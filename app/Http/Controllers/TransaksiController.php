<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\transaksi;
use Midtrans\Config;
use Midtrans\Snap;

class TransaksiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $res_transaksi = DB::select('SELECT p.`id`,p.`code_transaksi`,p.`nama`,p.`email`,p.`no_telp`,p.`payment_status`,p.`total_amount`,p.`transaction_date`,l.`nama_kos` AS kos
        FROM tbl_transaksi p
        LEFT JOIN tbl_kos l ON p.`id_kos`=l.`id`');
        $title = 'Data Transaksi';
        return view('transaksi.list-transaksi', compact('title', 'res_transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code_transaksi = $this->generateTransaksiCode();
        $res_kos = DB::select('select * from tbl_kos');
        return view('transaksi.add-transaksi', compact('res_kos', 'code_transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'id_kos' => 'required|integer',
            'total_amount' => 'required|numeric'
        ]);

        try {
            $transaksiId = DB::table('tbl_transaksi')->insertGetId([
                'code_transaksi' => $this->generateTransaksiCode(),
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'transaction_date' => now(),
                'payment_status' => 'pending',
                'total_amount' => $request->total_amount,
                'id_kos' => $request->id_kos,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION') == "true";
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Buat transaksi Midtrans
            $transactionDetails = [
                'order_id' => $transaksiId,
                'gross_amount' => (int) $request->total_amount,
            ];

            $customerDetails = [
                'first_name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->no_telp,
            ];

            $transaction = [
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails,
            ];

            $snapToken = Snap::getSnapToken($transaction);

            return response()->json(['snap_token' => $snapToken, 'order_id' => $transaksiId]);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    private function generateTransaksiCode()
    {
        $latestTransaksi = transaksi::where('code_transaksi', 'LIKE', 'TRAN%')
            ->orderByRaw("CAST(SUBSTRING(code_transaksi, 5, LENGTH(code_transaksi)-4) AS UNSIGNED) DESC")
            ->first();

        if (!$latestTransaksi || empty($latestTransaksi->code_transaksi)) {
            return 'TRAN001';
        }

        $lastNumber = intval(substr($latestTransaksi->code_transaksi, 4));
        $newNumber = $lastNumber + 1;

        return 'TRAN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function notificationHandler(Request $request)
    {
        // \Log::info('Midtrans Notification Received: ' . $request->getContent());
        $notif = json_decode($request->getContent(), true);
        $transaction = $notif['transaction_status'];
        $orderId = $notif['order_id'];

        // if (!$this->isValidSignature($request)) {
        //     return response()->json(['error' => 'Invalid signature'], 403);
        // }

        // \Log::info("Status: $transaction, Order ID: $orderId");

        $transaction = $notif['transaction_status'];
        $orderId = $notif['order_id'];

        if ($transaction == 'capture' || $transaction == 'settlement') {
            DB::table('tbl_transaksi')
                ->where('id', $orderId)
                ->update(['payment_status' => 'paid']);
        } elseif ($transaction == 'pending') {
            DB::table('tbl_transaksi')
                ->where('id', $orderId)
                ->update(['payment_status' => 'pending']);
        } elseif ($transaction == 'cancel' || $transaction == 'expire' || $transaction == 'deny') {
            DB::table('tbl_transaksi')
                ->where('id', $orderId)
                ->update(['payment_status' => 'failed']);
        }

        return response()->json(['message' => 'Notification processed']);
    }

    private function isValidSignature(Request $request)
    {
        $signatureKey = $request->input('signature_key');
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $serverKey = env('MIDTRANS_SERVER_KEY');

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return $signatureKey === $expectedSignature;
    }

    public function destroy($id)
    {
        $resdelete = DB::delete('DELETE FROM tbl_transaksi WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('transaksi.list')
                ->with([
                    'success' => 'New post has been delete successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
}
