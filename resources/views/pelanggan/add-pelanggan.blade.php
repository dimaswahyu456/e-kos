@extends('layouts.master')
@section('title')
@lang('translation.Datatables')
@endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Tables @endslot
@slot('title') Tambah Pelanggan @endslot
@endcomponent


@if ($errors->any())
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('pelanggan.add') }}" method="POST">
          @csrf
          <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Kode Pelanggan : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="kodecust" id="kodecust" value="{{ $kodecust }}" placeholder="Kode Pelanggan" readonly>
            </div>
            <br><br>

            <div class="mb-3 row">
              <label for="example-text-input" class="col-md-2 col-form-label">Nama Pelanggan : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" id="example-text-input" placeholder="Nama Pelanggan">
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">No Telpon : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="no_telp" value="{{ old('no_telp') }}" id="example-text-input" placeholder="No Telpon">
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Jenis Kelamin : </label>
              <div class="col-md-10">
                <select name="jenis_kelamin" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                  @foreach ($res_jenis_kelamin as $item)
                  <option value="{{$item->id}}">{{$item->jenis_kelamin}}</option>
                  @endforeach
                </select>
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Alamat : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="alamat" value="{{ old('alamat') }}" id="example-text-input" placeholder="Alamat">
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Tanggal Pemasangan : </label>
              <div class="col-md-10">
                <div class="input-group" id="datepicker1">
                  <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker1' data-provide="datepicker" name="tgl_psb">
                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Layanan : </label>
              <div class="col-md-10">
                <select name="layanan" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                  @foreach ($res_layanan as $item)
                  <option value="{{$item->id}}">{{$item->nama_layanan}}</option>
                  @endforeach
                </select>
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Jumlah Device : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="jumlah_device" value="{{ old('jumlah_device') }}" id="example-text-input" placeholder="Jumlah Device">
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Status : </label>
              <div class="col-md-10">
                <select name="status" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                  @foreach ($res_status as $item)
                  <option value="{{$item->id}}">{{$item->status}}</option>
                  @endforeach
                </select>
              </div>

            </div>
            <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('pelanggan.list') }}"> Back</a>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div> <!-- end col -->
</div>

@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endsection