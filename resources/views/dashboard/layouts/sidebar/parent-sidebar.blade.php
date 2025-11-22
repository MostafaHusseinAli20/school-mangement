<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">

        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('parent.dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('trans.main')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">
            {{trans('trans-parent.parent_dashboard')}} </li>

         <!-- المراحل الدراسية -->
        <li>
            <a href="{{ route('parent.grades') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('trans-parent.grades') }}</span></a>
        </li>

        <!-- الابناء -->
        <li>
            <a href="{{ route('parent.children') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('trans-parent.children') }}</span></a>
        </li>

        <!-- الدفوعات -->
        <li>
            <a href="{{ route('parent.fees') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('trans-parent.fees') }}</span></a>
        </li>

        <!-- الصفحة الشخصية -->
        <li>
            <a href="{{ route('parent.profile') }}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('trans.profile') }}</span></a>
        </li>

    </ul>
</div>