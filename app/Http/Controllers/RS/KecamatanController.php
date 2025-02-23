<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_kecamatan = DB::select('select * from tbl_kecamatan as kec inner join tbl_kabupaten as kab on kec.kd_kabupaten = kab.kd_kabupaten');
        $title = 'Kecamatan';
        return view('master.list-kecamatan', compact('title', 'res_kecamatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_kab = DB::select('select * from tbl_kabupaten');
        return view('master.add-kecamatan', compact('res_kab'));
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
            'kd_kabupaten' => 'required',
            'nama_kecamatan' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_kecamatan (kd_kabupaten,nama_kecamatan)
        VALUES ("' . $request->kd_kabupaten . '","' . $request->nama_kecamatan . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('kecamatan.list')
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
        $res_find = DB::select('select * from tbl_kecamatan where kd_kecamatan=' . $id);
        $find = $res_find[0];
        $res_kab = DB::select('select * from tbl_kabupaten');
        return view('master.show-kecamatan', compact('find', 'res_kab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_kecamatan where kd_kecamatan=' . $id);
        $find = $res_find[0];
        $res_kab = DB::select('select * from tbl_kabupaten');
        return view('master.edit-kecamatan', compact('find', 'res_kab'));
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
            'kd_kabupaten' => 'required',
            'nama_kecamatan' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_kecamatan
        SET kd_kabupaten="' . $request->kd_kabupaten . '",nama_kecamatan="' . $request->nama_kecamatan . '" WHERE kd_kecamatan=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('kecamatan.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_kecamatan WHERE kd_kecamatan=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('kecamatan.list')
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
