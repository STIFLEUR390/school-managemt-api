<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionApp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function daily_attendances()
    {
        return $this->hasMany(DailyAttendance::class);
    }

    public function syllabuses()
    {
        return $this->hasMany(Syllabuse::class);
    }
}
