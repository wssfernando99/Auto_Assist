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
                            <img src="{{ asset('assets/img/carlogo.png') }}" height="300" alt="">
                            <h1 class="display-3 text-DARK text-center fw-bold">AUTO ASSIST</h1>
                        </div>
                        
                        {{-- hero title --}}
                        <div class="d-flex justify-content-center align-items-center">
                        <h1 class="display-3 text-info text-center fw-bold" id="greetings"></h1>
                        <h1 class="display-3 text-dark text-center fw-bold"><span class="gradientText">&nbsp;&nbsp;&nbsp;{{ $name }}</span></h1>
                        </div>
                        <hr>
        
                    </div>

                    @if (session()->has('message'))
                    <div class="col-md-4">
                          <div class="alert alert-success alert-dismissible" role="alert">
                            <h6 class="alert-heading d-flex align-items-center mb-1">Completed:</h6>
                            <p class="mb-0">{{ session()->get('message') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                          </div>
                    </div>
                    @endif

                    @foreach ($errors->all() as $error)
                    <div class="col-md-4">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <h6 class="alert-heading d-flex align-items-center mb-1">Error!!</h6>
                            <p class="mb-0">{{ $error }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                          </div>
                    </div>
                    @endforeach
                    
                    <div class="container mt-md-4">

                        <div class="row">
            
        
            
                            <div class="col-md-6 col-xl-3 mt-4">
            
                                {{-- action card --}}
                                <div class="card py-4 px-4">
            
                                    <div class="cHead d-flex align-items-center gap-3 mb-2">
                                        {{-- card icon --}}
                                        {{-- <img src="{{ asset('assets/img/report.png') }}" class="img-fluid" width="45"
                                            alt=""> --}}
                                        {{-- card title --}}
                                        <h5 class="mt-3">Test</h5>
                                    </div>
            
                                    {{-- card info --}}
                                    <p class="pb-2 light-border-bottom">for testing ui</p>
                                    <br>
                                    {{-- link button --}}
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('/costingManagement') }}" class="btn btn-outline-dark btn-lg">Test</a>
                                    </div>
                                </div>
            
            
            
                            </div>
            
                            <div class="col-md-6 col-xl-3 mt-4">
            
                                {{-- action card --}}
                                <div class="card py-4 px-4">
            
                                    <div class="cHead d-flex align-items-center gap-3 mb-2">
                                        {{-- card icon --}}
                                        {{-- <img src="{{ asset('assets/img/report.png') }}" class="img-fluid" width="45"
                                            alt=""> --}}
                                        {{-- card title --}}
                                        <h5 class="mt-3">Test </h5>
                                    </div>
            
                                    {{-- card info --}}
                                    <p class="pb-2 light-border-bottom">for testing ui</p>
                                    <br>
                                    {{-- link button --}}
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-dark btn-lg"data-bs-toggle="modal" data-bs-target="#create-modal">
                                            Test
                                        </button>
                                    </div>
                                </div>
            
            
            
                            </div>

                            <div class="col-md-6 col-xl-3 mt-4">
            
                                {{-- action card --}}
                                <div class="card py-4 px-4">
            
                                    <div class="cHead d-flex align-items-center gap-3 mb-2">
                                        {{-- card icon --}}
                                        {{-- <img src="{{ asset('assets/img/report.png') }}" class="img-fluid" width="45"
                                            alt=""> --}}
                                        {{-- card title --}}
                                        <h5 class="mt-3">Test</h5>
                                    </div>
            
                                    {{-- card info --}}
                                    <p class="pb-2 light-border-bottom">for testing ui</p>
                                    <br>
                                    {{-- link button --}}
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('/costingManagement') }}" class="btn btn-outline-dark btn-lg">Test</a>
                                    </div>
                                </div>
            
            
            
                            </div>
                            <div class="col-md-6 col-xl-3 mt-4">
            
                                {{-- action card --}}
                                <div class="card py-4 px-4">
            
                                    <div class="cHead d-flex align-items-center gap-3 mb-2">
                                        {{-- card icon --}}
                                        {{-- <img src="{{ asset('assets/img/report.png') }}" class="img-fluid" width="45"
                                            alt=""> --}}
                                        {{-- card title --}}
                                        <h5 class="mt-3">Test</h5>
                                    </div>
            
                                    {{-- card info --}}
                                    <p class="pb-2 light-border-bottom">for testing ui</p>
                                    <br>
                                    {{-- link button --}}
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('/costingManagement') }}" class="btn btn-outline-dark btn-lg">Test</a>
                                    </div>
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
                <h1 class="display-3 text-DARK text-center fw-bold">AUTO ASSIST</h1>
            </div>
            
            {{-- hero title --}}
            <div class="d-flex justify-content-center align-items-center">
            
            <h1 class="display-3 text-dark text-center fw-bold"><span class="gradientText">&nbsp;&nbsp;&nbsp;Sorry No access</span></h1>
            </div>
            <hr>

        </div>

        @endif
    </div>


    <script>
        var myDate = new Date();
        var hrs = myDate.getHours();

        var greet;

        if (hrs < 12)
            greet = 'Good Morning' ;
        else if (hrs >= 12 && hrs <= 17)
            greet = 'Good Afternoon ' ;
        else if (hrs >= 17 && hrs <= 24)
            greet = 'Good Evening ';

        document.getElementById('greetings').innerHTML = greet;
    </script>

@endsection