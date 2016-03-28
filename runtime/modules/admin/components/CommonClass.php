<?php

class CommonClass extends CComponent
{

    public function getSlug($string)
    {
        $new_string = preg_replace("/[^a-zA-Z0-9-\@\$ \s]/", "", strtolower(strip_tags($string)));
        $rep_string = str_replace(" ", "-", trim($new_string));
        $rep_string = preg_replace('/-+/', '-', $rep_string);
        $ret_string = preg_replace('/\'/', '', $rep_string);
        return $ret_string;
    }

    public function makePageSlug($model, $title, $id)
    {
        $slug = CommonClass::getSlug($title);
        $criteria = new CDbCriteria;
        $criteria->condition = "id <> '$id' AND page_seo = '$slug'";
        if ($model->findAll($criteria)) {
            $slug = $slug . $id;
        }

        $model->updateByPk($id, array('page_seo' => $slug));
        return true;
    }

    public function Download($file)
    {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"'); //<<< Note the " " surrounding the file name
            header('Content-Transfer-Encoding: binary');
            header('Connection: Keep-Alive');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }

    public static function getUserStatusLabel($status)
    {

        $drgStatusLabels = array(0 => 'Pending Activation', 1 => 'Activated', 2 => 'Suspend');

        return $drgStatusLabels[$status];

    }

    public static function getUkDate($date)
    {

        return date("d/m/y", strtotime($date));

    }

    public static function getMySqlDate($date)
    {

        if (empty($date)) {

            return NULL;
        }

        $date = explode("/", $date);

        return "20" . $date[2] . "-" . $date[1] . "-" . $date[0];

    }

    public static function getLoggedInUsersByCriteria($criteria = NULL)
    {

        $usersLogguedIn = array();

        $sql1 = "SELECT log_id";
        $sql1 .= " FROM user_default_log_types";
        $sql1 .= " WHERE log_type IN('Login', 'Logout')";
        $sql1 .= " ORDER BY log_type ASC";
        $logType = Yii::app()->db->createCommand($sql1)->queryAll();
        $loginType = $logType[0]['log_id'];
        $logoutType = $logType[1]['log_id'];

        $sql2 = "SELECT user_default_id";
        $sql2 .= " FROM user_default_profiles";
        $sql2 .= ($criteria !== NULL) ? " WHERE " . $criteria : "";
        $users = Yii::app()->db->createCommand($sql2)->queryAll();

        foreach ($users as $u) {

            $sql3 = "SELECT transaction_date";
            $sql3 .= " FROM user_default_log_transaction";
            $sql3 .= " WHERE user_default_id = {$u[user_default_id]} AND log_id = '{$loginType}'";
            $sql3 .= " ORDER BY transaction_id desc";
            $sql3 .= " LIMIT 0, 1;";
            $trnsDate = Yii::app()->db->createCommand($sql3)->queryAll();

            if (count($trnsDate) > 0) {

                $trnsDateValue = $trnsDate[0]['transaction_date'];

                $sql4 = "SELECT COUNT(*) AS login";
                $sql4 .= " FROM user_default_log_transaction";
                $sql4 .= " WHERE user_default_id = '{$u['user_default_id']}' AND log_id = '{$logoutType}' AND transaction_date > '{$trnsDateValue}'";
                $trnsLogguedIn = Yii::app()->db->createCommand($sql4)->queryAll();
                $logguedInCount = $trnsLogguedIn[0]['login'];

                if ($logguedInCount == 0) {
                    $usersLogguedIn[] = $u['user_default_id'];
                }
            }
        }

        return $usersLogguedIn;

    }

    public static function convertDateAsDisplayFormat($date, $format)
    {
        if ($date && ($date != '0000-00-00' || $date != '0000-00-00 00:00:00')) {
            return date($format, strtotime(str_replace('/', '-', $date)));
        }
        return "";
    }

