<?php

namespace App\Services\User;

use App\Http\Controllers\BaseController;
use App\Models\{Enrol, SessionApp, Student, Teacher, Tutor, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Str;

#Librairie phpoffice/phpspreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            'email.unique' => 'sorry_this_email_has_been_taken',
            'blood_group.required' => 'required_blood_group',
            'phone.unique' => 'sorry_this_phone_has_been_taken',
        ];

        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:6',
            'phone' => 'required|string|min:9|max:9|unique:users,phone',
            'gender' => 'required|in:male,female,others',
            'blood_group' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'address' => 'required|string',
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
        $user->birthday = $request->birthday;
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

        $tutor = User::with('tutor')->whereId($request->parent_id)->first();
        $student = new Student();
        $student->code = $this->matricule($user);
        $student->user_id = $user->id;
        $student->tutor_id = $tutor->tutor->id;
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
            'val.*.email.unique' => 'some_of_the_emails_have_been_taken'
        ];

        $rules = [
            'val.*.name' => 'required|string|min:3',
            'val.*.email' => 'required|email|unique:users,email',
            'val.*.gender' => 'required|in:male,female,others',
        ];

        $forValidate['val'] = $request->students;

        $validator = Validator::make($forValidate, $rules, $customMessages);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return $this->sendError($validator->errors(), 422);
        }

        foreach ($request->students as $value) {
            $code = rand(000000, 999999);
            $user = new User();
            $user->name = $value['name'];
            $user->email = $value['email'];
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->gender = $value['gender'];
            $user->role = 'student';
            $user->watch_history = '[]';
            $user->save();

            $tutor = User::with('tutor')->whereId($value['parent']['id'])->first();
            $student = new Student();
            $student->code = $this->matricule($user);
            $student->user_id = $user->id;
            $student->tutor_id = $tutor->tutor->id;
            $student->session_app = $this->active_session()->id;
            $student->save();

            $enrol = new Enrol();
            $enrol->student_id = $student->id;
            $enrol->class_id = $request->class_id;
            $enrol->section_id = $request->section_id;
            $enrol->session = $this->active_session()->id;
            $enrol->save();
        }

        $response = array(
            'status' => true,
            'notification' => 'students_added_successfully'
        );

        return $this->sendResponse($response);
    }

    public function exportXlsFileToCreateStudent()
    {
        /*ini_set('max_execution_time', 0);
        ini_set('memory_limit', '400M'); 

        $customer_data = [__('student_name'), __('email'), __('phone'), __('parent_id'), __('gender')."'male','female','others'"];
        try {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadsheet->getActiveSheet()->fromArray($customer_data);

            $excel_writer = new Xls($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachement;filename="Student.generate.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $excel_writer->save('php://output');
            exit();

        } catch (Exception $th) {
            return;
        }*/
        $notification = [
            'fr' => env('APP_URL').'excel_file/fr.student.generate.xlsx',
            'en' => env('APP_URL').'excel_file/en.student.generate.xlsx',
        ];
        $response = [
            'status' => true,
            'notification' => $notification,
            'code' => 'successs'
        ];
        return $this->sendResponse($response);
    }

    public function exel_student_create(Request $request)
    {

        $rules = [
            'excel' => 'required|file|mimes:xls,xlsx',
            'class_id' => 'required',
            'section_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $session_id = $this->active_session()->id;
        $role = 'student';

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return $this->sendError($validator->errors(), 422);
        }

        $file = $request->file('excel');

        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('E', $column_limit);
            $startcount = 2;

            if ($sheet->getCell('A2')->getValue()) {
                $all_email = $sheet->rangeToArray('B2:B'.$row_limit, null, true, true, false);
                $all_phone = $sheet->rangeToArray('C2:C'.$row_limit, null, true, true, false);
                $duplicate = DB::table('users')->whereIn('email', $all_email)->orWhereIn('phone', $all_phone)->get();
                if (count($duplicate) === 0) {
                    foreach ($row_range as $row) {
                        $name = $sheet->getCell('A'.$row)->getValue();
                        $email = $sheet->getCell('B'.$row)->getValue();
                        $phone = $sheet->getCell('C'.$row)->getValue();
                        $parent_id = $sheet->getCell('D'.$row)->getValue();
                        $gender= $sheet->getCell('E'.$row)->getValue();

                        $code = rand(000000, 999999);
                        $user = new User();
                        $user->name = $name;
                        $user->email = $email;
                        $user->password = bcrypt($code);
                        $user->code = $code;
                        $user->phone = $phone;
                        $user->gender = $gender;
                        $user->role = $role;
                        $user->watch_history = '[]';
                        $user->save();

                        $tutor = User::with('tutor')->whereId($parent_id)->first();
                        $student = new Student();
                        $student->code = $this->matricule($user);
                        $student->user_id = $user->id;
                        $student->tutor_id = $tutor->tutor->id;
                        $student->session_app = $this->active_session()->id;
                        $student->save();

                        $enrol = new Enrol();
                        $enrol->student_id = $student->id;
                        $enrol->class_id = $class_id;
                        $enrol->section_id = $section_id;
                        $enrol->session = $session_id;
                        $enrol->save();

                        $startcount++;

                        $response = [
                            'status' => true,
                            'notification' => 'students_added_successfully',
                            'code' => 'successs'
                        ];
                    }
                } else {
                    $response = [
                        'status' => true,
                        'notification' => 'some_of_the_emails_have_been_taken',
                        'code' => 'warning'
                    ];
                }
            } else {
                $response = [
                    'status' => true,
                    'notification' => 'no data in excel file',
                    'code' => 'warning'
                ];
            }

        } catch (Exception $th) {
            $error_code = $th->errorInfo[1];

            $response = [
                'status' => false,
                'notification' => 'The was a problem uploading the data !',
                'code' => 'danger'
            ];
        }

        if ($response['status'] === true) {
            return $this->sendResponse($response);
        } else {
            return $this->sendError($response);
        }

    }

    public function matricule($user)
    {
        // $uuid = Str::uuid();
        $code = rand(100000, 999999);
        $year = date('Y');

        $matricule = $year.$user->id.$code;
        return $matricule;
    }

    public function active_session()
    {
        $session_active = SessionApp::where('status', 1)->firstOrFail();

        return $session_active;
    }
}
