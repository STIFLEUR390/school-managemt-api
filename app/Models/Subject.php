<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function syllabuses()
    {
        return $this->hasMany(Syllabuse::class);
    }
}
