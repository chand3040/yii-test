<?php


class BannerController extends Controller
{
    public $layout = '//layouts/column2';

    // Allowed mime type for file to upload
    public static $allowedUploadType = array("application/pdf", "application/zip", "application/x-rar-compressed", "application/x-compressed", "image/jpg", "image/jpeg", "image/png", "image/bmp", "image/gif", "image/thm", "image/tif");

    // Max size file to upload ( 2 MB )
    public static $maxUploadFile = 2097152;

    // Directory for upload attachement
    public static $uploadDirectoryPath = 'upload/mymessages/';

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


    public function accessRules()

    {

        return array(

            array('allow',  // allow all users to perform 'index' and 'view' actions

                'actions' => array('reject', 'updatehit'),

                'users' => array('*'),

            ),

            array('allow', // allow authenticated user to perform 'create' and 'update' actions

                'actions' => array('index', 'active', 'makepayment', 'bannerpaymentsuccess', 'bannerpaymentcancel', 'payment', 'uploadbaneer', 'update', 'marketing_payment', 'paypalreturn', 'paypalcancel', 'uploadAttachement', 'send_message'),

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


    public function actionIndex()
    {


        $listid = $_REQUEST['listid'];
        $payment = isset($_REQUEST['paymentSuccess']) ? $_REQUEST['paymentSuccess'] : '';

        if(isset($_REQUEST['displayDialog']) AND $_REQUEST['displayDialog']==1 AND isset($_REQUEST['purchasePoints']) AND $_REQUEST['purchasePoints']>0){
            $this->render('thankyou', array(
                'purchasePoints'=>$_REQUEST['purchasePoints']
            ));
        }else{

                $page = (isset($_GET['page']) ? $_GET['page'] : 1); // to get the current page
                $offset = ($page - 1) * Yii::app()->params['pageSize'];

                // generate sql query for geting purchased details
                $sql = "SELECT * FROM user_default_prize_points
                  WHERE user_default_listing_points_user_id = " . Yii::app()->user->id . " and user_default_listing_id ='" .$listid. "' ";

                $sql .= " ORDER BY  user_default_prize_points_id DESC "; // to set ordr by

                $dataProvider1 = PrizePoints::model()->findAllBySql($sql); // this query get the total number of items

                // set the limit for the pagination
                $sql .= " LIMIT " . $offset . "," . Yii::app()->params['pageSize']; //this query contains all the data

                $dataProvider = PrizePoints::model()->findAllBySql($sql);

                $itemCount = count($dataProvider1); // total records
                $pages = new CPagination($itemCount);
                $pages->setPageSize(Yii::app()->params['pageSize']);

                $this->render('index', array(
                    'listid' => $listid,
                    'payment' => $payment,
                    'dataProvider' => $dataProvider,
                    'itemCount' => $itemCount,
                    'pageSize' => Yii::app()->params['pageSize'],
                    'pages' => $pages
                ));
            }
    }

    public function actionMakepayment()
    {
        $banner_link = Yii::app()->request->getParam('banner_link');
        $banner_path = Yii::app()->request->getParam('banner_path');
        $totalWeeks = Yii::app()->request->getParam('totalWeeks');
        $cost = Yii::app()->request->getParam('cost');
        $listid = Yii::app()->request->getParam('listid');

        // banner upload Path
        $bannerUploadPath = dirname('upload/' . $banner_path);

        // if it isn't a directory
        if (!is_dir($bannerUploadPath)) {
            umask(0);
            mkdir($bannerUploadPath, 0777); // make a dir
        }

        $arrBannerPath = array_reverse(explode('/', $banner_path)); //echo $arrBannerPath[0];exit;

        // move uploaded banner
        move_uploaded_file($_FILES['bannerImage']['tmp_name'], getcwd() . '/' . $bannerUploadPath . '/' . $arrBannerPath[0]);


        // EPayPal Process
        $d = new ExpressCheckout();

        $products = array(
            '0' => array(
                'NAME' => 'Banner Advertisement',
                'AMOUNT' => $cost,
                'QTY' => '1'
            ),
        );

        //$user = new User;
        $userData = User::model()->findByPk(Yii::app()->user->getId());
        $userAddressData = Useraddress::model()->findByAttributes('user_default_profile_id', Yii::app()->user->getId());
        $currenyCode = Currency::model()->getCurrencyCode($userData['user_default_currency']);
        $user_address = array($userAddressData['user_default_address1'], $userAddressData['user_default_address2'], $userAddressData['user_default_address3']);

        $shipping_address = array(
            'FIRST_NAME' => $userData['user_default_first_name'],
            'LAST_NAME' => $userData['user_default_surname'],
            'EMAIL' => $userData['user_default_email'],
            'MOB' => $userData['user_default_tel'],
            'ADDRESS' => $user_address,
            /*'SHIPTOSTREET'=>'mannarkkad',*/
            /* 'SHIPTOCITY'=>'palakkad',*/
            'SHIPTOSTATE' => $userAddressData['user_default_town'],
            'SHIPTOCOUNTRYCODE' => $userAddressData['user_default_county'],
            'SHIPTOZIP' => $userAddressData['user_default_zip']
        );

        $d->setShippingInfo($shipping_address); // set Shipping info Optional
        $x = new ECurrencyConverter();
        $x->currencyConverter();


        $d->setCurrencyCode($currenyCode);//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)
        $d->setProducts($products); /* Set array of products*/
        //$e->setShippingCost(5.5);/* Set Shipping cost(Optional) */

        $returnValues = array(
            'listid' => $listid,
            'banner_path' => $banner_path,
            'banner_link' => $banner_link,
            'totalWeeks' => $totalWeeks,
            'cost' => $cost
        );
        $encryptedData = SharedFunctions::encodeArrayAsString($returnValues);
        $d->returnURL = Yii::app()->getBaseUrl(true) . '/banner/bannerPaymentSuccess?returnData=' . $encryptedData;
        $d->cancelURL = Yii::app()->getBaseUrl(true) . '/banner/bannerPaymentCancel?returnData=' . $encryptedData; //bannerPaymentCancel
        $result = $d->requestPayment();

        /*  The response format from paypal for a payment request
        Array
        (
            [TOKEN] => EC-9G810112EL503081W
            [TIMESTAMP] => 2013-12-12T10:29:35Z
            [CORRELATIONID] => 67da94aea08c3
            [ACK] => Success
            [VERSION] => 65.1
            [BUILD] => 8725992
        )*/
        if (strtoupper($result["ACK"]) == "SUCCESS") {
            /*redirect to the paypal gateway with the given token */
            header("location:" . $d->PAYPAL_URL . $result["TOKEN"]);
        }

    }

    public function actionBannerPaymentSuccess()
    {
        $returnValues = isset($_REQUEST['returnData']) ? $_REQUEST['returnData'] : '';
        $decryptedData = SharedFunctions::decodeStringAsArray($returnValues);
        $e = new ExpressCheckout;
        $paymentDetails = $e->getPaymentDetails($_REQUEST['token']);
        if ($paymentDetails['ACK'] == "Success") {

            $ack = $e->doPayment($paymentDetails);  //2.Do payment

            // track financial transaction
            $financialTransactionId = SharedFunctions::processFinancialTransaction($ack);

            // move uploaded banner file process
            $uploadedBannerPath = $decryptedData['banner_path'];
            $fileName = basename($uploadedBannerPath);
            $moveUploadedBannerPath = 'banner-images/banners_users/'.Yii::app()->user->getState('username')."_".Yii::app()->user->getID();
            $banner_path = $moveUploadedBannerPath.'/'.$fileName;

            // if it isn't a directory
            if (!is_dir('upload/'.$moveUploadedBannerPath)) {
                umask(0);
                mkdir('upload/'.$moveUploadedBannerPath, 0777, true); // make a dir
            }

            // move uploaded banner to banner_users
            rename('upload/'.$uploadedBannerPath, 'upload/'.$banner_path);

            // save model process
            $model = new Bannerads();

            $model->user_default_listing_id = $decryptedData['listid'];
            $model->user_default_listing_banner_path = $banner_path;
            $model->user_default_listing_banner_link = $decryptedData['banner_link'];
            $model->user_default_listing_banner_duration = ($decryptedData['totalWeeks'] * 7 * 24).':'. date('i').':'. date('s'); //date('d-m-Y H:i:s', strtotime(('+'.$decryptedData['totalWeeks'].' week')));
            $model->user_default_listing_banner_cost = $decryptedData['cost'];
            $model->user_default_listing_banner_status = 0;
            $model->user_default_id = Yii::app()->user->getId();
            $model->user_default_listing_banner_submission_date = date('Y-m-d');
            $model->user_default_listing_banner_clicks = 0;

            if ($model->validate()) {

                $userModel = User::model()->findByPk(Yii::app()->user->getId());
                if ($model->save()) {

                    /* Mail code */
                    $template = MailTemplate::model()->findByAttributes(array("template_module" => 'banner_submission_notice'));
                    $bannerImage = "<img src='" . Yii::app()->getBaseUrl(true) . '/upload/' . $model->user_default_listing_banner_path . "' title='" . $model->user_default_listing_banner_link . "' style='width:100%;'/>";

                    $arrBannerPath = array_reverse(explode('/', $model->user_default_listing_banner_path));
                    $currency_code = $ack['CURRENCYCODE'];
                    $string = array(

                        '{{#BANNER_IMAGE#}}' => $bannerImage,
                        '{{#IMAGE_NAME#}}' => $arrBannerPath[0],
                        '{{#BANNER_SUBMITTED_DATE#}}' => SharedFunctions::convertDateAsDisplayFormat($model->user_default_listing_banner_submission_date, 'd/m/Y'),
                        '{{#BANNER_LINK#}}' => $model->user_default_listing_banner_link,
                        '{{#BANNER_UPDATE_LINK#}}' => Yii::app()->getBaseUrl(true) . '/banner/index?listid=' . $decryptedData['listid'],
                        '{{#BANNER_DURATION#}}' => $decryptedData['totalWeeks'] . ' days',
                        '{{#AMOUNT_PAID#}}' => $currency_code . $model->user_default_listing_banner_cost,
                        '{{#STATUS#}}' => 'Waiting Admin Approval & Publication',
                        '{{#USER_NAME#}}' => $userModel->user_default_first_name . ' ' . $userModel->user_default_surname,
                        '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email']

                    );

                    $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string); //echo $body; exit;
                    SharedFunctions::app()->sendmail($userModel->user_default_email, $template->template_subject, $body);

                    // Admin mail sent code
                    $template = MailTemplate::model()->findByAttributes(array("template_module" => 'banner_submission_notice_admin'));
                    $activelink = '<a href="' . Yii::app()->createAbsoluteUrl('/admin/banner/banner/update', array('id' => $model->user_default_listing_banner_id)) . '" target="_blank" >here </a>';

                    $string = array(
                        '{{#HERE#}}' => $activelink,
                        '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email']
                    );

                    $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
                    SharedFunctions::app()->sendmail(Yii::app()->params['adminEmail'], $template->template_subject, $body);

                }

            }

        } else {
            $this->actionBannerPaymentCancel();
        }

        $this->redirect('index?listid=' . $decryptedData['listid'] . '&paymentSuccess=confirm');
    }

