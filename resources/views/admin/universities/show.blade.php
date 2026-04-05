@extends('layouts.admin')
@section('title', 'University Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">{{ $university->name }}</h1>
        </div>

        <div class="card mb-5">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-5">
                    <div>
                        <h2 class="text-gray-900 fw-bold fs-2 mb-2">{{ $university->name }}</h2>
                        @if($university->location)<div class="text-muted mb-3">{{ $university->location }}</div>@endif
                        <div class="d-flex gap-3 mt-3">
                            <div class="bg-light rounded px-5 py-3 text-center"><div class="fs-2 fw-bold text-primary">{{ $university->students_count }}</div><div class="text-muted fs-7">Students</div></div>
                            <div class="bg-light rounded px-5 py-3 text-center"><div class="fs-2 fw-bold text-info">{{ $university->teachers_count }}</div><div class="text-muted fs-7">Teachers</div></div>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.universities.edit', $university->id) }}" class="btn btn-info">Edit</a>
                        <form method="POST" action="{{ route('admin.universities.toggle-active', $university->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-{{ $university->is_active ? 'warning' : 'success' }}">{{ $university->is_active ? 'Deactivate' : 'Activate' }}</button>
                        </form>
                        <form method="POST" action="{{ route('admin.universities.destroy', $university->id) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Recent Students</h3></div>
                    <div class="card-body">
                        @forelse($students as $s)
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-35px me-3"><div class="symbol-label bg-light-success text-success fw-bold">{{ strtoupper(substr($s->first_name, 0, 1)) }}</div></div>
                            <div><a href="{{ route('admin.students.show', $s->student_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $s->first_name }} {{ $s->last_name }}</a><div class="text-muted fs-7">{{ $s->email }}</div></div>
                        </div>
                        @empty<div class="text-center text-muted py-5">No students yet.</div>@endforelse
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Recent Teachers</h3></div>
                    <div class="card-body">
                        @forelse($teachers as $t)
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-35px me-3"><div class="symbol-label bg-light-info text-info fw-bold">{{ strtoupper(substr($t->name ?? $t->email, 0, 1)) }}</div></div>
                            <div><a href="{{ route('admin.teachers.show', $t->teacher_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $t->name }}</a><div class="text-muted fs-7">{{ $t->specialty ?? 'No specialty' }}</div></div>
                        </div>
                        @empty<div class="text-center text-muted py-5">No teachers yet.</div>@endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5"><a href="{{ route('admin.universities.index') }}" class="btn btn-light">← Back to Universities</a></div>
    </div>
</div>
@endsection
