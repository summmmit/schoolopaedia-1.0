<?php

namespace App\Http\Controllers;

use app\Exceptions\ModelNotSavedException;
use App\Libraries\RequiredFunctions;
use App\Models\InboxFolders;
use App\Models\Mails;
use App\Models\MailsToFolder;
use App\Models\MailsToUser;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        $this->getCreateDefaultInboxFolders();
    }

    /**
     * @return SchoolAndUserBasicInfo
     */
    public function getSchoolAndUserBasicInfo()
    {
        return $this->_schoolAndUserBasicInfo;
    }

    //**-----------------------------------------------------Inbox ---------------------------------------------------**

    public function getCreateDefaultInboxFolders()
    {

        try {

            $folder_inbox = InboxFolders::where('folder_id', InboxFolders::FOLDER_INBOX_ID)
                ->where('user_id', $this->getSchoolAndUserBasicInfo()->getUserId())->get()->first();
            if (!$folder_inbox) {

                $folder_inbox = new InboxFolders();
                $folder_inbox->user_id = $this->getSchoolAndUserBasicInfo()->getUserId();
                $folder_inbox->folder_id = InboxFolders::FOLDER_INBOX_ID;
                $folder_inbox->folder_name = InboxFolders::FOLDER_INBOX;
                if (!$folder_inbox->save()) {
                    throw new ModelNotSavedException();
                }
            }

            $folder_sent_mails = InboxFolders::where('folder_id', InboxFolders::FOLDER_SENT_MAILS_ID)
                ->where('user_id', $this->getSchoolAndUserBasicInfo()->getUserId())->get()->first();
            if (!$folder_sent_mails) {

                $folder_sent_mails = new InboxFolders();
                $folder_sent_mails->user_id = $this->getSchoolAndUserBasicInfo()->getUserId();
                $folder_sent_mails->folder_id = InboxFolders::FOLDER_SENT_MAILS_ID;
                $folder_sent_mails->folder_name = InboxFolders::FOLDER_SENT_MAILS;
                if (!$folder_sent_mails->save()) {
                    throw new ModelNotSavedException();
                }
            }

            $folder_important = InboxFolders::where('folder_id', InboxFolders::FOLDER_IMPORTANT_ID)
                ->where('user_id', $this->getSchoolAndUserBasicInfo()->getUserId())->get()->first();
            if (!$folder_important) {

                $folder_important = new InboxFolders();
                $folder_important->user_id = $this->getSchoolAndUserBasicInfo()->getUserId();
                $folder_important->folder_id = InboxFolders::FOLDER_IMPORTANT_ID;
                $folder_important->folder_name = InboxFolders::FOLDER_IMPORTANT;
                if (!$folder_important->save()) {
                    throw new ModelNotSavedException();
                }
            }

            $folder_trash = InboxFolders::where('folder_id', InboxFolders::FOLDER_TRASH_ID)
                ->where('user_id', $this->getSchoolAndUserBasicInfo()->getUserId())->get()->first();
            if (!$folder_trash) {

                $folder_trash = new InboxFolders();
                $folder_trash->user_id = $this->getSchoolAndUserBasicInfo()->getUserId();
                $folder_trash->folder_id = InboxFolders::FOLDER_TRASH_ID;
                $folder_trash->folder_name = InboxFolders::FOLDER_TRASH;
                if (!$folder_trash->save()) {
                    throw new ModelNotSavedException();
                }
            }

        } catch (ErrorException $e) {

        } catch (ModelNotSavedException $e) {

        }
    }

    /**
     * @param none
     * @return Inbox mails to this user
     */
    public function postGetAllInboxMails()
    {
        $inbox_mails = MailsToUser::where('user_send_to', $this->getSchoolAndUserBasicInfo()->getUserId())->get();

        $mails = array();

        foreach ($inbox_mails as $inbox_mail) {

            $mail = Mails::find($inbox_mail->mail_id);
            $mail_info = array(
                'mail' => $mail,
                'mails_to_user' => $inbox_mail
            );
            array_push($mails, $mail_info);
        }
        return ApiResponseClass::successResponse($mails, null);
    }

    /**
     * @param none
     * @return Sent mails By this user
     */
    public function postGetAllSentMails()
    {
        $inbox_mails = MailsToUser::where('user_send_by', $this->getSchoolAndUserBasicInfo()->getUserId())->get();

        $mails = array();

        foreach ($inbox_mails as $inbox_mail) {

            $mail = Mails::find($inbox_mail->mail_id);
            $mail_info = array(
                'mail' => $mail,
                'mails_to_user' => $inbox_mail
            );
            array_push($mails, $mail_info);
        }
        return ApiResponseClass::successResponse($mails, null);
    }

    public function postGetAllSchoolUsers()
    {
        $users = RequiredFunctions::getAllUsersWithEmailAndNames($this->getSchoolAndUserBasicInfo()->getSchoolId());

        //return response()->json($users);
        return ApiResponseClass::successResponse($users, null);
    }

    public function postComposeMail(Request $request)
    {
        $recipients = $request->input('recipients');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $validator = validator::make($request->all(), [
            'recipients' => 'required',
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

                    $mail_to_user = new MailsToUser();
                    $mail_to_user->mail_id = $new_mail->id;
                    $mail_to_user->user_send_by = $this->getSchoolAndUserBasicInfo()->getUserId();
                    $mail_to_user->user_send_to = $recipient;
                    $mail_to_user->send_at = date('Y-m-d H:i:s');
                    $mail_to_user->is_read = MailsToUser::MAIL_UNREAD;

                    if (!$mail_to_user->save()) {
                        throw new ModelNotSavedException();
                    }

                    $mail_to_folder = new MailsToFolder();
                    $mail_to_folder->mail_id = $new_mail->id;
                    $mail_to_folder->user_id = $this->getSchoolAndUserBasicInfo()->getUserId();
                    $mail_to_folder->folder_id = $this->getSentMailsFolderId();

                    if (!$mail_to_folder->save()) {
                        throw new ModelNotSavedException();
                    }

                    $mail_to_folder = new MailsToFolder();
                    $mail_to_folder->mail_id = $new_mail->id;
                    $mail_to_folder->user_id = $recipient;
                    $mail_to_folder->folder_id = $this->getInboxFolderId();

                    if (!$mail_to_folder->save()) {
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

    public function getInboxFolderId()
    {

        $inbox_folder = InboxFolders::where('user_id', $this->getSchoolAndUserBasicInfo()->getUserId())
            ->where('folder_id', InboxFolders::FOLDER_INBOX_ID)->get()->first();

        return $inbox_folder->id;
    }

    public function getSentMailsFolderId()
    {

        $inbox_folder = InboxFolders::where('user_id', $this->getSchoolAndUserBasicInfo()->getUserId())
            ->where('folder_id', InboxFolders::FOLDER_SENT_MAILS_ID)->get()->first();

        return $inbox_folder->id;
    }

    public function postGetAllInboxFolders()
    {

        $inbox_folder = InboxFolders::where('user_id', $this->getSchoolAndUserBasicInfo()->getUserId())->get();

        return ApiResponseClass::successResponse($inbox_folder, null);
    }

    public function postMakeMailRead(Request $request)
    {
        $mails_to_user_id = $request->input('mails_to_user_id');

        $mails_to_user = MailsToUser::findOrFail($mails_to_user_id);
        $mails_to_user->is_read = 1;
        $mails_to_user->save();

        return ApiResponseClass::successResponse($mails_to_user, null);
    }

    public function postGetMailInfo(Request $request)
    {
        $mails_to_user_id = $request->input('mails_to_user_id');

        $validator = validator::make($request->all(), [
            'mails_to_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::errorResponse('You Have Some Input Errors. Please Try Again!!', $request->all(), $validator->errors());
        } else {

            try {

                $mail_to_user = MailsToUser::findOrFail($mails_to_user_id);
                $mail = Mails::findOrFail($mail_to_user->mail_id);
                $user_send_by = User::findOrFail($mail_to_user->user_send_by);
                $user_send_by_details = UserDetails::where('user_id', $mail_to_user->user_send_by)->get()->first();

                // make the mail read
                $mail_to_user->is_read = 1;
                if (!$mail_to_user->save()) {
                    throw new ModelNotSavedException();
                }

                $mail_info = array(
                    'mail_to_user' => $mail_to_user,
                    'mail' => $mail,
                    'user_send_by' => $user_send_by,
                    'user_send_by_details' => $user_send_by_details,
                );

            } catch (ModelNotSavedException $e) {
                return ApiResponseClass::errorResponse('You Have Some Network Errors. Please Try Again!!', $request->all());
            } catch (ModelNotFoundException $e) {
                return ApiResponseClass::errorResponse('You Have Some Network Errors. Please Try Again!!', $request->all());
            }

            return ApiResponseClass::successResponse($mail_info, null);
        }

        return ApiResponseClass::errorResponse('You Have Some Network Errors. Please Try Again!!', $request->all());
    }
}
