<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\User;
use App\Models\UsersGroups;
use App\Models\UsersLoginInfo;
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

            $user_group = new UsersGroups();
            $user_group->user_id = $user->id;
            $user_group->groups_id = $group_id;

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

    public function postSignIn(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        $inputs = [
            'email' => $email,
            'password' => $password,
            'remember' => $remember,
        ];

        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $flash_data = 'You have some errors !!';
            return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
        }else{
            $user = User::where('email', $email)->get()->first();
            if($user->count() > 0){
                if($user->activated){

                    $auth = Auth::attempt([
                        'email' => $email,
                        'password' => $password
                    ], $remember);

                    if($auth){

                        $userType = RequiredFunctions::checkUserTypeByUserId($user->id);

                        if($userType == Groups::Student_Group_Id){
                            return redirect()->intended(route('user-home'));
                        }elseif($userType == Groups::Teacher_Group_Id){
                            return redirect()->intended();
                        }elseif($userType == Groups::Administrator_Group_ID){
                            return redirect()->intended();
                        }

                    }else{
                        $flash_data = 'User email or password is not correct !!';
                        return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                    }
                }else{
                    $flash_data = 'User is not Activated !!';
                    return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                }
            }else{
                $flash_data = 'User with this email is not found !!';
                return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
            }
        }
        $flash_data = 'Something Went Wrong. Retry again Later sometime !!';
        return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);

    }

    protected function goToStudentAfterLogin($user){

        $users_login_info = UsersLoginInfo::where('user_id', $user->id)->get()->first();

        if($users_login_info->count() > 0){
            $school_id = $user->school_id;

            $school_session = SchoolSession::where('school_id', '=', $school_id)->where('current_session', '=', 1)->get()->first();

            $user_registered_to_session = UsersToClass::where('session_id', '=', $school_session->id)
                ->where('user_id', '=', Sentry::getUser()->id)->get();
            if($user_registered_to_session->count() > 0){

                return Redirect::to(route('user-home'));
            }else{
                Session::flash('global', 'Loggedin Successfully.<br>You Have to Register For new School Session first');
                return Redirect::to(route('user-class-set-initial'));
            }

        }else{
            return Redirect::to(route('user-welcome-settings'));
        }
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
        }else{
            $user = User::where('email', $email)->first();
            if($user->count()){

                if($user->activated){

                    $auth = Auth::attempt([
                        'email' => $email,
                        'password' => $password
                    ], $remember);

                    if($auth){
                        $user = Auth::user();
                        $login_flag = 1;
                        $result = array(
                            'user' => $user,
                            'login_flag' => $login_flag
                        );
                        return ApiResponseClass::successResponse($result, $inputs);
                    }else{
                        return ApiResponseClass::errorResponse('Hello, You Have Some Input Errors', $inputs);
                    }
                }else{
                    return ApiResponseClass::errorResponse('User is Not activated. Please activate It.', $inputs);
                }
            }else{
                $result = array(
                    'email' => 'User Not Found'
                );
                return ApiResponseClass::errorResponse('User Not Found.', $inputs, $result);
            }
        }
    }

    public function postRetrievePassword(Request $request){

        $email = $request->input('email');

        $inputs = [
            'email' => $email
        ];

        $validator = validator::make($request->all(), [
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            $flash_data = 'You have some errors !!';
            return redirect(route('account-user-retrieve-password'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
        }else{
            $user = User::where('email', $email)->get()->first();
            if($user && $user->count() > 0) {
                if ($user->activated) {

                    $user->reset_password_code = str_random(32);

                    if(!RequiredFunctions::checkIfTestEmail($email)){
                        // Send Email to that email address
                    }

                    if($user->save()){

                        $flash_data = 'Thank You. You have been sent an email to reset your password.!!';
                        return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                    }else{

                        $flash_data = 'Something went Wrong. Please Try again later!!';
                        return redirect(route('account-user-retrieve-password'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                    }
                }else{
                    $flash_data = 'User is not Activated !!';
                    return redirect(route('account-user-retrieve-password'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
                }
            }else{
                $flash_data = 'Your Email is not Found. Retry with Correct Email Address!!';
                return redirect(route('account-user-retrieve-password'))->withErrors($validator->errors())->withInput()->withGlobal($flash_data);
            }
        }
    }

    public function postRetrievePasswordMobileApp(Request $request){

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
        }else{
            $user = User::where('email', $email)->get()->first();
            if($user && $user->count() > 0) {
                if ($user->activated) {
                    // Send Email to that email address

                    $flash_data = 'Thank You. You have been sent an email to reset your password.!!';
                    return ApiResponseClass::successResponse(null, $inputs, $flash_data);
                }else{
                    $flash_data = 'User is not Activated !!';
                    return ApiResponseClass::errorResponse($flash_data, $inputs);
                }
            }else{
                $flash_data = 'Your Email is not Found. Retry with Correct Email Address!!';
                return ApiResponseClass::errorResponse($flash_data, $inputs);
            }
        }
    }

    public function getRecover($user_id, $reset_code){

        $user = User::where('id', $user_id)->where('reset_password_code', $reset_code)->get()->first();

        if($user && $user->count() > 0){

            $flash_data = 'Please Reset Your Password!!';
            return view('loginAndRegister.reset-password')->with('global', $flash_data)->withEmail($user->email)->withResetcode($reset_code);
        }else{

            $flash_data = 'Invalid User!!';
            return redirect(route('account-user-sign-in'))->with('global', $flash_data);
        }

    }

    public function postRecover(Request $request){

        $email = $request->get('email');
        $password = $request->get('password');
        $password_again = $request->get('password_again');
        $reset_code = $request->get('resetcode');

        $inputs = [
            'email' => $email,
            'password' => $password,
            'password_again' => $password_again,
            'reset_code' => $reset_code
        ];

        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
            'password_again' => 'required|same:password',
            'reset' => 'resetcode'
        ]);

        if($validator->fails()){

            $flash_data = 'You Have some Problems!!';
            return redirect(route('account-user-recover'))->with('global', $flash_data)->withEmail($email)->withResetcode($reset_code);
        }else{

            $user = User::where('email', $email)->where('reset_password_code', $reset_code)->get()->first();

            if($user && $user->count() > 0){

                $flash_data = 'Please Reset Your Password!!';
                return view('loginAndRegister.reset-password')->with('global', $flash_data)->withEmail($user->email)->withResetcode($reset_code);
            }else{

                $flash_data = 'Invalid User!!';
                return redirect(route('account-user-sign-in'))->with('global', $flash_data);
            }
        }
    }

    public function getLogout()
    {
        Auth::logout();

        $flash_data = 'You have been successfully Logged Out!!';
        return redirect(route('account-user-sign-in'))->with('global', $flash_data);
    }
}
