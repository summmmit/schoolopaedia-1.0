<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\SchoolAndUserBasicInfo;

class AdminStudentSettingsController extends Controller
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

    public function getSchoolStudents()
    {
        return view('admin.school-students');
    }

    public function getAllTheStudentsRegisteredToSchool()
    {
        $query = 'SELECT
                  user_details.id,
                  user_details.first_name,
                  user_details.last_name,
                  user_details.user_id
                  FROM user_details
                  JOIN users_registered_to_school
                  ON users_registered_to_school.user_id = user_details.user_id
                  JOIN user_group
                  ON user_group.user_id = user_details.user_id
                  WHERE user_group.group_id = ? AND users_registered_to_school.school_id = ?';
        $all_school_teachers = DB::select($query, array(2, $this->getSchoolAndUserBasicInfo()->getSchoolId()));

        return ApiResponseClass::successResponse($all_school_teachers);
    }
}
