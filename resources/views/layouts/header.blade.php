<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div >


    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <div class="d-flex flex-column ">
                <!-- user name -->
                <span
                    class="fw-semibold d-block">{{ $name }}</span>
                <!-- user role -->
                <small
                    class="text-muted margin-top--5">{{ $role }}</small>
            </div>


            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar ">
                        <!-- user image -->
                        <img src="{{ asset('userProfileImage/' . $profileImage) }}" alt="user image"
                            class="w-px-40 h-px-40 rounded-circle" />

                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <!-- user image -->
                                        <img src="{{ asset('userProfileImage/' . $profileImage) }}"  class="w-px-40 h-px-40 rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <!-- user name -->
                                    <span
                                        class="fw-semibold d-block">{{ $name }}</span>
                                    <!-- user role -->
                                    <small
                                        class="text-muted">{{ $role }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/userProfile') }}">
                            <i class="bx bx-user me-2"></i>
                            <!-- my profile -->
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    {{-- @if($role == 'Admin' || $role == 'Admin (View Only)') --}}
                    <li>
                        <a class="dropdown-item" href="{{ url('/adminDashboard') }}">
                            <i class="bx bx-home me-2"></i>
                            <!-- my profile -->
                            <span class="align-middle">Main Dashboard</span>
                        </a>
                    </li>
                    {{-- @endif --}}
                    @if($role == 'Admin')
                    <li>
                        <a class="dropdown-item" href="{{ url('/userManagement') }}">
                            <i class="bx bx-user-plus me-2"></i>
                            <!-- my profile -->
                            <span class="align-middle">User Management</span>
                        </a>
                    </li>
                    @endif

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="{{ url('logout') }}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>

            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
