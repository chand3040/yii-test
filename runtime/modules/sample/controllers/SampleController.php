<?php

class SampleController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('sampleslider','sample_view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('sample_listing','sampledelete','addcomment','updateviewlimit','navigate','sendmaillistowner','likecomment','reportasspam','setviewbycriteria','addorder','sendreminder'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSampledelete() {

        if ($_POST['sample_delete_id'] != "") {

            $id = $_POST['sample_delete_id'];

            $model = Samplelisting::model()->findByPk($id);

            $listingid = $model->user_default_listing_id;

            $listingdata = Userlisting::model()->findByPk($listingid);

            $user_details = User::model()->findAllByAttributes(array("user_default_id" => $listingdata->user_default_profiles_id));

            $user_id = $user_details[0]['user_default_id'];

            $user_name = $user_details[0]['user_default_username'];

            $folder = $user_name . '_' . $user_id;

            //$path = $_SERVER['DOCUMENT_ROOT'] . '/';
            $path=dirname(Yii::app()->request->scriptFile)."/";

            $temp_folder = $path . 'temp/';

            $userfolder = $path . 'upload/users/' . $folder . '/';

            $attribs1 = array('user_default_listing_lid' => $listingid);

            $criteria1 = new CDbCriteria(array('order' => '	user_default_listing_image_id ASC'));

            $imgs = Sampleimages::model()->findAllByAttributes($attribs1, $criteria1);

            foreach ($imgs as $images) {

                $img = $images->user_default_listing_image;

                $bigimgpath1 = $userfolder . 'listing/big/' . $img;

                $thumbimgpath1 = $userfolder . 'listing/thumb/' . $img;

                unlink($bigimgpath1);

                unlink($thumbimgpath1);
            }

            $query = "delete from `user_default_sample_listing_sliders` where `user_default_listing_lid` = :date";

            $command = Yii::app()->db->createCommand($query);

            $command->execute(array('date' => $listingid));

            $model->delete();

            $this->redirect($this->createUrl('/listing'));
        }
    }

    public function actionSampleslider()
    {
        $listid = $_REQUEST['listid'];
        $samplemodel = Sampleimages::model()->find("user_default_listing_lid ='" . $listid . "'");
        $this->renderPartial('sampleslider', array('samplesmodel' => $samplemodel, 'adminKey' => $adminKey));
    }


    public function actionSample_listing()
    {
        $listid = $_REQUEST['listid'];

        $model = $this->loadModel($listid);
        $this->pageTitle = $model->user_default_listing_title . ' - Business Supermarket';
        //$this->metaDesc=$model->drg_desc;
        // $this->metaKeys=$model->meta_keywords;
        $adminKey = isset($_REQUEST['h']) ? $_REQUEST['h'] : "";

        $samplemodel = Samplelisting::model()->find("user_default_listing_id ='" . $listid . "'");
        $count = count ( $samplemodel );

        if ($_POST['user_default_listing_image_text']) {

            $i = 0;
            for ($i = 0; $i < 6; $i++) {

                if ($_POST['img_name'][$i] != "") {

                    if($_POST['current_ids'][$i] != "")
                    {
                        $imgid = $_POST['current_ids'][$i];
                        $Userlistingimages = Sampleimages::model()->find("user_default_listing_image_id ='" . $imgid . "'");
                        $Userlistingimages->user_default_listing_image = $_POST['img_name'][$i];
                        $Userlistingimages->user_default_listing_image_text = $_POST['user_default_listing_image_text'][$i];
                        $Userlistingimages->user_default_listing_image_link2 = $_POST['user_default_listing_image_link2'][$i];
                        $Userlistingimages->user_default_listing_lid = $listid;
                        $Userlistingimages->save();
                    }
                    else
                    {
                        $Userlistingimages = new Sampleimages;
                        $Userlistingimages->user_default_listing_image = $_POST['img_name'][$i];
                        $Userlistingimages->user_default_listing_image_text = $_POST['user_default_listing_image_text'][$i];
                        $Userlistingimages->user_default_listing_image_link2 = $_POST['user_default_listing_image_link2'][$i];
                        $Userlistingimages->user_default_listing_lid = $listid;
                        $Userlistingimages->save();
                    }


                }
            }


        }
        if($_POST['user_default_sample_listing_currency']!="")
        {
            if($_POST['attach1']!="" || $_POST['attach2']!="" || $_POST['attach3']!="" || $_POST['attach4']!="")
            {
                $folder = YiiBase::getPathOfAlias('webroot').'/upload/attachments/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
            }




            if($_FILES['file1']['name']!="")
            {
                $target_path = $folder . basename( $_FILES['file1']['name']);
                move_uploaded_file($_FILES['file1']['tmp_name'], $target_path);
                $attach1 = $_FILES['file1']['name'];
            }

            if($_FILES['file2']['name']!="")
            {
                $target_path = $folder . basename( $_FILES['file2']['name']);
                move_uploaded_file($_FILES['file2']['tmp_name'], $target_path);
                $attach2 = $_FILES['file2']['name'];
            }

            if($_FILES['file3']['name']!="")
            {
                $target_path = $folder . basename( $_FILES['file3']['name']);
                move_uploaded_file($_FILES['file3']['tmp_name'], $target_path);
                $attach3 = $_FILES['file3']['name'];
            }

            if($_FILES['file4']['name']!="")
            {
                $target_path = $folder . basename( $_FILES['file4']['name']);
                move_uploaded_file($_FILES['file4']['tmp_name'], $target_path);
                $attach4 = $_FILES['file4']['name'];
            }



            if($count == "1")
            {
                $samplemodel->attributes = $_POST['Samplelisting'];
                $samplemodel->user_default_sample_listing_currency = $_POST['user_default_sample_listing_currency'];
                $samplemodel->user_default_sample_listing_terms = $_POST['rule'];
                if($attach1 !="")
                {
                    $samplemodel->user_default_sample_listing_att_specs = $attach1;
                }
                if($attach2 !="")
                {
                    $samplemodel->	user_default_sample_listing_att_instruction = $attach2;
                }
                if($attach3 !="")
                {
                    $samplemodel->	user_default_sample_listing_att_safety = $attach3;
                }
                if($attach4 !="")
                {
                    $samplemodel->user_default_sample_listing_image = $attach4;
                }

                $samplemodel->user_default_sample_listing_date = date('Y-m-d');

                $samplemodel->save();
            }
            else
            {
                $newsample = new Samplelisting;
                $newsample->user_default_listing_id = $listid;
                $newsample->attributes = $_POST['Samplelisting'];
                $newsample->user_default_sample_listing_currency = $_POST['user_default_sample_listing_currency'];
                $newsample->user_default_sample_listing_terms = $_POST['rule'];
                if($attach1 !="")
                {
                    $newsample->user_default_sample_listing_att_specs = $attach1;
                }
                if($attach2 !="")
                {
                    $newsample->	user_default_sample_listing_att_instruction = $attach2;
                }
                if($attach3 !="")
                {
                    $newsample->	user_default_sample_listing_att_safety = $attach3;
                }
                if($attach4 !="")
                {
                    $newsample->user_default_sample_listing_image = $attach4;
                }
                $newsample->user_default_sample_listing_date = date('Y-m-d');

                $newsample->save();
            }
        }
        //print_r($samplemodel);
        if(isset($_POST['btnsaveforlater']))
        {

            $model_user = User::model()->find("user_default_id='".Yii::app()->user->getState('uid')."'");

            $listingdate = date('d/m/Y',strtotime($model['user_default_listing_date']));

            $to = $model_user['user_default_email'];

            $listinglink = '<a href="'.Yii::app()->getBaseUrl(true)."/"."sample/sample_listing/listid/".$model->user_default_listing_id.'" target="_blank" style="color:#808080">here >> </a>';



            if($_POST['btnsaveforlater'] == "1")
            {
                $lstatus="Saved for later";

                $string = array(
                    '{{#LISTINGTITLE#}}'=>ucwords($model['user_default_listing_title']),
                    '{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'] .' '. $model_user['user_default_surname']),
                    '{{#LISTINGDATE#}}'=>ucwords($listingdate),
                    '{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
                    '{{#LISTINGLINK#}}'=>ucwords($listinglink)
                );

                $template =  MailTemplate::getTemplate('Sample_listing_save_later');

                $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

                $subject = SharedFunctions::app()->mailStringReplace($template->template_subject,$string);

                $result =  SharedFunctions::app()->sendmail($to,$subject,$body);

                $this->redirect($this->createUrl('/listing/selectlisting/listid/' . $listid));
            }
            else
            {
                if($newsample->user_default_sample_listing_status == "0")
                {

                    $lstatus="Waiting admin approval and publication";

                    $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['user_default_listing_title']),
                        '{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'] .' '. $model_user['user_default_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($listingdate),
                        '{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
                        '{{#LISTINGLINK#}}'=>ucwords($listinglink)
                    );

                    $template =  MailTemplate::getTemplate('Sample_listing_publish');

                    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

                    $subject = SharedFunctions::app()->mailStringReplace($template->template_subject,$string);

                    $result =  SharedFunctions::app()->sendmail($to,$subject,$body);
                }

                $this->render('samplesuccess', array('model' => $model, 'adminKey' => $adminKey));
            }


        }
        else
        {
            $this->render('sample_listing', array('model' => $model, 'adminKey' => $adminKey));
        }


    }

    public function loadModel($id) {
        $model = Userlisting::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }


    public function actionAddcomment(){

        // Return 302 code if the user isn't logged in        
        if( (Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id)) ){

            throw new CHttpException(302, "");

        }

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $message = $_POST['message'];
        $rating = $_POST['rating'];
        $commentReference = $_POST['commentReference'];
        //$attachementUploadFile = $_POST['attachementUploadFile'];
        //$attachementThumbUploadFile = $_POST['thumbattachementUploadFile'];

        // No listing so return null
        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0" ) );
            return false;

        }

        $firstComment = ($commentReference == 0) ? '1' : '0';

        $comment = new Samplefeedback();
        $comment->user_default_sample_listing_feedback_message = $message;
        $comment->user_default_profiles_id = Yii::app()->user->Id;
        $comment->user_default_sample_listing_id = $listingId;
        $comment->user_default_first_feedback = $firstComment;
        $comment->user_default_sample_listing_feedback_rating = $rating;


        /*
        // Add the attachement if exist
        if( ($attachementUploadFile != "null") && (is_file(Samplefeedback::$uploadDirectoryPath.$attachementUploadFile)) ){
        
            $comment->user_default_attachment = $attachementUploadFile;
        }
        
        if( ($attachementThumbUploadFile != "null") && (is_file(Samplefeedback::$uploadThumbDirectoryPath.$attachementThumbUploadFile)) ){

            $comment->user_default_thumb_attachment = $attachementThumbUploadFile;
        }
        */


        $comment->user_default_sample_listing_feedback_date = date('Y-m-d H:i:s');


        if ( $commentReference > 0 ){

            $comment->user_default_parent_id = $commentReference;

        }

        $comment->save();

        // Output some JSON instead of the usual text/html            
        echo CJSON::encode( array("action_status" => "1" ) );
        return true;

    }

    public function actionSendmaillistowner(){

        // Return 302 code if the user isn't logged in

        $adminEmail = Samplefeedback::$adminMail;
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


    public function actionLikecomment(){

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
        $criteria->addCondition("user_default_sample_feedback_id = {$commentId}");
        $criteria->addCondition("user_default_profile_id = {$authenticatedUserId}");
        $likeComment = LikeFeedback::model()->find($criteria);

        $criteria2 = new CDbCriteria;
        $criteria2->addCondition("user_default_sample_listing_feedback_id = {$commentId}");
        $comment = Samplefeedback::model()->find($criteria2);

        $likeAction = ($likeAction == "dislike") ? '0' : '1';

        // So new like or dislike
        if ( ! ($likeComment instanceof LikeComment) ){

            $likeComment = new LikeFeedback();
            $likeComment->user_default_sample_feedback_id = $commentId;
            $likeComment->user_default_profile_id = $authenticatedUserId;
            $likeComment->like_interacton = $likeAction;
            $likeComment->date_create = date('Y-m-d H:i:s');
            $likeComment->save();

            // Increment the total of like / dislike

            if( $likeAction == '0' ){
                $comment->user_default_feedback_dislikes_total += 1;
            }else{
                $comment->user_default_feedback_likes_total += 1;
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
                    $comment->user_default_feedback_dislikes_total += 1;
                    $comment->user_default_feedback_likes_total -= 1;
                }else{
                    $comment->user_default_feedback_dislikes_total -= 1;
                    $comment->user_default_feedback_likes_total += 1;
                }

                $comment->save();

            }

        }

        // Output some JSON instead of the usual text/html            
        echo CJSON::encode( array("action_status" => "1" ) );

        return true;

    }


    public function actionUpdateviewlimit(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : Samplefeedback::$commentViewLimit;
        $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : Samplefeedback::$commentOrderBy;
        $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : Samplefeedback::$userProfession;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        $listing = Samplelisting::model()->findByPk($listingId);

        // Render the forum page with the new paramters
        $listingView = $this->renderPartial('sample_fetch',
            array(
                'address' => $listing,
                'commentViewLimit' => $viewLimitValue,
                'commentViewOffset' => Samplefeedback::$commentViewOffset,
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
        $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : 'user_default_sample_listing_feedback_date desc';
        $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : 0;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }
        $address = Samplelisting::model()->findByPk($listingId);

        $countcomments = Samplefeedback::getTotalFeedbacksbyid($address->user_default_sample_listing_id);
        $countrating = Samplefeedback::getTotalFeedbacks($address->user_default_sample_listing_id);

        $listingrating = number_format($countcomments[0]['ratings'] / $countrating[0]['total_comments'], 1, '.', '');
        // print_r($listing);
        $listingView = $this->renderPartial('sample_fetch', array(
            'address' => $address,
            'commentViewLimit' => $viewLimitValue,
            'commentViewOffset' => $viewOffsetValue,
            'commentOrderBy' => $commentOrderBy,
            'pageSelected' => $pageSelected,
            'userProfession' => $userProfession
        ), true);


        echo CJSON::encode(array("action_status" => "1","crating" => $listingrating, "listingView" => $listingView));


    }



    public function actionReportasspam(){

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
        $encrypedKey = Samplefeedback::encryptString(Samplefeedback::$adminMail);

        $listingLink = Yii::app()->getBaseUrl(true)."/listing/view?id={$listingId}&h=".$encrypedKey;

        $commentDateCreat = Samplefeedback::formatDate($comment->user_default_date_create);

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
        $result=SharedFunctions::app()->sendmail(Samplefeedback::$adminMail,$subject,$body);

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

        $mail->setTo(Samplefeedback::$adminMail);

        $mail->setSubject($subject);
        $mail->setBody($body, 'text/html');
        
        $result = ($mail->send()) ? "1" : "0";*/

        echo CJSON::encode(array("action_status" => "1"));

    }


    public function actionSetviewbycriteria(){

        $listingId = ( isset($_POST['listingId']) ) ? $_POST['listingId'] : NULL;
        $viewLimitValue = ( isset($_POST['viewLimitValue']) ) ? $_POST['viewLimitValue'] : Samplefeedback::$commentViewLimit;
        $commentOrderBy = ( isset($_POST['commentOrderBy']) ) ? $_POST['commentOrderBy'] : Samplefeedback::$commentOrderBy;
        $userProfession = ( isset($_POST['userProfession']) ) ? $_POST['userProfession'] : Samplefeedback::$userProfession;

        if( $listingId == NULL ){

            echo CJSON::encode( array("action_status" => "0") );
            return false;

        }

        $listing = Samplelisting::model()->findByPk($listingId);

        $listingView = $this->renderPartial('sample_fetch', array(
            'address' => $listing,
            'commentViewLimit' => $viewLimitValue,
            'commentViewOffset' => Samplefeedback::$commentViewOffset,
            'commentOrderBy' => $commentOrderBy,
            'userProfession' => $userProfession
        ), true);

        echo CJSON::encode(array("action_status" => "1", "listingView" => $listingView));


    }



    public function actionDeletecomment(){

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


    public function actionAddorder()
    {
        $listid = $_REQUEST['listid'];
        $userlistid = $_REQUEST['mainlistid'];
        $samplemodel = Samplelisting::model()->find("user_default_listing_id ='" . $listid . "'");
        $count = count ( $samplemodel );
        if($listid!="")
        {

            $newsample = new Sampleorder;
            $newsample->user_default_sample_listing_id = $listid;
            $newsample->user_default_sample_listing_order_quantity = $_REQUEST['quantity'];
            $newsample->user_default_sample_listing_order_cost = $_REQUEST['total'];
            $newsample->user_default_profiles_id = Yii::app()->user->getState('uid');
            $newsample->user_default_sample_listing_order_instruction = $_REQUEST['instructions'];
            $newsample->user_default_sample_listing_order_date = date('Y-m-d h:i:s');
            $newsample->user_default_sample_listing_order_status = '0';
            $newsample->save();


            /*
            
            $model_user = User::model()->find("user_default_id='".Yii::app()->user->getState('uid')."'");
            
            $listingdate = date('d/m/Y',strtotime($model['user_default_listing_date']));
            
            $to = $model_user['user_default_email'];			
            
            $listinglink = '<a href="'.Yii::app()->getBaseUrl(true)."/"."sample/sample_listing/listid/".$model->user_default_listing_id.'" target="_blank" style="color:#808080">here >> </a>';
            
            $lstatus="Saved for later";
            
            $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model['user_default_listing_title']),
                        '{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'] .' '. $model_user['user_default_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($listingdate),
                        '{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
                        '{{#LISTINGLINK#}}'=>ucwords($listinglink)                        
                    );
            
            $template =  MailTemplate::getTemplate('Sample_listing_save_later');		
                    
            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
            
            $subject = SharedFunctions::app()->mailStringReplace($template->template_subject,$string);
            
            $result =  SharedFunctions::app()->sendmail($to,$subject,$body);
            
            */

        }
        $this->redirect($this->createUrl('/listing/view?id=' . $userlistid));


    }

    public function actionSendreminder()
    {
        $listid = $_REQUEST['listid'];
        $listingid = $_REQUEST['currentlisting'];
        $samplemodel = Samplelisting::model()->findByPk($listid);
        //$count = count ( $samplemodel );       
        $currentremindersent = $samplemodel->user_default_sample_listing_feedback_sent;
        //$listingid = $samplemodel->user_default_listing_id;
        $listingdate = date('d/m/Y',strtotime($samplemodel->user_default_sample_listing_date));
        if($samplemodel->user_default_sample_listing_status == "0")
        {
            $lstatus="Waiting for publication";
        }
        else if($samplemodel->user_default_sample_listing_status == "1")
        {
            $lstatus="Published";
        }
        else if($samplemodel->user_default_sample_listing_status == "2")
        {
            $lstatus="Suspended";
        }
        $increment = "1";

        if($listid!="" && $currentremindersent < 3)
        {
            $newreminder = $currentremindersent + $increment;

            $samplemodel->user_default_sample_listing_feedback_sent = $newreminder;

            $samplemodel->save();

            $model = Userlisting::model()->findByPk($listingid);

            //$fetchusers = Sampleorder::model()->findAll("user_default_sample_listing_id ='" . $listid . "'");

            $criteria = new CDbCriteria;

            $criteria->select = "t.*";

            //$criteria->join ='LEFT JOIN {{sample_listing_feedbacks}} AS feedback ON feedback.user_default_profiles_id = t.user_default_profiles_id';

            //$criteria->condition = "t.user_default_sample_listing_id=:user_id and feedback.user_default_sample_listing_id!=:user_id";

            $criteria->condition = "t.user_default_sample_listing_id=:user_id";

            $criteria->params = array(':user_id'=>$listid);

            $criteria->group = "t.user_default_profiles_id";

            //print_r($criteria);

            $fetchusers = Sampleorder::model()->findAll($criteria);

            foreach($fetchusers as $user)
            {

                $cuser = $user->user_default_profiles_id;

                $checkentry = Samplefeedback::model()->find("user_default_sample_listing_id ='" . $listid . "' and user_default_profiles_id = '".$cuser."'");

                $count = count ( $checkentry );

                if($count == "0")

                {

                    $model_user = User::model()->find("user_default_id='".$cuser."'");

                    $to = $model_user['user_default_email'];

                    $listinglink = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing/view?id=".$model->user_default_listing_id.'&feedback=true" target="_blank" style="color:#808080">here >> </a>';

                    $string = array(
                        '{{#LISTINGTITLE#}}'=>ucwords($model->user_default_listing_title),
                        '{{#USERNAME#}}'=>ucwords($model_user['user_default_first_name'] .' '. $model_user['user_default_surname']),
                        '{{#LISTINGDATE#}}'=>ucwords($listingdate),
                        '{{#LISTINGSTATUS#}}'=>ucwords($lstatus),
                        '{{#LISTINGLINK#}}'=>ucwords($listinglink)
                    );

                    $template =  MailTemplate::getTemplate('sample_reminder');

                    $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

                    $subject = SharedFunctions::app()->mailStringReplace($template->template_subject,$string);

                    $result =  SharedFunctions::app()->sendmail($to,$subject,$body);

                }

            }


        }

        $this->redirect($this->createUrl('/sample/sample_listing/listid/' . $listingid));


    }


}
