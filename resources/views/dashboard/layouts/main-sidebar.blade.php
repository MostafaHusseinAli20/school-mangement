<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url(LaravelLocalization::getCurrentLocale().'/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">
                                {{ trans('trans.main') }}
                            </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    
                    <!-- Grades -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span
                                    class="right-nav-text">{{trans('trans.acadmic_year')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('grades.index')}}">{{trans('trans.grade_list')}}</a></li>

                        </ul>
                    </li>

                    <!-- classes -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">{{trans('trans.classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('classes.index')}}">{{trans('trans.classes_list')}}</a></li>
                        </ul>
                    </li>
                   
                    <!-- sections-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                                    class="right-nav-text">{{trans('trans.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('sections.index')}}">{{trans('trans.sections_list')}}</a></li>
                        </ul>
                    </li>

                     <!-- students-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user-graduate"></i>{{trans('trans.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="students-menu" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Student_information" class="collapse">
                                    <li> <a href="{{route('students.create')}}">{{trans('trans.add_student')}}</a></li>
                                    <li> <a href="{{route('students.index')}}">{{trans('trans.students_list')}}</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('trans.students_promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Students_upgrade" class="collapse">
                                    <li> <a href="{{route('student-promotions.index')}}">{{trans('trans.add_promotion')}}</a></li>
                                    <li> <a href="{{route('student-promotions.create')}}">{{trans('trans.list_promotions')}}</a> </li>
                                </ul>
                            </li>

                            {{-- <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('main_trans.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Graduate students" class="collapse">
                                    <li> <a href="{{route('Graduated.create')}}">{{trans('main_trans.add_Graduate')}}</a> </li>
                                    <li> <a href="{{route('Graduated.index')}}">{{trans('main_trans.list_Graduate')}}</a> </li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>

                      <!-- Teachers-->
                      <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                                    class="right-nav-text">{{trans('trans.teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('teachers.index') }}">{{ trans('trans.teachers_list') }}</a> </li>
                        </ul>
                    </li>

                     <!-- Parents-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                            <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                    class="right-nav-text">{{trans('trans.parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ url(LaravelLocalization::getCurrentLocale() . '/add_parent') }}">{{ trans('trans.parents_list') }}</a> </li>
                            {{-- <li> <a href="{{ url(LaravelLocalization::getCurrentLocale() . '/add_parent') }}">{{ trans('trans.add_parent') }}</a> </li> --}}
                        </ul>
                    </li>

                    <!-- Accounts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                                    class="right-nav-text">{{trans('trans.accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="calendar.html">Events Calendar </a> </li>
                            <li> <a href="calendar-list.html">List Calendar</a> </li>
                        </ul>
                    </li>

                    <!-- Attendance-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                            <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('trans.attendance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>

                    <!-- Exams-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                            <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('trans.exams')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>

                    <!-- library-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                            <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('trans.library')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>


                    <!-- Onlinec lasses-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                            <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('trans.onlineclasses')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>

                     <!-- Settings-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Settings-icon">
                            <div class="pull-left"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('trans.settings')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Settings-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>


                    <!-- Users-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                            <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{trans('trans.users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>
                   
                   
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
