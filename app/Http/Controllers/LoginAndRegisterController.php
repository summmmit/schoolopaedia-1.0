<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\User;
use App\Models\UsersGroups;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseClass;
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

    public function getForgotPassword()
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
            return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInputs($inputs)->withGlobal($flash_data);
        }else{
            $user = User::where('email', $email)->get()->first();
            if($user->count() > 0){
                if($user->activated){

                    $auth = Auth::attempt([
                        'email' => $email,
                        'password' => $password
                    ], $remember);

                    if($auth){
                        $user_groups = UsersGroups::where('user_id', $user->id)->get()->first();
                        $group_id = $user_groups->groups_id;

                        echo $group_id;

                        if($group_id == Groups::Student_Group_Id){
                            return redirect()->intended(route('user-home'));
                        }elseif($group_id == Groups::Teacher_Group_Id){
                            return redirect()->intended();
                        }elseif($group_id == Groups::Administrator_Group_ID){
                            return redirect()->intended();
                        }

                    }else{
                        $flash_data = 'User email or password is not correct !!';
                        return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInputs($inputs)->withGlobal($flash_data);
                    }
                }else{
                    $flash_data = 'User is not Activated !!';
                    return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInputs($inputs)->withGlobal($flash_data);
                }
            }else{
                $flash_data = 'User with this email is not found !!';
                return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInputs($inputs)->withGlobal($flash_data);
            }
        }
        $flash_data = 'Something Went Wrong. Retry again Later sometime !!';
        return redirect(route('account-user-sign-in'))->withErrors($validator->errors())->withInputs($inputs)->withGlobal($flash_data);

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

    public function getLogout()
    {
        Auth::logout();

        $flash_data = 'You have been successfully Logged Out!!';
        return redirect(route('account-user-sign-in'))->with('global', $flash_data);
    }
}
