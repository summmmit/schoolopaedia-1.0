@extends('layouts.main-layout')

@section('page_header')
<h1><i class="fa fa-pencil-square"></i>Home</h1>
@stop

@section('page_breadcrumb')
<ol class="breadcrumb">
    <li>
        <a href="#">
            Home
        </a>
    </li>
    <li class="active">
        Schedule
    </li>
</ol>
@stop

@section('content')
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: FULL CALENDAR PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <i class="fa fa-calendar"></i>
                Full Calendar
            </div>
            <div class="panel-body">
                <div class="col-sm-12 space20">
                    <a href="#newFullEvent" class="btn btn-green add-event"><i class="fa fa-plus"></i> Add New Event</a>
                </div>
                <div class="col-sm-12">
                    <div id='full-calendar'></div>
                </div>
            </div>
        </div>
        <!-- end: FULL CALENDAR PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->
@stop
@section('subview')
<!-- start: SUBVIEW FOR CALENDAR PAGE -->
<div id="newFullEvent">
    <div class="noteWrap col-md-8 col-md-offset-2">
        <h3>Add new event</h3>
        <form class="form-full-event">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="event-id hide" type="text">
                        <input class="event-name form-control" name="eventName" type="text" placeholder="Event Name...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="checkbox" class="all-day" data-label-text="All-Day" data-on-text="True" data-off-text="False">
                    </div>
                </div>
                <div class="no-all-day-range">
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="form-group">
                                <span class="input-icon">
                                    <input type="text" class="event-range-date form-control" name="eventRangeDate" placeholder="Range date"/>
                                    <i class="fa fa-clock-o"></i> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all-day-range">
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="form-group">
                                <span class="input-icon">
                                    <input type="text" class="event-range-date form-control" name="ad_eventRangeDate" placeholder="Range date"/>
                                    <i class="fa fa-calendar"></i> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hide">
                    <input type="text" class="event-start-date" name="eventStartDate"/>
                    <input type="text" class="event-end-date" name="eventEndDate"/>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="form-control selectpicker event-categories">
                            <option data-content="<span class='event-category event-cancelled'>Cancelled</span>" value="event-cancelled">Cancelled</option>
                            <option data-content="<span class='event-category event-home'>Home</span>" value="event-home">Home</option>
                            <option data-content="<span class='event-category event-overtime'>Overtime</span>" value="event-overtime">Overtime</option>
                            <option data-content="<span class='event-category event-generic'>Generic</span>" value="event-generic" selected="selected">Generic</option>
                            <option data-content="<span class='event-category event-job'>Job</span>" value="event-job">Job</option>
                            <option data-content="<span class='event-category event-offsite'>Off-site work</span>" value="event-offsite">Off-site work</option>
                            <option data-content="<span class='event-category event-todo'>To Do</span>" value="event-todo">To Do</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="summernote" placeholder="Write note here..."></textarea>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="#" class="btn btn-info close-subview-button">
                        Close
                    </a>
                </div>
                <div class="btn-group">
                    <button class="btn btn-info save-new-event" type="submit">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="readFullEvent">
    <div class="noteWrap col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-12">
                <h2 class="event-title"></h2>
                <div class="btn-group options-toggle pull-right">
                    <button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                        <span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-light pull-right">
                        <li>
                            <a href="#newFullEvent" class="edit-event">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a href="#" class="delete-event">
                                <i class="fa fa-times"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <span class="event-category event-cancelled">Cancelled</span>
                <span class="event-allday"><i class='fa fa-check'></i> All-Day</span>
            </div>
            <div class="col-md-12">
                <div class="event-start">
                    <div class="event-day"></div>
                    <div class="event-date"></div>
                    <div class="event-time"></div>
                </div>
                <div class="event-end"></div>
            </div>
            <div class="col-md-12">
                <div class="event-content"></div>
            </div>
        </div>
    </div>
</div>
<!-- end: SUBVIEW FOR CALENDAR PAGE -->
@stop
@section('scripts')
<!--Start: Scripts for This page only -->
<script src="{{ URL::asset('assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'); }}"></script>
<script src="{{ URL::asset('assets/js/modifiedJs/user/pages-calendar.js'); }}"></script>
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    Calendar.init();
});
</script>
<!--End: Scripts for This page only -->
@stop
