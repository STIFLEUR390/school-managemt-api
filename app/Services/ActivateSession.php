<?php

namespace App\Services;

use App\Models\Section;
use Illuminate\Http\Request;

class ActivateSession
{
   public function active_session(Request $request)
   {
       // desactiver la session précedente
       $section_active = Section::whereStatus(1)->first();
       $section_active->status = 0;
       $section_active->save();

       // activation de la nouvelle section
       $section = Section::findOrFail($request->session_id);
       $section->status = 1;
       $section->save();
   }
}