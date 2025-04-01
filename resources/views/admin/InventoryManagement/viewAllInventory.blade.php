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
                                        <th>Category</th>
                                        <th>Inventory Name</th>
                                        <th>Supplier</th>
                                        <th>status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    {{-- @if (count($data) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">No Data Available</td>
                                        </tr>
                                    @endif --}}
                                    @foreach ($data as $inventory )
                                    <tr>
                                        <td>
                                            {{ $inventory->inventoryId }}
                                        </td>
                                        <td>
                                            <strong>{{ $inventory->name }}</strong>
                                        </td>
                                        <td>
                                            {{ $inventory->contact }}
                                        </td>
                                        <td>
                                            {{ $inventory->position }}
                                        </td>
                                        <td>
                                            {{ $inventory->nic }}
                                        </td>
                                        
                                        <td >
                                            <div class="dropdown z-50">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    
                                                    {{-- <a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $employee->id }}" data-name="{{ $employee->name }}"
                                                        data-email="{{ $employee->email }}"  data-dob="{{ $employee->dob }}" 
                                                        data-contact="{{ $employee->contact }}" data-emimage="{{ asset('employeeImage/' . $employee->emImage) }}"
                                                        data-nic="{{ $employee->nic }}" data-address="{{ $employee->address }}" data-gender="{{ $employee->gender }}"
                                                        data-position="{{ $employee->position }}" data-salary="{{ $employee->salary }}" data-joiningdate="{{ $employee->joiningDate }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Edit</a>
                                                    
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal{{ $employee->id }}"><i
                                                            class="bx bx-trash me-1"></i> Delete</a> --}}
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

            


            {{-- @include('admin.employeeManagement.modals.edit-modal')
            @include('admin.employeeManagement.modals.delete-modal')
            @include('admin.employeeManagement.modals.createModal') --}}


            <script>
                $(document).ready(function () {
                    $('#edit-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let name = button.data('name');
                        let email = button.data('email');
                        let position = button.data('position');
                        let contact = button.data('contact');
                        let emimage = button.data('emimage')
                        let dob = button.data('dob');
                        let nic = button.data('nic');
                        let address = button.data('address');
                        let gender = button.data('gender');
                        let salary = button.data('salary');
                        let joiningdate = button.data('joiningdate');
        
                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#name').val(name);
                        modal.find('#email').val(email);
                        modal.find('#position').val(position);
                        modal.find('#contact').val(contact);
                        modal.find('#dob').val(dob);
                        modal.find('#nic').val(nic);
                        modal.find('#address').val(address);
                        modal.find('#gender').val(gender);
                        modal.find('#salary').val(salary);
                        modal.find('#joiningDate').val(joiningdate);
                        modal.find('#employeeImage').attr('src', emimage);
                    
                    
                    });
                    
                });
        
            </script>

           


            @if($errors->has('name') || $errors->has('email') || $errors->has('contact') || $errors->has('emImage') || $errors->has('nic') || $errors->has('gender') || 
            $errors->has('position') || $errors->has('address') || $errors->has('dob') || $errors->has('salary') || $errors->has('joiningDate'))
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('create-modal'));
                modal.show();
            });
        
            </script>
            @endif

            @if($errors->has('ename') || $errors->has('eemail') || $errors->has('econtact') || $errors->has('eemImage') || $errors->has('enic') || $errors->has('egender') || 
            $errors->has('eposition') || $errors->has('eaddress') || $errors->has('edob') || $errors->has('esalary') || $errors->has('ejoiningDate'))
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