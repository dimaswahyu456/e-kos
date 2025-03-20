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
@slot('title') Add Transaksi @endslot
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
      <form id="payment-form">
          @csrf
          <input type="hidden" id="snap_token" name="snap_token">
          
          <div class="mb-3 row">
              <label class="col-md-2 col-form-label">Kode Transaksi :</label>
              <div class="col-md-10">
                  <input class="form-control" type="text" name="code_transaksi" id="code_transaksi" value="{{ $code_transaksi }}" readonly>
              </div>
              <br><br>
              
              <label class="col-md-2 col-form-label">Kos :</label>
              <div class="col-md-10">
                  <select name="id_kos" id="id_kos" class="form-select">
                      @foreach ($res_kos as $item)
                      <option value="{{ $item->id }}">{{ $item->nama_kos }}</option>
                      @endforeach
                  </select>
              </div>
              <br><br>

              <label class="col-md-2 col-form-label">Nama :</label>
              <div class="col-md-10">
                  <input class="form-control" type="text" name="nama" id="nama" required>
              </div>
              <br><br>

              <label class="col-md-2 col-form-label">Email :</label>
              <div class="col-md-10">
                  <input class="form-control" type="email" name="email" id="email" required>
              </div>
              <br><br>

              <label class="col-md-2 col-form-label">No Telpon :</label>
              <div class="col-md-10">
                  <input class="form-control" type="text" name="no_telp" id="no_telp" required>
              </div>
              <br><br>

              <label class="col-md-2 col-form-label">Total Amount :</label>
              <div class="col-md-10">
                  <input class="form-control" type="number" name="total_amount" id="total_amount" required>
              </div>
              <br><br>

              <label class="col-md-2 col-form-label">Tanggal Transaksi :</label>
              <div class="col-md-10">
                  <input class="form-control" type="date" name="transaction_date" id="transaction_date" required>
              </div>
          </div>

          <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('transaksi.list') }}">Back</a>
              <button type="button" id="pay-button" class="btn btn-success">Bayar Sekarang</button>
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
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function(event) {
        event.preventDefault();

        let formData = {
            _token: "{{ csrf_token() }}",
            code_transaksi: document.getElementById('code_transaksi').value,
            nama: document.getElementById('nama').value,
            email: document.getElementById('email').value,
            no_telp: document.getElementById('no_telp').value,
            total_amount: document.getElementById('total_amount').value,
            id_kos: document.getElementById('id_kos').value,
            transaction_date: document.getElementById('transaction_date').value
        };

        fetch("{{ route('transaksi.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        alert("Pembayaran berhasil!");
                        window.location.href = "{{ route('transaksi.list') }}";
                    },
                    onPending: function(result) {
                        alert("Menunggu pembayaran...");
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal!");
                    }
                });
            } else {
                alert("Terjadi kesalahan saat membuat transaksi.");
            }
        })
        .catch(error => console.error("Error:", error));
    };
</script>
@endsection