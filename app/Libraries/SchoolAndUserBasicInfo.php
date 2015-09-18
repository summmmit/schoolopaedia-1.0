<?php
/**
 * Created by PhpStorm.
 * User: 1084760
 * Date: 2015/09/02
 * Time: 12:39
 */

namespace app\Libraries;
use App\Models\SchoolSession;
use App\Models\User;
use App\Models\UsersRegisteredToSchool;
use Auth;


class SchoolAndUserBasicInfo
{
    protected $user;

    protected $userId;

    protected $schoolId;

    protected $currentSchoolSession;

    protected $currentSchoolSessionId;

    /**
     * SchoolAndUserBasicInfo constructor.
     * @param $user
     * @param $userId
     * @param $schoolId
     */
    public function __construct()
    {
        $userId = Auth::user()->id;

        $this->userId = $userId;

        $this->user = User::find($userId);

        $this->schoolId = UsersRegisteredToSchool::where('user_id', $userId)->get()->first()->school_id;

        $this->currentSchoolSession = SchoolSession::where('school_id', $this->schoolId)->where('current_session', 1)->get()->first();

        $this->currentSchoolSessionId = $this->currentSchoolSession->id;
    }

    /**
     * @return UserId of the LoggedIn User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return User Model for the LoggedIn User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return SchoolId of the LoggedIn User
     */
    public function getSchoolId()
    {
        return $this->schoolId;
    }

    /**
     * @return CurrentSchoolSession Id
     */
    public function getCurrentSchoolSessionId()
    {
        return $this->currentSchoolSessionId;
    }

    /**
     * @return mixed
     */
    public function getCurrentSchoolSession()
    {
        return $this->currentSchoolSession;
    }
}