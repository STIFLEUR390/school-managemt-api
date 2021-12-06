<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Models\{Classe, ClassRoom, Department, Routine, Section, Session, Subject, Syllabuse};
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
        $class_rom->session = $this->active_session();
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

    public function create_syllabus(Request $request)
    {
        $syllabus = new Syllabuse();
        $syllabus->title = $request->title;
        $syllabus->class_id = $request->class_id;
        $syllabus->section_id = $request->section_id;
        $syllabus->subject_id = $request->subject_id;
        $syllabus->session_id = $request->session_id;

        if ($request->file('syllabus_file')) {
            $file = $request->file('syllabus_file');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/syllabus'),$filename);
            $syllabus->file = 'upload/syllabus/'.$filename;
        }

		$syllabus->save();

        $response = [
            'status' => true,
            'notification' => 'syllabus_added_successfully',
        ];

        return $this->sendResponse($response);
    }

    public function create_routine(Request $request)
    {
        $routine = new Routine();
        $routine->class_id = $request->class_id;
        $routine->section_id = $request->section_id;
        $routine->subject_id = $request->subject_id;
        $routine->teacher_id = $request->teacher_id;
        $routine->room_id = $request->room_id;
        $routine->day = $request->day;
        $routine->starting_hour = $request->starting_hour;
        $routine->starting_minute = $request->starting_minute;
        $routine->ending_hour = $request->ending_hour;
        $routine->ending_minute = $request->ending_minute;
        $routine->session_id = $this->active_session();
        $routine->save();

        $response = [
            'status' => true,
            'notification' => 'class_routine_added_successfully',
        ];

        return $this->sendResponse($response);
    }

    public function active_session()
    {
        $session_active = Session::where('status', 1)->firstOrFail();
        
        return $session_active->id;
    }
    
}