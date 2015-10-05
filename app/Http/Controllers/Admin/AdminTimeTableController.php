<?php

namespace App\Http\Controllers\Admin;

use app\Exceptions\ModelNotSavedException;
use App\Models\PeriodProfiles;
use App\Models\Periods;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Libraries\ApiResponseClass;
use Validator;
use DB;

class AdminTimeTableController extends Controller
{
    protected $_schoolAndUserBasicInfo;

    /**
     * AdminSchoolSettingsController constructor.
     * @param SchoolAndUserBasicInfo $schoolAndUserBasicInfo
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

    public function getTimeTable()
    {
        return view('admin.time-table');
    }

    //--------------------------------------Period profiles -----------------------------------

    public function getPeriods()
    {
        return view('admin.periods');
    }

    public function postGetAllPeriodProfiles()
    {
        $period_profiles = PeriodProfiles::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->get();

        return ApiResponseClass::successResponse($period_profiles);
    }

    public function postEditOrCreatePeriodProfiles(Request $request)
    {
        $period_profiles_id = $request->input('period_profile_id');
        $period_profile_name = $request->input('period_profile_name');

        $validator = validator::make($request->all(), [
            'period_profile_name' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            try {

                $period_profile = PeriodProfiles::findOrNew($period_profiles_id);
                $period_profile->profile_name = $period_profile_name;
                $period_profile->school_id = $this->getSchoolAndUserBasicInfo()->getSchoolId();

                if (!$period_profile->save()) {
                    throw new ModelNotSavedException();
                }

            } catch (ModelNotSavedException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be saved. Try Again Later!!', $request->all());
            } catch (ModelNotFoundException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be saved. Try Again Later!!', $request->all());
            }
            return ApiResponseClass::successResponse($period_profile, $request->all());
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    public function postDeletePeriodProfiles(Request $request)
    {
        $period_profiles_id = $request->input('period_profile_id');

        $validator = validator::make($request->all(), [
            'period_profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            try {

                $period_profile = PeriodProfiles::findOrFail($period_profiles_id);

                if (!$period_profile->delete()) {
                    throw new ModelNotSavedException();
                }

            } catch (ModelNotSavedException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be deleted. Try Again Later!!', $request->all());
            } catch (ModelNotFoundException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be deleted. Try Again Later!!', $request->all());
            }
            return ApiResponseClass::successResponse($period_profile, $request->all());
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    public function postMakeCurrentPeriodProfiles(Request $request)
    {
        $period_profiles_id = $request->input('period_profile_id');

        $validator = validator::make($request->all(), [
            'period_profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            DB::beginTransaction();

            try {

                $current_profile = PeriodProfiles::where('current_profile', 1)
                    ->where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->get()->first();
                $current_profile->current_profile = 0;

                if (!$current_profile->save()) {
                    throw new ModelNotSavedException();
                }

                $period_profile = PeriodProfiles::findOrFail($period_profiles_id);
                $period_profile->current_profile = 1;

                if (!$period_profile->save()) {
                    throw new ModelNotSavedException();
                }
                DB::commit();
            } catch (ModelNotSavedException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('Sorry, profile could not be Saved. Try Again Later!!', $request->all());
            } catch (ModelNotFoundException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('Sorry, profile could not be Saved. Try Again Later!!', $request->all());
            }
            return ApiResponseClass::successResponse($period_profile, $request->all());
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    public function postPeriodProfilesById(Request $request)
    {
        $period_profiles_id = $request->input('period_profile_id');

        $validator = validator::make($request->all(), [
            'period_profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            try {

                $period_profile = PeriodProfiles::findOrFail($period_profiles_id);

            } catch (ModelNotSavedException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be deleted. Try Again Later!!', $request->all());
            } catch (ModelNotFoundException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be deleted. Try Again Later!!', $request->all());
            }
            return ApiResponseClass::successResponse($period_profile, $request->all());
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    //------------------------------------------------------Periods-------------------------------------------------

    public function postGetAllPeriodsByProfileId(Request $request)
    {
        $period_profiles_id = $request->input('period_profile_id');

        $validator = validator::make($request->all(), [
            'period_profile_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {
            $periods = Periods::where('period_profile_id', $period_profiles_id)->get();

            return ApiResponseClass::successResponse($periods, $request->all());
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    public function postEditOrCreatePeriod(Request $request)
    {
        $period_id = $request->input('period_id');
        $period_profile_id = $request->input('period_profile_id');
        $period_name = $request->input('period_name');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        $validator = validator::make($request->all(), [
            'period_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'period_profile_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            try {

                $period = Periods::findOrNew($period_id);
                $period->period_name = $period_name;
                $period->start_time = $start_time;
                $period->end_time = $end_time;
                $period->period_profile_id = $period_profile_id;

                if (!$period->save()) {
                    throw new ModelNotSavedException();
                }

            } catch (ModelNotSavedException $e) {
                return ApiResponseClass::errorResponse('Sorry, period could not be saved. Try Again Later!!', $request->all());
            } catch (ModelNotFoundException $e) {
                return ApiResponseClass::errorResponse('Sorry, period could not be saved. Try Again Later!!', $request->all());
            }
            return ApiResponseClass::successResponse($period, $request->all());
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

    public function postDeletePeriod(Request $request)
    {
        $period_id = $request->input('period_id');

        $validator = validator::make($request->all(), [
            'period_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            try {

                $period = Periods::findOrFail($period_id);

                if (!$period->delete()) {
                    throw new ModelNotSavedException();
                }

            } catch (ModelNotSavedException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be deleted. Try Again Later!!', $request->all());
            } catch (ModelNotFoundException $e) {
                return ApiResponseClass::errorResponse('Sorry, profile could not be deleted. Try Again Later!!', $request->all());
            }
            return ApiResponseClass::successResponse($period, $request->all());
        }

        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $request->all());
    }

}
