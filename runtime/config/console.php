<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

//if($_SERVER['HTTP_HOST'] == "localhost"){
	$con_string = 'mysql:host=localhost;dbname=businessdb';
	$user = 'root';
	$pass = '';
	$giiPass = '[c6"jjqF}:UaRn[';
/*}else{
	$con_string = 'mysql:host=localhost;dbname=businessdb';
	$user = 'business01';
	$pass = 'Nb4jhwvgSczC3?M';
	$giiPass = '[c6"jjqF}:UaRn[';
}
*/
ini_set('memory_limit', '969M');
ini_set('post_max_size', '9999M');
ini_set('upload_max_filesize', '9999M');

//$siteBaseUrl = 'http://www.business-supermarket.co.uk';
$siteBaseUrl = 'http://localhost/bsupermarket/www';
$baseUrl = trim($siteBaseUrl, '/');

// If scheme not included, prepend it
if (!preg_match('#^http(s)?://#', $baseUrl)) {
	$baseUrl = 'http://' . $baseUrl;
}

$urlParts = parse_url($baseUrl);

// remove www
$domain = preg_replace('/^www\./', '', $urlParts['host']);



return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.commands.*',
        'application.models.*',
        'application.modules.admin.models.LogtransactionAdmin',
        'application.helper.SharedFunctions',
        'ext.YiiMailer.YiiMailer'
    ),

    // application components
    'components' => array(
        'db' => array(
            'connectionString' => $con_string,
            'emulatePrepare' => true,
            'username' => $user,
            'password' => $pass,
            'charset' => 'utf8',
            'tablePrefix' => 'user_default_',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);