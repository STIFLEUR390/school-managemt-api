<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateUser
{
    public function update_admin(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email,'. $id .'',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9',
            'gender' => 'required|string',
            'blood_group' => 'required|string|min:2|max:3',
            'address' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::findOrFail($id);
        // $user->school_id = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
        $user->save();

        $response = array(
            'status' => true,
            'notification' => __('admin_has_been_updated_successfully')
        );

        return $response;
    }
}