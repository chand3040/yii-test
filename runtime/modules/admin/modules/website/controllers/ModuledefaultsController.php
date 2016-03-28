<?php


class ModuledefaultsController extends Controller
{

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
            array('allow', // allow authenticated user to perform 'index' action
                'actions' => array('index', 'update', 'currencysymbol'),
                'users' => array('@'),
            ),
            /*array('deny',  // deny all users
                'users' => array('*'),
            ),*/
        );
    }

    public function actionIndex($currency_id = false)
    {
        $currency_id = isset($_REQUEST['currency_id']) ? $_REQUEST['currency_id'] : '';
        $currency_symbol = '$';
        if ($currency_id) {
            $currency_code = Currency::model()->findByPk($currency_id)->currency_code;
            $currency_symbol = SharedFunctions::_get_currency_symbol($currency_code);
        }
        $this->render('index', array('currency_id' => $currency_id));
    }

    public function actionUpdate()
    {
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['WebsiteDefaults'])) {
            if (!empty($_POST['WebsiteDefaults'])) {

                foreach ($_POST['WebsiteDefaults'] as $data) {

                    $model = new WebsiteDefaults;
                    if ($data['id'] != '') {
                        $model = WebsiteDefaults::model()->findByPk($data['id']);
                    }
                    $model->attributes = $data; //print_r($model->attributes);
                    $return = $model->save();
                    if ($return) {
                        //echo CJSON::encode(array("action_status"=>'1',"message" => 'Success'));
                        echo "ID :" . $model->id . " saved..";
                    } else {
                        //echo CJSON::encode(array("action_status"=>'0',"message" => 'Fail'));
                        echo "Not saved.";
                    }
                }
            }
        }
    }

    public function actionCurrencySymbol()
    {
        $currency_id = isset($_REQUEST['currency_id']) ? $_REQUEST['currency_id'] : '';
        $currency_symbol = '';
        if ($currency_id) {
            $currency_code = Currency::model()->findByPk($currency_id)->currency_code;
            $currency_symbol = SharedFunctions::_get_currency_symbol($currency_code);
        }
        echo $currency_symbol;
    }

}