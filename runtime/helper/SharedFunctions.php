<?php

class SharedFunctions
{

    /**   $replceString = array(
     * '{{#USERNAME#}}'=>'',
     * '{{#COMPANY_NAME#}}'=>'',
     * '{{#COMPANY_EMAIL#}}'=>'',
     * '{{#COMPANY_ADDRESS#}}'=>'',
     * '{{#BASEURL#}}'=>'',
     * '{{#THEME_BASEURL#}}'=>'',
     * '{{#ACCOUNT_ACTIVATION_LINK#}}'=>'',
     * '{{#COMPANY_SIGNATURE#}}'=>''
     * );
     **/

    public static function app()
    {
        return new SharedFunctions();
    }

    public static function sendmail($to = "", $subject = "", $body = "", $attachment = "", $cc = false, $from = "")
    {

        $mail = new YiiMailer();

        // Check From mail set or not

        if ($from) {
            $mail->setFrom($from, Yii::app()->params['company_name']);
        } else if ($from == "") {
            $mail->setFrom(Yii::app()->params['company_email'], Yii::app()->params['company_name']);
        }

        // check to mail  more then one persone
        if ($to != "" || !empty($to)) {
            $mail->setTo($to);
        }


        // check if any mail sent to cc more then one person
        if ($cc != "" || !empty($cc)) {
            $mail->setCc($cc);
        }


        // Check subject is empty
        if ($subject != "") {
            $mail->setSubject($subject);
        }

        // Check any attachment or not
        if ($attachment != "" || !empty($attachment)) {
            $mail->setAttachment($attachment);
        }

        // check body empty or not
        if ($body != "" || !empty($body)) {
            $newstring = str_replace("{{BR}}", "<br />", $body);
            $mail->setBody($newstring);
        }

        if ($mail->send()) {
            return true;
        }
        return false;
    }

    public static function mailStringReplace($string = "", $replceString = "")
    {

        if (is_array($replceString)) {

            $newstring = $string;

            foreach ($replceString as $key => $val) {
                $newstring = str_replace($key, $val, $newstring);

            }

        }
        return $newstring;
    }

    public static function randvalue()
    {

        $random = substr(str_replace(" ", "", date('Y m d')), 0, 10) . substr(md5(time()), 1, 5) . substr(str_replace(".", "", Yii::app()->request->getUserHostAddress()), 0, 15) . md5(substr(number_format(time() * rand(), 0, '', ''), 0, 5));
        return $random;

    }


    /*Password check*/

    public static function encrypt_code($string)
    {

        if ($string != "") {
            return md5($string);
        }

    }

    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function check_captch($val)
    {

        if ($securimage->check($val) == false) {
            echo CJSON::encode(array('success' => false, 'message' => "Incorrect security code entered !", 'captcha' => true));
            Yii::app()->end();
        }
    }

    public static function insert_log($arrayData)
    {

        if (is_array($arrayData)) {
            $log = new Logtransaction();
            $log->member_id = $arrayData['member_id'];
            $log->log_id = $arrayData['log_id'];
            $log->transaction_description = $arrayData['description'];
            $log->transaction_date = date('Y-m-d h:i:s');
            $log->save();
        }

    }

    public static function age($birthday)
    {

        list($day, $month, $year) = explode("/", $birthday);

        $year_diff = date("Y") - $year;

        $month_diff = date("m") - $month;

        $day_diff = date("d") - $day;

        if ($day_diff < 0 && $month_diff == 0) {
            $year_diff--;
        }

        if ($day_diff < 0 && $month_diff < 0) {
            $year_diff--;
        }

        return $year_diff;
    }

    public static function calculateage($dob)
    {
        $dob = date("Y-m-d", strtotime($dob));
        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();
        $diff = $dobObject->diff($nowObject);
        return $diff->y;
    }

    function first_last_date($d = '')
    {
        $d = $d ? $d : time();
        $f = mktime(0, 0, 0, date("n", $d), 1, date("Y", $d));
        $l = mktime(0, 0, 0, date("n", $d), date("t", $d), date("Y", $d));
        return array($f, $l);
    }


