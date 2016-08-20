<?php
$lid=$_REQUEST['listid'];
?>
<div class="confirm" style="display: block; background: none;" >
    <div class="u-email-box success-popup" style="    width: 410px;">
        <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-torso.png" style="z-index:999999; position:relative; top:-2px;" />
        <div class="my-account-popup-box" style="margin-top:-38px !important;padding: 10px 12px 24px;">
            <h2>Success</h2>
            <p><b>You have successfully submitted your sample for approval.<br>

                    Once approved your sample will be live.</b></p>
            <p><em><b>You will be notified when your sample has been published</em></b></p>
            <div class="center-button"><a href="<?php echo Yii::app()->createUrl('listing'); ?>" class="black button">Close</a></div>
            <!-- <table align="center" width="100%">
               <tr>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
               </tr>
                 <tr>
             </tr>
             </table>-->
        </div>
    </div>
</div>
<!-- end close--> 