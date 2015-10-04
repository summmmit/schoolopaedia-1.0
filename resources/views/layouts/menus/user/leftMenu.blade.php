<ul class="main-navigation-menu">
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-home"></i> <span class="title"> Home </span><span class="label label-default pull-right ">LABEL</span> </a>
    </li>
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-desktop"></i> <span class="title"> Inbox </span></a>
    </li>
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-home"></i> <span class="title"> Other Class Students </span><span class="label label-default pull-right ">LABEL</span> </a>
    </li>
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-desktop"></i> <span class="title"> TimeTable </span></a>
    </li>
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-desktop"></i> <span class="title"> Weekly Schedule </span></a>
    </li>
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-desktop"></i> <span class="title"> Assignments </span></a>
    </li>
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-desktop"></i> <span class="title"> Attendance </span></a>
    </li>
    <li>
        <a href="{{ URL::route('user-home') }}"><i class="fa fa-desktop"></i> <span class="title"> Events </span></a>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="fa fa-th-large"></i> <span class="title"> Profile </span><i class="icon-arrow"></i> </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ URL::route('user-profile-details') }}">
                    <span class="title">Details</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::route('user-profile') }}">
                    <span class="title">User Profile</span>
                </a>
            </li>
        </ul>
    </li>
</ul>