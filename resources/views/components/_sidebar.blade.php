<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-white fw-bolder fs-3">Candid Admin</span>
        </a>
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180"><span class="path1"></span><span class="path2"></span></i>
        </div>
    </div>
    <!--begin::Menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true">

                {{-- Dashboard --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-element-3 fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                <div class="menu-item pt-5">
                    <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">User Management</span></div>
                </div>

                {{-- Users --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-profile-circle fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>

                {{-- Students --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}" href="{{ route('admin.students.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-book fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Students</span>
                    </a>
                </div>

                {{-- Teachers --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}" href="{{ route('admin.teachers.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-teacher fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Teachers</span>
                    </a>
                </div>

                {{-- Employers --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.employers.*') ? 'active' : '' }}" href="{{ route('admin.employers.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-briefcase fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Employers</span>
                    </a>
                </div>

                <div class="menu-item pt-5">
                    <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Institutions</span></div>
                </div>

                {{-- Universities --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.universities.*') ? 'active' : '' }}" href="{{ route('admin.universities.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-bank fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Universities</span>
                    </a>
                </div>

                <div class="menu-item pt-5">
                    <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Academic</span></div>
                </div>

                {{-- Projects --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-code fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Projects</span>
                    </a>
                </div>

                {{-- Recommendations --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.recommendations.*') ? 'active' : '' }}" href="{{ route('admin.recommendations.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-document fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Recommendations</span>
                    </a>
                </div>

                <div class="menu-item pt-5">
                    <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Jobs</span></div>
                </div>

                {{-- Vacancies --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.vacancies.*') ? 'active' : '' }}" href="{{ route('admin.vacancies.index') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-tag fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                        <span class="menu-title">Vacancies</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
