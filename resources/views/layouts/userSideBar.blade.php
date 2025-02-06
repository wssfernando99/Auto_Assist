<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo">
        <a href="{{ url('/adminDashboard') }}" class="app-brand-link">
            <img class="img-fluid" src="{{ URL::asset('/assets/img/carlogo.png') }}" alt=""
                style="padding: 20px;">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        {{--  Dashboard  --}}

        <li class="menu-item  {{ Request::is('adminDashboard') ? 'active' : '' }}">
            <a href="{{ url('/adminDashboard') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" >Back to Dashboard</div>
            </a>
        </li>
        @if ($role == 'Admin')
            
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">User Management</span>
        </li>


        <li class="menu-item {{ Request::is('userManagement') ? 'active' : '' }}">
            <!-- link -->
            <a href="{{ url('/userManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-iconsbi bi-people-fill"></i>
                <div data-i18n="Analytics">User Management</div>
            </a>
        </li>

        @endif
        
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Settings</span>
        </li>


        <li class="menu-item {{ Request::is('/userProfile') ? 'active' : '' }}">
            <!-- link -->
            <a href="{{ url('/userProfile') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bi bi-person-fill"></i>
                <div data-i18n="Analytics">Profile</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('') ? 'active' : '' }}">
            <!-- link -->
            <a href="{{ url('') }}" class="menu-link text-danger">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Analytics">Logout</div>
            </a>
        </li>


    
    </ul>
</aside>