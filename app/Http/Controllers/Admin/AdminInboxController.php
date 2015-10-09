<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Libraries\ApiResponseClass;

class AdminInboxController extends Controller
{
    protected $_schoolAndUserBasicInfo;

    /**
     * AdminSchoolSettingsController constructor.
     * @param SchoolAndUserBasicInfo $schoolAndUserBasicInfo
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

    //**-----------------------------------------------------Inbox ---------------------------------------------------**

    public function getInbox(){
        return view('admin.inbox');
    }
}
