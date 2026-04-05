@extends('layouts.admin')
@section('title', 'Users')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Users</h1>
        </div>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by email..." class="form-control form-control-solid w-250px"/>
                    <select name="role" class="form-select form-select-solid w-175px">
                        <option value="">All Roles</option>
                        @foreach(['student','teacher','employer','university_admin','super_admin'] as $role)
                            <option value="{{ $role }}" {{ request('role') === $role ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $role)) }}</option>
                        @endforeach
                    </select>
                    <select name="active" class="form-select form-select-solid w-150px">
                        <option value="">All Status</option>
                        <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light">Reset</a>
                </form>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-250px rounded-start">Email</th>
                                <th class="min-w-120px">Role</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-150px">Created</th>
                                <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="ps-4"><a href="{{ route('admin.users.show', $user->user_id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $user->email }}</a></td>
                                <td><span class="badge badge-light-primary">{{ ucwords(str_replace('_', ' ', $user->role)) }}</span></td>
                                <td>
                                    @if($user->is_active)<span class="badge badge-light-success">Active</span>
                                    @else<span class="badge badge-light-danger">Inactive</span>@endif
                                </td>
                                <td class="text-muted">{{ $user->created_at?->format('M d, Y') ?? '—' }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.users.show', $user->user_id) }}" class="btn btn-sm btn-icon btn-light-primary me-1">
                                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.toggle-active', $user->user_id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-warning me-1">
                                            <i class="ki-duotone ki-{{ $user->is_active ? 'minus-circle' : 'check-circle' }} fs-4"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->user_id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-danger btn-delete">
                                            <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted py-10">No users found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
