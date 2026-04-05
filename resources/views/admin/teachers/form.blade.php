@extends('layouts.admin')
@section('title', $teacher ? 'Edit Teacher' : 'Create Teacher')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $teacher ? 'Edit Teacher' : 'Create Teacher' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-body p-10">
                <form method="POST" action="{{ $teacher ? route('admin.teachers.update', $teacher->teacher_id) : route('admin.teachers.store') }}">
                    @csrf
                    @if($teacher) @method('PUT') @endif

                    @if($errors->any())
                    <div class="alert alert-danger mb-7">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                    @endif

                    <div class="row g-7">
                        <div class="col-md-6">
                            <label class="form-label required">Name</label>
                            <input type="text" name="name" value="{{ old('name', $teacher->name ?? '') }}"
                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                placeholder="Full name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">Email</label>
                            <input type="email" name="email" value="{{ old('email', $teacher->email ?? '') }}"
                                class="form-control form-control-solid @error('email') is-invalid @enderror"
                                placeholder="teacher@email.com" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">University</label>
                            <select name="university_id" class="form-select form-select-solid @error('university_id') is-invalid @enderror">
                                <option value="">Select university...</option>
                                @foreach($universities as $uni)
                                <option value="{{ $uni->id }}" {{ old('university_id', $teacher->university_id ?? '') == $uni->id ? 'selected' : '' }}>
                                    {{ $uni->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('university_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Specialty</label>
                            <input type="text" name="specialty" value="{{ old('specialty', $teacher->specialty ?? '') }}"
                                class="form-control form-control-solid @error('specialty') is-invalid @enderror"
                                placeholder="e.g. Computer Science" />
                            @error('specialty')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        @if(!$teacher)
                        <div class="col-md-6">
                            <label class="form-label required">Password</label>
                            <input type="password" name="password"
                                class="form-control form-control-solid @error('password') is-invalid @enderror"
                                placeholder="Minimum 6 characters" />
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @endif

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check form-switch form-check-custom form-check-solid mt-6">
                                <input class="form-check-input" type="checkbox" name="is_verified" value="1"
                                    id="is_verified" {{ old('is_verified', $teacher->is_verified ?? false) ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold ms-3" for="is_verified">Verified</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-10">
                        <a href="{{ $teacher ? route('admin.teachers.show', $teacher->teacher_id) : route('admin.teachers.index') }}"
                            class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            {{ $teacher ? 'Save Changes' : 'Create Teacher' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
