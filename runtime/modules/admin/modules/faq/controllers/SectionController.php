<?php
class SectionController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'index' action
                'actions' => array('index', 'delete', 'editfaq', 'deletefaq', 'getfaqs', 'create', 'displayfaq', 'videos', 'addvideo', 'editvideo', 'deletevideo', 'edit','addinfo'),
                'users' => array('@'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('sections', array());
    }
    public function actionCreate()
    {
        $m = new UserSections();
        if(Yii::app()->request->getParam( 'title' )){
            $m->title=Yii::app()->request->getParam('title');
            if($m->validate()){
                $m->save();
                $data["success"]="Section has been created successfully.";
                $this->render('index',array('m'=>$m, 'data'=>$data));
                exit;
            }else{
                $this->render('index',array('m'=>$m));
                exit;
            }
        }
        $this->render('index',array('m'=>$m));
    }

    public function actionEdit()
    {
        $id = Yii::app()->request->getParam( 'id' );
        $criteria = new CDbCriteria;
        $criteria->condition = "t.id = '$id'";
        $m = UserSections::model()->find($criteria);

        if(Yii::app()->request->getParam('btnupdate')){
            $m->title=Yii::app()->request->getParam('title');
            $m->save();
            $data["success"]="Section has been Updated successfully.";
            $this->render('edit',array('m'=>$m, 'data'=>$data));    
            exit;
        }
        $this->render('edit',array('m'=>$m));
    }

    public function actionDelete()
    {
        if(Yii::app()->request->getParam('id')){
            $id=Yii::app()->request->getParam('id');
            $criteria = new CDbCriteria;
            $criteria->condition = "t.id = '$id'";
            $m = UserSections::model()->find($criteria);
            $m->delete();
            $this->redirect(array('/admin/faq'));
        }
    }

    public function actionAddinfo()
    {
        $m = new UserSectioninfo();
        if(Yii::app()->request->getParam('submit')){
            $m->section_id=Yii::app()->request->getParam('section_id');
            $m->info_title=Yii::app()->request->getParam('info_title');
            $m->info_content=Yii::app()->request->getParam('info_content');
            if($m->validate()){
                $m->save();
                $data["success"]="Information successfully Stored";
                $this->render('addinfo',array('m'=>$m, 'data'=>$data));
                exit;
            }else{
                $this->render('addinfo',array('m'=>$m));
                exit;
            }
        }
        $this->render('addinfo',array('m'=>$m));
    }
    public function actionDisplayfaq(){
        $this->render('displayfaq');
    }
    public function actionGetfaqs(){
        if(Yii::app()->request->getParam('action')=="get_faqs"){
            $id=Yii::app()->request->getParam('sec_id');
            $m = UserSectioninfo::model()->findAllByAttributes(array("section_id"=>$id),array('order'=>'id'));
            $html="<table class='table table-striped'><tr><td>#</td><td>Title</td><td>Edit</td><td>Delete</td></tr>";
            foreach($m as $key=>$d){
                $html.="<tr><td>".($key+1)."</td><td>$d->info_title</td><td><a href='".Yii::app()->createUrl('/admin/faq/section/editfaq')."?id=".$d->id."'>Edit</a></td><td>".
                "<a href='".Yii::app()->createUrl('/admin/faq/section/deletefaq')."?id=".$d->id."'>Delete</a></td></tr>";
            }
            $html.="</table>";
            echo $html;
            exit;
        }
    }
    public function actionEditfaq(){
        $id = Yii::app()->request->getParam( 'id' );
        $criteria = new CDbCriteria;
        $criteria->condition = "t.id = '$id'";
        $m = UserSectioninfo::model()->find($criteria);
        if(Yii::app()->request->getParam('submit')){
            $m->section_id=Yii::app()->request->getParam('section_id');
            $m->info_title=Yii::app()->request->getParam('info_title');
            $m->info_content=Yii::app()->request->getParam('info_content');
            $m->save();
            $data["success"]="Section has been Updated successfully.";
            $this->render('editfaq',array('m'=>$m, 'data'=>$data));    
            exit;
        }
        $this->render('editfaq',array('m'=>$m));
    }
    public function actionDeletefaq(){
        if(Yii::app()->request->getParam( 'id' )){
            $id = Yii::app()->request->getParam( 'id' );
            $criteria = new CDbCriteria;
            $criteria->condition = "t.id = '$id'";
            $m = UserSectioninfo::model()->find($criteria);
            $m->delete();
            $this->redirect(array('/admin/faq/section/displayfaq'));
        }
    }
    public function actionVideos(){
        $m = UserSectionvideos::model()->findAll(array("order"=>"id"));
        $this->render('showvideos',array('model'=>$m));
    }
    public function actionAddvideo(){
        $m = new UserSectionvideos();

        $basePath= yii::app()->basePath;
        $baseurl=yii::app()->getBaseUrl(true);
        $error="";
        if(Yii::app()->request->getParam('submit')){
            $m->title=$_POST["title"];
            $ext=$_FILES['video_url']['name'];
            $ext=explode(".", $ext);
            $ext=$ext[count($ext)-1];
            $allowed=array("mp4","webm","flv");
            if(in_array($ext, $allowed)){
                $uploaddir = $basePath.'/../www/upload/videos/';
                $filename=basename(time().$_FILES['video_url']['name']);
                $uploadfile = $uploaddir.$filename;
                $showname=  $baseurl."/upload/videos/".$filename;
                if (!file_exists($uploaddir)) {
                    mkdir("$uploaddir" . $dirname, 0777);
                    exit;
                }
                if (move_uploaded_file($_FILES['video_url']['tmp_name'], $uploadfile)) {
                    $m->video_url=$showname;
                    $m->status=1;
                    $m->save();
                    $data["success"]="Section has been Updated successfully.";
                    $this->render('addvideo',array('m'=>$m, 'data'=>$data));
                    exit;
                } else {
                    $error="Error while uploading file.";
                }
            }else{
                $error="File Type Not allowed, only mp4, webm and flv files are allowed.";
            }
        }
        $this->render('addvideo',array('model'=>$m, "error"=>$error));
    }
    public function actionDeletevideo(){
        if(Yii::app()->request->getParam('id')){
            $id = Yii::app()->request->getParam( 'id' );
            $criteria = new CDbCriteria;
            $criteria->condition = "t.id = '$id'";
            $m = UserSectionvideos::model()->find($criteria);
            $m->delete();
            $this->redirect(array('/admin/faq/section/videos'));
        }
    }
    public function actionEditvideo(){
        $basePath= yii::app()->basePath;
        $baseurl=yii::app()->getBaseUrl(true);
        if(Yii::app()->request->getParam('submit')){
            $id = Yii::app()->request->getParam( 'id' );
            $criteria = new CDbCriteria;
            $criteria->condition = "t.id = '$id'";
            $m = UserSectionvideos::model()->find($criteria);
            $m->title=$_POST["title"];
            $error='';
            if(strlen($_FILES['video_url']['name'])>0){
                $ext=$_FILES['video_url']['name'];
                $ext=explode(".", $ext);
                $ext=$ext[count($ext)-1];
                $allowed=array("mp4","webm","flv");
                if(in_array($ext, $allowed)){
                    $uploaddir = $basePath.'/../www/upload/videos/';
                    $filename=basename(time().$_FILES['video_url']['name']);
                    $uploadfile = $uploaddir.$filename;
                    $showname=  $baseurl."/upload/videos/".$filename;
                    
                    if (move_uploaded_file($_FILES['video_url']['tmp_name'], $uploadfile)) {
                        $m->video_url=$showname;
                    } else {
                        $error="Error while uploading file.";
                    }
                }else{
                    $error="File Type Not allowed, only mp4, webm and flv files are allowed.";
                }
            }
            $m->status=1;
            $m->save();
            $data["success"]="Section has been Updated successfully.";
            $this->render('editvideo',array('model'=>$m, 'data'=>$data, 'error'=>$error));
            exit;
        }

        if(Yii::app()->request->getParam('id')){
            $id = Yii::app()->request->getParam( 'id' );
            $criteria = new CDbCriteria;
            $criteria->condition = "t.id = '$id'";
            $m = UserSectionvideos::model()->find($criteria);
            $this->render('editvideo',array('model'=>$m));
        }
    }
}