@extends('layouts.hr')

@section('content')

<section class="d-flex justify-content-start align-items-start flex-column gap-5">

    <!-- Team creation form -->
    <form action="{{ route('store_meeting') }}" method="POST" class="form-inline p-5 d-flex justify-content-start align-items-start">
        @csrf
        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="subject" class="mb-3">Subject</label>
            <input name="subject" id="subject" value="{{ old('subject') }}" type="text" class="form-control">
            
            <!-- Display validation errors for subject -->
            @error('subject')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="description" class="mb-3">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>

            <!-- Display validation errors for description -->
            @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="date_time" class="mb-3">Date & Time</label>
            <input name="date_time" id="date_time" value="{{ old('date_time') }}" type="datetime-local" class="form-control">

            <!-- Display validation errors for date_time -->
            @error('date_time')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-success px-5 rounded-xl" style="margin-top: 2.46rem;">
                + ADD
            </button>
        </div>
    </form>

    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display a list of created meetings -->
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="border">#</th>
                <th scope="col">Subject</th>
                <th scope="col">Description</th>
                <th scope="col">Date & Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meets as $meet)
                <tr>
                    <th scope="row" class="border">{{ $meet->id }}</th>
                    <td>{{ $meet->subject }}</td>
                    <td>{{ $meet->description }}</td>
                    <td>{{ $meet->date_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

@endsection
