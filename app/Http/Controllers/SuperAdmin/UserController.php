<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\{BaseController, Controller};
use App\Http\Resources\SuperAdmin\{StudentResource, TeacherResource, UserResource};
use App\Models\{Student, Teacher, User};
use App\Services\User\{CreateUser, DeleteUser, UpdateUser};
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->role) && !empty($request->role)) {
            if ($request->role == 'teacher') {
                $users = Teacher::with(['department', 'permissions.classe', 'user' => function($q) {
                    $q->withTrashed()->get();
                }])->get();
                $response = TeacherResource::collection($users);
            }else if($request->role == 'student'){
                $users = Student::whereHas('enrols', function ($query) use ($request) {
                    $query->where('class_id', $request->class_id)->where('section_id', $request->section_id);
                })->with(['enrols.classes', 'enrols.section', 'tutor.user', 'user' => function($q) {
                    $q->withTrashed()->get();
                }])->get();
                $response = StudentResource::collection($users);
            }else {
                $users = User::whereRole($request->role)->withTrashed()->get();
                $response = UserResource::collection($users);
            }

        } else {
            $users = User::all();
            $response = UserResource::collection($users);
        }

        // $users = (isset($request->role) && !empty($request->role)) ? User::whereRole($request->role)->get() : User::all();
        // return UserResource::collection($users);
        return $this->sendResponse($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateUser $newUser)
    {
        // 'accountant','librarian','parent','student','teacher'
        if ($request->role == "admin") {
            $response = $newUser->create_admin($request);
        }

        if ($request->role == "teacher") {
            $response = $newUser->create_teacher($request);
        }

        if ($request->role == "librarian") {
            $response = $newUser->create_librarian($request);
        }

        if ($request->role == "accountant") {
            $response = $newUser->create_accountant($request);
        }

        if ($request->role == "parent") {
            $response = $newUser->create_parent($request);
        }

        if ($request->role == "student" && $request->method == 'single') {
            $response = $newUser->single_student_create($request);
        }

        if ($request->role == "student" && $request->method == 'bulk') {
            $response = $newUser->bulk_student_create($request);
        }

        if ($request->role == "student" && $request->method == 'excel') {
            $response = $newUser->exel_student_create($request);
        }

        // return response()->json($response);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->role == 'teacher') {
            $user = User::with(['teacher.department'])->whereId($id)->first();
            $response = $this->sendResponse( new UserResource($user));
        }else if($request->role == 'student'){
            $user = Student::with(['enrols.classes', 'enrols.section', 'tutor.user', 'user' => function($q) {
                $q->withTrashed()->get();
            }])->whereId($id)->first();
            $response = new StudentResource($user);
        } else {
            $user = User::findOrFail($id);
            $response = $this->sendResponse( new UserResource($user));
        }
        return $response;
    }

    public function donwloadExcelToSubscripbeStudent(CreateUser $user)
    {
        $notification = [
            'fr' => env('APP_URL').'storage/excel_file/fr.student.generate.xlsx',
            'en' => env('APP_URL').'storage/excel_file/en.student.generate.xlsx',
        ];
        $response = [
            'status' => true,
            'notification' => $notification,
            'code' => 'successs'
        ];
        return $this->sendResponse($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateUser $updateUser)
    {
         // 'accountant','librarian','parent','student','teacher'
        if ($request->role == "admin") {
            $response = $updateUser->update_admin($request, $id);
        }

        else if ($request->role == "teacher") {
            $response = $updateUser->update_teacher($request, $id);
        }

        else if ($request->role == "librarian") {
            $response = $updateUser->update_librarian($request, $id);
        }

        else if ($request->role == "accountant") {
            $response = $updateUser->update_accountant($request, $id);
        }

        else if ($request->role == "parent") {
            $response = $updateUser->update_parent($request, $id);
        }

        else if ($request->role == "student") {
            $response = $updateUser->update_student($request);
        }
        else {
            // $response = $this->sendError('Erreur');
            $res = [
                "request" => $request->all(),
                "id" => $id
            ];

            $response = response()->json($res);
        }

         return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteUser $delUser)
    {
        $response = $delUser->delete_user($id);

        return $this->sendResponse($response);
    }

    public function restore($id, DeleteUser $delUser)
    {
        $response = $delUser->restore_user($id);

        return $this->sendResponse($response);
    }
}
