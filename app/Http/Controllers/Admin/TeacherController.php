<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::with('university');
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('email', 'ilike', '%' . $request->search . '%')
                  ->orWhere('specialty', 'ilike', '%' . $request->search . '%')
                  ->orWhere('name', 'ilike', '%' . $request->search . '%');
            });
        }
        if ($request->university_id) {
            $query->where('university_id', $request->university_id);
        }
        if ($request->verified !== null && $request->verified !== '') {
            $query->where('is_verified', $request->verified === '1');
        }
        $teachers     = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $universities = University::orderBy('name')->get();
        return view('admin.teachers.index', compact('teachers', 'universities'));
    }

    public function create()
    {
        $universities = University::orderBy('name')->get();
        return view('admin.teachers.form', ['teacher' => null, 'universities' => $universities]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'university_id' => 'required|exists:universities,id',
            'specialty'     => 'nullable|string|max:120',
            'password'      => 'required|string|min:6',
            'is_verified'   => 'boolean',
        ]);

        $userId    = (string) Str::uuid();
        $teacherId = (string) Str::uuid();

        User::create([
            'user_id'   => $userId,
            'role'      => 'teacher',
            'email'     => $data['email'],
            'is_active' => true,
        ]);

        Teacher::create([
            'teacher_id'    => $teacherId,
            'user_id'       => $userId,
            'university_id' => $data['university_id'],
            'name'          => $data['name'],
            'email'         => $data['email'],
            'specialty'     => $data['specialty'] ?? null,
            'password'      => bcrypt($data['password']),
            'is_verified'   => $request->boolean('is_verified'),
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created.');
    }

    public function show(string $id)
    {
        $teacher = Teacher::with('university')->findOrFail($id);
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(string $id)
    {
        $teacher      = Teacher::findOrFail($id);
        $universities = University::orderBy('name')->get();
        return view('admin.teachers.form', compact('teacher', 'universities'));
    }

    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $data    = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:teachers,email,' . $id . ',teacher_id',
            'university_id' => 'required|exists:universities,id',
            'specialty'     => 'nullable|string|max:120',
            'is_verified'   => 'boolean',
        ]);
        $teacher->update([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'university_id' => $data['university_id'],
            'specialty'     => $data['specialty'] ?? null,
            'is_verified'   => $request->boolean('is_verified'),
        ]);
        return redirect()->route('admin.teachers.show', $id)->with('success', 'Teacher updated.');
    }

    public function toggleVerified(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update(['is_verified' => !$teacher->is_verified]);
        return back()->with('success', 'Teacher verification status updated.');
    }

    public function destroy(string $id)
    {
        Teacher::findOrFail($id)->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted.');
    }
}
