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

                    <div class="d-flex justify-content-between  py-3 mb-1">
                        <div>
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Inventory Management <i class="bi bi-arrow-right"></i> Suppliers</h4>
                        </div>
                        <div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a  href="{{ url('/inventoryManagement') }}" class="btn btn-outline-dark" >
                                    All Inventories
                                </a>
                                <a href="{{ url('/allCategories') }}" class="btn btn-outline-dark">Categories</a>
                                <a href="{{ url('/allSuppliers') }}" class="btn btn-dark">Suppliers</a>
                                <a href="{{ url('/allTransactions') }}" class="btn btn-outline-dark">All Transactions</a>
                              </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                            Add New Supplier
                        </button>

                    </div>

                    <div class="card">
                        <h5 class="card-header">All Suppliers</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Cmpany Name</th>
                                        <th>Contact Person</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    {{-- @if (count($data) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">No Data Available</td>
                                        </tr>
                                    @endif --}}
                                    @foreach ($data as $index => $supplier )
                                    <tr>
                                        <td>
                                            {{ $index + 1 }}
                                        </td>
                                        <td>
                                            <strong>{{ $supplier->name }}</strong>
                                        </td>
                                        <td>
                                            {{ $supplier->contact_person }}
                                        </td>
                                        <td>
                                            {{ $supplier->email }}
                                        </td>
                                        <td>
                                            {{ $supplier->phone }}
                                        </td>

                                        <td >
                                            <div class="dropdown z-50">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $supplier->id }}" data-name="{{ $supplier->name }}"
                                                        data-email="{{ $supplier->email }}"  data-phone="{{ $supplier->phone }}" data-contactperson="{{ $supplier->contact_person }}"
                                                        data-address="{{ $supplier->address }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Edit</a>

                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal{{ $supplier->id }}"><i
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





            @include('admin.InventoryManagement.Suppliers.modals.create-modal')
            @include('admin.InventoryManagement.Suppliers.modals.edit-modal')
            @include('admin.InventoryManagement.Suppliers.modals.delete-modal')


            <script>
                $(document).ready(function () {
                    $('#edit-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let name = button.data('name');
                        let email = button.data('email');
                        let contactperson = button.data('contactperson');
                        let address = button.data('address');
                        let phone = button.data('phone');

                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#ename').val(name);
                        modal.find('#eemail').val(email);
                        modal.find('#econtact_person').val(contactperson);
                        modal.find('#eaddress').val(address);
                        modal.find('#ephone').val(phone);

                    });

                });

            </script>




            @if($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('contact_person') || $errors->has('address'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('create-modal'));
                modal.show();
            });

            </script>
            @endif

            @if($errors->has('ename') || $errors->has('eemail') || $errors->has('ephone') || $errors->has('econtact_person') || $errors->has('eaddress'))
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
