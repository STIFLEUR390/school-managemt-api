<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
