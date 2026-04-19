<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'floor',
        'capacity',
        'occupied_beds',
        'monthly_rate',
        'status',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
