<?php 

$listing_id = $model->user_default_listing_id;
				 $listing = Listings::model()->findByPk($listing_id);
				 $userid = $listing->user_default_profiles_id;
				 $userdata = User::model()->findByPk($userid);
				 $userfolder = $userdata['user_default_username'] . '_' . $userdata['user_default_id']; 
				 
				 if($model->user_default_sample_listing_currency == "1")
					{
						$currency = "$";
					}
					if($model->user_default_sample_listing_currency == "2")
					{
						$currency = "&pound;";
					}
					if($model->user_default_sample_listing_currency == "3")
					{
						$currency = "&euro;";
					}
					?>
	<form action="" method="post" id="listingform">				
<div style="width: 100%; overflow: hidden;">
    <div class="sample_audit" style="float: right;text-align: center">
        <div style="text-align:center">
            <span class="pinkTitle">Samples audit</span>
<?php 
$orders = Sampleorder::model()->findAll("user_default_sample_listing_id ='" . $model->user_default_sample_listing_id . "'" );
$totalorders = count ( $orders );
$outorders = Sampleorder::model()->findAll("user_default_sample_listing_id ='" . $model->user_default_sample_listing_id . "' and 	user_default_sample_listing_order_status = '1'" );
$ordersout = count ( $outorders );
$feeds = Samplefeedback::model()->findAll("user_default_sample_listing_id ='" . $model->user_default_sample_listing_id . "'" );
$totalfeeds = count ( $feeds );
?>
            <h3>Listing Title</h3>

            <h2><?=$listing->user_default_listing_title;?></h2></div>
        <table class="drivestop">
            <tr>
                <td>Samples ordered:</td>
                <td><input type="text" id="sample_ordered" name="sample_ordered" value="<?=$totalorders;?>"></td>
            </tr>
            <tr>
                <td>Samples sent out:</td>
                <td><input type="text" id="sampleSentOut" name="sampleSentOut" value="<?=$ordersout;?>"></td>
            </tr>
            <tr>
                <td>
                   Total cost:
                </td>
                <td><input type="text"  id="total_cost" value="<?php echo $model->user_default_sample_listing_cost; ?>" name="total_cost"></td>
            </tr>
            <tr>
                <td>Feedback received:</td>
                <td><input type="text" name="feedback_received" name="feedback_received" value="<?=$totalfeeds;?>"></td>
            </tr>
        </table>
		<?php
		$history = Samplelisting::model()->findAll("user_default_sample_listing_id !='" . $model->user_default_sample_listing_id . "'" );
$historynos = count ( $history );

$criteria = new CDbCriteria;
$criteria->addCondition('user_default_sample_listing_id != :username');
$criteria->params[ ':username' ] = $model->user_default_sample_listing_id;
$total = Samplelisting::model()->count($criteria);
if($total > 0)
{
	
	
	if (isset($_REQUEST['rows'])) {
            $count = $_REQUEST['rows'];
        } else {
            $count = 1;
        }
	$pages = new CPagination($total);
	$pages->setPageSize($count);
        $pages->applyLimit($criteria);
		
		$posts = Samplelisting::model()->findAll($criteria);
		
		/*
		$this->renderPartial('sampleshistory', array('model' => $model,
            'list' => $posts,
            'pages' => $pages,
            'item_count' => $total,
            'page_size' => Yii::app()->params['listPerPage']
        ));
*/
		
}
?>

    </div>

    <div class="sample-view-container">
	<div class="sample_inner">
 <!--- update profile picture pop up---->
        <div class="photo-upload-box" style="height:955px;display:none">
            <img class="side-robot-upload" style="margin-left:-70px;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/robot/robot-upload.png" alt="Upload your Business Supermarket user profile picture"/>
          <div class="my-account-popup-box" id="upload-frame" style="margin-left: 124px;"> <a class="pu-close" onclick="hide_picture_form();" href="javaScript:void(0)" title="Close">X</a>
            <h2>Upload your profile picture</h2>
            Click <b>Upload Picture...</b> to choose an image from your computer<br />
            Select an image that is 800px by 600px for best fit <br />
            Your image will be automatically uploaded.<br />
            <br />
             <div id="wrap">    
                    <div id="uploader">
                        <div id="big_uploader" style="position: relative;">
                        <div id="notice"><img src="<?php  echo Yii::app()->theme->baseUrl;?>/images/ajax-loader.gif" /></div>
                        <br />
                		<i>Upload image maximum of 100KB.</i>
                        <br /><br />
                        <div id="div_upload_big" class="listing_logo">	                          
                            <?php  
                             /* if($model->user_default_profile_image){
                                  $img = $model->user_default_profile_image;            
                                  ?>
                                  <img src="<?php echo Myaccount::getAvatar($img);?>" alt="<?php echo $model->user_default_first_name.' '.$model->user_default_surname; ?>" height="120" /> 

                              <?php }else {
                                                  $img = 'avatar.jpg';

                              ?>
                              <img src="<?php echo $this->createUrl('/upload/logo/'.$img);?>" alt="Profile picture" height="120" /> 

                              <?php }*/
                              ?>
                		</div>
                		<div id="div_upload_big_new"></div>
                      
                        Browse for a picture on your computer
                        <br /><br />
                        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                                'id'=>'uploadFile',
                                                'config'=>array(
                                                       'action'=>Yii::app()->createUrl('listing/imageupload'),
                                                       'allowedExtensions'=>array("jpg",'png','gif'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                       'sizeLimit'=>100*1024*1024,// maximum file size in bytes
                                                       'minSizeLimit'=>10,// minimum file size in bytes 
                                                       'onComplete'=>"js:function(id, fileName, responseJSON){givealert(responseJSON);}",                                                  
                                                )
                                        )); 
                                    ?>
                    	</div><!-- big_uploader --> 
                           
                    </div><!-- uploader --> 
                </div>            
          </div>
        </div>
       <!--- update profile picture pop up---->
        <div class="orangetitle"><?=$listing->user_default_listing_title;?></div>
		 <div style="margin-bottom: 3px;">
        <label >Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" otherwise cropping will occur.</span></a></label>
    </div><br class="clear"/>
