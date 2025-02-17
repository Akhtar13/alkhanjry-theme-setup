<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/branding/logo-dark-sm.jpg')}}" alt="" height="22">

                    </span>
            <span class="logo-lg">
                          <span
                              class="logo-lg text-white text-center fs-2"><b>{{trans('messages.sidebar_app_name')}}</b></span>
                    </span>
        </a>
        <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/branding/logo-light-sm.jpg')}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                          <span
                              class="logo-lg text-white text-center fs-2"><b>{{trans('messages.sidebar_app_name')}}</b></span>
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) === 'dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}" role="button">
                        <i class="ri-dashboard-2-line"></i> <span
                            data-key="t-dashboards">{{trans('messages.sidebar_dashboard')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) === 'event') ? 'active' : '' }}"
                       href="{{ route('admin.event.index') }}" role="button">
                        <i class="ri-dashboard-2-line"></i> <span
                            data-key="t-dashboards">{{trans('messages.sidebar_event')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
