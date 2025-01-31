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

        <li class="menu-item  {{ Request::is('/adminDashboard') ? 'active' : '' }}">
            <a href="{{ url('/adminDashboard') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" >Back to Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Sheet</span>
        </li>


        <li class="menu-item {{ Request::is('sheetManagement') ? 'active' : '' }}">
            <!-- link -->
            <a href="{{ url('/sheetManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bx bx-dumbbell"></i>
                <div data-i18n="Analytics">Sheet Management</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Product</span>
        </li>


        <li class="menu-item {{ Request::is('productManagement') ? 'active' : '' }}">
            <!-- link -->
            <a href="{{ url('/productManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bx bx-dumbbell"></i>
                <div data-i18n="Analytics">Product Management</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Inventory</span>
        </li>


        <li class="menu-item {{ Request::is('materialManagement') ? 'active' : '' }}">
            <a href="{{ url('/materialManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bx bx-dumbbell"></i>
                <div data-i18n="Analytics">Material</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('machineManagement') ? 'active' : '' }}">
            <a href="{{ url('/machineManagement') }}" class="menu-link text-dark">
                <i class="menu-icon tf-icons bx bxs-washer"></i>
                <div data-i18n="Analytics">Machine</div>
            </a>
        </li>

        

        <li class="menu-item {{ Request::is('capacityManagement') ? 'active' : '' }}">
            <a href="{{ url('/capacityManagement') }}" class="menu-link text-dark">
                <i class='menu-icon bx bxs-coffee-togo'></i>
                <div data-i18n="Analytics">Capacity </div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('productTypeManagement') ? 'active' : '' }}">

            <a href="{{ url('/productTypeManagement') }}" class="menu-link text-dark">
                <i class='menu-icon bx bx-package'></i>
                <div data-i18n="Analytics">Product Type  </div>
            </a>
        </li>


    
    </ul>
</aside>

