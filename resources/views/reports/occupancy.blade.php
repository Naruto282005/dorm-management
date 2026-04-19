@extends('layouts.app')

@section('content')
<h3 class="mb-3">Occupancy and Summary Report</h3>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Available Rooms</h5>
                <h2>{{ $availableRooms }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Full Rooms</h5>
                <h2>{{ $fullRooms }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white">
        <strong>Room Occupancy</strong>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Capacity</th>
                    <th>Occupied</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ $room->students_count }}</td>
                        <td>{{ $room->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white">
        <strong>Students Without Payment for {{ now()->format('F Y') }}</strong>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Number</th>
                    <th>Name</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                @forelse($unpaidStudents as $student)
                    <tr>
                        <td>{{ $student->student_id_number }}</td>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->course }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No unpaid students.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <strong>Income by Month</strong>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total Income</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incomeByMonth as $row)
                    <tr>
                        <td>{{ $row->month_paid_for }}</td>
                        <td>₱{{ number_format($row->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
