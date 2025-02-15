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

            @include('layouts.userSideBar')

            <div class="layout-page">

                @include('layouts.header')


                {{--  content  --}}

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="d-flex justify-content-between  py-3 mb-4">
                        <h4 class="fw-bold"><span class="text-muted fw-light"></span>User Profile Settings</h4>

                    </div>
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
                    
                    
                    <!-- Connection Cards -->
                    <div class="row">
                        <div class="col-md-12">
                          <ul class="nav nav-pills flex-column flex-md-row mb-3">
                            <li class="nav-item"><a class="nav-link bg-dark active" href="{{ url('/userProfile') }}"><i class="bx bx-user me-1"></i> Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/changePasswordView') }}"><i class="bx bx-lock-alt me-1"></i> Security</a></li>
                         
                          </ul>
                          <div class="card mb-4">
                            <h5 class="card-header">Profile Details</h5>
                            <!-- Account -->
                            
                            <hr class="my-0">
                            <div class="card-body">
                                <form action="{{url('editProfile')}}" novalidate method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}.

                                <div class="row mb-3">
                                  <div class="col-md-2 " >
                                    <img src="{{ asset('userProfileImage/' . $data->profileImage) }}" alt="user-avatar" class="d-block rounded" height="150" id="uploadedAvatar" />
                                  </div>
                                  <div class="col-md-4">
                                    <label for="profileImage" class="form-label">Upload New Image</label>
                                    <input class="form-control @error('profileImage') is-invalid @enderror" type="file" 
                                           id="profileImage" name="profileImage" accept="image/*" 
                                           onchange="previewImage()" value="{{ old('profileImage') }}" />
                                    <label class="form-label text-danger" id="imgValid" name="imgValid"></label>
                                    @error('profileImage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                </div>

                                <div class="row">
                                  <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" id="name" name="name"placeholder="Name"  value="{{ old('name', $data->name) }}" required />
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                 
                                  
                                  <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"  placeholder="john.doe@example.com" value="{{$data->email}}" readonly/>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                      <input type="tel" class="form-control"  placeholder="011*******"  id="contact" name="contact" value="{{ old('contact', $data->contact) }}" required>
                                    </div>
                                    @error('contact')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Role" value="{{$data->role}}"  readonly/>
                                  </div>
                                </div>
                                <div class="mt-2">
                                  <button type="submit" class="btn btn-dark me-2">Save changes</button>
                                </div>
                              </form>
                            </div>
                            <!-- /Account -->
                          </div>
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>


@endsection