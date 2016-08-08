<?php


class ContactController extends Controller
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
                'actions' => array('index'),
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

        // Set default value to numbe of member record
        Yii::app()->user->setState('pageSize', 10);

        if (isset($_POST['more_record'])) {
            Yii::app()->user->setState('pageSize', $_POST['more_record']);
            unset($_POST['more_record']);
        }

        $this->render('index');

    }

}

