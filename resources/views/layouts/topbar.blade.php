<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/kotaklogo.png') }}" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logolight.png') }}" alt="" height="80">
                    </span>
                </a>
        
                <a href="{{url('/dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/kotaklogo.png') }}" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logodark.png') }}" alt="" height="80">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->

        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="uil-minus-path"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil uil-user-circle font-size-20"></i>
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ Str::ucfirst(Auth::user()->name) }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="/logout"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">@lang('translation.Sign_out')</span></a>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="uil-cog"></i>
                </button>
            </div>

        </div>
    </div>
</header>