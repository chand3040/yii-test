<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class Cron
{
	public static function clearLogs() {
		$model = new SiteDefaults;
		$model = SiteDefaults::model()->findAll();
        
        $arr = ['Assets', 'AdminLogs', 'Apache2Logs', 'UserLogs', 'RuntimeLogs', 'Cache'];

        if(!$model) {
        	$model = array(

        		);
        }

        foreach ($model as $key => $_model) {
        	switch ($_model->user_default_site_default_type) {
        		case 'Assets':
        			Cron::removeAssetsAll($_model->user_default_site_default_days);
        			break;

        		case 'RuntimeLogs':
        			Cron::removeRuntimeLogs($_model->user_default_site_default_days);
                    Cron::removeLogs($_model->user_default_site_default_days);
        			break;

        		case 'UserLogs':
        			Cron::removeUserLogs($_model->user_default_site_default_days);
        			break;

                case 'Cache':
                    Cron::removeCacheAndTemp($_model->user_default_site_default_days);
                    break;

                case 'AdminLogs':
                    Cron::removeAdminLogs($_model->user_default_site_default_days);
                    break;

                case 'Apache2Logs':
                	if($_model->user_default_last_deleted <= date('Y-m-d H:i:s',  strtotime(date('Y-m-d H:i:s')) - $_model->user_default_site_default_days*24*60*60))
                    	Cron::clearApache2LogFiles($_model->user_default_site_default_days);
                    break;
        		
        		default:
        			# code...
        			break;
        	}
        }
	}

	public static function getFileTimeCompareToday($file = null, $day = 10) {
		return (filemtime($file) + $day * 24 * 60 * 60 <= strtotime(date('Y-m-d H:i:s'))) ? true : false;
	}

	public static function removeAssetsAll($dir = null, $day = 10)
    {
    	// if(!$dir)
        	$dir = realpath(dirname(Yii::app()->basePath) . "/www/assets");
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }

            if (is_dir($file)){
                self::deleteDir($file);

            } else {
            	if($file != '.gitignore' && Cron::getFileTimeCompareToday($file, $day))
                	unlink($file->getRealPath());
            }
        }

        return true;
    }

    public static function removeAssets($day = 10, &$files = null){
    	if(!$files)
    		$files = scandir( dirname(dirname( dirname(__FILE__) )) . '/www/assets/');

		foreach($files as $file) {
		  	if(is_file($file) && $file != '.gitignore' && Cron::getFileTimeCompareToday($file, $day)) {
		  		unlink($file->getRealPath());
		  	}else if( is_dir($file) ) {
		  		Cron::removeAssets($file);
		  	}
		}
    }

    public static function removeRuntimeLogs($day = 10) {
    	$dir = realpath(dirname(Yii::app()->basePath) . "/runtime/runtime");
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isDir()){
                // rmdir($file->getRealPath());
                self::deleteDir($file);
            } else {
            	if(Cron::getFileTimeCompareToday($file, $day))
                	unlink($file->getRealPath());
            }
        }

        return true;
    }

    public static function removeUserLogs($day = 10) {
    	/*
    	$datetime = date('Y-m-d H:i:s',  strtotime(date('Y-m-d H:i:s')) - $day*24*60*60);
        $delete = Yii::app()->db->createCommand("DELETE al.* FROM " . ActivityLog::model()->tableName() . " AS al WHERE al.datetime <= :datetime");
        $delete->bindParam(':datetime', $datetime);

    	if($delete->execute()) {
    		
	        $deleteTransaction = Yii::app()->db->createCommand("DELETE lt.* FROM " . Logtransaction::model()->tableName() . " AS lt WHERE lt.transaction_date <= :transaction_date");
	        $deleteTransaction->bindParam(':transaction_date', $datetime);

	        if($deleteTransaction->execute()) {
	        	print_r('Delete userlogs success');
	        	Yii::log('Delete userlogs transaction success', 'info', 'cron');
	        }else{
	        	Yii::log('Delete userlogs transaction false ', 'error', 'cron');
	        }

    		Yii::log('Delete userlogs activity success', 'info', 'cron');
    	}else{
    		print("Delete userlogs false");
    		Yii::log('Delete userlogs activity false ', 'error', 'cron');
    	}
    	*/
    	// deletes user activity date of 3 months older
        ActivityDate::model()->deleteAll(
            'date < :date',
            array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $day . ' DAY)')
        );

        // deletes user activity logs of 3 months older
        ActivityLog::model()->deleteAll(
            'datetime < :date',
            array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $day. ' DAY)')
        );

        // deletes user transaction logs of 2 months older
        Logtransaction::model()->deleteAll(
            'transaction_date < :date',
            array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $day. ' DAY)')
        );
    }

    public static function removeAdminLogs($day = 10) {
    	// $transaction_date = date('Y-m-d H:i:s',  strtotime(date('Y-m-d H:i:s')) - $day*24*60*60);
        // $delete = Yii::app()->db->createCommand("DELETE lta.* FROM " . LogTransactionAdmin::model()->tableName() . " AS lta WHERE lta.transaction_date <= :transaction_date");
        // $delete->bindParam(':transaction_date', $transaction_date);

    	// if(Yii::app()->db->createCommand()->delete(LogTransactionAdmin::model()->tableName(), 'transaction_date <= ' . $transaction_date)->execute()) {
    	// 	print_r('Delete admin logs success');
    	// 	Yii::log('Delete admin logs success', 'info', 'cron');
    	// }else{
    	// 	print_r('Delete admin logs false');
    	// 	Yii::log('Delete admin logs false ', 'error', 'cron');
    	// }

    	// deletes admin user transaction logs of 1 months older
        LogTransactionAdmin::model()->deleteAll(
            'transaction_date < :date',
            array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $day . ' DAY)')
        );
    }

    public static function removeLogs($day = 10) {
        $dir = realpath(dirname(Yii::app()->basePath) . "/www/log");
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isDir()){
                self::deleteDir($file);
            } else {
                if($file != '.gitignore' && Cron::getFileTimeCompareToday($file, $day))
                    unlink($file->getRealPath());
            }
        }

        return true;
    }

    public static function removeCacheAndTemp($day = 10) {
        $dir = realpath(dirname(Yii::app()->basePath) . "/www/cache");
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isDir()){
                self::deleteDir($file);
            } else {
                if($file != '.gitignore' && Cron::getFileTimeCompareToday($file, $day))
                    unlink($file->getRealPath());
            }
        }

        $dir = realpath(dirname(Yii::app()->basePath) . "/www/temp");
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isDir()){
                self::deleteDir($file);
            } else {
                if($file != '.gitignore' && Cron::getFileTimeCompareToday($file, $day))
                    unlink($file->getRealPath());
            }
        }

        return true;
    }

    // function to clear PHP ErrorLog Files
    public static function clearApache2LogFiles($days = 10)
    {
    	// self::deleteLinesOfFile("/var/log/apache2", $days*50);
    	// self::deleteLinesOfFile("/var/log/apache2", $days*20);

    	// update user_default_last_deleted
		$model = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => "Apache2Logs"));        
        
        if($model) {
	        $model->user_default_last_deleted = date('Y-m-d H:i:s');
	        
	        if ($model->save()) {
	        	Yii::log("Update last delete for apache2 log success", "info", "cron");
	        }else{
	        	Yii::log("Update last delete for apache2 log false", "error", "cron");
	        }
        }

    	/*
    	$dir = realpath(dirname("/var/log/apache2");
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isDir()){
                self::deleteDir($file);
            } else {
                if($file != '.gitignore' && Cron::getFileTimeCompareToday($file, $day))
                    unlink($file->getRealPath());
            }
        }
        */

        return true;
    }

    public static function deleteLinesOfFile($filename,$line_no=-1) {

		$strip_return=FALSE;

		$data=file($filename);
		$pipe=fopen($filename,'w');
		$size=count($data);


		if($line_no==-1) $skip=$size-1;
		else $skip=$line_no-1;

		for($line=0; $line<$size; $line++)
			if($line >= $skip)
				fputs($pipe,$data[$line]);
			else
				$strip_return=TRUE;

		return $strip_return;
	}

	public static function deleteDir($dir) {
		$objects = scandir($dir); 
        foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
                if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
            } 
        }
        reset($objects); 
        rmdir($dir); 
	}
	
}