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
        return $this->hasMany(Tutor::class);
    }

    public function book_issues()
    {
        return $this->hasMany(Book_issue::class);
    }

    public function class_rom()
    {
        return $this->hasMany(ClassRoom::class);
    }
}
