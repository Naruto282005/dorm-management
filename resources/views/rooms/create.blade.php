@extends('layouts.app')

@section('content')
<h3 class="mb-3">Add Room</h3>

<form action="{{ route('rooms.store') }}" method="POST" class="card shadow-sm border-0 p-4">
    @csrf

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Floor</label>
            <input type="number" name="floor" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Monthly Rate</label>
            <input type="number" step="0.01" name="monthly_rate" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="available">Available</option>
                <option value="full">Full</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save Room</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection

