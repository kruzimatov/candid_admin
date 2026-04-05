<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        $query = Vacancy::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('company', 'ilike', '%' . $request->search . '%')
                  ->orWhere('location', 'ilike', '%' . $request->search . '%');
            });
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->mode) {
            $query->where('mode', $request->mode);
        }

        if ($request->expired !== null && $request->expired !== '') {
            $query->where('is_expired', $request->expired === '1');
        }

        $vacancies = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function show(string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return view('admin.vacancies.show', compact('vacancy'));
    }

    public function destroy(string $id)
    {
        Vacancy::findOrFail($id)->delete();
        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy deleted.');
    }
}
