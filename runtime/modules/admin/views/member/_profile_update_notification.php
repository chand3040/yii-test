<div class="user-profile-update-notify"
     style="display: block; position: absolute; z-index: 2; top: 340px; left: 420px;">
    <div id="terms-conditions" class="u-email-box">
        <div class="my-account-popup-box">
            <a title="Close" href="javaScript:void(0)" onclick="close_form()" class="pu-close">X</a>

            <h2 style="color:#805CA2;">User Profile Update Notification</h2>

            <div id="update-table-box">

                <div>&nbsp;</div>
                <table id="update-table" style="background-color:#f1e5e2">
                    <tbody>
                    <tr>
                        <td class="label">Subject <span class="mandatory-field">*</span></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="Your Profile was Updated" name="update_subject"
                                   id="notification_subject" tabindex="1" class="value"></td>
                    </tr>
                    <tr>
                        <td class="label">Message <span class="mandatory-field">*</span></td>
                    </tr>
                    <tr>
                        <td><textarea id="notification_message" class="value" name="message"
                                      placeholder="Please enter your message here" rows="3" cols="50"
                                      tabindex="2" style="width: 98%;"></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                    <span class="middle">

                        <input name="btnsend" id="btnsend" value="Send" type="button" class="button update-green"
                               tabindex="3" onclick="notify_updation()"/>
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
        jQ(".user-profile-update-notify").fadeOut();
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
        var URL = (userType == 'default_user') ? "<?php echo Yii::app()->baseUrl; ?>/admin/member/updatenotifyemail" : "<?php echo Yii::app()->baseUrl; ?>/admin/member/updateNotifyEmailBusiness";

        var formData = jQ('#member-form').serialize();
        var formData = formData + '&id=' + userId + '&subject=' + subjectControl.val() + '&message=' + messageControl.val();

        jQ.ajax({
            type: "POST",
            url: URL,
            data: formData,
            success: function (result) {
                if (result == 'success') {
                    jQ(".user-profile-update-notify").fadeOut();
                    jQ('#screen').removeAttr('style');
                    jQ('body').removeAttr('style'); //return false;

                    if (userType == 'default_user')
                        window.location.href = "<?php echo Yii::app()->baseUrl; ?>/admin/member/defaultUsers";
                    else
                        window.location.href = "<?php echo Yii::app()->baseUrl; ?>/admin/member/businessUsers";
                }
            },
            error: function (e) {
                alert(e.message);
            }
        });
        return false;
    }

</script>