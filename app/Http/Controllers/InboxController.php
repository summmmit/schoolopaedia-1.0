<?php

namespace App\Http\Controllers;

use app\Exceptions\ModelNotSavedException;
use App\Libraries\RequiredFunctions;
use App\Models\Mails;
use App\Models\MailsToUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\SchoolAndUserBasicInfo;
use App\Libraries\ApiResponseClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Validator;

class inboxController extends Controller
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

    //**-----------------------------------------------------Inbox ---------------------------------------------------**

    /**
     * @param none
     * @return Inbox mails to this user
     */
    public function postGetAllInboxMails()
    {

    }

    public function postComposeMail(Request $request)
    {
        $recipients = json_decode($request->input('recipients'));
        $subject = $request->input('subject');
        $message = $request->input('message');

        $validator = validator::make($request->all(), [
            'recipients' => 'required|JSON',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            DB::beginTransaction();

            try {

                $new_mail = new Mails();
                $new_mail->subject = $subject;
                $new_mail->message = $message;

                if (!$new_mail->save()) {
                    throw new ModelNotSavedException();
                }

                foreach ($recipients as $recipient) {

                    $recipient_id = User::getUserIdByEmail($recipient);

                    $mail_to_user = new MailsToUser();
                    $mail_to_user->mail_id = $new_mail->id;
                    $mail_to_user->user_send_by = $this->getSchoolAndUserBasicInfo()->getUserId();
                    $mail_to_user->user_send_to = $recipient_id;
                    $mail_to_user->send_at = date('Y-m-d H:i:s');
                    $mail_to_user->is_read = MailsToUser::MAIL_UNREAD;

                    if (!$mail_to_user->save()) {
                        throw new ModelNotSavedException();
                    }
                }
                DB::commit();
            } catch (ModelNotSavedException $e) {
                DB::rollback();
                return ApiResponseClass::errorResponse('SomeThing Went Wrong. Please Try Again Later or Contact Support!!', $request->all());
            }
        }

        return ApiResponseClass::successResponse($recipients, $request->all());
    }
}
