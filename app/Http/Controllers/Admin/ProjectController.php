<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['student', 'teacher', 'university']);

        if ($request->search) {
            $query->where('title', 'ilike', '%' . $request->search . '%');
        }

        if ($request->approved !== null && $request->approved !== '') {
            $query->where('is_approved', $request->approved === '1');
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    public function show(string $id)
    {
        $project = Project::with(['student', 'teacher', 'university'])->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    public function toggleApproved(string $id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_approved' => !$project->is_approved]);
        return back()->with('success', 'Project approval status updated.');
    }

    public function destroy(string $id)
    {
        Project::findOrFail($id)->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }
}
