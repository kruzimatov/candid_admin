<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $query = University::withCount(['students', 'teachers']);
        if ($request->search) {
            $query->where('name', 'ilike', '%' . $request->search . '%');
        }
        $universities = $query->orderBy('name')->paginate(15)->withQueryString();
        return view('admin.universities.index', compact('universities'));
    }

    public function create()
    {
        return view('admin.universities.form', ['university' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:160',
            'location' => 'required|string',
        ]);
        University::create([
            'id'       => (string) Str::uuid(),
            'name'     => $data['name'],
            'location' => $data['location'],
            'admin_id' => (string) Str::uuid(),
            'is_active'=> true,
        ]);
        return redirect()->route('admin.universities.index')->with('success', 'University created.');
    }

    public function show(string $id)
    {
        $university = University::withCount(['students', 'teachers'])->findOrFail($id);
        $students   = $university->students()->orderBy('created_at', 'desc')->limit(10)->get();
        $teachers   = $university->teachers()->orderBy('created_at', 'desc')->limit(10)->get();
        return view('admin.universities.show', compact('university', 'students', 'teachers'));
    }

    public function edit(string $id)
    {
        $university = University::findOrFail($id);
        return view('admin.universities.form', compact('university'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:160',
            'location' => 'required|string',
        ]);
        University::findOrFail($id)->update($data);
        return redirect()->route('admin.universities.show', $id)->with('success', 'University updated.');
    }

    public function toggleActive(string $id)
    {
        $university = University::findOrFail($id);
        $university->update(['is_active' => !$university->is_active]);
        return back()->with('success', 'University status updated.');
    }

    public function destroy(string $id)
    {
        University::findOrFail($id)->delete();
        return redirect()->route('admin.universities.index')->with('success', 'University deleted.');
    }
}
