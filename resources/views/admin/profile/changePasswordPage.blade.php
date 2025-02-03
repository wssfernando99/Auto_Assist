@php
    $id = session('id');
    $name = session('name');
    $role = session('role');
    $profileImage = session('profileImage');
@endphpp
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
                    <div class="col-md-4">
                          <div class="alert alert-success alert-dismissible" role="alert">
                            <h6 class="alert-heading d-flex align-items-center mb-1">Completed:</h6>
                            <p class="mb-0">{{ session()->get('message') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                          </div>
                    </div>
                    @endif

                    @if (session()->has('error'))
                    
                    <div class="col-md-4">
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
                            <li class="nav-item "><a class="nav-link " href="{{ url('/userProfile') }}"><i class="bx bx-user me-1"></i> Account</a></li>
                            <li class="nav-item"><a class="nav-link bg-dark active" href="{{ url('/changePasswordView') }}"><i class="bx bx-lock-alt me-1"></i> Security</a></li>
                           
                          </ul>
                          <div class="card mb-4">
                            <h5 class="card-header">Change Password</h5>
                            <div class="card-body">
                                <form action="{{url('changePassword')}}" novalidate method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}                                <div class="row">
                               
                            
                                <div class="row">
                                  <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Current Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                      <input class="form-control" type="password" id="cPwd" name="cPwd" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide" id="toggleold"></i></span>
                                    </div>
                                    @error('cPwd')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                      
                                  <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword"> New Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                      <input class="form-control" type="password" name="newPwd" id="newPwd" pattern="^\S+$" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide" id="togglenew"></i></span>
                                    </div>
                                    @error('newPwd')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                    <p class="fw-medium mt-2">Password Requirements:</p>
                                    <ul class="ps-3 mb-0">
                                      <li class="mb-1 text-warning">
                                        Minimum 6 characters long - the more, the better
                                      </li>
                                     
                                    </ul>
                                  </div>
                                  <div class="col-12 mt-1">
                                    <button type="submit" class="btn btn-dark me-2">Save changes</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.getElementById('togglenew').addEventListener('click', function() {
            var passwordInput = document.getElementById('newPwd');
            var passwordIcon = document.getElementById('togglenew');
        
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove('bx-hide');
                passwordIcon.classList.add('bx-show');
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove('bx-show');
                passwordIcon.classList.add('bx-hide');
            }
        });

        document.getElementById('toggleold').addEventListener('click', function() {
            var passwordInput = document.getElementById('cPwd');
            var passwordIcon = document.getElementById('toggleold');
        
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove('bx-hide');
                passwordIcon.classList.add('bx-show');
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove('bx-show');
                passwordIcon.classList.add('bx-hide');
            }
        });
        
    </script>


@endsection