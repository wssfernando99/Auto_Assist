<aside id="layout-menu" class="layout-menu menu-vertical menu  ">
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
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Employee Management</span>
        </li>


        <li class="menu-item {{ Request::is('employeeManagement') ? 'active' : '' }}">
            <!-- link -->
            <a href="{{ url('/employeeManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bi bi-person-lines-fill"></i>
                <div data-i18n="Analytics">Employee Details</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('salaryManagement') ? 'active' : '' }}">
            <!-- link -->
            <a href="#" class="menu-link text-dark">
                <i class="menu-icon tf-icons bi bi-currency-dollar"></i>
                <div data-i18n="Analytics">Salary Manage</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Customer Management</span>
        </li>


        <li class="menu-item {{ Request::is('customerManagement') ? 'active' : '' }}">
            <!-- link -->
            <a href="{{ url('/customerManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bi bi-person-lines-fill"></i>
                <div data-i18n="Analytics">Customer Details</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('vehicleManagement') ? 'active' : '' }}">
            <a href="{{ url('/vehicleManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bi bi-car-front-fill"></i>
                <div data-i18n="Analytics">Vehicle Details</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Inventory Management</span>
        </li>


        <li class="menu-item {{ Request::is('materialManagement') ? 'active' : '' }}">
            <a href="{{ url('/materialManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bi bi-box-seam"></i>
                <div data-i18n="Analytics">Inventory Manage</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Maintenance Predict</span>
        </li>


        <li class="menu-item {{ Request::is('materialManagement') ? 'active' : '' }}">
            <a href="{{ url('/materialManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bi bi-exclamation-triangle-fill "></i> 

                <div data-i18n="Analytics">Maintenance Alerts</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('materialManagement') ? 'active' : '' }}">
            <a href="{{ url('/materialManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-iconsbi bi-tools"></i> 

                <div data-i18n="Analytics">Service Roud Alerts</div>
            </a>
        </li>

    
    
    </ul>
</aside>

