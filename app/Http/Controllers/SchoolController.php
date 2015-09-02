<?php

namespace App\Http\Controllers;

use app\Libraries\RequiredConstants;
use App\Libraries\RequiredFunctions;
use App\Libraries\ApiResponseClass;
use App\Models\Groups;
use App\Models\Schools;
use App\Models\UserDetails;
use App\Models\UserGroup;
use App\Models\UserLoginInfo;
use App\Models\UsersRegisteredToSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class SchoolController extends Controller
{
    public function getCreate()
    {
        return view('schools.register');
    }

    public function postCreate(Request $request)
    {
        $email = $request->input('email');
        $school_name = $request->input('school_name');
        $manager_name = $request->input('manager_name');
        $phone_number = $request->input('phone_number');
        $add_1 = $request->input('add_1');
        $add_2 = $request->input('add_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pin_code = $request->input('pin_code');

        $inputs = [
            'email' => $email,
            'school_name' => $school_name,
            'manager_name' => $manager_name,
            'phone_number' => $phone_number,
            'add_1' => $add_1,
            'add_2' => $add_2,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'pin_code' => $pin_code,
        ];

        $validator = validator::make($request->all(), [
            'email' => 'required|unique:schools|email',
            'school_name' => 'required|min:6',
            'manager_name' => 'required|min:6',
            'phone_number' => 'required|max:16|min:10',
            'add_1' => 'required|min:6',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pin_code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('school-register'))->withErrors($validator->errors())->withInput();
        } else {
            //Registration Code
            $registration_code = str_random(50);
            //staff Code
            $code_for_teachers = str_random(60);
            //students Code
            $code_for_students = str_random(70);
            //moderators Code
            $code_for_parents = str_random(95);
            //students Code
            $code_for_admin = str_random(80);
            //moderators Code
            $code_for_moderators = str_random(90);

            $today = date("Y-m-d H:i:s");

            $school = Schools::create(array(
                'school_name' => ucwords($school_name),
                'manager_full_name' => ucwords($manager_name),
                'phone_number' => $phone_number,
                'email' => $email,
                'add_1' => ucwords($add_1),
                'add_2' => ucwords($add_2),
                'city' => ucwords($city),
                'state' => $state,
                'country' => $country,
                'pin_code' => $pin_code,
                'registration_code' => $registration_code,
                'code_for_admin' => $code_for_admin,
                'code_for_moderators' => $code_for_moderators,
                'code_for_teachers' => $code_for_teachers,
                'code_for_parents' => $code_for_parents,
                'code_for_students' => $code_for_students,
                'active' => 0,
                'registration_date' => $today,
            ));

            if ($school) {

                $email_array = [
                    'link' => route('school-account-activate', $registration_code),
                    'school_name' => $school_name
                ];
                if (!RequiredFunctions::checkIfTestEmail($email)) {

                    //send email
                    Mail::send('schools.emails.activate-school', $email_array, function ($message) use ($school) {
                        $message->to($school->email, $school->school_name)
                            ->subject('Activate Your Account');
                    });
                }
                return redirect(route('school-register'))
                    ->with('global', 'You have Been Registered. You have been send a mail to activate your account.');
            } else {
                return redirect(route('school-register'))
                    ->with('global', 'You have not Been Registered. Try Again Later Some time.');
            }
        }
    }

    public function getActivateSchool($registration_code)
    {

        $school = Schools::where('registration_code', '=', $registration_code)->where('active', '=', 0);

        if ($school->count()) {
            $school = $school->first();

            $school->active = 1;

            if ($school->save()) {

                $email_array = [
                    'school_name' => $school->school_name,
                    'registration_code' => $school->registration_code,
                    'code_for_admin' => $school->code_for_admin,
                    'code_for_students' => $school->code_for_students,
                    'code_for_teachers' => $school->code_for_teachers,
                    'code_for_parents' => $school->code_for_parents
                ];
                if (!RequiredFunctions::checkIfTestEmail($school->email)) {

                    //send email
                    Mail::send('schools.emails.activate-school', $email_array, function ($message) use ($school) {
                        $message->to($school->email, $school->school_name)
                            ->subject('Register For Admin and Other Codes');
                    });
                }
                return redirect(route('school-register'))
                    ->with('global', 'Your Account Have been activated. You have got mail with registration procedure explained.');
            }
        }
        return redirect(route('school-register'))
            ->with('global', 'Cant activate do after some time');
    }

    public function postValidateSchool(Request $request)
    {
        $registration_code = $request->input('registration_code');
        $group_id = $request->input('group_id');

        $group = Groups::find($group_id);

        $code = array();

        if ($group && $group->count() > 0) {
            if ($group_id == Groups::Teacher_Group_Id) {

                $code_for_teachers = $request->input('code_for_teachers');
                $school = Schools::where('registration_code', '=', $registration_code)
                    ->where('code_for_teachers', '=', $code_for_teachers)->get()->first();
                $code = array(
                    'code_for_teachers' => $code_for_teachers
                );
            } elseif ($group_id == Groups::Student_Group_Id) {

                $code_for_students = $request->input('code_for_students');
                $school = Schools::where('registration_code', '=', $registration_code)
                    ->where('code_for_students', '=', $code_for_students)->get()->first();
                $code = array(
                    'code_for_students' => $code_for_students
                );
            } elseif ($group_id == Groups::Administrator_Group_ID) {

                $code_for_admin = $request->input('code_for_admin');
                $school = Schools::where('registration_code', '=', $registration_code)
                    ->where('code_for_admin', '=', $code_for_admin)->get()->first();
                $code = array(
                    'code_for_admin' => $code_for_admin
                );
            }

            $input = array(
                'registration_code' => $registration_code,
                'group_id' => $group_id
            );

            $input = array_merge($input, $code);

            if ($school && $school->count() > 0) {

                $users_registered_to_school = new UsersRegisteredToSchool();
                $users_registered_to_school->user_id = Auth::user()->id;
                $users_registered_to_school->school_id = $school->id;
                $users_registered_to_school->registration_date = date('Y-m-d H:i:s');
                $users_registered_to_school->save();

                if ($users_registered_to_school->save()) {

                    $result = array(
                        'school' => $school
                    );
                    return ApiResponseClass::successResponse($result, $input);
                }
            } else {

                return ApiResponseClass::errorResponse('School Codes are InValid. Please Try again with Correct Codes!!', $input);
            }
        }

        return ApiResponseClass::errorResponse('Some Problem Occured. Please Try again With Correct Codes!!', $input);
    }

    /**
     * Api for Brief Registration
     */
    public function postBriefRegistration(Request $request)
    {

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $sex = $request->input('sex');

        $validator = validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required'
        ]);

        $input = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'sex' => $sex
        ];

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('Some Problem Occured. Please Try again With Correct Values!!', $input);
        }

        $input = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'sex' => $sex
        ];

        $user_details = UserDetails::where('user_id', Auth::user()->id)->get()->first();

        if(!$user_details){
            $user_details = new UserDetails();
        }

        $user_details->first_name = $first_name;
        $user_details->last_name = $last_name;
        $user_details->sex = $sex;
        $user_details->user_id = Auth::user()->id;

        if ($user_details->save()) {

            $result = array(
                'details' => $user_details
            );
            return ApiResponseClass::successResponse($result, $input);
        }

        return ApiResponseClass::errorResponse('Some Problem Occured. Please Try again With Correct Values!!', $input);
    }

}
