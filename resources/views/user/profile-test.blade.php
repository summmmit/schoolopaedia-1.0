@extends('layouts.main-layout')

@section('page_header')
    <h1><i class="fa fa-home"></i> User Profile</h1>
@stop

@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">
    <style type="text/css">
        .profile {
            width: 100%;
            position: relative;
            background: #FFF;
            border: 1px solid #D5D5D5;
            padding-bottom: 5px;
            margin-bottom: 0px;
        }

        .profile .image {
            display: block;
            position: relative;
            z-index: 1;
            overflow: hidden;
            text-align: center;
            border: 5px solid #FFF;
        }

        .profile .user {
            position: relative;
            padding: 0px 5px 5px;
        }

        .profile .user .avatar {
            position: absolute;
            left: 20px;
            top: -85px;
            z-index: 2;
        }

        .profile .user h2 {
            font-size: 16px;
            line-height: 20px;
            display: block;
            float: left;
            margin: 4px 0px 0px 135px;
            font-weight: bold;
        }

        .profile .user .actions {
            float: right;
        }

        .profile .user .actions .btn {
            margin-bottom: 0px;
        }

        .profile .info {
            float: left;
            margin-left: 20px;
        }

        .img-profile {
            height: 100px;
            width: 100px;
        }

        .img-cover {
            width: 100%;
            height: 300px;
        }

        @media (max-width: 768px) {
            .btn-responsive {
                padding: 2px 4px;
                font-size: 80%;
                line-height: 1;
                border-radius: 3px;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .btn-responsive {
                padding: 4px 9px;
                font-size: 90%;
                line-height: 1.2;
            }
        }

        @media (max-width: 769px) {

            .img-cover {
                height: 200px;
            }
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
            User Profile
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
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ URL::route('user-update-profile-pic') }}" role="form" id="profile_image_change" enctype="multipart/form-data" method="post">
                <input type="file" class="form-control" id="profile_image" name="profile_image"><br>
                <button type="submit" class="btn btn-success">Submit</button>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
    @stop

    @section('scripts')
            <!-- Scripts for This page only -->
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();

            $('form').on('submit', uploadFiles);

            function uploadFiles(event) {
                event.stopPropagation(); // Stop stuff happening
                event.preventDefault(); // Totally stop stuff happening

                // START A LOADING SPINNER HERE
                $.ajax({
                    url: serverUrl + '/user/update/profile/pic',
                    dataType: 'json',
                    cache: false,
                    method: 'POST',
                    data: new FormData($('#profile_image_change')[0]),
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false
                    success: function (result, response) {
                        console.log(result);
                    },
                    error: function(result){
                        console.log("error");
                        console.log(result);
                    }
                });
            }
        });
    </script>

@stop
