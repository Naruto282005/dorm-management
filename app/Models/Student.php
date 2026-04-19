<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'student_id_number',
        'first_name',
        'last_name',
        'gender',
        'course',
        'year_level',
        'email',
        'phone',
        'address',
        'guardian_name',
        'guardian_phone',
        'photo',
        'check_in_date',
        'status',
    ];

    protected $appends = ['full_name'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
