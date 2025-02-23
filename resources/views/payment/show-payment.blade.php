@extends('layouts.master')
@section('title')
@lang('translation.Profile')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Payment @endslot
@slot('title') Detail Payment @endslot
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
                    <h5 class="mt-3 mb-1">{{ $find->nama_payment }}</h5>
                </div>
                <div class="mt-3">
                    <a href="{{ route('payment.list') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<!-- end row -->
@endsection