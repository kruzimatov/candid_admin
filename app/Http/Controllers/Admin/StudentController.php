<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('university');
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'ilike', '%' . $request->search . '%')
                  ->orWhere('last_name', 'ilike', '%' . $request->search . '%')
                  ->orWhere('email', 'ilike', '%' . $request->search . '%');
            });
        }
        if ($request->university_id) {
            $query->where('university_id', $request->university_id);
        }
        $students     = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $universities = University::orderBy('name')->get();
        return view('admin.students.index', compact('students', 'universities'));
    }

    public function create()
    {
        $universities = University::orderBy('name')->get();
        return view('admin.students.form', ['student' => null, 'universities' => $universities]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:50',
            'last_name'     => 'required|string|max:50',
            'email'         => 'required|email|unique:users,email',
            'university_id' => 'required|exists:universities,id',
            'password'      => 'required|string|min:6',
        ]);

        $userId    = (string) Str::uuid();
        $studentId = (string) Str::uuid();

        User::create([
            'user_id'   => $userId,
            'role'      => 'student',
            'email'     => $data['email'],
            'is_active' => true,
        ]);

        Student::create([
            'student_id'    => $studentId,
            'user_id'       => $userId,
            'university_id' => $data['university_id'],
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created.');
    }

    public function show(string $id)
    {
        $student = Student::with('university')->findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    public function edit(string $id)
    {
        $student      = Student::findOrFail($id);
        $universities = University::orderBy('name')->get();
        return view('admin.students.form', compact('student', 'universities'));
    }

    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $data    = $request->validate([
            'first_name'    => 'required|string|max:50',
            'last_name'     => 'required|string|max:50',
            'email'         => 'required|email|unique:student,email,' . $id . ',student_id',
            'university_id' => 'required|exists:universities,id',
        ]);
        $student->update($data);
        return redirect()->route('admin.students.show', $id)->with('success', 'Student updated.');
    }

    public function destroy(string $id)
    {
        Student::findOrFail($id)->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted.');
    }
}
