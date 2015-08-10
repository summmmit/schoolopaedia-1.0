<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\User;
use App\Models\UsersGroups;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseClass;
use Illuminate\Support\Facades\Hash;
use DB;

class UserLoginController extends Controller
{

    public function __construct()
    {
    }

    /**
     * TO show form for user Login
     * @return \Illuminate\View\View
     */
    public function getSignIn()
    {
        return view('user.account.login');
    }

    /**
     * To show form for User Registration
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('user.account.register');
    }

    public function postCreate(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $password_again = $request->input('password_again');

        $inputs = [
            'email' => $email,
            'password' => $password,
            'password_again' => $password_again
        ];

        if ($password != $password_again) {
            return ApiResponseClass::errorResponse('failed', 'Password and Password Confirm Should be Same.', $inputs);
        }

        $ifAlreadyExists = User::where('email' , $email)->count();

        if($ifAlreadyExists > 0){

            return ApiResponseClass::errorResponse('User Exists', 'User With Same Email Address already Exists.', $inputs);
        }else{
            $isUrlUser = $request->is('user/*');
            $isUrlAdmin = $request->is('admin/*');
            $isUrlTeacher = $request->is('teacher/*');

            $group_id = null;

            if($isUrlUser){
                $group_id = Groups::Student_Group_Id;
            }elseif($isUrlAdmin){
                $group_id = Groups::Administrator_Group_ID;
            }elseif($isUrlTeacher){
                $group_id = Groups::Teacher_Group_Id_Group_ID;
            }

            DB::beginTransaction();

            try{

                Groups::findorFail($group_id);

                $user = new User();
                $user->email = $email;
                $user->password = Hash::make('password');
                $user->activated = 0;
                $user->email_updated_at = date("Y-m-d h:i:s");
                $user->password_updated_at = date("Y-m-d h:i:s");
                $user->activation_code = str_random(16);

                $user->save();

                $user_group = new UsersGroups();
                $user_group->user_id = $user->id;
                $user_group->groups_id = $group_id;
                $user_group->save();


            }catch (ModelNotFoundException  $e){
                DB::rollback();
            }

            return ApiResponseClass::successResponse($user, $request);
        }



        try {

            $user = Sentry::createUser(array(
                'email' => $email,
                'password' => $password,
                'activated' => 0,
                'email_updated_at' => date("Y-m-d h:i:s"),
                'password_updated_at' => date("Y-m-d h:i:s"),
            ));


            //Get the activation code & prep data for email
            $activationCode = $user->GetActivationCode();
            $userId = $user->getId();

            //If no groups created then create new groups
            try {
                $user_group = Sentry::findGroupById(2);
            } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
                $this->createGroup('administrator');
                $this->createGroup('students');
                $user_group = Sentry::findGroupById(2);
            }

            $user->addGroup($user_group);

            $userDetails = new UserDetails();

            $userDetails->user_id = $userId;
            $userDetails->save();

            $successResponse = [
                'status' => 'success',
                'result' => 'null',
                'request' => $request
            ];

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {

            $errorResponse = [
                'status' => 'failed',
                'error' => [
                    'message' => 'Error',
                    'description' => 'Email and Password Required.'
                ],
                'request' => $request
            ];
            return Response::json($errorResponse);

        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {

            $errorResponse = [
                'status' => 'failed',
                'error' => [
                    'message' => 'Error',
                    'description' => 'User Already Exists.'
                ],
                'request' => $request
            ];
            return Response::json($errorResponse);

        }

        return Response::json($successResponse);
    }
}
