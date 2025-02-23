<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_obat = DB::select('select * from tbl_obat as o inner join tbl_kategori_obat kat on o.id_kategori = kat.id_kategori join tbl_kelompok_obat as kel on o.id_kel_obat = kel.id_kel_obat join tbl_satuan_obat as sat on o.id_satuan = sat.id_satuan join tbl_pabrik_obat as p on o.id_pabrik = p.id_pabrik');
        $title = 'obat';
        return view('rs.list-obat', compact('title', 'res_obat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_kategori_obat = DB::select('select * from tbl_kategori_obat');
        $res_kelompok_obat = DB::select('select * from tbl_kelompok_obat');
        $res_satuan_obat = DB::select('select * from tbl_satuan_obat');
        $res_pabrik_obat = DB::select('select * from tbl_pabrik_obat');
        return view('rs.add-dokter', compact('res_kategori_obat', 'res_kelompok_obat', 'res_satuan_obat', 'res_pabrik_obat'));
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
            'id_kel_obat' => 'required',
            'id_satuan' => 'required',
            'id_pabrik' => 'required',
            'kode_obat' => 'required',
            'nama_obat' => 'required',
            'nama_generik' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_dokter (id_kategori,id_kel_obat,id_satuan,id_pabrik,kode_obat,nama_obat,nama_generik)
        VALUES ("' . $request->id_kategori . '","' . $request->id_kel_obat . '","' . $request->id_satuan . '",,"' . $request->id_pabrik . '","' . $request->kode_obat . '","' . $request->nama_obat . '","' . $request->nama_generik . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('obat.list')
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
        $res_find = DB::select('select * from tbl_pasien where id=' . $id);
        $find = $res_find[0];
        $res_kategori_obat = DB::select('select * from tbl_kategori_obat');
        $res_kelompok_obat = DB::select('select * from tbl_kelompok_obat');
        $res_satuan_obat = DB::select('select * from tbl_satuan_obat');
        $res_pabrik_obat = DB::select('select * from tbl_pabrik_obat');
        return view('rs.show-pasien', compact('find', 'res_kategori_obat', 'res_kelompok_obat', 'res_satuan_obat', 'res_pabrik_obat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_pasien where id=' . $id);
        $find = $res_find[0];
        $res_kategori_obat = DB::select('select * from tbl_kategori_obat');
        $res_kelompok_obat = DB::select('select * from tbl_kelompok_obat');
        $res_satuan_obat = DB::select('select * from tbl_satuan_obat');
        $res_pabrik_obat = DB::select('select * from tbl_pabrik_obat');
        return view('rs.edit-pasien', compact('find', 'res_kategori_obat', 'res_kelompok_obat', 'res_satuan_obat', 'res_pabrik_obat'));
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
            'id_kel_obat' => 'required',
            'id_satuan' => 'required',
            'id_pabrik' => 'required',
            'kode_obat' => 'required',
            'nama_obat' => 'required',
            'nama_generik' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_obat
        SET id_kategori="' . $request->id_kategori . '",id_kel_obat="' . $request->id_kel_obat . '",id_satuan="' . $request->id_satuan . '",id_pabrik="' . $request->id_pabrik . '",kode_obat="' . $request->kode_obat . '",nama_obat="' . $request->nama_obat . '",nama_generik="' . $request->nama_generik . '" WHERE id=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('obat.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_obat WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('obat.list')
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
