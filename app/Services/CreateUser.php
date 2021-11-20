<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class CreateUser
{
    public function create_admin(Request $request)
    {
        $user = New User();
        $user->school_id = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
		$user->role = 'admin';
		$user->watch_history = '[]';
        $user->save();

        $response = array(
            'status' => true,
            'notification' => __('admin_added_successfully')
        );
    }
}