<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClassRoom;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admission_number',
        'class_id',
        'roll_number',
        'admission_date',
        'parent_name',
        'parent_phone',
        'parent_email',
        'status'
    ];

    protected $casts = [
        'admission_date' => 'date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}
