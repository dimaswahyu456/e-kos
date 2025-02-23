@extends('layouts.master-without-nav')
@section('title')
@lang('translation.Login')
@endsection
@section('content')

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="{{ route('login') }}" class="mb-5 d-block auth-logo">
                        <span class="logo logo-dark">
                            <center><img src="{{ URL::asset('/assets/images/logolight.png') }}" alt="" height="100"></center>
                        </span>
                        <span class="logo logo-light">
                            <center><img src="{{ URL::asset('/assets/images/logolight.png') }}" alt="" height="85"></center>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            
                            <h5 class="text-primary">E-Tagihan Sadayana Net</h5>
                            <p class="text-muted"></p>
                        </div>
                        <div class="p-2 mt-4">
                            <form method="POST" action="auth">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Username">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" />
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log
                                        In</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p>© <script>
                            document.write(new Date().getFullYear())
                        </script> SobatWeb</p>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection