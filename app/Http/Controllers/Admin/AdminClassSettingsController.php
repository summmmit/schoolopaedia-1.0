<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use App\Models\Sections;
use App\Models\Streams;
use App\Models\Subjects;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PhpSpec\Exception\Example\ErrorException;
use Validator;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Libraries\ApiResponseClass;

class AdminClassSettingsController extends Controller
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

    public function getClassesSettings()
    {
        return view('admin.class-settings');
    }

    public function postAllStreams()
    {

        $streams = Streams::where('school_id', $this->getSchoolAndUserBasicInfo()->getSchoolId())->get();

        return ApiResponseClass::successResponse($streams);
    }

    public function postAddOrEditStream(Request $request)
    {
        $stream_id = $request->input('stream_id');
        $stream_name = $request->input('stream_name');

        $input = [
            'stream_id' => $stream_id,
            'stream_name' => $stream_name
        ];

        $validator = validator::make($request->all(), [
            'stream_name' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $stream = Streams::findOrNew($stream_id);
            $stream->stream_name = ucwords($stream_name);
            $stream->school_id = $this->getSchoolAndUserBasicInfo()->getSchoolId();

            if ($stream->save()) {
                return ApiResponseClass::successResponse($stream, $input);
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postDeleteStream(Request $request)
    {

        $stream_id = $request->input('stream_id');

        $input = [
            'stream_id' => $stream_id,
        ];

        $validator = validator::make($request->all(), [
            'stream_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            DB::beginTransaction();

            try {

                $stream = Streams::findOrFail($stream_id);

                if (!$stream->delete()) {
                    throw new ErrorException;
                }

                DB::commit();

            } catch (ModelNotFoundException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input);
            } catch (ErrorException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input);
            }
            return ApiResponseClass::successResponse($stream, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postGetAllClassesByStreamId(Request $request)
    {
        $stream_id = $request->input('stream_id');

        $input = [
            'stream_id' => $stream_id,
        ];

        $validator = validator::make($request->all(), [
            'stream_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $classes = Classes::where('stream_id', $stream_id)->get();

            return ApiResponseClass::successResponse($classes, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postAddOrEditClass(Request $request)
    {
        $class_id = $request->input('class_id');
        $class_name = $request->input('class_name');
        $stream_id = $request->input('stream_id');

        $input = [
            'class_id' => $class_id,
            'stream_id' => $stream_id,
            'class_name' => $class_name
        ];

        $validator = validator::make($request->all(), [
            'stream_id' => 'required',
            'class_name' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $class = Classes::findOrNew($class_id);
            $class->class_name = ucwords($class_name);
            $class->stream_id = $stream_id;
            $class->school_id = $this->getSchoolAndUserBasicInfo()->getSchoolId();

            if ($class->save()) {
                return ApiResponseClass::successResponse($class, $input);
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postDeleteClass(Request $request)
    {
        $class_id = $request->input('class_id');

        $input = [
            'class_id' => $class_id,
        ];

        $validator = validator::make($request->all(), [
            'class_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            DB::beginTransaction();

            try {

                $class = Classes::findOrFail($class_id);

                if (!$class->delete()) {
                    throw new ErrorException;
                }

                DB::commit();

            } catch (ModelNotFoundException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input);
            } catch (ErrorException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input);
            }
            return ApiResponseClass::successResponse($class, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postGetAllSectionsByClassId(Request $request)
    {
        $class_id = $request->input('class_id');

        $input = [
            'class_id' => $class_id,
        ];

        $validator = validator::make($request->all(), [
            'class_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $sections = Sections::where('class_id', $class_id)->get();

            return ApiResponseClass::successResponse($sections, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postAddOrEditSection(Request $request)
    {
        $class_id = $request->input('class_id');
        $section_name = $request->input('section_name');
        $section_id = $request->input('section_id');

        $input = [
            'class_id' => $class_id,
            'section_id' => $section_id,
            'section_name' => $section_name
        ];

        $validator = validator::make($request->all(), [
            'class_id' => 'required',
            'section_name' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $section = Sections::findOrNew($section_id);
            $section->section_name = ucwords($section_name);
            $section->class_id = $class_id;

            if ($section->save()) {
                return ApiResponseClass::successResponse($section, $input);
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postDeleteSection(Request $request)
    {
        $section_id = $request->input('section_id');

        $input = [
            'section_id' => $section_id,
        ];

        $validator = validator::make($request->all(), [
            'section_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            DB::beginTransaction();

            try {

                $section = Sections::findOrFail($section_id);

                if (!$section->delete()) {
                    throw new ErrorException;
                }

                DB::commit();
            } catch (ModelNotFoundException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input);
            } catch (ErrorException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $input);
            }
            return ApiResponseClass::successResponse($section, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postGetAllSubjectsBySectionId(Request $request)
    {
        $section_id = $request->input('section_id');

        $input = [
            'section_id' => $section_id,
        ];

        $validator = validator::make($request->all(), [
            'section_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $subjects = Subjects::where('section_id', $section_id)->get();
            return ApiResponseClass::successResponse($subjects, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postAddOrEditSubject(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $subject_name = $request->input('subject_name');
        $subject_code = $request->input('subject_code');
        $section_id = $request->input('section_id');

        $input = [
            'subject_id' => $subject_id,
            'subject_name' => $subject_name,
            'subject_code' => $subject_code,
            'section_id' => $section_id
        ];

        $validator = validator::make($request->all(), [
            'section_id' => 'required',
            'subject_name' => 'required',
            'subject_code' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            $subject = Subjects::findOrNew($subject_id);
            $subject->subject_name = ucwords($subject_name);
            $subject->subject_code = strtoupper($subject_code);
            $subject->section_id = $section_id;

            if ($subject->save()) {
                return ApiResponseClass::successResponse($subject, $input);
            }
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

    public function postDeleteSubject(Request $request)
    {
        $subject_id = $request->input('subject_id');

        $input = [
            'subject_id' => $subject_id,
        ];

        $validator = validator::make($request->all(), [
            'subject_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $input, $validator->errors());
        } else {

            try{

                $subject = Subjects::findOrFail($subject_id);
                if (!$subject->delete()) {
                    throw new ErrorException;
                }
            }catch (ModelNotFoundException $e){
                return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
            }catch (ErrorException $e){
                return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
            }
            return ApiResponseClass::successResponse($subject, $input);
        }
        return ApiResponseClass::errorResponse('There is Something Wrong. Please Try Again!!', $input);
    }

}
