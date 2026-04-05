@extends('layouts.admin')
@section('title', 'Recommendations')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Recommendations</h1>
        </div>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
                    <select name="status" class="form-select form-select-solid w-150px">
                        <option value="">All Statuses</option>
                        @foreach(['pending','preparing','submitting','done'] as $s)
                            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <select name="terminated" class="form-select form-select-solid w-150px">
                        <option value="">All</option>
                        <option value="0" {{ request('terminated') === '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ request('terminated') === '1' ? 'selected' : '' }}>Terminated</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.recommendations.index') }}" class="btn btn-light">Reset</a>
                </form>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-200px rounded-start">Student</th>
                                <th class="min-w-200px">Teacher</th>
                                <th class="min-w-150px">University</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px">Signed</th>
                                <th class="min-w-150px">Created</th>
                                <th class="min-w-100px text-end rounded-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recommendations as $rec)
                            @php $sc = match($rec->status) { 'done'=>'success','preparing'=>'warning','submitting'=>'info',default=>'secondary' }; @endphp
                            <tr>
                                <td class="ps-4">
                                    <a href="{{ route('admin.recommendations.show', $rec->id) }}" class="text-gray-800 text-hover-primary fw-bold">
                                        {{ $rec->student ? $rec->student->first_name . ' ' . $rec->student->last_name : '—' }}
                                    </a>
                                </td>
                                <td class="text-muted">{{ $rec->teacher?->name ?? $rec->teacher?->email ?? '—' }}</td>
                                <td class="text-muted">{{ $rec->university?->name ?? '—' }}</td>
                                <td><span class="badge badge-light-{{ $sc }}">{{ ucfirst($rec->status) }}</span></td>
                                <td>
                                    @if($rec->is_teacher_signed)<span class="badge badge-light-success">Yes</span>
                                    @else<span class="badge badge-light-secondary">No</span>@endif
                                </td>
                                <td class="text-muted">{{ $rec->created_at?->format('M d, Y') ?? '—' }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.recommendations.show', $rec->id) }}" class="btn btn-sm btn-icon btn-light-primary me-1">
                                        <i class="ki-duotone ki-eye fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.recommendations.destroy', $rec->id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-light-danger btn-delete">
                                            <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted py-10">No recommendations found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $recommendations->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
