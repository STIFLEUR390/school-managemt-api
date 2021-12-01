<?php

namespace App\Services\Crud;

use App\Http\Controllers\BaseController;
use App\Models\{Classe, Section, Syllabuse};
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class GetCrud extends BaseController
{
    public function getClasse()
    {
        $classes = Classe::where('school_id', 1)->get();
        return $this->sendResponse($classes);
    }

    public function getClasseById($id)
    {
        $classe = Classe::where('school_id', 1)->whereId($id)->firstOrFail();
        return $this->sendResponse($classe);
    }

    public function getSession(Request $request)
    {
        if ($request->type == 'class') {
            $sessions = Section::where('class_id', $request->id)->get();
        } else {
            $sessions = Section::whereId( $request->id)->get();
        }

        return $this->sendResponse($sessions);
    }

    public function getSyllabusById($id)
    {
        $syllabus = Syllabuse::whereId($id)->firstOrFail();
        return $this->sendResponse($syllabus);
    }
}