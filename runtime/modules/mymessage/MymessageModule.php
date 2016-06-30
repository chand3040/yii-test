<?php

class MymessageModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'mymessage.models.*',
			'mymessage.components.*',
			'application.modules.admin.components.*'
		));

		 $this->setComponents(array(

            'errorHandler' => array(

                'errorAction' => 'site/error'),

            'user' => array(

                'class' => 'CWebUser',
                "returnUrl"=>Yii::app()->createUrl('mymessage'),

                'loginUrl' => Yii::app()->createUrl('site/guestLogin'),

            )

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
