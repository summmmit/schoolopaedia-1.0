@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/style.css'); }}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800'
      rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700'
      rel='stylesheet' type='text/css'>
@stop

@section('page_header')
<h1>
    <i class="fa fa-calendar"></i> Weekly Schedule
</h1>
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
            <div class="panel-body">
                <ul class="tab-left">
                    <table class="timetable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>MONDAY</th>
                                <th>TUESDAY</th>
                                <th>WEDNESDAY</th>
                                <th>THURSDAY</th>
                                <th>FRIDAY</th>
                                <th>SATURDAY</th>
                                <th>SUNDAY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> 05.00 - 06.00 </td>
                                <td class="event"><a href="#" title="Boxing">Sumit Singh</a>Science</td>
                                <td class="event"><a href="#" title="Boxing">Boxing</a>05.00 - 06.00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> 06.00 - 07.00 </td>
                                <td class="event">
                                    <a href="#" title="Gym Fitness">Gym Fitness</a>
                                    06.00 
                                    - 
                                    07.00
                                </td>
                                <td class="event">
                                    <a href="#" title="Gym Fitness">Gym Fitness</a>
                                    06.00 
                                    - 
                                    07.00
                                </td>
                                <td class="event" rowspan="3">
                                    <a href="#">Gym Fitness</a>
                                    06.00 
                                    -
                                    08.30
                                    <br><br>
                                    <a href="#" title="Cardio Fitness">Cardio Fitness</a>
                                    06.00 
                                    - 
                                    08.30
                                </td>
                                <td class="event" rowspan="3">
                                    <a href="#" title="Gym Fitness">Gym Fitness</a>
                                    06.00
                                    -
                                    08.30
                                    <br><br>
                                    <a href="#" title="Cardio Fitness">Cardio Fitness</a>
                                    06.00 
                                    - 
                                    08.30
                                </td>
                                <td class="event" rowspan="3">
                                    <a href="#" title="Gym Fitness">Gym Fitness</a>
                                    06.00
                                    -
                                    08.30
                                    <br><br>
                                    <a href="#" title="Cardio Fitness">Cardio Fitness</a>
                                    06.00 
                                    - 
                                    08.30
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    07.00 - 08.00
                                </td>
                                <td class="event"><a href="#" title="Cardio Fitness">Cardio Fitness</a>07.00
                                    -
                                    08.00
                                </td>
                                <td class="event"><a href="#" title="Cardio Fitness">Cardio Fitness</a>07.00
                                    -
                                    08.00
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    08.00 - 09.00
                                </td>
                                <td></td>
                                <td></td>
                                <td class="event" rowspan="2"><a href="#" title="Indoor Cycling">Indoor
                                        Cycling</a>08.00
                                    -
                                    09.30
                                </td>
                                <td class="event" rowspan="2"><a href="#" title="Indoor Cycling">Indoor
                                        Cycling</a>08.00
                                    -
                                    09.30
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    09.00 - 10.00
                                </td>
                                <td class="event" rowspan="3"><a href="#" title="Indoor Cycling">Indoor
                                        Cycling</a>09.00
                                    -
                                    11.25
                                </td>
                                <td class="event" rowspan="3"><a href="#" title="Indoor Cycling">Indoor
                                        Cycling</a>09.00
                                    -
                                    11.25
                                </td>
                                <td></td>
                                <td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>09.00
                                    -
                                    10.00
                                </td>
                                <td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>09.00
                                    -
                                    10.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    10.00 - 11.00
                                </td>
                                <td></td>
                                <td class="event" rowspan="2"><a href="#" title="Cardio Fitness">Cardio
                                        Fitness</a>10.00
                                    -
                                    11.30
                                </td>
                                <td class="event" rowspan="2"><a href="#" title="Cardio Fitness">Cardio
                                        Fitness</a>10.00
                                    -
                                    11.30
                                </td>
                                <td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>10.00 -
                                    11.00
                                </td>
                                <td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>10.00 -
                                    11.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    11.00 - 12.00
                                </td>
                                <td></td>
                                <td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>11.00
                                    -
                                    12.00
                                </td>
                                <td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>11.00
                                    -
                                    12.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    12.00 - 13.00
                                </td>
                                <td></td>
                                <td></td>
                                <td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 -
                                    13.00
                                </td>
                                <td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 -
                                    13.00
                                </td>
                                <td class="event" rowspan="4"><a href="#" title="Boxing">Boxing</a>12.00 -
                                    15.45
                                </td>
                                <td class="event" rowspan="4"><a href="#" title="Gym Fitness">Gym
                                        Fitness</a>12.00
                                    -
                                    13.00<br><br><a
                                        href="#" title="Boxing">Boxing</a>12.00 - 15.45<br><br><a
                                        href="#" title="Cardio Fitness">Cardio
                                        Fitness</a>14.00 - 16.00
                                </td>
                                <td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 -
                                    13.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    13.00 - 14.00
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    14.00 - 15.00
                                </td>
                                <td class="event" rowspan="4"><a href="#" title="Gym Fitness">Gym
                                        Fitness</a>14.00
                                    -
                                    16.15<br><br><a
                                        href="#" title="Indoor Cycling">Indoor Cycling</a>16.00 - 17.30
                                </td>
                                <td class="event" rowspan="4"><a href="#" title="Gym Fitness">Gym
                                        Fitness</a>14.00
                                    -
                                    16.15<br><br><a
                                        href="#" title="Indoor Cycling">Indoor Cycling</a>16.00 - 17.30
                                </td>
                                <td></td>
                                <td></td>
                                <td class="event" rowspan="2"><a href="#" title="Cardio Fitness">Cardio
                                        Fitness</a>14.00
                                    -
                                    16.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    15.00 - 16.00
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    16.00 - 17.00
                                </td>
                                <td></td>
                                <td class="event" rowspan="2"><a href="#" title="Indoor Cycling">Indoor
                                        Cycling</a>16.00
                                    -
                                    17.30
                                </td>
                                <td class="event" rowspan="4"><a href="#" title="Indoor Cycling">Indoor
                                        Cycling</a>16.00
                                    -
                                    17.30<br><br><a
                                        href="#" title="Gym Fitness">Gym Fitness</a>17.30 -
                                    20.00<br><br><a
                                        href="#" title="Boxing">Boxing</a>18.00
                                    -
                                    20.00
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="timetable_small">
                        <div class="panel-group accordion" id="accordion">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseMonday">
                                            <i class="icon-arrow"></i> Monday
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseMonday" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <ul class="items_list"><h3>Monday</h3>
                                            <li><p><a href>Gym Fitness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cardio Fittness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga Pilates</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTuesday">
                                            <i class="icon-arrow"></i> Tuesday
                                        </a></h5>
                                </div>
                                <div id="collapseTuesday" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="items_list"><h3>Tuesday</h3>
                                            <li><p><a href>Gym Fitness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cardio Fittness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga Pilates</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseWednesday">
                                            <i class="icon-arrow"></i> Wednesday
                                        </a></h5>
                                </div>
                                <div id="collapseWednesday" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="items_list"><h3>Wednesday</h3>
                                            <li><p><a href>Gym Fitness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cardio Fittness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga Pilates</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThrusday">
                                            <i class="icon-arrow"></i> Thrusday
                                        </a></h5>
                                </div>
                                <div id="collapseThrusday" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="items_list"><h3>Thrusday</h3>
                                            <li><p><a href>Gym Fitness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cardio Fittness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga Pilates</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFriday">
                                            <i class="icon-arrow"></i> Friday
                                        </a></h5>
                                </div>
                                <div id="collapseFriday" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="items_list"><h3>Friday</h3>
                                            <li><p><a href>Gym Fitness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cardio Fittness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga Pilates</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSaturdnay">
                                            <i class="icon-arrow"></i> Saturday
                                        </a></h5>
                                </div>
                                <div id="collapseSaturdnay" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="items_list"><h3>Saturday</h3>
                                            <li><p><a href>Gym Fitness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cardio Fittness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga Pilates</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSunday">
                                            <i class="icon-arrow"></i> Sunday
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseSunday" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="items_list">
                                            <li><p><a href>Gym Fitness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cardio Fittness</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Yoga Pilates</a></p><span
                                                    class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                            <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span>

                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
            <!-- end: FULL CALENDAR PANEL -->
        </div>
    </div>
    <!-- end: PAGE CONTENT-->
    @stop
    @section('scripts')
    <script>
        jQuery(document).ready(function() {
            Main.init();
            SVExamples.init();
        });
    </script>
    <!--End: Scripts for This page only -->
    @stop
