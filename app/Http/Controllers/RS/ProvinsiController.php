<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_prop = DB::select('select * from tbl_propinsi');
        $title = 'Provinsi';
        return view('master.list-propinsi', compact('title', 'res_prop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.add-propinsi');
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
            'nama_propinsi' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_propinsi (nama_propinsi)
        VALUES ("' . $request->nama_propinsi . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('propinsi.list')
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
        $res_find = DB::select('select * from tbl_propinsi where kd_propinsi=' . $id);
        $find = $res_find[0];
        return view('master.show-propinsi', compact('find'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_propinsi where kd_propinsi=' . $id);
        $find = $res_find[0];
        return view('master.edit-propinsi', compact('find'));
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
            'nama_propinsi' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_propinsi
        SET nama_propinsi="' . $request->nama_propinsi . '" WHERE kd_propinsi=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('propinsi.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_propinsi WHERE kd_propinsi=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('propinsi.list')
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
