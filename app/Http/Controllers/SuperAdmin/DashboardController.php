<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\DailyAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function __invoke()
    {
        //'superadmin','accountant','admin','librarian','parent','student','teacher'
        $teatchers = User::whereRole('teacher')->get()->count();
        // $asuperadmindmin = User::whereRole('superadmin')->get()->count();
        $accountant = User::whereRole('accountant')->get()->count();
        // $admin = User::whereRole('admin')->get()->count();
        $librarian = User::whereRole('librarian')->get()->count();
        $parent = User::whereRole('parent')->get()->count();
        $student = User::whereRole('student')->get()->count();

        $daily_attendances = DailyAttendance::where('timestamp', strtotime(date('Y-m-d')))->where('school_id', 1)->where('status', 1)->get();


        $data = [
            'teachers_count' => $teatchers,
            'student_count' => $student,
            'employee_count' => $librarian + $accountant,
            'parent_count' => $parent,
            'daily_attendances' => $daily_attendances,
        ];
        
        return $this->sendResponse($data);
    }
}
