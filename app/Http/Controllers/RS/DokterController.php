<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_dokter = DB::select('select d.id, l.nama_kelompok_layanan,d.nama,d.alamat,d.NIK,d.sip,jk.jenis_kelamin,d.tanggal_lahir,d.no_telp
        FROM tbl_dokter AS d 
        INNER JOIN tbl_kelompok_layanan AS l ON d.id_kl = l.id_kl 
        JOIN tbl_jenis_kelamin AS jk ON d.jenis_kelamin = jk.id 
        WHERE d.`status` = 1 ');
        $title = 'Dokter';
        return view('dokter.list-dokter', compact('title', 'res_dokter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res_kl = DB::select('select * from tbl_kelompok_layanan');
        $res_jenis_kelamin = DB::select('select * from tbl_jenis_kelamin');
        return view('dokter.add-dokter', compact('res_kl', 'res_jenis_kelamin'));
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
            'id_kl' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'NIK' => 'required',
            'sip' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp' => 'required',
            'status' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_dokter (id_kl,nama,alamat,NIK,sip,jenis_kelamin,tanggal_lahir,no_telp,status)
        VALUES ("' . $request->id_kl . '","' . $request->nama . '","' . $request->alamat . '","' . $request->NIK . '","' . $request->sip . '","' . $request->jenis_kelamin . '","' . $request->tanggal_lahir . '","' . $request->no_telp . '","' . $request->status . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('dokter.list')
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
        $res_find = DB::select('select * from tbl_dokter where id=' . $id);
        $find = $res_find[0];
        $res_kl = DB::select('select * from tbl_kelompok_layanan');
        $res_jenis_kelamin = DB::select('select * from tbl_jenis_kelamin');
        return view('dokter.show-dokter', compact('find', 'res_kl', 'res_jenis_kelamin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_dokter where id=' . $id);
        $find = $res_find[0];
        $res_kl = DB::select('select * from tbl_kelompok_layanan');
        $res_jenis_kelamin = DB::select('select * from tbl_jenis_kelamin');
        return view('dokter.edit-dokter', compact('find', 'res_kl', 'res_jenis_kelamin'));
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
            'id_kl' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'NIK' => 'required',
            'sip' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp' => 'required',
            'status' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_dokter
        SET id_kl="' . $request->id_kl . '",nama="' . $request->nama . '",alamat="' . $request->alamat . '",NIK="' . $request->NIK . '",sip="' . $request->sip . '",jenis_kelamin="' . $request->jenis_kelamin . '",tanggal_lahir="' . $request->tanggal_lahir . '",no_telp="' . $request->no_telp . '",status="' . $request->status . '" WHERE id=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('dokter.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_dokter WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('dokter.list')
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
