<!-- resources/views/timesheets/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Timesheets</h1>
        <a href="{{ route('timesheets.create') }}" class="btn btn-primary">Create Timesheet</a>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timesheets as $timesheet)
                    <tr>
                        <td>{{ $timesheet->id }}</td>
                        <td>{{ $timesheet->user_id }}</td>
                        <td>{{ $timesheet->date }}</td>
                        <td>{{ $timesheet->start_time }}</td>
                        <td>{{ $timesheet->end_time }}</td>
                        <td>{{ $timesheet->description }}</td>
                        <td>
                            <a href="{{ route('timesheets.show', $timesheet->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('timesheets.edit', $timesheet->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('timesheets.destroy', $timesheet->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
