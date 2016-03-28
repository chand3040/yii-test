<?php


class DefaultbannersController extends Controller

{

    // Allowed mime type for file to upload
    public static $allowedUploadType = array("image/jpg", "image/jpeg", "image/png", "image/bmp", "image/gif", "image/thm", "image/tif");

    // Max size file to upload ( 2 MB )
    public static $maxUploadFile = 2097152;

    // Directory for upload attachement
    public static $uploadDirectoryPath = 'upload/banner-images/banners_index/';

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
            array('allow', // allow authenticated user to perform 'index' action
                'actions' => array('index', 'publish', 'unpublish', 'deleteBanner'),
                'users' => array('@'),
            ),
            /*array('deny',  // deny all users
                'users' => array('*'),
            ),*/
        );
    }

    public function actionIndex()
    {
        $defaultBanners = SiteBannerads::model()->findAll();

        $this->render('index', array('defaultBanners' => $defaultBanners));
    }

    public function actionuploadAttachement()
    {
        if ((Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id))) {
            throw new CHttpException(302, "");
        }

        $error = FALSE;
        $message = null;
        $fileName = "error";

        if (empty($_FILES) || ($_FILES['attachement']['error'] != 0)) {

            $error = TRUE;
            $message = "Attachment not found.";

        }

        if (!$error) {

            $attachement = $_FILES['attachement'];

            if ((!$error) && (!in_array($attachement['type'], self::$allowedUploadType))) {

                $error = TRUE;
                $message = "You may not upload an illegal file." . '<br/>';
                $message .= '<span style="color: #6b6d6e;">File types allowed:- Image files only.</span>';
            }

            if ((!$error) && ($attachement['size'] > self::$maxUploadFile)) {

                $error = TRUE;
                $message = "Attachment size not allowed.";

            }

        }

        if (!$error) {

            $fileToUploadPath = self::$uploadDirectoryPath . $attachement['name'];

            // Add time in file name to avoid conflict beetween files names
            $fileName = 'banner-images/banners_index/' . $attachement['name'];

            if (!(move_uploaded_file($attachement['tmp_name'], $fileToUploadPath))) {

                $error = TRUE;
                $message = "Upload attachement failed.";
                $fileName = "error";
            }
        }

        $actionStatus = (!$error) ? "1" : "0";
        $message = ($message != '') ? $message : "Upload attachment success";
        echo CJSON::encode(array("action_status" => $actionStatus, "message" => $message, "file_name" => $fileName));


    }

    public function actionPublish()
    {

        if (isset($_POST['banner_id'])) {

            $siteBannerAds = SiteBannerads::model()->findByPk($_POST['banner_id']);

            $siteBannerAds->user_default_banner_path = $_POST['banner_path'];
            $siteBannerAds->user_default_banner_link = $_POST['banner_link'];
            $siteBannerAds->user_default_date_time = date('Y-m-d H:i:s');
            $siteBannerAds->user_default_banner_status = '1';
            $siteBannerAds->update(array('user_default_banner_path', 'user_default_banner_link', 'user_default_date_time', 'user_default_banner_status'));

            if ($siteBannerAds) {
                echo CJSON::encode(array("action_status" => '1', "message" => 'Success'));
            } else {
                echo CJSON::encode(array("action_status" => '0', "message" => 'Fail'));
            }
        }

    }

    public function actionUnpublish()
    {

        if (isset($_REQUEST['banner_id'])) {

            $siteBannerAds = SiteBannerads::model()->findByPk($_REQUEST['banner_id']);

            $siteBannerAds->user_default_date_time = date('Y-m-d H:i:s');
            $siteBannerAds->user_default_banner_status = '2';
            $siteBannerAds->update(array('user_default_date_time', 'user_default_banner_status'));

            if ($siteBannerAds) {
                echo CJSON::encode(array("action_status" => '1', "message" => 'Success'));
            } else {
                echo CJSON::encode(array("action_status" => '0', "message" => 'Fail'));
            }
        }

    }

    public function actionDeleteBanner()
    {

        /*$bannerId = (isset($_POST['BannerId'])? $_POST['BannerId']:'');
        $return = SiteBannerads::model()->deleteByPk(array('user_default_banner_id'=>$bannerId));
        if($return){
            echo CJSON::encode(array("action_status"=>'1',"message" => 'Success'));
        }else{
            echo CJSON::encode(array("action_status"=>'0',"message" => 'Fail'));

        }*/

        if (isset($_REQUEST['banner_id'])) {

            $siteBannerAds = SiteBannerads::model()->findByPk($_REQUEST['banner_id']);

            if ($siteBannerAds->user_default_banner_path != '' && file_exists('upload/' . $siteBannerAds->user_default_banner_path)) {
                unlink('upload/' . $siteBannerAds->user_default_banner_path);
            }

            $siteBannerAds->user_default_banner_path = '';
            $siteBannerAds->user_default_banner_link = '';
            $siteBannerAds->user_default_date_time = date('Y-m-d H:i:s');
            $siteBannerAds->user_default_banner_status = '2';
            $siteBannerAds->update(array('user_default_banner_path', 'user_default_banner_link', 'user_default_date_time', 'user_default_banner_status'));

            if ($siteBannerAds) {
                echo CJSON::encode(array("action_status" => '1', "message" => 'Success'));
            } else {
                echo CJSON::encode(array("action_status" => '0', "message" => 'Fail'));
            }
        }
    }
}