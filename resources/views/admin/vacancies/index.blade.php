@extends('layouts.admin')
@section('title', 'Vacancies')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Vacancies</h1>
        </div>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search company, location..." class="form-control form-control-solid w-250px"/>
                    <select name="type" class="form-select form-select-solid w-150px">
                        <option value="">All Types</option>
                        <option value="job" {{ request('type') === 'job' ? 'selected' : '' }}>Job</option>
                        <option value="internship" {{ request('type') === 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                    <select name="mode" class="form-select form-select-solid w-150px">
                        <option value="">All Modes</option>
                        <option value="online" {{ request('mode') === 'online' ? 'selected' : '' }}>Online</option>
                        <option value="offline" {{ request('mode') === 'offline' ? 'selected' : '' }}>Offline</option>
                        <option value="hybrid" {{ request('mode') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                    <select name="expired" class="form-select form-select-solid w-150px">
                        <option value="">All</option>
                        <option value="0" {{ request('expired') === '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ request('expired') === '1' ? 'selected' : '' }}>Expired</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.vacancies.index') }}" class="btn btn-light">Reset</a>
                </form>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-200px rounded-start">Company</th>
                                <th class="min-w-150px">Location</th>
                                <th class="min-w-100px">Type</th>
                                <th class="min-w-100px">Mode</th>
                                <th class="min-w-100px">Salary</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vacancies as $vacancy)
                            <tr>
                                <td class="ps-4"><a href="{{ route('admin.vacancies.show', $vacancy->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $vacancy->company }}</a></td>
                                <td class="text-muted">{{ $vacancy->location }}</td>
                                <td><span class="badge badge-light-{{ $vacancy->type === 'job' ? 'primary' : 'success' }}">{{ ucfirst($vacancy->type) }}</span></td>
                                <td><span class="badge badge-light-info">{{ ucfirst($vacancy->mode) }}</span></td>
                                <td class="text-muted">{{ $vacancy->salary ? '$' . number_format($vacancy->salary) : '—' }}</td>
                                <td>
                                    @if($vacancy->is_expired)<span class="badge badge-light-danger">Expired</span>
                                    @else<span class="badge badge-light-success">Active</span>@endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.vacancies.show', $vacancy->id) }}" class="btn btn-sm btn-icon btn-light-primary me-1">
                                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.vacancies.destroy', $vacancy->id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-danger btn-delete">
                                            <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted py-10">No vacancies found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $vacancies->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
