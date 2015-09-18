<?php

namespace App\Http\Controllers\User;

use App\Models\SchoolSession;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Libraries\ApiResponseClass;
use App\Models\UsersToClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserAccountController extends Controller
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

    public function getHome()
    {
        return view('user.home');
    }

    public function getWelcomeSettings()
    {
        return view('user.welcome-settings');
    }

    public function getSetInitial()
    {
        //$school_session = SchoolSession::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->get()->first();
        return view('user.initial-school-settings')->with('session', $this->getSchoolAndUserBasicInfo()->getCurrentSchoolSession());
    }

    public function postSetInitial(Request $request)
    {
        $session_id = $request->input('session_id');
        $stream_id = $request->input('stream_id');
        $class_id   = $request->input('class_id');
        $section_id   = $request->input('section_id');

        $input = [
            'session_id' => $session_id,
            'stream_id' => $stream_id,
            'class_id' => $class_id,
            'section_id' => $section_id
        ];

        $validator = validator::make($request->all(), [
            'session_id' => 'required',
            'stream_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $user_to_class = UsersToClass::where('session_id', $session_id)
                ->where('stream_id', $stream_id)->where('class_id', $class_id)
                ->where('section_id', $section_id)->where('user_id', Auth::user()->id)
                ->get()->first();

            if($user_to_class && $user_to_class->count() > 0){

                return ApiResponseClass::successResponse($user_to_class, $input, 'User is Already Registered!!');
            }else{

                $user_to_class = new UsersToClass();
                $user_to_class->session_id = $session_id;
                $user_to_class->stream_id = $stream_id;
                $user_to_class->class_id = $class_id;
                $user_to_class->section_id = $section_id;
                $user_to_class->user_id = Auth::user()->id;

                if($user_to_class->save()){
                    return ApiResponseClass::successResponse($user_to_class, $input);
                }
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }
}
