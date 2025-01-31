@extends('layouts.adminLayout')

@section('content')

<div class="container p-5">

    <div class="row">

        <div class="col d-flex justify-content-center align-item-center mt-5">

            <div class="card p-5">
                <div class="card-body ">
                  <!-- Logo -->
                  <div class="d-flex justify-content-center align-items-center">
                    
                      <img src="{{asset('assets/img/carlogo.png')}}" alt="" height="200">
                      <h2 class="text-secondary fw-bold rounded">AUTO ASSIST</h2>
                      
                  </div>
                  <!-- /Logo -->
                  <p class="mb-4">Please sign-in to your account</p>
      
                  @if ($errors->any())
                  <div class="container">
                      <div class="alert alert-danger" role="alert">
                          {{ $errors->first() }}
                      </div>
                  </div>
                  @endif
      
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
      
      
                  <form action="{{ url('/login') }}" method="post"
                  enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" name="email-username" placeholder="Enter your email "  value="{{ old('email') }}" autofocus>
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                     @enderror
                    <div class="mb-3 form-password-toggle">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
      
                      </div>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="*********" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-show" id="togglePassword"></i></span>
      
                      </div>
                      @error('password')
                    <span class="text-danger">{{ $message }}</span>
                     @enderror
      
                    </div>
                    <div class="mb-3">
      
                    </div>
                    <div class="mb-3">
      
                      <button class="btn btn-dark d-grid w-100" type="submit">Sign in</button>
                    </div>
                  </form>
      
      
      
                  <div class="divider my-4">
                    <div class="divider-text">Design & Develop by </div>
                  </div>
      
                  <div class="d-flex justify-content-center">
                    <div class="divider-text">Sayuranga Fernando</div>
                  </div>
                </div>
          </div>
        </div>

        
    </div>
      
        
  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        var passwordIcon = document.getElementById('togglePassword');
    
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


