<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">

                @if (auth('web')->check())
                    @include('dashboard.layouts.sidebar.admin-sidebar')
                @endif

                @if (auth('student')->check())
                    @include('dashboard.layouts.sidebar.student-sidebar')
                @endif

                @if (auth('teacher')->check())
                    @include('dashboard.layouts.sidebar.teacher-sidebar')
                @endif

                @if (auth('parent')->check())
                    @include('dashboard.layouts.sidebar.parent-sidebar')
                @endif

            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================

            
