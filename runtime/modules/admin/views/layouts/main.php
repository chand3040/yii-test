<?php /* @var $this Controller */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>

    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9"/>

    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/images/favicon.ico"/>

    <title><?php echo $this->pageTitle ? CHtml::encode($this->pageTitle) . ' - Business Supermarket' : 'Business Supermarket Admin'; ?></title>

    <?php

    $themepath = Yii::app()->theme->baseUrl;

    if (Yii::app()->user->isGuest) {

        Yii::app()->clientScript->registerCssFile($themepath . '/css/style.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/login.css');

    } else {

        $themepath = Yii::app()->theme->baseUrl;

        Yii::app()->clientScript->registerCoreScript('jquery');

        Yii::app()->clientScript->registerScriptFile($themepath . '/js/tinymce/tinymce.min.js');

        Yii::app()->clientScript->registerScriptFile($themepath . '/js/common.js');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/chosen.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/sample.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/tooltips.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/admin.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/VoiceOpinion.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/button.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/fonts/fonts.css');

        Yii::app()->clientScript->registerCssFile($themepath . '/css/business_listing.css');

        /*Yii::app()->clientScript->registerScriptFile($themepath . '/js/jquery-1.11.1.min.js?ver=3.3.1');*/

        Yii::app()->clientScript->registerCssFile($themepath . '/css/jquery.dataTables_themeroller.css');

        Yii::app()->clientScript->registerScriptFile($themepath . '/js/chosen.jquery.js');

        Yii::app()->clientScript->registerScriptFile($themepath . '/js/jquery.jcarousel.min.js');
        /* Fancybox code */

        Yii::app()->clientScript->registerCssFile($themepath . '/css/fancybox/jquery.fancybox-1.3.4.css');

        Yii::app()->clientScript->registerScriptFile($themepath . '/js/fancybox/jquery.easing-1.3.pack.js');

        Yii::app()->clientScript->registerScriptFile($themepath . '/js/fancybox/jquery.fancybox-1.3.4.pack.js');

        Yii::app()->clientScript->registerScriptFile($themepath . '/js/fancybox/jquery.mousewheel-3.0.4.pack.js');

        Yii::app()->clientScript->registerCssFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.forum.assets')) . '/css/forum.css');

        Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.forum.assets')) . '/js/common.js');

        Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.forum.assets')) . '/js/engine.js');


    }

    // current moduleId
    $currentControllerModuleId = Yii::app()->controller->module->id;

    // current controllerId
    $currentControllerId = Yii::app()->controller->id;

    // current controller's actionId
    $currentControllerActionId = Yii::app()->controller->action->id;

    ?>
    <script src="http://code.highcharts.com/highcharts.js"></script>
</head>
<body>
<div class="container">
    <?php if (!Yii::app()->user->isGuest) {
        $userInfo = Adminuser::model()->findByPk(Yii::app()->user->Id);
        $userdata = Member::model()->findByAttributes(array('user_default_username' => Yii::app()->user->getState('username')));
        ?>
        <div class="menu_header">
            <div class="admin_name">
                User: <span><?php echo Yii::app()->user->getState('username'); ?></span><br/>
                Name:
                <span> <?php echo !empty($userdata->attributes) ? $userdata->user_default_first_name : 'as'; ?></span>
            </div>
            <!--admin_name-->
            <div class="admin_status">
                Admin Status: <span><?php echo ($userInfo['status'] == 1) ? 'Super Admin' : 'Admin'; ?></span>
            </div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>

            <div class="menu">
                <ul>
                    <li class="<?php if ($currentControllerId == 'member') echo 'active' ?>">
                        <a href="<?php echo Yii::app()->createUrl('admin/member') ?>">Users</a>
                    </li>
                    <li class="<?php if ($currentControllerId == 'listings' || $currentControllerId == 'blisting') echo 'active' ?>">
                        <a href="<?php echo Yii::app()->createUrl('admin/listings/listings/index') ?>">Listings</a>
                    </li>
                    <li class=""><a href="#">Auctions</a></li>
                    <li class=""><a href="#">Funding</a></li>
                    <li><a href="#">Samples</a></li>
                    <li class="<?php if ($currentControllerId == 'banner' || $currentControllerId == 'index') echo 'active' ?>">
                        <a href="<?php echo Yii::app()->createUrl('admin/banner/banner/index') ?>"> Banner Adverts</a>
                    </li>
                    <li class=""><a href="#">Website Info</a></li>
                    <li class="<?php if ($currentControllerModuleId == 'admin/website' || $currentControllerModuleId == 'admin/faq') echo 'active' ?>">
                        <a href="<?php echo Yii::app()->createUrl('admin/website') ?>">Website</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl('/admin/logout') ?>"
                           title="LogOut"><b>LogOut</b></a></li>
                </ul>
            </div>
            <!--menu-->
            <div class="profile_img">
                <?php
                $user_dirname = strtolower($userdata->user_default_username) . '_' . $userdata->user_default_id . '/images';
                if ($userdata->user_default_profile_image) {
                    if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/' . $userdata->user_default_profile_image))
                        $img = $this->createUrl('/upload/users/' . $user_dirname . '/' . $userdata->user_default_profile_image);
                    else
                        $img = $this->createUrl('/upload/logo/avatar.jpg');
                    $alt_img = $userdata->user_default_first_name . ' ' . $userdata->user_default_surname;
                } else {
                    $img = $this->createUrl('/upload/logo/avatar.jpg');
                    $alt_img = 'Avatar';
                }
                ?>
                <img src="<?php echo $img; ?>" alt="<?php echo $alt_img; ?>"/>
            </div>
        </div> <!--menu_header-->
    <?php } ?>
    <div class="main_content">

        <?php
        echo $content;
        ?>
    </div>
    <!--main_content-->

</div>
<!--container-->
</body>
</html>


