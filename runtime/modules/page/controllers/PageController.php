<?php

class PageController extends Controller
{
	public function actionIndex($slug)
	{
		if(Yii::app()->request->getParam('id')){
			$this->pageTitle='Faq - Business Supermarket';    
			$id=Yii::app()->request->getParam('id');
			$criteria = new CDbCriteria;
	        $criteria->condition = "t.id = '$id'";
	        $m = UserSectioninfo::model()->find($criteria);
	        $this->render('faq',array('model'=>$m,'faqpage'=>'faqpage'));
			exit;
		}	
		if(!$slug)
			throw new CHttpException(404,'The requested page does not exist.');

		$model=Contents::model()->find(array('condition'=>"page_seo='$slug' AND status=1"));
		if(!$model)
		      throw new CHttpException(404,'The requested page does not exist.');
		else{        
		$this->pageTitle=$model->meta_title. ' - Business Supermarket';        
		$this->metaDesc=$model->meta_desc;
		$this->metaKeys=$model->meta_keywords;        
		$this->render('index',array('model'=>$model));
		}
	}
}