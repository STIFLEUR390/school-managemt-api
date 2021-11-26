<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\TeacherPermission;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUser
{
    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $response = array(
			'status' => true,
			'notification' => $user->role.'_has_been_disabled_successfully'
		);

        return $response;
    }
    
    public function restore_user($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->restore();

        $response = array(
			'status' => true,
			'notification' => 'admin_has_been_restored_successfully'
		);

        return $response;
    }

    public function force_delete_admin($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->forceDelete();

        $response = array(
			'status' => true,
			'notification' => 'admin_has_been_deleted_successfully'
		);

        return $response;
    }

    public function teacher_delete_admin($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        $teacher = Teacher::where('user_id', $id)->get();
        $teacher->delete();
        $teacher_permision = TeacherPermission::where('teacher_id', $teacher->id)->get();
        $teacher_permision->delete();

        $response = array(
			'status' => true,
			'notification' => 'teacher_has_been_deleted_successfully'
		);

        return $response;
    }
}