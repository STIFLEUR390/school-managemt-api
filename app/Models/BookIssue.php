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
        return $this->BelongsTo(Book::class);
    }

    public function classe()
    {
        return $this->BelongsTo(Classe::class);
    }

    public function school()
    {
        return $this->BelongsTo(School::class);
    }
}
