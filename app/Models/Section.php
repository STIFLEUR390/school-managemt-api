<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function daily_attendances()
    {
        return $this->hasMany(DailyAttendance::class);
    }

    public function enrols()
    {
        return $this->hasMany(Enrol::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function syllabuses()
    {
        return $this->hasMany(Syllabuse::class);
    }    

    public function teacher_permissions()
    {
        return $this->hasMany(TeacherPermission::class);
    }  
}
