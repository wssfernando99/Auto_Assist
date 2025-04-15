@php
    $id = session('id');
    $name = session('name');
    $role = session('role');
    $profileImage = session('profileImage');

    $subTotal = 0;

    if (!empty($items)) {
        foreach ($items as $key => $item) {
        $subTotal += $item['total'];
    }
    }


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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Vehicle Management<i class="bi bi-arrow-right"></i> With Invoice<i class="bi bi-arrow-right"></i>Print View</h4>


                        <div>
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" onclick="printInvoice()"  class="btn btn-dark">Print Invoice</button>
                            <button type="button" onclick="printService()" class="btn btn-dark">Print Service Log</button>
                        </div>
                        <a href="{{ url('/pastRecords/'.$service->vehicleId) }}" class="btn btn-secondary" >
                            Back
                        </a>
                        </div>


                    </div>

                    <div class="card">
                        <h5 class="card-header">Log</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" id="invoicePrintArea">
                                        <div class="card-body">
                                        <div class="invoice-header">
                                            <h2>INVOICE</h2>
                                        </div>
                                        <div class="invoice-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5><strong>Auto Assist</strong></h5>
                                                    <p><strong>Invoice Number: </strong> {{ $invoice->invoiceId }}</p>
                                                    <p><strong>Date of Issue: </strong>{{ $invoice->invoiceDate }}</p>
                                                    <p><strong>Vehicle No: </strong> {{ $invoice->numberPlate }}</p>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5 class="bg-primary text-white p-2">Invoice To:</h5>
                                                    <p>{{ $invoice->name }}</p>
                                                </div>
                                            </div>
                                            <table class="table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($invoiceItems))
                                                            @foreach($invoiceItems as $item)

                                                                    <tr>
                                                                        <td>{{ $item->description }}</td>
                                                                        <td>{{ $item->quantity }}</td>
                                                                        <td>{{ number_format($item->price, 2) }}</td>
                                                                        <td>{{ number_format($item->discount, 2) }}</td>
                                                                        <td>{{ number_format($item->total, 2) }}</td>

                                                                    </tr>

                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="5" class="text-center">No items in the invoice.</td>
                                                            </tr>
                                                        @endif


                                                </tbody>
                                            </table>
                                            <div class="row mt-3">
                                                <div class="col-md-6 company-details">
                                                    <h6>Checked By:</h6>
                                                    <p>check</p>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <p><strong>Subtotal:</strong> Rs. {{ number_format($invoice->subTotal,2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>



                                </div>


                                <div class="col-md-12">
                                    <div class="card mt-3" >
                                        <div class="card-body" id="servicePrintArea">
                                    @include('admin.VehicleManagement.extra.printForm')

                                        </div>
                                    </div>
                                </div>


                            </div>



                        </div>
                    </div>
                </div>



            </div>






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



    <script>
        function printInvoice() {
            var printContent = document.getElementById("invoicePrintArea").innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // Refresh page to restore functionality
        }

        function printService() {
            var printContent = document.getElementById("servicePrintArea").innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // Refresh page to restore functionality
        }
    </script>


    @endsection
