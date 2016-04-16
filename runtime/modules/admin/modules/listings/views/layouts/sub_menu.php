<div class="content-container">
    <ul class="secondary-top-menu">
        <li>
            <a <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('newlistings'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/listings/listings/newlistings'); ?>"
                data-active="Newlistings">
                New Listings Submission
            </a>
        </li>
        <li>
            <a <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('listingytd'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/listings/listings/listingytd'); ?>"
                data-active="listingytd">
                Listing YTD Snapshot
            </a>
        </li>
        <li>
            <a <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('index'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/listings/listings/index'); ?>"
                data-active="userlistings">
                Default User Listings
            </a>
        </li>
        <li>
            <a <?php if (Yii::app()->controller->id == 'blisting' && in_array(Yii::app()->controller->action->id, array('index'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/blisting/blisting/index'); ?>"
                data-active="businesslistings">
                Business User Listings
            </a>
        </li>
        <li>
            <a <?php if (Yii::app()->controller->id == 'listings' && in_array(Yii::app()->controller->action->id, array('samples'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/listings/listings/samples'); ?>"
                data-active="samples">
                Samples
            </a>
        </li>
        <li>
            <a <?php if (Yii::app()->controller->id == 'admin' && in_array(Yii::app()->controller->action->id, array('member'))): ?> class="active" <?php endif; ?>
                href="<?php echo Yii::app()->createUrl('admin/member'); ?>"
                data-active="return">
                Return
            </a>
        </li>

        <!-- <li><a href="<?php //echo Yii::app()->createUrl('admin/listings/listings/index') ?>"
               data-active="Return">Return</a>
        </li> -->
    </ul>

</div>