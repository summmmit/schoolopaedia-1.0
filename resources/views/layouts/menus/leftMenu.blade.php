@include('layouts.menus.userMenu')
<div class="main-navigation left-wrapper transition-left">
    <div class="navigation-toggler hidden-sm hidden-xs">
        <a href="#main-navbar" class="sb-toggle-left">
        </a>
    </div>
    <div class="user-profile border-top padding-horizontal-10 block">
        @yield('left-user-profile')
    </div>
    <!-- start: MAIN NAVIGATION MENU -->
        @yield('left-menu')
    <!-- end: MAIN NAVIGATION MENU -->
</div>