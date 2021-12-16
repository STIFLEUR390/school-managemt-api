<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Http\Resources\SuperAdmin\{ClasseResource, ClassRoomResource, DepartmentResource, SubjectResource, SyllabusResource};
use App\Models\{Classe, ClassRoom, Department, Section, SessionApp, Subject, Syllabuse};
use Illuminate\Http\Request;

class GetCrud extends BaseController
{
    public function getClasse()
    {
        $classes = Classe::with('sections')->where('school_id', 1)->get();
        return $this->sendResponse(ClasseResource::collection($classes));
    }

    public function getClasseById($id)
    {
        // $classe = Classe::findOrFail($id);
        $classe = Classe::with('sections')->whereId($id)->get()->first();
        return $this->sendResponse(new ClasseResource($classe));
    }

    public function getSession(Request $request)
    {
        if ($request->type == 'class') {
            $sessions = Section::where('class_id', $request->id)->get();
        } else {
            $sessions = Section::whereId( $request->id)->get();
        }

        return $this->sendResponse(new ClasseResource($sessions));
    }

    public function getClasseromm()
    {
        $classrooms = ClassRoom::all();

        return $this->sendResponse(ClassRoomResource::collection($classrooms));
    }

    public function getClasserommById($id)
    {
        $classrooms = ClassRoom::findOrFail($id);

        return $this->sendResponse(new ClassRoomResource($classrooms));
    }

    public function getSyllabusById($id)
    {
        $syllabus = Syllabuse::whereId($id)->firstOrFail();
        return $this->sendResponse(new SyllabusResource($syllabus));
    }

    public function getSubject($request)
    {
        $subjects = Subject::where('class_id', $request->class_id)->where('session', $this->active_session()->name)->get();
        return $this->sendResponse(SubjectResource::collection($subjects));
    }

    public function getSubjectById($id)
    {
        $subject = Subject::findOrFail($id);
        return $this->sendResponse(new SubjectResource($subject));
    }
    public function getDepartment()
    {
        $departments = Department::all();
        return $this->sendResponse(DepartmentResource::collection($departments));
    }

    public function getDepartmentById($id)
    {
        $department = Department::findOrFail($id);
        return $this->sendResponse(new DepartmentResource($department));
    }

    public function active_session()
    {
        $session_active = SessionApp::where('status', 1)->firstOrFail();

        return $session_active;
    }
}
