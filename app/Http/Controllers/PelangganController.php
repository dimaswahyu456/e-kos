<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\DateTimeZone;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controller\Log;
use App\Models\pelanggan;
use App\Models\layanan;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $res_pelanggan = DB::select('SELECT p.`id`,p.`kodecust`,p.`nama_pelanggan`,p.`no_telp`,p.`alamat`,p.`tgl_masuk`,jk.`jenis_kelamin` AS jenis_kelamin,l.`nama_kos` AS kos, s.`status` AS status
        FROM tbl_pelanggan p
        LEFT JOIN jenis_kelamin jk ON p.`jenis_kelamin`=jk.`id`
        LEFT JOIN tbl_kos l ON p.`id_kos`=l.`id`
        LEFT JOIN tbl_status s ON p.`status`=s.`id`');
        $title = 'Data Pelanggan';
        return view('pelanggan.list-pelanggan', compact('title', 'res_pelanggan'));
    }

    public function create()
    {
        $kodecust = $this->generatePelangganCode();
        $res_kos = DB::select('select * from tbl_kos');
        $res_jenis_kelamin = DB::select('select * from jenis_kelamin');
        $res_status = DB::select('select * from tbl_status');
        return view('pelanggan.add-pelanggan', compact('res_kos', 'res_jenis_kelamin', 'kodecust', 'res_status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kodecust' => 'required',
            'nama_pelanggan' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_masuk' => 'required',
            'id_kos' => 'required',
            'status' => 'required'
        ]);

        try {
            DB::table('tbl_pelanggan')->insert([
                'kodecust' => $this->generatePelangganCode(),
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_masuk' => $request->tgl_masuk,
                'id_kos' => $request->id_kos,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()
                ->route('pelanggan.list')
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    private function generatePelangganCode()
    {
        $latestPelanggan = Pelanggan::latest('kodecust')->first();

        if (!$latestPelanggan) {
            return 'CUST001';
        }

        $lastNumber = intval(substr($latestPelanggan->kodecust, 3));
        $newNumber = $lastNumber + 1;

        return 'CUST' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function show($id)
    {
        $res_find = DB::select('select * from tbl_pelanggan where id=' . $id);
        $find = $res_find[0];
        $res_kos = DB::select('select * from tbl_kos');
        $res_jenis_kelamin = DB::select('select * from jenis_kelamin');
        $res_status = DB::select('select * from tbl_status');
        return view('pelanggan.show-pelanggan', compact('find', 'res_kos', 'res_jenis_kelamin', 'res_status'));
    }

    public function edit($id)
    {
        $res_find = DB::select('select * from tbl_pelanggan where id=' . $id);
        $find = $res_find[0];
        $res_kos = DB::select('select * from tbl_kos');
        $res_jenis_kelamin = DB::select('select * from jenis_kelamin');
        $res_status = DB::select('select * from tbl_status');
        return view('pelanggan.edit-pelanggan', compact('find', 'res_kos', 'res_jenis_kelamin', 'res_status'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kodecust' => 'required',
            'nama_pelanggan' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_masuk' => 'required',
            'id_kos' => 'required',
            'status' => 'required'
        ]);

        $resupdate = DB::update('UPDATE tbl_pelanggan
        SET kodecust="' . $request->kodecust . '",nama_pelanggan="' . $request->nama_pelanggan . '",no_telp="' . $request->no_telp . '",alamat="' . $request->alamat . '",jenis_kelamin="' . $request->jenis_kelamin . '",tgl_masuk="' . $request->tgl_masuk . '",id_kos="' . $request->id_kos . '",status="' . $request->status . '",updated_at="' . now() . '" WHERE id=' . $id . '; ');

        if ($resupdate) {
            return redirect()
                ->route('pelanggan.list')
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

    public function destroy($id)
    {
        $resdelete = DB::delete('DELETE FROM tbl_pelanggan WHERE id=' . $id . ';');

        if ($resdelete) {
            return redirect()
                ->route('pelanggan.list')
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

    public function sendWhatsAppMessage()
    {
        $curl = curl_init();
        $query = 'SELECT * FROM tbl_pelanggan';
        $dataPelanggan = DB::select($query);

        foreach ($dataPelanggan as $pelanggan) {
            $tanggalPemasangan = new DateTime($pelanggan->tgl_psb);
            $tanggaljt = clone $tanggalPemasangan;
            $tanggaljt->modify('+1 month');
            $tanggalpl = clone $tanggaljt;
            $tanggalpl->modify('-1 day');

            $tanggaljtf = $tanggaljt->format('d-m-Y');
            $tanggalplf = $tanggalpl->format('d-m-Y');

            // Format pesan
            $message = "Yth. Pelanggan setia Sadayana Net,\n\n";
            $message .= "Saat ini kami informasikan bahwa masa aktif dari :\n\n";
            $message .= "Nomer Pelanggan    : {$pelanggan->id}\n";
            $message .= "Nama Pelanggan     : {$pelanggan->nama_pelanggan}\n\n";
            $message .= "Akan segera berakhir pada tanggal $tanggaljtf\n\n";
            $message .= "Mohon segera melakukan pembayaran paling lambat tanggal $tanggalplf melalui :\n\n";
            $message .= "No rekening   : 002601030293530\n";
            $message .= "Bank/ A.N     : BRI / Satya Bhakti Nuswanto\n";
            $message .= "Total biaya   : Rp {$pelanggan->total_tagihan}\n\n";
            $message .= "Demikian informasi yang kami sampaikan, mohon maaf apabila mengganggu waktunya.\n\n";
            $message .= "Jika sudah menyelesaikan pembayaran harap konfirmasi kembali.\n\n";
            $message .= "Atas perhatiannya kami ucapkan terima kasih.";

            // Kirim pesan
            $payload = [
                'target' => $pelanggan->no_telp,
                'message' => $message,
                'countryCode' => '62',
            ];

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: P0nBh5Qc7TpDKG+_kTD1'
                ),
            ));

            $response = curl_exec($curl);

            if (!$response) {
                return response()->json(['error' => 'Gagal kirim message'], 500);
            }
        }

        curl_close($curl);

        return redirect()->back()->with('success', 'Data berhasil disimpan dan pesan terkirim ke nomor WhatsApp pelanggan.');
    }

    public function sendWhatsAppMessageSchedule()
    {

        $query = 'SELECT * FROM tbl_pelanggan';
        $dataPelanggan = DB::select($query);

        foreach ($dataPelanggan as $pelanggan) {
            $curl = curl_init();
            // Mengambil tanggal jadwal kirim dari tabel datetime
            // $scheduledDatetime = DB::table('datetime')->value('scheduled_datetime');
            $tgl_psb = new DateTime($pelanggan->tgl_psb);

            // Menghitung tanggal H-2 dari masa aktif
            $scheduledDatetime = clone $tgl_psb;
            $scheduledDatetime->modify('-2 days');
            $scheduledDatetime->setTime(8, 0, 0);

            // Tentukan zona waktu yang diinginkan (WIB)
            $timezone = new \DateTimeZone('Asia/Jakarta');

            // Ubah waktu ke zona waktu yang diinginkan
            $scheduledDatetime->setTimezone($timezone);

            // Mendapatkan timestamp UNIX dengan zona waktu yang benar
            $scheduledTimestamp = $scheduledDatetime->getTimestamp();
            // dd($scheduledTimestamp);

            $tanggalPemasangan = new DateTime($pelanggan->tgl_psb);
            $tanggaljt = clone $tanggalPemasangan;
            $tanggaljt->modify('+1 month');
            $tanggalpl = clone $tanggaljt;
            $tanggalpl->modify('-1 day');

            $tanggaljtf = $tanggaljt->format('d-m-Y');
            $tanggalplf = $tanggalpl->format('d-m-Y');

            // Format pesan
            $message = "Yth. Pelanggan setia Sadayana Net,\n\n";
            $message .= "Saat ini kami informasikan bahwa masa aktif dari :\n\n";
            $message .= "Nomer Pelanggan    : {$pelanggan->id}\n";
            $message .= "Nama Pelanggan     : {$pelanggan->nama_pelanggan}\n\n";
            $message .= "Akan segera berakhir pada tanggal $tanggaljtf\n\n";
            $message .= "Mohon segera melakukan pembayaran paling lambat tanggal $tanggalplf melalui :\n\n";
            $message .= "No rekening   : 002601030293530\n";
            $message .= "Bank/ A.N     : BRI / Satya Bhakti Nuswanto\n";
            $message .= "Total biaya   : Rp {$pelanggan->total_tagihan}\n\n";
            $message .= "Demikian informasi yang kami sampaikan, mohon maaf apabila mengganggu waktunya.\n\n";
            $message .= "Jika sudah menyelesaikan pembayaran harap konfirmasi kembali.\n\n";
            $message .= "Atas perhatiannya kami ucapkan terima kasih.\n\n";

            // // Menambahkan tanggal yang dijadwalkan ke dalam pesan
            // $message .= "Tanggal Jadwal Kirim : " . $scheduledDatetime . "\n";

            // // Mengubah tanggal yang dijadwalkan menjadi unix timestamp hingga detik
            // $scheduledTimestamp = strtotime($scheduledDatetime);

            // Kirim pesan dengan jadwal
            $payload = [
                'target' => $pelanggan->no_telp,
                'message' => $message,
                'delay' => '2',
                'schedule' =>   $scheduledTimestamp, // Menggunakan timestamp UNIX hingga detik
                'countryCode' => '62',
            ];
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: q+k+bRWj+nLF9Q1sfzwd',
                ),
            ));

            $response = curl_exec($curl);

            if (!$response) {
                return response()->json(['error' => 'Gagal kirim message'], 500);
            }

            curl_close($curl);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan dan pesan terkirim ke nomor WhatsApp pelanggan.');
    }
}