<?php

    $userimage = Samplelistingimages::model()->findAllByAttributes(array("user_default_listing_id" => $model->user_default_listing_id));

    //$username = User::model()->findAllByAttributes(array("user_default_id" => $userid));

    $userfolder = $userdata['user_default_username'] . '_' . $userdata['user_default_id'];


    for ($i = 1; $i <= 5; $i++) {
        ?>
        <div class="photo-upload-box<?php echo $i; ?>" id="photo-upload-box-tab">
            <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-upload.png"
                 alt="Upload your business supermarket user profile picture"/>

            <div class="my-account-popup-box" id="upload-frame">
                <a href="javaScript:void(0);" class="pu-close" onclick='$(".photo-upload-box<?php echo $i; ?>").hide();' 
                   title="Close">X</a>

                <h2>Upload user listing picture</h2>
                Click <b>Browse...</b> to select a picture from your computer<br/>
                Click <b>Preview Picture</b> to see a thumbnail of your image<br/>
                Click <b>Upload Picture</b> to save your profile picture and close this dialog box.<br/>
                <br/>
            </div>
        </div>
        <div class="sl-photo-box admin-photo" style="margin:0; text-align:center">
            <div class="clear"></div>
            <br>

            <div class="sl-photograph image_preview">

                <?php
                if ($userimage[$i - 1]['user_default_listing_image'] != '') {
                    //$img_src='../users/'.$user->get_log_folder($userimage['drg_uid']).'/listing/thumb/'.$data[$i-1]['user_default_listing_image'];
                    //$img_src = Yii::app()->baseUrl.'/upload/users/' . Yii::app()->user->getState('ufolder') . $userfolder.'/listing/big/' . $userimage->user_default_listing_image;
                    $img_src = Yii::app()->baseUrl . '/upload/users/' . $userfolder . '/listing/thumb/' . $userimage[$i - 1]['user_default_listing_image'];

                    ?>
                    <div id="preview_logo_<?php echo $i; ?>">
                        <img src="<?php echo $img_src; ?>" alt='Preview logo' style='    height: 99px;'/>
                    </div>
                    <input type="hidden" name="img_name[]"
                           value="<?php echo $userimage[$i - 1]['user_default_listing_image']; ?>"
                           id="logo_<?php echo $i; ?>"/>
                <?php
                } else {
                    ?>
                    <div id="preview_logo_<?php echo $i; ?>"></div>
                    <input type="hidden" name="img_name[]" value="" id="logo_<?php echo $i; ?>"/>
                <?php
                }
                ?>
				<input type="hidden" value="<?php echo $userimage[$i - 1]->user_default_listing_image_id; ?>" name="current_ids[]" /> 
            </div>
            <!-- File Upload for Company Logo -->
        </div>
    <?php } ?>

    <br class="clear"/>
    <br class="clear"/>

    <div class="slisting-head">
        <label>Enter a short description for each image <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter a short description explaining each image. Please note text is limited to 4 lines.</span></a>
        </label>
    </div>
    <div class="sl-image-description admin-description">
        <?php
        $userimage = Samplelistingimages::model()->findAllByAttributes(array("user_default_listing_id" => $model->user_default_listing_id));
        ?>
        <?php for ($i = 1; $i <= 5; $i++) { ?>
            <div class="img_desc img_desc_text">
                <textarea rows="2" cols="9" class="user_default_listing_image_text"
                          name="user_default_listing_image_text[]" id="image-description-<?php echo $i; ?>"
                          maxlength="80"><?php echo $userimage[$i - 1]['user_default_listing_image_text']; ?></textarea>
                <br>
                Image <?php echo $i; ?> text
            </div>
            <!-- <?php echo $i; ?>Image text -->
        <?php } ?>
        <br class="clear"/>
    </div>

    <br class="clear"/>
    <br class="clear"/>

    <div class="slisting-head">
        <label>Enter a link to each slider <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter either video link or site link for each slider image.</span></a>
        </label>
    </div>
    <div class="sl-image-description admin-description">
        <?php
        $userimage = Samplelistingimages::model()->findAllByAttributes(array("user_default_listing_id" => $model->user_default_listing_id));
        $h = 0;
        for ($i = 1; $i <= 5; $i++) {
            $sitelink = $userimage[$h]->user_default_listing_image_link1;
            $videolink = $userimage[$h]->user_default_listing_image_link2;
            ?>
            <div class="img_desc img_desc_text">
                <?php /* ?><input type="text" class="inp width" name="user_default_listing_image_link1[]"
                       id="slider-sitelink-<?php echo $i; ?>" value="<?php echo $sitelink; ?>"
                       style="background: none repeat scroll 0 0 #F1E5E2;
                border: 1px solid #F1E5E2;
                margin: 1px;
                overflow: hidden;
                padding: 5px 4.5px;
                width:150px;
                resize: none"/>
                <br/>
                Site link<?php echo $i; ?>
                <h3 style="  color: #1dbfd8;">OR</h3>
				<?php */ ?>
                <input type="text" class="inp width" name="user_default_listing_image_link2[]"
                       id="slider-videolink-<?php echo $i; ?>" maxlength="80" value="<?php echo $videolink; ?>"
                       style="background: none repeat scroll 0 0 #F1E5E2;
                   border: 1px solid #F1E5E2;
                   margin:1px;
                   width:150px;
                   overflow: hidden;
                   padding: 5px 4.5px;
                   resize: none;"/>
                <br/>
                Video link<?php echo $i; ?>
            </div>
            <!-- <?php echo $i; ?>Image text -->
            <?php $h++;
        } ?>
        <br class="clear"/>
    </div>
	<br>
        <label>Details of samples available</label>
        <textarea rows="4" name="Samplelisting[user_default_sample_listing_details]" class="textarea-medium"><?=$model->user_default_sample_listing_details;?></textarea>
        <label>What feedback the business is looking for</label>
        <textarea rows="4" name="Samplelisting[user_default_sample_listing_feedback]" class="textarea-medium"><?=$model->user_default_sample_listing_feedback;?></textarea>
        <label>How to obtain a sample</label>
        <textarea rows="4" name="Samplelisting[user_default_sample_listing_obtain]" class="textarea-medium"><?=$model->user_default_sample_listing_obtain;?></textarea>
        <label>Special instructions</label>
        <textarea rows="4" name="Samplelisting[user_default_sample_listing_instructions]" class="textarea-medium" style="width:350px !important"><?=$model->user_default_sample_listing_instructions;?></textarea>

        <label>Company Details</label>

        <div class="company_details">
            <div class="sample_image">
			<?php  
                if($model->user_default_sample_listing_company_image){
                    $img = $model->user_default_sample_listing_company_image;
					
                     $img_src = Yii::app()->baseUrl.'/upload/users/'.$userfolder.'/listing/big/'.$img;
                    ?>
                    <img src="<?php echo $img_src;?>"  style="width:105px;height:100px" />

                <?php }else {
                                    $img = 'avatar.jpg';

                ?>
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/avatar.jpg"/>
                <?php }
                ?>
                

                <div class="clear">&nbsp;</div>
                <?php /* ?><input type="button" class="button black-btn" value="Upload" onClick="show_picture_form();"><?php */ ?>
            </div>
            <div class="company_address" style="float: left;">
                <label>Address 1</label>
                <input type="text" id="address1" name="Samplelisting[user_default_sample_listing_company_address1]" value="<?=$model->user_default_sample_listing_company_address1;?>"/>
                <label>Address 2</label>
                <input type="text" id="address2" name="Samplelisting[user_default_sample_listing_company_address2]" value="<?=$model->user_default_sample_listing_company_address2;?>"/>
                <label>Address 3</label>
                <input type="text" id="address3" name="Samplelisting[user_default_sample_listing_company_address3]" value="<?=$model->user_default_sample_listing_company_address3;?>"/>
                <label>Town</label>
                <input type="text" id="town" name="Samplelisting[user_default_sample_listing_company_town]" value="<?=$model->user_default_sample_listing_company_town;?>"/>
                <label>County</label>
                <input type="text" id="town" name="Samplelisting[user_default_sample_listing_company_county]" value="<?=$model->user_default_sample_listing_company_county;?>"/>
                <label>Zip</label>
                <input type="text" id="town" name="Samplelisting[user_default_sample_listing_company_postal]" value="<?=$model->user_default_sample_listing_company_postal;?>"/>
                <label>Tel no</label>
                <input type="text" id="zip_code" name="Samplelisting[user_default_sample_listing_company_tel]" value="<?=$model->user_default_sample_listing_company_tel;?>"/>
            </div>


            <div style="clear:both;"></div>

        </div>
		<br>
