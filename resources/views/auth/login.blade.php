<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login — Candid Admin</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet"/>
</head>
<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center" style="background-image: url({{ asset('assets/media/auth/bg10.jpeg') }})">
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url({{ asset('assets/media/misc/auth-bg.png') }})">
            <div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100">
                <div class="mb-7">
                    <span class="text-white fw-bolder fs-2qx">Candid</span>
                    <span class="text-white fw-light fs-2qx"> Admin</span>
                </div>
                <h2 class="text-white fs-2qx fw-bold text-center mb-7">Project Management System</h2>
                <div class="text-white fs-base text-center">Manage students, teachers, universities, employers, projects, vacancies and recommendations from one place.</div>
            </div>
        </div>
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <form class="form w-100" method="POST" action="{{ route('admin.login.post') }}">
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Candid Admin Panel</div>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger mb-5">{{ $errors->first() }}</div>
                        @endif

                        <div class="fv-row mb-8">
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                   class="form-control bg-transparent @error('email') is-invalid @enderror" required autofocus/>
                        </div>

                        <div class="fv-row mb-3">
                            <input type="password" name="password" placeholder="Password"
                                   class="form-control bg-transparent" required/>
                        </div>

                        <div class="d-grid mb-10 mt-8">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Sign In</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>
</html>
