@extends('layouts.admin')
@section('title', 'Student Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Student Details</h1>
        </div>

        <div class="card mb-5">
            <div class="card-body">
                <div class="d-flex flex-wrap flex-sm-nowrap gap-7">
                    <div class="symbol symbol-100px">
                        <div class="symbol-label fs-2 bg-light-success text-success fw-bold" style="font-size:3rem!important">
                            {{ strtoupper(substr($student->first_name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h2 class="text-gray-900 fs-2 fw-bold mb-1">{{ $student->first_name }} {{ $student->last_name }}</h2>
                        <div class="text-muted mb-3">{{ $student->email }}</div>
                        @if($student->university)
                            <span class="badge badge-light-primary">{{ $student->university->name }}</span>
                        @endif
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('admin.students.edit', $student->student_id) }}" class="btn btn-info">Edit Student</a>
                            <form method="POST" action="{{ route('admin.students.destroy', $student->student_id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete">Delete Student</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title">Information</h3></div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-6"><span class="text-muted">Student ID:</span><br><code>{{ $student->student_id }}</code></div>
                    <div class="col-6"><span class="text-muted">University:</span><br><strong>{{ $student->university?->name ?? '—' }}</strong></div>
                    <div class="col-6"><span class="text-muted">Created:</span><br>{{ $student->created_at?->format('M d, Y H:i') ?? '—' }}</div>
                </div>
            </div>
        </div>

        <div class="mt-3"><a href="{{ route('admin.students.index') }}" class="btn btn-light">← Back to Students</a></div>
    </div>
</div>
@endsection
