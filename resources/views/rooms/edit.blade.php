@extends('layouts.app')

@section('content')
<h3 class="mb-3">Edit Room</h3>

<form action="{{ route('rooms.update', $room) }}" method="POST" class="card shadow-sm border-0 p-4">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $room->room_number) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Floor</label>
            <input type="number" name="floor" class="form-control" value="{{ old('floor', $room->floor) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $room->capacity) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Occupied Beds</label>
            <input type="number" name="occupied_beds" class="form-control" value="{{ old('occupied_beds', $room->occupied_beds) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Monthly Rate</label>
            <input type="number" step="0.01" name="monthly_rate" class="form-control" value="{{ old('monthly_rate', $room->monthly_rate) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="full" {{ $room->status == 'full' ? 'selected' : '' }}>Full</option>
                <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update Room</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
