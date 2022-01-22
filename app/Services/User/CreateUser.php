<?php

namespace App\Services\User;

use App\Http\Controllers\BaseController;
use App\Models\{Enrol, SessionApp, Student, Teacher, Tutor, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'email' => 'required|email|unique:users',
            // 'phone' => 'required|string|min:9|max:9|unique:users,phone',
            'phone' => 'required|unique:users,phone|phone:LENIENT,CM,mobile',
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
		$user->role = 'student';
		$user->watch_history = '[]';

        if ($request->file('image')) {
    		$file = $request->file('image');
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/users'),$filename);
    		$user->image = 'upload/users/'.$filename;
    	}

        $user->save();

        // enregistrer l'etudiant'


        $response = array(
            'status' => true,
            'notification' => 'teacher_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function single_student_create(Request $request)
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

        $student = new Student();
        $student->code = $this->matricule($user);
        $student->user_id = $user->id;
        $student->parent_id = $request->parent_id;
        $student->session_app = $this->active_session()->id;
        $student->save();

        $enrol = new Enrol();
        $enrol->student_id = $student->id;
        $enrol->class_id = $request->class_id;
        $enrol->section_id = $request->section_id;
        $enrol->session = $this->active_session()->id;
        $enrol->save();

        $response = array(
            'status' => true,
            'notification' => 'student_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function bulk_student_create(Request $request)
    {

        $customMessages = [
            'email.unique' => __('some_of_the_emails_have_been_taken'),
            'blood_group.required' => __('required_blood_group')
        ];

        /* $rules = [
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
        ]; */

        $rules = [
            'name' => 'array:name,required|string|min:3',
            'email' => 'array:name,required|email|unique:users,email',
            'phone' => 'array:name,required|string|min:9|max:9|unique:users,phone',
            // 'gender' => 'array:name,required|in:male,female,others',
            // 'blood_group' => 'array:name,required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            // 'address' => 'array:name,required|string',
            // 'about' => 'array:name,required|string',
            // 'facebook_link' => 'array:name,required|string',
            // 'twitter_link' => 'array:name,required|string',
            // 'linkedin_link' => 'array:name,required|string',
            // 'department_id' => 'array:name,required|string',
            // 'designation' => 'array:name,required|string',
            // 'show_on_website' => 'array:name,required|string',
            // 'image' => 'array:name,file|mimes:jpeg,bmp,png,jpg,gif'
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
        // $user->phone = $request->phone;
        $user->gender = $request->gender;
        // $user->blood_group = $request->blood_group;
        // $user->address = $request->address;
		$user->role = 'teacher';
		$user->watch_history = '[]';

        // if ($request->file('image')) {
    	// 	$file = $request->file('image');
    	// 	$filename = date('YmdHi').$file->getClientOriginalName();
    	// 	$file->move(public_path('upload/users'),$filename);
    	// 	$user->image = 'upload/users/'.$filename;
    	// }

        $user->save();

        $student = new Student();
        $student->code = $this->matricule($user);
        $student->user_id = $user->id;
        $student->parent_id = $request->parent_id;
        $student->session_app = $this->active_session()->id;
        $student->save();

        $enrol = new Enrol();
        $enrol->student_id = $student->id;
        $enrol->class_id = $request->class_id;
        $enrol->section_id = $request->section_id;
        $enrol->session = $this->active_session()->id;
        $enrol->save();

        $response = array(
            'status' => true,
            'notification' => 'students_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function matricule($user)
    {
        $uuid = Str::uuid();
        $year = date('Y');

        $matricule = $year.$user->id.$uuid;
        return $matricule;
    }

    public function active_session()
    {
        $session_active = SessionApp::where('status', 1)->firstOrFail();

        return $session_active;
    }
}
