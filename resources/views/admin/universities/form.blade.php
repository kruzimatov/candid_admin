@extends('layouts.admin')
@section('title', $university ? 'Edit University' : 'Create University')

@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 py-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $university ? 'Edit University' : 'Create University' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-body p-10">
                <form method="POST" action="{{ $university ? route('admin.universities.update', $university->id) : route('admin.universities.store') }}">
                    @csrf
                    @if($university) @method('PUT') @endif

                    @if($errors->any())
                    <div class="alert alert-danger mb-7">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                    @endif

                    <div class="row g-7">
                        <div class="col-md-6">
                            <label class="form-label required">Name</label>
                            <input type="text" name="name" value="{{ old('name', $university->name ?? '') }}"
                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                placeholder="University name" />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">Location</label>
                            <input type="text" name="location" value="{{ old('location', $university->location ?? '') }}"
                                class="form-control form-control-solid @error('location') is-invalid @enderror"
                                placeholder="City, Country" />
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-10">
                        <a href="{{ $university ? route('admin.universities.show', $university->id) : route('admin.universities.index') }}"
                            class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            {{ $university ? 'Save Changes' : 'Create University' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
