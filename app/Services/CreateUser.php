<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateUser
{
    public function create_admin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9',
            'gender' => 'required|string',
            'blood_group' => 'required|string|min:2|max:3',
            'address' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // creation de l'utilisateur
        $user = new User();
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

        return $response;
    }

    public function create_teacher(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9',
            'gender' => 'required|string',
            'blood_group' => 'required|string|min:2|max:3',
            'address' => 'required|string',
            'about' => 'required|string',
            'facebook_link' => 'required|string',
            'twitter_link' => 'required|string',
            'linkedin_link' => 'required|string',
            'department_id' => 'required|string',
            'designation' => 'required|string',
            'show_on_website' => 'required|string',
            'image' => 'file|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
 
        // creation de l'utilisateur
        $user = new User();
        $user->school_id = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
		$user->role = 'teacher';
		$user->watch_history = '[]';

        if ($request->file('image')) {
    		$file = $request->file('image');
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/users'),$filename);
    		$user->image = $filename;
    	}
        
        $user->save();

        // enregistrer l'enseignant
        $teacher = new Teacher();
        $teacher->user_id = $user->id;
        $teacher->school_id = 1;
        $teacher->about = $request->about;
        $teacher->social_links = json_encode([ $request->facebook_link, $request->twitter_link, $request->linkedin_link ]);
        $teacher->department_id = $request->department_id;
        $teacher->designation = $request->abodesignationut;
        $teacher->show_on_website = $request->show_on_website;
        $teacher->save();
        
        $response = array(
            'status' => true,
            'notification' => __('teacher_added_successfully')
        );

        return $response;
    }
}