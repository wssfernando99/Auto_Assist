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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Salary Management</h4>
                        <a href="{{ url('/viewAllSalary') }}" class="btn btn-primary" >
                        view all history
                        </a>
                    </div>

                    <div class="card">
                        <h5 class="card-header">All Salaries for {{ date('m') }} - {{ date('Y') }}</h5>
                        <div class="table-responsive text-nowrap overflow-visible">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
                                        <th>Month</th>
                                        <th>Basic Salary</th>
                                        <th>Totam amount</th>
                                        <th>Deductions</th>
                                        <th>Leaves</th>
                                        <th>Bounus</th>
                                        <th>status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data as $salary )
                                    <tr>
                                        <td>
                                            {{ $salary->employeeId }}
                                        </td>
                                        <td>
                                            {{ $salary->name }}
                                        </td>
                                        <td>
                                            <strong>{{ $salary->month }}</strong>
                                        </td>
                                        <td>
                                            {{ number_format($salary->salary,2)}}
                                        </td>
                                        <td>
                                            {{ number_format($salary->total,2) }}
                                        </td>
                                        <td>
                                            {{ number_format($salary->deduction,2) }}
                                        </td>
                                        <td>
                                            {{ $salary->leave }}
                                        </td>
                                        <td>
                                            {{ number_format($salary->bonus,2) }}
                                        </td>
                                        <td>
                                            @if ($salary->status == 0)
                                            <span class="badge bg-label-primary me-1">Pending</span>
                                            @elseif ($salary->status == 1)
                                            <span class="badge bg-label-success me-1">Paid</span>
                                            @endif
                                        </td>

                                        <td >
                                            <div class="dropdown z-50">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $salary->id }}" data-bonus="{{ $salary->bonus }}"
                                                        data-deduction="{{ $salary->deduction }}"  data-leave="{{ $salary->leave }}" ><i
                                                            class="bx bx-edit-alt me-1"></i>Update</a>
                                                    @if ($salary->status == 0)
                                                    <a class="dropdown-item text-success" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#paid-modal{{ $salary->id }}"><i
                                                    class="bx bx-check"></i> mark as paid</a>
                                                    @else
                                                    <a class="dropdown-item text-warning" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#unpaid-modal{{ $salary->id }}"><i
                                                    class="bx bx-x"></i> mark as unpaid</a>
                                                    @endif

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




            @include('admin.salaryManagement.modals.edit-modal')
            @include('admin.salaryManagement.modals.paid-modal')
            @include('admin.salaryManagement.modals.unpaid-modal')


            <script>
                $(document).ready(function () {
                    $('#edit-modal').on('show.bs.modal', function (event) {
                        let button = $(event.relatedTarget); // Button that triggered the modal
                        let id = button.data('id');
                        let bonus = button.data('bonus');
                        let deduction = button.data('deduction');
                        let leave = button.data('leave');


                        let modal = $(this);
                        modal.find('#id').val(id);
                        modal.find('#bonus').val(bonus);
                        modal.find('#deduction').val(deduction);
                        modal.find('#leave').val(leave);


                    });

                });

            </script>




            @if($errors->has('bonus') || $errors->has('deduction') || $errors->has('leave') )
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
