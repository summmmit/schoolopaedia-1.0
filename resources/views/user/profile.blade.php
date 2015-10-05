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

        .profile .cover-image {
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

        .img-profile {
            height: 100px;
            width: 100px;
        }

        .img-cover {
            width: 100%;
            height: 300px;
        }

        .upload-btn {
            top: 26px;
            left: -45px;
        }

        .cover-upload-btn {
            position: absolute;
            top: 8px;
            right: 6px;
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
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile clearfix">
                        <div class="cover-image clearfix">
                            <form role="form" id="cover_image_change" enctype="multipart/form-data">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <img src="{{ URL::asset('school/images/default-cover-pic.jpg') }}"
                                         class="img-cover" id="user-cover-pic">
                                    <div class="user-image-buttons">
																		<span class="btn btn-azure btn-file btn-sm cover-upload-btn no-display">
                                                                            <span class="fileupload-new"><i class="fa fa-camera"></i></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-camera"></i></span>
																			<input class="form-control" type="file" id="cover_image" name="cover_image">
																		</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="user clearfix">
                            <div class="avatar">
                                <img src="{{ URL::asset('school/images/anonymous.jpg') }}" alt=""
                                     class="img-thumbnail img-profile" id="img-profile">
									<span class="btn btn-light-purple btn-file btn-sm upload-btn no-display"
                                          data-target=".modal-update-profile-pic" data-toggle="modal">
                                                                            <span class="fileupload-new">
                                                                                <i class="fa fa-camera"></i>
                                                                            </span>
                                    </span>
                            </div>
                            <h2 id="user-name">Sumit Singh</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('subview')
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
         class="modal modal-update-profile-pic fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                        <i class="fa fa-close"></i>
                    </button>
                    <h4 id="myModalLabel" class="modal-title">Update Profile Pic</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- start: PREVIEW PANE PANEL -->
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="user-left">
                                        <div class="center">
                                            <form role="form" id="profile_image_change" enctype="multipart/form-data">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="user-image">
                                                        <div class="fileupload-new thumbnail"><img
                                                                    src="{{ URL::asset('assets/images/avatar-1-xl.jpg') }}"
                                                                    alt="" id="profile_image_update_icon">
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                                        <div class="user-image-buttons">
																		<span class="btn btn-azure btn-file btn-sm"><span
                                                                                    class="fileupload-new"><i
                                                                                        class="fa fa-pencil"></i></span><span
                                                                                    class="fileupload-exists"><i
                                                                                        class="fa fa-pencil"></i></span>
																			<input class="form-control" type="file"
                                                                                   id="profile_image"
                                                                                   name="profile_image">
																		</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button data-dismiss="modal" class="btn btn-default" type="button"
                                                        id="button_close_profile_image">
                                                    Close
                                                </button>
                                                <button class="btn btn-primary no-display" type="submit"
                                                        id="button_update_profile_image">
                                                    Save changes
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: PREVIEW PANE PANEL -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @stop
    @section('scripts')
            <!-- Scripts for This page only -->
    <script src="{{ URL::asset('assets/plugins/bootstrap-modal/js/bootstrap-modal.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"></script>
    <script src="{{ URL::asset('school/profile-page-modals.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            SVExamples.init();
            ProfilePageModals.init();
        });
    </script>

@stop
