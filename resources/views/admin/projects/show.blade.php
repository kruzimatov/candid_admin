@extends('layouts.admin')
@section('title', 'Project Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Project Details</h1>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <div>
                    <h3 class="card-title">{{ $project->title }}</h3>
                    <div class="d-flex gap-2 mt-1">
                        @if($project->is_approved)<span class="badge badge-light-success">Approved</span>
                        @else<span class="badge badge-light-warning">Pending</span>@endif
                        @if(!$project->is_active)<span class="badge badge-light-danger">Inactive</span>@endif
                    </div>
                </div>
                <div class="card-toolbar d-flex gap-3">
                    <form method="POST" action="{{ route('admin.projects.toggle-approved', $project->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-{{ $project->is_approved ? 'warning' : 'success' }}">{{ $project->is_approved ? 'Unapprove' : 'Approve' }}</button>
                    </form>
                    <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-md-4">
                        <label class="form-label text-muted">Student</label>
                        @if($project->student)
                        <div><a href="{{ route('admin.students.show', $project->student->student_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $project->student->first_name }} {{ $project->student->last_name }}</a></div>
                        @else<div class="text-muted">—</div>@endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted">Teacher</label>
                        @if($project->teacher)
                        <div><a href="{{ route('admin.teachers.show', $project->teacher->teacher_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $project->teacher->name }}</a></div>
                        @else<div class="text-muted">—</div>@endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted">University</label>
                        @if($project->university)
                        <div><a href="{{ route('admin.universities.show', $project->university->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $project->university->name }}</a></div>
                        @else<div class="text-muted">—</div>@endif
                    </div>
                    <div class="col-md-4"><label class="form-label text-muted">Created</label><div>{{ $project->created_at?->format('M d, Y H:i') ?? '—' }}</div></div>
                    <div class="col-12"><label class="form-label text-muted">Description</label><div class="text-gray-800">{{ $project->description ?: '—' }}</div></div>
                </div>
            </div>
        </div>

        <div class="mt-3"><a href="{{ route('admin.projects.index') }}" class="btn btn-light">← Back to Projects</a></div>
    </div>
</div>
@endsection
