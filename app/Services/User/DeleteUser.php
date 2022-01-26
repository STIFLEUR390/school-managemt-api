<?php

namespace App\Services\User;

use App\Models\{Enrol, Student, Teacher, TeacherPermission, Tutor, User};
use Illuminate\Http\Request;

class DeleteUser
{
    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $response = array(
			'status' => true,
			'notification' => 'user_has_been_disabled_successfully'
		);

        return $response;
    }

    public function restore_user($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->restore();

        $response = array(
			'status' => true,
			'notification' => 'user_has_been_restored_successfully'
		);

        return $response;
    }

    public function force_delete_admin($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->forceDelete();

        $response = array(
			'status' => true,
			'notification' => 'user_has_been_deleted_successfully'
		);

        return $response;
    }

    public function teacher_force_delete($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        $teacher = Teacher::where('user_id', $id)->get();
        $teacher->delete();
        $teacher_permision = TeacherPermission::where('teacher_id', $teacher->id)->get();
        $teacher_permision->delete();

        $response = array(
			'status' => true,
			'notification' => 'user_has_been_deleted_successfully'
		);

        return $response;
    }

    public function parent_force_delete($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        $teacher = Tutor::where('user_id', $id)->get();
        $teacher->delete();

        $response = array(
			'status' => true,
			'notification' => 'user_has_been_deleted_successfully'
		);

        return $response;
    }

    public function student_force_delete($id)
    {
        $student = Student::find($id);
        $user_id = $student->user_id;
        $enrol_id = $student->enrols()->id;

        $student->delete();
        Enrol::whereId($enrol_id)->forceDelete();
        User::withTrashed()->whereId($user_id)->firstOrFail()->forceDelete();

        $response = array(
			'status' => true,
			'notification' => 'user_has_been_deleted_successfully'
		);

        return $response;
    }
}
