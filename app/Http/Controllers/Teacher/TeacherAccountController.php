<?php

namespace App\Http\Controllers\Teacher;

use App\Models\UsersRegisteredToSession;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Libraries\ApiResponseClass;

class TeacherAccountController extends Controller
{
    public function getHome()
    {
        return view('teacher.home');
    }

    public function getWelcomeSettings()
    {
        return view('teacher.welcome-settings');
    }

    public function getSetInitial()
    {
        return view('teacher.initial-school-settings');
    }

    public function postSetInitial(Request $request)
    {
        $session_id = $request->input('session_id');

        $input = [
            'session_id' => $session_id,
        ];

        $validator = validator::make($request->all(), [
            'session_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $user_registered_to_session = new UsersRegisteredToSession();
            $user_registered_to_session->session_id = $session_id;
            $user_registered_to_session->school_id = $this->getSchoolAndUserBasicInfo()->getSchoolId();
            $user_registered_to_session->user_id = $this->getSchoolAndUserBasicInfo()->getUserId();

            $user_registered_to_session->save();
            if ($user_registered_to_session->save()) {
                return ApiResponseClass::successResponse($user_registered_to_session, $input);
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }
}
