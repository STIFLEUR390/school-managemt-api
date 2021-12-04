<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function book()
    {
        return $this->BelongsTo(Book::class, 'book_id');
    }

    public function classe()
    {
        return $this->BelongsTo(Classe::class, 'class_id');
    }

    public function student()
    {
        return $this->BelongsTo(Student::class, 'student_id');
    }

    public function school()
    {
        return $this->BelongsTo(School::class, 'school_id');
    }
}
