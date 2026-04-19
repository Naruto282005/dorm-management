@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Rooms</h3>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Floor</th>
                    <th>Capacity</th>
                    <th>Occupied</th>
                    <th>Rate</th>
                    <th>Status</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->floor }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ $room->occupied_beds }}</td>
                        <td>₱{{ number_format($room->monthly_rate, 2) }}</td>
                        <td>{{ $room->status }}</td>
                        <td>
                            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No rooms found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $rooms->links() }}
    </div>
</div>
@endsection
