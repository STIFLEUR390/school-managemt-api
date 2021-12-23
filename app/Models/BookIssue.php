<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['book_issues'];

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
