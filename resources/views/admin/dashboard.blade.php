@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">

        {{-- Page header --}}
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
            <span class="text-muted fs-7 fw-semibold mt-1">{{ now()->format('l, F j Y') }}</span>
        </div>

        {{-- Stat Cards --}}
        <div class="row g-5 mb-8">
            @php
            $cards = [
                ['label'=>'Users',           'count'=>$stats['users'],           'icon'=>'profile-user',   'color'=>'primary',  'route'=>'admin.users.index'],
                ['label'=>'Students',        'count'=>$stats['students'],        'icon'=>'book',           'color'=>'success',  'route'=>'admin.students.index'],
                ['label'=>'Teachers',        'count'=>$stats['teachers'],        'icon'=>'teacher',        'color'=>'info',     'route'=>'admin.teachers.index'],
                ['label'=>'Employers',       'count'=>$stats['employers'],       'icon'=>'briefcase',      'color'=>'warning',  'route'=>'admin.employers.index'],
                ['label'=>'Universities',    'count'=>$stats['universities'],    'icon'=>'home-2',         'color'=>'danger',   'route'=>'admin.universities.index'],
                ['label'=>'Projects',        'count'=>$stats['projects'],        'icon'=>'code',           'color'=>'primary',  'route'=>'admin.projects.index'],
                ['label'=>'Vacancies',       'count'=>$stats['vacancies'],       'icon'=>'document',       'color'=>'success',  'route'=>'admin.vacancies.index'],
                ['label'=>'Recommendations', 'count'=>$stats['recommendations'], 'icon'=>'star',           'color'=>'info',     'route'=>'admin.recommendations.index'],
            ];
            @endphp

            @foreach($cards as $card)
            <div class="col-6 col-md-3">
                <a href="{{ route($card['route']) }}" class="card text-decoration-none h-100" style="border-top: 3px solid var(--bs-{{ $card['color'] }})">
                    <div class="card-body d-flex align-items-center gap-4 py-5">
                        <div class="d-flex align-items-center justify-content-center rounded-2 bg-light-{{ $card['color'] }}" style="width:50px;height:50px;flex-shrink:0">
                            <i class="ki-duotone ki-{{ $card['icon'] }} fs-2x text-{{ $card['color'] }}"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </div>
                        <div>
                            <div class="fs-2 fw-bold text-gray-900 lh-1">{{ number_format($card['count']) }}</div>
                            <div class="text-muted fs-7 fw-semibold mt-1">{{ $card['label'] }}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        {{-- Recent Data --}}
        <div class="row g-5">

            {{-- Recent Students --}}
            <div class="col-xl-4">
                <div class="card card-flush h-100">
                    <div class="card-header pt-6">
                        <h3 class="card-title fw-bold text-gray-800">Recent Students</h3>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-light">View All</a>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-4">
                        @forelse($recentStudents as $s)
                        <div class="d-flex align-items-center py-3 {{ !$loop->last ? 'border-bottom border-dashed' : '' }}">
                            <div class="symbol symbol-35px me-3">
                                <div class="symbol-label bg-light-success text-success fw-bold fs-6">{{ strtoupper(substr($s->first_name, 0, 1)) }}</div>
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <a href="{{ route('admin.students.show', $s->student_id) }}" class="text-gray-800 text-hover-primary fw-semibold d-block text-truncate">{{ $s->first_name }} {{ $s->last_name }}</a>
                                <span class="text-muted fs-7 text-truncate d-block">{{ $s->university?->name ?? '—' }}</span>
                            </div>
                            <span class="text-muted fs-8 ms-2 text-nowrap">{{ $s->created_at?->diffForHumans() ?? '' }}</span>
                        </div>
                        @empty
                        <div class="text-center text-muted py-8">No students yet</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Recent Vacancies --}}
            <div class="col-xl-4">
                <div class="card card-flush h-100">
                    <div class="card-header pt-6">
                        <h3 class="card-title fw-bold text-gray-800">Recent Vacancies</h3>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.vacancies.index') }}" class="btn btn-sm btn-light">View All</a>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-4">
                        @forelse($recentVacancies as $v)
                        <div class="d-flex align-items-center py-3 {{ !$loop->last ? 'border-bottom border-dashed' : '' }}">
                            <div class="symbol symbol-35px me-3">
                                <div class="symbol-label bg-light-warning text-warning fw-bold fs-6">{{ strtoupper(substr($v->company ?? 'V', 0, 1)) }}</div>
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <a href="{{ route('admin.vacancies.show', $v->id) }}" class="text-gray-800 text-hover-primary fw-semibold d-block text-truncate">{{ $v->company }}</a>
                                <span class="text-muted fs-7">{{ $v->location ?? '—' }}</span>
                            </div>
                            <span class="badge badge-light-{{ $v->type === 'job' ? 'primary' : 'success' }} ms-2">{{ ucfirst($v->type) }}</span>
                        </div>
                        @empty
                        <div class="text-center text-muted py-8">No vacancies yet</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Recent Recommendations --}}
            <div class="col-xl-4">
                <div class="card card-flush h-100">
                    <div class="card-header pt-6">
                        <h3 class="card-title fw-bold text-gray-800">Recent Recommendations</h3>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.recommendations.index') }}" class="btn btn-sm btn-light">View All</a>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-4">
                        @forelse($recentRecommendations as $r)
                        @php
                            $sc = match($r->status ?? '') {
                                'done'       => 'success',
                                'preparing'  => 'warning',
                                'submitting' => 'info',
                                default      => 'secondary'
                            };
                        @endphp
                        <div class="d-flex align-items-center py-3 {{ !$loop->last ? 'border-bottom border-dashed' : '' }}">
                            <div class="symbol symbol-35px me-3">
                                <div class="symbol-label bg-light-info text-info fw-bold fs-6">{{ strtoupper(substr($r->student?->first_name ?? 'R', 0, 1)) }}</div>
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <a href="{{ route('admin.recommendations.show', $r->id) }}" class="text-gray-800 text-hover-primary fw-semibold d-block text-truncate">
                                    {{ $r->student?->first_name ?? 'N/A' }} {{ $r->student?->last_name ?? '' }}
                                </a>
                                <span class="text-muted fs-7 text-truncate d-block">{{ $r->teacher?->name ?? '—' }}</span>
                            </div>
                            <span class="badge badge-light-{{ $sc }} ms-2">{{ ucfirst($r->status ?? 'unknown') }}</span>
                        </div>
                        @empty
                        <div class="text-center text-muted py-8">No recommendations yet</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
