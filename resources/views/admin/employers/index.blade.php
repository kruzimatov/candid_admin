@extends('layouts.admin')
@section('title', 'Employers')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Employers</h1>
        </div>

        <div class="card">
            <div class="card-header border-0 pt-6">
                <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, company..."
                           class="form-control form-control-solid w-250px"/>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.employers.index') }}" class="btn btn-light">Reset</a>
                </form>
                <div class="card-toolbar">
                    <a href="{{ route('admin.employers.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> Add Employer
                    </a>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-200px rounded-start">Name</th>
                                <th class="min-w-200px">Company</th>
                                <th class="min-w-200px">Email</th>
                                <th class="min-w-150px">Created</th>
                                <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employers as $employer)
                            <tr>
                                <td class="ps-4">
                                    <a href="{{ route('admin.employers.show', $employer->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $employer->name }}</a>
                                </td>
                                <td class="text-muted">{{ $employer->company }}</td>
                                <td class="text-muted">{{ $employer->email }}</td>
                                <td class="text-muted">{{ $employer->created_at?->format('M d, Y') ?? '—' }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.employers.show', $employer->id) }}" class="btn btn-sm btn-icon btn-light-primary me-1">
                                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </a>
                                    <a href="{{ route('admin.employers.edit', $employer->id) }}" class="btn btn-sm btn-icon btn-light-info me-1">
                                        <i class="ki-duotone ki-pencil fs-4"><span class="path1"></span><span class="path2"></span></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.employers.destroy', $employer->id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-danger btn-delete">
                                            <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted py-10">No employers found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $employers->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
