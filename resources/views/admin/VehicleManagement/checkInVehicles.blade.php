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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Vehicle Management<i class="bi bi-arrow-right"></i> Checked In Vehicles</h4>
                        <a href="{{ url('/vehicleManagement') }}" class="btn btn-secondary" >
                            Back
                        </a>
                    </div>

                    <div class="card">
                        <h5 class="card-header">All Checked In Vehicles</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Vehicle Id</th>
                                        <th>Vehicle Number Plate</th>
                                        <th>Vehicle Brand</th>
                                        <th>Vehicle Model</th>
                                        <th>Manfactured Year</th>
                                        <th>Vehicle Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if (count($data) == 0)
                                        <tr>
                                            <td colspan="7" class="text-center">No Data Available</td>
                                        </tr>
                                    @endif
                                    @foreach ($data as $vehicle )
                                    <tr>
                                        <td>
                                            {{ $vehicle->vehicleId }}
                                        </td>
                                        <td>
                                            {{ $vehicle->numberPlate }}
                                        </td>
                                        
                                        <td>
                                            {{ $vehicle->vehicleBrand }}
                                        </td>
                                        <td>
                                            {{ $vehicle->vehicleModel }}
                                        </td>
                                        <td>
                                            {{ $vehicle->vehicleYear }}
                                        </td>
                                        <td>
                                            {{ $vehicle->vehicleType }}
                                        </td>
                                        
                                        <td>
                                            <div class="dropdown z-50">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item text-success" href="{{ url('/getcheckOutVehicle/' . $vehicle->vehicleId) }}">
                                                            <i class="bi bi-clipboard-check-fill me-1"></i>Check Out</a>

                                                    <a class="dropdown-item text-warning" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#cancelCheck-modal" data-id="{{ $vehicle->id }}" data-vehicleid="{{ $vehicle->vehicleId }}">
                                                            <i class="bi bi-clipboard-x-fill me-1"></i>Cancel Check In</a>
                                                    
                                                    
       
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

            


            @include('admin.vehicleManagement.modals.cancelCheck-modal')

            
            

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

            <script>
                $(document).ready(function () {
                    $('#add-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let customerId = button.data('customerid');

                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#customer').val(customerId);
                        modal.find('#customeri').text(customerId);
                    
                    });
                    
                });

            </script>

            <script>
                $(document).ready(function () {
                    $('#cancelCheck-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let vehicleId = button.data('vehicleid');

                        let modal = $(this);
                        modal.find('#vehicleId').val(vehicleId);
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

            @if($errors->has('abrand') || $errors->has('amodel') || 
            $errors->has('ayear') || $errors->has('atype') || $errors->has('aengine') || $errors->has('anumberPlate') || $errors->has('amilage') || $errors->has('aperMilage'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('add-modal'));
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