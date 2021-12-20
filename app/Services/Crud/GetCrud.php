<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Select2\SelectResource;
use App\Http\Resources\SuperAdmin\{ClasseResource, ClassRoomResource, DepartmentResource, SubjectResource, SyllabusResource, TeacherPermissionResource, TeacherResource};
use App\Models\{Classe, ClassRoom, Department, Section, SessionApp, Subject, Syllabuse, TeacherPermission};
use Illuminate\Http\Request;

class GetCrud extends BaseController
{
    public function getClasse()
    {
        $classes = Classe::with('sections')->where('school_id', 1)->get();
        return $this->sendResponse(ClasseResource::collection($classes));
    }

    public function getClasseForSelect()
    {
        $classes = Classe::where('school_id', 1)->get();
        return $this->sendResponse(SelectResource::collection($classes));
    }

    public function getDepartmentForSelect()
    {
        $departments = Department::where('school_id', 1)->get();
        return $this->sendResponse(SelectResource::collection($departments));
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
        $subject = Subject::with(['classe'])->whereId($id)->first();
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

    public function getSectionByClassId($class_id)
    {
        $sections = Section::where('class_id', $class_id)->get();
        $names = [];
        foreach ($sections as $value) {
            $names[] = $value->name;
        }
        $section_names = implode(',', $names);

        return $this->sendResponse($section_names);
    }

    public function getTeacherPermission($teacher_id)
    {
        $permissions = TeacherPermission::with(['section', 'classe', 'teacher.user'])->where('teacher_id', $teacher_id)->get();
        return $this->sendResponse(TeacherPermissionResource::collection($permissions));
    }

    public function getPermissionByClass($req)
    {
        $class_id = $req->class_id;
        $section_id = $req->section_id;
        $teacher_id = $req->teacher_id;

        $search = ['class_id' => $class_id, 'section_id' => $section_id, 'teacher_id' => $teacher_id];
        $permissions = TeacherPermission::with(['section', 'classe', 'teacher.user'])->where($search)->get();

        return $this->sendResponse(TeacherPermissionResource::collection($permissions));
    }
}
