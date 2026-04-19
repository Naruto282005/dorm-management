<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Room;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $totalIncome = Payment::sum('amount');

        $recentStudents = Student::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalStudents',
            'totalRooms',
            'availableRooms',
            'totalIncome',
            'recentStudents'
        ));
    }
}
