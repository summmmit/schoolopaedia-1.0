<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Libraries\ApiResponseClass;
use DB;

class AdminTeacherSettingsController extends Controller
{
    protected $_schoolAndUserBasicInfo;

    /**
     * AdminSchoolSettingsController constructor.
     */
    public function __construct(SchoolAndUserBasicInfo $schoolAndUserBasicInfo)
    {
        $this->_schoolAndUserBasicInfo = $schoolAndUserBasicInfo;
    }

    /**
     * @return SchoolAndUserBasicInfo
     */
    public function getSchoolAndUserBasicInfo()
    {
        return $this->_schoolAndUserBasicInfo;
    }

    public function getSchoolTeachers()
    {
        return view('admin.school-teachers');
    }

    public function postGetAllTheTeachersRegisteredToSchool()
    {
        $query = 'SELECT user_details.id, user_details.first_name, user_details.last_name, user_details.user_id FROM user_details
                  JOIN users_registered_to_school
                  ON users_registered_to_school.user_id = user_details.user_id
                  JOIN user_group
                  ON user_group.user_id = user_details.user_id
                  WHERE user_group.group_id = ? AND users_registered_to_school.school_id = ?';
        $all_school_teachers = DB::select($query, array(3, $this->getSchoolAndUserBasicInfo()->getSchoolId()));

        return ApiResponseClass::successResponse($all_school_teachers);
    }
}
