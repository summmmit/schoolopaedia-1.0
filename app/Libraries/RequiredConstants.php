<?php
/**
 * Created by PhpStorm.
 * User: 1084760
 * Date: 2015/08/27
 * Time: 11:12
 */

namespace app\Libraries;


class RequiredConstants
{
    Const ADMIN = 'admin';
    Const USER = 'user';
    Const TEACHER = 'teacher';

    Const ADMIN_ROUTE = 'admin/*';
    Const USER_ROUTE = 'user/*';
    Const TEACHER_ROUTE = 'teacher/*';

    Const ADMIN_ROUTE_PREFIX = '/admin/';
    Const USER_ROUTE_PREFIX = '/user/';
    Const TEACHER_ROUTE_PREFIX = '/teacher/';

    // Images Folder Paths
    Const USER_PROFILE_IMAGES_PATH = "school/images/user/profile_images/";
    Const USER_COVER_PICS_PATH = "school/images/user/profile_images/";

    Const ADMIN_PROFILE_IMAGES_PATH = "school/images/admin/profile_images/";
    Const ADMIN_COVER_PICS_PATH = "school/images/admin/profile_images/";

    Const TEACHER_PROFILE_IMAGES_PATH = "school/images/teacher/profile_images/";
    Const TEACHER_COVER_PICS_PATH = "school/images/teacher/profile_images/";

    Const MAXIMUM_PROFILE_IMAGE_SIZE = 50000;
}