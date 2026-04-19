@extends('layouts.app')

@section('content')
<h3 class="mb-3">Edit Student</h3>

<form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm border-0 p-4">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Student ID Number</label>
            <input type="text" name="student_id_number" class="form-control" value="{{ old('student_id_number', $student->student_id_number) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Course</label>
            <input type="text" name="course" class="form-control" value="{{ old('course', $student->course) }}" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Year Level</label>
            <input type="text" name="year_level" class="form-control" value="{{ old('year_level', $student->year_level) }}" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Check In Date</label>
            <input type="date" name="check_in_date" class="form-control" value="{{ old('check_in_date', $student->check_in_date) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Room</label>
            <select name="room_id" class="form-select">
                <option value="">No room assigned</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id', $student->room_id) == $room->id ? 'selected' : '' }}>
                        {{ $room->room_number }} ({{ $room->occupied_beds }}/{{ $room->capacity }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Guardian Name</label>
            <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name', $student->guardian_name) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Guardian Phone</label>
            <input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone', $student->guardian_phone) }}" required>
        </div>

        <div class="col-md-12">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="3" required>{{ old('address', $student->address) }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
            @if($student->photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $student->photo) }}" width="100" class="rounded border">
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update Student</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
