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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Inventory Management</h4>
                        </div>
                        <div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a  href="{{ url('/inventoryManagement') }}" class="btn btn-dark" >
                                    All Inventories
                                </a>
                                <a href="{{ url('/allCategories') }}" class="btn btn-outline-dark">Categories</a>
                                <a href="{{ url('/allSuppliers') }}" class="btn btn-outline-dark">Suppliers</a>
                                <a href="{{ url('/allTransactions') }}" class="btn btn-outline-dark">All Transactions</a>

                              </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-4">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                            Add New Inventory
                        </button>

                    </div>

                    <div class="card">
                        <h5 class="card-header">All Inventories</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Inventory Name</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Price per Quantity</th>
                                        <th>Storable Quantity</th>
                                        <th>Available Quantity</th>
                                        <th>Reorder Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    {{-- @if (count($data) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">No Data Available</td>
                                        </tr>
                                    @endif --}}
                                    @foreach ($data as $index => $inventory)
                                    <tr>
                                        <td>
                                            {{ $index + 1 }}
                                        </td>
                                        <td>
                                            <strong>{{ $inventory->name }}</strong>
                                        </td>
                                        <td>
                                            {{ $inventory->category }}
                                        </td>
                                        <td>
                                            {{ $inventory->supplierName }}
                                        </td>
                                        <td>
                                            {{ $inventory->price }}
                                        </td>
                                        <td>
                                            {{ $inventory->sku }}
                                        </td>
                                        <td>
                                            {{ $inventory->quantity }}
                                        </td>
                                        <td>
                                            {{ $inventory->reorder_level }}
                                        </td>

                                        <td >
                                            <div class="dropdown z-50">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $inventory->id }}" data-name="{{ $inventory->name }}"
                                                        data-category="{{ $inventory->inventory_category_id }}"  data-description="{{ $inventory->description }}"
                                                        data-sku="{{ $inventory->sku }}" data-supplier="{{ $inventory->supplier_id }}"
                                                        data-price="{{ $inventory->price }}" data-quantity="{{ $inventory->quantity }}" ><i
                                                            class="bx bx-edit-alt me-1"></i>Edit</a>

                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal{{ $inventory->id }}"><i
                                                            class="bx bx-trash me-1"></i> Delete</a>
                                                    <a class="dropdown-item text-dark" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#transaction-modal{{ $inventory->id }}"><i class='bx bx-transfer-alt'></i> Make a transaction</a>


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




            @include('admin.InventoryManagement.modals.create-modal')
            @include('admin.InventoryManagement.modals.edit-modal')
            @include('admin.InventoryManagement.modals.delete-modal')
            @include('admin.InventoryManagement.modals.transaction-modal')

            <script>
                $(document).ready(function () {
                    $('#edit-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let name = button.data('name');
                        let category = button.data('category')
                        let description = button.data('description')
                        let sku = button.data('sku')
                        let supplier = button.data('supplier')
                        let price = button.data('price')
                        let quantity = button.data('quantity')


                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#name').val(name);
                        modal.find('#category').val(category);
                        modal.find('#description').val(description);
                        modal.find('#sku').val(sku);
                        modal.find('#supplier').val(supplier);
                        modal.find('#price').val(price);
                        modal.find('#quantity').val(quantity);

                    });

                });

            </script>




            @if($errors->has('name') || $errors->has('category') || $errors->has('supplier') || $errors->has('quantity') || $errors->has('price') || $errors->has('sku'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('create-modal'));
                modal.show();
            });

            </script>
            @endif

            @if($errors->has('ename') || $errors->has('ecategory') || $errors->has('esupplier') || $errors->has('equantity') || $errors->has('eprice') || $errors->has('esku'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('edit-modal'));
                modal.show();
            });

            </script>
            @endif

            @if($errors->has('tquantity') || $errors->has('ttransaction') || $errors->has('tnote'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let modalEl = document.querySelector('.transaction-modal');
                    if (modalEl) {
                        let modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
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
