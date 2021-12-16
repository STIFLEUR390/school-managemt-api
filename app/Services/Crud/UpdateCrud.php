<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Models\{Classe, ClassRoom, Department, Routine, Section, SessionApp, Subject};
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class UpdateCrud extends BaseController
{
    public function update_class(Request $request, $id)
    {
        // mise a jour de la classe
        $class = Classe::findOrFail($id);
        $class->name = $request->name;
        $class->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_updated_successfully',
            'name' => __('class')
        ];

        return $this->sendResponse($response);
    }

    public function update_section(Request $request, $id)
    {
        $sections = explode(",", $request->name);
        Section::where('class_id', $id)->delete();

        foreach ($sections as $name) {
            $section = new Section();
            $section->name = $name;
            $section->class_id = $id;
            $section->save();
        }

        $response = [
            'status' => true,
            'notification' => 'section_list_updated_successfully'
        ];

        return $this->sendResponse($response);
    }

    public function update_class_room(Request $request, $id)
    {
        $class_rom = ClassRoom::findOrFail($id);
        $class_rom->name = $request->name;
        $class_rom->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_updated_successfully',
            'name' => __('class_room')
        ];

        return $this->sendResponse($response);
    }

    public function update_session(Request $request, $id)
    {
        $class_rom = SessionApp::findOrfail($id);
        $class_rom->name = $request->name;
        $class_rom->save();

        $response = [
            'status' => true,
            'notification' => 'section_has_been_updated_successfully',
        ];

        return $this->sendResponse($response);
    }

    public function update_subject(Request $request, $id)
    {
        $class_rom = Subject::findOrFail($id);
        $class_rom->name = $request->name;
        $class_rom->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_updated_successfully',
            'name' => __('subject')
        ];

        return $this->sendResponse($response);
    }

    public function update_departement(Request $request, $id)
    {
        $departement = Department::findOrFail($id);
        $departement->name = $request->name;
        $departement->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_updated_successfully',
            'name' => __('department')
        ];

        return $this->sendResponse($response);
    }

    public function create_routine(Request $request, $id)
    {
        $routine = Routine::findOrFail($id);
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
        $routine->save();

        $response = [
            'status' => true,
            'notification' => 'has_been_updated_successfully',
            'name' => __('routine')
        ];

        return $this->sendResponse($response);
    }

}
