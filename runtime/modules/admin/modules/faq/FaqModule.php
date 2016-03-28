<?php
class FaqModule extends CWebModule
{
    public $defaultController = 'section';
    public function init()
    {
        $this->setImport(array(
            'faq.models.*',
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
            return true;
        } else
            return false;
    }
}