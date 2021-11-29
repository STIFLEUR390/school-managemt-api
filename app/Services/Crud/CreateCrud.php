<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Models\{Classe, ClassRoom, Department, Section, Session, Subject};
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class CreateCrud extends BaseController
{
    public function create_class(Request $request)
    {
        // création de la classe
        $class = new Classe();
        $class->name = $request->name;
        $class->save();

        // création de la section
        $section = new Section();
        $section->name = 'A';
        $section->class_id = $class->id;
        $section->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_added_successfully',
            'name' => __('class')
        ];

        return $this->sendResponse($response);
    }

    public function create_class_room(Request $request)
    {
        $class_rom = new ClassRoom();
        $class_rom->name = $request->name;
        $class_rom->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_added_successfully',
            'name' => __('class_room')
        ];

        return $this->sendResponse($response);
    }

    public function create_session(Request $request)
    {
        $class_rom = new Session();
        $class_rom->name = $request->name;
        $class_rom->save();

        $response = [
            'status' => true,
            'notification' => 'section_has_been_added_successfully',
        ];

        return $this->sendResponse($response);
    }

    public function create_subject(Request $request)
    {
        $class_rom = new Subject();
        $class_rom->name = $request->name;
        $class_rom->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_added_successfully',
            'name' => __('subject')
        ];

        return $this->sendResponse($response);
    }

    public function create_departement(Request $request)
    {
        $departement = new Department();
        $departement->name = $request->name;
        $departement->save();

        $response = [
            'status' => true,
            'notification' => 'department_has_been_added_successfully',
        ];

        return $this->sendResponse($response);
    }
    
}