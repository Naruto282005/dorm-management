<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Room;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function students()
    {
        $students = Student::with('room')->get();
        return view('reports.students', compact('students'));
    }

    public function studentsPdf()
    {
        $students = Student::with('room')->get();
        $pdf = Pdf::loadView('reports.students_pdf', compact('students'));
        return $pdf->download('students-report.pdf');
    }

    public function payments()
    {
        $payments = Payment::with('student')->get();
        $totalIncome = Payment::sum('amount');
        return view('reports.payments', compact('payments', 'totalIncome'));
    }

    public function paymentsPdf()
    {
        $payments = Payment::with('student')->get();
        $totalIncome = Payment::sum('amount');
        $pdf = Pdf::loadView('reports.payments_pdf', compact('payments', 'totalIncome'));
        return $pdf->download('payments-report.pdf');
    }

    public function occupancy()
    {
        $rooms = Room::withCount('students')->get();

        $availableRooms = Room::whereColumn('occupied_beds', '<', 'capacity')->count();
        $fullRooms = Room::whereColumn('occupied_beds', '>=', 'capacity')->count();

        $unpaidStudents = Student::whereDoesntHave('payments', function ($query) {
            $query->where('month_paid_for', now()->format('F Y'));
        })->get();

        $incomeByMonth = Payment::select('month_paid_for', DB::raw('SUM(amount) as total'))
            ->groupBy('month_paid_for')
            ->orderBy('month_paid_for')
            ->get();

        return view('reports.occupancy', compact(
            'rooms',
            'availableRooms',
            'fullRooms',
            'unpaidStudents',
            'incomeByMonth'
        ));
    }
}
