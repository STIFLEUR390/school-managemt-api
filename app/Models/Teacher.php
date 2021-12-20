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
        return $this->belongsTo(User::class, 'user_id');
    }    

    public function department()
    {
        return $this->belongsTo(Department::class);
    }    

    public function teacher_permissions()
    {
        return $this->hasMany(TeacherPermission::class);
    }  
}
