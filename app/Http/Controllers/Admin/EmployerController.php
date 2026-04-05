<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        $query = Employer::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'ilike', '%' . $request->search . '%')
                  ->orWhere('email', 'ilike', '%' . $request->search . '%')
                  ->orWhere('company', 'ilike', '%' . $request->search . '%');
            });
        }

        $employers = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.employers.index', compact('employers'));
    }

    public function create()
    {
        return view('admin.employers.form', ['employer' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'company'  => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $userId     = (string) Str::uuid();
        $employerId = (string) Str::uuid();

        User::create([
            'user_id'   => $userId,
            'role'      => 'employer',
            'email'     => $data['email'],
            'is_active' => true,
        ]);

        Employer::create([
            'id'       => $employerId,
            'name'     => $data['name'],
            'email'    => $data['email'],
            'company'  => $data['company'] ?? null,
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('admin.employers.index')->with('success', 'Employer created.');
    }

    public function show(string $id)
    {
        $employer = Employer::with('vacancies')->findOrFail($id);
        return view('admin.employers.show', compact('employer'));
    }

    public function edit(string $id)
    {
        $employer = Employer::findOrFail($id);
        return view('admin.employers.form', compact('employer'));
    }

    public function update(Request $request, string $id)
    {
        $employer = Employer::findOrFail($id);
        $data     = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:employers,email,' . $id . ',id',
            'company' => 'nullable|string|max:255',
        ]);
        $employer->update([
            'name'    => $data['name'],
            'email'   => $data['email'],
            'company' => $data['company'] ?? null,
        ]);
        return redirect()->route('admin.employers.show', $id)->with('success', 'Employer updated.');
    }

    public function destroy(string $id)
    {
        Employer::findOrFail($id)->delete();
        return redirect()->route('admin.employers.index')->with('success', 'Employer deleted.');
    }
}
