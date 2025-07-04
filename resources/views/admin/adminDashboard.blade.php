@php
    $id = session('id');
    $name = session('name');
    $role = session('role');
    $profileImage = session('profileImage');
@endphp
@extends('layouts.adminLayout')

@section('content')
    <div class="layout-wrapper layout-content-navbar">
        @if (!empty($id))
            <div class="layout-container">
                @include('layouts.sideBar')
                <div class="layout-page">
                    @include('layouts.header')
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="container">
                            {{-- LOGO --}}
                            <div class="d-flex justify-content-center align-items-center">
                                {{-- <img src="{{ asset('assets/img/carlogo.png') }}" height="300" alt=""> --}}
                                <h1 class="display-3 text-dark text-center fw-bold">WELCOME TO AUTO ASSIST</h1>
                            </div>

                            {{-- hero title --}}
                            <div class="d-flex justify-content-center align-items-center">
                                <h1 class="display-3 text-dark text-center fw-bold" id="greetings"></h1>
                                <h1 class="display-3 text-primary text-center fw-bold"><span class="gradientText">   {{ $name }}</span></h1>
                            </div>
                        </div>
                        <hr>
                        @if (session()->has('message'))
                            <div class="col-md-4">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <h6 class="alert-heading d-flex align-items-center mb-1">Completed:</h6>
                                    <p class="mb-0">{{ session()->get('message') }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        @foreach ($errors->all() as $error)
                            <div class="col-md-4">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <h6 class="alert-heading d-flex align-items-center mb-1">Error!!</h6>
                                    <p class="mb-0">{{ $error }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endforeach

                        <div class="container mt-md-4">
                            {{-- Quick Access Count Cards --}}
                            <h4 class="mb-4">Quick Stats</h4>
                            <div class="row">
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">In Process Vehicles</h5>
                                            <span class="badge bg-primary ms-auto">{{ $vehicleCheckCount }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Total Checked In vehicles Today</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/checkInVehicles') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Active Customers</h5>
                                            <span class="badge bg-primary ms-auto">{{ $customerCount }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Total active customers</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/customerManagement') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Active Employees</h5>
                                            <span class="badge bg-primary ms-auto">{{ $employeeCount }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Total active employees</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/employeeManagement') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Unpaid Salaries</h5>
                                            <span class="badge bg-danger ms-auto">{{ $unpaid }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Salaries pending payment</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/salaryManagement') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Paid Salaries</h5>
                                            <span class="badge bg-success ms-auto">{{ $paid }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Salaries paid this month</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/salaryManagement') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Total Paid Amount</h5>
                                            <span class="badge bg-success ms-auto">Rs. {{ number_format($paidAmount, 2) }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Total paid this month</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/salaryManagement') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Total Unpaid</h5>
                                            <span class="badge bg-danger ms-auto">Rs. {{ number_format($unpaidAmount, 2) }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Total unpaid this month</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/salaryManagement') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Income</h5>
                                            <span class="badge bg-success ms-auto">Rs. {{ number_format($totalincome, 2) }}</span>
                                        </div>
                                        <p class="pb-2 light-border-bottom">Total Income</p>
                                        <div class="d-flex gap-2">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Charts Section --}}
                            <h4 class="mt-5 mb-4">Dashboard Analytics</h4>
                            <div class="row">
                                {{-- Chart 1: Counts Bar Chart --}}
                                <div class="col-md-6 col-xl-4 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Counts Overview</h5>
                                        </div>
                                        <canvas id="countsChart" height="200"></canvas>
                                    </div>
                                </div>

                                {{-- Chart 2: Salary Status Pie Chart --}}
                                <div class="col-md-6 col-xl-4 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Salary Status this month</h5>
                                        </div>
                                        <canvas id="salaryStatusChart" height="200"></canvas>
                                    </div>
                                </div>

                                {{-- Chart 3: Salary Amounts Bar Chart --}}
                                <div class="col-md-6 col-xl-4 mt-4">
                                    <div class="card py-4 px-4">
                                        <div class="cHead d-flex align-items-center gap-3 mb-2">
                                            <h5 class="mt-3">Salary Amounts this month</h5>
                                        </div>
                                        <canvas id="salaryAmountsChart" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                {{-- LOGO --}}
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/carlogo.png') }}" height="300" alt="">
                    <h1 class="display-3 text-dark text-center fw-bold">AUTO ASSIST</h1>
                </div>

                {{-- hero title --}}
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="display-3 text-dark text-center fw-bold"><span class="gradientText">   Sorry No access</span></h1>
                </div>
                <hr>
            </div>
        @endif
    </div>

    {{-- Include Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Greeting Script
        var myDate = new Date();
        var hrs = myDate.getHours();
        var greet;
        if (hrs < 12)
            greet = 'Good Morning';
        else if (hrs >= 12 && hrs <= 17)
            greet = 'Good Afternoon';
        else if (hrs >= 17 && hrs <= 24)
            greet = 'Good Evening';
        document.getElementById('greetings').innerHTML = greet;

        // Chart 1: Counts Bar Chart
        const countsCtx = document.getElementById('countsChart').getContext('2d');
        new Chart(countsCtx, {
            type: 'bar',
            data: {
                labels: ['Vehicles', 'Customers', 'Employees'],
                datasets: [{
                    label: 'Count',
                    data: [{{ $vehicleCount }}, {{ $customerCount }}, {{ $employeeCount }}],
                    backgroundColor: ['#4CAF50', '#2196F3', '#FFC107'],
                    borderColor: ['#388E3C', '#1976D2', '#FFA000'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Count' }
                    },
                    x: {
                        title: { display: true, text: 'Category' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Chart 2: Salary Status Pie Chart
        const salaryStatusCtx = document.getElementById('salaryStatusChart').getContext('2d');
        new Chart(salaryStatusCtx, {
            type: 'pie',
            data: {
                labels: ['Paid', 'Unpaid'],
                datasets: [{
                    data: [{{ $paid }}, {{ $unpaid }}],
                    backgroundColor: ['#66BB6A', '#EF5350'],
                    borderColor: ['#388E3C', '#D32F2F'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Chart 3: Salary Amounts Bar Chart
        const salaryAmountsCtx = document.getElementById('salaryAmountsChart').getContext('2d');
        new Chart(salaryAmountsCtx, {
            type: 'bar',
            data: {
                labels: ['Paid Amount', 'Unpaid Amount'],
                datasets: [{
                    label: 'Amount (Rs.)',
                    data: [{{ $paidAmount }}, {{ $unpaidAmount }}],
                    backgroundColor: ['#66BB6A', '#EF5350'],
                    borderColor: ['#388E3C', '#D32F2F'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Amount (Rs.)' }
                    },
                    x: {
                        title: { display: true, text: 'Category' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
@endsection
