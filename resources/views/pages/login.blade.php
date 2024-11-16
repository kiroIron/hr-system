@extends('layouts.login')

@section('content')
<form class="gap-5 border p-5 rounded-5" method="POST" action="{{ route('login') }}" >
  @csrf  
  <fieldset >
      <legend class="text-center my-3 fs-3 fw-bold">Login</legend>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
     <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                        </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror      </div>
     
      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </fieldset>
  </form>
@endsection