@extends('layouts.admin')
@section('title', $employer ? 'Edit Employer' : 'Create Employer')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $employer ? 'Edit Employer' : 'Create Employer' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-body p-10">
                <form method="POST" action="{{ $employer ? route('admin.employers.update', $employer->id) : route('admin.employers.store') }}">
                    @csrf
                    @if($employer) @method('PUT') @endif

                    @if($errors->any())
                    <div class="alert alert-danger mb-7">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                    @endif

                    <div class="row g-7">
                        <div class="col-md-6">
                            <label class="form-label required">Name</label>
                            <input type="text" name="name" value="{{ old('name', $employer->name ?? '') }}"
                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                placeholder="Full name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">Email</label>
                            <input type="email" name="email" value="{{ old('email', $employer->email ?? '') }}"
                                class="form-control form-control-solid @error('email') is-invalid @enderror"
                                placeholder="employer@company.com" />
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Company</label>
                            <input type="text" name="company" value="{{ old('company', $employer->company ?? '') }}"
                                class="form-control form-control-solid @error('company') is-invalid @enderror"
                                placeholder="Company name" />
                            @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        @if(!$employer)
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
                        <a href="{{ $employer ? route('admin.employers.show', $employer->id) : route('admin.employers.index') }}"
                            class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            {{ $employer ? 'Save Changes' : 'Create Employer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
