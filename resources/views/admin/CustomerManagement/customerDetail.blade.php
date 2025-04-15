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

                                <div class="col-md-6">

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
                                            <td>{{ $vehicle->milage }} </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4">
                                                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editVehicle-modal"
                                                    data-id="{{ $vehicle->id }}" data-vehicleid="{{ $vehicle->vehicleId }}" data-brand="{{ $vehicle->vehicleBrand }}"
                                                    data-type="{{ $vehicle->vehicleType }}" data-model="{{ $vehicle->vehicleModel }}" data-engine="{{ $vehicle->engineType }}"
                                                    data-plate="{{ $vehicle->numberPlate }}" data-year="{{ $vehicle->vehicleYear }}" data-milage="{{ $vehicle->milage }}"
                                                    data-per="{{ $vehicle->milagePer }}" data-check="{{ $vehicle->check }}" data-vin="{{ $vehicle->vin }}">
                                                <i class="bx bx-edit-alt me-1"></i>Edit</button>

                                                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#maintenance-modal"  data-vehicleid="{{ $vehicle->vehicleId }}"
                                                    data-milage="{{ $vehicle->totalMilage }}" data-lservice="{{ $vehicle->lastService }}" data-lbrake="{{ $vehicle->lastBrake }}" data-loil="{{ $vehicle->lastOil }}"
                                                    data-lengine="{{ $vehicle->lastEngine }}">
                                                <i class="bi bi-capslock-fill me-1"></i>Update Maintenance</button>

                                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteVehicle-modal"  data-vehicleid="{{ $vehicle->vehicleId }}">
                                                <i class="bx bx-trash me-1"></i>Delete</button>
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




            @include('admin.customerManagement.modals.editVehicle-modal')
            @include('admin.customerManagement.modals.maintenance-modal')
            @include('admin.customerManagement.modals.deleteVehicle-modal')


            <script>
                $(document).ready(function () {
                    $('#deleteVehicle-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget);
                        let vehicleId = button.data('vehicleid');

                        let modal = $(this);
                        modal.find('#vehicleId').val(vehicleId);

                    });

                });

            </script>

            <script>
                $(document).ready(function () {
                    $('#editVehicle-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let vehicleId = button.data('vehicleid');
                        let brand = button.data('brand');
                        let type = button.data('type');
                        let model = button.data('model');
                        let engine = button.data('engine');
                        let plate = button.data('plate');
                        let year = button.data('year');
                        let milage = button.data('milage');
                        let milagePer = button.data('per');
                        let check = button.data('check');
                        let vin = button.data('vin');


                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#vehicleId').val(vehicleId);
                        modal.find('#brand').val(brand);
                        modal.find('#type').val(type);
                        modal.find('#modelName').val(model);
                        modal.find('#engine').val(engine);
                        modal.find('#numberPlate').val(plate);
                        modal.find('#year').val(year);
                        modal.find('#milage').val(milage);
                        modal.find('#perMilage').val(milagePer);
                        modal.find('#check').prop('checked', check == 1);
                        modal.find('#vin').val(vin);


                    });

                });

            </script>


            <script>
                $(document).ready(function () {
                    $('#maintenance-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget);
                        let vehicleId = button.data('vehicleid');
                        let milage = button.data('milage');
                        let lService = button.data('lservice');
                        let lBrake = button.data('lbrake');
                        let lOil = button.data('loil');
                        let lEngine = button.data('lengine');

                        let modal = $(this);
                        modal.find('#vehicleId').val(vehicleId);
                        modal.find('#milage').val(milage);
                        modal.find('#lService').val(lService);
                        modal.find('#lBrake').val(lBrake);
                        modal.find('#lOil').val(lOil);
                        modal.find('#lEngine').val(lEngine);


                    });

                });

            </script>



            @if($errors->has('abrand') || $errors->has('amodel') ||
            $errors->has('ayear') || $errors->has('atype') || $errors->has('aengine') || $errors->has('anumberPlate') || $errors->has('amilage') || $errors->has('aperMilage'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('editVehicle-modal'));
                modal.show();
            });

            </script>
            @endif

            @if($errors->has('milage') || $errors->has('lEngine') || $errors->has('lService') || $errors->has('lOil') || $errors->has('lBrake'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('maintenance-modal'));
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
