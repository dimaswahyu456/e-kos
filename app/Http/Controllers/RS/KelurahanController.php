<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_kelurahan = DB::select('select a.`kd_kelurahan`,b.`nama_kecamatan`,a.`nama_kelurahan` FROM tbl_kelurahan AS a INNER JOIN tbl_kecamatan AS b ON a.`kd_kecamatan`=b.`kd_kecamatan`');
        $title = 'Kelurahan';
        return view('master.list-kelurahan', compact('title', 'res_kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_kec = DB::select('select * from tbl_kecamatan');
        return view('master.add-kelurahan', compact('res_kec'));
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
            'kd_kecamatan' => 'required',
            'nama_kelurahan' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_kelurahan (kd_kecamatan,nama_kelurahan)
        VALUES ("' . $request->kd_kecamatan . '","' . $request->nama_kelurahan . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('kelurahan.list')
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
        $res_find = DB::select('select * from tbl_kelurahan where kd_kelurahan=' . $id);
        $find = $res_find[0];
        $res_kec = DB::select('select * from tbl_kecamatan');
        return view('master.show-kelurahan', compact('find', 'res_kec'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_kelurahan where kd_kelurahan=' . $id);
        $find = $res_find[0];
        $res_kec = DB::select('select * from tbl_kecamatan');
        return view('master.edit-kelurahan', compact('find', 'res_kec'));
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
            'kd_kecamatan' => 'required',
            'nama_kelurahan' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_kelurahan
        SET kd_kecamatan="' . $request->kd_kecamatan . '",nama_kelurahan="' . $request->nama_kelurahan . '" WHERE kd_kelurahan=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('kelurahan.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_kelurahan WHERE kd_kelurahan=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('kelurahan.list')
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
