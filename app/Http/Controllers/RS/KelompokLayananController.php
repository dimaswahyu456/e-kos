<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelompokLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_layanan = DB::select('select * from tbl_kelompok_layanan');
        $title = 'Layanan';
        return view('master.list-layanan', compact('title', 'res_layanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.add-layanan');
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
            'nama_kelompok_layanan' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_kelompok_layanan (nama_kelompok_layanan)
        VALUES ("' . $request->nama_kelompok_layanan . '"); ');

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
        $res_find = DB::select('select * from tbl_kelompok_layanan where id_kl=' . $id);
        $find = $res_find[0];
        return view('master.show-layanan', compact('find'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_kelompok_layanan where id_kl=' . $id);
        $find = $res_find[0];
        return view('master.edit-layanan', compact('find'));
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
            'nama_kelompok_layanan' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_kelompok_layanan
        SET nama_kelompok_layanan="' . $request->nama_kelompok_layanan . '" WHERE id_kl=' . $id . '; ');

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
        $resdelete = DB::delete('DELETE FROM tbl_kelompok_layanan WHERE id_kl=' . $id . ';');

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
