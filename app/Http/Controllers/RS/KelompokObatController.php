<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelompokObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        $res_kelompok_obat = DB::select('select * from tbl_kelompok_obat as ko inner join tbl_kategori_obat as kat on ko.id_kategori = kat.id_kategori');
        $title = 'kelompok_obat';
        return view('master.list-kelompok_obat', compact('title', 'res_kelompok_obat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_kategori = DB::select('select * from tbl_kategori_obat');
        return view('master.add-kelompok_obat', compact('res_kategori'));
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
            'id_kategori' => 'required',
            'nama_kelompok' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_kelompok_obat (id_kategori,nama_kelompok)
        VALUES ("' . $request->id_kategori . '","' . $request->nama_kelompok . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('kelompok_obat.list')
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
        $res_find = DB::select('select * from tbl_kelompok_obat where id=' . $id);
        $find = $res_find[0];
        $res_kategori = DB::select('select * from tbl_kategori_obat');
        return view('master.show-kelompok_obat', compact('find', 'res_kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_kelompok_obat where id=' . $id);
        $find = $res_find[0];
        $res_kategori = DB::select('select * from tbl_kategori_obat');
        return view('master.edit-kelompok_obat', compact('find', 'res_kategori'));
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
            'id_kategori' => 'required',
            'nama_kelompok' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_kelompok_obat
        SET id_kategori="' . $request->id_kategori . '",nama_kelompok="' . $request->nama_kelompok . '" WHERE id=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('kelompok_obat.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_kelompok_obat WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('kelompok_obat.list')
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
