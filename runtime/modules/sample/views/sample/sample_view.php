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

        $userid = $model->user_default_profiles_id;
        $userdata = User::model()->findByPk($userid);
        $userfolder = $userdata['user_default_username'] . '_' . $userdata['user_default_id'];

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
                        <div style="height:auto;" class="gray_box" id="sample_box_1"><!--<span class="width_20">&nbsp;</span>--><?php
                            $count = str_word_count($address->user_default_sample_listing_details);
                            $expaln = implode(' ', array_slice(explode(' ', $address->user_default_sample_listing_details), 0, 50));
                            ?>
                            <div class="explain" style="overflow: hidden;">
                                <?php echo $expaln; if($count > 50) { ?>&nbsp;&nbsp;<a onclick="jQuery('.explainfull').show();jQuery('.explain').hide();" class="more readmore">Read more &gt;&gt;</a><?php } ?>
                            </div>
                            <div class="explainfull" style="display:none;">
                                <?php echo $address->user_default_sample_listing_details; ?> &nbsp;&nbsp; <a
                                    onclick="jQuery('.explain').show();jQuery('.explainfull').hide();" class="more readmore">Read
                                    less &gt;&gt;</a>
                            </div>
                        </div>
                        <h4 class="Blue">What feedback the business is looking for</h4>
                        <div style="height:auto;" class="gray_box" id="sample_box_2"><!--<span class="width_20">&nbsp;</span>--><?php
                            $count1 = str_word_count($address->user_default_sample_listing_feedback);
                            $expaln = implode(' ', array_slice(explode(' ', $address->user_default_sample_listing_feedback), 0, 50));
                            ?>
                            <div class="explain1" style="overflow: hidden;">
                                <?php echo $expaln; if($count1 > 50) {  ?>&nbsp;&nbsp;<a onclick="jQuery('.explainfull1').show();jQuery('.explain1').hide();" class="more readmore">Read more &gt;&gt;</a><?php } ?>
                            </div>
                            <div class="explainfull1" style="display:none;">
                                <?php echo $address->user_default_sample_listing_feedback; ?> &nbsp;&nbsp; <a
                                    onclick="jQuery('.explain1').show();jQuery('.explainfull1').hide();" class="more readmore">Read
                                    less &gt;&gt;</a>
                            </div>
                        </div>
                        <h4 class="Blue">How to obtain a sample</h4>
                        <div style="height:auto;" class="gray_box" id="sample_box_3"><!--<span class="width_20">&nbsp;</span>--><?php
                            $count2 = str_word_count($address->user_default_sample_listing_obtain);
                            $expaln = implode(' ', array_slice(explode(' ', $address->user_default_sample_listing_obtain), 0, 50));
                            ?>
                            <div class="explain2" style="overflow: hidden;">
                                <?php echo $expaln; if($count2 > 50) {  ?>&nbsp;&nbsp;<a onclick="jQuery('.explainfull2').show();jQuery('.explain2').hide();" class="more readmore">Read more &gt;&gt;</a><?php } ?>
                            </div>
                            <div class="explainfull2" style="display:none;">
                                <?php echo $address->user_default_sample_listing_obtain; ?> &nbsp;&nbsp; <a
                                    onclick="jQuery('.explain2').show();jQuery('.explainfull2').hide();" class="more readmore">Read
                                    less &gt;&gt;</a>
                            </div>
                        </div>
                        <?php /* ?>
            	<h4 class="Blue">Details of Sample available</h4>
                <div class="gray_box" id="sample_box_1"><?php echo $address->user_default_sample_listing_details; ?></div>
                
                <h4 class="Blue">What feedback the business is looking for</h4>
				<div class="gray_box" id="sample_box_2"><?php echo $address->user_default_sample_listing_feedback; ?></div>
            
            	<h4 class="Blue">How to obtain a sample</h4>
                <div class="gray_box" id="sample_box_3"><?php echo $address->user_default_sample_listing_obtain; ?></div>
                
                <h4 class="Blue">Special instructions</h4>
				<div class="gray_box" id="sample_box_4"><?php echo $address->user_default_sample_listing_instructions; ?></div>
                <?php */ ?>
                        <h4 class="Blue">Delivery address details</h4>
                        <div class="gray_box">

                            <table width="100%">
                                <tr class="addresstr">
                                    <td class="gray-text" width="20%">Address 1</td>
                                    <td id="address1" class="addressdata" width="30%"><?php echo $address->user_default_sample_listing_company_address1; ?></td>
                                    <td class="gray-text" width="20%">Town</td>
                                    <td id="address2" class="addressdata" width="30%"><?php echo $address->user_default_sample_listing_company_town; ?></td>
                                </tr>
                                <tr class="addresstr">
                                    <td class="gray-text">Address 2</td>
                                    <td id="address3" class="addressdata"><?php echo $address->user_default_sample_listing_company_address2; ?></td>
                                    <td class="gray-text">County</td>
                                    <td id="address4" class="addressdata"><?php echo $address->user_default_sample_listing_company_county; ?></td>
                                </tr>
                                <tr class="addresstr">
                                    <td class="gray-text">Address 3</td>
                                    <td id="address5" class="addressdata"><?php echo $address->user_default_sample_listing_company_address3; ?></td>
                                    <td class="gray-text">Zip Code</td>
                                    <td id="address6" class="addressdata"><?php echo $address->user_default_sample_listing_company_postal; ?></td>
                                </tr>

                            </table>

                        </div>
                        <form id="order-form" action="<?php echo Yii::app()->createUrl('sample/addorder');?>"  method="post">
                            <h4 class="Blue">Request a sample</h4>
                            <div class="gray_box requestbox">
                                <table width="100%">
                                    <tr>
                                        <td width="30%" class="right titles">Username </td>
                                        <input type="hidden" name="listid" value="<?php echo $address->user_default_sample_listing_id; ?>">
                                        <input type="hidden" name="mainlistid" value="<?php echo $address->user_default_listing_id; ?>">
                                        <td width="30%"><input type="text" name="in1" value="<?php echo Yii::app()->user->getState('username'); ?>"/></td>
                                        <td width="40%" rowspan="5" valign="top" class="titles">Instruction to supplier<br><br>
                                            <textarea  rows="5" name="instructions" id="instructions"><?php echo $address->user_default_sample_listing_instructions; ?></textarea>
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
                                        <td><input type="text" name="total" id="total" readonly="true"/></td>
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
                                    <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_specs){  echo Yii::app()->createUrl('/listing/viewpdf?filename='.$address->user_default_sample_listing_att_specs);} ?>' target="_blank"><br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                                    <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_specs){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_specs);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                                </tr>
                            </table>

                            <br>
                            <a href="#" class="link">How to use the sample</a>
                            <table width="100%">
                                <tr>
                                    <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_instruction){  echo Yii::app()->createUrl('/listing/viewpdf?filename='.$address->user_default_sample_listing_att_instruction);} ?>' target="_blank"><br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                                    <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_instruction){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_instruction);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                                </tr>
                            </table>

                            <br>
                            <a href="#" class="link">Any known Health & Saftey issues</a>
                            <table width="100%">
                                <tr>
                                    <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_safety){  echo Yii::app()->createUrl('/listing/viewpdf?filename='.$address->user_default_sample_listing_att_safety);} ?>' target="_blank"><br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
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
                                $img_src = Yii::app()->baseUrl.'/upload/users/'.$userfolder.'/listing/big/'.$img;
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
        <div id="voice-your-opinions" class="feedback_box" data-listingid="<?=$address->user_default_sample_listing_id;?>" >
            <div class="white_content confirm-email" id="lights" style="display: none;top: 58%;left: 6%;">
                <div class="u-email-box" style="width: 615px !important;">
                    <img src="<?=Yii::app()->theme->getBaseUrl().'/images/robot/Robot-pointing-down.png';?>" style="z-index:999999; position:relative; top:0px;" alt="">
                    <div class="my-account-popup-box" style="margin-top:-38px !important;  width: 550px;">
                        <a title="Close" href="javaScript:void(0)" onclick="feedback.closeNotification();" class="pu-close">X</a>
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
            <div class="headings" style="text-align: center;">
                <h2>Customer Feedback</h2>
            </div>

            <div class="clear"></div>
            <div class='postBlock'>
                <form class="submit-comment" data-commentreference="0" action="">
                    <br />
                    <div class="feedback_left" style="margin-top: 10px;float: left;width: 15%;">
                        <h4>click the stars to rate</h4>
                        <?php
                        $pathBootstrap = Yii::app()->assetManager->publish( Yii::getPathOfAlias('ext.DzRaty.assets') );

                        $this->widget('ext.DzRaty.DzRaty', array(
                            'name' => 'your_rating',

                            'options' => array(
                                'path' => $pathBootstrap. '/img',
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
                    </div><div class="feedback_right" style="float: right;width: 84%;">
                        <textarea class="feedback_message" placeholder="<?=$notLogguedInText;?>" name="feedback_message" style="width: 85%;"></textarea>
                        <!--<div class="submitBtn">--><a class="dd_feedback_button" id="dd_feedback_button" title="Submit comment">Post</a><!--</div>-->
                    </div> </form>
                <br/>
            </div>

            <div class="clear"></div>

            <div class="current_rating" style="text-align:center;    margin-top: 10px;">
                <div id="current_rating" style="    margin-left: 320px;">
                    <?php

                    $countcomments = Samplefeedback::getTotalFeedbacksbyid($address->user_default_sample_listing_id);
                    $countrating = Samplefeedback::getTotalFeedbacks($address->user_default_sample_listing_id);

                    $listingrating = number_format($countcomments[0]['ratings'] / $countrating[0]['total_comments'], 1, '.', '');

                    ?>
                    <input type="hidden" id="current_rating_value" value="<?php echo $listingrating; ?>">
                    <?php
                    $this->widget('ext.DzRaty.DzRaty', array(
                        'name' => 'total_rating','value' =>$listingrating,
                        'options' => array(
                            'path' => $pathBootstrap. '/img',
                            'half' => TRUE ,
                            'starOff' => 'star-off.png',
                            'starOn' => 'star-on.png',
                            'starHalf' => 'star-half.png',
                            'cancelOff' => 'cancel-off.png',
                            'cancelOn' => 'cancel-on.png',
                            'readOnly' => TRUE,
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
                <p>&nbsp;</p>
                <p class="gray-text"><i>Click on star rating bar to filter comments to show selected feedback rating first</i></p>
            </div>

            <div class="feedbackpage" id="feedbackpage">

                <?php
                $this->renderPartial('//../modules/sample/views/sample/sample_fetch', array('address' => $address));
                //$this->renderPartial('sample_fetch', array('address' => $address));
                ?>
            </div>
        </div>
        <?php
        $this->renderPartial('//../modules/sample/views/sample/sample_js', array('address' => $address));

    }

}

?>

<script>
    var ccost = "<?php echo $address->user_default_sample_listing_cost; ?>";
    var cpacking = "<?php echo $address->user_default_sample_listing_packaging; ?>";
    $("#quantity").bind("keyup change", function(e) {
        $('#total').val(ccost * cpacking * $('#quantity').val());
    });

    $(".sample_submit").on("click",function(){

        var failedvalidation = false;
        var instructions = document.getElementById("instructions").value;
        var quantity = document.getElementById("quantity").value;
        <?php
        if(Yii::app()->user->getState('uid') == "")
        {
        ?>
        $("#instructions").addClass('mandatoryerror');
        $("#instructions").attr('placeholder','You must have logged in to order..');
        failedvalidation = true;
        <?php
        }
        else
        {
        ?>
        if(instructions == "")
        {
            $("#instructions").addClass('mandatoryerror');
            $("#instructions").attr('placeholder','Enter Instructions');
            failedvalidation = true;
        }
        else
        {
            $("#instructions").removeClass('mandatoryerror');
        }

        if(quantity == "")
        {
            $("#quantity").addClass('mandatoryerror');
            $("#quantity").attr('placeholder','Enter Quantity');
            failedvalidation = true;
        }
        else
        {
            $("#quantity").removeClass('mandatoryerror');
        }

        <?php
        }
        ?>


        if (failedvalidation)
        {	return false;
        }else {
            $("#order-form").submit();
        }
    });

</script>
