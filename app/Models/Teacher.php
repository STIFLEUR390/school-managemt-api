<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;    

    public function school()
    {
        return $this->belongsTo(School::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }    

    public function departements()
    {
        return $this->belongsToMany(Departement::class);
    }    

    public function teacher_permissions()
    {
        return $this->hasMany(TeacherPermission::class);
    }  
}
