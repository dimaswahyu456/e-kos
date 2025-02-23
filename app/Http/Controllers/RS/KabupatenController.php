<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_kabupaten = DB::select('select * from tbl_kabupaten as kab inner join tbl_propinsi as prov on kab.kd_propinsi = prov.kd_propinsi');
        $title = 'Kabupaten';
        return view('master.list-kabupaten', compact('title', 'res_kabupaten'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_prop = DB::select('select * from tbl_propinsi');
        return view('master.add-kabupaten', compact('res_prop'));
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
            'kd_propinsi' => 'required',
            'nama_kabupaten' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_kabupaten (kd_propinsi,nama_kabupaten)
        VALUES ("' . $request->kd_propinsi . '","' . $request->nama_kabupaten . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('kabupaten.list')
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
        $res_find = DB::select('select * from tbl_kabupaten where kd_kabupaten=' . $id);
        $find = $res_find[0];
        $res_prop = DB::select('select * from tbl_propinsi');
        return view('master.show-kabupaten', compact('find', 'res_prop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_kabupaten where kd_kabupaten=' . $id);
        $find = $res_find[0];
        $res_prop = DB::select('select * from tbl_propinsi');
        return view('master.edit-kabupaten', compact('find', 'res_prop'));
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
            'kd_propinsi' => 'required',
            'nama_kabupaten' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_kabupaten
        SET kd_propinsi="' . $request->kd_propinsi . '",nama_kabupaten="' . $request->nama_kabupaten . '" WHERE kd_kabupaten=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('kabupaten.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_kabupaten WHERE kd_kabupaten=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('kabupaten.list')
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