<div class="sl-bottom-buttons admin-button">
    <!--<a href="<?php echo $this->createUrl('delete', array('id' => $model->user_default_listing_id)); ?>" class="button red">Delete</a>-->
   <a href="javaScript:void(0)<?php //echo Yii::app()->createUrl('/admin/listings/listings/rdelete',array('id'=>$model->user_default_listing_id));  ?>"
           onClick="delete_listing()" class="button red">Delete</a>
		   
    <button type="submit" class="button blue">Update</button>
    <?php
    if ($model->user_default_sample_listing_status == 1) {
        ?>
        <a href="javaScript:void(0)" onClick="suspension()" class="button black">Suspend</a>
    <?php
    } else {
        ?>
        <a href="javaScript:void(0)" onClick="publishion()" class="button update-green">Publish</a>
    <?php } ?>
    <div class="clear"></div>
	<input type="hidden" name="ispublish" id="ispublish" value="0">
	<input type="hidden" name="issuspend" id="issuspend" value="0">
</div>

    </div>
	</form>
	<div class="delete_listing black-popup" style="display: none;    position: fixed;
    top: 20%;
    left: 28%;
    z-index: 99999999;">

    <form action="<?php echo $this->createUrl('sampledelete', array('id' => $model->user_default_sample_listing_id)); ?>"   method="post">

        <div class="terms-conditions u-email-box" style="    font-size: 12px;text-align: center;    margin: 0 auto;">
            <div class="my-account-popup-box"  style="    font-size: 12px;text-align: center;    margin: 0 auto;">
                <span>Are you sure you want to delete this listing from the website?</span><br/>
                <span>Warning this action cannot be undone</span><br/><br/><br/>

                <div class="confirmbtn">
                    <button type="submit">OK</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button  onClick="jQuery('.delete_listing').hide();
        return false;">Cancel
                    </button>
                </div>
            </div>
        </div>

    </form>


</div>
</div>
	

	</div>
	
	<style>
	.admin-photo .image_preview {
    width: 106px;
    overflow: hidden;
    height: 99px;
}
.sl-image-description .img_desc_text textarea {
    width: 100px;
    height: 89px;
    font-size: 10px;
}
.sl-image-description .img_desc_text {
    width: 112px;
}
.inp.width {width:100px !important;    background: none repeat scroll 0 0 #e7dfef !important;}
</style>
    <script type="text/javascript">
	function delete_listing() {
    jQuery(".delete_listing").fadeIn();
	//jQuery(".sample_inner").fadeOut();
	
}

	function show_picture_form(){
   jQuery(".my-account-links,#update-table,.fBtn").css({
     'opacity': 0,
     '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
     'filter': 'alpha(opacity=0)'
   });
    jQuery(".photo-upload-box").show();
	jQuery('html, body').animate({scrollTop: jQuery(".photo-upload-box").offset().top}, 350);
 }
function suspension() {
	jQuery("#ispublish").val('0');
    jQuery("#issuspend").val('1');
	jQuery("#listingform").submit();
}
function publishion() {
    jQuery("#issuspend").val('0');
	jQuery("#ispublish").val('1');
	jQuery("#listingform").submit();
}
    </script>

