<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
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

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function session(){
        return $this->belongsTo(SessionApp::class, 'session_app');
    }
}
