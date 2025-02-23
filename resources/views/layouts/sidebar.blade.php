<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{url('/dashboard')}}" class="logo logo-dark">
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

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    {{-- <a href="{{url('index')}}"> --}}
                    <a href="{{url('/dashboard')}}">
                        <i class="uil-home-alt"></i>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-database"></i>
                        <span>@lang('Master')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href={{ route('pelanggan.list') }}>@lang('Data Pelanggan')</a></li>
                        <li><a href={{ route('kos.list') }}>@lang('Data Kos')</a></li>
                        <li><a href={{ route('category.list') }}>@lang('Data Category')</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-money-bill"></i>
                        <span>@lang('Keuangan')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href={{ route('payment.list') }}>@lang('Data Payment')</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users-cog"></i>
                        <span>@lang('Users')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href={{ route('user.list') }}>@lang('Data User')</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->