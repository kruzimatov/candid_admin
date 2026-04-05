@extends('layouts.admin')
@section('title', $student ? 'Edit Student' : 'Create Student')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $student ? 'Edit Student' : 'Create Student' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-body p-10">
                <form method="POST" action="{{ $student ? route('admin.students.update', $student->student_id) : route('admin.students.store') }}">
                    @csrf
                    @if($student) @method('PUT') @endif

                    @if($errors->any())
                    <div class="alert alert-danger mb-7">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                    @endif

                    <div class="row g-7">
                        <div class="col-md-6">
                            <label class="form-label required">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}"
                                class="form-control form-control-solid @error('first_name') is-invalid @enderror"
                                placeholder="First name" />
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}"
                                class="form-control form-control-solid @error('last_name') is-invalid @enderror"
                                placeholder="Last name" />
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">Email</label>
                            <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}"
                                class="form-control form-control-solid @error('email') is-invalid @enderror"
                                placeholder="student@email.com" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">University</label>
                            <select name="university_id" class="form-select form-select-solid @error('university_id') is-invalid @enderror">
                                <option value="">Select university...</option>
                                @foreach($universities as $uni)
                                <option value="{{ $uni->id }}" {{ old('university_id', $student->university_id ?? '') == $uni->id ? 'selected' : '' }}>
                                    {{ $uni->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('university_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        @if(!$student)
                        <div class="col-md-6">
                            <label class="form-label required">Password</label>
                            <input type="password" name="password"
                                class="form-control form-control-solid @error('password') is-invalid @enderror"
                                placeholder="Minimum 6 characters" />
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-10">
                        <a href="{{ $student ? route('admin.students.show', $student->student_id) : route('admin.students.index') }}"
                            class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            {{ $student ? 'Save Changes' : 'Create Student' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