    public static function get_user_names($d = '')
    {
        $row = Yii::app()->db->createCommand(array(
            'select' => array('user_default_username '),
            'from' => 'user_default_profiles',
            'where' => 'user_default_id=:drg_uid',
            'params' => array(':drg_uid' => $d),
        ))->queryRow();
        return $row[""];
    }

    public static function get_listingcat($d = '')
    {
        $row = Yii::app()->db->createCommand(array('select' => array('user_default_listing_category_name '), 'from' => 'user_default_listing_category', 'where' => 'user_default_listing_category_id=:list_category_id', 'params' => array(':list_category_id' => $d),))->queryRow();
        if ($row[""] != "") {
            return $row[""];
        } else {
            return "Default";
        }
    }

    public static function get_listingtype($d = '')
    {
        if ($d == "0") {
            return "Pending";
        } else {
            return "Published";
        }

    }

    /* user  for banner current symbol*/

    public static function _get_currency_symbol($CurrencyCode)
    {
        $symbol = '';
        if ($CurrencyCode != "") {
            switch ($CurrencyCode) {
                case 'USD':
                    $symbol = '$';
                    break;
                case 'GBP':
                    $symbol = '&pound;';
                    break;
                case 'EUR':
                    $symbol = '&euro;';
                    break;
                default :
                    $symbol = $CurrencyCode;

            }

        }
        return $symbol;
    }

