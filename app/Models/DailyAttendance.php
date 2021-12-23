<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyAttendance extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['classe', 'section', 'session', 'student'];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function session()
    {
        return $this->belongsTo(SessionApp::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
