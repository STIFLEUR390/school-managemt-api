<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Models\{Classe, ClassRoom, Department, Routine, Section, SessionApp, Subject, Syllabuse};
use Illuminate\Http\Request;

class DeleteCrud extends BaseController
{
    public function delete_class($id)
    {
        Section::where('class_id', $id)->firstOrFail()->delete();

        $classe = Classe::findOrFail($id);
        $classe->delete();

        $response = [
            'status' => true,
            'notification' => 'has_been_deleted_successfully',
            'name' => __('class')
        ];

        return $this->sendResponse($response);
    }

    public function delete_class_room($id)
    {
        $classe = ClassRoom::findOrFail($id);
        $classe->delete();

        $response = [
            'status' => true,
            'notification' => 'has_been_deleted_successfully',
            'name' => __('class_room')
        ];

        return $this->sendResponse($response);
    }

    public function delete_session($id)
    {
        $classe = SessionApp::findOrFail($id);
        $classe->delete();

        $response = [
            'status' => true,
            'notification' => 'section_has_been_deleted_successfully',
        ];

        return $this->sendResponse($response);
    }

    public function delete_subject($id)
    {
        $classe = Subject::findOrFail($id);
        $classe->delete();

        $response = [
            'status' => true,
            'notification' => 'has_been_deleted_successfully',
            'name' => __('subject')
        ];

        return $this->sendResponse($response);
    }

    public function delete_department($id)
    {
        $classe = Department::findOrFail($id);
        $classe->delete();

        $response = [
            'status' => true,
            'notification' => 'has_been_deleted_successfully',
            'name' => __('department')
        ];

        return $this->sendResponse($response);
    }

    public function delete_syllabus($id)
    {
        $syllabuse = Syllabuse::findOrFail($id);
        @unlink(public_path($syllabuse->file));
        $syllabuse->delete();

        $response = [
            'status' => true,
            'notification' => 'syllabus_deleted_successfully'
        ];

        return $this->sendResponse($response);
    }

    public function delete_routine($id)
    {
        $classe = Routine::findOrFail($id);
        $classe->delete();

        $response = [
            'status' => true,
            'notification' => 'has_been_deleted_successfully',
            'name' => __('routine')
        ];

        return $this->sendResponse($response);
    }

}