    public function actionBannerPaymentCancel()
    {
        $returnValues = isset($_REQUEST['returnData']) ? $_REQUEST['returnData'] : '';
        $decryptedData = SharedFunctions::decodeStringAsArray($returnValues);

        // if file exists and unlink it
        if ($decryptedData['banner_path']) {
            if (file_exists('upload/' . $decryptedData['banner_path'])) {
                unlink('upload/' . $decryptedData['banner_path']);
            }
        }
        $this->redirect('index?listid=' . $decryptedData['listid']);

    }

    public function actionPayment()
    {
        $listid = Yii::app()->request->getParam('listid');
        $this->render('index', array('payment' => 'confirm'));
    }


    public function actionReject()
    {

        $listid = Yii::app()->request->getParam('code');


        if (Yii::app()->user->isGuest) {

            $this->render('login');

        } else {

            $modelReject = Banner::model()->findAllByPk($listid);

            $this->render('rejcted', array("model" => $modelReject));

        }


    }


    public function actionUpdate()
    {


        $id = Yii::app()->request->getParam('banner_id');

        $listid = Yii::app()->request->getParam('banner_list_id');

        $banner_path = Yii::app()->request->getParam('banner_link');

        $imagename = explode('/', $banner_path);

        $newimagename = array_reverse($imagename);

        $modelReject = Banner::model()->findByPk($id);

        $modelReject->user_default_listing_banner_path = $banner_path;

        $modelReject->user_default_listing_banner_status = 1;

        $modelReject->user_default_id = Yii::app()->user->getId();

        $modelReject->user_default_listing_banner_submission_date = date('Y-m-d');

        if ($modelReject->validate()) {

            $result = move_uploaded_file($_FILES['bannerImage']['tmp_name'], getcwd() . '/upload/banner-images/' . $newimagename[0]);

            if ($modelReject->save()) {

                $this->redirect(Yii::app()->createUrl('listing'));

            }

        } else {

            $this->redirect(Yii::app()->request->urlReferrer);

        }


    }


