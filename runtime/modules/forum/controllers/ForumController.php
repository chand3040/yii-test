<?php

class ForumController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    public function init(){

        parent::init();

        Yii::app()->session['adminKey'] = '0';

    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('addcomment','uploadAttachement','UpdateViewLimit','navigate','sendmaillistowmer','mymessages'),
                'users'=>array('*'),
            ),
            /*array('deny',  // deny all users
                'users'=>array('*'),
            ),*/
        );
    }

    public function actionMymessages(){


        //$listid = $_REQUEST['id'];
        //$model = $this->loadModel($listid);
        $this->pageTitle=$model->user_default_listing_title. 'My Messages - Business Supermarket';
        //$this->metaDesc=$model->drg_desc;
        // $this->metaKeys=$model->meta_keywords;
        //$adminKey = isset($_REQUEST['h']) ? $_REQUEST['h'] : "";

        $this->render('mymessages', array());


    }

    public function actionAddComment(){

        // Return 302 code if the user isn't logged in
        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $message = $_POST['message'];
        $commentReference = $_POST['commentReference'];
        $attachementUploadFile = $_POST['attachementUploadFile'];
        $attachementThumbUploadFile = $_POST['thumbattachementUploadFile'];

        // No listing so return null
        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0" ) );
            return false;

        }

        $firstComment = ($commentReference == 0) ? '1' : '0';

        $comment = new Comments();
        $comment->user_default_interaction_message = $message;
        $comment->user_default_profile_id = Yii::app()->user->Id;
        $comment->user_default_listing_id = $listingId;
        $comment->user_default_first_interations = $firstComment;

        // Add the attachement if exist
        if( ($attachementUploadFile != "null") && (is_file(ForumClass::$uploadDirectoryPath.$attachementUploadFile)) ){

            $comment->user_default_attachment = $attachementUploadFile;
        }

        if( ($attachementThumbUploadFile != "null") && (is_file(ForumClass::$uploadThumbDirectoryPath.$attachementThumbUploadFile)) ){

            $comment->user_default_thumb_attachment = $attachementThumbUploadFile;
        }


        $comment->user_default_date_create = date('Y-m-d H:i:s');
        $comment->save();

        if ( $commentReference > 0 ){

            $commentComment = new PostComments();
            $commentComment->user_default_interactions_message_id = $comment->user_default_interaction_id;
            $commentComment->user_default_interaction_id = $commentReference + 1;
            $commentComment->save();

        }

        // Output some JSON instead of the usual text/html
        echo CJSON::encode( array("action_status" => "1" ) );
        return true;

    }

    public function actionsendMailListOwmer(){

        // Return 302 code if the user isn't logged in

        $adminEmail = ForumClass::$adminMail;
        // $userData =Adminuser::model()->findByAttributes(array('email'=>$adminEmail));

        $listingId = ( isset($_POST['listid']) ) ? $_POST['listid'] : NULL;
        $message = $_POST['msg'];
        $commentReference = $_POST['commentReference'];
        $attachementUploadFile = $_POST['attachementUploadFile'];
        $subject = $_POST['subject'];
        // No listing so return null
        /*if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0" ) );
            return false;

        }

        $comment = Comments::model()->findByPk($commentReference);

        $comment->is_spam = '0';

        $comment->save(); */

        $listing = Listings::model()->findByPk($listingId);
        $firstMessage = '1';

        $userMessage = new UserMessages();
        $userMessage->message = $message;
        $userMessage->subject = $subject;
        $userMessage->user_default_profiles_id = Yii::app()->user->Id;
        $userMessage->user_default_listing_id = $listingId;
        $userMessage->created_date = date('Y-m-d H:i:s');
        $userMessage->first_message = $firstMessage;


        // Add the attachement if exist
        /* if( ($attachementUploadFile != "null") && (is_file($this->$uploadDirectoryPath.$attachementUploadFile)) ){

            $userMessage->attachement = $attachementUploadFile;
        } */

        if($userMessage->save()){

            $model_fromuser = User::model()->find("user_default_id='".$listing->user_default_profiles_id."'");

            $model_user = User::model()->find("user_default_id='".Yii::app()->user->getState('uid')."'");

            $title=$_POST['title'];

            $subject11=$_POST['subject'];

            $msg=$_POST['msg'];

            $furl=$_POST['furl'];

            $sitelink='<a href="'.Yii::app()->getBaseUrl(true).'" target="_blank" >here >> </a>';

            $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing/fupdate/listid/".$listingId.'" target="_blank" >here >> </a>';


            $template =  MailTemplate::getTemplate('listing_via_contact_user');

            $string = array(
                '{{#LISTINGTITLE#}}'=>ucwords($title),
                '{{#USERNAME#}}'=>ucwords($model_fromuser['user_default_first_name'] .' '. $model_fromuser['user_default_surname']),
                '{{#SITELINK#}}'=>ucwords($sitelink)
            );

            $subject="Listing ".$listing['user_default_listing_title']." requires your input";

            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

            $result =  SharedFunctions::app()->sendmail($model_fromuser['user_default_email'],$subject,$body);

            $newmsg=str_replace("\n","</p><p>",$msg);

            $msgg="<span style='color:black;margin:0px;text-transform:capitalize;'>".$newmsg."</span>";

            $template1 =  MailTemplate::getTemplate('listing_via_contact_user2');

            $string1 = array('{{#LISTINGTITLE#}}'=>ucwords($title),
                '{{#USERNAME#}}'=>ucwords($model_fromuser['user_default_first_name'] .' '. $model_fromuser['user_default_surname']),
                '{{#SNAME#}}'=>ucwords($model_user['user_default_first_name'] .' '. $model_user['user_default_surname']),
                '{{#SUNAME#}}'=>ucwords($model_user['user_default_username']),
                '{{#SITELINK#}}'=>ucwords($yii_user_request_id),
                '{{#MESSAGE#}}'=>ucwords($msgg)
            );

            $subject1="You have received a private message re: ".$subject11;

            $body1 = SharedFunctions::app()->mailStringReplace($template1->template_body,$string1);

            $result1 =  SharedFunctions::app()->sendmail($model_fromuser['user_default_email'],$subject1,$body1);

            $memail=$_POST['memail'];

            if($memail=="yes")

            {


                $template =  MailTemplate::getTemplate('listing_via_contact_user3');

                $string = array(
                    '{{#LISTINGTITLE#}}'=>ucwords($title),
                    '{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'] .' '. $model_user['user_default_surname']),
                    '{{#USER#}}'=>ucwords($model_fromuser['user_default_first_name'] .' '. $model_fromuser['user_default_surname']),
                    '{{#MESSAGE#}}'=>ucwords($msgg)
                );

                $subject="You have sent the following message to ".$listing['user_default_listing_title'];

                $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

                $result =  SharedFunctions::app()->sendmail($model_user['user_default_email'],$subject,$body);


            }

            /* $template =  MailTemplate::getTemplate('comment_justified_notification');
             $string = array(
                 '{{#COMMENTMESSAGE#}}'=>$comment['message'],
                 '{{#COMPANY_NAME#}}'=>Yii::app()->params['company_name'],
                 '{{#COMPANY_SIGNATURE#}}'=>Yii::app()->params['signature'],
                 '{{#MESSAGE#}}' =>$message,
                 '{{#LISTINGTITLE#}}' => $listing['user_default_listing_title'],
                 '{{#COMPANY_EMAIL#}}'=>Yii::app()->params['company_email'],
                 '{{#USERNAME#}}'=>ucwords($user['user_default_first_name'].' '.$user['user_default_surname'])
             );


             $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
             SharedFunctions::app()->sendmail($user['user_default_email'],$subject,$body,$attachment,$adminEmail,$adminEmail); */
        }

        $this->redirect(Yii::app()->createUrl("$furl"));
        die;

        // Output some JSON instead of the usual text/html
        // echo CJSON::encode( array("action_status" => "1" ) );
        //return true;

    }


    public function actionlikeComment(){

        // Return 302 code if the user isn't logged in
        $authenticatedUserId = Yii::app()->user->Id;

        if( (Yii::app()->user->isGuest) && (empty($authenticatedUserId)) ){

            throw new CHttpException(302, "");

        }

        $commentId = ( isset($_POST['commentId']) ) ? $_POST['commentId'] : NULL;
        $likeAction = ( isset($_POST['likeAction']) ) ? $_POST['likeAction'] : NULL;

        if( ($commentId == NULL) || ($likeAction == NULL) ){

            echo CJSON::encode( array("action_status" => "0" ) );
            return false;

        }

        $criteria = new CDbCriteria;
        $criteria->addCondition("user_default_interaction_id = {$commentId}");
        $criteria->addCondition("user_default_profile_id = {$authenticatedUserId}");
        $likeComment = LikeComment::model()->find($criteria);

        $criteria2 = new CDbCriteria;
        $criteria2->addCondition("user_default_interaction_id = {$commentId}");
        $comment = Comments::model()->find($criteria2);

        $likeAction = ($likeAction == "dislike") ? '0' : '1';

        // So new like or dislike
        if ( ! ($likeComment instanceof LikeComment) ){

            $likeComment = new LikeComment();
            $likeComment->user_default_interaction_id = $commentId;
            $likeComment->user_default_profile_id = $authenticatedUserId;
            $likeComment->like_interacton = $likeAction;
            $likeComment->date_create = date('Y-m-d H:i:s');
            $likeComment->save();

            // Increment the total of like / dislike

            if( $likeAction == '0' ){
                $comment->user_default_dislikes_total += 1;
            }else{
                $comment->user_default_likes_total += 1;
            }

            $comment->save();

        }else{

            // Update the user choice
            //
            // The same choice no update
            if( $likeComment->like_interacton == $likeAction ){

                // Nothing to do here
                // Output some JSON instead of the usual text/html
                echo CJSON::encode( array("action_status" => "0" ) );
                return true;

            }else{

                $likeComment->like_interacton = $likeAction;
                $likeComment->date_update = date('Y-m-d H:i:s');
                $likeComment->save();

                if( $likeAction == '0' ){
                    $comment->user_default_dislikes_total += 1;
                    $comment->user_default_likes_total -= 1;
                }else{
                    $comment->user_default_dislikes_total -= 1;
                    $comment->user_default_likes_total += 1;
                }

                $comment->save();

            }

        }

        // Output some JSON instead of the usual text/html
        echo CJSON::encode( array("action_status" => "1" ) );

        return true;

    }


    public function actionUpdateViewLimit(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : ForumClass::$commentViewLimit;
        $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : ForumClass::$commentOrderBy;
        $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : ForumClass::$userProfession;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        $listing = Userlisting::model()->findByPk($listingId);

        // Render the forum page with the new paramters
        $listingView = $this->renderPartial('/forum/page',
            array(
                'listing' => $listing,
                'commentViewLimit' => $viewLimitValue,
                'commentViewOffset' => ForumClass::$commentViewOffset,
                'commentOrderBy' => $commentOrderBy,
                'userProfession' => $userProfession
            ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }


    public function actionNavigate(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : 6;
        $pageSelected = ( isset($_POST['pageSelected']) ) ? $_POST['pageSelected'] : 1;
        $viewOffsetValue = ( isset($_POST['viewOffsetValue']) ) ? $_POST['viewOffsetValue'] : 0;
        $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : 'user_default_date_create DESC';
        $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : 0;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }
        $listing = Userlisting::model()->findByPk($listingId);
        // print_r($listing);
        $listingView = $this->renderPartial('/forum/page', array(
            'listing' => $listing,
            'commentViewLimit' => $viewLimitValue,
            'commentViewOffset' => $viewOffsetValue,
            'commentOrderBy' => $commentOrderBy,
            'pageSelected' => $pageSelected,
            'userProfession' => $userProfession
        ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }



    public function actionReportAsSpam(){

        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $commentId = ( isset($_POST['commentId']) ) ? $_POST['commentId'] : NULL;

        if( ($listingId == NULL) || ($commentId == NULL) ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        $comment = Comments::model()->findByPk($commentId);

        $comment->is_spam = '1';

        $comment->save();

        // Send mail to admin

        $commentOwner = User::model()->findByPk($comment->user_default_profile_id);
        $commentOwnerName = $commentOwner->user_default_first_name." ".$commentOwner->user_default_surname;

        $listing = Listings::model()->findByPk($listingId);


        $listingOwner = User::model()->findByPk($listing->user_default_profile_id);
        $listingOwnerName = $listingOwner->user_default_first_name." ".$listingOwner->user_default_surname;


        $mailTemplate =  new MailTemplate();

        // Get the forum_report_comment_as_spam template
        $template =  $mailTemplate->getTemplate('forum_report_comment_as_spam');

        // No need to continue if the template is not found
        if( ! ($template instanceof MailTemplate ) ){

            echo CJSON::encode(array("action_status" => "0"));
            return FALSE;
        }

        // To secure admin connection, it's necessary to add an encrypted key in the listing link to be sent to the admin
        $encrypedKey = ForumClass::encryptString(ForumClass::$adminMail);

        $listingLink = Yii::app()->getBaseUrl(true)."/listing/view?id={$listingId}&h=".$encrypedKey;

        $commentDateCreat = ForumClass::formatDate($comment->user_default_date_create);

        // Format the template with the right parameters
        $bodyString = array(
            '{{#COMMENT_OWNER#}}' => $commentOwnerName,
            '{{#COMMENT_DATE#}}' => $commentDateCreat['date']." ".$commentDateCreat['time'],
            '{{#COMMENT_CONTENT#}}' => $comment->message,
            '{{#LISTING_OWNER#}}' => $listingOwnerName,
            '{{#LISTING_TITLE#}}' => $listing->user_default_listing_title,
            '{{#LISTING_LINK#}}' => $listingLink
        );

        $subjectString = array('{{#LISTING_NUMBER#}}' => $listingId);

        $body = SharedFunctions::app()->mailStringReplace($template->template_body, $bodyString);
        $subject = SharedFunctions::app()->mailStringReplace($template->template_subject, $subjectString);
        $result=SharedFunctions::app()->sendmail(ForumClass::$adminMail,$subject,$body);

        // Send the email
        /*$mail = new YiiMailer();
        $mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup server
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';                            // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;
        //set mail properties
        $mail->setFrom("Business Supermarket");

        $mail->setTo(ForumClass::$adminMail);

        $mail->setSubject($subject);
        $mail->setBody($body, 'text/html');

        $result = ($mail->send()) ? "1" : "0";*/

        echo CJSON::encode(array("action_status" => "1"));

    }


    public function actionuploadAttachement(){


        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $error = FALSE;
        $message = "Upload attachment success";
        $fileName = "error";

        if( empty($_FILES) || ($_FILES['attachement']['error'] != 0)  ){

            $error = TRUE;
            $message = "Attachment not found.";

        }

        if( ! $error ){

            $attachement = $_FILES['attachement'];

            if( (!$error) && ( !in_array($attachement['type'], ForumClass::$allowedUploadType)) ){

                $error = TRUE;
                $message = "You may not upload an illegal file.".'<br/>';
                $message .= '<span style="color: #6b6d6e;">File types allowed:- pdf, rar, zip, and image files only.</span>';
            }

            if( (!$error) && ( $attachement['size'] > ForumClass::$maxUploadFile) ){

                $error = TRUE;
                $message = "Attachment size not allowed.";

            }

        }

        if( !$error ){
            if(!file_exists(ForumClass::$uploadDirectoryPath)) {
                mkdir(ForumClass::$uploadDirectoryPath, 0777, true);
            }
            $fileToUploadPath = ForumClass::$uploadDirectoryPath.time().".".$attachement['name'];

            // Add time in file name to avoid conflict beetween files names
            $fileName = time().".".$attachement['name'];

            if( ! (move_uploaded_file($attachement['tmp_name'], $fileToUploadPath)) ){

                $error = TRUE;
                $message = "Upload attachement failed.";
                $fileName = "error";
            } else {
                $error = FALSE;
                $message = "Attachement Uploaded Successfully.";
            }
        }

        $actionStatus = (!$error) ? "1" : "0";

        echo CJSON::encode(array("action_status" => $actionStatus, "message" => $message, "file_name" => $fileName));


    }

    public function actionUploadThumbattachement(){


        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $error = FALSE;
        $message = "Upload attachment success";
        $fileName = "error";

        if( empty($_FILES) || ($_FILES['thumb_attchement']['error'] != 0)  ){

            $error = TRUE;
            $message = "Attachment not found.";

        }

        if( ! $error ){

            $attachement = $_FILES['thumb_attchement'];

            if( (!$error) && ( !in_array($attachement['type'], ForumClass::$allowedThumbUploadType)) ){

                $error = TRUE;
                $message = "You may not upload an illegal file.".'<br/>';
                $message .= '<span style="color: #6b6d6e;">File types allowed:- Image files only.</span>';
            }

            if( (!$error) && ( $attachement['size'] > ForumClass::$maxUploadFile) ){

                $error = TRUE;
                $message = "Attachment size not allowed.";

            }

        }

        if( !$error ){
            if(!file_exists(ForumClass::$uploadThumbDirectoryPath)) {
                mkdir(ForumClass::$uploadThumbDirectoryPath, 0777, true);
            }
            $fileToUploadPath = ForumClass::$uploadThumbDirectoryPath.time().".".$attachement['name'];

            // Add time in file name to avoid conflict beetween files names
            $fileName = time().".".$attachement['name'];

            if( ! (move_uploaded_file($attachement['tmp_name'], $fileToUploadPath)) ){

                $error = TRUE;
                $message = "Upload attachement failed.";
                $fileName = "error";
            }
        }

        $actionStatus = (!$error) ? "1" : "0";

        echo CJSON::encode(array("action_status" => $actionStatus, "message" => $message, "file_name" => $fileName));


    }


    public function actionDownloadAttachement(){


        // User must be logged in to see the file
        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "You must be logged in to view this page.");

        }

        if( empty($_REQUEST['commentId']) ){

            throw new CHttpException(404, "Page not found.");
        }


        $commentId = $_REQUEST['commentId'];

        $comment = Comments::model()->findByPk($commentId);

        if ( ! ($comment instanceof Comments) ){

            throw new CHttpException(404, "Attachement not found.");

        }

        if( empty($comment->user_default_attachment) || $comment->user_default_attachment === NULL ){

            throw new CHttpException(404, "Attachement not found.");

        }

        $attachment = $comment->user_default_attachment;

        // Get the real path of the attachement
        $filePath = Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.ForumClass::$uploadDirectoryPath.$attachment;

        if( ! is_file($filePath) ){

            throw new CHttpException(404, "Attachement not found.");
        }

        // Get the original file name
        $attachementName = explode(".", $attachment);
        $fileNameLength = (int) ( (strlen($attachementName[0])) + 1);

        $originaleFileName = substr($attachment, $fileNameLength);

        $mime = ForumClass::_mime_content_type($originaleFileName);
        // Fix for IE https issue
        header('Pragma: public');
        header('Content-Description: File Transfer');
        header("Content-type: ".$mime);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($filePath));

        header("Content-Disposition: attachment; filename=\"".$originaleFileName."\"");

        ob_clean();

        flush();

        readfile($filePath);

    }


    public function actionSetViewByCriteria(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : ForumClass::$commentViewLimit;
        $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : ForumClass::$commentOrderBy;
        $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : ForumClass::$userProfession;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        $listing = Userlisting::model()->findByPk($listingId);

        $listingView = $this->renderPartial('/forum/page', array(
            'listing' => $listing,
            'commentViewLimit' => $viewLimitValue,
            'commentViewOffset' => ForumClass::$commentViewOffset,
            'commentOrderBy' => $commentOrderBy,
            'userProfession' => $userProfession
        ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }



    public function actionDeleteComment(){

        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $commentId = ( isset($_POST['commentId']) ) ? $_POST['commentId'] : NULL;

        if( ($listingId == NULL) || ($commentId == NULL) ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        $comment = Comments::model()->findByPk($commentId);

        $comment->delete();

        echo CJSON::encode(array("action_status" => "1"));


    }


}
