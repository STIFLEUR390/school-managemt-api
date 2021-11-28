<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\{BaseController, Controller};
use App\Http\Resources\SuperAdmin\UserResource;
use App\Models\User;
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
            $users = User::whereRole($request->role)->withTrashed()->get();
        } else {
            $users = User::all();
        }

        // $users = (isset($request->role) && !empty($request->role)) ? User::whereRole($request->role)->get() : User::all();
        // return UserResource::collection($users);
        return $this->sendResponse(UserResource::collection($users), 'all_users');
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

        // return response()->json($response);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->sendResponse( new UserResource($user));
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

        if ($request->role == "teacher") {
            $response = $updateUser->update_teacher($request, $id);
        }
        
        if ($request->role == "librarian") {
            $response = $updateUser->update_librarian($request, $id);
        }
        
        if ($request->role == "accountant") {
            $response = $updateUser->update_accountant($request, $id);
        }
        
        if ($request->role == "parent") {
            $response = $updateUser->update_parent($request, $id);
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
