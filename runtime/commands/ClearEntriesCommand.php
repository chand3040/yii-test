<?php

/**
 * Created by PhpStorm.
 * User: aequalis PHP Team
 * Date: 24/11/15
 * Description: This command makes sure to clear log files and the past db entries
 */
class ClearEntriesCommand extends CConsoleCommand
{
    /**
     * @var string the name of the default action. Defaults to 'clear'.
     * @since 1.1.5
     */
    public $defaultAction = 'clear';
    private $webroot;

    public function actionClear($specific = '')
    {
        // web root
        $this->webroot = dirname(Yii::app()->basePath);

        switch ($specific) {
            case 'Apache2Logs':
                $this->clearApache2LogFiles(); // clears Apache2 logs of N days older
                break;
            case 'RuntimeLogs':
                $this->clearWebsiteRuntimeLogs(); // clears the website runtime logs of N days older
                break;
            case 'Assets':
                $this->clearWebsiteAssets(); // clears the website assets of N days older
                break;
            case 'Logs':
                $this->clearWebsiteLogs(); // clears the website logs of N days older
                break;
            case 'UserLogs':
                $this->clearUserTransactionLogs(); // clears user transaction logs of N days older
                break;
            case 'AdminLogs':
                $this->clearAdminUserTransactionLogs(); // clears admin user transaction logs of N days older
                break;
            default :
                $this->clearApache2LogFiles();
                $this->clearWebsiteRuntimeLogs();
                $this->clearWebsiteAssets();
                $this->clearWebsiteLogs();
                $this->clearUserTransactionLogs();
                $this->clearAdminUserTransactionLogs();
                break;
        }

    }

    // function to clear PHP ErrorLog Files
    private function clearApache2LogFiles()
    {
        $days = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'Apache2Logs'))->user_default_site_default_days;
        if ($days) {
            $result = self::clearDirectoryNDaysOlder('/var/log/apache2', $days);
            print "Apache2 Log: {$result}";
        }
    }

    // function to clear the website runtime logs
    private function clearWebsiteRuntimeLogs()
    {
        $days = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'RuntimeLogs'))->user_default_site_default_days;
        if ($days) {
            $result = self::clearDirectoryNDaysOlder($this->webroot . '/runtime/runtime', $days);
            print "Website Runtime Logs: {$result}";
        }
    }

    // function to clear the web assets
    private function clearWebsiteAssets()
    {
        $days = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'Assets'))->user_default_site_default_days;
        if ($days) {
            $result = self::clearDirectoryNDaysOlder($this->webroot . '/www/assets', $days);
            print "Website Assets: {$result}";
        }
    }

    // function to clear the website logs
    private function clearWebsiteLogs()
    {
        $days = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'Logs'))->user_default_site_default_days;
        if ($days) {
            $result = self::clearDirectoryNDaysOlder($this->webroot . '/www/log', $days);
            $result .= self::unlinkFileNDaysOlder($this->webroot . '/www/log.txt', $days);
            print "Website Logs: {$result}";
        }
    }

    /**
     * function to clear all user transaction logs of N days older.
     * @param int $days to be cleared or empty
     */
    private function clearUserTransactionLogs()
    {
        $days = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'UserLogs'))->user_default_site_default_days;
        if ($days) {

            // deletes user activity date of 3 months older
            ActivityDate::model()->deleteAll(
                'date < :date',
                array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $days . ' DAY)')
            );

            // deletes user activity logs of 3 months older
            ActivityLog::model()->deleteAll(
                'datetime < :date',
                array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $days . ' DAY)')
            );

            // deletes user transaction logs of 2 months older
            Logtransaction::model()->deleteAll(
                'transaction_date < :date',
                array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $days . ' DAY)')
            );

            print "Deleted User Transaction Logs\n";
        }
    }

    /**
     * function to clear all admin user transaction logs of N days older.
     * @param int $days to be cleared or empty
     */
    private function clearAdminUserTransactionLogs()
    {
        $days = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'AdminLogs'))->user_default_site_default_days;
        if ($days) {

            // deletes admin user transaction logs of 1 months older
            LogtransactionAdmin::model()->deleteAll(
                'transaction_date < :date',
                array('date' => 'DATE_SUB(NOW(), INTERVAL ' . $days . ' DAY)')
            );

            print "Deleted Admin User Transaction Logs\n";
        }
    }

    /*
     * function to clear the given directory recursively.
     * @param string $directory to be cleared or empty.
     */
    /*private static function clearDirectory($directory, $self_delete = false)
    {
        if (is_dir($directory)) {
            $objects = scandir($directory);
            if ($objects) {
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($directory . "/" . $object) == "dir") self::clearDirectory($directory . "/" . $object, true); else unlink($directory . "/" . $object);
                    }
                }
            }
            if ($self_delete === true) rmdir($directory);
        }

    }*/

    /*
     * function to clear the given directory N days older recursively.
     * @param string $directory to be cleared or empty
     * @param int $days older
     * @param int $self_delete to delete the folder itself
     */
    private static function clearDirectoryNDaysOlder($directory, $days, $deletedItemCount = 0)
    {
        if (is_dir($directory)) {
            if ($dh = opendir($directory)) {
                while (($object = readdir($dh)) !== false) {
                    if ($object != "." && $object != "..") {
                        $objectPath = $directory . "/" . $object; //echo $objectPath."\n";
                        $fileMTime = filemtime($objectPath);
                        if ($fileMTime < (time() - $days * 24 * 60 * 60)) {
                            if (filetype($objectPath) == "dir") {
                                self:: clearDirectoryNDaysOlder($objectPath, $days, $deletedItemCount);
                                $deletedItemCount += 1;
                            } else {
                                chmod($objectPath, 0755); // read and execute
                                $status = unlink($objectPath);
                                if ($status) $deletedItemCount += 1;
                            }
                            chmod($objectPath, 0755); // read and execute
                            $status = rmdir($objectPath);
                            if ($status) $deletedItemCount += 1;
                        }
                    }
                }
                closedir($dh);
            }
        }

        return "Deleted {$deletedItemCount} items\n";
    }

    /*
     * Removes a given file based on $days older
     * @param string $file to be deleted
     * @param int $days older
     */
    private static function unlinkFileNDaysOlder($file, $days, $deletedItemCount = 0)
    {
        if (file_exists($file)) {
            $fileMTime = filemtime($file);
            if ($fileMTime < (time() - $days * 24 * 60 * 60)) {
                chmod($file, 0755); // read and execute
                $status = unlink($file);
                if ($status) $deletedItemCount += 1;
            }
        }

        return "Deleted {$deletedItemCount} items\n";
    }

}