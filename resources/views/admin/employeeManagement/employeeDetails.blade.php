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

            @if($role == 'Admin')

            @include('layouts.sideBar')

            <div class="layout-page">

                @include('layouts.header')

                

                    {{--  content  --}}

                <div class="container-xxl flex-grow-1 container-p-y">
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

                    @if (session()->has('error'))
                    
                        <div class="col-md-4">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <h6 class="alert-heading d-flex align-items-center mb-1">Error!!</h6>
                                <p class="mb-0">{{ session()->get('error') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    
                    @endif

                    <div class="d-flex justify-content-between  py-3 mb-4">
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>User Management</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                            Create User
                        </button>
                    </div>

                    <div class="card">
                        <h5 class="card-header">All Users in the System</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Employee Id</th>
                                        <th>Employee Image</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>position</th>
                                        <th>NIC</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if (count($data) == 0)
                                        <tr>
                                            <td colspan="6" class="text-center">No Data Available</td>
                                        </tr>
                                    @endif
                                    @foreach ($data as $employee )
                                    <tr>
                                        <td>
                                            {{ $employee->employeeId }}
                                        </td>
                                        <td>
                                            {{ $employee->emImage }}
                                        </td>
                                        <td>
                                            <strong>{{ $employee->name }}</strong>
                                        </td>
                                        <td>
                                            {{ $employee->contact }}
                                        </td>
                                        <td>
                                            {{ $employee->position }}
                                        </td>
                                        <td>
                                            {{ $employee->nic }}
                                        </td>
                                        
                                        <td class="d-flex justify-content-center">
                                            <div class="dropdown z-50">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $employee->id }}" data-name="{{ $employee->name }}"
                                                        data-email="{{ $employee->email }}" data-role="{{ $employee->role }}" 
                                                        data-contact="{{ $employee->contact }}" data-profileimage="{{ asset('userProfileImage/' . $employee->profileImage) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal{{ $employee->id }}"><i
                                                            class="bx bx-trash me-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
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