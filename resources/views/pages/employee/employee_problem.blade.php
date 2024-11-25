@extends('layouts.employee')

@section('content')
<section class="d-flex flex-column gap-5">

    {{-- Display Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Problem Submission Form --}}
    <form action="{{ route('store_problem') }}" method="POST" class="p-5 d-flex flex-column gap-4">
        @csrf

        <div class="form-group">
            <label for="subject">Problem Subject</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control" placeholder="Enter problem subject">
            @error('subject')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Problem Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Describe the problem">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Problem</button>
    </form>

    {{-- Display List of Problems --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Employee</th>
            </tr>
        </thead>
        <tbody>
            @forelse($problems as $problem)
                <tr>
                    <td>{{ $problem->id }}</td>
                    <td>{{ $problem->subject }}</td>
                    <td>{{ $problem->description }}</td>
                    <td>{{ $problem->user->name ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No problems found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</section>
@endsection
