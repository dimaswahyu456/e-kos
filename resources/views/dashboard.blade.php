<!-- start page title -->
@extends('layouts.master')
@section('title')
@lang('translation.Datatables')
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('path/to/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('js/dashboard-charts.js') }}"></script>
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/chart-js/Chart.min.css') }}" rel="stylesheet" type="text/css" />

@section('content')

<div class="row">

    <div class="col-12">
        <div class="page-title-box">
            <h2 class="mb-0">Dashboard</h2>

            <h4 class="mb-0">
                <?php
                date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu sesuai dengan lokasi Anda
                $currentTime = date('H:i'); // Ambil jam saat ini

                // Tentukan ucapan berdasarkan jam
                if ($currentTime >= '05:00' && $currentTime < '10:00') {
                    $greeting = '🌞 Selamat Pagi'; // Emoji tangan menyapa di sini
                } elseif ($currentTime >= '10:01' && $currentTime < '14:59') {
                    $greeting = '☀️ Selamat Siang'; // Emoji tangan menyapa di sini
                } elseif ($currentTime >= '15:00' && $currentTime < '17:30') {
                    $greeting = '🌅 Selamat Sore'; // Emoji tangan menyapa di sini
                } else {
                    $greeting = '🌙 Selamat Malam'; // Emoji tangan menyapa di sini
                }

                // Akses nama pengguna melalui auth()
                $userName = auth()->user()->name ?? "Guest"; // Jika tidak ada pengguna terautentikasi, gunakan "Guest"

                echo $greeting . ', ' . $userName;
                ?>
            </h4>
            <p class="mb-0">
                <?php echo date('l, j F Y'); ?>
            </p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <i class="fas fa-address-card text-blue" style="font-size: 40px;"></i>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$jmlh_pelanggan}}</span></h4>
                    <p class="text-muted mb-0">Jumlah Pelanggan</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <i class="fas fa-address-card text-blue" style="font-size: 40px;"></i>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$pertahun_pelanggan}}</span></h4>
                    <p class="text-muted mb-0">Pelanggan Tahun {{ $currentYear }} </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <i class="fas fa-address-card text-blue" style="font-size: 40px;"></i>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$pelangganBulanIni}}</span></h4>
                    <p class="text-muted mb-0">Pelanggan Bulan ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <button id="switchYear" class="btn btn-primary mb-2">Switch Year</button>
                    <canvas id="grafik-rekap-pelanggan"></canvas>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var currentYear = {
                    {
                        $currentYear
                    }
                };
                var previousYear = {
                    {
                        $previousYear
                    }
                };
                var currentYearData = @json($currentYearData);
                var previousYearData = @json($previousYearData);
                var data = currentYearData;
                var isCurrentYear = true;

                var chart = new Chart(document.getElementById('grafik-rekap-pelanggan').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: getMonthNames(isCurrentYear),
                        datasets: [{
                            label: isCurrentYear ? 'Total Pelanggan ' + currentYear : 'Total Pelanggan ' + previousYear,
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Switch between current and previous year
                document.getElementById('switchYear').addEventListener('click', function() {
                    isCurrentYear = !isCurrentYear;
                    data = isCurrentYear ? currentYearData : previousYearData;

                    chart.data.labels = getMonthNames(isCurrentYear);
                    chart.data.datasets[0].data = data;
                    chart.data.datasets[0].label = isCurrentYear ? 'Total Pelanggan ' + currentYear : 'Total Pelanggan ' + previousYear;

                    chart.update();
                });

                function getMonthNames(isCurrentYear) {
                    var year = isCurrentYear ? currentYear : previousYear;
                    var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    return monthNames.map(function(month) {
                        return month + ' ' + year;
                    });
                }
            });
        </script>


        <div class="col-xl-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-sm-8">
                            <p class="text-white font-size-18">Ingin Menuju ke Data Pelanggan Langsung ?</p>
                            <div class="mt-4">
                                <a href={{ route('pelanggan.list') }} class="btn btn-success waves-effect waves-light">Klik Disini !</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mt-4 mt-sm-0">
                                <img src="assets/images/setup-analytics-amico.svg" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end card-->

    </div>



    @endsection
    @section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/apexcharts.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/dashboard-charts.js') }}"></script>


    @endsection