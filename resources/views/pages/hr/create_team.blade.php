@extends('layouts.hr')

@section('content')
<section class="d-flex justify-content-start align-items-start flex-column gap-5">
    <!-- Display success message if available -->
    {{-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    <!-- Team creation form -->
    <form action="{{ route('pages.hr.store_team') }}" method="POST" class="form-inline p-5 d-flex justify-content-start align-items-start">
        @csrf
        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="title" class="mb-3">Title</label>
            <input name="title" id="title" value="{{ old('title') }}" type="text" class="form-control">
            
            <!-- Display validation errors for title -->
            @error('title')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-success px-5 rounded-xl" style="margin-top: 2.46rem;">
                + ADD
            </button>
        </div>
    </form>

    <!-- Display a list of created teams -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="border">#</th>
                <th scope="col">Title</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
                <tr>
                    <th scope="row" class="border">{{ $team->id }}</th>
                    <td>{{ $team->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
