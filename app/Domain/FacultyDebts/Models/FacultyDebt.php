<?php

namespace App\Domain\FacultyDebts\Models;

use App\Domain\Faculties\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyDebt extends Model
{
    protected $fillable = [
        'user_id',
        'faculty_id',
        'number_of_students',
        'number_of_students_paid',
        'number_of_students_not_paid',
        'amount_of_debt',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
