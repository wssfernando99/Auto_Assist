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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Vehicle Management</h4>

                        <a href="{{ url('/checkInVehicles') }}" class="btn btn-outline-primary d-flex align-items-center" >
                            <i class="bi bi-card-checklist me-2 display-5"></i>
                            All Checked in Vehicles
                        </a>
                    </div>

                    <div class="card">
                        <h5 class="card-header">All Vehicles</h5>
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

                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                    data-bs-toggle="modal" data-bs-target="#editVehicle-modal"
                                                    data-id="{{ $vehicle->id }}" data-vehicleid="{{ $vehicle->vehicleId }}" data-brand="{{ $vehicle->vehicleBrand }}"
                                                    data-type="{{ $vehicle->vehicleType }}" data-model="{{ $vehicle->vehicleModel }}" data-engine="{{ $vehicle->engineType }}"
                                                    data-plate="{{ $vehicle->numberPlate }}" data-year="{{ $vehicle->vehicleYear }}" data-milage="{{ $vehicle->milage }}"
                                                    data-per="{{ $vehicle->milagePer }}" data-check="{{ $vehicle->check }} " data-vin="{{ $vehicle->vin }}"
                                                        ><i
                                                            class="bx bx-edit-alt me-1"></i>Edit & view</a>

                                                    <a class="dropdown-item" href="{{ url('/pastRecords/'.$vehicle->vehicleId) }}">
                                                            <i class="bi bi-clipboard2-data me-1"></i>Past Records</a>
                                                    @if ($vehicle->checkIn == 0)
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#check-modal" data-id="{{ $vehicle->id }}" data-vehicleid="{{ $vehicle->vehicleId }}">
                                                    <i class="bi bi-clipboard2-plus me-1"></i>Check In</a>
                                                    @else
                                                    <a class="dropdown-item" href="#"
                                                            >
                                                            <i class="bi bi-exclamation-lg"></i>Already Check In</a>

                                                    @endif
                                                    @if ($vehicle->vin == null)
                                                    <a class="dropdown-item" href="#"
                                                        ><i
                                                            class="bx bx-trash me-1"></i> Specs feature unavailable</a>

                                                    @else
                                                    <a class="dropdown-item" href="{{ url('/vehicleDetails/'.$vehicle->id) }}"
                                                        ><i class='bx bxs-report'></i> Specs</a>

                                                    @endif



                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#deleteVehicle-modal" data-vehicleId="{{ $vehicle->vehicleId }}"
                                                        data-name="{{ $vehicle->name }}"><i
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




            @include('admin.vehicleManagement.modals.check-modal')
            @include('admin.customerManagement.modals.editVehicle-modal')
            @include('admin.customerManagement.modals.maintenance-modal')
            @include('admin.customerManagement.modals.deleteVehicle-modal')




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
                    $('#check-modal').on('show.bs.modal', function (event) {
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
