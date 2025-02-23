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
@slot('title') Edit Payment @endslot
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
        <form action="{{ route('payment.update',$find->id) }}" method="POST">
          @csrf
          <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Kode Payment : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="kode_payment" value="{{ $find->kode_payment }}" id="example-text-input" placeholder="Kode Payment" readonly>
            </div>
            <br><br>
            <label for="example-text-input" class="col-md-2 col-form-label">Nama Payment : </label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="nama_payment" value="{{ $find->nama_payment }}" id="example-text-input" placeholder="Nama Payment">
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
            <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('payment.list') }}"> Back</a>
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
@endsection