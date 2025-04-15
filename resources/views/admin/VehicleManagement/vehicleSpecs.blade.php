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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Vehicle Management<i class="bi bi-arrow-right"></i>Specs</h4>
                        <a href="{{ url('/vehicleManagement') }}" class="btn btn-secondary" >
                            Back
                        </a>
                    </div>

                    <div class="card">
                        <h5 class="card-header">Vehicle Specifications for <b>{{ $vehicle['vehicleBrand'] }} {{ $vehicle['vehicleModel'] }} {{ $vehicle['vehicleYear'] }}</b></h5>
                        <div class="table-responsive text-nowrap overflow-visible p-3">
                            @if(isset($response['specs']) && is_array($response['specs']) && count($response['specs']) > 0)
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Specification</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($response['specs'] as $key => $value)
                                            <tr>
                                                <td>{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                                <td>{{ $value === '*** (hidden)' ? 'Hidden (Upgrade to view)' : $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">Sorry! No specification data available.</p>
                            @endif
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
