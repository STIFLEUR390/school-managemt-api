<?php

namespace App\Services\User;

use App\Http\Controllers\BaseController;
use App\Models\{Teacher, Tutor, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateUser extends BaseController
{
    public function create_parent(Request $request)
    {
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|min:9|max:9|unique:users,phone',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $code = rand(000000, 999999);
        // creation de l'utilisateur
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($code);
        $user->code = $code;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
		$user->role = 'parent';
		$user->watch_history = '[]';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }

        $user->save();

        //enregistrer le parent dans la table tuteur
        $tutor = new Tutor();
        $tutor->school_id = 1;
        $tutor->user_id = $user->id;
        $tutor->save();

        $response = array(
            'status' => true,
            'notification' => 'parent_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function create_accountant(Request $request)
    {
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|min:9|max:9|unique:users,phone',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $code = rand(000000, 999999);
        // creation de l'utilisateur
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($code);
        $user->code = $code;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
		$user->role = 'accountant';
		$user->watch_history = '[]';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }


        $user->save();

        $response = array(
            'status' => true,
            'notification' => 'accountant_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function create_librarian(Request $request)
    {
        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|min:9|max:9|unique:users,phone',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $code = rand(000000, 999999);
        // creation de l'utilisateur
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($code);
        $user->code = $code;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
		$user->role = 'librarian';
		$user->watch_history = '[]';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }


        $user->save();

        $response = array(
            'status' => true,
            'notification' => 'librarian_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function create_admin(Request $request)
    {

        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            // 'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9|unique:users,phone',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'string'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return $this->sendError($validator->errors(), 422);
        }

        $code = rand(000000, 999999);
        // creation de l'utilisateur
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($code);
        $user->code = $code;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
		$user->role = 'admin';
		$user->watch_history = '[]';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/users'),$filename);
            $user->image = 'upload/users/'.$filename;
        }


        $user->save();

        $response = array(
            'status' => true,
            'notification' => 'admin_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function create_teacher(Request $request)
    {

        $customMessages = [
            'email.unique' => __('sorry_this_email_has_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9|unique:users,phone',
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

        $code = rand(000000, 999999);
        // creation de l'utilisateur
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($code);
        $user->code = $code;
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
    		$user->image = 'upload/users/'.$filename;
    	}

        $user->save();

        // enregistrer l'enseignant
        $teacher = new Teacher();
        $teacher->user_id = $user->id;
        $teacher->about = $request->about;
        $teacher->social_links = json_encode([ $request->facebook_link, $request->twitter_link, $request->linkedin_link ]);
        $teacher->department_id = $request->department_id;
        $teacher->designation = $request->designation;
        $teacher->show_on_website = $request->show_on_website;
        $teacher->save();

        $response = array(
            'status' => true,
            'notification' => 'teacher_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function single_student_create(Request $request)
    {
        # code...
    }
}
