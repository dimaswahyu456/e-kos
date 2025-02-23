<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_penyakit = DB::select('select * from tbl_penyakit 
        ORDER BY id_penyakit DESC
        LIMIT 500');
        $title = 'penyakit';
        return view('penyakit.list-penyakit', compact('title', 'res_penyakit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penyakit.add-penyakit');
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
            'code_icdx' => 'required',
            'english_desc' => 'required',
            'indonesia_desc' => 'required'
        ]);

        $resinsert = DB::insert('INSERT INTO tbl_penyakit (code_icdx,english_desc,indonesia_desc)
        VALUES ("' . $request->code_icdx . '","' . $request->english_desc . '","' . $request->indonesia_desc . '"); ');

        if ($resinsert) {
            return redirect()
                ->route('penyakit.list')
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
        $res_find = DB::select('select * from tbl_penyakit where id_penyakit=' . $id);
        $find = $res_find[0];
        return view('penyakit.show-penyakit', compact('find'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_penyakit where id_penyakit=' . $id);
        $find = $res_find[0];
        return view('penyakit.edit-penyakit', compact('find'));
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
            'code_icdx' => 'required',
            'english_desc' => 'required',
            'indonesia_desc' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_penyakit
        SET code_icdx="' . $request->code_icdx . '",english_desc="' . $request->english_desc . '",indonesia_desc="' . $request->indonesia_desc . '" WHERE id_penyakit=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('penyakit.list')
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
        $resdelete = DB::delete('DELETE FROM tbl_penyakit WHERE id_penyakit=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('penyakit.list')
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
