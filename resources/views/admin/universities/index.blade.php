@extends('layouts.admin')
@section('title', 'Universities')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Universities</h1>
        </div>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search university name..." class="form-control form-control-solid w-250px"/>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.universities.index') }}" class="btn btn-light">Reset</a>
                </form>
                <div class="card-toolbar">
                    <a href="{{ route('admin.universities.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> Add University
                    </a>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-250px rounded-start">Name</th>
                                <th class="min-w-200px">Location</th>
                                <th class="min-w-100px">Students</th>
                                <th class="min-w-100px">Teachers</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($universities as $uni)
                            <tr>
                                <td class="ps-4"><a href="{{ route('admin.universities.show', $uni->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $uni->name }}</a></td>
                                <td class="text-muted">{{ $uni->location ?? '—' }}</td>
                                <td><span class="badge badge-light-primary">{{ $uni->students_count }}</span></td>
                                <td><span class="badge badge-light-info">{{ $uni->teachers_count }}</span></td>
                                <td>
                                    @if($uni->is_active)<span class="badge badge-light-success">Active</span>
                                    @else<span class="badge badge-light-danger">Inactive</span>@endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.universities.show', $uni->id) }}" class="btn btn-sm btn-icon btn-light-primary me-1">
                                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </a>
                                    <a href="{{ route('admin.universities.edit', $uni->id) }}" class="btn btn-sm btn-icon btn-light-info me-1">
                                        <i class="ki-duotone ki-pencil fs-4"><span class="path1"></span><span class="path2"></span></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.universities.toggle-active', $uni->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-{{ $uni->is_active ? 'warning' : 'success' }} me-1">
                                            <i class="ki-duotone ki-{{ $uni->is_active ? 'minus-circle' : 'check-circle' }} fs-4"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.universities.destroy', $uni->id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-danger btn-delete">
                                            <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-10">No universities found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $universities->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
