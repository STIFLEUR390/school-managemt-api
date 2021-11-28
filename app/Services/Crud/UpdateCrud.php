<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Models\{Classe, ClassRoom, Department, Section, Session, Subject};
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
        $sections = $request->sections;
        $secion_names = $request->name;

        foreach ($sections as $key => $value) {
            if ($value == 0) {
               $section = new Section();
               $section->class_id = $id;
               $section->name = $secion_names[$key];
               $section->save();
            }

            if ($value != 0 && $value != 'delete') {
                $section = Section::whereId($value)->where('class_id', $id)->first();
                $section->name = $secion_names[$key];
                $section->save();
            }

            $section_value = null;
            if (strpos($value, 'delete') == true) {
                $section_value = str_replace('delete', '', $value);
            }

            if ($value == $section_value.'delete') {
                Section::whereId($section_value)->where('class_id', $id)->firstOrFail()->delete();
            }
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
        $class_rom = Session::findOrfail($id);
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
    
}