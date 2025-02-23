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
@slot('title') Edit Kos @endslot
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
        <form action="{{ route('kos.update',$find->id) }}" method="POST">
          @csrf
          <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Kode Kos : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="nama_kos" value="{{ $find->nama_kos }}" id="example-text-input" placeholder="Kode Kos" readonly>
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Nama Kos : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="nama_kos" value="{{ $find->nama_kos }}" id="example-text-input" placeholder="Nama Kos">
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Harga : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="price" value="{{ $find->price }}" id="example-text-input" placeholder="Harga">
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Category : </label>
            <div class="col-md-10">
              <select name="id_category" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                @foreach ($res_category as $item)
                @if ($find->id_category == $item->id)
                <option value="{{$item->id}}" selected>{{$item->nama_category}}</option>
                @else
                <option value="{{$item->id}}">{{$item->nama_category}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Status : </label>
            <div class="col-md-10">
              <select name="status" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                @foreach ($res_status as $item)
                @if ($find->id_status == $item->id)
                <option value="{{$item->id}}" selected>{{$item->status}}</option>
                @else
                <option value="{{$item->id}}">{{$item->status}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Keterangan : </label>
            <div class="col-md-10">
              @if($data->image)
              <img src="{{asset('storage/kos/'. $data->kode_kos . '/' . $data->image)}}" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
              @endif
              <br>
              <input class="form-control" type="file" name="image" id="image" onchange="validateFileSize(this)">
              <small class="text-muted">Ukuran file maksimal: 2MB</small>
              <div id="fileSizeError" class="text-danger"></div>
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Keterangan : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="keterangan" value="{{ $find->keterangan }}" id="example-text-input" placeholder="Keterngan">
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