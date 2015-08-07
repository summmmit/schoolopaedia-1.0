@extends('layouts.main-layout')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/ms-Dropdown/css/msdropdown/dd.css'); }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/x-editable/css/bootstrap-editable.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/typeaheadjs/lib/typeahead.js-bootstrap.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/jquery-address/address.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css'); }}">
@stop


@section('page_header')
<h1><i class="fa fa-pencil-square"></i>Home</h1>
@stop

@section('page_breadcrumb')
<ol class="breadcrumb">
    <li>
        <a href="#">
            Dashboard
        </a>
    </li>
    <li class="active">
        Home
    </li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Form <span class="text-bold">test</span></h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td class="column-left">Simple text field</td>
                                    <td class="column-right">
                                        <a href="#" id="username" data-type="text" data-pk="1">
                                           2047/01/05
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <table width="100%" border="0" cellspacing="1" cellpadding="5" class="tblWhite">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top">Created from HTML SELECT Element</td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <select id="payments" name="payments" style="width:250px;">
                                <option value="" data-description="Choos your payment gateway">Payment Gateway</option>
                                <option value="amex" data-description="My life. My card..." data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/Amex-56.png'); }}">Amex</option>
                                <option value="Discover" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/Discover-56.png'); }}" data-description="It pays to Discover...">Discover</option>
                                <option value="Mastercard" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/Mastercard-56.png'); }}" data-title="For everything else..." data-description="For everything else...">Mastercard</option>
                                <option value="cash" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/Cash-56.png'); }}" data-description="Sorry not available..." disabled="true">Cash on devlivery</option>
                                <option value="Visa" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/Visa-56.png'); }}" data-description="All you need...">Visa</option>
                                <option value="Paypal" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/Paypal-56.png'); }}" data-description="Pay and get paid...">Paypal</option>
                            </select> &nbsp;
                            <select name="tech" class="tech" id="tech" style="width:200px">
                                <option value="calendar" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_calendar.gif'); }}" Calendar</option>
                                <option value="shopping_cart" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_cart.gif'); }}" Shopping Cart</option>
                                <option value="cd" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_cd.gif'); }}" name="cd">CD</option>
                                <option value="email"  data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_email.gif'); }}" Email</option>
                                <option value="faq" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_faq.gif'); }}" FAQ</option>
                                <option value="games" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_games.gif'); }}" Games</option>
                                <option value="music" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_music.gif'); }}" Music</option>
                                <option value="phone" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_phone.gif'); }}" Phone</option>
                                <option value="graph" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_sales.gif'); }}" Graph</option>
                                <option value="secured" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_secure.gif'); }}" Secured</option>
                                <option value="video" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_video.gif'); }}" Video</option>
                                <option value="cd" data-image="{{ URL::asset('assets/plugins/ms-Dropdown/images/msdropdown/icons/icon_cd.gif'); }}" name="cd">CD</option>
                            </select>
                        </td>
                </table>
                <div class="row">
                    <div class="col-md-1">
                        <p>
                            Time Picker
                        </p>
                        <div class="input-group input-append bootstrap-timepicker">
                            <input type="text" class="form-control time-picker">
                            <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-1">
                        <p>
                            Time Picker
                        </p>
                        <div class="input-group input-append bootstrap-timepicker">
                            <input type="text" class="form-control time-picker">
                            <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')

<!-- Scripts for This page only -->
<script src="{{ URL::asset('assets/plugins/ms-Dropdown/js/msdropdown/jquery.dd.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/x-editable/js/bootstrap-editable.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/typeaheadjs/typeaheadjs.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/typeaheadjs/lib/typeahead.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-address/address.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js'); }}"></script>
<script src="{{ URL::asset('assets/plugins/wysihtml5/wysihtml5.js'); }}"></script>
<script src="{{ URL::asset('assets/js/modifiedJs/admin/test-xeditable.js'); }}"></script>
<script>
jQuery(document).ready(function() {
    Main.init();
    SVExamples.init();
    //function to initiate bootstrap-timepicker
    $('.time-picker').timepicker({
        showMeridian: false
    });
    $("#payments").msDropdown({visibleRows: 4});
    $("#tech").msDropdown().data("dd");//{animStyle:'none'} /{animStyle:'slideDown'} {animStyle:'show'}	
});
</script>
@stop
