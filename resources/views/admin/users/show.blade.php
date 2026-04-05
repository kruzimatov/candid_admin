@extends('layouts.admin')
@section('title', 'User Details')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">User Details</h1>
        </div>

        <div class="row g-5 g-xl-10">
            <div class="col-xl-4">
                <div class="card mb-5">
                    <div class="card-body pt-15 text-center">
                        <div class="symbol symbol-100px mb-4">
                            <div class="symbol-label fs-2 bg-light-primary text-primary fw-bold" style="font-size:3rem!important">
                                {{ strtoupper(substr($user->email ?? 'U', 0, 1)) }}
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <span class="fs-4 text-gray-800 fw-bold">{{ $user->email }}</span>
                            <span class="badge badge-light-primary align-self-center mt-2">{{ ucwords(str_replace('_', ' ', $user->role)) }}</span>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <form method="POST" action="{{ route('admin.users.toggle-active', $user->user_id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-{{ $user->is_active ? 'warning' : 'success' }}">
                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.destroy', $user->user_id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-delete">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body border-top pt-5">
                        <table class="table table-flush fw-semibold gy-1">
                            <tr><td class="text-muted">Status</td><td>
                                @if($user->is_active)<span class="badge badge-light-success">Active</span>
                                @else<span class="badge badge-light-danger">Inactive</span>@endif
                            </td></tr>
                            <tr><td class="text-muted">Created</td><td>{{ $user->created_at?->format('M d, Y') ?? '—' }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                @if($user->student)
                <div class="card mb-5">
                    <div class="card-header"><h3 class="card-title">Student Profile</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6"><span class="text-muted">Name:</span> <strong>{{ $user->student->first_name }} {{ $user->student->last_name }}</strong></div>
                            <div class="col-6"><span class="text-muted">Email:</span> {{ $user->student->email }}</div>
                        </div>
                        <div class="mt-3"><a href="{{ route('admin.students.show', $user->student->student_id) }}" class="btn btn-sm btn-primary">View Profile</a></div>
                    </div>
                </div>
                @endif
                @if($user->teacher)
                <div class="card mb-5">
                    <div class="card-header"><h3 class="card-title">Teacher Profile</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6"><span class="text-muted">Name:</span> {{ $user->teacher->name }}</div>
                            <div class="col-6"><span class="text-muted">Specialty:</span> {{ $user->teacher->specialty ?? '—' }}</div>
                            <div class="col-6 mt-2"><span class="text-muted">Verified:</span>
                                @if($user->teacher->is_verified)<span class="badge badge-light-success">Yes</span>
                                @else<span class="badge badge-light-danger">No</span>@endif
                            </div>
                        </div>
                        <div class="mt-3"><a href="{{ route('admin.teachers.show', $user->teacher->teacher_id) }}" class="btn btn-sm btn-primary">View Profile</a></div>
                    </div>
                </div>
                @endif
                @if($user->universityAdmin)
                <div class="card mb-5">
                    <div class="card-header"><h3 class="card-title">University Admin Profile</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6"><span class="text-muted">Name:</span> {{ $user->universityAdmin->name }}</div>
                            <div class="col-6"><span class="text-muted">Email:</span> {{ $user->universityAdmin->email }}</div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="mt-3"><a href="{{ route('admin.users.index') }}" class="btn btn-light">← Back to Users</a></div>
    </div>
</div>
@endsection
