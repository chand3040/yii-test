<div class="content-container">
    <ul class="secondary-top-menu">
        <li>
            <a <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('update'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/listings/listings/update') . '?id=' . ($_REQUEST['id'] ? $_REQUEST['id'] : ''); ?>"
                data-active="Details">Details</a></li>

        <li>
            <a <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('forum'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/listings/listings/forum') . '?id=' . ($_REQUEST['id'] ? $_REQUEST['id'] : ''); ?>"
                data-active="Forum">Forum</a></li>

        <li>
            <a <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('samples'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/listings/listings/sampleview'); ?>"
                data-active="Samples">Samples</a></li>

        <li><a href="javascript:void(0);" data-active="Banner Adverts">Banner Adverts</a></li>

        <li>
            <a href="<?php echo Yii::app()->createUrl('admin/listings/listings/marketingdata') . '?id=' . ($_REQUEST['id'] ? $_REQUEST['id'] : ''); ?>"
               data-active="Marketing Data" <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('marketingdata'))): ?> class="active" <?php endif; ?> >Marketing
                Data</a></li>

        <li>
            <a href="<?php echo Yii::app()->createUrl('admin/listings/listings/portfolio') . '?id=' . ($_REQUEST['id'] ? $_REQUEST['id'] : ''); ?>"
               title="Portfolio" <?php if (Yii::app()->controller->id == 'portfolio' && in_array(Yii::app()->controller->action->id, array('index'))): ?> class="active" <?php endif; ?>>Portfolio</a>
        </li>
        <li><a href="<?php echo Yii::app()->createUrl('admin/listings/listings/index') ?>"
               data-active="Return">Return</a>
        </li>
    </ul>

</div>