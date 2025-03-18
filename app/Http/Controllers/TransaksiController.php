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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $res_transaksi = DB::select('SELECT p.`id`,p.`code_transaksi`,p.`nama`,p.`email`,p.`no_telp`,p.`payment_status`,p.`total_amount`,p.`transaction_date`,l.`nama_kos` AS kos, s.`status` AS status
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
            'code_transaksi' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'id_kos' => 'required'
        ]);

        try {
            DB::table('tbl_transaksi')->insert([
                'code_transaksi' => $this->generateTransaksiCode(),
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'transaction_date' => $request->transaction_date,
                'payment_status' => $request->payment_status,
                'total_amount' => $request->total_amount,
                'id_kos' => $request->id_kos,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()
                ->route('transaksi.list')
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    private function generateTransaksiCode()
    {
        $latestTransaksi = transaksi::latest('code_transaksi')->first();

        if (!$latestTransaksi) {
            return 'TRAN001';
        }

        $lastNumber = intval(substr($latestTransaksi->code_transaksi, 3));
        $newNumber = $lastNumber + 1;

        return 'CUST' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
