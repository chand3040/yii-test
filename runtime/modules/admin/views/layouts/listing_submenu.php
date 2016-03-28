<div class="content-container">
    <ul class="secondary-top-menu">
        <li><a href="<?php echo Yii::app()->createUrl('admin/listings/listings/index'); ?>"
               <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('index'))){ ?>class="active" <?php } ?>>New
                Listing Submissions</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('admin/listings/listings/statistics'); ?>"
               <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('statistics'))){ ?>class="active" <?php } ?>>Listing
                YTD snapshot</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('admin/listings/listings/defaultUserListing'); ?>"
               <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('defaultUserListing'))){ ?>class="active" <?php } ?>>Default
                User Listing</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('admin/blisting/blisting/index'); ?>"
               <?php if (Yii::app()->controller->id == 'blisting' && in_array(Yii::app()->controller->action->id, array('index'))){ ?>class="active" <?php } ?>>Business
                User Listings</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('admin/listings/listings/samples'); ?>"
               <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('samples'))){ ?>class="active" <?php } ?>>Samples</a>
        </li>
    </ul>
</div>