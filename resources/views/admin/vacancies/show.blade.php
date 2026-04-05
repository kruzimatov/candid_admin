@extends('layouts.admin')
@section('title', 'Vacancy Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Vacancy Details</h1>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <div>
                    <h3 class="card-title">{{ $vacancy->company }}</h3>
                    <div class="d-flex gap-2 mt-1">
                        <span class="badge badge-light-{{ $vacancy->type === 'job' ? 'primary' : 'success' }}">{{ ucfirst($vacancy->type) }}</span>
                        <span class="badge badge-light-info">{{ ucfirst($vacancy->mode) }}</span>
                        @if($vacancy->is_expired)<span class="badge badge-light-danger">Expired</span>
                        @else<span class="badge badge-light-success">Active</span>@endif
                    </div>
                </div>
                <div class="card-toolbar">
                    <form method="POST" action="{{ route('admin.vacancies.destroy', $vacancy->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-md-4"><label class="form-label text-muted">Location</label><div>{{ $vacancy->location }}</div></div>
                    <div class="col-md-4"><label class="form-label text-muted">Salary</label><div>{{ $vacancy->salary ? '$' . number_format($vacancy->salary) : '—' }}</div></div>
                    <div class="col-md-4"><label class="form-label text-muted">Start Date</label><div>{{ $vacancy->start_date?->format('M d, Y') ?? '—' }}</div></div>
                    <div class="col-md-4"><label class="form-label text-muted">End Date</label><div>{{ $vacancy->end_date?->format('M d, Y') ?? '—' }}</div></div>
                    <div class="col-md-4"><label class="form-label text-muted">Posted</label><div>{{ $vacancy->created_at?->format('M d, Y') ?? '—' }}</div></div>
                    <div class="col-12"><label class="form-label text-muted">Description</label><div class="text-gray-800">{{ $vacancy->description ?: '—' }}</div></div>
                </div>
            </div>
        </div>

        <div class="mt-3"><a href="{{ route('admin.vacancies.index') }}" class="btn btn-light">← Back to Vacancies</a></div>
    </div>
</div>
@endsection
