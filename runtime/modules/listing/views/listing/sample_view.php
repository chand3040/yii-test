 <?php   
 
      $model_new = Samplelisting::model()->find("user_default_listing_id ='".$model->user_default_listing_id."' ");
	  $count = count ( $model_new );
	  if($count == 1){  

	                  $address = Samplelisting::model()->find("user_default_listing_id ='".$model->user_default_listing_id."' ");
          
	                   if($address->user_default_sample_listing_status=='1' || $show == "true")
					   
					   {
						   
						   $notLogguedInText = "";

if( Yii::app()->user->isGuest ){

    $notLogguedInText = "You must be logged in to leave a comment.";

}
						   
								 ?>
								 <div class="sample-previews sample_view" >
<div align="center">
    	<h1 class="headertitle"><?php echo $model->user_default_listing_title;?></h1>
		<p class="listing_no">Listing no<br>
		#<?php echo $model->user_default_listing_id;?></p>
		<p class="summary"><?php echo $model->user_default_listing_summary; ?></p>
    </div>
    <table>
    	<tr>
   	  <td width="60%" valign="top">
            	<h4 class="Blue">Details of Sample available</h4>
                <div class="gray_box" id="sample_box_1"><?php echo $address->user_default_sample_listing_details; ?></div>
                
                <h4 class="Blue">What feedback the business is looking for</h4>
				<div class="gray_box" id="sample_box_2"><?php echo $address->user_default_sample_listing_feedback; ?></div>
            
            	<h4 class="Blue">How to obtain a sample</h4>
                <div class="gray_box" id="sample_box_3"><?php echo $address->user_default_sample_listing_obtain; ?></div>
                
                <h4 class="Blue">Special instructions</h4>
				<div class="gray_box" id="sample_box_4"><?php echo $address->user_default_sample_listing_instructions; ?></div>
                
                <h4 class="Blue">Delivery address details</h4>
                <div class="gray_box">
                	
                    <table width="100%">
                    	<tr>
                       	  <td class="gray-text" width="20%">Address 1</td>
                          <td id="address1" class="addressdata" width="30%"><?php echo $address->user_default_sample_listing_company_address1; ?></td>
                          <td class="gray-text" width="20%">Town</td>
                          <td id="address2" class="addressdata" width="30%"><?php echo $address->user_default_sample_listing_company_town; ?></td>
                        </tr>
                        <tr>
                       	  <td class="gray-text">Address 2</td>
                          <td id="address3" class="addressdata"><?php echo $address->user_default_sample_listing_company_address2; ?></td>
                          <td class="gray-text">County</td>
                          <td id="address4" class="addressdata"><?php echo $address->user_default_sample_listing_company_county; ?></td>
                        </tr>
                        <tr>
                       	  <td class="gray-text">Address 3</td>
                          <td id="address5" class="addressdata"><?php echo $address->user_default_sample_listing_company_address3; ?></td>
                          <td class="gray-text">Zip Code</td>
                          <td id="address6" class="addressdata"><?php echo $address->user_default_sample_listing_company_postal; ?></td>
                        </tr>
						
                    </table>
                
    </div>
                <form  action="<?php echo Yii::app()->createUrl('listing/addorder/listid/'.$address->user_default_sample_listing_id);?>"  method="post">
                <h4 class="Blue">Request a sample</h4>
				<div class="gray_box requestbox">
                <table width="100%">
                	<tr>
                    	<td width="30%" class="right titles">Username </td>
                        <td width="30%"><input type="text" name="in1" value="<?php echo Yii::app()->user->getState('username'); ?>"/></td>
                        <td width="40%" rowspan="5" valign="top" class="titles">Instruction to supplier<br><br>
                        <textarea  rows="5" name="instructions"></textarea>
						</td>
                  </tr>
                	<tr><?php 
					if($address->user_default_sample_listing_currency == "1")
					{
						$currency = "$";
					}
					if($address->user_default_sample_listing_currency == "2")
					{
						$currency = "&pound;";
					}
					if($address->user_default_sample_listing_currency == "3")
					{
						$currency = "&euro;";
					}
					?>
                    	<td class="right titles">Cost of sample  <input type="hidden" name="lid" value="<?php echo $_REQUEST['id']; ?>"><input type="hidden" name="currency" value="<?php echo $address->user_default_sample_listing_currency; ?>"></td>
                        <td id="cost"><?=$currency;?><?php echo $address->user_default_sample_listing_cost; ?></td>
                  </tr>
                	<tr>
                    	<td class="right titles">Cost of packing </td>
                        <td id="packing"><?=$currency;?><?php echo $address->user_default_sample_listing_packaging; ?></td>
                  </tr>
                	<tr>
                    	<td class="right titles">Quantity required </td>
                        <td><input type="text" name="quantity" id="quantity" /></td>
                  </tr>
                	<tr>
                    	<td  class="right titles">Total cost </td>
                        <td><input type="text" name="total" id="total"/></td>
                  </tr>
                	</table>
					<br>
                    <input type="checkbox" name="chk1" id="chk1" style="    vertical-align: bottom;"/> <label for="chk1" class="chk1">By ticking the checkbox on the left I hereby confirm that I have read and understood the literature accompanying the sample. I agree to use the sample in a safe and responsible manner. I shall also agree to give any</label>
			<br><br>
               <div class="sample-buttons-box"><span class="stext">Submit</span><button class="sample_submit" name="login_sbmt" type="submit" title="order sample"><img style="border-radius:5px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png" width="25"></button>
					</div> 
            </div>
            </td>
            
            <td width="30%" valign="top">
            	<h4 class="Blue" align="center">Request a sample</h4>
                <div class="gray_box rightbox">
                	<p>Lorem ipsum dolor sit amet, eos at tritani ullamcorper, vim ei vitae oporteat volutpat, vel et atqui tibique.</p>
                    
                    <p>Lorem ipsum dolor sit amet, eos at tritani ullamcorper, vim ei vitae oporteat volutpat, vel et atqui tibique.</p>
                    
                    <p>Lorem ipsum dolor sit amet, eos at tritani ullamcorper, vim ei vitae oporteat volutpat, vel et atqui tibique. Lobortis inciderint ad has, has an illum alterum consulatu. Inani option ex cum, est in illum dissentias, labore impetus legimus sed ne.</p>
                    <a href="#" class="link">Sample information / specifications</a>
                    <table width="100%">
                    	<tr>
                        	<td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_specs){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_specs);} ?>' target="_blank"><br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                        	<td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_specs){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_specs);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                         </tr>
                    </table>
                                        
                    <br>
                    <a href="#" class="link">How to use the sample</a>
                    <table width="100%">
                    	<tr>
                        	<td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_instruction){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_instruction);} ?>' target="_blank"><br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                        	<td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_instruction){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_instruction);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                         </tr>
                    </table>
                    
                    <br>
                    <a href="#" class="link">Any known Health & Saftey issues</a>
                   <table width="100%">
                    	<tr>
                        	<td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_safety){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_safety);} ?>' target="_blank"><br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                        	<td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_safety){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_safety);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                         </tr>
                    </table>
                    
                    
                    <br>
					<p class="voicetext">Check the forum at <a href="#" onclick="jQuery('#tabshow2').click();">Voice your opinion</a> for discussions regarding the sample, before you order.</p>
                </div>
                
                <div class="gray_box white_box" align="center" id="sample_image">
                	
					 <?php  
                if($address->user_default_sample_listing_company_image){
                    $img = $address->user_default_sample_listing_company_image;
                     $img_src = Yii::app()->baseUrl.'/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/'.$img;
                    ?>
                    <img src="<?php echo $img_src;?>" width="50%" align="middle" style="    height: 101px;"/>

                <?php }else {
                ?>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/serverid.jpg" style="    height: 101px;" width="50%" align="middle"/>

                <?php }
                ?>
                </div>
            	
            </td>
        </tr>
    </table> 
 </form>



        <div style="display: none;" class="white_content confirm-email" id="light1">
          <div class="u-email-box" style="width: 615px !important;">
            <img src="<?=Yii::app()->theme->getBaseUrl().'/images/robot/Robot-pointing-down.png';?>" style="z-index:999999; position:relative; top:0px;" alt="">
            <div class="my-account-popup-box" style="margin-top:-38px !important;  width: 550px;">
              <a title="Close" href="javaScript:void(0)" onclick="forum.closeNotification();" class="pu-close">X</a>
              <br>
              <h2 class="Blue" style="color: #f3782c !important;">Oops.</h2>
              <h2 class="Blue text-message" style="color: #231f20 !important;">You must be logged in to continue.</h2>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <input name="cancel" id="cancel" value="Close" type="button" onclick="feedback.closeNotification();" class="button black"  />
            </div>
          </div>
        </div>
		<div class="clear"></div>
		<hr>
		<div class="clear"></div>
		
		</div>
		<?php /* ?>
		<div id="voice-your-opinion" class="feedback_box" data-listingid="<?=$address->user_default_sample_listing_id;?>" >
		    <div class="headings" style="text-align: center;">
            <h2>Customer Feedback</h2>
    </div>
		
		            <div class="clear"></div>
            <div class='postBlock'>
                <form class="submit-comment" data-commentreference="0" action="">
                        <br />
						<div class="feedback_left" style="float: left;width: 20%;">
						<h4>click the stars to rate</h4>
						<?php
						$this->widget('ext.DzRaty.DzRaty', array(
    'name' => 'your_rating',
	
	'options' => array(
		'path' => Yii::app()->request->baseUrl. '/assets/50c19f9d/img',
	  	'half' => TRUE,
		'starOff' => 'star-off.png',
		'starOn' => 'star-on.png',
		'starHalf' => 'star-half.png',
	  	'cancelOff' => 'cancel-off.png',
	  	'cancelOn' => 'cancel-on.png',
		'click' => "js:function(score, evt){ $('#rating').val(score); }"
	),
	));
?>
<input type="hidden" id="rating" value="">
</div><div class="feedback_right" style="float: right;width: 80%;">
                        <textarea class="feedback_message" placeholder="<?=$notLogguedInText;?>" name="feedback_message" style="width: 85%;"></textarea>
                        <!--<div class="submitBtn">--><a class="dd_feedback_button" title="Submit comment">Post</a><!--</div>-->
                   </div> </form>
                <br/>
            </div>
			</div>
<div class="clear"></div>

<div class="current_rating" style="text-align:center;    margin-top: 10px;">
<div id="current_rating" style="    margin-left: 320px;">
<?php

//$countcomments = Samplefeedback::getTotalFeedbacksbyid($address->user_default_sample_listing_id);
//$countrating = Samplefeedback::getTotalFeedbacks();
$listingrating = $countcomments[0]['ratings'] / $countrating[0]['total_comments'];

						$this->widget('ext.DzRaty.DzRaty', array(
    'name' => 'total_rating','value' =>$listingrating,
	'options' => array(
		'path' => Yii::app()->request->baseUrl. '/assets/50c19f9d/img',
	  	'half' => TRUE,
		'starOff' => 'star-off.png',
		'starOn' => 'star-on.png',
		'starHalf' => 'star-half.png',
	  	'cancelOff' => 'cancel-off.png',
	  	'cancelOn' => 'cancel-on.png',
	),
	));
	?>
	</div>
	<span id="rating_details">
	<?php 
	if($countcomments[0]['ratings'] > 0)
	{
		echo $listingrating;
?>
 out of 5 stars
<?php 
	}
	?>
	</span>
</div>

<div class="feedbackpage" id="feedbackpage">

<?php 
//$this->renderPartial('/listing/sample_fetch', array('address' => $address));
?>
			
			</div>

<?php  
*/

	  }
	  
	  }
			
?>

<script>
var ccost = "<?php echo $address->user_default_sample_listing_cost; ?>";
$("#quantity").bind("keyup change", function(e) {
    $('#total').val(ccost * $('#quantity').val());
});
</script>
