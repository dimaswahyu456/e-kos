@extends('layouts.master')
@section('title')
@lang('translation.Datatables')
@endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Tables @endslot
@slot('title') List Pelanggan @endslot
@endcomponent

<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <a class="btn btn-success" href="{{ route('pelanggan.create') }}">
          <i class="fas fa-plus"></i> Tambah Pelanggan
        </a>

        <form method="POST" action="{{ route('pelanggan.send') }}">
          @csrf
          <button type="submit" class="btn btn-warning">
            <i class="fas fa-bell"></i> Pengingat Tagihan
          </button>
        </form>
        <form method="POST" action="{{ route('pelanggan.send.schedule') }}">
          @csrf
          <button type="submit" class="btn btn-info">
            <i class="fas fa-bell"></i> Pengingat Tagihan Schedule
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <div class="table-responsive">
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No.</th>
                <th>ID Pelanggan</th>
                <th>Nama</th>
                <th>No telpon</th>
                <th>Tgl Daftar</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($res_pelanggan as $item)
              <tr>
                <td>{{ $loop->index + 1}}</td>
                <td>{{ $item->kodecust}}</td>
                <td>{{ $item->nama_pelanggan}}</td>
                <td>{{ $item->no_telp}}</td>
                <td>{{ $item->tgl_masuk}}</td>
                <td>{{ $item->alamat}}</td>
                <td>{{ $item->status}}</td>
                <td>
                  <a class="btn btn-info" href="{{ route('pelanggan.show',$item->id) }}"><i class="uil uil-eye font-size-18"></i></a>
                  <a class="btn btn-primary" href="{{ route('pelanggan.edit',$item->id) }}"><i class="uil uil-pen font-size-18"></i></a>
                  <a class="btn btn-danger" href="{{ route('pelanggan.destroy',$item->id) }}"><i class="uil uil-trash-alt font-size-18"></i></a>
                  @csrf
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection