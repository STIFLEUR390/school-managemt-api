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
        } else if ($request->getData == 'classroom') {
            $response = $crud->getClasseromm();
        } else if ($request->getData == 'department') {
            $response = $crud->getDepartment();
        } else if ($request->getData == 'subject') {
            $response = $crud->getSubject($request);
        }
        else {
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
        } else if ($request->getData == 'classroom') {
            $response = $crud->create_class_room($request);
        } else if ($request->getData == 'department') {
            $response = $crud->create_departement($request);
        } else if ($request->getData == 'subject') {
            $response = $crud->create_subject($request);
        }
         else {
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
        } else if ($request->getData == 'classroom') {
            $response = $crud->getClasserommById($id);
        } else if ($request->getData == 'department') {
            $response = $crud->getDepartmentById($id);
        } else if ($request->getData == 'subject') {
            $response = $crud->getSubjectById($id);
        } else if ($request->getData == 'class_session') {
            $response = $crud->getSectionByClassId($id);
        }
        else {
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
        } else if ($request->getData == 'classroom') {
            $response = $crud->update_class_room($request, $id);
        } else if ($request->getData == 'department') {
            $response = $crud->update_departement($request, $id);
        } else if ($request->getData == 'subject') {
            $response = $crud->update_subject($request, $id);
        }  else if ($request->getData == 'class_section') {
            $response = $crud->update_section($request, $id);
        }
        else {
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
        } else if($request->getData == 'classroom') {
            $response = $crud->delete_class_room($id);
        } else if ($request->getData == 'department') {
            $response = $crud->delete_department($id);
        } else if ($request->getData == 'subject') {
            $response = $crud->delete_subject($id);
        }
        else {
            $error = "aucune donnée";
            $response = $this->sendError($error);
        }

        return $response;
    }
}
