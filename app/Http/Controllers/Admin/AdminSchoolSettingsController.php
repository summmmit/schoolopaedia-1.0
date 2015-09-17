<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schools;
use App\Models\SchoolScheduleProfiles;
use App\Models\SchoolSchedules;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use PhpSpec\Exception\Example\ErrorException;
use Validator;
use DB;
use App\Libraries\ApiResponseClass;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Models\SchoolSession;
use App\Models\SchoolSchedule;

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

    public function postSetSchoolSessions(Request $request)
    {
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

            try {

                if ($current_session) {

                    $school_sessions = SchoolSession::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->where('current_session', 1)->get();

                    foreach ($school_sessions as $school_session) {

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

            } catch (ErrorException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input, $validator->errors());
            }

            return ApiResponseClass::successResponse($new_school_session, $input);
        }

        return ApiResponseClass::errorResponse('You Have Some Input Errors. Yes', $input, $validator->errors());
    }

    public function getSchoolSchedule()
    {
        $schedule_profiles = SchoolScheduleProfiles::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->get();
        return view('admin.school-schedule')->with('schedule_profiles', $schedule_profiles);
    }

    public function getSchoolSettings()
    {
        return view('admin.school-settings');
    }

    public function postSetSchoolSchedule(Request $request)
    {

        $schedule_starts_from = $request->input('schedule_starts_from');
        $schedule_ends_untill = $request->input('schedule_ends_untill');
        $school_opening_time = $request->input('school_opening_time');
        $school_lunch_time = $request->input('school_lunch_time');
        $school_closing_time = $request->input('school_closing_time');

        $school_schedule_profile_id = $request->input('schedule_profile_id');
        $schedule_id = $request->input('schedule_id');

        $input = [
            'schedule_id' => $schedule_id,
            'schedule_starts_from' => $schedule_starts_from,
            'schedule_ends_untill' => $schedule_ends_untill,
            'school_opening_time' => $school_opening_time,
            'school_lunch_time' => $school_lunch_time,
            'school_closing_time' => $school_closing_time,
            'schedule_profile_id' => $school_schedule_profile_id
        ];

        $validator = validator::make($request->all(), [
            'schedule_starts_from' => 'required|date',
            'schedule_ends_untill' => 'required|date',
            'school_opening_time' => 'required',
            'school_lunch_time' => 'required',
            'school_closing_time' => 'required',
            'schedule_profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            if ($schedule_id) {
                $school_schedule = SchoolSchedules::find($schedule_id);
            } else {
                $school_schedule = new SchoolSchedules();
            }

            $school_schedule->start_from = $schedule_starts_from;
            $school_schedule->close_untill = $schedule_ends_untill;
            $school_schedule->opening_time = $school_opening_time;
            $school_schedule->lunch_time = $school_lunch_time;
            $school_schedule->closing_time = $school_closing_time;
            $school_schedule->school_id = $this->getSchoolAndUserBasicInfo()->getSchoolId();
            $school_schedule->school_session_id = $this->getSchoolAndUserBasicInfo()->getCurrentSchoolSessionId();
            $school_schedule->school_schedule_profile_id = $school_schedule_profile_id;

            if ($school_schedule->save()) {

                return ApiResponseClass::successResponse($school_schedule, $input);
            }
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postSetSchoolScheduleProfile(Request $request)
    {

        $profile_name = $request->input('profile_name');
        $profile_id = $request->input('profile_id');

        $input = [
            'profile_name' => $profile_name
        ];

        $validator = validator::make($request->all(), [
            'profile_name' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            if ($profile_id) {
                $schedule_profile = SchoolScheduleProfiles::find($profile_id);
            } else {
                $schedule_profile = new SchoolScheduleProfiles();
            }

            $schedule_profile->profile_name = ucwords($profile_name);
            $schedule_profile->school_id = $this->getSchoolAndUserBasicInfo()->getSchoolId();

            if ($schedule_profile->save()) {

                return ApiResponseClass::successResponse($schedule_profile, $input);
            }
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postGetAllSchoolScheduleProfile()
    {

        $schedule_profiles = SchoolScheduleProfiles::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->get();

        return ApiResponseClass::successResponse($schedule_profiles);
    }

    public function postDeleteSchoolScheduleProfile(Request $request)
    {

        $profile_id = $request->input('profile_id');

        $input = [
            'profile_id' => $profile_id
        ];

        $validator = validator::make($request->all(), [
            'profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $schedule_profiles = SchoolScheduleProfiles::find($request->input('profile_id'));

            if ($schedule_profiles->current_profile) {

                return ApiResponseClass::errorResponse('This Is current Profile. You Can not delete it!!', $input);
            }

            DB::beginTransaction();

            try {
                if ($schedule_profiles && $schedule_profiles->count() > 0) {

                    $all_profile_schedules = SchoolSchedules::where('school_schedule_profile_id', $profile_id)->get();

                    foreach ($all_profile_schedules as $profile_schedule) {
                        if (!$profile_schedule->delete()) {
                            throw new ErrorException;
                        }
                    }

                    if (!$schedule_profiles->delete()) {
                        throw new ErrorException;
                    }

                    DB::commit();
                }
            } catch (ErrorException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input, $validator->errors());
            }

            return ApiResponseClass::successResponse($schedule_profiles);
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postMakeSchoolScheduleProfileCurrent(Request $request)
    {

        $profile_id = $request->input('profile_id');

        $input = [
            'profile_id' => $profile_id
        ];

        $validator = validator::make($request->all(), [
            'profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            DB::beginTransaction();

            try {

                $current_schedule_profiles = SchoolScheduleProfiles::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())
                    ->where('current_profile', 1)->get()->first();

                if ($current_schedule_profiles && $current_schedule_profiles->count() > 0) {
                    $current_schedule_profiles->current_profile = 0;

                    if (!$current_schedule_profiles->save()) {
                        throw new \ErrorException();
                    }
                }

                $schedule_profiles = SchoolScheduleProfiles::find($request->input('profile_id'));

                $schedule_profiles->current_profile = 1;
                if (!$schedule_profiles->save()) {
                    throw new \ErrorException();
                }
                DB::commit();
            } catch (ErrorException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input, $validator->errors());
            }
            return ApiResponseClass::successResponse($schedule_profiles, $input);
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postGetSchoolInformation()
    {

        $school = Schools::find($this->getSchoolAndUserBasicInfo()->getSchoolId());
        return ApiResponseClass::successResponse($school);
    }

    public function postGetAllSchedulesFromProfile(Request $request)
    {

        $profile_id = $request->input('profile_id');

        $input = [
            'profile_id' => $profile_id
        ];

        $validator = validator::make($request->all(), [
            'profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $school_schedules = SchoolSchedules::where('school_schedule_profile_id', $profile_id)->get();

            $result = [
                'school_schedules' => $school_schedules,
                'schedule_profile' => $this->findScheduleProfileById($profile_id)
            ];

            return ApiResponseClass::successResponse($result, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function findScheduleProfileById($id)
    {

        $schedule_profile = SchoolScheduleProfiles::find($id);

        return $schedule_profile;
    }

    public function postDeleteSchoolScheduleById(Request $request)
    {

        $profile_id = $request->input('profile_id');

        $input = [
            'profile_id' => $profile_id
        ];

        $validator = validator::make($request->all(), [
            'profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $school_schedules = SchoolSchedules::where('school_schedule_profile_id', $profile_id)->get();

            $result = [
                'school_schedules' => $school_schedules,
                'schedule_profile' => $this->findScheduleProfileById($profile_id)
            ];

            return ApiResponseClass::successResponse($result, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function getSchoolStudents() {

//        $query = "select
//                        users.id,
//                        users.school_id,
//                        user_details.username,
//                        user_details.first_name,
//                        user_details.last_name,
//                        users_to_class.class_id,
//                        users_to_class.section_id,
//                        user_details.pic
//                  from users
//                  join user_group
//                  on users.id=user_group.user_id and user_group.group_id=? and users.school_id=?
//                  join user_details
//                  on users.id=user_details.user_id
//                  join users_to_class
//                  on users_to_class.user_id=users.id";
//        $all_school_users = DB::select($query, array(2, $this->getSchoolAndUserBasicInfo()->getSchoolId()));
//        $i = 0;
//        foreach ($all_school_users as $all_school_user) {
//
//            $class = Classes::find($all_school_user->class_id)->get()->first();
//            $all_users[$i]['class_name'] = $class->class;
//            $section = Sections::find($all_school_user->section_id);
//            $all_users[$i]['section_name'] = $section->section_name;
//
//            $all_users[$i]['username'] = $all_school_user->username;
//            $all_users[$i]['first_name'] = $all_school_user->first_name;
//            $all_users[$i]['last_name'] = $all_school_user->last_name;
//            $all_users[$i]['pic'] = $all_school_user->pic;
//            $all_users[$i]['id'] = $all_school_user->id;
//            $all_users[$i]['school_id'] = $all_school_user->school_id;
//            $i++;
//        }

        //return View::make('admin.school-students')->with('users', $all_users);
        return view('admin.school-students');
    }

}
