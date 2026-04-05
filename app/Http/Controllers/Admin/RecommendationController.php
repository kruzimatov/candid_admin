<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $query = Recommendation::with(['student', 'teacher', 'university']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->terminated !== null && $request->terminated !== '') {
            $query->where('is_terminated', $request->terminated === '1');
        }

        $recommendations = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.recommendations.index', compact('recommendations'));
    }

    public function show(string $id)
    {
        $recommendation = Recommendation::with(['student', 'teacher', 'university'])->findOrFail($id);
        return view('admin.recommendations.show', compact('recommendation'));
    }

    public function destroy(string $id)
    {
        Recommendation::findOrFail($id)->delete();
        return redirect()->route('admin.recommendations.index')->with('success', 'Recommendation deleted.');
    }
}
