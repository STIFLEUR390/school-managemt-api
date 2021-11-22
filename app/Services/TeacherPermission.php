<?php

namespace App\Services;

use App\Models\TeacherPermission as ModelsTeacherPermission;
use Illuminate\Http\Request;

class TeacherPermission
{
   public function teacher_permission(Request $request)
   {
       $class_id = $request->class_id;
       $section_id = $request->section_id;
       $teacher_id = $request->class_id;
       $column_name = $request->class_id;
       $value = $request->class_id;

       $rows = ModelsTeacherPermission::where('class_id', $class_id)->whre('section_id', $section_id)->where('teacher_id', $teacher_id)->get();

       if ($rows->count() > 0) {
            $teacher_permissions = ModelsTeacherPermission::where('class_id', $class_id)->whre('section_id', $section_id)->where('teacher_id', $teacher_id)->firstOrFail();
            $teacher_permissions->$column_name = $value;
            $teacher_permissions->save();
       } else {
            $teacher_permissions = new ModelsTeacherPermission();
            $teacher_permissions->class_id = $class_id;
            $teacher_permissions->section_id = $section_id;
            $teacher_permissions->teacher_id = $teacher_id;
            $teacher_permissions->$column_name = '1';
            $teacher_permissions->save();
       }
   }
}