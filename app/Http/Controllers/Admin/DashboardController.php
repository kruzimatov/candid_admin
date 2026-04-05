<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Message;
use App\Models\Project;
use App\Models\Recommendation;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\University;
use App\Models\User;
use App\Models\Vacancy;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'           => User::count(),
            'students'        => Student::count(),
            'teachers'        => Teacher::count(),
            'employers'       => Employer::count(),
            'universities'    => University::count(),
            'projects'        => Project::count(),
            'vacancies'       => Vacancy::count(),
            'recommendations' => Recommendation::count(),
            'messages'        => Message::count(),
        ];

        $recentStudents        = Student::with('university')->orderBy('created_at', 'desc')->limit(5)->get();
        $recentVacancies       = Vacancy::orderBy('created_at', 'desc')->limit(5)->get();
        $recentRecommendations = Recommendation::with(['student', 'teacher'])->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentStudents', 'recentVacancies', 'recentRecommendations'));
    }
}
