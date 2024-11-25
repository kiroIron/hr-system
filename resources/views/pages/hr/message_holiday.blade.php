@extends('layouts.hr')

@section('content')


{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Subject</th>
            <th scope="col">Description</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($holidays as $holiday)
        <tr>
            <td>{{ $holiday->id }}</td>
            <td>{{ $holiday->subject }}</td>
            <td>{{ $holiday->description }}</td>
            <td>{{ $holiday->date }}</td>
            <td>
                @if($holiday->action == 'pending')
                    <form action="{{ route('update_holiday_action', ['id' => $holiday->id, 'action' => 'accept']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Accept</button>
                    </form>
                    <form action="{{ route('update_holiday_action', ['id' => $holiday->id, 'action' => 'cancel']) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                @else
                    <span>{{ ucfirst($holiday->action) }}</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
