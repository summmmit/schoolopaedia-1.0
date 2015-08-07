<!-- start: MAIN NAVIGATION MENU -->
<ul class="main-navigation-menu">
    <li>
        <a href="{{ URL::route('admin-home'); }}"><i class="fa fa-home"></i> <span class="title"> Home </span><span class="label label-default pull-right "> HOME </span> </a>
    </li>
    <li>
        <a href="{{ URL::route('admin-profile'); }}"><i class="fa fa-desktop"></i> <span class="title"> Your Profile </span></a>
    </li>
    <li>
        <a href="{{ URL::route('admin-time-table'); }}"><i class="fa fa-desktop"></i> <span class="title"> Add or Edit TimeTable </span></a>
    </li>
    <li>
        <a href="{{ URL::route('admin-create-time-table'); }}"><i class="fa fa-desktop"></i> <span class="title"> Create TimeTable </span></a>
    </li>
    <li>
        <a href="{{ URL::route('admin-school-settings'); }}"><i class="fa fa-caret-up"></i> <span class="title"> School Settings </span></a>
    </li>
    <li>
        <a href="{{ URL::route('admin-school-students'); }}"><i class="fa fa-caret-up"></i> <span class="title"> Students </span></a>
    </li>
    <li>
        <a href="{{ URL::route('admin-school-teachers'); }}"><i class="fa fa-caret-up"></i> <span class="title"> Teachers </span></a>
    </li>
    <li>
        <a href="{{ URL::route('admin-school-events'); }}"><i class="fa fa-caret-up"></i> <span class="title"> Events </span></a>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="fa fa-th-large"></i> <span class="title"> School Settings </span><i class="icon-arrow"></i> </a>
        <ul class="sub-menu">
            <li>
                <a href="#">
                    <span class="title">Schedule</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::route('admin-school-periods'); }}">
                    <span class="title">Periods</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
<!-- end: MAIN NAVIGATION MENU -->