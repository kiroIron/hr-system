
@extends('layouts.login')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
@endpush
@section('content')

<div class=" container d-flex justify-content-center align-items-center min-vh-100">
  <div class="row container p-3 bg-white shadow box-area" style="border-radius:5%">
      <div class="col-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
          style="  border-radius:5% ;background:#103cbe; ">
          <div class="featured-image mb-5 ">
              <img src="{{asset('img/5605786.png')}}" alt="company-image" class="img-fluid" style="width: 300px;">
          </div>
          <p class="text-light fs-2 p_style container d-flex justify-content-center mb-4"> data company</p>

      </div>
      <div class="col-6 right-box">
          <div class="row align-items-center">
              <div class="header-text mb-4">

                  <p class="container d-flex justify-content-center mt-5 p_stylee">LOGIN</p>

                  <form class=" container mt-5 " method="post" action="{{ route('login') }}">
                    @csrf

                      <div class="input-group mb-4 ">
                          <input id="email" title="email" name="email" required type="text"  
                              class=" form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"value="{{ old('email') }}"autofocus placeholder="Email address">
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="input-group mb-5 ">
                          <input id="password" title="password" name="password" required type="password"
                              class=" form-control form-control-lg bg-light fs-6  @error('password') is-invalid @enderror" placeholder="Your password">
                              @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                      </div>
                      <div class="input-group mb-5 ">
                          <button class="btn_color btn btn-primary container w-75 d-flex justify-content-center "
                          type="submit" name="button" title="button">Login</button>
                      </div>
                  </form>

              </div>
          </div>
      </div>
  </div>
</div>


@push('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
crossorigin="anonymous"></script>
@endpush
@endsection 