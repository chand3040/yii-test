<?php if ($userType == 'business') : ?>

    <div class="heading">
        <h3>Business user profile</h3>
    </div>

    <?php $this->renderPartial('profile_info_business', array('model' => $model, 'total' => $total)); ?>

    <div style="top:-30px;">
        <?php
        $this->renderPartial('_business_user_form', array(
            'model' => $model,
            'userType' => $userType,
        ));
        ?>
    </div>

<?php else : ?>

    <div class="heading">
        <h3>Default user profile</h3>
    </div>

    <?php $this->renderPartial('profile_info', array('model' => $model, 'total' => $total)); ?>


    <div style="top:-30px;">
        <?php
        $this->renderPartial('_user_form', array(
            'model' => $model,
            'userType' => $userType,
        ));
        ?>
    </div>

<?php endif; ?>
