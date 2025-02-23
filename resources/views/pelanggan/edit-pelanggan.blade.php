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
@slot('title') Edit Pelanggan @endslot
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
        <form action="{{ route('pelanggan.update',$find->id) }}" method="POST">
          @csrf
          <div class="mb-3 row">
            <div class="mb-3 row">
              <label for="example-text-input" class="col-md-2 col-form-label">Kode Pelanggan : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="kodecust" value="{{ $find->kodecust }}" id="example-text-input" placeholder="Kode Pelanggan" readonly>
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Nama Pelanggan : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="nama_pelanggan" value="{{ $find->nama_pelanggan }}" id="example-text-input" placeholder="Nama Pelanggan">
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">No Telpon : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="no_telp" value="{{ $find->no_telp }}" id="example-text-input" placeholder="No Telpon">
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Jenis Kelamin : </label>
              <div class="col-md-10">
                <select name="jenis_kelamin" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                  @foreach ($res_jenis_kelamin as $item)
                  @if ($find->jenis_kelamin == $item->id)
                  <option value="{{$item->id}}" selected>{{$item->jenis_kelamin}}</option>
                  @else
                  <option value="{{$item->id}}">{{$item->jenis_kelamin}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Alamat : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="alamat" value="{{ $find->alamat }}" id="example-text-input" placeholder="Alamat">
              </div>
              <br><br>
              <label for="example-text-input" class="col-md-2 col-form-label">Layanan : </label>
              <div class="col-md-10">
                <select name="layanan" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                  @foreach ($res_layanan as $item)
                  @if ($find->layanan == $item->id)
                  <option value="{{$item->id}}" selected>{{$item->nama_layanan}}</option>
                  @else
                  <option value="{{$item->id}}">{{$item->nama_layanan}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <label for="example-text-input" class="col-md-2 col-form-label">Tanggal Pemasangan :</label>
              <div class="col-md-10">
                  <div class="input-group date" id="datepicker1" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#datepicker1" name="tgl_psb" value="{{ $find->tgl_psb }}" />
                      <div class="input-group-append" data-target="#datepicker1" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="mdi mdi-calendar"></i></div>
                      </div>
                  </div>
              </div>

              <label for="example-text-input" class="col-md-2 col-form-label">Jumlah Device : </label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="jumlah_device" value="{{ $find->jumlah_device }}" id="example-text-input" placeholder="Jumlah Device">
              </div>
              <br><br>

              <label for="example-text-input" class="col-md-2 col-form-label">Status : </label>
              <div class="col-md-10">
                <select name="status" id="userSelectCategory" class="form-select" aria-label="Floating label select">
                  @foreach ($res_status as $item)
                  @if ($find->status == $item->id)
                  <option value="{{$item->id}}" selected>{{$item->status}}</option>
                  @else
                  <option value="{{$item->id}}">{{$item->status}}</option>
                  @endif
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Initialize Bootstrap Datepicker -->
<script>
    $(document).ready(function () {
        $('#datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>  
@endsection