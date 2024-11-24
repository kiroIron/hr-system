@extends('layouts.employee')

@section('content')


<!-- Page Content -->
<div class="content container d-flex justify-content-center align-content-center  ">
    <div class="container-fluid mt-5">
        <div class="row mt-5">
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                <div class="profile-sidebar">
                    <div class="widget-profile pro-widget-content">
                        <div>
                            <a href="#" class="booking-doc-img">
                                <img src="{{ $user->image }}" alt="User Image" class=" rounded-2 w-50 d-flex">
                            </a>
                            <div class="profile-det-info">
                                <h3>{{ $user->name }}</h3>
                                <div class="patient-details">
                                    <h5>
                                        <i class="fas fa-birthday-cake"></i> 
                                        {{ $user->birthday }}, 
                                        <span id="age"></span> years
                                    </h5>
                                    <h5 class="mb-0">
                                        <i class="fas fa-map-marker-alt"></i> {{ $user->address }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('updateprofile', $user->id) }}" method="POST" enctype="multipart/form-data" class=" container mt-5">
                            @csrf
                            @method('PUT')
                            <div class="row form-row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" readonly class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" readonly class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="date" name="birthday" class="form-control" value="{{ $user->birthday }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>image</label>
                                        <input type="file" name="image" class="form-control" value="{{ $user->image}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->

@push('js')
<script>
    function calculateAge(dateOfBirth) {
        const today = new Date();
        const birthDate = new Date(dateOfBirth);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    $(document).ready(function () {
        $('#age').text(calculateAge('{{ $user->birthday }}'));
    });
</script>
@endpush
@endsection
