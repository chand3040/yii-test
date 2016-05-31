<?php

class CronController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actionClearLogs($clear = 0) {
		if($clear == 1) {
			Cron::clearLogs();
            echo "Clear logs successful";
		}
	}

	
}