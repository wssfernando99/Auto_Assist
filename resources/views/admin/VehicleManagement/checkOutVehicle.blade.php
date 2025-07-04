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
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>Vehicle Management<i class="bi bi-arrow-right"></i> Checked In Vehicles <i class="bi bi-arrow-right"></i> Checked Out</h4>

                        <a href="{{ url('/checkInVehicles') }}" class="btn btn-secondary" >
                            Back
                        </a>
                        <button onclick="printInvoice()" class="btn btn-primary">Print Invoice</button>

                    </div>

                    <div class="card">
                        <h5 class="card-header">Log</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body" >
                                            <form  action="{{url('/itemInvoice')}}" method="post" novalidate enctype="multipart/form-data">
                                                {{csrf_field()}}

                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="basic-default-fullname">Description<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description" id="name"  value="{{ old('description') }}" />
                                                            @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="basic-default-company">Quantity<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"  placeholder="XX"   id="contact" name="quantity"  value="{{ old('quantity') }}" />
                                                            @error('quantity')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="basic-default-email">Price<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="john.doe@loopcare.com" name="price" id="email" value="{{ old('price') }}" />
                                                            @error('price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="basic-default-address">Discount(%)<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('discount') is-invalid @enderror" placeholder="address" name="discount" id="address"  value="{{ old('discount') }}" />
                                                            @error('discount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                <div class="d-flex justify-content-end">

                                                    <button class="btn btn-secondary" type="submit">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card" id="invoicePrintArea">
                                        <div class="card-body">
                                        <div class="invoice-header">
                                            <h2>INVOICE</h2>
                                        </div>
                                        <div class="invoice-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5><strong>Auto Assist</strong></h5>
                                                    <p><strong>Invoice Number: </strong> {{ $invoiceId }}</p>
                                                    <p><strong>Date of Issue: </strong>{{ $date }}</p>
                                                    <p><strong>Vehicle No: </strong> {{ $vehicle->numberPlate }}</p>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5 class="bg-primary text-white p-2">Invoice To:</h5>
                                                    <p>{{ $customer->name }}</p>
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
                                                    @if(!empty($items) && is_array($items))
                                                            @foreach($items as $item)
                                                                @if(is_array($item) && isset($item['description'], $item['quantity'], $item['price'], $item['discount']))
                                                                    <tr>
                                                                        <td>{{ $item['description'] }}</td>
                                                                        <td>{{ $item['quantity'] }}</td>
                                                                        <td>{{ number_format($item['price'], 2) }}</td>
                                                                        <td>{{ number_format($item['discount'], 2) }}</td>
                                                                        <td>{{ number_format($item['total'], 2) }}</td>
                                                                        <td><a href="{{ url('/removeItem/'.$item['id']) }}">
                                                                            <i class="bi bi-file-excel text-danger"></i>
                                                                            </a>
                                                                        </td>

                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td colspan="5" class="text-danger">Invalid data format</td>
                                                                    </tr>
                                                                @endif
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
                                                    <p>{{ $userName }}</p>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <p><strong>Subtotal:</strong> Rs. {{ number_format($subTotal,2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>



                                </div>
                                <form  action="{{url('/completeCheckOut')}}" method="post" novalidate enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card mt-3">
                                        <div class="card-body">

                                                <div class="modal-body">

                                                    <input type="text" name="vehicleId" id="vehicleId" value="{{ $vehicle->vehicleId }}" hidden>
                                                    <input type="text" name="invoiceDate" id="invoiceDate" value="{{ $date }}" hidden>
                                                    <input type="text" name="customerId" id="customerId" value="{{ $customer->customerId }}" hidden>
                                                    <input type="text" name="subTotal" id="subTotal" value="{{ $subTotal }}" hidden>

                                                    <div class="row">
                                                        <div class="col-md-12 mb-3"><h4>Update Vehicle Maintenance Records</h4></div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="basic-default-fullname">Update Total Milage<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('milage') is-invalid @enderror" placeholder="" name="milage" id="milage"  value="{{ old('milage', $vehicle->milage) }}" />
                                                            @error('milage')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="basic-default-company">Update last Service Milage<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('lservice') is-invalid @enderror"  placeholder=""   id="lService" name="lService"  value="{{ old('lservice',$maintenance->lastService) }}" />
                                                            @error('lService')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="basic-default-email">Update Last Brake Checked Milage<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('lBrake') is-invalid @enderror" placeholder="" name="lBrake" id="lBrake" value="{{ old('lBrake',$maintenance->lastBrake) }}" />
                                                            @error('lBrake')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="basic-default-address">Update Last Oil Filter Changed Milage<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('lOil') is-invalid @enderror" placeholder="" name="lOil" id="lOil"  value="{{ old('lOil',$maintenance->lastOil) }}" />
                                                            @error('lOil')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="basic-default-address">Update Last Oil Engine Checked Milage<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('lEngine') is-invalid @enderror" placeholder="" name="lEngine" id="lEngine"  value="{{ old('lEngine',$maintenance->lastEngine) }}" />
                                                            @error('lEngine')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="basic-default-address">Update Last Tire Rotation Milage<span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error('lTire') is-invalid @enderror" placeholder="" name="lTire" id="lTire"  value="{{ old('lTire',$maintenance->lastTire) }}" />
                                                            @error('lTire')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                    @include('admin.VehicleManagement.extra.form')

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Complete CheckOut</button>
                                </form>

                                </div>

                            </div>



                        </div>
                    </div>
                </div>



            </div>




            @include('admin.vehicleManagement.modals.check-modal')



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
        function toggleFields(checkbox) {
            let row = checkbox.closest("tr");
            let inputs = row.querySelectorAll("textarea");
                inputs.forEach(input => {
                input.disabled = !checkbox.checked;
            });
        }

    </script>

    <script>
        function printInvoice() {
            var printContent = document.getElementById("invoicePrintArea").innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // Refresh page to restore functionality
        }
    </script>


    @endsection
