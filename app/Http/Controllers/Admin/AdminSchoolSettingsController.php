<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Validator;
use DB;
use App\Libraries\ApiResponseClass;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Models\SchoolSession;

class AdminSchoolSettingsController extends Controller
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

    public function getSetInitial()
    {
        return view('admin.set-initial-school-sessions');
    }

    public function postSetSchoolSessions(Request $request) {
        $start_session_from = $request->input('start_session_from');
        $end_session_untill = $request->input('end_session_untill');
        $current_session = $request->input('current_session');

        $input = [
            'start_session_from' => $start_session_from,
            'end_session_untill' => $end_session_untill,
            'current_session' => $current_session
        ];

        $validator = validator::make($request->all(), [
            'start_session_from' => 'required|date',
            'end_session_untill' => 'required|date'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            DB::beginTransaction();

            try{

                if($current_session){

                    $school_sessions = SchoolSession::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->where('current_session', 1)->get();

                    foreach($school_sessions as $school_session){

                        $school_session->current_session = 0;
                        if (!$school_session->save()) {
                            throw new \ErrorException();
                        }
                    }
                }

                $new_school_session = new SchoolSession();
                $new_school_session->session_start = $start_session_from;
                $new_school_session->session_end = $end_session_untill;
                $new_school_session->school_id = $this->getSchoolAndUserBasicInfo()->getSchoolId();
                $new_school_session->current_session = $current_session;

                if (!$new_school_session->save()) {
                    throw new \ErrorException();
                }

                DB::commit();

            }catch (ErrorException $e){
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input, $validator->errors());
            }

            return ApiResponseClass::successResponse($new_school_session, $input);
        }

        return ApiResponseClass::errorResponse('You Have Some Input Errors. Yes', $input, $validator->errors());
    }

}
