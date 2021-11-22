<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuperAdmin\UserResource;
use App\Models\User;
use App\Services\CreateUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->role) && !empty($request->role)) {
            $users = User::whereRole($request->role)->get();
        } else {
            $users = User::all();
        }

        // $users = (isset($request->role) && !empty($request->role)) ? User::whereRole($request->role)->get() : User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateUser $newUser)
    {
        // 'superadmin','accountant','admin','librarian','parent','student','teacher'
        if ($request->role == "admin") {
            $response = $newUser->create_admin($request);
        }

        if ($request->role == "teacher") {
            $response = $newUser->create_teacher($request);
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
