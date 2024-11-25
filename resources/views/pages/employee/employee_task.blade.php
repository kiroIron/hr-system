@extends('layouts.employee')

@section('content')
<section class="d-flex flex-column gap-5 p-5">

    <h1 class="mb-4">Your Tasks</h1>

    @if($tasks->isEmpty())
        <p>No tasks assigned to you yet.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>
                            @if($task->status == 'pending')
                                <form action="{{ route('employeeTask.end', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">End</button>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>Completed</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</section>
@endsection
