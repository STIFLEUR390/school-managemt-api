<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }

    public function classes()
    {
        return $this->hasMany(Tutor::class, 'class_id');
    }

    public function book_issues()
    {
        return $this->hasMany(Book_issue::class);
    }

    public function class_rom()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function daily_attendances()
    {
        return $this->hasMany(DailyAttendance::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function enrols()
    {
        return $this->hasMany(Enrol::class);
    }

    public function event_calendars()
    {
        return $this->hasMany(EventCalendar::class);
    }

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }

    public function expense_categories()
    {
        return $this->hasMany(ExpenseCategorie::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
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

    public function noticeboards()
    {
        return $this->hasMany(Noticeboard::class);
    }

    public function setting()
    {
        return $this->hasOne(Noticeboard::class);
    }

    public function syllabuses()
    {
        return $this->hasMany(Syllabuse::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
