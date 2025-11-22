<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('teacher.dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('trans.main')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('trans-teacher.teacher_dashboard') }} </li>

        <!-- الاقسام-->
        <li>
            <a href="{{ route('teacher.sections') }}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('trans.sections') }}</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{ route('teacher.students') }}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{ trans('trans.students') }}</span></a>
        </li>

        <!-- الحصص -->
        <li>
            <a href="{{ route('teacher.lessons.index') }}"><i class="fas fa-video"></i><span
                    class="right-nav-text">{{ trans('trans.lessons') }}</span></a>
        </li>

        <!-- الامتحانات -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#quizzes-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ trans('trans.exams') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="quizzes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('teacher.quizzes.index') }}">{{ trans('trans.list_exams') }}</a></li>
                <li><a href="{{ route('teacher.quizzes.questions.index') }}">{{ trans('trans.list_question') }}</a></li>
            </ul>

        </li>

        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ trans('trans-teacher.reports') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('teacher.attendance.report') }}">{{ trans('trans-teacher.attendance_report') }}</a></li>
            </ul>

        </li>


        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('teacher.profile')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('trans.profile') }}</span></a>
        </li>

    </ul>
</div>