    public static function convertDateAsMySQLFormat($date)
    {
        if ($date && ($date != '0000-00-00' || $date != '0000-00-00 00:00:00')) {
            return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $date)));
        }
        return "";
    }

    public static function getCountryNameByDefaultUser($user_id)
    {

        $criteria = new CDbCriteria;

        $criteria->select = 'country.user_default_country_name as user_default_country';
        $criteria->join .= 'LEFT JOIN user_default_country AS country ON ( country.user_default_country_id = t.user_default_country)';

        $criteria->condition = 'user_default_profile_id=:user_default_profile_id';
        $criteria->params = array(':user_default_profile_id' => $user_id);
        $model = Useraddress::model()->find($criteria);
        if ($model) {
            return $model->user_default_country;
        }
        return '';
    }

    public static function getCountryNameByBusinessUser($user_id)
    {

        $criteria = new CDbCriteria;

        $criteria->select = 'country.user_default_country_name as user_default_business_country';
        $criteria->join .= 'LEFT JOIN user_default_country AS country ON ( country.user_default_country_id = t.user_default_business_country)';

        $criteria->condition = 'user_default_business_country=:user_default_business_country';
        $criteria->params = array(':user_default_business_country' => $user_id);
        $model = Businessaddress::model()->find($criteria);
        if ($model) {
            return $model->user_default_business_country;
        }
        return '';
    }

    public static function getProfessionUsersCount($professionId, $month)
    {
        $criteria = new CDbCriteria;

        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_profession = t.profession_id)";
        $criteria->addCondition('t.profession_id=' . $professionId . ' AND MONTH(profile.user_default_registration_date)=' . $month . ' AND Year(profile.user_default_registration_date)=' . date('Y'));

        $resultProfessionUsers = Profession::model()->count($criteria);
        return $resultProfessionUsers;
    }

    public static function getToDateProfessionUsersCount($professionId)
    {
        $criteria = new CDbCriteria;

        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_profession = t.profession_id)";
        $criteria->addCondition('t.profession_id=' . $professionId . ' AND Year(profile.user_default_registration_date) < ' . date('Y'));

        $resultProfessionUsers = Profession::model()->count($criteria);
        return $resultProfessionUsers;
    }

    public static function getProfessionUsersCountOnline($professionId)
    {
        $criteria = new CDbCriteria;

        $criteria->select = 't.log_id';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_id)";
        $criteria->condition = "profile.user_default_profession = '" . $professionId . "' AND t.datetime > SUBTIME('" . date('Y-m-d H:i:s') . "', '00:30:00') AND t.log_id <> 14";
        $criteria->group = "profile.user_default_id";

        $user_activity = ActivityLog::model()->findAll($criteria);
        if ($user_activity) {
            return count($user_activity);
        } else
            return 0;
    }

    public static function getBusinessProfessionUsersCount($professionId, $month)
    {

        if ($professionId) {

            $criteria = new CDbCriteria;

            $criteria->join = "INNER JOIN user_default_business AS profile ON (profile.user_default_business_sector = t.list_profession_id)";
            $criteria->addCondition('t.list_profession_id=' . $professionId . ' AND MONTH(profile.user_default_business_rdate)=' . $month . ' AND Year(profile.user_default_business_rdate)=' . date('Y'));

            $resultProfessionUsers = BusinessProfession::model()->count($criteria);
            return $resultProfessionUsers;
        }
        return false;

    }

    public static function getToDateBusinessProfessionUsersCount($professionId)
    {

        if ($professionId) {

            $criteria = new CDbCriteria;

            $criteria->join = "INNER JOIN user_default_business AS profile ON (profile.user_default_business_sector = t.list_profession_id)";
            $criteria->addCondition('t.list_profession_id=' . $professionId . ' AND Year(profile.user_default_business_rdate) < ' . date('Y'));

            $resultProfessionUsers = BusinessProfession::model()->count($criteria);
            return $resultProfessionUsers;
        }
        return false;

    }

    public static function getBusinessProfessionUsersCountOnline($professionId)
    {
        if ($professionId) {
            $criteria = new CDbCriteria;

            $criteria->select = 't.log_id';
            $criteria->join = "INNER JOIN user_default_business AS profile ON (profile.user_default_business_id = t.user_default_id)";
            $criteria->condition = "profile.user_default_business_sector = '" . $professionId . "' AND t.datetime > SUBTIME('" . date('Y-m-d H:i:s') . "', '00:30:00') AND t.log_id <> 14";
            $criteria->group = "profile.user_default_business_id";

            $user_activity = ActivityLog::model()->findAll($criteria);
            if ($user_activity) {
                return count($user_activity);
            } else
                return 0;
        }
        return false;
    }


}

?>