<?php


class WebsiteModule extends CWebModule
{

    public $defaultController = 'moduledefaults';

    public function init()
    {

        $this->setImport(array(

            'website.models.*',
            'banner.models.*',
            'banner.components.*',
            'application.models.WebsiteDefaults',
            'application.models.SiteDefaults'
        ));


        $this->setComponents(array(

            'errorHandler' => array(

                'errorAction' => 'admin/default/error'),

            'user' => array(

                'class' => 'CWebUser',

                'loginUrl' => Yii::app()->createUrl('admin/default/login'),

            )

        ));

        $this->layoutPath = Yii::getPathOfAlias('application.modules.admin.views.layouts');

    }


    public function beforeControllerAction($controller, $action)
    {

        if (parent::beforeControllerAction($controller, $action)) {

            // this method is called before any module controller action is performed

            // you may place customized code here

            return true;

        } else

            return false;

    }

}

