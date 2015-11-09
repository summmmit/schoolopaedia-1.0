@extends('layouts.main-layout')

@section('page_header')
    <h1><i class="fa fa-home"></i> Home</h1>
@stop

@section('stylesheets')
    <link rel="stylesheet"
          href="{{ URL::asset('assets/plugins/material-design-floating-action-button/dist/css/kc.fab.css') }}"/>
    <link rel="stylesheet"
          href="{{ URL::asset('assets/plugins/multiple-emails/multiple-emails.css') }}"/>
    <style>
        .mail-box {
            border-collapse: collapse;
            border-spacing: 0;
            display: table;
            table-layout: fixed;
            width: 100%;
        }

        .mail-box aside {
            display: table-cell;
            float: none;
            height: 100%;
            padding: 0;
            vertical-align: top;
        }

        .mail-box .sm-side {
            background: none repeat scroll 0 0;
            border-radius: 4px 0 0 4px;
            width: 25%;
        }

        .mail-box .lg-side {
            background: none repeat scroll 0 0;
            border-radius: 0 4px 4px 0;
            width: 75%;
        }

        .mail-box .sm-side .user-head {
            background: none repeat scroll 0 0 #00a8b3;
            border-radius: 4px 0 0;
            color: #fff;
            min-height: 80px;
            padding: 10px;
        }

        .user-head .inbox-avatar {
            float: left;
            width: 65px;
        }

        .user-head .inbox-avatar img {
            border-radius: 4px;
        }

        .user-head .user-name {
            display: inline-block;
            margin: 0 0 0 10px;
        }

        .user-head .user-name h5 {
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 0;
            margin-top: 15px;
        }

        .user-head .user-name h5 a {
            color: #fff;
        }

        .user-head .user-name span a {
            color: #87e2e7;
            font-size: 12px;
        }

        a.mail-dropdown {
            background: none repeat scroll 0 0 #80d3d9;
            border-radius: 2px;
            color: #01a7b3;
            font-size: 10px;
            margin-top: 20px;
            padding: 3px 5px;
        }

        .inbox-body {
            padding: 10px;
            padding-top: 0;
        }

        .btn-compose {
            background: none repeat scroll 0 0 #ff6c60;
            color: #fff;
            padding: 12px 0;
            text-align: center;
            width: 100%;
        }

        .btn-compose:hover {
            background: none repeat scroll 0 0 #f5675c;
            color: #fff;
        }

        ul.inbox-nav {
            display: inline-block;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .inbox-divider {
            border-bottom: 1px solid #d5d8df;
        }

        ul.inbox-nav li {
            display: inline-block;
            line-height: 45px;
            width: 100%;
        }

        ul.inbox-nav li a {
            color: #6a6a6a;
            display: inline-block;
            line-height: 45px;
            padding: 0 20px;
            width: 100%;
        }

        ul.inbox-nav li a:hover, ul.inbox-nav li.active a, ul.inbox-nav li a:focus {
            background: none repeat scroll 0 0 #d5d7de;
            color: #6a6a6a;
        }

        ul.inbox-nav li a i {
            color: #6a6a6a;
            font-size: 16px;
            padding-right: 10px;
        }

        ul.inbox-nav li a span.label {
            margin-top: 13px;
        }

        ul.labels-info li h4 {
            color: #5c5c5e;
            font-size: 13px;
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 5px;
            text-transform: uppercase;
        }

        ul.labels-info li {
            margin: 0;
        }

        ul.labels-info li a {
            border-radius: 0;
            color: #6a6a6a;
        }

        ul.labels-info li a:hover, ul.labels-info li a:focus {
            background: none repeat scroll 0 0 #d5d7de;
            color: #6a6a6a;
        }

        ul.labels-info li a i {
            padding-right: 10px;
        }

        .nav.nav-pills.nav-stacked.labels-info p {
            color: #9d9f9e;
            font-size: 11px;
            margin-bottom: 0;
            padding: 0 22px;
        }

        .inbox-head {
            background: none repeat scroll 0 0 #41cac0;
            border-radius: 0 4px 0 0;
            color: #fff;
            min-height: 80px;
            padding: 20px;
        }

        .inbox-head h3 {
            display: inline-block;
            font-weight: 300;
            margin: 0;
            padding-top: 6px;
        }

        .inbox-head .sr-input {
            border: medium none;
            border-radius: 4px 0 0 4px;
            box-shadow: none;
            color: #8a8a8a;
            float: left;
            height: 40px;
            padding: 0 10px;
        }

        .inbox-head .sr-btn {
            background: none repeat scroll 0 0 #00a6b2;
            border: medium none;
            border-radius: 0 4px 4px 0;
            color: #fff;
            height: 40px;
            padding: 0 20px;
        }

        .table-inbox {
            border: 1px solid #d3d3d3;
            margin-bottom: 0;
        }

        .table-inbox tr td {
            padding: 12px !important;
        }

        .table-inbox tr td:hover {
            cursor: pointer;
        }

        .table-inbox tr td .fa-star.inbox-started, .table-inbox tr td .fa-star:hover {
            color: #f78a09;
        }

        .table-inbox tr td .fa-star {
            color: #d5d5d5;
        }

        .table-inbox tr.unread td {
            background: none repeat scroll 0 0 #f7f7f7;
            font-weight: 600;
        }

        ul.inbox-pagination {
            float: right;
        }

        ul.inbox-pagination li {
            float: left;
        }

        .mail-option {
            display: inline-block;
            margin-bottom: 10px;
            width: 100%;
        }

        .mail-option .chk-all, .mail-option .btn-group {
            margin-right: 5px;
        }

        .mail-option .chk-all, .mail-option .btn-group a.btn {
            background: none repeat scroll 0 0 #fcfcfc;
            border: 1px solid #e7e7e7;
            border-radius: 3px !important;
            color: #afafaf;
            display: inline-block;
            padding: 5px 10px;
        }

        .inbox-pagination a.np-btn {
            background: none repeat scroll 0 0 #fcfcfc;
            border: 1px solid #e7e7e7;
            border-radius: 3px !important;
            color: #afafaf;
            display: inline-block;
            padding: 5px 15px;
        }

        .mail-option .chk-all input[type="checkbox"] {
            margin-top: 0;
        }

        .mail-option .btn-group a.all {
            border: medium none;
            padding: 0;
        }

        .inbox-pagination a.np-btn {
            margin-left: 5px;
        }

        .inbox-pagination li span {
            display: inline-block;
            margin-right: 5px;
            margin-top: 7px;
        }

        .fileinput-button {
            background: none repeat scroll 0 0 #eeeeee;
            border: 1px solid #e6e6e6;
        }

        .inbox-body .modal .modal-body input, .inbox-body .modal .modal-body textarea {
            border: 1px solid #e6e6e6;
            box-shadow: none;
        }

        .btn-send, .btn-send:hover {
            background: none repeat scroll 0 0 #00a8b3;
            color: #fff;
        }

        .btn-send:hover {
            background: none repeat scroll 0 0 #009da7;
        }

        .modal-header h4.modal-title {
            font-family: "Open Sans", sans-serif;
            font-weight: 300;
        }

        .modal-body label {
            font-family: "Open Sans", sans-serif;
            font-weight: 400;
        }

        .heading-inbox h4 {
            border-bottom: 1px solid #ddd;
            color: #444;
            font-size: 18px;
            margin-top: 20px;
            padding-bottom: 10px;
        }

        .sender-info {
            margin-bottom: 20px;
        }

        .sender-info img {
            height: 30px;
            width: 30px;
        }

        .sender-dropdown {
            background: none repeat scroll 0 0 #eaeaea;
            color: #777;
            font-size: 10px;
            padding: 0 3px;
        }

        .view-mail a {
            color: #ff6c60;
        }

        .attachment-mail {
            margin-top: 30px;
        }

        .attachment-mail ul {
            display: inline-block;
            margin-bottom: 30px;
            width: 100%;
        }

        .attachment-mail ul li {
            float: left;
            margin-bottom: 10px;
            margin-right: 10px;
            width: 150px;
        }

        .attachment-mail ul li img {
            width: 100%;
        }

        .attachment-mail ul li span {
            float: right;
        }

        .attachment-mail .file-name {
            float: left;
        }

        .attachment-mail .links {
            display: inline-block;
            width: 100%;
        }

        .fileinput-button {
            float: left;
            margin-right: 4px;
            overflow: hidden;
            position: relative;
        }

        .fileinput-button input {
            cursor: pointer;
            direction: ltr;
            font-size: 23px;
            margin: 0;
            opacity: 0;
            position: absolute;
            right: 0;
            top: 0;
            transform: translate(-300px, 0px) scale(4);
        }

        .fileupload-buttonbar .btn, .fileupload-buttonbar .toggle {
            margin-bottom: 5px;
        }

        .files .progress {
            width: 200px;
        }

        .fileupload-processing .fileupload-loading {
            display: block;
        }

        * html .fileinput-button {
            line-height: 24px;
            margin: 1px -3px 0 0;
        }

        * + html .fileinput-button {
            margin: 1px 0 0;
            padding: 2px 15px;
        }

        @media (max-width: 767px) {
            .files .btn span {
                display: none;
            }

            .files .preview * {
                width: 40px;
            }

            .files .name * {
                display: inline-block;
                width: 80px;
                word-wrap: break-word;
            }

            .files .progress {
                width: 20px;
            }

            .files .delete {
                width: 60px;
            }
        }

        ul {
            list-style-type: none;
            padding: 0px;
            margin: 0px;
        }

        /******************* read Email*******************/

        section.panel ul.list-group li.list-group-item {
            margin-left: 10px;
        }

        section.panel ul.list-group li.list-group-item {
            background-color: #ffffff;
            -webkit-transition: all 0.75s;
            -moz-transition: all 0.75s;
            transition: all 0.75s;
            border-left: 3px solid rgb(245, 245, 245);
            color: #1C7EBB;
            font-size: 18px;
        }

        section.panel ul.list-group li.list-group-item:hover {
            background-color: #f5f5f5;
            text-decoration: none;
            background-color: #FAFAFA;
            border-left: 3px solid #555555;
            color: #1C7EBB;
        }

        section.panel ul.list-group li.list-group-item a {
            -webkit-transition: all 0.75s;
            -moz-transition: all 0.75s;
            transition: all 0.75s;
        }

        section.panel ul.list-group li.list-group-item a:hover {
            text-decoration: none;
            color: blue;
            color: #1C7EBB;
        }

        section.panel ul.list-group li.list-group-item i {
            margin-right: 10px;
            margin-left: -10px;
        }

        .mail-info ul {
            list-style: none;
        }

        .mail-info ul li:before {
            content: '| \0000a0';
            font-size: 1.2em;
            font-weight: bold;
        }

        .mail-info ul li i {
            margin-left: 10px;
            margin-right: 10px;
        }

    </style>
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
            @if(Session::has('global'))
                <div class="errorHandler alert alert-success">
                    <i class="fa fa-remove-sign"></i>{{ Session::get('global') }}
                </div>
            @endif
        </div>
    </div>
    <div class="mail-box">
        <aside class="sm-side">
            <div class="panel">
                <div class="panel-body">
                    <div class="inbox-body">
                        <a href="#myModal" data-toggle="modal" title="Compose" class="btn btn-compose">
                            Compose
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <ul class="inbox-nav inbox-divider" id="inbox-folders">
                        <li class="active">
                            <a href="#" id="button-folder-inbox">
                                <i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="button-folder-sent-mails">
                                <i class="fa fa-envelope-o"></i> Sent Mail <span class="label label-success pull-right">2</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="button-folder-important">
                                <i class=" fa fa-external-link"></i> Important <span class="label label-info pull-right">30</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="button-folder-trash">
                                <i class=" fa fa-trash-o"></i> Trash <span class="label label-danger pull-right">2</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
                        <li><h4>Labels</h4></li>
                        <li><a href="#"> <i class=" fa fa-sign-blank text-danger"></i> Work </a></li>
                        <li><a href="#"> <i class=" fa fa-sign-blank text-success"></i> Design </a></li>
                        <li><a href="#"> <i class=" fa fa-sign-blank text-info "></i> Family </a>
                        </li>
                        <li><a href="#"> <i class=" fa fa-sign-blank text-warning "></i> Friends </a>
                        </li>
                        <li><a href="#"> <i class=" fa fa-sign-blank text-primary "></i> Office </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <aside class="lg-side">
            <div class="inbox-body">
                <div class="panel incoming-mails">
                    <div class="panel-body">
                        <div class="mail-option">
                            <div class="chk-all">
                                <input type="checkbox" class="mail-checkbox mail-group-checkbox">

                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                        All
                                        <i class="fa fa-angle-down "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"> None</a></li>
                                        <li><a href="#"> Read</a></li>
                                        <li><a href="#"> Unread</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#"
                                   class="btn mini tooltips">
                                    <i class=" fa fa-refresh"></i>
                                </a>
                            </div>
                            <div class="btn-group hidden-phone">
                                <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                    More
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                    Move to
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>

                            <ul class="unstyled inbox-pagination">
                                <li><span>1-50 of 234</span></li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                </li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                </li>
                            </ul>
                        </div>
                        <table class="table table-inbox table-hover" id="table-inbox-incoming-mails">
                            <tbody>
                            </tbody>
                        </table>
                        <table class="table table-inbox table-hover no-display" id="table-inbox-sent-mails">
                            <tbody>
                            <tr class="unread">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                <td class="view-message dont-show">Google Webmaster</td>
                                <td class="view-message">Improve the search presence of WebSite</td>
                                <td class="view-message inbox-small-cells"></td>
                                <td class="view-message text-right">March 15</td>
                            </tr>
                            <tr class="">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                <td class="view-message dont-show">JW Player</td>
                                <td class="view-message">Last Chance: Upgrade to Pro for</td>
                                <td class="view-message inbox-small-cells"></td>
                                <td class="view-message text-right">March 15</td>
                            </tr>
                            <tr class="">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                <td class="view-message dont-show">Tim Reid, S P N</td>
                                <td class="view-message">Boost Your Website Traffic</td>
                                <td class="view-message inbox-small-cells"></td>
                                <td class="view-message text-right">April 01</td>
                            </tr>
                            <tr class="">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                <td class="view-message dont-show">Freelancer.com <span
                                            class="label label-danger pull-right">urgent</span>
                                </td>
                                <td class="view-message">Stop wasting your visitors</td>
                                <td class="view-message inbox-small-cells"></td>
                                <td class="view-message text-right">May 23</td>
                            </tr>
                            <tr class="">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                <td class="view-message dont-show">WOW Slider</td>
                                <td class="view-message">New WOW Slider v7.8 - 67% off</td>
                                <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                <td class="view-message text-right">March 14</td>
                            </tr>
                            <tr class="">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                <td class="view-message dont-show">LinkedIn Pulse</td>
                                <td class="view-message">The One Sign Your Co-Worker Will Stab</td>
                                <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                <td class="view-message text-right">Feb 19</td>
                            </tr>
                            <tr class="">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                <td class="view-message dont-show">Drupal Community<span
                                            class="label label-success pull-right">megazine</span>
                                </td>
                                <td class="view-message view-message">Welcome to the Drupal Community</td>
                                <td class="view-message inbox-small-cells"></td>
                                <td class="view-message text-right">March 04</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default mail-container read-mails no-display">
                    <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> View
                            Article</strong></div>
                    <div class="panel-body">
                        <div class="mail-header row">
                            <div class="col-md-4 col-md-offset-8">
                                <div class="pull-right">
                                    <a href="#/mail/compose" class="btn btn-sm btn-default">Reply <i
                                                class="fa fa-mail-reply"></i></a>
                                    <a href="javascript:;" class="btn btn-sm btn-default"><i
                                                class="fa fa-print"></i></a>
                                    <a href="javascript:;" class="btn btn-sm btn-default"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="mail-header row">
                            <div class="col-md-12">
                                <h3>How to include an image in production description</h3>
                            </div>
                        </div>
                        <div class="mail-info">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-unstyled list-inline">
                                        <li><i class="fa fa-calendar-o"></i>8/28/2013</li>
                                        <li><i class="fa fa-user"></i>Sergio Rodriguez</li>
                                        <li><i class="glyphicon glyphicon-bookmark"></i><a
                                                    href="http://localhost:8080/Utilities/xmlKnowledgeBase23/index.asp?displayCategory=yes&id=Gateway">Gateway</a>
                                        </li>
                                        <li><i class="fa fa-star"></i>33 views</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mail-content">
                            <p>Quo, animi, reprehenderit, dolorem obcaecati reiciendis quasi accusamus totam alias
                                sapiente sint tempore quam adipisci temporibus unde odit eveniet eum molestias! Esse,
                                hic ut maxime animi et! Dolores, cum libero pariatur facere nesciunt tempore. Expedita,
                                vel, ut illo magni quis suscipit nisi deserunt enim eaque veniam.</p>
                            <blockquote>Ipsum dolor sit amet, consectetur adipisicing elit. Doloremque, error, nulla,
                                quia, neque est animi necessitatibus qui vero beatae quae ut laudantium facere
                                consequuntur maiores cupiditate amet vitae magni nihil!
                                <small>Someone famous</small>
                            </blockquote>
                            <p>Officiis, tempore, unde, sint in ut neque alias ad est ex fugit odio nobis nemo dolorem
                                aperiam labore ipsam sapiente optio nostrum perferendis ab. Molestias, </p>

                            <p>sit, dolorem consequuntur vel quibusdam illum veniam veritatis vitae blanditiis officiis
                                ducimus voluptatibus omnis cum quae tempore porro reiciendis animi dignissimos optio rem
                                laborum eius magnam. Esse, accusantium quia deleniti fugiat commodi architecto itaque
                                nulla in. Consequatur beatae non explicabo in qui aspernatur deleniti quas
                                doloribus!</p>

                            <p>Aperiam, veniam, quae temporibus ratione suscipit accusantium provident amet deserunt
                                natus veritatis ipsa error accusamus saepe debitis quisquam labore facilis magnam
                                impedit minus explicabo quidem dicta ipsam nam velit quasi esse ad culpa sequi dolorum
                                eaque. Iste exercitationem facilis nemo aut quae! Sit?</p>
                        </div>
                        <div class="mail-attachments">
                            <p><i class="fa fa-paperclip"></i> 2 attachements | <a href="javascript:;">Download all
                                    attachements</a></p>
                            <ul class="list-unstyled">
                                <li><a>iniformation.pdf</a></li>
                                <li><a>drivername.ini</a></li>
                            </ul>
                        </div>
                        <div class="mail-actions">
                            <a href="#/mail/compose" class="btn btn-sm btn-default">Reply <i
                                        class="fa fa-mail-reply"></i></a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default compose-new-email no-display">
                    <div class="panel-body">
                        <form accept-charset="UTF-8" action="" method="POST" role="form" class="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="recipients" placeholder="Recipients"
                                       style="margin-bottom:10px;"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject"
                                       style="margin-bottom:10px;"/>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control counted" name="message" placeholder="Type in your message"
                                          rows="5" style="margin-bottom:10px;"></textarea>
                            </div>
                            <h6 class="pull-right" id="counter">2500 characters remaining</h6>
                            <button class="btn btn-info" id="send_new_mail" type="button">Send New Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <div class="kc_fab_wrapper">
    </div>
    @stop

    @section('scripts')

            <!-- Scripts for This page only -->
    <script src="{{ URL::asset('assets/plugins/material-design-floating-action-button/dist/js/kc.fab.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/multiple-emails/multiple-emails.js') }}"></script>
    <script src="{{ URL::asset('school/inbox.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            InboxSettings.init();
            var links = [
                {
                    "bgcolor": "green",
                    "icon": "+"
                },
                {
                    "url": "http://www.example.com",
                    "bgcolor": "red",
                    "color": "#fffff",
                    "icon": "<i class='fa fa-camera'></i>",
                    "target": "_blank"
                },
                {
                    "url": "http://www.example.com",
                    "bgcolor": "black",
                    "color": "white",
                    "icon": "<i class='fa fa-music'></i>"
                }
            ]

            $('.kc_fab_wrapper').kc_fab(links);

            $('input[name="recipients"]').multiple_emails({
                position: 'top', // Display the added emails above the input
                theme: 'bootstrap', // Bootstrap is the default theme
                checkDupEmail: true // Should check for duplicate emails added
            });
        });
    </script>

@stop
