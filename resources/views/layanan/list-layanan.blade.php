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
@slot('title') List Layanan @endslot
@endcomponent

<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-success" href="{{ route('layanan.create') }}"><i class="fas fa-plus"></i>  Tambah Layanan</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($res_layanan as $item)
              <tr>
                <td>{{ $loop->index + 1}}</td>
                <td>{{ $item->nama_layanan}}</td>
                <td>{{ $item->harga}}</td>
                <td>{{ $item->keterangan}}</td>
                <td>
                  <a class="btn btn-info" href="{{ route('layanan.show',$item->id) }}"><i class="uil uil-eye font-size-18"></i></a>
                  <a class="btn btn-primary" href="{{ route('layanan.edit',$item->id) }}"><i class="uil uil-pen font-size-18"></i></a>
                  <a class="btn btn-danger" href="{{ route('layanan.destroy',$item->id) }}"><i class="uil uil-trash-alt font-size-18"></i></a>
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