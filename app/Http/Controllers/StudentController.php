<?php

namespace App\Http\Controllers;

use App\Mail\StudentWelcomeMail;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('room');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('student_id_number', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $rooms = Room::where('status', 'available')
            ->orWhere('status', 'full')
            ->get();

        return view('students.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'nullable|exists:rooms,id',
            'student_id_number' => 'required|unique:students,student_id_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'course' => 'required|string|max:255',
            'year_level' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'check_in_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student = Student::create($validated);

        if ($student->room_id) {
            $room = Room::find($student->room_id);

            if ($room) {
                $room->occupied_beds += 1;
                $room->status = $room->occupied_beds >= $room->capacity ? 'full' : 'available';
                $room->save();
            }
        }

        Mail::to($student->email)->send(new StudentWelcomeMail($student));

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load('room', 'payments');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $rooms = Room::all();

        return view('students.edit', compact('student', 'rooms'));
    }

    public function update(Request $request, Student $student)
    {
        $oldRoomId = $student->room_id;

        $validated = $request->validate([
            'room_id' => 'nullable|exists:rooms,id',
            'student_id_number' => 'required|unique:students,student_id_number,' . $student->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'course' => 'required|string|max:255',
            'year_level' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'check_in_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($validated);

        if ($oldRoomId != $student->room_id) {
            if ($oldRoomId) {
                $oldRoom = Room::find($oldRoomId);
                if ($oldRoom && $oldRoom->occupied_beds > 0) {
                    $oldRoom->occupied_beds -= 1;
                    $oldRoom->status = $oldRoom->occupied_beds >= $oldRoom->capacity ? 'full' : 'available';
                    $oldRoom->save();
                }
            }

            if ($student->room_id) {
                $newRoom = Room::find($student->room_id);
                if ($newRoom) {
                    $newRoom->occupied_beds += 1;
                    $newRoom->status = $newRoom->occupied_beds >= $newRoom->capacity ? 'full' : 'available';
                    $newRoom->save();
                }
            }
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        if ($student->room_id) {
            $room = $student->room;

            if ($room && $room->occupied_beds > 0) {
                $room->occupied_beds -= 1;
                $room->status = $room->occupied_beds >= $room->capacity ? 'full' : 'available';
                $room->save();
            }
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
