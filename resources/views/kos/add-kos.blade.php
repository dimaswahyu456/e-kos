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
@slot('title') Add Kos @endslot
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
        <form action="{{ route('kos.add') }}" method="POST">
          @csrf
          <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Kode Kos : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="kodekos" id="kodekos" value="{{ $kodekos }}" placeholder="Kode Pelanggan" readonly>
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Nama Kos : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="nama_kos" value="{{ old('nama_kos') }}" id="example-text-input" placeholder="Nama Kos">
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Harga : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="price" value="{{ old('price') }}" id="example-text-input" placeholder="Harga">
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Alamat : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="alamat" value="{{ old('alamat') }}" id="example-text-input" placeholder="Alamat">
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Category : </label>
            <div class="col-md-10">
              <select name="id_category" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                @foreach ($res_category as $item)
                <option value="{{$item->id}}">{{$item->nama_category}}</option>
                @endforeach
              </select>
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
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Image : </label>
            <div class="col-md-10">
              <input class="form-control" type="file" name="image" id="image" accept="image/*" onchange="validateFileSize(this)">
              <small class="text-muted">Ukuran gambar maksimal: 2MB</small>
              <div id="fileSizeError" class="text-danger"></div>
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Keterangan : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="keterangan" value="{{ old('keterangan') }}" id="example-text-input" placeholder="Keterangan">
            </div>
          </div>
          <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kos.list') }}"> Back</a>
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
<script>
  function validateFileSize(input) {
    const maxSize = 2 * 1024 * 1024; // 2MB in bytes
    const fileSize = input.files[0].size;

    if (fileSize > maxSize) {
      document.getElementById('fileSizeError').innerHTML = 'Ukuran file melebihi batas (2MB). Pilih file lain.';
      input.value = ''; // Reset input file
    } else {
      document.getElementById('fileSizeError').innerHTML = '';
    }
  }
</script>
@endsection