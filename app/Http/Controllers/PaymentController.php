<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_payment = DB::select('SELECT p.`id`,p.`kode_payment`,p.`nama_payment`,s.`status` as status
        FROM tbl_payments p 
        LEFT JOIN tbl_status s ON p.`status`=s.`id`');
        $title = 'Data Payment';
        return view('payment.list-payment', compact('title', 'res_payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_payment = $this->generatePaymentCode();
        $res_status = DB::select('select * from tbl_status');
        return view('payment.add-payment', compact('kode_payment', 'res_status'));
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
            'kode_payment' => 'required',
            'nama_payment' => 'required',
            'status' => 'required'
        ]);

        try {
            DB::table('tbl_payments')->insert([
                'kode_payment' => $this->generatePaymentCode(),
                'nama_payment' => $request->nama_payment,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()
                ->route('payment.list')
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

    private function generatePaymentCode()
    {
        $latestPayment = Payment::latest('kode_payment')->first();

        if (!$latestPayment) {
            return 'PAY001';
        }

        $lastNumber = intval(substr($latestPayment->kode_payment, 3));
        $newNumber = $lastNumber + 1;

        return 'PAY' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res_find = DB::select('select * from tbl_payments where id=' . $id);
        $find = $res_find[0];
        $res_status = DB::select('select * from tbl_status');
        return view('payment.show-payment', compact('find', 'res_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_payments where id=' . $id);
        $find = $res_find[0];
        $res_status = DB::select('select * from tbl_status');
        return view('payment.edit-payment', compact('find', 'res_status'));
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
        $this->validate($request, [
            'kode_payment' => 'required',
            'nama_payment' => 'required',
            'status' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_payments
        SET kode_payment="' . $request->kode_payment . '",nama_payment="' . $request->nama_payment . '",status="' . $request->status . '",updated_at="' . now() . '" WHERE id=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('payment.list')
                ->with([
                    'success' => 'New post has been created successfully'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resdelete = DB::delete('DELETE FROM tbl_payments WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('payment.list')
                ->with([
                    'success' => 'New post has been created successfully'
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
