<?php
if($model!="")
{
	$lid=$model->user_default_listing_id;
?> 
<!--- Confirm close pop up---->        
        
        <br /><br /><br /><br /><br /><br />
        <div class="confirm" style="display: block; background: none;" >
            <div class="u-email-box success-popup" style="margin-left: 24px;"> 
          	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-torso.png" style="z-index:999999; position:relative; top:-2px;" />
            <div class="my-account-popup-box" style="margin-top:-38px !important"> 
              <h2>Success</h2>
 <p><em>You have successfully ordered sample listing.</em></p> 
          
              <?php /* ?><p>An email notification of this change has been sent to your registered email address</p>   <?php */ ?>
              <div class="center-button"><a href="<?php echo Yii::app()->createUrl('/listing/view?id='.$lid); ?>" class="black button">Close</a></div>   
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
<?php
}
else
{
$this->redirect($this->createUrl('/index.php'));
}
?>