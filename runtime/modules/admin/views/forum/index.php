<?php $this->renderPartial('application.modules.admin.modules.new.views.layouts.listing_menu'); ?>

<div class="clear"></div>

<div class="content-container">
    <?php
    //if (($model instanceof Listings)) {
    $this->renderPartial('//../modules/forum/views/forum/page', array('listing' => $model, 'adminKey' => $adminKey));
    //}
    ?>
