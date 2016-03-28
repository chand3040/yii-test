<?php


class BannerController extends Controller
{
    public $layout = '/layouts/column2';

    public function init()
    {
        parent::init();
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('update', 'index', 'exportBannerGrid'),
                'users' => array('@'),
            ),
            array('allow',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {

        // Set default value
        Yii::app()->user->setState('pageSize', 10);

        if (isset($_POST['more_record'])) {
            Yii::app()->user->setState('pageSize', $_POST['more_record']);
            unset($_POST['more_record']);
        }

        $model = new Banner('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Banner']))
            $model->attributes = $_GET['Banner'];

        // if isset POST['Banner']
        if (isset($_POST['Banner']))
            $model->attributes = $_POST['Banner'];

        $newBannerSubmission = Yii::app()->db->createCommand()
            ->select('profile.user_default_username , profile.user_default_email ,listing.user_default_listing_title,banner.*')
            ->from('{{banner_ads}} banner')
            ->join('user_default_profiles AS profile', 'profile.user_default_id = banner.user_default_id')
            ->join('user_default_listing AS listing', 'listing.user_default_listing_id = banner.user_default_listing_id')
            ->order('banner.user_default_listing_banner_id DESC')
            ->where("banner.user_default_listing_banner_status='0'")
            ->limit('5')
            ->queryAll();

