@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                @if($student->photo)
                    <img src="{{ asset('storage/' . $student->photo) }}" class="img-fluid rounded" alt="Student Photo">
                @else
                    <div class="border p-5 text-muted">No Photo</div>
                @endif
            </div>
            <div class="col-md-9">
                <h3>{{ $student->full_name }}</h3>
                <p><strong>Student ID:</strong> {{ $student->student_id_number }}</p>
                <p><strong>Course:</strong> {{ $student->course }}</p>
                <p><strong>Year Level:</strong> {{ $student->year_level }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Phone:</strong> {{ $student->phone }}</p>
                <p><strong>Room:</strong> {{ $student->room->room_number ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $student->status }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
