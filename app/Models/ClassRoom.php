<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    // protected $with = ['school'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
