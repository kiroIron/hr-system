@extends('layouts.employee')

@section('content')
<section class="d-flex justify-content-start align-items-start flex-column gap-5">
    <!-- Display list of meetings -->
    <h2>Meetings</h2>
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
