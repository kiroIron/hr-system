@extends('layouts.employee')

@section('content')
<section class="d-flex justify-content-start align-items-start flex-column gap-5">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <!-- Holiday request form -->
    <form action="{{ route('store_holiday') }}" method="POST" class="form-inline p-5 d-flex justify-content-start align-items-start">
        @csrf
        
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        
        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="subject" class="mb-3">Holiday Subject</label>
            <input name="subject" id="subject" value="{{ old('subject') }}" type="text" class="form-control">
            
            @error('subject')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="description" class="mb-3">Holiday Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            
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

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="user_id" class="mb-3">Employee</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Select Employee</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            
            @error('user_id')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="action" class="mb-3">Action</label>
            <select name="action" id="action" class="form-control">
                <option value="pending" {{ old('action') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accept" {{ old('action') == 'accept' ? 'selected' : '' }}>Accept</option>
                <option value="cancel" {{ old('action') == 'cancel' ? 'selected' : '' }}>Cancel</option>
            </select>
            
            @error('action')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-success px-5 rounded-xl" style="margin-top: 2.46rem;">
                + SUBMIT HOLIDAY REQUEST
            </button>
        </div>
    </form>

    <!-- Display a list of submitted holiday requests (optional) -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="border">#</th>
                <th scope="col">Subject</th>
                <th scope="col">Date</th>
                <th scope="col">Employee</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($holidays as $holiday)
                <tr>
                    <th scope="row" class="border">{{ $holiday->id }}</th>
                    <td>{{ $holiday->subject }}</td>
                    <td>{{ $holiday->date }}</td>
                    <td>{{ $holiday->user->name }}</td>
                    <td>{{ $holiday->action }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

@endsection