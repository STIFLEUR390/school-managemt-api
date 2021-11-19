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
        return $this->hasMany(Section::class);
    }
}
