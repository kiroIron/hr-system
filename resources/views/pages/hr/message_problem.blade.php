@extends('layouts.hr')

@section('content')
<section class="d-flex flex-column gap-5">

    <h1>Employee Messages</h1>

    {{-- Display List of Problems --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Submitted By</th>
                <th>Date Submitted</th>
            </tr>
        </thead>
        <tbody>
            @forelse($problems as $problem)
                <tr>
                    <td>{{ $problem->id }}</td>
                    <td>{{ $problem->subject }}</td>
                    <td>{{ $problem->description }}</td>
                    <td>{{ $problem->user->name ?? 'Unknown' }}</td>
                    <td>{{ $problem->created_at->format('d M, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No problems found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</section>
@endsection
