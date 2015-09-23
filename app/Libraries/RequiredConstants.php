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
}