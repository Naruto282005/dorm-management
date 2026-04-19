<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Student;

class StudentObserver
{
    public function created(Student $student): void
    {
        ActivityLog::create([
            'user_name' => auth()->user()->name ?? 'System',
            'action' => 'created',
            'model' => 'Student',
            'record_id' => $student->id,
            'description' => 'Created student: ' . $student->full_name,
        ]);
    }

    public function updated(Student $student): void
    {
        ActivityLog::create([
            'user_name' => auth()->user()->name ?? 'System',
            'action' => 'updated',
            'model' => 'Student',
            'record_id' => $student->id,
            'description' => 'Updated student: ' . $student->full_name,
        ]);
    }

    public function deleted(Student $student): void
    {
        ActivityLog::create([
            'user_name' => auth()->user()->name ?? 'System',
            'action' => 'deleted',
            'model' => 'Student',
            'record_id' => $student->id,
            'description' => 'Deleted student: ' . $student->full_name,
        ]);
    }
}
