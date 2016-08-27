<?php

class ListingsController extends Controller
{
    public $uploadytube;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array(),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index,update,create,delete,listingytd,rdelete,publish,rejection,suspension,restore,downloadvideo,marketingdata,portfolio,samples,forum,exportDefaultListings,sampleview,uploadyoutube,Videopath,newlistings,samplescsv,sampledelete'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'newlistings'),
                'users' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate()
    {
        $model = new Listings;

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Listings'])) {
            $model->attributes = $_POST['Listings'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
                $this->redirect(array('view', 'id' => $model->user_default_listing_id));
            }
        }

        $this->render('create', array('model' => $model,));
    }

    public function actionListingytd(){
        if(!empty($_REQUEST['username']) || !empty($_REQUEST['user_default_listing_title']) || !empty($_REQUEST['user_default_listing_category_id']) || !empty($_REQUEST['user_default_listing_lookingfor_id']) ||
                    !empty($_REQUEST['user_default_listing_limit_viewing_id']) || !empty($_REQUEST['Keyword']))
        {
            $model = new Listings('search');
            $criteria = new CDbCriteria;
            $criteria->compare('user_default_listing_submission_status', 0, true);
            if (isset($_REQUEST['username']) && $_REQUEST['username'] != "") {
                $Data = User::model()->findAll("LOWER(user_default_username) like '%" . addslashes(strtolower($_REQUEST['username'])) . "%'");
                if ($Data) {
                    foreach ($Data as $rsData) {
                        $ids[] = $rsData->user_default_id;
                    }
                    //$ids1 = array(rtrim($ids,','));
                    $criteria->addInCondition('user_default_profiles_id', $ids);
                }
            }
            if (isset($_REQUEST['user_default_listing_category_id']) && $_REQUEST['user_default_listing_category_id'] != "") {
                $criteria->compare('user_default_listing_category_id', addslashes($_REQUEST['user_default_listing_category_id']), true);
            }
            if (isset($_REQUEST['user_default_listing_lookingfor_id']) && $_REQUEST['user_default_listing_lookingfor_id'] != "") {
                $criteria->compare('user_default_listing_lookingfor_id', addslashes($_REQUEST['user_default_listing_lookingfor_id']), true);
            }
            if (isset($_REQUEST['user_default_listing_limit_viewing_id']) && $_REQUEST['user_default_listing_limit_viewing_id'] != "") {
                $criteria->compare('user_default_listing_limit_viewing_id', addslashes($_REQUEST['user_default_listing_limit_viewing_id']), true);
            }
            if (isset($_REQUEST['user_default_listing_title']) && $_REQUEST['user_default_listing_title'] != "") {
                $criteria->compare('user_default_listing_title', addslashes($_REQUEST['user_default_listing_title']), true);
            }
            if (isset($_REQUEST['Keyword']) && $_REQUEST['Keyword'] != "") {
                $criteria->compare('user_default_listing_keywords', addslashes($_REQUEST['Keyword']), true);
            }

            $criteria->order = 'user_default_listing_id desc';
            $posts = Listings::model()->findAll($criteria);

            $this->render("listingytd",array(
                'model' => $model,
                'list' => $posts,
                'pages' => $pages,
                'item_count' => $total,
                'page_size' => Yii::app()->params['listPerPage']
            ));
        }else{
            $model = new Listings('search');
            $criteria = new CDbCriteria;
            $criteria->order = 'user_default_listing_id desc';
            $posts = Listings::model()->findAll($criteria);

            $this->render("listingytd",array(
                'model' => $model,
                'list' => $posts,
                'pages' => $pages,
                'item_count' => $total,
                'page_size' => Yii::app()->params['listPerPage']
            )); 
        }
    }

    public function actionNewlistings(){

        if(!empty($_REQUEST['username']) || !empty($_REQUEST['user_default_listing_title']) || !empty($_REQUEST['user_default_listing_category_id']) || !empty($_REQUEST['user_default_listing_lookingfor_id']) ||
                    !empty($_REQUEST['user_default_listing_limit_viewing_id']) || !empty($_REQUEST['Keyword']))
        {
        $model = new Listings('search');
        $criteria = new CDbCriteria;
        $criteria->compare('user_default_listing_submission_status', 0, true);
        if (isset($_REQUEST['username']) && $_REQUEST['username'] != "") {
            $Data = User::model()->findAll("LOWER(user_default_username) like '%" . addslashes(strtolower($_REQUEST['username'])) . "%'");
            if ($Data) {
                foreach ($Data as $rsData) {
                    $ids[] = $rsData->user_default_id;
                }
                //$ids1 = array(rtrim($ids,','));
                $criteria->addInCondition('user_default_profiles_id', $ids);
            }
        }
        if (isset($_REQUEST['user_default_listing_category_id']) && $_REQUEST['user_default_listing_category_id'] != "") {
            $criteria->compare('user_default_listing_category_id', addslashes($_REQUEST['user_default_listing_category_id']), true);
        }
        if (isset($_REQUEST['user_default_listing_lookingfor_id']) && $_REQUEST['user_default_listing_lookingfor_id'] != "") {
            $criteria->compare('user_default_listing_lookingfor_id', addslashes($_REQUEST['user_default_listing_lookingfor_id']), true);
        }
        if (isset($_REQUEST['user_default_listing_limit_viewing_id']) && $_REQUEST['user_default_listing_limit_viewing_id'] != "") {
            $criteria->compare('user_default_listing_limit_viewing_id', addslashes($_REQUEST['user_default_listing_limit_viewing_id']), true);
        }
        if (isset($_REQUEST['user_default_listing_title']) && $_REQUEST['user_default_listing_title'] != "") {
            $criteria->compare('user_default_listing_title', addslashes($_REQUEST['user_default_listing_title']), true);
        }
        if (isset($_REQUEST['Keyword']) && $_REQUEST['Keyword'] != "") {
            $criteria->compare('user_default_listing_keywords', addslashes($_REQUEST['Keyword']), true);
        }

        $criteria->order = 'user_default_listing_id desc';
        // print_r($criteria);


        $total = Listings::model()->count($criteria);

        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 5;
        }

        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!

        $posts = Listings::model()->findAll($criteria);
        $this->render('newlistings', array(
            'model' => $model,
            'list' => $posts,
            'pages' => $pages,
            'item_count' => $total,
            'page_size' => Yii::app()->params['listPerPage']
        ));
        }else{
            /*$this->render('index', array('model' => $model,
                'list' => $posts,
                'pages' => $pages,
                'item_count' => $total,
                'page_size' => Yii::app()->params['listPerPage']
            ));*/


            //$arr["user_default_listing_submission_status"]=1;
            /*if($_POST){
                if($_POST["username"]){
                    $user_details = User::model()->findAllByAttributes(array("user_default_id" => $_POST["username"]));
                    print_r($user_details);
                }
                //$arr["user_default_listing_category_id"]=
                print_r($_POST);
            }*/
            $criteria = new CDbCriteria;
            $criteria->compare('user_default_listing_submission_status', 0, true);
            $criteria->order = 'user_default_listing_id desc';
            $model = Listings::model()->findAll($criteria);
            $total = Listings::model()->count($criteria);
            if (isset($_REQUEST['rows'])) {
                $count = $_REQUEST['rows'];
            } else {
                $count = 5;
            }
            $pages = new CPagination($total);
            $pages->setPageSize($count);
            $pages->applyLimit($criteria);  // the trick is here!

            $posts = Listings::model()->findAll($criteria);
            $this->render('newlistings', array(
                'model' => $model,
                'list' => $posts,
                'pages' => $pages,
                'item_count' => $total,
                'page_size' => Yii::app()->params['listPerPage']
            ));
        }
    }

      public function actionVideopath($id,$uid){

                     //  ob_clean();
                    @ini_set('error_reporting', E_ALL & ~ E_NOTICE);
                   // @apache_setenv('no-gzip', 1);
                    //@ini_set('zlib.output_compression', 'Off');
                    
                    /*$model =  Listings::model()->findByPk($uid);
                    echo $uid;
                        print_r($model);
                    die();*/
                    $id=base64_decode($id);
                    //$file = Yii::app()->getBaseUrl(true)."/".$id; // The media file's location
                    
                    $user_details = User::model()->findAllByAttributes(array("user_default_id" => $uid));//$model->user_default_profiles_id));

                    $userid = $uid;//$model->user_default_profiles_id;
                    $username = $user_details[0]['user_default_username'];
                     $upath = $username."_".$userid;
                   // echo $file = $_SERVER['DOCUMENT_ROOT'].'/upload/users/'.$upath."/videos/".$id;
                     $file =   $_SERVER['DOCUMENT_ROOT'].'/upload/users/'.$upath.'/videos/'.$id;

                    //print_r($file);
                        // Read the file
                    echo base64_encode(@file_get_contents($file));
                     
                        // and flush the buffer
                       
                    
            // $file= fopen("http://webriderz.com/jag/www/upload/users/jag_88/videos/dsfdsfdsfds81_jag..mp4","r");

            //  echo $file;
              die();
     }


    public function actionUpdate($id)
    {


        $this->uploadytube = new uploadyoutube;
        $url = $this->uploadytube->getRedirect();
        //print_r($this->uploadytube);
        $model = $this->loadModel($id);
        if (isset($_POST['Listings'])) {
            $data = $_REQUEST['drg_fprojections1'] . "," . $_REQUEST['drg_fprojections2'] . "," . $_REQUEST['drg_fprojections3'] . "," . $_REQUEST['drg_fprojections4'] . "," . $_REQUEST['drg_fprojections5'] . "," . $_REQUEST['drg_fprojections6'];
            $model->user_default_listing_financial_table_status = $_REQUEST['user_default_listing_financial_table_status'];
            $model->user_default_listing_table_currency_code = $_REQUEST['user_default_listing_table_currency_code'];
            $model->user_default_listing_notification_frequency = $_REQUEST['user_default_listing_notification_frequency'];
            $model->user_default_listing_fprojections = $data;
            $model->attributes = $_POST['Listings'];

            $address = Userlistingmarketing::model()->find("user_default_listing_id = '" . $id . "' ");

            if ($address == NULL) {
                $address = new Userlistingmarketing;

                $address->user_default_listing_marketing_question_submission_date = date('Y-m-d');

                $address->user_default_listing_id = $id;
            }

            $address->user_default_listing_marketing_question = $_POST['Userlistingmarketing']['user_default_listing_marketing_question'];

            $address->save();

            if ($id != "") {

                Userlistingimages::model()->deleteAll("user_default_listing_id  ='" . $id . "'");

            }

            $i = 0;

            for ($i = 0; $i < 6; $i++) {

                if ($_POST['img_name'][$i] != "") {

                    $Userlistingimages = new Userlistingimages;

                    $Userlistingimages->user_default_listing_image = $_POST['img_name'][$i];

                    $Userlistingimages->user_default_listing_image_text = $_POST['user_default_listing_image_text'][$i];

                    $Userlistingimages->user_default_listing_image_link1 = $_POST['user_default_listing_image_link1'][$i];

                    $Userlistingimages->user_default_listing_image_link2 = $_POST['user_default_listing_image_link2'][$i];

                    $Userlistingimages->user_default_listing_id = $id;

                    $Userlistingimages->save();

                }

            }

            $user_details = User::model()->findAllByAttributes(array("user_default_id" => $model->user_default_profiles_id));

            $userid = $model->user_default_profiles_id;

            $username = $user_details[0]['user_default_username'];

            $upath = $username . "_" . $userid;

            $path = $_SERVER['DOCUMENT_ROOT'] . '/';

            $j = 0;

            for ($j = 0; $j < 3; $j++) {

                if ($_POST['drg_video'][$j] != "") {

                    $oldvid = $_POST['drg_oldvideo'][$j];

                    $cvidpath1 = $path . "upload/users/" . $upath . "/videos/" . $oldvid;

                    unlink($cvidpath1);

                    Userlistingvideos::model()->deleteAll("user_default_listing_video_link ='" . $oldvid . "'");

                    $Userlistingvideos = new Userlistingvideos;

                    $Userlistingvideos->user_default_listing_video_link = $_POST['drg_video'][$j];

                    $Userlistingvideos->user_default_listing_video_type = "1";

                    $Userlistingvideos->user_default_listing_id = $id;

                    $Userlistingvideos->save();

                }

            }


            if ($model->save()) {

                if ($_POST['update']) {


                    $to = $user_details[0]['user_default_email'];
                    $subject = "User listing update notification";
                    $controller = Yii::app()->controller->action->id;

                    $yii_user_request_id1 = Yii::app()->getBaseUrl(true) . "/" . "listing" . "/" . "fupdate" . "/listid/" . $model->user_default_listing_id;
                    $yii_user_request_id = '<a href="' . Yii::app()->getBaseUrl(true) . "/" . "listing" . "/" . "fupdate" . "/listid/" . $model->user_default_listing_id . '" target="_blank" >here >> </a>';


                    $template = MailTemplate::getTemplate('Listing_update');
                    $subjectcc = $model['user_default_listing_title'] . " update notification";
                    $sitelink = '<a href="' . Yii::app()->getBaseUrl(true) . '" target="_blank" >here >> </a>';
                    $adminmsg = "<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>" . $_POST['changes'] . "</p>";
                    $contactlink = '<a href="' . Yii::app()->getBaseUrl(true) . '/contact" target="_blank" >listing support team</a>';

                    $string = array(
                        '{{#LISTINGTITLE#}}' => ucwords($model['user_default_listing_title']),
                        '{{#USERNAME#}}' => ucwords($user_details[0]['user_default_first_name'] . ' ' . $user_details[0]['user_default_surname']),
                        '{{#MESSAGE#}}' => ucwords($adminmsg), '{{#LSLINK#}}' => $contactlink,
                        '{{#LISTINGLINK#}}' => ucwords($yii_user_request_id)
                    );

                    $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

                    $result = SharedFunctions::app()->sendmail($to, $subjectcc, $body);


                }
                Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
                $this->redirect(array('index'));
            }
        }
        

        $this->render('update', array(
            'model' => $model,
            'urlGetToken'=>$url
        ));
    }


   
    public function loadModel($id)
    {
       // echo "check";
        $model = Listings::model()->findByPk($id);
        //print_r($model);die();
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
    public function actionIndex()
    {
        if(!empty($_REQUEST['username']) || !empty($_REQUEST['user_default_listing_title']) || !empty($_REQUEST['user_default_listing_category_id']) || !empty($_REQUEST['user_default_listing_lookingfor_id']) ||
                    !empty($_REQUEST['user_default_listing_limit_viewing_id']) || !empty($_REQUEST['Keyword']))
        {
        $model = new Listings('search');
        $criteria = new CDbCriteria;

        if (isset($_REQUEST['username']) && $_REQUEST['username'] != "") {

            $Data = User::model()->findAll("LOWER(user_default_username) like '%" . addslashes(strtolower($_REQUEST['username'])) . "%'");

            if ($Data) {

                foreach ($Data as $rsData) {

                    $ids[] = $rsData->user_default_id;

                }
                //$ids1 = array(rtrim($ids,','));
                $criteria->addInCondition('user_default_profiles_id', $ids);
            }
        }
        if (isset($_REQUEST['user_default_listing_category_id']) && $_REQUEST['user_default_listing_category_id'] != "") {

            $criteria->compare('user_default_listing_category_id', addslashes($_REQUEST['user_default_listing_category_id']), true);
        }

        if (isset($_REQUEST['user_default_listing_lookingfor_id']) && $_REQUEST['user_default_listing_lookingfor_id'] != "") {

            $criteria->compare('user_default_listing_lookingfor_id', addslashes($_REQUEST['user_default_listing_lookingfor_id']), true);
        }


        if (isset($_REQUEST['user_default_listing_limit_viewing_id']) && $_REQUEST['user_default_listing_limit_viewing_id'] != "") {

            $criteria->compare('user_default_listing_limit_viewing_id', addslashes($_REQUEST['user_default_listing_limit_viewing_id']), true);
        }


        if (isset($_REQUEST['user_default_listing_title']) && $_REQUEST['user_default_listing_title'] != "") {
            $criteria->compare('user_default_listing_title', addslashes($_REQUEST['user_default_listing_title']), true);

        }


        if (isset($_REQUEST['Keyword']) && $_REQUEST['Keyword'] != "") {
            $criteria->compare('user_default_listing_keywords', addslashes($_REQUEST['Keyword']), true);

        }

        $criteria->order = 'user_default_listing_id desc';
        // print_r($criteria);


        $total = Listings::model()->count($criteria);

        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 5;
        }

        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria);  // the trick is here!

        $posts = Listings::model()->findAll($criteria);

        $this->render('index', array('model' => $model,
            'list' => $posts,
            'pages' => $pages,
            'item_count' => $total,
            'page_size' => Yii::app()->params['listPerPage']
        ));
        }elseif(!empty($_REQUEST['btnsubmit'])) {
            $model = new Listings();

            $total = Listings::model()->count($criteria);

            if (isset($_REQUEST['rows'])) {
                $count = $_REQUEST['rows'];
            } else {
                $count = 5;
            }

            $pages = new CPagination($total);
            $pages->setPageSize($count);
            $pages->applyLimit($criteria);  // the trick is here!

            $posts = Listings::model()->findAll($criteria);
            $this->render('index', array('model' => $model,
                'list' => $posts,
                'pages' => $pages,
                'item_count' => $total,
                'page_size' => Yii::app()->params['listPerPage']
            ));
        }else {

            $model = new Listings();
            $posts = array();
            $this->render('index', array('model'=>$model,'list'=>$posts));
        }

    }

    public function actionDelete($id)
    {

        Userlistingimages::model()->deleteAll("user_default_listing_id  ='" . $id . "'");

        Userlistingvideos::model()->deleteAll("user_default_listing_id ='" . $id . "'");

        Interactions::model()->deleteAll("user_default_listing_id ='" . $id . "'");

        Banner::model()->deleteAll("user_default_listing_id ='" . $id . "'");

        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionRdelete($id)
    {
        $model = $this->loadModel($id);


        if (isset($model)) {
            $model->user_default_listing_submission_status = 0;
            //$model->drg_deletedate = date('Y-m-d H:i:s');
            if ($model->save()) {

                if ($_POST['delete']) {

                    $user_details = User::model()->findAllByAttributes(array("user_default_id" => $model->user_default_profiles_id));

                    $yii_user_request_id = '<a href="' . Yii::app()->getBaseUrl(true) . "/" . "listing" . "/" . "rdelete" . "/listid/" . $model->user_default_listing_id . '" target="_blank" >here >> </a>';

                    $to = $user_details[0]['user_default_email'];
                    $subject = "User listing deletion notification";

                    $template = MailTemplate::getTemplate('Listing_mark_delete');
                    $subjectcc = "Listing " . $model['user_default_listing_title'] . " has been marked for deletion ";
                    $adminmsg = "<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>" . $_POST['deletionval'] . "</p>";
                    $sitelink = '<a href="' . Yii::app()->getBaseUrl(true) . "/page/faq" . '" target="_blank" >here >> </a>';
                    $contactlink = '<a href="' . Yii::app()->getBaseUrl(true) . '/contact" target="_blank" >customer listing support team</a>';
                    $string = array(
                        '{{#LISTINGTITLE#}}' => ucwords($model['user_default_listing_title']),
                        '{{#USERNAME#}}' => ucwords($user_details[0]['user_default_first_name'] . ' ' . $user_details[0]['user_default_surname']),
                        '{{#MESSAGE#}}' => ucwords($adminmsg), '{{#CSLINK#}}' => $contactlink,
                        '{{#LISTINGLINK#}}' => ucwords($yii_user_request_id),
                        '{{#SITELINK#}}' => ucwords($sitelink),
                    );

                    $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

                    $result = SharedFunctions::app()->sendmail($to, $subjectcc, $body);


                }
                $this->redirect(array('index'));
                //$this->render('update',array('model'=>$model,));
            } else {
                $this->render('update', array('model' => $model,));
            }

        }


    }

    public function actionPublish($id)
    {
        $model = $this->loadModel($id);
        $user_details = User::model()->findAllByAttributes(array("user_default_id" => $model->user_default_profiles_id));
        $to = $user_details[0]['user_default_email'];

        $controller = Yii::app()->controller->action->id;
        $status = "Published";
        $yii_user_request_id = '<a href="' . Yii::app()->getBaseUrl(true) . "/" . "listing" . "/" . "view?id=" . $model->user_default_listing_id . '" target="_blank" >here >> </a>';

        $template = MailTemplate::getTemplate('user_listing_publish');

        $sitelink = '<a href="' . Yii::app()->getBaseUrl(true) . '" target="_blank" >here >> </a>';
        $llink = '<a href="' . Yii::app()->getBaseUrl(true) . "/" . "listing" . "/" . "selectlisting" . "/" . "listid" . "/" . $model->user_default_listing_id . '" target="_blank" >here >> </a>';
        $ltitle = "<i>" . $model['user_default_listing_title'] . "</i>";
        $ldate = "<i>" . $model['user_default_listing_date'] . "</i>";
        $lstatus = "<i>" . $status . "</i>";

        $string = array(
            '{{#LISTINGTITLE#}}' => ucwords($ltitle),
            '{{#USERNAME#}}' => ucwords($user_details[0]['user_default_first_name'] . ' ' . $user_details[0]['user_default_surname']),
            '{{#LISTINGDATE#}}' => ucwords($ldate),
            '{{#LISTINGSTATUS#}}' => ucwords($lstatus),
            '{{#LISTINGLINK#}}' => ucwords($yii_user_request_id),
            '{{#SITELINK#}}' => ucwords($sitelink),
            '{{#LLINK#}}' => ucwords($llink)
        );

        $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

        $result = SharedFunctions::app()->sendmail($to, $template->template_subject, $body);


        if (isset($model)) {
            $model->user_default_listing_submission_status = 1;
            $model->user_default_listing_approvedate = date('Y-m-d');
            /*
             $attribs = array('user_default_listing_id'=>$model->user_default_listing_id);
            $criteria = new CDbCriteria(array('order'=>'iuser_default_listing_video_id ASC'));
            $vids = Userlistingvideos::model()->findAllByAttributes($attribs, $criteria);
            foreach ($vids as $videos)
            {

            $cvid1=$videos->drg_listing_video;
            $tvid1=str_replace('flv','mp4',$cvid1);
            $path =  $_SERVER['DOCUMENT_ROOT'].'/';
            $temp_dir=$path."temp/";
            $tvidpath1=$path."temp/".$tvid1;
            unlink($tvidpath1);
            }
            */

            if ($model->save()) {
                $this->render('update', array('model' => $model,));
            } else {
                $this->render('update', array('model' => $model,));
            }
        }
        $this->redirect(array('index'));


    }

    public function actionRejection($id)
    {
        $model = $this->loadModel($id);


        if ($_POST['rejection']) {
            $user_details = User::model()->findAllByAttributes(array("user_default_id" => $model->user_default_profiles_id));
            $to = $user_details[0]['user_default_email'];
            $subject = "User listing rejection notification";
            $controller = Yii::app()->controller->action->id;
            $yii_user_request_id = Yii::app()->getBaseUrl(true) . "/" . "listing" . "/" . "rejection" . "/listid/" . $model->user_default_listing_id;

            $template = MailTemplate::getTemplate('Listing_rejection');
            $subjectcc = $model['user_default_listing_title'] . " rejection notification";
            $sitelink = '<a href="' . Yii::app()->getBaseUrl(true) . '" target="_blank" >here >> </a>';
            $rmessage = "<p style='background: #C2C3C4;color:#ED7932;border: 1px dashed #000;min-height: 90px;padding: 6px;'>" . $_POST['rejectval'] . "</p>";

            $string = array(
                '{{#LISTINGTITLE#}}' => ucwords($model['user_default_listing_title']),
                '{{#USERNAME#}}' => ucwords($user_details[0]['user_default_first_name'] . ' ' . $user_details[0]['user_default_surname']),
                '{{#MESSAGE#}}' => ucwords($rmessage),
                '{{#SITELINK#}}' => ucwords($sitelink)
            );

            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

            $result = SharedFunctions::app()->sendmail($to, $subjectcc, $body);
        }
        if (isset($model)) {
            $model->user_default_listing_submission_status = 2;

            if ($model->save()) {
                $this->render('update', array('model' => $model,));
            } else {
                $this->render('update', array('model' => $model,));
            }
        }
    }

    public function actionSuspension($id)
    {

        $model = $this->loadModel($id);

        if ($_POST['suspension']) {

            $user_details = User::model()->findAllByAttributes(array("user_default_id" => $model->user_default_profiles_id));
            $to = $user_details[0]['user_default_email'];

            $controller = Yii::app()->controller->action->id;
            $yii_user_request_id = '<a href="' . Yii::app()->getBaseUrl(true) . "/" . "listing" . "/" . "suspensed" . "/listid/" . $model->user_default_listing_id . '" target="_blank" >here >> </a>';

            $template = MailTemplate::getTemplate('Listing_suspension');

            $adminmsg = $_POST['suspensionval'];

            $string = array(
                '{{#LISTINGTITLE#}}' => ucwords($data['user_default_listing_title']),
                '{{#USERNAME#}}' => ucwords($user_details[0]['user_default_first_name'] . ' ' . $user_details[0]['user_default_surname']),
                '{{#MESSAGE#}}' => ucwords($adminmsg),
                '{{#LISTINGLINK#}}' => ucwords($yii_user_request_id)
            );
            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
            $result = SharedFunctions::app()->sendmail($to, $template->template_subject, $body);

        }

        if (isset($model)) {
            $model->user_default_listing_submission_status = 0;
            $model->user_default_listing_approvedate = date('Y-m-d');
            if ($model->save()) {
                $this->render('update', array('model' => $model,));
            } else {
                $this->render('update', array('model' => $model,));
            }
        }

    }

    public function actionRestore($id)
    {
        $model = $this->loadModel($id);
        if (isset($model)) {
            $model->user_default_listing_submission_status = 4;
            if ($model->save()) {
                $user_details = User::model()->findAllByAttributes(array("user_default_id" => $model->user_default_profiles_id));
                $to = $user_details[0]['user_default_email'];
                $controller = Yii::app()->controller->action->id;
                $site = Yii::app()->getBaseUrl(true);
                $sitelink = '<a href="' . Yii::app()->getBaseUrl(true) . '" target="_blank" >' . $site . '</a>';
                $template = MailTemplate::getTemplate('Listing_restore');
                $subjectcc = " Listing " . $model->user_default_listing_title . " has been restored";
                $string = array('{{#LISTINGTITLE#}}' => ucwords($model->user_default_listing_title), '{{#USERNAME#}}' => ucwords($user_details[0]['user_default_first_name'] . ' ' . $user_details[0]['user_default_surname']), '{{#SITELINK#}}' => ucwords($sitelink));
                $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
                $result = SharedFunctions::app()->sendmail($to, $subjectcc, $body);
                //$this->render('update',array('model'=>$model,));
            } else {
                $this->render('update', array('model' => $model,));
            }
            $this->redirect(array('index'));
        }
    }

    public function userToString()
    {
        $targets = $this->drg_user;


        if ($targets) {
            $string = '';
            foreach ($targets as $target) {
                $string .= $targets->user_default_first_name . ', ';
            }
            return substr($string, 0, strlen($string) - 1);
        }
        return null;
    }

    public function actionDownloadvideo()
    {

        $filename = Yii::app()->request->getParam('file');


        $fileData = Userlistingvideos::model()->find("user_default_listing_video_link = '" . $filename . "'");


        $ListingData = Listings::model()->find("user_default_listing_id= '" . $fileData->user_default_listing_id . "'");

        $userData = User::model()->find("user_default_id = '" . $ListingData->user_default_profiles_id . "'");


        /*  echo Yii::getPathOfAlias('webroot.upload.users.'.$userData->drg_username.'_'.$userData->drg_id).'/videos/'.$filename;
          die; */

        @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.users.' . $userData->user_default_username . '_' . $userData->user_default_id) . '/videos/' . $filename);
        return;
    }

    public function actionPortfolio()
    {
        $this->render('portfolio');
    }

    public function actionMarketingdata()
    {
        $this->render('marketing_data');
    }

    public function actionSamples()
    {

        if(isset($_REQUEST['username']) || isset($_REQUEST['date']) || isset($_REQUEST['details']) || isset($_REQUEST['email']) ||  isset($_REQUEST['amount']))
        {
            $model = new Listings('search');
            $criteria = new CDbCriteria;

            if (isset($_REQUEST['username']) && $_REQUEST['username'] != "") {

                $userdata = User::model()->find("LOWER(user_default_username) = '" . addslashes(strtolower($_REQUEST['username'])) . "'");

                $Data = Listings::model()->findAll("user_default_profiles_id = '" . addslashes(strtolower($userdata->user_default_id)) . "'");
                if ($Data) {

                    foreach ($Data as $rsData) {

                        $ids[] = $rsData->user_default_listing_id;

                    }
                    //$ids1 = array(rtrim($ids,','));
                    $criteria->addInCondition('user_default_listing_id', $ids);
                }
            }

            if (isset($_REQUEST['email']) && $_REQUEST['email'] != "") {


                $userdata = User::model()->find("LOWER(user_default_email) = '" . addslashes(strtolower($_REQUEST['email'])) . "'");

                $Data = Listings::model()->findAll("user_default_profiles_id = '" . addslashes(strtolower($userdata->user_default_id)) . "'");
                if ($Data) {

                    foreach ($Data as $rsData) {

                        $ids[] = $rsData->user_default_listing_id;

                    }
                    //$ids1 = array(rtrim($ids,','));
                    $criteria->addInCondition('user_default_listing_id', $ids);
                }
            }


            if (isset($_REQUEST['date']) && $_REQUEST['date'] != "") {
                $date = date('Y-m-d',strtotime($_REQUEST['date']));
                $criteria->compare('user_default_sample_listing_date', addslashes($date), true);
            }



            if (isset($_REQUEST['details']) && $_REQUEST['details'] != "") {

                $criteria->compare('user_default_sample_listing_details', addslashes($_REQUEST['details']), true);
            }


            if (isset($_REQUEST['amount']) && $_REQUEST['amount'] != "") {

                $criteria->compare('user_default_sample_listing_cost', addslashes($_REQUEST['amount']), true);
            }




            $criteria->order = 'user_default_sample_listing_id desc';
            //print_r($criteria);


            $total = Samplelisting::model()->count($criteria);

            if (isset($_REQUEST['rows'])) {
                $count = $_REQUEST['rows'];
            } else {
                $count = 5;
            }

            $pages = new CPagination($total);
            $pages->setPageSize($count);
            $pages->applyLimit($criteria);  // the trick is here!

            $posts = Samplelisting::model()->findAll($criteria);

            $this->render('samples', array('model' => $model,
                'list' => $posts,
                'pages' => $pages,
                'item_count' => $total,
                'page_size' => Yii::app()->params['listPerPage']
            ));
        }elseif(!empty($_REQUEST['btnsubmit'])) {
            $model = new Samplelisting();

            $total = Samplelisting::model()->count($criteria);

            if (isset($_REQUEST['rows'])) {
                $count = $_REQUEST['rows'];
            } else {
                $count = 5;
            }

            $pages = new CPagination($total);
            $pages->setPageSize($count);
            $pages->applyLimit($criteria);  // the trick is here!

            $posts = Samplelisting::model()->findAll($criteria);
            $this->render('samples', array('model' => $model,
                'list' => $posts,
                'pages' => $pages,
                'item_count' => $total,
                'page_size' => Yii::app()->params['listPerPage']
            ));
        }else {

            $posts = Samplelisting::model()->findAll();
            $this->render('samples', array('model'=>$model,'list'=>$posts));
        }




        //$this->render('samples');
    }

    public function actionSamplescsv()
    {
        $model = Samplelisting::model()->findAll();
        $filename = "samples.csv";
        header('Content-type: text/csv');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        $i=1;
        echo "Sr no.,User,Date,Listing Title,Details,Email,Amount\n";
        foreach($model as $row)
        {
            $listing_id = $row->user_default_listing_id;
            $listing = Listings::model()->findByPk($listing_id);
            $userid = $listing->user_default_profiles_id;
            $userdata = User::model()->findByPk($userid);

            if($row->user_default_sample_listing_currency == "1")
            {
                $currency = "$";
            }
            if($row->user_default_sample_listing_currency == "2")
            {
                $currency = "&pound;";
            }
            if($row->user_default_sample_listing_currency == "3")
            {
                $currency = "&euro;";
            }

            $title= html_entity_decode(str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n","<br>","<br/>","</br>",",")," ",$listing->user_default_listing_title));
            $details= html_entity_decode(str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n","<br>","<br/>","</br>",",")," ",$row->user_default_sample_listing_details));
            $cc = $currency.$row->user_default_sample_listing_cost;
            $cost =  html_entity_decode(str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n","<br>","<br/>","</br>",",")," ",$cc));
            $date = $row->user_default_sample_listing_date;
            $newdate = date('d M Y', strtotime($date));


            echo $i.','.$userdata->user_default_username.','.$newdate.','.$title.','.$details.','.$userdata->user_default_email.','.$cost."\n";


        }
    }


    public function actionSampledelete($id)
    {

        $model = Samplelisting::model()->find("user_default_sample_listing_id = '" . $id . "'");

        $listingid = $model->user_default_listing_id;

        Samplelistingimages::model()->deleteAll("user_default_listing_lid  ='" . $listingid . "'");

        Samplefeedback::model()->deleteAll("user_default_sample_listing_id ='" . $id . "'");

        Sampleorder::model()->deleteAll("user_default_sample_listing_id ='" . $id . "'");

        $model->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('samples'));
    }

    public function actionForum()
    {
        $listingModel = new Listings();
        $listingModel= Listings::model()->findByPk($_REQUEST['id']);

        $this->render('forum',array('model'=>$listingModel));
    }

    public function actionexportDefaultListings()
    {
        $fp = fopen('php://output', 'w');

        /*
         * Write a header of csv file
         */
        $headers = array(
            '',
            'Consumers',
            'Business Owners',
            'Business Users',
            'Entrepreneurs',
            'Other',
            'Total',
        );

        $row = array();
        foreach ($headers as $header) {
            $row[] = $header;
        }

        /*
         * save as csv content
         */
        $filename = 'DefaultUserListings.csv';
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        fputcsv($fp, $row);

       /*
      * Write the data of csv file
      */

        /*
        * Write the data of csv file
        */
        $totalConsumers = 0;
        $totalBusinessOwners = 0;
        $totalBusinessUsers = 0;
        $totalEntrepreneurs = 0;
        $totalOther = 0;
        $totalAll = 0;
        $totalToDates = 0;
        $totalUsersCountOnline = 0;

        $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Num', '12' => 'Dec');
        foreach ($months as $index => $month) {

            $totalProfessions = 0;
            $row = array($month);
            foreach ($headers as $head) {

                if ($head == 'Consumers') {
                    $professionId = 2;
                    $month = $index;
                    $professionUsersListingsCount = Listings::getProfessionUserListingCount($professionId, $month);
                    $totalProfessions += $professionUsersListingsCount;
                    $totalConsumers += $professionUsersListingsCount;

                    $row[] = $professionUsersListingsCount ? $professionUsersListingsCount : '';

                } else if ($head == 'Business Owners') {
                    $professionId = 1;
                    $month = $index;
                    $professionUsersListingsCount = Listings::getProfessionUserListingCount($professionId, $month);
                    $totalProfessions += $professionUsersListingsCount;
                    $totalBusinessOwners += $professionUsersListingsCount;

                    $row[] = $professionUsersListingsCount ? $professionUsersListingsCount : '';

                } else if ($head == 'Business Users') {
                    $row[] = '';
                } else if ($head == 'Entrepreneurs') {
                    $professionId = 3;
                    $month = $index;
                    $professionUsersListingsCount = Listings::getProfessionUserListingCount($professionId, $month);
                    $totalProfessions += $professionUsersListingsCount;
                    $totalBusinessUsers += $professionUsersListingsCount;

                    $row[] = $professionUsersListingsCount ? $professionUsersListingsCount : '';
                } else if ($head == 'Other') {
                    $professionId = 5;
                    $month = $index;
                    $professionUsersListingsCount = Listings::getProfessionUserListingCount($professionId, $month);
                    $totalProfessions += $professionUsersListingsCount;
                    $totalOther += $professionUsersListingsCount;

                    $row[] = $professionUsersListingsCount ? $professionUsersListingsCount : '';
                } else if ($head == 'Total') {
                    $totalAll += $totalProfessions;
                    $row[] = $totalProfessions ? $totalProfessions : '';
                }
            }
            fputcsv($fp, $row);

            unset($row);
        }


        $row = array('Totals');
        foreach ($headers as $head) {

            if ($head == 'Consumers') {
                $row[] = $totalConsumers ? $totalConsumers : '';
            } else if ($head == 'Business Owners') {
                $row[] = $totalBusinessOwners ? $totalBusinessOwners : '';
            } else if ($head == 'Business Users') {
                $row[] = '';
            } else if ($head == 'Entrepreneurs') {
                $row[] = $totalEntrepreneurs ? $totalEntrepreneurs : '';
            } else if ($head == 'Other') {
                $row[] = $totalOther ? $totalOther : '';
            } else if ($head == 'Total') {
                $row[] = $totalAll ? $totalAll : '';
            }
        }
        fputcsv($fp, $row);
        unset($row);

        $row = array('To Date');
        foreach ($headers as $head) {

            if ($head == 'Consumers') {
                $totalUsersListings = ($totalConsumers + Listings::getToDateProfessionUsersListingCount(2));
                $totalToDates += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Business Owners') {
                $totalUsersListings = ($totalBusinessOwners + Listings::getToDateProfessionUsersListingCount(1));
                $totalToDates += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Business Users') {
                $row[] = '';
            } else if ($head == 'Entrepreneurs') {
                $totalUsersListings = ($totalEntrepreneurs + Listings::getToDateProfessionUsersListingCount(3));
                $totalToDates += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Other') {
                $totalUsersListings = ($totalOther + Listings::getToDateProfessionUsersListingCount(5));
                $totalToDates += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Total') {
                $row[] = $totalToDates ? $totalToDates : '';
            }
        }
        fputcsv($fp, $row);
        unset($row);

        $row = array('Online');
        foreach ($headers as $head) {

            if ($head == 'Consumers') {
                $totalUsersListings = Listings::getProfessionUserListingCountOnline(2);
                $totalUsersListingsCountOnline += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Business Owners') {
                $totalUsersListings = Listings::getProfessionUserListingCountOnline(1);
                $totalUsersListingsCountOnline += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Business Users') {
                $row[] = '';
            } else if ($head == 'Entrepreneurs') {
                $totalUsersListings = Listings::getProfessionUserListingCountOnline(3);
                $totalUsersListingsCountOnline += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Other') {
                $totalUsersListings = Listings::getProfessionUserListingCountOnline(5);
                $totalUsersListingsCountOnline += $totalUsersListings;
                $row[] = $totalUsersListings ? $totalUsersListings : '';
            } else if ($head == 'Total') {
                $row[] = $totalUsersListingsCountOnline ? $totalUsersListingsCountOnline : '';
            }
        }
        fputcsv($fp, $row);
        unset($row);

        exit;
    }

    public function actionSampleview()
    {
        $listid = $_REQUEST['id'];
        $model = Samplelisting::model()->findByPk($listid);
        if(isset($_POST))
        {

            $i = 0;
            for ($i = 0; $i < 6; $i++) {

                if ($_POST['user_default_listing_image_text'][$i] != "") {

                    if($_POST['current_ids'][$i] != "")
                    {
                        $imgid = $_POST['current_ids'][$i];
                        $Userlistingimages = Samplelistingimages::model()->find("user_default_listing_image_id ='" . $imgid . "'");
                        //$Userlistingimages->user_default_listing_image = $_POST['img_name'][$i];
                        $Userlistingimages->user_default_listing_image_text = $_POST['user_default_listing_image_text'][$i];
                        $Userlistingimages->user_default_listing_image_link2 = $_POST['user_default_listing_image_link2'][$i];
                        // $Userlistingimages->user_default_listing_lid = $listid;
                        $Userlistingimages->save();
                    }



                }
            }

            $model->attributes = $_POST['Samplelisting'];
            if($_POST['ispublish'] == "1")
            {
                $model->user_default_sample_listing_status = "1";
            }
            if($_POST['issuspend'] == "1")
            {
                $model->user_default_sample_listing_status = "2";
            }
            $model->save();
        }
        //$this->render('sampleview');
        $this->render('sampleview', array('model' => $model));
    }
    
    public function actionUploadYoutube(){
        $del = Yii::app()->request->getParam('del');
        $filename = Yii::app()->request->getParam('filename');
        if($del){
            $file1 = Yii::app()->request->getParam('file1');
            $file2 = Yii::app()->request->getParam('file2');
            unlink($file1);
            unlink($file2);
            exit();
        }
        
        $temp = explode('/', $filename);
        $name = end($temp);        
        $name = explode('.', $name)[0];

        $upload_cls = new uploadyoutube;
        $response  = $upload_cls->upload($filename, $name);
        
        $res = json_decode($response);
        if($res->status=='success'){
            unlink($filename);
        }
        @ob_clean();
        echo $response;
        exit();
    }
    
    public function actionGetYoutubeUploadStatus(){
       $filename = Yii::app()->request->getParam('filename');
       if(!empty($filename)){
         $progress =  file_get_contents($filename);
         $progress_arr = explode('\n', $progress);
         $lastest_progress = array_pop($progress_arr);
         @ob_clean();
         echo json_encode(array('success'=>true, 'filename'=>$filename,'progress'=>$lastest_progress));
       }
    }

    public function actionUpdateToken(){
        $this->uploadytube = new uploadyoutube;        
        $this->uploadytube->writeAccesstoken();
        $this->redirect(Yii::app()->createUrl('admin/listings/listings'));
    }
    
    
}