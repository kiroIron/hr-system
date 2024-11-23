@extends('layouts.employee')

@section('content')

<section class="d-flex justify-content-start align-items-start flex-column gap-5">

    <!-- Holiday creation form -->
    <form action="{{ route('store_holiday') }}" method="POST" class="form-inline p-5 d-flex justify-content-start align-items-start">
        @csrf
        {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="subject" class="mb-3">Holiday Subject</label>
            <input name="subject" id="subject" value="{{ old('subject') }}" type="text" class="form-control">
            
            @error('subject')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="description" class="mb-3">Holiday Description</label>
            <input name="description" id="description" value="{{ old('description') }}" type="text" class="form-control">
            
            @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="date" class="mb-3">Holiday Date</label>
            <input name="date" id="date" value="{{ old('date') }}" type="date" class="form-control">
            
            @error('date')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>



        <div>
            <button type="submit" class="btn btn-success px-5 rounded-xl" style="margin-top: 2.46rem;">
                + SUBMIT REQUEST
            </button>
        </div>
    </form>

    <h2>Your Holiday Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Subject</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($holidays as $holiday)
            <tr>
                <td>{{ $holiday->id }}</td>
                <td>{{ $holiday->subject }}</td>
                <td>{{ ucfirst($holiday->action) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>

@endsection
