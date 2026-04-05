@extends('layouts.admin')
@section('title', 'Teacher Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Teacher Details</h1>
        </div>

        <div class="card mb-5">
            <div class="card-body">
                <div class="d-flex flex-wrap flex-sm-nowrap gap-7">
                    <div class="symbol symbol-100px">
                        <div class="symbol-label fs-2 bg-light-info text-info fw-bold" style="font-size:3rem!important">
                            {{ strtoupper(substr($teacher->name ?? $teacher->email, 0, 1)) }}
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h2 class="text-gray-900 fs-2 fw-bold mb-1">{{ $teacher->name }}</h2>
                        <div class="text-muted mb-1">{{ $teacher->email }}</div>
                        @if($teacher->specialty)<div class="text-muted mb-3">{{ $teacher->specialty }}</div>@endif
                        <div class="d-flex gap-2 flex-wrap mb-4">
                            @if($teacher->is_verified)<span class="badge badge-light-success fs-7">Verified</span>
                            @else<span class="badge badge-light-warning fs-7">Not Verified</span>@endif
                            @if($teacher->university)<span class="badge badge-light-primary fs-7">{{ $teacher->university->name }}</span>@endif
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{ route('admin.teachers.edit', $teacher->teacher_id) }}" class="btn btn-info">Edit</a>
                            <form method="POST" action="{{ route('admin.teachers.toggle-verified', $teacher->teacher_id) }}">
                                @csrf
                                <button type="submit" class="btn btn-{{ $teacher->is_verified ? 'warning' : 'success' }}">{{ $teacher->is_verified ? 'Unverify' : 'Verify' }}</button>
                            </form>
                            <form method="POST" action="{{ route('admin.teachers.destroy', $teacher->teacher_id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete">Delete</button>
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
                    <div class="col-6"><span class="text-muted">Teacher ID:</span><br><code>{{ $teacher->teacher_id }}</code></div>
                    <div class="col-6"><span class="text-muted">University:</span><br>{{ $teacher->university?->name ?? '—' }}</div>
                    <div class="col-6"><span class="text-muted">Created:</span><br>{{ $teacher->created_at?->format('M d, Y H:i') ?? '—' }}</div>
                </div>
            </div>
        </div>

        <div class="mt-3"><a href="{{ route('admin.teachers.index') }}" class="btn btn-light">← Back to Teachers</a></div>
    </div>
</div>
@endsection
