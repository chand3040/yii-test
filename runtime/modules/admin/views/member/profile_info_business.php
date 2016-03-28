<?php
$currControllerID = Yii::app()->controller->id;
$currActionId = Yii::app()->controller->action->id; //echo $currActionId;
?>

<table style="border-spacing:10px;margin-top: -15px;">
    <tr>
        <td>
            <div class="user_image_container">
                <?php
                $user_dirname = strtolower($model->user_default_business_username) . '_' . $model->user_default_business_id . '/images';
                if ($model->user_default_business_image) {
                    if (file_exists(Yii::app()->basePath . '/../www/upload/logo/' . $model->user_default_business_image))
                        $img = $this->createUrl('/upload/logo/' . $model->user_default_business_image);
                    else
                        $img = $this->createUrl('/upload/logo/avatar.jpg');
                    $alt_img = $model->user_default_business_first_name . ' ' . $model->user_default_business_surname;
                } else {
                    $img = $this->createUrl('/upload/logo/avatar.jpg');
                    $alt_img = 'Avatar';
                }
                ?>
                <img src="<?php echo $img; ?>" alt="<?php echo $alt_img; ?>" style="width:80px; height:80px;"/>
            </div>
        <td style="vertical-align:middle; width:16%"><label
                style="text-align: right;clear: both;float:left;margin-right:1px; color: #808080; font: 12px Verdana, Helvetica, Arial;">User</label>&nbsp;:&nbsp;<span
                style="color: rgba(242, 119, 41, 1); font-size: 12px; font-weight: bold;"><?php echo $model->user_default_business_username; ?></span>
        </td>
        <td style="vertical-align:middle">

            <div class="row member-tabs">

                <?php if ($model->isNewRecord) {
                    echo CHtml::submitButton('Create', array('class' => 'button update-green')); ?>

                    <?php
                    //echo CHtml::submitButton('Create', array('class' => 'button green'));
                } else { /*echo CHtml::submitButton('Update Profile', array('class' => 'button update-green'));*/
                    ?>
                    <a class="member-tab gray update" href="javascript:void(0);" id="update-profile-btn">Update
                        Profile</a>
                <?php } ?>
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <?php

                    if (strtolower($model->user_default_business_status) == '1') {
                        ?>
                        <a href="javascript:void(0);" class="member-tab rosy suspend_account">Suspend Account</a>
                    <?php
                    } else {
                        ?>
                        <a href="javascript:void(0);" class="member-tab rosy activate_account">Activate Account</a>
                    <?php
                    }
                    ?>
                    <a href="javascript:void(0);" class="member-tab update-green contact">Contact</a>
                    <a onclick="return confirm('Are you sure you want to delete the user? This action cannot be undone.');"
                       href="<?php echo Yii::app()->createUrl('/admin/member/deleteBusiness', array('id' => $model->user_default_business_id)); ?>"
                       class="member-tab red delete">Delete Account</a>
                    <?php if ($currActionId == 'financialinfobusiness') { ?>
                        <a href="<?php echo Yii::app()->createUrl("admin/member/update", array('id' => $model->user_default_business_id, 'userType' => 'business')); ?>"
                           class="member-tab blue">Back to profile</a>
                    <?php } else { ?>
                        <a href="<?php echo Yii::app()->createUrl("admin/member/financialInfoBusiness", array('profileId' => $model->user_default_business_id)); ?>"
                           class="member-tab blue">Financial Statements</a>
                    <?php } ?>
                    <a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="member-tab black">Return</a>
                <?php
                }
                ?>

            </div>
        </td>
    </tr>
</table>

<?php

$userId = $model->user_default_business_id;

?>

<script type="text/javascript">
    jQuery(".chzn-select").chosen();
    jQ = jQuery.noConflict();

    jQ(document).ready(function () {

        /*jQ('#update-profile-btn').click(function(e){
         e.preventDefault();
         jQ(this).closest('form').submit();
         });*/

        jQ('input,textarea').focus(function () {
            jQ(this).removeAttr('placeholder');
        });
        jQ('#update-profile-btn').on('click', function (e) {

            jQ('div.notification-popup').html('');

            var userType = 'business';
            var userId = '<?php echo $userId;?>';
            var actionType = 'user_profile_update_notify';

            jQ.ajax({
                type: "GET",
                url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/showNotification?userType=" + userType + '&userId=' + userId + '&actionType=' + actionType,
                success: function (response) {
                    jQ('div.notification-popup').html(response);
                },
                error: function (e) {
                    alert(e.message);
                }
            });
        });

        jQ('a.activate_account').on('click', function (e) {

            jQ('div.notification-popup').html('');

            var userType = 'business';
            var userId = '<?php echo $userId;?>';
            var actionType = 'user_profile_activation_notify';

            jQ.ajax({
                type: "GET",
                url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/showNotification?userType=" + userType + '&userId=' + userId + '&actionType=' + actionType,
                success: function (response) {
                    jQ('div.notification-popup').html(response);
                },
                error: function (e) {
                    alert(e.message);
                }
            });
        });

        jQ('a.suspend_account').on('click', function (e) {

            jQ('div.notification-popup').html('');

            var userType = 'business';
            var userId = '<?php echo $userId;?>';
            var actionType = 'user_profile_suspend_notify';

            jQ.ajax({
                type: "GET",
                url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/showNotification?userType=" + userType + '&userId=' + userId + '&actionType=' + actionType,
                success: function (response) {
                    jQ('div.notification-popup').html(response);
                },
                error: function (e) {
                    alert(e.message);
                }
            });

        });

        jQ('a.contact').on('click', function (e) {

            jQ('div.notification-popup').html('');

            var userType = 'business';
            var userId = '<?php echo $userId;?>';
            var actionType = 'contact_notify';

            jQ.ajax({
                type: "GET",
                url: "<?php echo Yii::app()->baseUrl; ?>/admin/member/showNotification?userType=" + userType + '&userId=' + userId + '&actionType=' + actionType,
                success: function (response) {
                    jQ('div.notification-popup').html(response);
                },
                error: function (e) {
                    alert(e.message);
                }
            });
        });

    });
</script>



