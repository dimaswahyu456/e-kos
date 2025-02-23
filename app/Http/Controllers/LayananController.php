<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
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
        $res_layanan = DB::select('select * from tbl_layanan');
        $title = 'Data Layanan';
        return view('layanan.list-layanan', compact('title', 'res_layanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layanan.add-layanan');
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
            'nama_layanan' => 'required',
            'harga' => 'required',
            'keterangan' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_layanan (nama_layanan,harga,keterangan,created_at,updated_at)
        VALUES ("' . $request->nama_layanan . '","' . $request->harga . '","' . $request->keterangan . '","' . now() . '","' . now() . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('layanan.list')
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res_find = DB::select('select * from tbl_layanan where id=' . $id);
        $find = $res_find[0];
        return view('layanan.show-layanan', compact('find'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_layanan where id=' . $id);
        $find = $res_find[0];
        return view('layanan.edit-layanan', compact('find'));
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
            'nama_layanan' => 'required',
            'harga' => 'required',
            'keterangan' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_layanan
        SET nama_layanan="' . $request->nama_layanan . '",harga="' . $request->harga . '",keterangan="' . $request->keterangan . '",updated_at="' . now() . '" WHERE id=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('layanan.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_layanan WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('layanan.list')
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
