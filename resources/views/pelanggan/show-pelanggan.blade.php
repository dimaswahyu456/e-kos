@extends('layouts.master')
@section('title')
@lang('translation.Profile')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Pelanggan @endslot
@slot('title') Detail Pelanggan @endslot
@endcomponent

<div class="row mb-4">
  <div class="col-xl-4 mx-auto">
    <div class="card h-100">
      <div class="card-body">
        <div class="text-center">
          <div class="clearfix"></div>
          <div>
            <i class="fas fa-user-circle fa-5x text-primary"></i>
          </div>
          <h5 class="mt-3 mb-1">{{ $find->nama_pelanggan }}</h5>
          <p class="text-muted">{{ $find->kodecust }}</p>
        </div>
        <hr class="my-4">

        <div class="text-muted">
          <div class="table-responsive mt-4">
            <div class="mt-4">
              <p class="mb-1">Status :</p>
              <h5 class="font-size-16">
                {{ $find->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
              </h5>
            </div>
            <p class="mb-1">Gender :</p>
            <h5 class="font-size-16">
              {{ $find->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}
            </h5>
          </div>
          <div class="mt-1">
            <p class="mb-1">Layanan :</p>
            @foreach ($res_layanan as $item)
            @if ($find->layanan == $item->id)
            <h5 class="font-size-16">{{ $item->nama_layanan }}</h5>
            @else
            <h5 class="font-size-16"></h5>
            @endif
            @endforeach
          </div>
          <div class="mt-1">
            <p class="mb-1">Tagihan :</p>
            <h5 class="font-size-16">{{ $find->total_tagihan }}</h5>
          </div>
          <div class="mt-1">
            <p class="mb-1">Jumlah Device yang di Sewa :</p>
            <h5 class="font-size-16">{{ $find->jumlah_device }}</h5>
          </div>
          <div class="mt-1">
            <p class="mb-1">No Telefon :</p>
            <h5 class="font-size-16">{{ $find->no_telp }}</h5>
          </div>
          <div class="mt-1">
            <p class="mb-1">Alamat :</p>
            <h5 class="font-size-16">{{ $find->alamat }}</h5>
          </div>
          <div class="mt-1">
            <p class="mb-1">Tanggal Pemasangan :</p>
            <h5 class="font-size-16">{{ \Carbon\Carbon::parse($find->tgl_psb)->format('l, j F Y') }}</h5>
          </div>
        </div>
        <div class="mt-3">
          <a href="{{ route('pelanggan.list') }}" class="btn btn-secondary">Back</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



<!-- end row -->
@endsection