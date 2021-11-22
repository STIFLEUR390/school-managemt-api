<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class DeleteUser
{
    public function delete_admin($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $response = array(
			'status' => true,
			'notification' => __('admin_has_been_deleted_successfully')
		);

        return $response;
    }

    public function force_delete_admin($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->forceDelete();

        $response = array(
			'status' => true,
			'notification' => __('admin_has_been_deleted_successfully')
		);

        return $response;
    }
    
    public function restore_admin($id)
    {
        $user = User::withTrashed()->whereId($id)->firstOrFail()->restore();

        $response = array(
			'status' => true,
			'notification' => __('admin_has_been_deleted_successfully')
		);

        return $response;
    }
}