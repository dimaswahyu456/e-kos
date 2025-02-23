<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_pasien = DB::select('SELECT p.id,p.nama,p.alamat,p.alamat_tinggal,p.tanggal_lahir,jk.jenis_kelamin,p.no_pasien,p.no_telp,prov.nama_propinsi,kb.nama_kabupaten,kec.nama_kecamatan,kel.nama_kelurahan,pek.nama_pekerjaan,kwn.status_perkawinan,ddk.nama_pendidikan,ag.agama,drh.golongan_darah,wrg.warga_negara,p.id_jenis_kelamin,p.kd_propinsi,p.kd_kabupaten,p.kd_kecamatan,p.kd_kelurahan,p.id_pekerjaan,p.id_pendidikan,p.id_wn,p.id_agama,p.id_darah,p.id_perkawinan
        FROM tbl_pasien AS p 
        LEFT JOIN tbl_propinsi AS prov ON p.kd_propinsi = prov.kd_propinsi 
        LEFT JOIN tbl_kabupaten AS kb ON p.kd_kabupaten = kb.kd_kabupaten 
        LEFT JOIN tbl_kecamatan kec ON p.kd_kecamatan = kec.kd_kecamatan 
        LEFT JOIN tbl_kelurahan AS kel ON p.kd_kelurahan = kel.kd_kelurahan 
        LEFT JOIN tbl_pekerjaan AS pek ON p.id_pekerjaan = pek.id_pekerjaan 
        LEFT JOIN tbl_perkawinan AS kwn ON p.id_perkawinan = kwn.id_perkawinan 
        LEFT JOIN tbl_pendidikan AS ddk ON p.id_pendidikan = ddk.id_pendidikan 
        LEFT JOIN tbl_agama AS ag ON p.id_agama = ag.id_agama 
        LEFT JOIN tbl_golongan_darah AS drh ON p.id_darah = drh.id_darah 
        LEFT JOIN tbl_kewarganegaraan AS wrg ON p.id_wn = wrg.id_wn 
        LEFT JOIN tbl_jenis_kelamin AS jk ON p.id_jenis_kelamin = jk.id
        LIMIT 500');
        $title = 'pasien';
        return view('pasien.list-pasien', compact('title', 'res_pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_propinsi = DB::select('select * from tbl_propinsi');
        $res_kabupaten = DB::select('select * from tbl_kabupaten');
        $res_kecamatan = DB::select('select * from tbl_kecamatan');
        $res_kelurahan = DB::select('select * from tbl_kelurahan');
        $res_pekerjaan = DB::select('select * from tbl_pekerjaan');
        $res_perkawinan = DB::select('select * from tbl_perkawinan');
        $res_pendidikan = DB::select('select * from tbl_pendidikan');
        $res_jk = DB::select('select * from tbl_jenis_kelamin');
        $res_agama = DB::select('select * from tbl_agama');
        $res_golongan_darah = DB::select('select * from tbl_golongan_darah');
        $res_kewarganegaraan = DB::select('select * from tbl_kewarganegaraan');
        return view('pasien.add-pasien', compact('res_propinsi', 'res_kabupaten', 'res_kecamatan', 'res_kelurahan', 'res_pekerjaan', 'res_perkawinan', 'res_pendidikan', 'res_agama', 'res_golongan_darah', 'res_kewarganegaraan', 'res_jk'));
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
            'nama' => 'required',
            'alamat' => 'required',
            'alamat_tinggal' => 'required',
            'tanggal_lahir' => 'required',
            'id_jenis_kelamin' => 'required',
            'no_pasien' => 'required',
            'no_telp' => 'required',
            'kd_propinsi' => 'required',
            'kd_kabupaten' => 'required',
            'kd_kecamatan' => 'required',
            'kd_kelurahan' => 'required',
            'id_pekerjaan' => 'required',
            'id_perkawinan' => 'required',
            'id_pendidikan' => 'required',
            'id_agama' => 'required',
            'id_darah' => 'required',
            'id_wn' => 'required',
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_pasien (nama,alamat,alamat_tinggal,tanggal_lahir,id_jenis_kelamin,no_pasien,no_telp,kd_propinsi,kd_kabupaten,kd_kecamatan,kd_kelurahan,id_pekerjaan,id_perkawinan,id_pendidikan,id_agama,id_darah,id_wn)
        VALUES ("' . $request->nama . '","' . $request->alamat . '","' . $request->alamat_tinggal . '","' . $request->tanggal_lahir . '","' . $request->id_jenis_kelamin . '","' . $request->no_pasien . '","' . $request->no_telp . '","' . $request->kd_propinsi . '","' . $request->kd_kabupaten . '","' . $request->kd_kecamatan . '","' . $request->kd_kelurahan . '","' . $request->id_pekerjaan . '","' . $request->id_perkawinan . '","' . $request->id_pendidikan . '","' . $request->id_agama . '","' . $request->id_darah . '","' . $request->id_wn . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('pasien.list')
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
        $res_propinsi = DB::select('select * from tbl_propinsi');
        $res_kabupaten = DB::select('select * from tbl_kabupaten');
        $res_kecamatan = DB::select('select * from tbl_kecamatan');
        $res_kelurahan = DB::select('select * from tbl_kelurahan');
        $res_pekerjaan = DB::select('select * from tbl_pekerjaan');
        $res_perkawinan = DB::select('select * from tbl_perkawinan');
        $res_pendidikan = DB::select('select * from tbl_pendidikan');
        $res_agama = DB::select('select * from tbl_agama');
        $res_jk = DB::select('select * from tbl_jenis_kelamin');
        $res_golongan_darah = DB::select('select * from tbl_golongan_darah');
        $res_kewarganegaraan = DB::select('select * from tbl_kewarganegaraan');
        return view('pasien.show-pasien', compact('find', 'res_propinsi', 'res_kabupaten', 'res_kecamatan', 'res_kelurahan', 'res_pekerjaan', 'res_perkawinan', 'res_pendidikan', 'res_agama', 'res_golongan_darah', 'res_kewarganegaraan', 'res_jk'));
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
        $res_propinsi = DB::select('select * from tbl_propinsi');
        $res_kabupaten = DB::select('select * from tbl_kabupaten');
        $res_kecamatan = DB::select('select * from tbl_kecamatan');
        $res_kelurahan = DB::select('select * from tbl_kelurahan');
        $res_pekerjaan = DB::select('select * from tbl_pekerjaan');
        $res_perkawinan = DB::select('select * from tbl_perkawinan');
        $res_pendidikan = DB::select('select * from tbl_pendidikan');
        $res_agama = DB::select('select * from tbl_agama');
        $res_jk = DB::select('select * from tbl_jenis_kelamin');
        $res_golongan_darah = DB::select('select * from tbl_golongan_darah');
        $res_kewarganegaraan = DB::select('select * from tbl_kewarganegaraan');
        return view('pasien.edit-pasien', compact('find', 'res_propinsi', 'res_kabupaten', 'res_kecamatan', 'res_kelurahan', 'res_pekerjaan', 'res_perkawinan', 'res_pendidikan', 'res_agama', 'res_golongan_darah', 'res_kewarganegaraan', 'res_jk'));
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
            'nama' => 'required',
            'alamat' => 'required',
            'alamat_tinggal' => 'required',
            'tanggal_lahir' => 'required',
            'id_jenis_kelamin' => 'required',
            'no_pasien' => 'required',
            'no_telp' => 'required',
            'kd_propinsi' => 'required',
            'kd_kabupaten' => 'required',
            'kd_kecamatan' => 'required',
            'kd_kelurahan' => 'required',
            'id_pekerjaan' => 'required',
            'id_perkawinan' => 'required',
            'id_pendidikan' => 'required',
            'id_agama' => 'required',
            'id_darah' => 'required',
            'id_wn' => 'required',
        ]);

        $resupdate = DB::update('UPDATE tbl_pasien
        SET nama="' . $request->nama . '",alamat="' . $request->alamat . '",alamat_tinggal="' . $request->alamat_tinggal . '",tanggal_lahir="' . $request->tanggal_lahir . '",id_jenis_kelamin="' . $request->id_jenis_kelamin . '",no_pasien="' . $request->no_pasien . '",no_telp="' . $request->no_telp . '",kd_propinsi="' . $request->kd_propinsi . '",kd_kabupaten="' . $request->kd_kabupaten . '",kd_kecamatan="' . $request->kd_kecamatan . '",kd_kelurahan="' . $request->kd_kelurahan . '",id_pekerjaan="' . $request->id_pekerjaan . '",id_perkawinan="' . $request->id_perkawinan . '",id_pendidikan="' . $request->id_pendidikan . '",id_agama="' . $request->id_agama . '",id_darah="' . $request->id_darah . '",id_wn="' . $request->id_wn . '" WHERE id=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('pasien.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_pasien WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('pasien.list')
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
