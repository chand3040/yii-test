<?php

class AdminModule extends CWebModule

{


    public function init()

    {


        // this method is called when the module is being created

        // you may place code here to customize the module or the application

        //$this->setModules(array('imgModule'));

        // import the module-level models and components

        $this->setImport(array(

            'admin.models.*',

            'admin.components.*',

            'admin.extension.*',

            'admin.modules.*'

        ));

        $this->setComponents(array(

            'errorHandler' => array(

                'errorAction' => 'site/error'),

            'user' => array(

                'class' => 'CWebUser',

                'loginUrl' => Yii::app()->createUrl('/admin/login'),

            )

        ));


        Yii::app()->user->setStateKeyPrefix('_admin');

    }


    public function beforeControllerAction($controller, $action)

    {


        if (parent::beforeControllerAction($controller, $action)) {

            // this method is called before any module controller action is performed

            // you may place customized code here

            $controller->layout = 'column2';

            $route = $controller->id . '/' . $action->id;

            // echo $route;  

            $publicPages = array(

                'login/index',

                'site/error',

                'dashboard/exportnewregistration'

            );

            if (Yii::app()->user->isGuest && !in_array($route, $publicPages)) {

                // The following six lines is for re-directing to admin/new, can be deleted after the demo
                $currentModule = Yii::app()->controller->module->id;
                if ($currentModule == 'admin/new') {
                    if (Yii::app()->user->getState('setReturnUrl_admin_new') == false)
                        Yii::app()->user->setState('setReturnUrl_admin_new', true);
                } else
                    Yii::app()->user->setState('setReturnUrl_admin_new', false);

                Yii::app()->getModule('admin')->user->loginRequired();

            } else {

                Yii::app()->widgetFactory->widgets['CBreadcrumbs'] = array('homeLink' => CHtml::link('Admin', array('/admin')));

                return true;

            }

        } else

            return false;

    }

}

