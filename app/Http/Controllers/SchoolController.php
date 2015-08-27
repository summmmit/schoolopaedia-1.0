<?php

namespace App\Http\Controllers;

use App\Libraries\RequiredFunctions;
use App\Models\Schools;
use Illuminate\Http\Request;
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
                return  redirect(route('school-register'))
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
                    'code_for_parents'  => $school->code_for_parents
                ];
                if (!RequiredFunctions::checkIfTestEmail($school->email)) {

                    //send email
                    Mail::send('schools.emails.activate-school', $email_array, function ($message) use ($school) {
                        $message->to($school->email, $school->school_name)
                            ->subject('Register For Admin and Other Codes');
                    });
                }
                return  redirect(route('school-register'))
                    ->with('global', 'Your Account Have been activated. You have got mail with registration procedure explained.');
            }
        }
        return redirect(route('school-register'))
            ->with('global', 'Cant activate do after some time');
    }
}
