@extends('layouts.admin')
@section('title', 'Projects')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Projects</h1>
        </div>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search project title..." class="form-control form-control-solid w-250px"/>
                    <select name="approved" class="form-select form-select-solid w-150px">
                        <option value="">All</option>
                        <option value="1" {{ request('approved') === '1' ? 'selected' : '' }}>Approved</option>
                        <option value="0" {{ request('approved') === '0' ? 'selected' : '' }}>Pending</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light">Reset</a>
                </form>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-250px rounded-start">Title</th>
                                <th class="min-w-150px">Student</th>
                                <th class="min-w-150px">University</th>
                                <th class="min-w-100px">Approved</th>
                                <th class="min-w-150px">Created</th>
                                <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                            <tr>
                                <td class="ps-4"><a href="{{ route('admin.projects.show', $project->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $project->title }}</a></td>
                                <td class="text-muted">{{ $project->student ? $project->student->first_name . ' ' . $project->student->last_name : '—' }}</td>
                                <td class="text-muted">{{ $project->university?->name ?? '—' }}</td>
                                <td>
                                    @if($project->is_approved)<span class="badge badge-light-success">Approved</span>
                                    @else<span class="badge badge-light-warning">Pending</span>@endif
                                </td>
                                <td class="text-muted">{{ $project->created_at?->format('M d, Y') ?? '—' }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-icon btn-light-primary me-1">
                                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.projects.toggle-approved', $project->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-{{ $project->is_approved ? 'warning' : 'success' }} me-1">
                                            <i class="ki-duotone ki-{{ $project->is_approved ? 'cross-circle' : 'check-circle' }} fs-4"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-danger btn-delete">
                                            <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-10">No projects found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $projects->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
