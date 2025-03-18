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
@slot('title') List Transaksi @endslot
@endcomponent

<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-success" href="{{ route('transaksi.create') }}"><i class="fas fa-plus"></i> Tambah Transaksi</a>
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
                <th>Kode Transaksi</th>
                <th>Nama Kos</th>
                <th>Nama Pelanggan</th>
                <th>Total Amount</th>
                <th>Status Pembayaran</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($res_transaksi as $item)
              <tr>
                <td>{{ $loop->index + 1}}</td>
                <td>{{ $item->kode_transaksi}}</td>
                <td>{{ $item->nama_kos}}</td>
                <td>{{ $item->nama}}</td>
                <td>{{ $item->total_amount}}</td>
                <td>
                  @if($item->payment_status == 'Success')
                  <div class="badge bg-pill bg-soft-success font-size-13">{{ $item->payment_status}}
                  </div>
                  @else
                  <div class="badge bg-pill bg-soft-warning font-size-13">{{ $item->payment_status}}
                  </div>
                  </td>
                <td>
                  <a class="btn btn-danger" href="{{ route('payment.destroy',$item->id) }}"><i class="uil uil-trash-alt font-size-18"></i></a>
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