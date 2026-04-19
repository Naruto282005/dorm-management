@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Students</h3>
    <div>
        <a href="{{ route('reports.students') }}" class="btn btn-secondary">View Report</a>
        <a href="{{ route('reports.students.pdf') }}" class="btn btn-danger">Download PDF</a>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>
</div>

<form method="GET" class="mb-3">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search student..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-secondary w-100">Search</button>
        </div>
    </div>
</form>

<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>ID Number</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" width="60" height="60" class="rounded-circle object-fit-cover">
                            @else
                                No Photo
                            @endif
                        </td>
                        <td>{{ $student->student_id_number }}</td>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->room->room_number ?? 'N/A' }}</td>
                        <td>{{ $student->status }}</td>
                        <td>
                            <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $students->links() }}
    </div>
</div>
@endsection
