<?php
$user_id = Sentry::getUser()->id;
$user_group = UsersGroups::where('user_id', '=', $user_id)->get()->first();
$userDetails = UserDetails::where('user_id', '=', $user_id)->get()->first();
?>
@section('upper-dropdown')
<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
    @if($userDetails->pic == null)
    <img src="{{ URL::asset('assets/projects/images/no_img.png') }}" class="img-circle" alt="" width="30px" height="30px">
    @else
    <img src="{{ URL::asset('assets/projects/images/profilepics/'.$userDetails->pic) }}" class="img-circle" alt="" width="30px" height="30px">
    @endif
    <span class="username hidden-xs">{{ $userDetails->first_name }} {{ $userDetails->last_name }}</span> <i class="fa fa-caret-down "></i>
</a>
@stop
@section('left-user-profile')
<div class="inline-block">
    @if($userDetails->pic == null)
    <img src="{{ URL::asset('assets/projects/images/no_img.png') }}" class="img-circle" alt="" width="50px" height="50px">
    @else
    <img src="{{ URL::asset('assets/projects/images/profilepics/'.$userDetails->pic) }}" alt="" height="50px" width="50px">
    @endif
</div>
<div class="inline-block">
    <h5 class="no-margin"> Welcome </h5>
    <h4 class="no-margin"> {{ $userDetails->first_name }} {{ $userDetails->last_name }} </h4>
</div>
@stop

@section('left-menu')
@if($user_group->groups_id == 1)
@include('layouts.menus.admin.leftMenu')
@elseif($user_group->groups_id == 2)
@include('layouts.menus.user.leftMenu')
@elseif($user_group->groups_id == 3)
@include('layouts.menus.teacher.leftMenu')
@endif
@stop

@section('upper-menu')
@if($user_group->groups_id == 1)
@include('layouts.menus.admin.upperMenu')
@elseif($user_group->groups_id == 2)
@include('layouts.menus.user.upperMenu')
@elseif($user_group->groups_id == 3)
@include('layouts.menus.teacher.upperMenu')
@endif
@stop