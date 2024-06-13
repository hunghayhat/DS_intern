@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Timesheet</h1>
    <form action="{{ route('timesheets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_time">Check In</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">Check out</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
