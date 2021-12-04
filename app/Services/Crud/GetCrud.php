<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Http\Resources\SuperAdmin\ClasseResource;
use App\Models\{Classe, Section, Syllabuse};
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class GetCrud extends BaseController
{
    public function getClasse()
    {
        $classes = Classe::with('sections')->where('school_id', 1)->get();
        return $this->sendResponse($classes);
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

    public function getSyllabusById($id)
    {
        $syllabus = Syllabuse::whereId($id)->firstOrFail();
        return $this->sendResponse($syllabus);
    }
}