    public function actionUpdatehit()
    {
        $id = isset($_REQUEST['banner_id']) ? $_REQUEST['banner_id'] : '';
        if ($id) {
            $model = Bannerads::model()->findByPk($id);
            if ($model) {
                $model->user_default_listing_banner_clicks = ($model->user_default_listing_banner_clicks + 1);
                $model->save();
            }
        } else {

        }
    }


    public function actionUploadbaneer()
    {


    }


    public function actionActive()
    {


    }

    public function actionMarketing_payment($listid)
    {
        $d = new ExpressCheckout();
        $currencymodel = new Currency();
        if (Yii::app()->user->_user_Type == 'user') {
            $user = new User;
            $userData = User::model()->findByPk(Yii::app()->user->getId());
            $userAddressData = Useraddress::model()->findByAttributes('user_default_profile_id', Yii::app()->user->getId());
            $currenyCode = Currency::model()->getCurrencyCode($userData['user_default_currency']);
            $user_address = array($userAddressData['user_default_address1'], $userAddressData['user_default_address2'], $userAddressData['user_default_address3']);
        }
        if (Yii::app()->user->_user_Type == 'business') {
            $userData = Business::model()->findByPk(Yii::app()->user->getId());
            $userAddressData = Businessaddress::model()->findByAttributes('user_default_business_id', Yii::app()->user->getId());
            $currenyCode = Currency::model()->getCurrencyCode($userData['user_default_business_currency']);
            $user_address = array($userAddressData['user_default_business_addr1'], $userAddressData['user_default_business_addr2'], $userAddressData['user_default_business_addr3']);
        }

        $products = array(
            '0' => array(
                'NAME' => 'Listing Market',
                'AMOUNT' => Yii::app()->request->getParam('cost'),
                'QTY' => '1'
            ),
        );

        if (Yii::app()->user->_user_Type == 'user') {
            /*Optional */
            $shipping_address = array(
                'FIRST_NAME' => $userData['user_default_first_name'],
                'LAST_NAME' => $userData['user_default_surname'],
                'EMAIL' => $userData['user_default_email'],
                'MOB' => $userData['user_default_tel'],
                'ADDRESS' => $user_address,
                /*'SHIPTOSTREET'=>'mannarkkad',*/
                /* 'SHIPTOCITY'=>'palakkad',*/
                'SHIPTOSTATE' => $userAddressData['user_default_town'],
                'SHIPTOCOUNTRYCODE' => $userAddressData['user_default_county'],
                'SHIPTOZIP' => $userAddressData['user_default_zip']
            );
        }
        if (Yii::app()->user->_user_Type == 'business') {
            $shipping_address = array(
                'FIRST_NAME' => $userData['user_default_business_first_name'],
                'LAST_NAME' => $userData['user_default_business_surname'],
                'EMAIL' => $userData['user_default_business_email'],
                'MOB' => $userData['user_default_business_phone'],
                'ADDRESS' => $user_address,
                /*'SHIPTOSTREET'=>'mannarkkad',*/
                /* 'SHIPTOCITY'=>'palakkad',*/
                'SHIPTOSTATE' => $userAddressData['user_default_business_town'],
                'SHIPTOCOUNTRYCODE' => $userAddressData['user_default_business_country'],
                'SHIPTOZIP' => $userAddressData['user_default_business_zip']
            );
        }

        $d->setShippingInfo($shipping_address); // set Shipping info Optional
        $x = new ECurrencyConverter();
        $x->currencyConverter();


        $d->setCurrencyCode($currenyCode);//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)

        $d->setProducts($products); /* Set array of products*/

        // $e->setShippingCost(5.5);/* Set Shipping cost(Optional) */

        $data = array(
            'listid' => $listid,
            'cost' => Yii::app()->request->getParam('cost'),
            'purchasePoints' => Yii::app()->request->getParam('purchasePoints')
        );

        $listData = SharedFunctions::encodeArrayAsString($data);
        $d->returnURL = Yii::app()->getBaseUrl(true) . "/banner/paypalreturn/" . '?listdata=' . $listData;
        $d->cancelURL = Yii::app()->createAbsoluteUrl("banner/paypalcancel/", array('listid' => $listid));

        $result = $d->requestPayment();

        /*  The response format from paypal for a payment request
        Array
        (
            [TOKEN] => EC-9G810112EL503081W
            [TIMESTAMP] => 2013-12-12T10:29:35Z
            [CORRELATIONID] => 67da94aea08c3
            [ACK] => Success
            [VERSION] => 65.1
            [BUILD] => 8725992
        )
            */

        if (strtoupper($result["ACK"]) == "SUCCESS") {
            /*redirect to the paypal gateway with the given token */
            header("location:" . $d->PAYPAL_URL . $result["TOKEN"]);
        }

    }

