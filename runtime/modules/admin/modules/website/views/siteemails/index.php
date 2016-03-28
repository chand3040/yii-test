<?php

/*$this->breadcrumbs = array(

    'Mail Templates' => 'index',

);*/

?>

<?php

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');

?>

<div class="content-container">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('../layouts/_top_menu'); ?>

</div>

<div class="heading">
    <h3>Site Emails</h3>
</div>

<div class="department">

    <?php

    // run Department Controller
    Yii::app()->runController('admin/website/department');
    ?>

</div>
<div>&nbsp;</div>
<div class="email-template">
    <?php

    // run Mailtemplate Controller
    Yii::app()->runController('admin/website/mailtemplate');
    ?>

</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery(".chzn-select").chosen();

        // Add necessary style while there's a pagination
        if (jQuery('.yiiPager').is(":visible")) {

            jQuery('#more_record_label').addClass('more_record_label_pagination');
            jQuery('#more_record_chzn').addClass('more_record_chzn_pagination');

        }

    });

</script>

