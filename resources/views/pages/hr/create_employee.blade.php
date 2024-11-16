@extends('layouts.hr')

@section('content')
<section class="d-flex justify-content-start align-items-start flex-column gap-5">
    <!-- Display success message if available -->
    {{-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    <!-- Employee creation form -->
    <form action="{{ route('pages.hr.store_employee') }}" method="POST" class="form-inline p-5 d-flex justify-content-start align-items-start">
        @csrf
        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="name" class="mb-3">Name</label>
            <input name="name" id="name" value="{{ old('name') }}" type="text" class="form-control">
            @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="email" class="mb-3">Email</label>
            <input name="email" id="email" value="{{ old('email') }}" type="email" class="form-control">
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="password" class="mb-3">Password</label>
            <input name="password" id="password" value="{{ old('password') }}" type="password" class="form-control">
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="teams" class="mb-3">Teams</label>
            <select name="team_id" id="teams" class="custom-select mb-3">
                <option selected>Choose a team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->title }}</option>
                @endforeach
            </select>
            @error('team_id')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-success px-5 rounded-xl" style="margin-top: 2.46rem;">
                + ADD
            </button>
        </div>
    </form>

    <!-- Display a list of created employees (users) -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="border">#</th>
                <th scope="col">Image</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row" class="border">{{ $user->id }}</th>
                    <td>
                        <img src="{{ $user->image }}" alt="" class="rounded-circle" width="48px" height="48px">
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
