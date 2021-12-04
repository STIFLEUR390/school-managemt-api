<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Services\Crud\{CreateCrud, DeleteCrud, GetCrud, UpdateCrud};
use Illuminate\Http\Request;

class CrudController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GetCrud $crud)
    {
        if($request->getData == 'class') {
            $response = $crud->getClasse();
        } else {
            $error = "aucune donnée";
            $response = $this->sendError($error);
        }

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateCrud $crud)
    {
        if($request->getData == 'class') {
            $response = $crud->create_class($request);
        } else {
            $error = "aucune donnée";
            $response = $this->sendError($error);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request, GetCrud $crud)
    {
        if($request->getData == 'class') {
            $response = $crud->getClasseById($id);
        } else {
            $error = "aucune donnée";
            $response = $this->sendError($error);
        }

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateCrud $crud)
    {
        if($request->getData == 'class') {
            $response = $crud->update_class($request, $id);
        } else {
            $error = "aucune donnée";
            $response = $this->sendError($error);
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request, DeleteCrud $crud)
    {
        if($request->getData == 'class') {
            $response = $crud->delete_class($id);
        } else {
            $error = "aucune donnée";
            $response = $this->sendError($error);
        }

        return $response;
    }
}
