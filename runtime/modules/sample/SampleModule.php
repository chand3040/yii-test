<?php
/**
 * Created by PhpStorm.
 * User: jats007
 * Date: 20-08-2016
 * Time: 12:43
 */


class SampleModule extends CWebModule
{
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'sample.models.*',
            'sample.components.*',
            'application.modules.admin.components.*'
        ));

    }

    public function beforeControllerAction($controller, $action)
    {

        if(parent::beforeControllerAction($controller, $action))
        {


            if(Yii::app()->user->isGuest)
            {

                Yii::app()->controller->redirect('site/guestLogin?redirectto='.urlencode(Yii::app()->request->url));
            }
            else
            {

                return true;
            }
        }
        else
            return false;

    }
}
