<?php


class SitedefaultsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.

     */
    public $layout = '//layouts/column2';


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

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'update'),
                'users' => array('@'),
            ),

            array('deny',  // deny all users
                'users' => array('*'),
            ),

        );

    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    // update a site default
    public function actionUpdate()
    {
        if (isset($_POST['SiteDefaults'])) {

            $model = new SiteDefaults;
            if ($_POST['SiteDefaults']['user_default_site_default_id'] != '') {
                $model = SiteDefaults::model()->findByPk($_POST['SiteDefaults']['user_default_site_default_id']);
            }
            $model->attributes = $_POST['SiteDefaults'];
            if ($model->save()) {
                echo CJSON::encode(array("status" => '1', "message" => 'Success'));
            } else {
                echo CJSON::encode(array("status" => '0', "message" => 'Failed'));
            }
        }
    }

    // funtion to call console app and execute the command
    /*public function actionClearThroughConsoleApp()
    {
        if (isset($_REQUEST['days']) && isset($_REQUEST['specific'])) {

            Yii::import('application.commands.*');
            $command = new ClearEntriesCommand('start', 'start');
            $command->run(array('clear', "--days={$_REQUEST['days']}", "--specific={$_REQUEST['specific']}"));
        }
    }*/

}