    public function actionPaypalReturn()
    {

        $listData = SharedFunctions::decodeStringAsArray($_REQUEST['listdata']);
        $listid = $listData['listid'];
        $purchasePoints = $listData['purchasePoints'];
        $cost = $listData['cost'];

        $e = new ExpressCheckout;
        $paymentDetails = $e->getPaymentDetails($_REQUEST['token']);

        if ($paymentDetails['ACK'] == "Success") {
            $ack = $e->doPayment($paymentDetails);  //2.Do payment
            
            SharedFunctions::processFinancialTransaction($ack);
            if (Yii::app()->user->_user_Type == 'user') {
                $modelprizepoints = new PrizePoints();
                $modelprizepoints->user_default_listing_points_purchased = $purchasePoints;
                $modelprizepoints->user_default_listing_points_cost = $ack['AMT'];
                $modelprizepoints->user_default_listing_id = $listid;
                $modelprizepoints->user_default_listing_points_user_id = Yii::app()->user->getId();
                $modelprizepoints->user_default_listing_points_date = date('Y-m-d');
                $modelprizepoints->user_default_listing_points_time = date('H:i:s');
                $modelprizepoints->user_default_listing_points_required = '135';
                $modelprizepoints->save();
            }
            if (Yii::app()->user->_user_Type == 'business') {
                $modelbusinessprizepoints = new BusinessPrizePoints();
                $modelbusinessprizepoints->business_user_blisting_points_purchased = $purchasePoints;
                $modelbusinessprizepoints->business_user_blisting_points_cost = $cost;
                $modelbusinessprizepoints->business_user_blisting_id = $listid;
                $modelbusinessprizepoints->business_user_id = Yii::app()->user->getId();
                $modelbusinessprizepoints->business_user_blisting_points_date = date('Y-m-d');
                $modelbusinessprizepoints->business_user_blisting_points_time = date('H:i:s');
                $modelbusinessprizepoints->business_user_blisting_points_required = '135';
                $modelbusinessprizepoints->save();
            }

        }/*
echo Yii::app()->createAbsoluteUrl("banner/index/listid/$listid", array('displayDialog' => 1, 'purchasePoints' => $purchasePoints));die;*/
        $this->redirect(Yii::app()->createAbsoluteUrl("banner/index/listid/$listid", array('displayDialog' => 1, 'purchasePoints' => $purchasePoints)));
    }

