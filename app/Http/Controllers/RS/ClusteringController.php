<?php

namespace App\Http\Controllers\RS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\cluster;
use Illuminate\Support\Facades\DB;

class ClusteringController extends Controller
{
    public function index()
    {
        $data = RekamMedis::all();
        // Inisialisasi centroid awal
        $centroid = [
            ['indonesia_desc' => 4143, 'kecamatan' => 2008, 'jenis_kelamin' => 2, 'umur' => 4, 'layanan' => 1],
            ['indonesia_desc' => 4128, 'kecamatan' => 2028, 'jenis_kelamin' => 1, 'umur' => 2, 'layanan' => 1],
            ['indonesia_desc' => 9060, 'kecamatan' => 2009, 'jenis_kelamin' => 1, 'umur' => 3, 'layanan' => 1],
            ['indonesia_desc' => 4548, 'kecamatan' => 2029, 'jenis_kelamin' => 1, 'umur' => 4, 'layanan' => 1],
            ['indonesia_desc' => 4143, 'kecamatan' => 2031, 'jenis_kelamin' => 2, 'umur' => 4, 'layanan' => 1]
        ];

        // $k = 5;
        // $numAttributes = 5;

        // // Inisialisasi centroid awal secara acak
        // $centroid = [];
        // for ($i = 0; $i < $k; $i++) {
        //     $centroid[$i] = [];
        //     for ($j = 0; $j < $numAttributes; $j++) {
        //         $centroid[$i][$j] = rand(0, 500);
        //     }
        // }

        // Jumlah klaster
        $k = count($centroid);

        // Inisialisasi hasil klasterisasi
        $clusters = [];

        // Melakukan iterasi hingga konvergen
        $maxIterations = 100;
        $count = 0; // Variabel hitung iterasi
        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            // Mengosongkan klaster pada setiap iterasi
            $clusters = array_fill(0, $k, []);

            // Memasukkan setiap data ke klaster terdekat
            foreach ($data as $point) {
                $minDistance = PHP_INT_MAX;
                $closestCluster = 0;

                // Menghitung jarak ke setiap centroid
                for ($i = 0; $i < $k; $i++) {
                    $distance = sqrt(
                        pow($point['indonesia_desc'] - $centroid[$i]['indonesia_desc'], 2) +
                            pow($point['kecamatan'] - $centroid[$i]['kecamatan'], 2) +
                            pow($point['jenis_kelamin'] - $centroid[$i]['jenis_kelamin'], 2) +
                            pow($point['umur'] - $centroid[$i]['umur'], 2) +
                            pow($point['layanan'] - $centroid[$i]['layanan'], 2)
                    );

                    // Memperbarui centroid terdekat jika ditemukan jarak yang lebih kecil
                    if ($distance < $minDistance) {
                        $minDistance = $distance;
                        $closestCluster = $i;
                    }
                }

                // Memasukkan data ke klaster terdekat
                $clusters[$closestCluster][] = $point;
                $count++; // Menambah hitungan iterasi
            }

            // Memperbarui centroid
            $newCentroid = [];
            foreach ($clusters as $cluster) {
                $numPoints = count($cluster);
                $sumValues = array_fill(0, 5, 0);

                // Menjumlahkan nilai atribut untuk menghitung rata-rata
                foreach ($cluster as $point) {
                    $sumValues[0] += $point['indonesia_desc'];
                    $sumValues[1] += $point['kecamatan'];
                    $sumValues[2] += $point['jenis_kelamin'];
                    $sumValues[3] += $point['umur'];
                    $sumValues[4] += $point['layanan'];
                }

                // Menghitung rata-rata untuk mendapatkan centroid baru
                $newCentroid[] = [
                    'indonesia_desc' => $sumValues[0] / $numPoints,
                    'kecamatan' => $sumValues[1] / $numPoints,
                    'jenis_kelamin' => $sumValues[2] / $numPoints,
                    'umur' => $sumValues[3] / $numPoints,
                    'layanan' => $sumValues[4] / $numPoints,
                ];
            }

            // Memeriksa konvergensi
            $isConverged = true;
            for ($i = 0; $i < $k; $i++) {
                if ($centroid[$i] != $newCentroid[$i]) {
                    $isConverged = false;
                    break;
                }
            }

            // Menghentikan iterasi jika sudah konvergen
            if ($isConverged) {
                break;
            }


            // Memperbarui centroid dengan centroid baru
            $centroid = $newCentroid;
        }

        return view('cluster.clustering')
            ->with('count', $count)
            ->with('clusters', $clusters)
            ->with('centroids', $centroid);
    }

    public function getPenyakitCount()
    {
        $data = cluster::all();

        $penyakitCount = [];

        foreach ($data as $row) {
            $jenisKelamin = $row->jenis_kelamin;
            $kelompok_usia = $row->kelompok_usia;
            $layanan = $row->layanan;
            $indonesia_desc = $row->code_icdx;

            //dump($indonesia_desc);

            $key = $jenisKelamin . '_' . $kelompok_usia . '_' . $layanan;
            if (!isset($penyakitCount[$key])) {
                $penyakitCount[$key] = [];
            }

            $penyakit = $row->indonesia_desc;
            if (!isset($penyakitCount[$key][$penyakit])) {
                $penyakitCount[$key][$penyakit] = 0;
            }

            $penyakitCount[$key][$penyakit]++;
        }

        //dump($penyakitCount);
        arsort($penyakitCount);

        //dump($penyakitCount);

        return $penyakitCount;
    }

    public function getBanyakPenyakit()
    {
        $res_kelompok_usia = DB::select('select * from tbl_kelompok_usia');

        $res_pria = DB::select('SELECT 
        kategori_penyakit,
        jenis_kelamin,
        code_icdx,
        kelompok_usia,
        COUNT(*) AS jumlah_pasien
        FROM 
            tbl_cluster
        WHERE jenis_kelamin="laki-laki"
        GROUP BY 
            code_icdx, kategori_penyakit,kelompok_usia
        ORDER BY 
            COUNT(*) DESC
        LIMIT 10');

        $res_wanita = DB::select('SELECT 
        kategori_penyakit,
        jenis_kelamin,
        code_icdx,
        kelompok_usia,
        COUNT(*) AS jumlah_pasien
        FROM 
            tbl_cluster
        WHERE jenis_kelamin="perempuan"
        GROUP BY 
            code_icdx, kategori_penyakit,kelompok_usia
        ORDER BY 
            COUNT(*) DESC
        LIMIT 10');
        $title = 'Penyakit Terbanyak by Jenis Kelamin Pria';
        return view('cluster.banyak', compact('title', 'res_pria', 'res_wanita', 'res_kelompok_usia'));
    }
}
