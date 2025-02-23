@extends('layouts.master')
@section('title')
@lang('translation.Profile')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Kos @endslot
@slot('title') Detail Kos @endslot
@endcomponent

<div class="row mb-4">
    <div class="col-xl-4 mx-auto">
        <div class="card h-100">
            <div class="card-body">
                <div class="text-center">
                    <div class="clearfix"></div>
                    <div>
                        <i class="fas fa-network-wired fa-3x text-primary"></i>
                    </div>
                    <h5 class="mt-3 mb-1">{{ $find->nama_kos }}</h5>
                    <p class="text-muted">Rp.{{ $find->harga }}</p>


                </div>

                <hr class="my-4">

                <div class="text-muted">
                    <div class="table-responsive mt-4">
                        <p class="mb-1">Keterangan :</p>
                        <h5 class="font-size-16">
                            {{ $find->keterangan }}
                        </h5>
                    </div>


                </div>
                <div class="mt-3">
                    <a href="{{ route('kos.list') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<!-- end row -->
@endsection