    public function actionPaypalCancel()
    {
        $listid = $_REQUEST['listid'];
        /*The user flow  wil come here when a user cancels the payment */
        /*Do what you want*/
        $this->redirect("banner/index/listid/$listid");
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
                $message .= '<span style="color: #6b6d6e;">File types allowed:- pdf, rar, zip, and image files only.</span>';
            }

            if ((!$error) && ($attachement['size'] > self::$maxUploadFile)) {

                $error = TRUE;
                $message = "Attachment size not allowed.";

            }

        }

        if (!$error) {

            $fileToUploadPath = self::$uploadDirectoryPath . time() . "." . $attachement['name'];

            // Add time in file name to avoid conflict beetween files names
            $fileName = time() . "." . $attachement['name'];

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

    public function actionSend_message()
    {
        if ((Yii::app()->user->isGuest) && (empty(Yii::app()->user->Id))) {
            throw new CHttpException(302, "");
        }

        $userMessageInsertSuccessMessage = 'true';
        $blistingOwnerSendMailSuccess = 'true';
        $listingOwnerSendMailSuccess = 'true';
        $defaultUserMailSendSuccess = 'true';
        $businessUserMessageInsertSuccessMessage = 'true';

        $subject = Yii::app()->request->getParam('subject');
        $message = Yii::app()->request->getParam('message');
        $sector = Yii::app()->request->getParam('sector');
        $limitRequest = Yii::app()->request->getParam('limitRequest');
        $listid = Yii::app()->request->getParam('listid');
        $attachment = isset($_POST['attachment']) ? $_POST['attachment'] : '';

        $link = Yii::app()->getBaseUrl(true) . '/mymessage/mymessages/index';

        $sectorData = ($sector != 'all') ? ListingProfession::model()->findByAttributes(array('list_profession_id' => $sector)) : array();
        $userData = Business::model()->findByPk(Yii::app()->user->getId());
        $uName = ucwords($userData['user_default_business_first_name'] . ' ' . $userData['user_default_business_surname']);
        $uEmail = $userData['user_default_business_email'];

        $bodyMessage = rtrim(ltrim($message, "<p>"), "</p>");

        $userSubject = 'You have sent a message';
        $template = MailTemplate::getTemplate('default_user_send_query');
        $string = array(
            '{{#COMPANY_NAME#}}' => Yii::app()->params['company_name'],
            '{{#COMPANY_SIGNATURE#}}' => Yii::app()->params['signature'],
            '{{#MESSAGE#}}' => $bodyMessage,
            '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email'],
            '{{#SUBJECT#}}' => $subject,
            '{{#USERNAME#}}' => $uName,
            '{{#SECTOR#}}' => ($sector != 'all') ? $sectorData['list_profession_name'] : 'All',
            '{{#LIMITREQUEST#}}' => $limitRequest
        );

        $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);
        if (SharedFunctions::app()->sendmail($uEmail, $userSubject, $body, $attachment))
            $defaultUserMailSendSuccess = 'true';
        else
            $defaultUserMailSendSuccess = 'false';

        $criteria = new CDbCriteria;
        $criteria->join = "INNER JOIN {{business}} AS business ON (t.user_default_business_id = business.user_default_business_id)";
        $criteria->join .= "INNER JOIN {{business_profession}} AS bprofession ON (bprofession.list_profession_id = business.user_default_business_sector)";

        if ($sector != 'all') {
            $criteria->addCondition('business.user_default_business_sector', $sector);
        }
        $criteria->addCondition('business.user_default_business_status=1');
        if ($limitRequest != 'worldwide') {
            $criteria->addCondition('t.user_default_business_viewlimit', $limitRequest);
        }
        $businessUserData = Business::model()->findAll($criteria);

        $modelMessage = new ProfilesMessages();
        $modelMessage->user_default_listing_id = $listid;
        $modelMessage->subject = $subject;
        $modelMessage->message = $message;
        $modelMessage->user_default_profiles_id = Yii::app()->user->getId();
        $modelMessage->user_default_user_type = Yii::app()->user->_user_Type;
        $modelMessage->attachement = (Yii::app()->request->getParam('attachment')) ? Yii::app()->request->getParam('attachment') : 'NULL';
        $modelMessage->likes_total = '0';
        $modelMessage->dislikes_total = '0';
        $modelMessage->first_message = '1';
        $modelMessage->is_spam = '0';
        $modelMessage->notice_flag = '0';
        $modelMessage->created_date = date('Y-m-d H:i:s');
        if ($modelMessage->save())
            $userMessageInsertSuccessMessage = 'true';
        else
            $userMessageInsertSuccessMessage = 'false';

        foreach ($businessUserData as $record) {
            $modelSentMessage = new ProfilesMessagesSent();
            $modelSentMessage->msg_id = $modelMessage->id;
            $modelSentMessage->sender_user_id = Yii::app()->user->getId();
            $modelSentMessage->receiver_user_id = $record->user_default_business_id;
            if ($modelSentMessage->save())
                $businessUserMessageInsertSuccessMessage = 'true';
            else
                $businessUserMessageInsertSuccessMessage = 'false';

            $template = MailTemplate::getTemplate('Email_received_by_Recipients');
            $string = array(
                '{{#COMPANY_NAME#}}' => Yii::app()->params['company_name'],
                '{{#COMPANY_SIGNATURE#}}' => Yii::app()->params['signature'],
                '{{#MESSAGE#}}' => $bodyMessage,
                '{{#COMPANY_EMAIL#}}' => Yii::app()->params['company_email'],
                '{{#SUBJECT#}}' => $subject,
                '{{#LINK#}}' => $link,
                '{{#USERNAME#}}' => ucwords($record->user_default_business_first_name . ' ' . $record->user_default_business_surname),
                '{{#BUSINESSCOMPANYNAME#}}' => ''
            );

            $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

         
            if (SharedFunctions::app()->sendmail($businessUserData['user_default_business_email'], $template->template_subject, $body, $attachment))
                $blistingOwnerSendMailSuccess = 'true';
            else
                $blistingOwnerSendMailSuccess = 'false';

        }

        if ($userMessageInsertSuccessMessage == 'true' || $businessUserMessageInsertSuccessMessage == 'true') {
        } elseif ($blistingOwnerSendMailSuccess == 'true' && $defaultUserMailSendSuccess == 'true') {
        } elseif ($userMessageInsertSuccessMessage == 'false' || $businessUserMessageInsertSuccessMessage == 'false') {
            $messagedisplay = 'Message is could not be inserted!';
        } elseif ($blistingOwnerSendMailSuccess == 'false' && $defaultUserMailSendSuccess == 'false') {
            $messagedisplay = 'Mail could not sent';
        }

        $messageDisplay = ($messagedisplay != '') ? $messagedisplay : "success";
        echo CJSON::encode(array("messageDisplay" => $messageDisplay));

    }

}