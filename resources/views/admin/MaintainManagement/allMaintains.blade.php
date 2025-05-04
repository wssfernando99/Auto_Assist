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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Maintenance Alerts Management</h4>

                        <a href="{{ url('/prediction') }}" class="btn btn-outline-primary d-flex align-items-center" >
                            Predict Maintenances
                        </a>
                    </div>

                    <div class="card">
                        <h5 class="card-header">Today Alerts</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Vehicle ID</th>
                                        <th>Customer Name</th>
                                        <th>Vehicle Number</th>
                                        <th>Note</th>
                                        <th>Predicted Date</th>
                                        <th>Send</th>
                                        <th>Sent Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>




            @include('admin.MaintainManagement.modals.notify-modal')




            <script>
                $(document).ready(function () {
                    $('#notify-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let number = button.data('number');
                        let email = button.data('email');
                        let name = button.data('name');

                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#number').text(number);
                        modal.find('#email').text(email);
                        modal.find('#name').text(name);

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

<script>
    let table;

    $(document).ready(function () {
        table = $('#myTable').DataTable();

        fetchMaintains(); // Initial load
        setInterval(fetchMaintains, 2000); // Reload every 2 seconds
    });

    function fetchMaintains() {
        $.ajax({
            url: '/maintains/latest',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let rows = data.map(maintain => {
                    // Create buttons for each row
                    let sendButton = `<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#notify-modal"
                                        data-id="${maintain.id}" data-name="${maintain.name}" data-number="${maintain.contact}" data-email='${maintain.email}'>Send Message</button>`;
                    let ignoreButton = `<button class="btn btn-secondary btn-sm" onclick="ignoreAction(${maintain.id})">Ignore</button>`;

                    return [
                        maintain.vehicleId,
                        maintain.name,
                        maintain.numberPlate,
                        maintain.Note,
                        maintain.predictedDate,
                        maintain.send == null ? 'not send' : 'sent',
                        maintain.sentCount,
                        `${sendButton} ${ignoreButton}` // Add buttons to last column
                    ];
                });

                table.clear().rows.add(rows).draw();
            },
            error: function () {
                alert('Failed to fetch data.');
            }
        });
    }

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
