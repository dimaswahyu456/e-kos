<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\kos;

class KosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_kos = DB::select('select * from tbl_kos');
        $title = 'Data Kos';
        return view('kos.list-kos', compact('title', 'res_kos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodekos = $this->generateKosCode();
        $res_category = DB::select('select * from tbl_categories');
        $res_status = DB::select('select * from tbl_status');
        return view('kos.add-kos', compact('res_category', 'res_status', 'kodekos'));
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
            'kodekos' => 'required',
            'nama_kos' => 'required',
            'price' => 'required',
            'alamat' => 'required',
            'id_category' => 'required',
            'keterangan' => 'required',
            'image' => 'nullable|file|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        try {
            $kodeKos = $this->generateKosCode();
            $imageName = null;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('kos-images/' . $kodeKos), $imageName);
            }

            DB::table('tbl_kos')->insert([
                'kodekos' => $kodeKos,
                'nama_kos' => $request->nama_kos,
                'price' => $request->price,
                'alamat' => $request->alamat,
                'id_category' => $request->id_category,
                'status' => 1,
                'image' => $imageName,
                'keterangan' => $request->keterangan,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()
                ->route('kos.list')
                ->with(['success' => 'New post has been created successfully']);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with(['error' => 'Some problem occurred, please try again']);
        }
    }

    private function generateKosCode()
    {
        $latestKos = DB::table('tbl_kos')->latest('kodekos')->first();

        if (!$latestKos) {
            return 'KOS001';
        }

        $lastNumber = intval(substr($latestKos->kodekos, 3));
        $newNumber = $lastNumber + 1;

        return 'KOS' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function show($id)
    {
        $res_find = DB::select('select * from tbl_kos where id=' . $id);
        $find = $res_find[0];
        $res_category = DB::select('select * from tbl_categories');
        $res_status = DB::select('select * from tbl_status');
        return view('kos.show-kos', compact('find', 'res_category', 'res_status'));
    }

    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_kos where id=' . $id);
        $find = $res_find[0];
        $res_category = DB::select('select * from tbl_categories');
        $res_status = DB::select('select * from tbl_status');
        return view('kos.edit-kos', compact('find', 'res_category', 'res_status'));
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
            'kodekos' => 'required',
            'nama_kos' => 'required',
            'price' => 'required',
            'alamat' => 'required',
            'id_category' => 'required',
            'status' => 'required',
            'image' => 'nullable|file|image|mimes:png,jpg,jpeg|max:2048',
            'keterangan' => 'required'
        ]);

        try {
            $kos = DB::table('tbl_kos')->where('id', $id)->first();
            if (!$kos) {
                return redirect()->back()->with(['error' => 'Data tidak ditemukan!']);
            }

            $kodeKos = $request->kodekos;
            $imageName = $kos->image;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
                $folderPath = public_path('kos-images/' . $kodeKos);

                if ($kos->image && file_exists($folderPath . '/' . $kos->image)) {
                    unlink($folderPath . '/' . $kos->image);
                }

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $file->move($folderPath, $imageName);
            }

            DB::table('tbl_kos')
                ->where('id', $id)
                ->update([
                    'kodekos' => $kodeKos,
                    'nama_kos' => $request->nama_kos,
                    'price' => $request->price,
                    'alamat' => $request->alamat,
                    'id_category' => $request->id_category,
                    'status' => $request->status,
                    'image' => $imageName,
                    'keterangan' => $request->keterangan,
                    'updated_at' => now()
                ]);

            return redirect()
                ->route('kos.list')
                ->with(['success' => 'Data berhasil diperbarui']);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with(['error' => 'Terjadi kesalahan, silakan coba lagi']);
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
        $resdelete = DB::delete('DELETE FROM tbl_kos WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('kos.list')
                ->with([
                    'success' => 'New post has been delete successfully'
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
