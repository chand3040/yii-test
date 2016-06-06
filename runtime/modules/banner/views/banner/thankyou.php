<?php
$this->breadcrumbs = array(
    'my account' => Yii::app()->user->_user_Type == 'user' ? array('/user/myaccount/update') : array('/business/myaccount/update'),
    'manage business listing' => Yii::app()->user->_user_Type == 'user' ? array('/listing') : array('/businesslisting'),
    'my marketing tools',
);
$currencyConveter = new ECurrencyConverter();
$currencyConveter->currencyConverter();
if (Yii::app()->user->_user_Type == 'user') {
    $UserData = User::model()->findByPk(Yii::app()->user->getID());
    $Currency = Currency::model()->findByPk($UserData->user_default_currency);
} else {
    $UserData = Business::model()->findByPk(Yii::app()->user->getID());
    $Currency = Currency::model()->findByPk($UserData->user_default_business_currency);
}
?>


<div id="displayDialog" style="display: none;"><?php echo $displayDialog; ?></div>
<div id="registration-tabs"><a href="javascript:void(0);">My Account</a>
<style>
.table_style1 td { font-size:10px}
</style>
    <div class="clear"></div>
</div>

<div class="registration-content banner-add-section" style="min-height:580px;float:left;">
<div class="my-account-links">
    <?php
    $this->renderPartial("//layouts/my-account-links");
    ?>
</div>
<div class="marketing_tab">
<div class="row">
    <div class="heading_part">
        <h1>My Marketing Tools</h1>

        <h2>Marketing tools for
              <span class="orange-color">
              <?php
              $title = '';
              $listId = Yii::app()->request->getParam('listid');
              if (Yii::app()->user->_user_Type == 'user') {
                  $listData = UserDefaultListing::model()->findByPk(array('user_default_listing_id' => $listId));
                  $title = $listData->user_default_listing_title;
              } else {
                  $listData = Businesslisting::model()->findByPk(array('user_default_business_blid' => $listId));
                  $title = $listData->user_default_business_title;
              }
              print ucfirst($title);
              ?>
              </span>
        </h2>

        <p class="darkGrey-text">Market your listing to business supermarket members and your social network
            contacts</p>

            </div>
        </div>
        <div class="col-md-12">
            <div id="payment_robot_pic">
			    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/robot-torso.png" width="168" height="135" alt="Robot pointing to login form">
			</div>
            <div id="box3" class="payment_success_container">
			    <div id="tabs_content_container">
			        <div id="servicetab1" class="tab_content" style="display: block;">
			           <h2 class="Blue">Success</h2>
			           </br>
			           <p>
			           	You have successfully offered points to all users who <span class="orange-color size-12"><?php echo @$purchasePoints; ?></span>
						visit your listing and make a vote on your marketing
						question</p>
						</br>
						<p>

						Your users will get a further points if the take part in <span class="orange-color size-12"><?php echo @$purchasePoints; ?></span>
your forum and leave a comment
			                  
			                   <!-- Link take user to Support Section -->
			               </span>
			           </p>
			           </br>
			            <p>
			           	<input type="button" name="pop_close" class="button black" onclick="window.location.href='<?php echo Yii::app()->createAbsoluteUrl('businesslisting/business-services');?>?tab=promotions'" value="Close" />
			           </p>
			        </div> <!-- /tab1 Ends -->
			       
			    </div>  <!-- /tabs_content_container Ends -->

			  
			    <div class="clear"></div>
			</div>
		</div>
	</div>
</div>