        $this->render('index', array(
            'model' => $model,
            'newBannerSubmission' => $newBannerSubmission
        ));

    }


    public function actionPublish()
    {
        $request = Yii::app()->getRequest();
        if ($request->getPost('selectBanner')) {

            foreach ($request->getPost('selectBanner') as $index => $bannerId):
                if (!empty($request->getPost('selectBanner')[$index]) && empty($request->getPost('reject')[$index])) {
                    $banner = Banner::model()->findByPk($request->getPost('selectBanner')[$index]);
                    $banner->user_default_listing_banner_status = 1;
                    $banner->user_default_listing_banner_submission_date = date('Y-m-d');
                    if ($banner->save()) {
                    }
                }
                if (!empty($request->getPost('reject')[$index])) {
                    $bannersId = $request->getPost('reject')[$index];
                    $messagereject = $request->getPost('message')[$index];
                    $banner = Banner::model()->findByPk($bannersId);
                    $banner->user_default_listing_banner_status = 0;
                    $banner->user_default_listing_banner_submission_date = date('Y-m-d');
                    $activelink = '<a href="' . Yii::app()->createAbsoluteUrl('/banner/reject/', array('code' => $bannersId)) . '" target="_blank" >here </a>';
                    $template = MailTemplate::model()->findByAttributes(array("template_module" => 'banner_rejection'));
                    $bannerImage = "<img src='" . Yii::app()->baseUrl . '/upload/' . $banner->user_default_listing_banner_path . "' title='" . $banner->user_default_listing_banner_link . "'/>";
                    $model = User::model()->findByPk($banner->user_default_id);

                    if ($banner->save()) {
                        $string = array(

                            '{{#ADMINMESSAGE#}}' => $message,
                            '{{#BANNERIMAGE#}}' => $bannerImage,
                            '{{#BANNERLINK#}}' => $banner->user_default_listing_banner_link,

                            '{{#SUBMISSIONDATE#}}' => $banner->user_default_listing_banner_submission_date,

                            '{{#TITLE#}}' => $banner->user_default_listing_banner_link,

                            '{{#LINK#}}' => 'You may click ' . $activelink . ' to log into your account and update / amend your banner so that it complies.',

                            '{{#DURATION#}}' => $banner->user_default_listing_banner_duration,

                            '{{#COST#}}' => $banner->user_default_listing_banner_cost,

                            '{{#STATUS#}}' => 'Waiting Admin Approval',

                            '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email'],

                        );


                    }


                    $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);


                    $result = SharedFunctions::app()->sendmail($model->user_default_email, $template->template_subject, $body);

                    SharedFunctions::app()->sendmail($model->user_default_email, $template->template_subject, $body);

                }
            endforeach;
        }

        $this->redirect(Yii::app()->request->urlReferrer);

    }


    public function actionReject()
    {
        $request = Yii::app()->getRequest();

        if ($request) {

            $bannersId = $request->getPost('bannerid');
            $messagereject = $request->getPost('admincomment');
            $banner = Banner::model()->findByPk($bannersId);
            $banner->user_default_listing_banner_status = 0;
            $banner->user_default_listing_banner_submission_date = date('Y-m-d');
            $activelink = '<a href="' . Yii::app()->createAbsoluteUrl('/banner/reject/', array('code' => $bannersId)) . '" target="_blank" >here </a>';
            $template = MailTemplate::model()->findByAttributes(array("template_module" => 'banner_rejection'));
            $bannerImage = "<img src='" . Yii::app()->baseUrl . '/upload/' . $banner->user_default_listing_banner_path . "' title='" . $banner->user_default_listing_banner_link . "'/>";
            $model = User::model()->findByPk($banner->user_default_id);

            if ($banner->save()) {
                $string = array(

                    '{{#ADMINMESSAGE#}}' => $message,
                    '{{#BANNERIMAGE#}}' => $bannerImage,
                    '{{#BANNERLINK#}}' => $banner->user_default_listing_banner_link,

                    '{{#SUBMISSIONDATE#}}' => $banner->user_default_listing_banner_submission_date,

                    '{{#TITLE#}}' => $banner->user_default_listing_banner_link,

                    '{{#LINK#}}' => 'You may click ' . $activelink . ' to log into your account and update / amend your banner so that it complies.',

                    '{{#DURATION#}}' => $banner->user_default_listing_banner_duration,

                    '{{#COST#}}' => $banner->user_default_listing_banner_cost,

                    '{{#STATUS#}}' => 'Waiting Admin Approval',

                    '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email'],

                );


            }


            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);


            $result = SharedFunctions::app()->sendmail($model->user_default_email, $template->template_subject, $body);

            SharedFunctions::app()->sendmail($model->user_default_email, $template->template_subject, $body);


            if ($result) {

                echo 'success';

            } else {

                echo 'fail';

            }


        }

    }


    public function actionUpdatelink()
    {
        $request = Yii::app()->getRequest();

        if ($request) {

            $bannersId = $request->getPost('bannerid');
            $bannerlink = $request->getPost('bannerlink');
            $bannerMessage = $request->getPost('bannermessage');
            $activelink = '<a href="' . Yii::app()->createAbsoluteUrl('/banner/reject/', array('code' => $bannersId)) . '" target="_blank" >here </a>';
            $model = Banner::model()->findByPk($bannersId);
            $model->user_default_listing_banner_link = $bannerlink;
            $model->user_default_listing_banner_status = 1;
            $user = User::model()->findByPk($model->user_default_id);
            $bannerImage = "<img src='" . Yii::app()->baseUrl . '/upload/' . $model->user_default_listing_banner_path . "' title='" . $model->user_default_listing_banner_link . "'/>";
            $template = MailTemplate::model()->findByAttributes(array("template_module" => 'banner_link_updated'));

            if ($model->save()) {

                $string = array(

                    '{{#ADMINMESSAGE#}}' => $bannerMessage,

                    '{{#BANNERIMAGE#}}' => $bannerImage,

                    '{{#SUBMISSIONDATE#}}' => $model->user_default_listing_banner_submission_date,
                    '{{#TITLE#}}' => $model->user_default_listing_banner_link,

                    '{{#LINK#}}' => 'You may click ' . $activelink . ' to log into your account and update / amend your banner so that it complies.',

                    '{{#DURATION#}}' => $model->user_default_listing_banner_duration,

                    '{{#COST#}}' => $model->user_default_listing_banner_cost,

                    '{{#STATUS#}}' => 'Banner link is updated',

                    '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email'],

                );

                $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

                $result = SharedFunctions::app()->sendmail($user->user_default_email, $template->template_subject, $body);

                SharedFunctions::app()->sendmail($user->user_default_email, $template->template_subject, $body);

                if ($result) {
                    die(json_encode(array('success' => true)));
                }
            }
        }
    }


    public function actionUpdate()
    {


        $criteria = new CDbCriteria;

        $criteria->compare('user_default_listing_banner_status !', 1);

        $criteria->order = 'user_default_listing_banner_id desc';


        $bannerId = Yii::app()->request->getParam('bannerid');

        $total = Banner::model()->count($criteria);

        if (isset($_REQUEST['rows'])) {

            $count = $_REQUEST['rows'];

        } else {

            $count = 6;

        }

        $pages = new CPagination($total);

        $pages->setPageSize($count);

        $pages->applyLimit($criteria);  // the trick is here!


        $posts = Banner::model()->findAll($criteria);


        $this->render('update', array(

            'list' => $posts,

            'pages' => $pages,

            'item_count' => $total,

            'page_size' => Yii::app()->params['listPerPage'],

        ));
    }

    public function actionExportBannerGrid()
    {
        $fp = fopen('php://output', 'w');

        /*
         * Write a header of csv file
         */
        $headers = array(
            'User',
            'Date',
            'Banner Title',
            'Email',
            'Duration',
            'Amount',
        );

        $row = array();
        foreach ($headers as $header) {
            $row[] = $header;
        }

        /*
         * save as csv content
         */
        $filename = 'BannerAds.csv';
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        fputcsv($fp, $row);

        /*
        * Write the data of csv file
        */
        $model = new Banner('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Banner']))
            $model->attributes = $_GET['Banner'];

        $dp = $model->search();
        $dp->setPagination(false);

        /*
         * Get models, write to a file
         */

        $models = $dp->getData();
        foreach ($models as $model) {
            $row = array();
            foreach ($headers as $head) {
                if ($head == 'User') {
                    $row[] = $model->userDefault->user_default_username;
                }
                if ($head == 'Date') {
                    $row[] = CommonClass::convertDateAsDisplayFormat(CHtml::value($model, 'user_default_listing_banner_submission_date'), 'd/m/Y');
                } else if ($head == 'Banner Title') {
                    $row[] = $model->userDefaultListing->user_default_listing_title;
                } else if ($head == 'Email') {
                    $row[] = $model->userDefault->user_default_email;
                } else if ($head == 'Duration') {
                    $row[] = CHtml::value($model, 'user_default_listing_banner_duration');
                } else if ($head == 'Amount') {
                    $row[] = $model->user_default_listing_banner_cost;
                }
            }
            fputcsv($fp, $row);
        }
        exit;
    }

}