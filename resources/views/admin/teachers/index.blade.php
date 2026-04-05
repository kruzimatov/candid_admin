@extends('layouts.admin')
@section('title', 'Teachers')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Teachers</h1>
        </div>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, specialty..." class="form-control form-control-solid w-250px"/>
                    <select name="university_id" class="form-select form-select-solid w-200px">
                        <option value="">All Universities</option>
                        @foreach($universities as $uni)
                            <option value="{{ $uni->id }}" {{ request('university_id') === $uni->id ? 'selected' : '' }}>{{ $uni->name }}</option>
                        @endforeach
                    </select>
                    <select name="verified" class="form-select form-select-solid w-150px">
                        <option value="">Verified?</option>
                        <option value="1" {{ request('verified') === '1' ? 'selected' : '' }}>Verified</option>
                        <option value="0" {{ request('verified') === '0' ? 'selected' : '' }}>Not Verified</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-light">Reset</a>
                </form>
                <div class="card-toolbar">
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> Add Teacher
                    </a>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-200px rounded-start">Name / Email</th>
                                <th class="min-w-150px">Specialty</th>
                                <th class="min-w-200px">University</th>
                                <th class="min-w-100px">Verified</th>
                                <th class="min-w-150px">Created</th>
                                <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                            <tr>
                                <td class="ps-4">
                                    <a href="{{ route('admin.teachers.show', $teacher->teacher_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $teacher->name }}</a>
                                    <div class="text-muted fs-7">{{ $teacher->email }}</div>
                                </td>
                                <td class="text-muted">{{ $teacher->specialty ?? '—' }}</td>
                                <td class="text-muted">{{ $teacher->university?->name ?? '—' }}</td>
                                <td>
                                    @if($teacher->is_verified)<span class="badge badge-light-success">Verified</span>
                                    @else<span class="badge badge-light-warning">Pending</span>@endif
                                </td>
                                <td class="text-muted">{{ $teacher->created_at?->format('M d, Y') ?? '—' }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.teachers.show', $teacher->teacher_id) }}" class="btn btn-sm btn-icon btn-light-primary me-1">
                                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </a>
                                    <a href="{{ route('admin.teachers.edit', $teacher->teacher_id) }}" class="btn btn-sm btn-icon btn-light-info me-1">
                                        <i class="ki-duotone ki-pencil fs-4"><span class="path1"></span><span class="path2"></span></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.teachers.toggle-verified', $teacher->teacher_id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-{{ $teacher->is_verified ? 'warning' : 'success' }} me-1">
                                            <i class="ki-duotone ki-{{ $teacher->is_verified ? 'cross-circle' : 'check-circle' }} fs-4"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.teachers.destroy', $teacher->teacher_id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-danger btn-delete">
                                            <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-10">No teachers found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $teachers->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
