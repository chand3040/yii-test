<?php

$connection = Yii::app()->db;
$cronsql = $connection->createCommand("select * from `user_default_listing` where `user_default_listing_submission_status`='1' and user_default_listing_notification_frequency='3'");
$cronresult = $cronsql->queryAll();

foreach($cronresult as $data )
{

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
					
					?>