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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Customer Management <i class="bi bi-arrow-right"></i> All Details</h4>
                        <a href="{{ url('/customerManagement') }}" class="btn btn-secondary" >
                            Back
                        </a>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"><h4>Customer Details</h4></div>
                                <table class="table table-bordered ">
                                    <tr>
                                        <th>Customer Id</th>
                                        <td>{{ $customer->customerId }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact</th>
                                        <td>{{ $customer->contact }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $customer->address }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"><h4>Vehicles</h4></div>
                                @foreach ($vehicles as $vehicle )

                                <div class="col-md-6 m-2">

                                    <table class="table table-bordered ">
                                        <tr>
                                            <th>Vehicle Id</th>
                                            <td>{{ $vehicle->vehicleId }}</td>
                                            <th>Vehicle Brand</th>
                                            <td>{{ $vehicle->vehicleBrand }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vehicle Type</th>
                                            <td>{{ $vehicle->vehicleType }}</td>
                                            <th>Vehicle Model</th>
                                            <td>{{ $vehicle->vehicleModel }}</td>
                                        </tr>
                                        <tr>
                                            <th>Engine Type</th>
                                            <td>{{ $vehicle->engineType }}</td>
                                            <th>Number Plate No.</th>
                                            <td>{{ $vehicle->numberPlate }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vehicle Year</th>
                                            <td>{{ $vehicle->vehicleYear }}</td>
                                            <th>Total Milage</th>
                                            <td>{{ $vehicle->milage }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="4">
                                                <button class="btn btn-outline-dark">Show More+ & Edit</button>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                                    
                                @endforeach

                        

                            </div>
                        </div>
                        
                    </div>
                </div>
                    
        
                
            </div>

            


            @include('admin.customerManagement.modals.createModal')
            @include('admin.customerManagement.modals.edit-modal')


            <script>
                $(document).ready(function () {
                    $('#edit-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let name = button.data('name');
                        let email = button.data('email');
                        let contact = button.data('contact');
                        let address = button.data('address');
        
                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#name').val(name);
                        modal.find('#email').val(email);
                        modal.find('#contact').val(contact);
                        modal.find('#address').val(address);
                    
                    });
                    
                });
        
            </script>

           


            @if($errors->has('name') || $errors->has('email') || $errors->has('contact') || $errors->has('address') || $errors->has('brand') || $errors->has('model') || 
            $errors->has('year') || $errors->has('type') || $errors->has('engine') || $errors->has('numberPlate') || $errors->has('milage') || $errors->has('perMilage'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('create-modal'));
                modal.show();
            });
        
            </script>
            @endif

            @if($errors->has('ename') || $errors->has('eemail') || $errors->has('econtact') ||  $errors->has('eaddress'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('edit-modal'));
                modal.show();
            });
        
            </script>
            @endif

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