    public static function time_elapsed_string($datetime, $full = false)
    {

        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) : 'just now';
    }

    public static function createThumbs($pathToImages, $pathToThumbs, $thumbWidth)
    {
        // open the directory
        $dir = opendir($pathToImages);

        // loop through it, looking for any/all JPG files:
        while (false !== ($fname = readdir($dir))) {
            // parse path for the extension
            $info = pathinfo($pathToImages . $fname);
            // continue only if this is a JPEG image
            if (strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'png' || strtolower($info['extension']) == 'gif') {
                //echo "Creating thumbnail for {$fname} <br />";

                // load image and get image size
                $img = imagecreatefromjpeg("{$pathToImages}{$fname}");
                $width = imagesx($img);
                $height = imagesy($img);

                // calculate thumbnail size
                $new_width = $thumbWidth;
                $new_height = floor($height * ($thumbWidth / $width));

                // create a new temporary image
                $tmp_img = imagecreatetruecolor($new_width, $new_height);

                // copy and resize old image into new image
                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                // save thumbnail into a file
                imagejpeg($tmp_img, "{$pathToThumbs}{$fname}");
            }
        }
        // close the directory
        closedir($dir);
    }

    public static function imagethumb($image_src, $image_dest = NULL, $max_size = 100, $expand = FALSE, $square = FALSE)
    {


        if (!file_exists($image_src)) return FALSE;

        // R�cup�re les infos de l'image
        $fileinfo = getimagesize($image_src);
        if (!$fileinfo) return FALSE;

        $width = $fileinfo[0];
        $height = $fileinfo[1];
        $type_mime = $fileinfo['mime'];
        $type = str_replace('image/', '', $type_mime);

        if (!$expand && max($width, $height) <= $max_size && (!$square || ($square && $width == $height))) {
            // L'image est plus petite que max_size
            if ($image_dest) {
                return copy($image_src, $image_dest);
            } else {
                header('Content-Type: ' . $type_mime);
                return (boolean)readfile($image_src);
            }
        }

        // Calcule les nouvelles dimensions
        $ratio = $width / $height;

        if ($square) {
            $new_width = $new_height = $max_size;

            if ($ratio > 1) {
                // Paysage
                $src_y = 0;
                $src_x = round(($width - $height) / 2);

                $src_w = $src_h = $height;
            } else {
                // Portrait
                $src_x = 0;
                $src_y = round(($height - $width) / 2);

                $src_w = $src_h = $width;
            }
        } else {
            $src_x = $src_y = 0;
            $src_w = $width;
            $src_h = $height;

            if ($ratio > 1) {
                // Paysage
                $new_width = $max_size;
                $new_height = round($max_size / $ratio);
            } else {
                // Portrait
                $new_height = $max_size;
                $new_width = round($max_size * $ratio);
            }
        }

        // Ouvre l'image originale
        $func = 'imagecreatefrom' . $type;
        if (!function_exists($func)) return FALSE;

        $image_src = $func($image_src);
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Gestion de la transparence pour les png
        if ($type == 'png') {
            imagealphablending($new_image, false);
            if (function_exists('imagesavealpha'))
                imagesavealpha($new_image, true);
        } // Gestion de la transparence pour les gif
        elseif ($type == 'gif' && imagecolortransparent($image_src) >= 0) {
            $transparent_index = imagecolortransparent($image_src);
            $transparent_color = imagecolorsforindex($image_src, $transparent_index);
            $transparent_index = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
            imagefill($new_image, 0, 0, $transparent_index);
            imagecolortransparent($new_image, $transparent_index);
        }

        // Redimensionnement de l'image
        imagecopyresampled(
            $new_image, $image_src,
            0, 0, $src_x, $src_y,
            $new_width, $new_height, $src_w, $src_h
        );

        // Enregistrement de l'image
        $func = 'image' . $type;
        if ($image_dest) {
            $func($new_image, $image_dest);
        } else {
            header('Content-Type: ' . $type_mime);
            $func($new_image);
        }

        // Lib�ration de la m�moire
        imagedestroy($new_image);

        return TRUE;
    }

    public static function get_user_data($d = '')
    {
        $row = Yii::app()->db->createCommand(array(
            'select' => array('*'),
            'from' => 'drg_user',
            'where' => 'drg_uid=:drg_uid',
            'params' => array(':drg_uid' => $d),
        ))->queryRow();
        return $row;
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

    public static function getDateDiffAsDays($date1, $date2)
    {
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        $interval = $date1->diff($date2);

        return $interval->days;
    }

    public static function getWeekNumbers($date1, $date2)
    {

        $startTime = strtotime($date1);
        $endTime = strtotime($date2);

        $weeks = array();
        while ($startTime < $endTime) {
            $weeks[] = date('W', $startTime);
            $startTime += strtotime('+1 week', 0);
        }

        return $weeks;
    }

    public static function setLatLngUserVotes(&$markers = array(), $usersAddressInfo, $colorCode)
    {

        if ($usersAddressInfo) {
            foreach ($usersAddressInfo as $addressInfo) {
                $markers[] = array(
                    'latLng' => self::getLatLngFromGoogleMaps($addressInfo->userAddressInfo),
                    'name' => $addressInfo->userAddress1,
                    'style' => array('fill' => $colorCode, 'r' => 2)
                );
            }
        }

        return $markers;
    }

    private static function getLatLngFromGoogleMaps($addressInfo)
    {
        $address = urlencode($addressInfo);
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

        // Make the HTTP request
        $data = @file_get_contents($url);

        // Parse the json response
        $jsonData = json_decode($data, true);

        // If the json data is invalid, return empty array
        if ($jsonData["status"] != "OK") return array();

        $LatLng = array(
            $jsonData["results"][0]["geometry"]["location"]["lat"],
            $jsonData["results"][0]["geometry"]["location"]["lng"],
        );

        return $LatLng;
    }

    public static function setChartParams($period = 'weekly', $question_submission_date, $question_end_date, &$params = array())
    {
        // GET start date and end of a week or year
        $currDate = date('Y-m-d');
        if (strtotime($currDate) < strtotime($question_end_date)) {
            $date = $currDate;
            //$dateWeekNumber = (int)date('W', strtotime($date));
        } else {
            $date = $question_end_date;
            //$dateWeekNumber = (int)date('W', strtotime($date));
        }

        switch ($period) {

            case "weekly":

                // START & END dates
                if (!isset($params['start_date']) && $params['start_date'] == '') {
                    $startAndEndDate = SharedFunctions::getStartAndEndDate($date, 'weekly');
                    $params['start_date'] = $startAndEndDate['start_date'];
                    $params['end_date'] = $startAndEndDate['end_date'];
                }

                if ($params['nav'] === 'prev') {
                    $prev_start_date = date('Y-m-d', strtotime('-7 day', strtotime($params['start_date']))); // previous 7 days;
                    if (strtotime($prev_start_date) > strtotime($question_submission_date)) {
                        $params['start_date'] = $prev_start_date;
                        $params['end_date'] = date('Y-m-d', strtotime("+6 day", strtotime($params['start_date'])));
                    } else {
                        $params['start_date'] = $question_submission_date;
                        $dayNumber = date('w', strtotime($params['start_date']));
                        $incrementDays = (6 - $dayNumber);
                        $params['end_date'] = date('Y-m-d', strtotime("+$incrementDays day", strtotime($params['start_date'])));
                    }
                }

                if ($params['nav'] === 'next') {
                    $next_end_date = date('Y-m-d', strtotime('+7 day', strtotime($params['end_date']))); // next 7 days;
                    if (strtotime($next_end_date) < strtotime($question_end_date)) {
                        $params['start_date'] = date('Y-m-d', strtotime("-6 day", strtotime($next_end_date)));
                        $params['end_date'] = $next_end_date;
                    } else {
                        $dayNumber = date('w', strtotime($question_end_date));
                        $params['start_date'] = date('Y-m-d', strtotime("-$dayNumber day", strtotime($question_end_date)));
                        $params['end_date'] = $question_end_date;
                    }
                }
                break;

            case "monthly":

                // START & END dates
                $startAndEndDate = SharedFunctions::getStartAndEndDate($date, '');
                $params['start_date'] = $startAndEndDate['start_date'];
                $params['end_date'] = $startAndEndDate['end_date'];
                if (strtotime($params['start_date']) < strtotime($question_submission_date))
                    $params['start_date'] = $question_submission_date;

                if (strtotime($params['end_date']) > strtotime($question_end_date))
                    $params['end_date'] = $question_end_date;

                if ($params['nav'] === 'prev') {
                    $prev_end_date = date('Y-m-d', strtotime('-1 year', strtotime($params['start_date']))); // previous 1 year;
                    $startAndEndDate = SharedFunctions::getStartAndEndDate($prev_end_date, '');
                    if (strtotime($startAndEndDate['start_date']) > strtotime($question_submission_date)) {
                        $params['start_date'] = $startAndEndDate['start_date'];
                        $params['end_date'] = $startAndEndDate['end_date'];
                        if (strtotime($params['end_date']) > strtotime($question_end_date))
                            $params['end_date'] = $question_end_date;
                    } else {
                        $params['start_date'] = $question_submission_date;
                        $params['end_date'] = date('Y-12-31', strtotime($question_submission_date));
                        if (strtotime($params['end_date']) > strtotime($question_end_date))
                            $params['end_date'] = $question_end_date;
                    }

                }

                if ($params['nav'] === 'next') {
                    $next_end_date = date('Y-m-d', strtotime('+1 year', strtotime($params['end_date']))); // next 1 year;
                    $startAndEndDate = SharedFunctions::getStartAndEndDate($next_end_date, '');
                    if (strtotime($startAndEndDate['end_date']) < strtotime($question_end_date)) {
                        $params['start_date'] = $startAndEndDate['start_date'];
                        $params['end_date'] = $startAndEndDate['end_date'];
                        if (strtotime($params['start_date']) < strtotime($question_submission_date))
                            $params['start_date'] = $question_submission_date;

                    } else {
                        $params['start_date'] = date('Y-01-01', strtotime($question_end_date));
                        $params['end_date'] = $question_end_date;
                        if (strtotime($params['start_date']) < strtotime($question_submission_date))
                            $params['start_date'] = $question_submission_date;
                    }
                }

                break;
        }
    }

    // encode an array as a string
    public static function encodeArrayAsString($data)
    {
        return base64_encode(serialize($data));
    }

    // decode a string as an array
    public static function decodeStringAsArray($data)
    {
        return unserialize(base64_decode($data));
    }

    public static function processFinancialTransaction($paymentAckDetails)
    {
        $x = new ECurrencyConverter();
        $x->currencyConverter();
        $userData = User::model()->findByPk(Yii::app()->user->getId());
        $currenyCode = Currency::model()->getCurrencyCode($userData['user_default_currency']);

        $transaction_id = $paymentAckDetails['TRANSACTIONID'];
        $type = 'cr';
        $description = 'Paypal';
        $pay_in = $paymentAckDetails['AMT'];
        $transaction_code = $paymentAckDetails['CURRENCYCODE'];
        $account_balance = new AccountBalance();
        $accountData = Yii::app()->db->createCommand()
            ->select("*")
            ->from('user_default_account_balance')
            ->where('user_default_account_balance_user_id=' . Yii::app()->user->getId() . '')
            ->queryAll();

        $accountBalance = $x->convert($accountData[0]['user_default_account_balance_account_balance'], $accountData[0]['user_default_account_balance_currency_code'], $currenyCode);

        if (count($accountData) == 0) {

            $balance = $accountBalance + $pay_in;
            $useraccountbalance = Yii::app()->db->createCommand()
                ->insert('user_default_account_balance', array(
                    'user_default_account_balance_user_id' => Yii::app()->user->getId(),
                    'user_default_account_balance_account_balance' => $balance,
                    'user_default_account_balance_currency_code' => $transaction_code
                ));
        } else {
            $balance = $accountBalance + $pay_in;
            $update = Yii::app()->db->createCommand()
                ->update('user_default_account_balance',
                    array(
                        'user_default_account_balance_account_balance' => new CDbExpression($balance),
                        'user_default_account_balance_currency_code' => $transaction_code
                    ),
                    'user_default_account_balance_user_id=:user_id',
                    array(':user_id' => Yii::app()->user->getId())
                );

        }

        $usertransaction = Yii::app()->db->createCommand()
            ->insert('user_default_financial', array(
                'user_default_transaction_profile_id' => Yii::app()->user->getId(),
                'user_default_transaction_type' => $type,
                'user_default_transaction_date' => date('Y-m-d %H:%i:%s'),
                'user_default_transaction_paypal_transactionId' => $transaction_id,
                'user_default_transaction_details' => $description,
                'user_default_transaction_paid_out' => '',
                'user_default_transaction_paid_in' => $pay_in,
                'user_default_transaction_balance' => $balance,
                'user_default_financial_transaction_withdraw_status' => 0,
                'user_default_financial_transaction_currency_code' => $transaction_code
            ));

        $financialTransactionId = Yii::app()->db->getLastInsertID();

        $template = MailTemplate::getTemplate('Add_Fund_Notice_Transaction');

        $string = array(
            '{{#USERNAME#}}' => $userData['user_default_username'],
            '{{#FULLNAME#}}' => $userData['user_default_first_name'] . '' . $userData['user_default_surname'],
            '{{#USEREMAIL#}}' => $userData['user_default_email'],
            '{{#TYPEOFTRANSACTION#}}' => 'Credit to user financial account',
            '{{#TRANSACTIONREF#}}' => $paymentAckDetails['TRANSACTIONID'],
            '{{#BANK#}}' => 'Paypal',
            '{{#AMOUNTRECEIVED#}}' => Yii::app()->numberFormatter->formatCurrency($paymentAckDetails['AMT'], $paymentAckDetails['CURRENCYCODE'])
        );

        $body = SharedFunctions::app()->mailStringReplace($template->template_body, $string);

        SharedFunctions::app()->sendmail(Yii::app()->params['company_account_email'], $template->template_subject, $body);

        return $financialTransactionId;
    }

    public static function _get_banner_cost_indoller($userId, $cost)
    {
        $currencyConvert = new ECurrencyConverter();
        $currencyConvert->currencyConverter();
        $userData = User::model()->findByPk($userId);
        $currency = Currency::model()->findByPk($userData->user_default_currency);
        return $currencyConvert->convert($cost, $currency->currency_code, 'USD', 2);

    }


    public static function formatDate($date)
    {

        if (empty($date))
            return NULL;

        $result['time'] = date('h:i A', strtotime($date));

        $result['date'] = date('d/m/Y', strtotime($date));

        return $result;

    }

    public static function isYoutubeUrl($url)
    {
        return preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url);
    }

    public static function getStartAndEndDate($date, $action = 'weekly')
    {
        $dto = new DateTime($date);
        if ($action === 'weekly') {
            $result['start_date'] = $dto->setISODate($dto->format('Y'), $dto->format('W'), 0)->format('Y-m-d');
            $result['end_date'] = $dto->modify('+6 days')->format('Y-m-d');
        } else {
            $date1 = date_create($dto->format('Y') . '-01-01');
            $date2 = date_create($dto->format('Y') . '-12-31');
            $result['start_date'] = date_format($date1, 'Y-m-d');
            $result['end_date'] = date_format($date2, 'Y-m-d');
        }
        return $result;
    }


}

?>