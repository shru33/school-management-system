<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRoom;
use App\Models\Teacher;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'credits'
    ];
    public function classes()
    {
        return $this->belongsToMany(ClassRoom::class, 'class_subject', 'subject_id', 'class_id')
                    ->withTimestamps();
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher')
                    ->withPivot('class_id')
                    ->withTimestamps();
    }                    
}
