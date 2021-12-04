<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function book_issues()
    {
        return $this->hasMany(Book_issue::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    public function daily_attendances()
    {
        return $this->hasMany(DailyAttendance::class);
    }

    public function enrols()
    {
        return $this->hasMany(Enrol::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
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
