<?php

namespace App\Services\User;

use App\Http\Controllers\BaseController;
use App\Models\{Teacher, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateUser extends BaseController
{
    public function update_parent(Request $request, $id)
    {
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'. $id .'',
            'phone' => 'required|string|min:9|max:9|unique:users,phone,'. $id .'',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string',
            'image' => 'file|mimes:jpeg,bmp,png,jpg,gif'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;

        if ($request->file('image')) {
            $file = $request->file('image');
            if ($user->image != 'upload/avatar.jpg') {
                @unlink(public_path($user->image));
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }
        
        
        $user->save();

        $response = array(
            'status' => true,
            'notification' => 'parent_has_been_updated_successfully'
        );

        return $this->sendResponse($response);
    }

    public function update_accountant(Request $request, $id)
    {
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'. $id .'',
            'phone' => 'required|string|min:9|max:9|unique:users,phone,'. $id .'',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string',
            'image' => 'file|mimes:jpeg,bmp,png,jpg,gif'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;

        if ($request->file('image')) {
            $file = $request->file('image');
            if ($user->image != 'upload/avatar.jpg') {
                @unlink(public_path($user->image));
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }
        
        
        $user->save();

        $response = array(
            'status' => true,
            'notification' => 'accountant_has_been_updated_successfully'
        );

        return $this->sendResponse($response);
    }

    public function update_librarian(Request $request, $id)
    {
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'. $id .'',
            'phone' => 'required|string|min:9|max:9|unique:users,phone,'. $id .'',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string',
            'image' => 'file|mimes:jpeg,bmp,png,jpg,gif'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;

        if ($request->file('image')) {
            $file = $request->file('image');
            if ($user->image != 'upload/avatar.jpg') {
                @unlink(public_path($user->image));
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }
        
        
        $user->save();

        $response = array(
            'status' => true,
            'notification' => 'librarian_has_been_updated_successfully'
        );

        return $this->sendResponse($response);
    }

    public function update_admin(Request $request, $id)
    {
        
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'. $id .'',
            // 'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9|unique:users,phone,'. $id .'',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string',
            'image' => 'file|mimes:jpeg,bmp,png,jpg,gif'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return $this->sendError($validator->errors(), 422);
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;

        if ($request->file('image')) {
            $file = $request->file('image');
            if ($user->image != 'upload/avatar.jpg') {
                @unlink(public_path($user->image));
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }
        
        
        $user->save();

        $response = array(
            'status' => true,
            'notification' => 'admin_has_been_updated_successfully'
        );

        return $this->sendResponse($response);
    }
    public function update_teacher(Request $request, $id)
    {
        
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'. $id .'',
            // 'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9|unique:users,phone,'. $id .'',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'required|string',
            'about' => 'required|string',
            'facebook_link' => 'required|string',
            'twitter_link' => 'required|string',
            'linkedin_link' => 'required|string',
            'department_id' => 'required|string',
            'designation' => 'required|string',
            'show_on_website' => 'required|string',
            'image' => 'file|mimes:jpeg,bmp,png,jpg,gif'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return $this->sendError($validator->errors(), 422);
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;

        if ($request->file('image')) {
    		$file = $request->file('image');            
            if ($user->image != 'upload/avatar.jpg') {
                @unlink(public_path($user->image));
            }
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/users'),$filename);
    		$user->image = 'upload/users/'.$filename;
    	}
        
        $user->save();

        // enregistrer l'enseignant
        $teacher = Teacher::where('user_id', $id)->get();
        // $teacher->user_id = $user->id;
        $teacher->about = $request->about;
        $teacher->social_links = json_encode([ $request->facebook_link, $request->twitter_link, $request->linkedin_link ]);
        $teacher->department_id = $request->department_id;
        $teacher->designation = $request->abodesignationut;
        $teacher->show_on_website = $request->show_on_website;
        $teacher->save();

        $response = array(
            'status' => true,
            'notification' => 'teacher_has_been_updated_successfully'
        );

        return $this->sendResponse($response);
    }
}