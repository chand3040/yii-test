<div class="profile_suspend_account" style="display: block; position: absolute; z-index: 2; top: 340px; left: 420px;">
    <div id="terms-conditions" class="u-email-box">
        <div class="my-account-popup-box">
            <a title="Close" href="javaScript:void(0)" onclick="close_form()" class="pu-close">X</a>

            <h2 style="color:#805CA2;">User Profile Suspension Notification</h2>

            <div>&nbsp;</div>
            <div id="update-table-box">
                <table id="update-table" style="background-color:#f1e5e2">
                    <tbody>
                    <tr>
                        <td class="label">Subject</td>
                    </tr>
                    <tr>
                        <td><input type="text" value="User Account Suspension Notice" class="value"
                                   id="notification_subject" name="suspension_subject"></td>
                    </tr>
                    <tr>
                        <td class="label">Message <span class="mandatory-field">*</span></td>
                    </tr>
                    <tr>
                        <td><textarea id="notification_message" name="suspension_message"
                                      placeholder="Please enter your message here" rows="3" cols="50"
                                      class="value" style="width: 98%;"></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                    <span class="middle">


                        <input name="btnsend" id="btnsend" value="Send" type="button" class="button update-green"
                               onclick="notify_updation()"/>
                    </span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    jQ = jQuery.noConflict();
    jQ(document).ready(function () {

        jQ('input,textarea').focus(function () {
            jQ(this).removeAttr('placeholder');
        });

    });

    function close_form() {
        jQ(".profile_suspend_account").fadeOut();
    }

    // Notify the updation
    function notify_updation() {

        var subjectControl = null;
        jQ('.notification-popup input[type="text"]').each(function () {
            if (jQ(this).attr('id') == 'notification_subject') {
                subjectControl = jQ(this);
                return;
            }
        });

        var messageControl = null;
        jQ('.notification-popup textarea').each(function () {
            if (jQ(this).attr('id') == 'notification_message') {
                messageControl = jQ(this);
                return;
            }
        });

        if (subjectControl.val() == '') {
            subjectControl.css('border', '2px solid #f00');
            return false;
        }
        if (messageControl.val() == '') {
            messageControl.css('border', '2px solid #f00');
            return false;
        }

        var userType = '<?php echo $userType;?>';
        var userId = '<?php echo $userId;?>';
        var URL = (userType == 'default_user') ? "<?php echo Yii::app()->baseUrl; ?>/admin/member/suspend" : "<?php echo Yii::app()->baseUrl; ?>/admin/member/suspendBusiness";

        var formData = jQ('#member-form').serialize();
        var formData = formData + '&id=' + userId + '&subject=' + subjectControl.val() + '&message=' + messageControl.val();

        jQ.ajax({
            type: "POST",
            url: URL,
            data: formData,
            success: function (result) {
                if (result == 'success') {
                    jQ(".profile_suspend_account").fadeOut();
                    jQ('#screen').removeAttr('style');
                    jQ('body').removeAttr('style'); //return false;

                    window.location.href = "<?php echo Yii::app()->baseUrl.'/admin/member/update?id='.$userId.'&userType='.$userType; ?>";

                }
            },
            error: function (e) {
                alert(e.message);
            }
        });
        return false;
    }

</script>