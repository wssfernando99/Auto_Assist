@php
    $id = session('id');
    $name = session('name');
    $role = session('role');
@endphp
@extends('layouts.adminLayout')

@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('layouts.userSideBar')

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

                    @foreach ($errors->all() as $error)
                    @if (!$errors->has('email') && !$errors->has('contact'))
                        <div class="col-md-4">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <h6 class="alert-heading d-flex align-items-center mb-1">Error!!</h6>
                                <p class="mb-0">{{ $error }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    @endif
                    @endforeach
                    <div class="d-flex justify-content-between  py-3 mb-4">
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>User Management</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                            Create User
                        </button>
                    </div>

                    <div class="card">
                        <h5 class="card-header">All Users in the System</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table ">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data as $user )
                                    <tr>
                                        <td>
                                            <strong>{{ $user->name }}</strong>
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->contact }}
                                        </td>
                                        <td>
                                            {{ $user->role }}
                                        </td>
                                        <td>@if($user->isActive == 1)<span class="badge bg-label-success me-1 text-success">Active</span>
                                            @else<span class="badge bg-label-danger me-1">Disabled</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <div class="dropdown z-50">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}" data-role="{{ $user->role }}" 
                                                        data-contact="{{ $user->contact }}" data-profileimage="{{ asset('userProfileImage/' . $user->profileImage) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    @if ($user->isActive == 1)
                                                    <a class="dropdown-item" href="edit_user"
                                                        data-bs-toggle="modal" data-bs-target="#deactive-modal{{ $user->id }}"><i
                                                            class='bx bx-info-circle'></i> Deactivate</a>
                                                    @else
                                                    <a class="dropdown-item" href="edit_user"
                                                        data-bs-toggle="modal" data-bs-target="#active-modal{{ $user->id }}"><i
                                                            class='bx bxs-check-circle'></i>activate</a>
                                                    @endif
                                                    
                                                    <a class="dropdown-item" href="edit_user"
                                                        data-bs-toggle="modal" data-bs-target="#password-modal{{ $user->id }}"><i
                                                            class='bx bx-reset'></i>Reset Password</a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal{{ $user->id }}"><i
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
        </div>
    </div>

    @include('admin.userManagement.modals.edit-Modal')
    @include('admin.userManagement.modals.createModal')
    
    @include('admin.userManagement.modals.deactive-Modal')
    @include('admin.userManagement.modals.active-Modal')

    @include('admin.userManagement.modals.delete-Modal')
    @include('admin.userManagement.modals.password-Modal')

    <script>
        $(document).ready(function () {
            $('#edit-modal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget); // Button that triggered the modal
                let id = button.data('id');
                let name = button.data('name');
                let email = button.data('email');
                let role = button.data('role');
                let contact = button.data('contact');
                let profileimage = button.data('profileimage')

                let modal = $(this);
                modal.find('#id').val(id);
                modal.find('#name').val(name);
                modal.find('#email').val(email);
                modal.find('#role').val(role);
                modal.find('#contact').val(contact);
                
                if (profileimage) {
                    modal.find('#profilePreview').attr('src', profileimage);
                } else {
                    modal.find('#profilePreview').attr('src', 'default-profile.jpg'); // Fallback image
                }
            });
        });

    </script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

   
        @if($errors->has('name') || $errors->has('email') || $errors->has('contact') || $errors->has('profileImage') || $errors->has('password') || $errors->has('role'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('create-modal'));
                modal.show();
            });
        
        </script>
        @endif
        
   
        @if($errors->has('ename') || $errors->has('eemail') || $errors->has('econtact') || $errors->has('eprofileImage') ||  $errors->has('erole'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                let modal = new bootstrap.Modal(document.getElementById('edit-modal'));
                 modal.show();
             }); 
        
            </script>
        @endif
        
   


    

   

    
@endsection