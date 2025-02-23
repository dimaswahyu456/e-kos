<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_rm = DB::select('select rm.id_rekam,p.no_pasien,rm.tanggal_rekam,rm.keluhan,d.english_desc,dok.nama as nama_dokter,kl.nama_kelompok_layanan
        from tbl_rekam_medis rm 
        inner join tbl_penyakit d ON d.id_penyakit = rm.id_penyakit
        join tbl_registrasi r ON r.id_reg = rm.id_reg 
        join tbl_pasien p ON p.id = r.id_pasien
        join tbl_dokter dok on rm.id_dokter=dok.id
        join tbl_kelompok_layanan kl on dok.id_kl=kl.id_kl
        LIMIT 0, 1000');
        $title = 'rekam medis';
        return view('rekam_medis.list-rm', compact('title', 'res_rm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_penyakit = DB::select('select * from tbl_penyakit');
        return view('rekam_medis.add-rm', compact('res_penyakit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res_find = DB::select('select rm.id_rekam,p.no_pasien,rm.tanggal_rekam,rm.keluhan,d.english_desc,dok.nama as nama_dokter,kl.nama_kelompok_layanan
        from tbl_rekam_medis rm 
        inner join tbl_penyakit d ON d.id_penyakit = rm.id_penyakit
        join tbl_registrasi r ON r.id_reg = rm.id_reg 
        join tbl_pasien p ON p.id = r.id_pasien
        join tbl_dokter dok on rm.id_dokter=dok.id
        join tbl_kelompok_layanan kl on dok.id_kl=kl.id_kl where id_rekam=' . $id);
        $find = $res_find[0];
        $res_penyakit = DB::select('select * from tbl_penyakit');
        $res_pasien = DB::select('select * from tbl_pasien limit 0, 100');
        $res_dokter = DB::select('select * from tbl_dokter');
        $res_layanan = DB::select('select * from tbl_kelompok_layanan');
        return view('rekam_medis.show-rm', compact('find', 'res_penyakit', 'res_pasien', 'res_dokter', 'res_layanan'));
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
        //
    }
}
