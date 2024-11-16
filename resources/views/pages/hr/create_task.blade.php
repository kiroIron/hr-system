@extends('layouts.hr')

@section('content')
<section class="d-flex justify-content-start align-items-start flex-column gap-5">

    <!-- Display success message -->
    {{-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}

    <!-- Task creation form -->
    <form action="{{ route('pages.hr.store_task') }}" method="POST" class="form-inline p-5 d-flex justify-content-start align-items-start">
        @csrf
        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="title" class="mb-3">Task Title</label>
            <input name="title" id="title" value="{{ old('title') }}" type="text" class="form-control">
            
            @error('title')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="description" class="mb-3">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            
            @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="status" class="mb-3">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="end" {{ old('status') == 'end' ? 'selected' : '' }}>End</option>
            </select>
            
            @error('status')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mr-4 d-flex flex-column justify-content-start align-items-start gap-5">
            <label for="team_id" class="mb-3">Team</label>
            <select name="team_id" id="team_id" class="form-control">
                <option value="">Select Team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                        {{ $team->title }}
                    </option>
                @endforeach
            </select>
            
            @error('team_id')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-success px-5 rounded-xl" style="margin-top: 2.46rem;">
                + ADD TASK
            </button>
        </div>
    </form>

    <!-- Display a list of created tasks (if you need it) -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="border">#</th>
                <th scope="col">Title</th>
                <th scope="col">Status</th>
                <th scope="col">Team</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <th scope="row" class="border">{{ $task->id }}</th>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->team->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
