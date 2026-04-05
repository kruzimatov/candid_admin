@extends('layouts.admin')
@section('title', 'Employer Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Employer Details</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted"><a href="{{ route('admin.employers.index') }}" class="text-muted text-hover-primary">Employers</a></li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">{{ $employer->name }}</li>
            </ul>
        </div>

        <div class="row g-5">
            <div class="col-xl-4">
                <div class="card mb-5">
                    <div class="card-body text-center pt-15">
                        <div class="symbol symbol-100px mb-4">
                            <div class="symbol-label fs-2 bg-light-warning text-warning fw-bold" style="font-size:3rem!important">
                                {{ strtoupper(substr($employer->name, 0, 1)) }}
                            </div>
                        </div>
                        <h3 class="text-gray-900 fw-bold">{{ $employer->name }}</h3>
                        <div class="text-muted mb-2">{{ $employer->company }}</div>
                        <div class="text-muted mb-5">{{ $employer->email }}</div>
                        <a href="{{ route('admin.employers.edit', $employer->id) }}" class="btn btn-info mb-3">Edit Employer</a>
                        <form method="POST" action="{{ route('admin.employers.destroy', $employer->id) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete">Delete Employer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Vacancies ({{ $employer->vacancies->count() }})</h3>
                    </div>
                    <div class="card-body">
                        @forelse($employer->vacancies as $vacancy)
                        <div class="d-flex align-items-center mb-5">
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.vacancies.show', $vacancy->id) }}" class="text-gray-800 text-hover-primary fw-bold fs-6">{{ $vacancy->company }}</a>
                                <div class="text-muted fs-7">{{ $vacancy->location }} — {{ ucfirst($vacancy->type) }} / {{ ucfirst($vacancy->mode) }}</div>
                            </div>
                            <div>
                                @if($vacancy->isExpired)
                                    <span class="badge badge-light-danger">Expired</span>
                                @else
                                    <span class="badge badge-light-success">Active</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-muted py-5">No vacancies posted.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.employers.index') }}" class="btn btn-light">← Back to Employers</a>
        </div>
    </div>
</div>
@endsection
