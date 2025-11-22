<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('student.dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('trans.main')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('trans.features')}} </li>


        <!-- الامتحانات-->
        <li>
            <a href="{{route('students.exam.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('trans.exams') }}</span></a>
        </li>

        <!-- Settings-->
        <li>
            <a href="{{route('student.profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('trans.profile') }}</span></a>
        </li>

    </ul>
</div>  