<?php

namespace App\Http\Controllers\User;

use App\Models\SchoolSession;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UsersRegisteredToSchool;
use App\Models\UsersRegisteredToSession;
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
    protected $_userId;

    /**
     * UserAccountController constructor.
     * @param $_userId
     */
    public function __construct()
    {
        $this->_userId = Auth::user()->id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_userId;
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
        return view('user.initial-school-settings');
    }

    public function postSetInitial(Request $request)
    {
        $session_id = $request->input('session_id');
        $stream_id = $request->input('stream_id');
        $class_id = $request->input('class_id');
        $section_id = $request->input('section_id');

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

            if ($user_to_class && $user_to_class->count() > 0) {

                return ApiResponseClass::successResponse($user_to_class, $input, 'User is Already Registered!!');
            } else {

                $user_registered_to_school = UsersRegisteredToSchool::where('user_id', Auth::user()->id)->get()->first();

                $user_registered_to_session = UsersRegisteredToSession::where('session_id', $session_id)
                    ->where('user_id', Auth::user()->id)->get()->first();

                if (!$user_registered_to_session) {

                    $user_registered_to_session = new UsersRegisteredToSession();
                    $user_registered_to_session->session_id = $session_id;
                    $user_registered_to_session->school_id = $user_registered_to_school->school_id;
                    $user_registered_to_session->user_id = Auth::user()->id;


                    $user_to_class = new UsersToClass();
                    $user_to_class->session_id = $session_id;
                    $user_to_class->stream_id = $stream_id;
                    $user_to_class->class_id = $class_id;
                    $user_to_class->section_id = $section_id;
                    $user_to_class->user_id = Auth::user()->id;

                    if ($user_to_class->save() && $user_registered_to_session->save()) {
                        return ApiResponseClass::successResponse($user_to_class, $input);
                    }
                } else {
                    return ApiResponseClass::successResponse($user_registered_to_session, $input);
                }
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function getProfile()
    {
        return view('user.profile');
    }

    public function postGetDetails()
    {
        $user_details = UserDetails::where('user_id', $this->getUserId())->get()->first();
        $user = User::find($this->getUserId());

        $result = [
            'user_details' => $user_details,
            'user' => $user
        ];

        return ApiResponseClass::successResponse($result);
    }

    public function postUpdateDetails(Request $request)
    {
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $mobile_number = $request->input('mobile_number');
        $home_number = $request->input('home_number');
        $dd = $request->input('dd');
        $mm = $request->input('mm');
        $yyyy = $request->input('yyyy');
        $marriage_status = $request->input('marriage_status');
        $sex = $request->input('sex');
        $add_1 = $request->input('add_1');
        $add_2 = $request->input('add_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $pin_code = $request->input('pin_code');
        $country = $request->input('country');
        $skype   = $request->input('skype');
        $facebook = $request->input('facebook');
        $google_plus = $request->input('google_plus');
        $twitter = $request->input('twitter');

        $validator = Validator::make($request->all(), array(
                'first_name' => 'max:30',
                'last_name' => 'max:30',
                'mobile_number' => 'max:10',
                'home_number' => 'max:10',
                'dd' => 'max:2',
                'mm' => 'max:2',
                'yyyy' => 'max:4',
                'relative_id' => 'max:30',
                'add_1' => 'max:30',
                'city' => 'max:30',
                'state' => 'max:30',
                'pin_code' => 'max:10',
                'country' => 'max:30'
            )
        );
        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            $now = date("Y-m-d H-i-s");

            $user = UserDetails::where('user_id', $this->getUserId())->get()->first();
            $user->first_name = ucwords($first_name);
            $user->middle_name = ucwords($middle_name);
            $user->last_name = ucwords($last_name);
            $user->dob = implode("-", [$yyyy, $mm, $dd]);
            $user->sex = $sex;
            $user->marriage_status = $marriage_status;

            if($user->mobile_number != $mobile_number){
                $user->mobile_updated_at = $now;
            }

            $user->mobile_number = $mobile_number;
            $user->home_number = $home_number;

            if($user->add_1 != $add_1 or $user->add_2 != $add_2){
                $user->address_updated_at = $now;
            }

            $user->add_1 = ucwords($add_1);
            $user->add_2 = ucwords($add_2);
            $user->city = ucwords($city);
            $user->state = $state;
            $user->country = $country;
            $user->pin_code = $pin_code;
            $user->skype = $skype;
            $user->facebook = $facebook;
            $user->google_plus = $google_plus;
            $user->twitter = $twitter;


            if ($user->save()) {

                $result = [
                    'user_details' => $user,
                    'user' => User::findOrFail($this->getUserId())
                ];
                return ApiResponseClass::successResponse($result, $request->all());
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    public function postChangeEmailAddress(Request $request){

        $email = $request->input('email');

        $validator = Validator::make($request->all(), array(
            'email' => 'sometimes|max:60|email|unique:users'
        ));
        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            $user = User::findOrFail($this->getUserId());

            $now = date("Y-m-d H-i-s");

            if ($user->email != $email) {
                $user->email = $email;
                $user->email_updated_at = $now;
            }
            //send email for verification
            if ($user->save()) {

                $result = [
                    'user' => User::findOrFail($this->getUserId())
                ];
                return ApiResponseClass::successResponse($result, $request->all());
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    public function postChangePassword()
    {

        $updated = false;

        $user = User::find(Auth::user()->id);

        $now = date("Y-m-d H-i-s");

        if ($user->email != Input::get('email')) {

            $updated = true;

            $validator = Validator::make(Input::all(), array('email' => 'sometimes|max:60|email|unique:users'));
            if ($validator->fails()) {
                return Redirect::route('user-profile')->withErrors($validator)->withInput();
            } else {
                $user->email = Input::get('email');
                $user->email_updated_at = $now;
            }
        }

        $auth = Auth::attempt(array('password' => Input::get('old_password')));

        if ($auth) {
            if (Input::get('password') != NULL) {

                $updated = true;

                $validator = Validator::make(Input::all(), array(
                        'password' => 'required|min:3',
                        'password_again' => 'required|same:password'
                    )
                );
                if ($validator->fails()) {
                    return Redirect::route('user-profile')->withErrors($validator);
                } else {
                    $user->password = Hash::make(Input::get('password'));
                    $user->password_updated_at = $now;
                }
            }
        } else {
            return Redirect::route('user-profile')->with('details-not-changed', 'Your Current Password is not matched. Try Again');
        }

        if ($updated) {
            if ($user->save()) {
                return Redirect::route('user-profile')->with('details-changed', ' Your Details are Changed');
            } else {
                return Redirect::route('user-profile')->with('details-not-changed', 'Your details Not Changed . Try Again');
            }
        } else {
            return Redirect::route('user-profile')->with('details-not-changed', ' You didn\'t changed any details. Check and Try Again');
        }
    }
}
