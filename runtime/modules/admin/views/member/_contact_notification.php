<div class="send-mail" style="display: block; position: absolute; z-index: 2; top: 340px; left: 420px;">
    <div id="terms-conditions" class="u-email-box">
        <div class="my-account-popup-box">
            <a title="Close" href="javaScript:void(0)" onclick="close_form()" class="pu-close">X</a>

            <h2 style="color:#805CA2;">Send email to member</h2>

            <div id="email_error" class="error_msg"></div>
            <div id="update-table-box">
                <div>&nbsp;</div>
                <table id="update-table" style="background-color:#f1e5e2">
                    <tbody>
                    <tr>
                        <td class="label">Subject<span class="mandatory-field">*</span></td>
                    </tr>
                    <tr>
                        <td><input type="text" id="notification_subject" name="subject" value="Your Profile was Updated"
                                   tabindex="1"></td>
                    </tr>
                    <tr>
                        <td class="label">Message <span class="mandatory-field">*</span></td>
                    </tr>
                    <tr>
                        <td><textarea id="notification_message" name="email_message"
                                      placeholder="Please enter your message here" rows="3" cols="50"
                                      tabindex="2" style="width: 98%;"></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    </tbody>
                </table>

                <span class="left">
                <input name="btncancel" value="Cancel" id="btncancel" type="button" class="button black"
                       onclick="close_form()"/>&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="btnsendemail" value="Send" id="btnsendemail" type="button" class="button update-green"
                       onclick="notify_contact()"/>
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
        jQ(".send-mail").fadeOut();
    }

    // Notify the updation
    function notify_contact() {

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
        var URL = (userType == 'default_user') ? "<?php echo Yii::app()->baseUrl; ?>/admin/member/sendmail" : "<?php echo Yii::app()->baseUrl; ?>/admin/member/sendmailBusiness";

        var formData = jQ('#member-form').serialize();
        var formData = formData + '&id=' + userId + '&subject=' + subjectControl.val() + '&message=' + messageControl.val();

        jQ.ajax({
            type: "POST",
            url: URL,
            data: formData,
            success: function (result) {
                if (result == 'success') {
                    jQ(".send-mail").fadeOut();
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