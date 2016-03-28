<?php
$date=date('Y-m-d');

$connection = Yii::app()->db;
$cronsql = $connection->createCommand("select * from `user_default_listing` where `user_default_listing_submission_status`='3'");
$cronresult = $cronsql->queryAll();

foreach($cronresult as $data )
{
$lid=$data['user_default_listing_id'];
$deldate=$date['user_default_listing_date'];
$dd="7 days";
$newtime = strtotime($deldate . ' + '.$dd);
$ddate = date('Y-m-d', $newtime);
if($ddate==$date)
{
$command = $connection->createCommand("select * from `user_default_profiles` where `user_default_id`='$uid'");
$myresult = $command->queryRow();
$to=$myresult['user_default_email'];
$template =  MailTemplate::getTemplate('Listing_deletion');
$subjectcc="Listing ".$model['user_default_listing_title']." has been deleted ";
$string = array(        '{{#LISTINGTITLE#}}'=>ucwords($data['user_default_listing_title']),
						'{{#USERNAME#}}'=>ucwords($myresult['user_default_first_name'].' '.$myresult['user_default_surname'])
						);
$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);
$result =  SharedFunctions::app()->sendmail($to,$subjectcc,$body);

$query = "delete from `user_default_listing` where `user_default_listing_id`='$lid'";
$query->queryAll($query);

 
}
}
?>