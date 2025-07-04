@php
    $id = session('id');
    $name = session('name');
    $role = session('role');
    $profileImage = session('profileImage');
@endphp
@extends('layouts.adminLayout')

@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @if($role == 'Admin' || $role == 'Service Admin')

            @include('layouts.sideBar')

            <div class="layout-page">

                @include('layouts.header')



                    {{--  content  --}}

                <div class="container-xxl flex-grow-1 container-p-y">
                    @if (session()->has('message'))
                    <div class="col-md-4 msg">
                          <div class="alert alert-success alert-dismissible" role="alert">
                            <h6 class="alert-heading d-flex align-items-center mb-1">Completed:</h6>
                            <p class="mb-0">{{ session()->get('message') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                          </div>
                    </div>
                    @endif

                    @if (session()->has('error'))

                        <div class="col-md-4 msg">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <h6 class="alert-heading d-flex align-items-center mb-1">Error!!</h6>
                                <p class="mb-0">{{ session()->get('error') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>

                    @endif

                    <div class="d-flex justify-content-between  py-3 mb-4">
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Prediction History</h4>

                            <a href="{{ url('/maintainManagement') }}"  class="btn btn-success me-2 d-flex align-items-center" >
                                Back
                            </a>



                    </div>

                    <div class="card">
                        <h5 class="card-header">All Predictions</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Vehicle ID</th>
                                        <th>Customer Name</th>
                                        <th>Vehicle Number</th>
                                        <th>Note</th>
                                        <th>Predicted Date</th>
                                        <th>Status</th>
                                        <th>Sent Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($predictions as $prediction)
                                    <tr>
                                        <td>{{ $prediction->vehicleId }}</td>
                                        <td>{{ $prediction->name }}</td>
                                        <td>{{ $prediction->numberPlate }}</td>
                                        <td>{{ $prediction->Note }}</td>
                                        <td>{{ $prediction->predictedDate }}</td>
                                        <td>@if ($prediction->send == 1)
                                            <span class="badge bg-label-success me-1">Sent</span>
                                            @elseif ($prediction->send == 3)
                                            <span class="badge bg-label-danger me-1">Ignored</span>
                                            @else
                                            <span class="badge bg-label-warning me-1">Not Sent</span>
                                            @endif
                                        </td>
                                        <td>{{ $prediction->sentCount }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>




            @else
            <div class="container mt-4">
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Access Denied!</strong> You do not have permission to view this page.
                </div>
                <div class="text-center mb-5">
                    <a href="{{ url('/adminDashboard') }}" class="btn btn-secondary">back to Dashoard</a>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('fixedImages/access_denied.jpg') }}" alt="user-avatar" class="d-block rounded" height="400" id="uploadedAvatar" />
                </div>
            </div>

            @endif
        </div>
    </div>

    @endsection
