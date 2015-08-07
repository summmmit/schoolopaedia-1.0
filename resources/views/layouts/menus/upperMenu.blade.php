@include('layouts.menus.userMenu')
<ul class="nav navbar-right">
    <!-- start: USER DROPDOWN -->
    <li class="dropdown current-user">
        @yield('upper-dropdown')
        @yield('upper-menu')
    </li>
    <!-- end: USER DROPDOWN -->
</ul>