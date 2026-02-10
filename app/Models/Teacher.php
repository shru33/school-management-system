<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Subject;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'qualification',
        'joining_date',
        'specialization',
        'salary',
        'status'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class, 'class_teacher_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')
                    ->withPivot('class_id')
                    ->withTimestamps();
    }

}
