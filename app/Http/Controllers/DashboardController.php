<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\pelanggan;
use Carbon\Carbon;
use App\Models\layanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pelanggan = pelanggan::all();
        // $layanan = layanan::all();
        $user = User::all();

        $jmlh_pelanggan = $pelanggan->count();
        // $jmlh_layanan = $layanan->count();

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Query to get the count for the current year
        $pertahun_pelanggan = Pelanggan::whereYear('tgl_masuk', $currentYear)->count();

        // Get the current month
        $sekarang = now();

        // Query to get the count for the current month
        $pelangganBulanIni = Pelanggan::whereYear('tgl_masuk', $sekarang->year)
            ->whereMonth('tgl_masuk', $sekarang->month)
            ->count();



        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;

        $currentYearData = [];
        $previousYearData = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, '0', STR_PAD_LEFT);

            // Get data for the current year
            $currentYearData[] = Pelanggan::whereYear('tgl_masuk', $currentYear)
                ->whereMonth('tgl_masuk', $month)
                ->count();

            // Get data for the previous year
            $previousYearData[] = Pelanggan::whereYear('tgl_masuk', $previousYear)
                ->whereMonth('tgl_masuk', $month)
                ->count();
        }

        // dd(   $previousYearData);

        return view('dashboard', compact('currentYear', 'previousYear', 'jmlh_pelanggan', 'pertahun_pelanggan', 'pelangganBulanIni', 'currentYearData', 'previousYearData'));
    }
}
