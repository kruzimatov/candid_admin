@extends('layouts.admin')
@section('title', 'Recommendation Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Recommendation Details</h1>
        </div>

        @php $sc = match($recommendation->status) { 'done'=>'success','preparing'=>'warning','submitting'=>'info',default=>'secondary' }; @endphp

        <div class="card mb-5">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Recommendation</h3>
                    <div class="d-flex gap-2 mt-1">
                        <span class="badge badge-light-{{ $sc }} fs-7">{{ ucfirst($recommendation->status) }}</span>
                        @if($recommendation->is_terminated)<span class="badge badge-light-danger fs-7">Terminated</span>@endif
                        @if($recommendation->is_teacher_signed)<span class="badge badge-light-success fs-7">Teacher Signed</span>@endif
                    </div>
                </div>
                <div class="card-toolbar">
                    <form method="POST" action="{{ route('admin.recommendations.destroy', $recommendation->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-md-4">
                        <label class="form-label text-muted">Student</label>
                        @if($recommendation->student)
                        <div><a href="{{ route('admin.students.show', $recommendation->student->student_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $recommendation->student->first_name }} {{ $recommendation->student->last_name }}</a></div>
                        @else<div class="text-muted">—</div>@endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted">Teacher</label>
                        @if($recommendation->teacher)
                        <div><a href="{{ route('admin.teachers.show', $recommendation->teacher->teacher_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $recommendation->teacher->name }}</a></div>
                        @else<div class="text-muted">—</div>@endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted">University</label>
                        @if($recommendation->university)
                        <div><a href="{{ route('admin.universities.show', $recommendation->university->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $recommendation->university->name }}</a></div>
                        @else<div class="text-muted">—</div>@endif
                    </div>
                    <div class="col-md-4"><label class="form-label text-muted">Created</label><div>{{ $recommendation->created_at?->format('M d, Y H:i') ?? '—' }}</div></div>
                    <div class="col-md-4"><label class="form-label text-muted">Teacher Signed</label>
                        <div>@if($recommendation->is_teacher_signed)<span class="badge badge-light-success">Yes</span>@else<span class="badge badge-light-secondary">No</span>@endif</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Content</label>
                        <div class="text-gray-800 bg-light rounded p-5">{{ $recommendation->content ?: '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3"><a href="{{ route('admin.recommendations.index') }}" class="btn btn-light">← Back to Recommendations</a></div>
    </div>
</div>
@endsection
