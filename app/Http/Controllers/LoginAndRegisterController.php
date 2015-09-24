<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserLoginInfo;
use App\Models\UserRegisteredToSchool;
use App\Models\UsersLoginInfo;
use App\Models\UsersRegisteredToSchool;
use App\Models\SchoolSession;
use App\Models\UsersRegisteredToSession;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseClass;
use App\Libraries\RequiredFunctions;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;
use Auth;
use Mail;
use App\Libraries\RequiredConstants;

class LoginAndRegisterController extends Controller
{
    public function getSignIn()
    {
        return view('loginAndRegister.login');
    }

    public function getCreate()
    {
        return view('loginAndRegister.register');
    }

    public function getRetrievePassword()
    {
        return view('loginAndRegister.forgot-password');
    }

    public function postCreate(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $group_to_register_in = $request->input('group_to_register_in');

        $validator = validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'password' => 'required|max:16|min:6',
            'password_again' => 'required|same:password',
            'group_to_register_in' => 'required|in:1,2,3'
        ]);

        $account_sign_in_route = null;
        $account_create_route = null;

        if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
            $account_create_route = route('account-admin-create');
            $account_sign_in_route = route('account-admin-sign-in');
        } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
            $account_create_route = route('account-user-create');
            $account_sign_in_route = route('account-user-sign-in');
        }

        if ($validator->fails()) {
            $flash_data = 'You have some errors !!';
            return redirect($account_create_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
        }

        $group_id = null;

        if ($group_to_register_in == Groups::Student_Group_Id) {
            $group_id = Groups::Student_Group_Id;
        } elseif ($group_to_register_in == Groups::Administrator_Group_ID) {
            $group_id = Groups::Administrator_Group_ID;
        } elseif ($group_to_register_in == Groups::Teacher_Group_Id) {
            $group_id = Groups::Teacher_Group_Id;
        }

        DB::beginTransaction();

        try {

            Groups::findorFail($group_id);

            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->activated = 0;
            $user->email_updated_at = date("Y-m-d h:i:s");
            $user->password_updated_at = date("Y-m-d h:i:s");
            $user->activation_code = str_random(64);

            if (!$user->save()) {
                throw new \ErrorException();
            }

            $user_group = new UserGroup();
            $user_group->user_id = $user->id;
            $user_group->group_id = $group_id;

            if (!$user_group->save()) {
                throw new \ErrorException();
            }

            DB::commit();

        } catch (ModelNotFoundException  $e) {
            DB::rollback();

            $groups = new Groups();
            $groups->id = 1;
            $groups->name = "Administrator";
            $groups->save();

            $groups = new Groups();
            $groups->id = 2;
            $groups->name = "Student";
            $groups->save();

            $groups = new Groups();
            $groups->id = 3;
            $groups->name = "Teacher";
            $groups->save();


            $flash_data = 'You have some errors!!';
            return redirect($account_create_route)->withInput()->withGlobal($flash_data);
        } catch (\ErrorException $e) {
            DB::rollback();
            $flash_data = 'You have some errors!!';
            return redirect($account_create_route)->withInput()->withGlobal($flash_data);
        }

        // Send mail to the user if not the test Shop Id.
        $email_array = [];
        if (!RequiredFunctions::checkIfTestEmail($email)) {

            //send email
            Mail::send('schools.emails.activate-school', $email_array, function ($message) use ($user) {
                $message->to($user->email, 'Mr. Admin')
                    ->subject('Register For Admin and Other Codes');
            });
        }

        $flash_data = 'You have Successfully Registered. You have been send an email. Please Activate!!';
        return redirect($account_sign_in_route)->withGlobal($flash_data);
    }

    public function postCreateMobileApp(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $password_again = $request->input('password_again');
        $group_to_register_in = $request->input('group_to_register_in');

        $inputs = [
            'email' => $email,
            'password' => $password,
            'password_again' => $password_again,
            'group_to_register_in' => $group_to_register_in
        ];

        $validator = validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'password' => 'required|max:16|min:6',
            'password_again' => 'required|same:password',
            'group_to_register_in' => 'required|in:1,2,3'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors', $inputs, $validator->errors());
        }

        $group_id = null;

        if ($group_to_register_in == Groups::Student_Group_Id) {
            $group_id = Groups::Student_Group_Id;
        } elseif ($group_to_register_in == Groups::Administrator_Group_ID) {
            $group_id = Groups::Administrator_Group_ID;
        } elseif ($group_to_register_in == Groups::Teacher_Group_Id) {
            $group_id = Groups::Teacher_Group_Id;
        }

        DB::beginTransaction();

        try {

            Groups::findorFail($group_id);

            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->activated = 0;
            $user->email_updated_at = date("Y-m-d h:i:s");
            $user->password_updated_at = date("Y-m-d h:i:s");
            $user->activation_code = str_random(64);

            if (!$user->save()) {
                throw new \ErrorException();
            }

            $user_group = new UserGroup();
            $user_group->user_id = $user->id;
            $user_group->group_id = $group_id;

            if (!$user_group->save()) {
                throw new \ErrorException();
            }

            DB::commit();

        } catch (ModelNotFoundException  $e) {
            DB::rollback();
            return ApiResponseClass::errorResponse('ModelNotFoundException', $inputs);
        } catch (\ErrorException $e) {
            DB::rollback();
            return ApiResponseClass::errorResponse('ModelNotSavedException', $inputs);
        }

        // Send mail to the user if not the test Shop Id.

        return ApiResponseClass::successResponse($user, $inputs);
    }

    public function postSignIn(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        $account_sign_in_route = null;

        if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
            $account_sign_in_route = route('account-admin-sign-in');
        } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
            $account_sign_in_route = route('account-user-sign-in');
        }

        if ($validator->fails()) {
            $flash_data = 'You have some errors !!';
            return redirect($account_sign_in_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
        } else {

            $user = User::where('email', $email)->get()->first();
            if ($user->count() > 0) {
                if ($user->activated) {

                    $auth = Auth::attempt([
                        'email' => $email,
                        'password' => $password
                    ], $remember);

                    if ($auth) {

                        $userType = RequiredFunctions::checkUserTypeByUserId($user->id);

                        if ($userType == Groups::Student_Group_Id) {
                            return redirect()->intended(route('user-first-page', ['userId' => $user->id]));
                        } elseif ($userType == Groups::Teacher_Group_Id) {
                            return redirect()->intended(route('teacher-first-page', ['teacherId' => $user->id]));
                        } elseif ($userType == Groups::Administrator_Group_ID) {
                            return redirect()->intended(route('admin-first-page', ['adminId' => $user->id]));
                        }

                    } else {
                        $flash_data = 'User email or password is not correct !!';
                        return redirect($account_sign_in_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                    }
                } else {
                    $flash_data = 'User is not Activated !!';
                    return redirect($account_sign_in_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                }
            } else {
                $flash_data = 'User with this email is not found !!';
                return redirect($account_sign_in_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
            }
        }
        $flash_data = 'Something Went Wrong. Retry again Later sometime !!';
        return redirect($account_sign_in_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);

    }

    protected function goToAfterSignIn($user_id)
    {

        $userType = RequiredFunctions::checkUserTypeByUserId($user_id);

        $route_home = null;
        $route_welcome_settings = null;
        $route_set_class_initial_settings = null;

        if ($userType == Groups::Student_Group_Id) {

            $route_home = route('user-home');
            $route_welcome_settings = route('user-welcome-settings');
            $route_set_class_initial_settings = route('user-class-set-initial');
        } elseif ($userType == Groups::Teacher_Group_Id) {

            $route_home = route('teacher-home');
            $route_welcome_settings = route('teacher-welcome-settings');
            $route_set_class_initial_settings = route('teacher-class-set-initial');
        }

        $user_registered_to_school = UsersRegisteredToSchool::where('user_id', $user_id)->get()->first();

        if ($user_registered_to_school && $user_registered_to_school->count() > 0) {

            $school_session = SchoolSession::where('school_id', '=', $user_registered_to_school->school_id)->where('current_session', '=', 1)->get()->first();
            $user_registered_to_session = UsersRegisteredToSession::where('session_id', $school_session->id)
                ->where('user_id', Auth::user()->id)->where('school_id', $user_registered_to_school->school_id)->get();
            if ($user_registered_to_session->count() > 0) {
                if($this->userLoginInfo(Auth::user()->id, $user_registered_to_school->school_id)){
                    return redirect($route_home)->with('global', 'Welcome Back !!');
                }
            } else {
                return redirect($route_set_class_initial_settings)->with('global', 'Loggedin Successfully. You Have to Register For new School Session first');
            }
        } else {
            return redirect($route_welcome_settings);
        }
        return redirect(route('account-user-sign-in'))->with('global', 'Something Went Wrong. Try Again later !!');
    }

    protected function goToAfterSignInAdmin($user_id)
    {

        $userType = RequiredFunctions::checkUserTypeByUserId($user_id);

        if ($userType != Groups::Administrator_Group_ID) {

            return redirect(route('admin-welcome-settings'))->with('global', 'Sorry Something went Wrong. Please try again Later!!');
        }

        $user_registered_to_school = UsersRegisteredToSchool::where('user_id', $user_id)->get()->first();

        if ($user_registered_to_school && $user_registered_to_school->count() > 0) {

            $school_session = SchoolSession::where('school_id', '=', $user_registered_to_school->school_id)->where('current_session', '=', 1)->get()->first();

            if ($school_session && $school_session->count() > 0) {
                if($this->userLoginInfo(Auth::user()->id, $user_registered_to_school->school_id)){
                    return redirect(route('admin-home'));
                }
            } else {
                return redirect(route('admin-class-set-initial'))->with('global', 'Loggedin Successfully. You Have to Register For new School Session first');
            }
        } else {
            return redirect(route('admin-welcome-settings'));
        }
        return redirect(route('account-admin-sign-in'))->with('global', 'Sorry Something went Wrong. Please try again Later!!');
    }

    public function postSignInMobileApp(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        $inputs = [
            'email' => $email,
            'password' => $password,
        ];

        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Yes', $inputs, $validator->errors());
        } else {
            $user = User::where('email', $email)->first();
            if ($user->count()) {

                if ($user->activated) {

                    $auth = Auth::attempt([
                        'email' => $email,
                        'password' => $password
                    ], $remember);

                    if ($auth) {
                        $user = Auth::user();
                        $login_flag = 1;
                        $result = array(
                            'user' => $user,
                            'login_flag' => $login_flag
                        );
                        return ApiResponseClass::successResponse($result, $inputs);
                    } else {
                        return ApiResponseClass::errorResponse('Hello, You Have Some Input Errors', $inputs);
                    }
                } else {
                    return ApiResponseClass::errorResponse('User is Not activated. Please activate It.', $inputs);
                }
            } else {
                $result = array(
                    'email' => 'User Not Found'
                );
                return ApiResponseClass::errorResponse('User Not Found.', $inputs, $result);
            }
        }
    }

    public function postRetrievePassword(Request $request)
    {

        $email = $request->input('email');

        $validator = validator::make($request->all(), [
            'email' => 'required'
        ]);

        $account_sign_in_route = null;
        $account_create_route = null;

        if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
            $account_create_route = route('account-admin-retrieve-password');
            $account_sign_in_route = route('account-admin-sign-in');
        } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
            $account_create_route = route('account-user-retrieve-password');
            $account_sign_in_route = route('account-user-sign-in');
        }

        if ($validator->fails()) {
            $flash_data = 'You have some errors !!';
            return redirect(route('account-user-retrieve-password'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
        } else {
            $user = User::where('email', $email)->get()->first();
            if ($user && $user->count() > 0) {
                if ($user->activated) {

                    $user->reset_password_code = str_random(32);

                    if ($user->save()) {

                        // Send mail to the user if not the test Shop Id.
                        $email_array = [];
                        if (!RequiredFunctions::checkIfTestEmail($email)) {

                            Mail::send('schools.emails.activate-school', $email_array, function ($message) use ($user) {
                                $message->to($user->email, 'Mr. Admin')
                                    ->subject('Register For Admin and Other Codes');
                            });
                        }

                        $flash_data = 'Thank You. You have been sent an email to reset your password.!!';
                        return redirect($account_sign_in_route)->withGlobal($flash_data);
                    } else {

                        $flash_data = 'Something went Wrong. Please Try again later!!';
                        return redirect($account_create_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                    }
                } else {
                    $flash_data = 'User is not Activated !!';
                    return redirect($account_create_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                }
            } else {
                $flash_data = 'Your Email is not Found. Retry with Correct Email Address!!';
                return redirect($account_create_route)->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
            }
        }
    }

    public function postRetrievePasswordMobileApp(Request $request)
    {

        $email = $request->input('email');

        $inputs = [
            'email' => $email
        ];

        $validator = validator::make($request->all(), [
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            $flash_data = 'You have some errors !!';
            return ApiResponseClass::errorResponse($flash_data, $inputs, $validator->errors());
        } else {
            $user = User::where('email', $email)->get()->first();
            if ($user && $user->count() > 0) {
                if ($user->activated) {
                    // Send Email to that email address

                    $flash_data = 'Thank You. You have been sent an email to reset your password.!!';
                    return ApiResponseClass::successResponse(null, $inputs, $flash_data);
                } else {
                    $flash_data = 'User is not Activated !!';
                    return ApiResponseClass::errorResponse($flash_data, $inputs);
                }
            } else {
                $flash_data = 'Your Email is not Found. Retry with Correct Email Address!!';
                return ApiResponseClass::errorResponse($flash_data, $inputs);
            }
        }
    }

    public function getRecover(Request $request, $user_id, $reset_code)
    {
        $user = User::where('id', $user_id)->where('reset_password_code', $reset_code)->get()->first();

        $account_recover = null;
        $account_sign_in_route = null;

        if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
            $account_recover = route('account-admin-recover');
            $account_sign_in_route = route('account-admin-sign-in');
        } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
            $account_recover = route('account-user-recover');
            $account_sign_in_route = route('account-user-sign-in');
        }

        if ($user && $user->count() > 0) {

            $flash_data = 'Please Reset Your Password!!';
            return redirect($account_recover)->with('global', $flash_data)->withEmail($user->email)->withResetcode($reset_code);
        } else {

            $flash_data = 'Invalid User. Retry with Real URL!!';
            return redirect($account_sign_in_route)->with('global', $flash_data);
        }

    }

    public function postRecover(Request $request)
    {
        $email = $request->get('email');
        $reset_code = $request->get('resetcode');
        $password = $request->get('password');
        $password_again = $request->get('password_again');

        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
            'password_again' => 'required|same:password',
            'reset' => 'resetcode'
        ]);

        $account_recover = null;
        $account_sign_in_route = null;

        if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
            $account_recover = route('account-admin-recover');
            $account_sign_in_route = route('account-admin-sign-in');
        } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
            $account_recover = route('account-user-recover');
            $account_sign_in_route = route('account-user-sign-in');
        }

        if ($validator->fails()) {

            $flash_data = 'You Have some Problems!!';
            return redirect($account_recover)->with('global', $flash_data)->withEmail($email)->withResetcode($reset_code);
        } else {

            $user = User::where('email', $email)->where('reset_password_code', $reset_code)->get()->first();

            if ($user && $user->count() > 0) {

                $user->password = Hash::make($password);
                $user->password_updated_at = date('Y-m-d H:i:s');

                if ($user->save()) {

                    $flash_data = 'Your Password has been updated. Please Login Now!!';
                    return redirect($account_sign_in_route)->with('global', $flash_data);
                }
            } else {

                $flash_data = 'Invalid User!!';
                return redirect($account_sign_in_route)->with('global', $flash_data);
            }
        }

        $flash_data = 'You Have some Problems!!';
        return redirect($account_recover)->with('global', $flash_data)->withEmail($email)->withResetcode($reset_code);
    }

    public function getActivate(Request $request, $userId, $activation_code)
    {

        $user = User::where('id', $userId)->where('activation_code', $activation_code)->where('activated', 0)->get()->first();

        $account_sign_in_route = null;

        if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
            $account_sign_in_route = route('account-admin-sign-in');
        } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
            $account_sign_in_route = route('account-user-sign-in');
        }

        if ($user && $user->count() > 0) {

            $user->activation_code = "";
            $user->activated = 1;
            $user->activated_at = date('Y-m-d H:i:s');

            if ($user->save()) {

                $flash_data = 'User is activated. Please Login Now!!';
                return redirect($account_sign_in_route)->withGlobal($flash_data);
            }
        } else {

            $flash_data = 'User Not Found. Try with real URL!!';
            return redirect($account_sign_in_route)->withGlobal($flash_data);
        }

        $flash_data = 'You have some errors. You cant activate Now. Try some other time!!';
        return redirect($account_sign_in_route)->withGlobal($flash_data);
    }

    public function getLogout(Request $request)
    {
        Auth::logout();

        $account_sign_in_route = null;

        if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
            $account_sign_in_route = route('account-admin-sign-in');
        } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
            $account_sign_in_route = route('account-user-sign-in');
        } elseif ($request->is(RequiredConstants::TEACHER_ROUTE)) {
            $account_sign_in_route = route('account-user-sign-in');
        }

        $flash_data = 'You have been successfully Logged Out!!';
        return redirect($account_sign_in_route)->with('global', $flash_data);
    }

    private function userLoginInfo($userId, $schoolId){

        $login_info = new UserLoginInfo();
        $login_info->user_id = $userId;
        $login_info->school_id = $schoolId;

        if($login_info->save()){
            return true;
        }
        return false;
    }
}
