<?php

class BlistingController extends Controller
{

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
                'actions' => array('index,update,create,delete,rdelete,publish,rejection,suspension,restore,downloadvideo,blistingStatistics,exportBusinessListings'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate()
    {
        $model = new Blisting;
        if (isset($_POST['Blisting'])) {
            $model->attributes = $_POST['Blisting'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->user_default_business_blid));
            }
        }
    }

    public function actionIndex()
    {
        /*if($_POST['username'] || $_POST['month'] || $_POST['user_default_business_profession']
            || $_POST['user_default_business_viewlimit'] || $_POST['user_default_business_slogon'] || $_POST['Email']  )
        {*/
        $model = new Blisting('search');
        $criteria = new CDbCriteria;

        if (isset($_POST['username']) && $_POST['username'] != "") {

            $Data = Business::model()->findAll("user_default_business_username like '%" . addslashes($_POST['username']) .
                "%'");
            if ($Data) {

                foreach ($Data as $rsData) {

                    $ids = $rsData->user_default_business_id . ',';

                }

                $ids1 = rtrim($ids, ',');

                $criteria->addInCondition('user_default_business_id', array($ids1));
            }
        }
        if (isset($_POST['month']) && $_POST['month'] != "") {
            $criteria->addCondition("MONTH(user_default_business_datetime)='" . $_POST['month'] . "'");

        }


        if (isset($_POST['user_default_business_profession']) && $_POST['user_default_business_profession'] != "") {

            $criteria->compare('user_default_business_profession', addslashes($_POST['user_default_business_profession']), true);
        }


        if (isset($_POST['user_default_business_viewlimit']) && $_POST['user_default_business_viewlimit'] != "") {

            $criteria->compare('user_default_business_viewlimit', addslashes($_POST['user_default_business_viewlimit']), true);
        }


        if (isset($_POST['user_default_business_slogon']) && $_POST['user_default_business_slogon'] != "") {
            $criteria->compare('user_default_business_slogon', addslashes($_POST['user_default_business_slogon']), true);

        }


        if (isset($_POST['Email']) && $_POST['Email'] != "") {
            $Data = Business::model()->findAll("user_default_business_email like '%" . addslashes($_POST['Email']) .
                "%'");
            if ($Data) {

                foreach ($Data as $rsData) {

                    $ids = $rsData->user_default_business_id . ',';

                }

                $ids1 = rtrim($ids, ',');

                $criteria->addInCondition('user_default_business_id', array($ids1));
            }

        }

        $criteria->order = 'user_default_business_blid desc';

        $total = Blisting::model()->count($criteria);

        if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 5;
        }


        $pages = new CPagination($total);
        $pages->setPageSize($count);
        $pages->applyLimit($criteria); // the trick is here!
        $posts = Blisting::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'list' => $posts,
            'pages' => $pages,
            'item_count' => $total,
            'page_size' => Yii::app()->params['listPerPage'],

        ));
        /* }elseif($_POST['btnsubmit']) {
             $model = new Blisting();

             $total = Blisting::model()->count($criteria);

             if (isset($_REQUEST['rows'])) {
                 $count = $_REQUEST['rows'];
             } else {
                 $count = 5;
             }


             $pages = new CPagination($total);
             $pages->setPageSize($count);
             $pages->applyLimit($criteria); // the trick is here!
             $posts = Blisting::model()->findAll($criteria);

             $this->render('index', array(
                 'model' => $model,
                 'list' => $posts,
                 'pages' => $pages,
                 'item_count' => $total,
                 'page_size' => Yii::app()->params['listPerPage'],

             ));
         }else
         {
             $model = new Blisting();
             $posts= array();
             $this->render('index', array(
                 'model' => $model,
                 'list' => $posts));
         }*/
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if (isset($_POST['Blisting'])) {
            $model->attributes = $_POST['Blisting'];
            if ($id != "") {

                Businesslistingimages::model()->deleteAll("user_default_business_blid  ='" . $id . "'");

            }

            $i = 0;

            for ($i = 0; $i < 6; $i++) {

                if ($_POST['img_name'][$i] != "") {

                    $Businesslistingimages = new Businesslistingimages;

                    $Businesslistingimages->user_default_business_listing_image = $_POST['img_name'][$i];

                    $Businesslistingimages->user_default_business_imgdesc = $_POST['user_default_business_imgdesc'][$i];

                    $Businesslistingimages->user_default_business_listing_link1 = $_POST['user_default_business_listing_link1'][$i];

                    $Businesslistingimages->user_default_business_listing_link2 = $_POST['user_default_business_listing_link2'][$i];

                    $Businesslistingimages->user_default_business_blid = $id;

                    $Businesslistingimages->save();

                }

            }

            $user_details = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id));

            $userid = $model->user_default_business_id;

            $username = $user_details[0]['user_default_business_username'];

            $upath = $username . "_" . $userid;

            $path = $_SERVER['DOCUMENT_ROOT'] . '/';

            $j = 0;

            for ($j = 0; $j < 3; $j++) {

                if ($_POST['user_default_business_videos'][$j] != "") {

                    echo $youtubelink = $_POST['user_default_business_video'][$j];

                    if ($youtubelink != "") {

                        $oldvid = $_POST['user_default_business_old_videos'][$j];

                        $cvidpath1 = $path . "upload/users/" . $upath . "/videos/" . $oldvid;

                        unlink($cvidpath1);

                        Businesslistingvideos::model()->deleteAll("user_default_business_listing_video ='" . $oldvid . "'");

                        $Businesslistingvideos = new Businesslistingvideos;

                        $Businesslistingvideos->user_default_business_listing_video_type = "1";

                        $Businesslistingvideos->user_default_business_listing_video = $youtubelink;

                    } else {
                        $Businesslistingvideos = new Businesslistingvideos;

                        $Businesslistingvideos->user_default_business_listing_video_type = "0";

                        $Businesslistingvideos->user_default_business_listing_video = $_POST['user_default_business_videos'][$j];
                    }


                    $Businesslistingvideos->user_default_business_blid = $id;

                    $Businesslistingvideos->save();

                }

            }


            if ($model->save()) {

                if ($_POST['update']) {

                    //$user_details = Business::model()->findAllByAttributes(array("user_default_business_id"=>$model->user_default_business_id));
                    $to = $user_details[0]['user_default_business_email'];
                    $subject = "User listing update notification";
                    //$url = $_SERVER['HTTP_REFERER'];
                    $yii_user_request_id = '<a href="' . Yii::app()->getBaseUrl(true) . "/" . "businesslisting" . "/" . "fupdate" . "/blistid/" . $model->user_default_business_blid . '" target="_blank" >here >> </a>';

                    $template = MailTemplate::getTemplate('Business_Listing_update');
                    $sitelink = '<a href="' . Yii::app()->getBaseUrl(true) . '" target="_blank" >here >> </a>';
                    $adminmsg = "<p >" . $_POST['changes'] . "</p>";
                    $contactlink = '<a href="' . Yii::app()->getBaseUrl(true) . '/contact" target="_blank" >listing support team</a>';

                    $string = array(
                        '{{#USERNAME#}}' => ucwords($user_details[0]['user_default_business_first_name'] . ' ' . $user_details[0]['user_default_business_surname']),
                        '{{#MESSAGE#}}' => ucwords($adminmsg), '{{#LSLINK#}}' => $contactlink,
                        '{{#LISTINGLINK#}}' => ucwords($yii_user_request_id)
                    );

                    $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

                    $result = SharedFunctions::app()->sendmail($to, $template->template_subject, $body);

                }
                Yii::app()->user->setFlash('success', 'User Profile Updated Successfully.');
                //$this->redirect(array('index'));
                //$this->redirect(Yii::app()->createUrl('admin/blisting/blisting'));
            }

        }
        $this->render('update', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $model = Blisting::model()->findByPk($id);
        if ($model === null)

            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;

    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionRdelete($id)
    {
        $model = $this->loadModel($id);


        if (isset($model)) {
            $model->user_default_business_blistingstatus = 3;
            $model->user_default_business_bdeletedate = date('Y-m-d H:i:s');
            if ($model->save()) {

                if ($_POST['delete']) {

                    $user_details = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id));
                    $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true) . "/" . "businesslisting" . "/" . "rdelete" . "/blistid/" . $model->user_default_business_blid.'>here >></a>';
                    $to = $user_details[0]['user_default_business_email'];
                    $subject = "User listing deletion notification";                 
                }
                $this->render('update', array('model' => $model,));
            } else {
                $this->render('update', array('model' => $model,));
            }

        }
    }

    public function actionPublish($id)
    {
        $model = $this->loadModel($id);
        $user_details = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id));
        $to = $user_details[0]['user_default_business_email'];
        $statuss = $model['user_default_business_status'];
        if ($statuss == "0") {
            $stat = "Waiting admin approval and publication";
        } else if ($statuss == "1") {
            $stat = "Published";
        } else if ($statuss == "2") {
            $stat = "Suspended";
        } else if ($statuss == "3") {
            $stat = "Deleted";
        } else if ($statuss == "4") {
            $stat = "Restored";
        } else if ($statuss == "4") {
            $stat = "Permenant Deleted";
        }
        $template = MailTemplate::getTemplate('blisting_publication');
        $yii_user_request_id = '<a href="' . Yii::app()->getBaseUrl(true) . "/" . "businesslisting/fupdate/blistid/" . $model->user_default_business_blid . '" target="_blank" >here >> </a>';
        $ltitle = "<font color='orange'><i>" . $model_user['co_title'] . "</i></font>";
        $ldate = "<font color='orange'><i>" . $model['user_default_business_datetime'] . "</i></font>";
        $lstatus = "<font color='#15c'><i>" . $stat . "</i></font>";
        $string = array('{{#LISTINGTITLE#}}' => ucwords($ltitle), '{{#USERNAME#}}' => ucwords($model_user['user_default_business_name'] . ' ' . $model_user['user_default_business_surname']), '{{#LISTINGDATE#}}' => ucwords($ldate), '{{#LISTINGSTATUS#}}' => ucwords($lstatus), '{{#LINK#}}' => ucwords($yii_user_request_id));
        $subject = "Your Business listing " . $model_user['co_title'] . " has now been published";
        $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
        $result = SharedFunctions::app()->sendmail($to, $subject, $body);

        if (isset($model)) {
            $model->user_default_business_blistingstatus = 1;
            $model->user_default_business_datetime = date('Y-m-d');
            if ($model->save()) {
                $this->render('update', array('model' => $model,));
            } else {
                $this->render('update', array('model' => $model,));
            }
        }
    }

    public function actionRejection($id)
    {
        $model = $this->loadModel($id);


        if ($_POST['rejection']) {
            $user_details = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id));
            $to = $user_details[0]['user_default_business_email'];

            $subject = "User listing rejection notification";
            $controller = Yii::app()->controller->action->id;
            $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true) . "/" . "businesslisting" . "/" . "rejection" . "/blistid/" . $model->user_default_business_blid.'">here >> </a>';

            $template = MailTemplate::getTemplate('Business_Listing_rejection');

            $string = array(
                '{{#USERNAME#}}'=>$user_details[0]['user_default_business_name'],
                '{{#MESSAGE#}}'=>$_POST['rejectval'],
                '{{#SITELINK#}}'=>$yii_user_request_id
            );
            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

            $result = SharedFunctions::app()->sendmail($to, $subject, $body);
        }
        if (isset($model)) {
            $model->user_default_business_breject_list = 1;

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

            $user_details = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id));
            $to = $user_details[0]['user_default_business_email'];
            $subject = "User listing suspension notification";
            $controller = Yii::app()->controller->action->id;

            $yii_user_request_id = "<a herf='" .Yii::app()->getBaseUrl(true) . "/" . "businesslisting" . "/" . "suspensed" . "/blistid/" . $model->user_default_business_blid. "><<here</a>";

            $template = MailTemplate::getTemplate('Business_Listing_suspension');

            $string = array(
                '{{#USERNAME#}}'=>$user_details[0]['user_default_business_name'],
                '{{#MESSAGE#}}'=>$_POST['suspensionval'],
                '{{#LISTINGLINK#}}'=>$yii_user_request_id
            );
            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

            $result = SharedFunctions::app()->sendmail($to, $subject, $body);

        }

        if (isset($model)) {
            $model->user_default_business_blistingstatus = 0;
            $model->user_default_business_bapprovedate = date('Y-m-d');
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
            $model->user_default_business_blistingstatus = 4;
            if ($model->save()) {
                $this->render('update', array('model' => $model,));
            } else {
                $this->render('update', array('model' => $model,));
            }
        }
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
    public function actionDownloadvideo()
    {

        $filename = Yii::app()->request->getParam('file');

        $fileData = Businesslistingvideos::model()->find("user_default_business_listing_video= '" . $filename . "'");

        $BlistingData = Blisting::model()->find("user_default_business_blid= '" . $fileData->user_default_business_blid . "'");

        $userData = Business::model()->find("user_default_business_id = '" . $BlistingData->user_default_business_id . "'");

        // @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.'.$userData->user_default_business_username.'_'.$userData->user_default_business_id).DIRECTORY_SEPARATOR.$filename);
        @EDownloadHelper::download(Yii::getPathOfAlias('webroot.upload.users.' . $userData->user_default_business_username . '_' . $userData->user_default_business_id) . '/videos/' . $filename);
        return;
    }

    public function actionBlistingStatistics()
    {
        $sectorId = ($_POST['sectorId'] ? $_POST['sectorId'] : '');
        $janmonth = '01';
        $janSector = Blisting::model()->getSectorBlistingCount($sectorId, $janmonth);

        $febmonth = '02';
        $febSector = Blisting::model()->getSectorBlistingCount($sectorId, $febmonth);

        $marmonth = '03';
        $marSector = Blisting::model()->getSectorBlistingCount($sectorId, $marmonth);

        $aprilmonth = '04';
        $aprilSector = Blisting::model()->getSectorBlistingCount($sectorId, $aprilmonth);

        $maymonth = '05';
        $maySector = Blisting::model()->getSectorBlistingCount($sectorId, $maymonth);

        $junemonth = '06';
        $juneSector = Blisting::model()->getSectorBlistingCount($sectorId, $junemonth);

        $julymonth = '07';
        $julySector = Blisting::model()->getSectorBlistingCount($sectorId, $julymonth);

        $augmonth = '08';
        $augSector = Blisting::model()->getSectorBlistingCount($sectorId, $augmonth);

        $septmonth = '09';
        $septSector = Blisting::model()->getSectorBlistingCount($sectorId, $septmonth);

        $octmonth = '10';
        $octSector = Blisting::model()->getSectorBlistingCount($sectorId, $octmonth);

        $novmonth = '11';
        $novSector = Blisting::model()->getSectorBlistingCount($sectorId, $novmonth);

        $decmonth = '12';
        $decSector = Blisting::model()->getSectorBlistingCount($sectorId, $decmonth);

        $todate = Blisting::model()->getSectorBlistingToDateCount($sectorId);


        echo CJSON::encode(array("sector" => $sectorId, "janSector" => $janSector, 'febSector' => $febSector, 'marSector' => $marSector, 'aprilSector' => $aprilSector,
            'maySector' => $maySector, 'juneSector' => $juneSector, 'julySector' => $julySector, 'augSector' => $augSector, 'septSector' => $septSector, 'octSector' => $octSector, 'novSector' => $novSector, 'decSector' => $decSector,
            'toDateSector' => $todate
        ));

    }

    function actionExportBusinessListings()
    {

        $sectorId = $_REQUEST['sectorId'];

        $fp = fopen('php://output', 'w');

        /*
         * Write a header of csv file
         */
        $headers = array(
            'Business Sector',
            'Total',
        );

        $row = array();
        foreach ($headers as $header) {
            $row[] = $header;
        }

        /*
         * save as csv content
         */
        $filename = 'BusinessListings.csv';
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        fputcsv($fp, $row);

        /*
       * Write the data of csv file
       */

        /*
        * Write the data of csv file
        */
        $totalSector = 0;

        $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Num', '12' => 'Dec');
        foreach ($months as $index => $month) {

            $row = array($month);
            foreach ($headers as $head) {

                if ($head == 'Business Sector') {
                    $month = $index;
                    $sectorBlistingCount = Blisting::getSectorBlistingCount($sectorId, $month);
                    $row[] = $sectorBlistingCount ? $sectorBlistingCount : '';

                } else if ($head == 'Total') {
                    $row[] = $sectorBlistingCount ? $sectorBlistingCount : '';
                }
            }
            fputcsv($fp, $row);

            unset($row);
        }


        $row = array('Totals');
        foreach ($headers as $head) {

            if ($head == 'Business Sector') {
                $row[] = $sectorBlistingCount ? $sectorBlistingCount : '';
            } else if ($head == 'Total') {
                $row[] = $sectorBlistingCount ? $sectorBlistingCount : '';
            }
        }
        fputcsv($fp, $row);
        unset($row);

        $row = array('To Date');
        foreach ($headers as $head) {

            if ($head == 'Business Sector') {
                $totalToDateBListings = Blisting::getSectorBlistingToDateCount($sectorId);
                $totalToDates += $totalToDateBListings;
                $row[] = $totalToDateBListings ? $totalToDateBListings : '';
            } else if ($head == 'Total') {
                $row[] = $totalToDates ? $totalToDates : '';
            }
        }
        fputcsv($fp, $row);
        unset($row);

        exit;
    }

}