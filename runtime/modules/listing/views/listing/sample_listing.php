<?php

$this->breadcrumbs=array(
    'Sample listing'=>array('index')
);
?>
<style>
    #upload1,#upload2,#upload3,#upload4{
        display:none
    }
</style><div class="clear"></div>
<div class="registration-box">
    <div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
        <div class="clear"></div>
    </div>
    <div class="registration-content" style="min-height:580px">
        <div class="my-account-links">
            <?php
            //$this->renderPartial("//layouts/my-account-links");
            $this->renderPartial('//../modules/listing/views/layouts/my-account-links');
            ?>
        </div>
        <div  class="userlistings pl-logo-box " id="addsamplelisting">
            <!--Confirm close pop up-->
            <div class="confirm listingpage" style="width: 98%; height: 94%;  padding-top:30px; margin-top:-40px;">
                <div class="u-email-box">
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:2px;" />
                    <div class="my-account-popup-box" style="margin-top:-38px !important">
                        <a title="Close" href="javaScript:void(0)" onclick="close_form_confirm()" class="pu-close">X</a>
                        <br />
                        <h2 class="Blue">Are you sure you want to leave this page?</h2>
                        <p>Your form data has not been saved  leaving the listing submission process now will result in any data you have submitted being lost.<br /> Please save your listing first.</p>
                        <table align="center" width="100%">
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <button class="button black" title="Close and return to form" name="canle" type="button"  onclick="jQuery('.confirm').hide('slow');">Cancel</button>
                                    <button class="button black" title="Save and close form" onclick="saveforlater();" name="register" type="button"  >Save &#38; Close</button>
                                    <button class="button black" title="Discard ALL data and close form" name="register" type="button" onclick="window.location.href = '<?php echo Yii::app()->createUrl('listing/selectlisting/listid/' . $model->user_default_listing_id); ?>'" >Discard</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end close-->
            <!--- update profile picture pop up---->
            <div class="photo-upload-box" style="height:955px;">
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


            <?php $form=$this->beginWidget('CActiveForm', array('id'=>'sample_listing','enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data',"onSubmit"=>'return form_validation();'))); ?>


            <div class="headings">
                <h2><?php echo $model->user_default_listing_title;?></h2>
                <div class="content">
                    <label class="heading">Listing number: <?php echo $model->user_default_listing_id;?></label><br>
                    <!--<span class="width_20">&nbsp;</span>--><?php
                    $count = str_word_count($model->user_default_listing_summary);
                    $expaln =  implode(' ', array_slice(explode(' ', $model->user_default_listing_summary), 0, 150));
                    ?>

                    <?php echo $expaln; ?><!--&nbsp;&nbsp;<a onclick="jQuery('.explainfull').show();jQuery('.explain').hide();" class="more readmore">Read more &gt;&gt;</a>-->

                    <div class="explainfull" style="display:none;">
                        <?php echo $model->user_default_listing_summary; ?> &nbsp;&nbsp; <a  onclick="jQuery('.explain').show();jQuery('.explainfull').hide();" class="more readmore">Read less &gt;&gt;</a>
                    </div>
                </div>
            </div>

            <br class="clear" />
            <br class="clear" />
            <div style="margin-bottom: 3px;">
                <label style="color:#a84793;">Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" (400px x 300px) otherwise cropping will occur.</span></a></label>
            </div>

            <?php

            $userimage = Sampleimages::model()->findAllByAttributes(array("user_default_listing_lid" => $model->user_default_listing_id));

            $f = 0;
            $old = 0;
            for ($i = 1; $i <= 5; $i++) {
                ?>
                <div class=" listing-upload photo-upload-box<?php echo $i; ?>" id="photo-upload-box-tab" style="height:94%;">
                    <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/robot-upload.png" alt="Upload your Business Supermarket user profile picture"/>
                    <div class="my-account-popup-box" id="upload-frame">
                        <a class="pu-close" onclick='jQuery(".photo-upload-box<?php echo $i; ?>").hide();' href="javaScript:void(0)" title="Close">X</a>
                        <h2>Upload Sample Image</h2>
                        Click <b>Upload Picture...</b> to choose an image from your computer<br />
                        Select an image that is 120px by 120px for best fit <br />
                        Your image will be automatically uploaded.<br />
                        <br />
                        <?php
                        $imagename = "";
                        if ($userimage[$f]->user_default_listing_image != "") {
                            $imagename = $userimage[$f]->user_default_listing_image;
                        }
                        ?>
                        <input type="hidden" id="logo_<?php echo $i; ?>" value="<?php echo $imagename; ?>" name="img_name[]" />
                        <input type="hidden" value="<?php echo $userimage[$f]->user_default_listing_image_id; ?>" name="current_ids[]" />
                        <input type="hidden" value="<?php echo $imagename; ?>" name="old_img_name[]" />
                        <div id="wrap">
                            <div id="uploader">
                                <div id="big_uploader">
                                    <div id="notice"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ajax-loader.gif" /></div>
                                    <i>Upload image maximum of 2MB.</i>
                                    <br/><br/>
                                    <div id="div_upload_big" class="listing_logo" style="height: auto !important;">
                                        <p  style="padding: 42px 10px;">&nbsp;</p>
                                    </div>
                                    <div id="div_upload_big_new"></div>
                                    Browse for a picture on your computer
                                    <br /> <br />
                                    <?php
                                    $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                                        'id' => 'uploadFile' . $i,
                                        'config' => array(
                                            'action' => Yii::app()->createUrl('listing/listingimage'),
                                            'allowedExtensions' => array("jpg", 'png', 'gif'), //array("jpg","jpeg","gif","exe","mov" and etc...
                                            'sizeLimit' => 30 * 1024 * 1024, // maximum file size in bytes
                                            'minSizeLimit' => 10, // minimum file size in bytes
                                            'onComplete' => "js:function(id, fileName, responseJSON){getUploadfilename(responseJSON," . $i . ");}",
                                        )
                                    ));
                                    ?>
                                </div><!-- big_uploader -->
                            </div><!-- uploader -->
                        </div>
                    </div>
                </div>
                <div class="sl-photo-box" style="margin:0px; text-align:center">
                    <div class="clear"></div>
                    <br />
                    <div class="sl-photograph image_preview" id="image_preview<?php echo $i; ?>">
                        <?php
                        if ($imagename != "") {
                            ?>
                            <img title="<?php echo $userimage[$f]->user_default_listing_image_text; ?>" alt="<?php echo $userimage[$f]->user_default_listing_image_text; ?>" src="<?php echo Yii::app()->baseUrl; ?>/upload/users/<?php echo Yii::app()->user->getState('ufolder'); ?>/listing/thumb/<?php echo $userimage[$f]->user_default_listing_image; ?>" height="104" />
                            <?php
                            $old++;
                        } else {
                            ?><p class="listing_imagesize_text">
                                image size 6" x 4"

                                (400px x 300px)

                                for best fit
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- File Upload for Company Logo -->
                    <div style="margin:10px 0 0 7px;">
                        <a class="button gray" title="Upload logo" onClick="show_picture_formnew('photo-upload-box<?php echo $i; ?>')" href="javaScript:void(0)" id="uplaod-logo-<?php echo $i; ?>" > &nbsp; Select Image &nbsp;</a>
                    </div>
                </div>
                <?php
                $f++;
            }
            ?>
            <input type="hidden" value="<?php echo $old ?>" name="oldimage" id="oldimage" />
            <br class="clear" />
            <br class="clear" />
            <!-- Image text starts here -->
            <div class="slisting-head">
                <p>Enter a short description for each image <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter a short description explaining each image. Please note text is limited to 4 lines.</span></a></p>
            </div>
            <!-- Title -->
            <div class="sl-image-description">
                <?php
                $userimage = Sampleimages::model()->findAllByAttributes(array("user_default_listing_lid" => $model->user_default_listing_id));
                $g = 0;
                for ($i = 1; $i <= 5; $i++) {
                    $imagedesc = $userimage[$g]->user_default_listing_image_text;
                    ?>
                    <div class="img_desc img_desc_text txtarea">
                        <textarea rows="2" cols="9" class="drg_imgdesc" name="user_default_listing_image_text[]" id="image-description-<?php echo $i; ?>" maxlength="80"><?php echo $imagedesc; ?></textarea>
                        <br>
                        Image <?php echo $i; ?> text
                    </div>
                    <?php
                    $g++;
                }
                ?>
            </div>
            <br class="clear" />
            <br class="clear" />
            <div class="slisting-head">
                <p>Enter a link for each slider <a class="sl-tip tooltip" href="#;">?
                        <span class="classic">Enter video link for each slider image.</span>
                    </a>
                </p>
            </div>
            <div class="sl-image-description admin-description">
                <?php $userimage = Sampleimages::model()->findAllByAttributes(array("user_default_listing_lid" => $model->user_default_listing_id));
                ?>
                <?php
                $h = 0;
                for ($i = 1; $i <= 5; $i++) {
                    $sitelink = $userimage[$h]->user_default_listing_image_link1;
                    $videolink = $userimage[$h]->user_default_listing_image_link2;
                    ?>
                    <div class="img_desc img_desc_text ylinks">
                        <!--<input type="text" class="inp width" name="user_default_listing_image_link1[]" id="slider-sitelink-<?php echo $i; ?>" value="<?php echo $sitelink; ?>"
                           style="background: none repeat scroll 0 0 #F1E5E2;  border: 1px solid #F1E5E2;  margin: 6px 0 10px;width: 126px;  overflow: hidden;  padding: 5px 4.5px;  resize: none" />

                                                       <br>

                                                       Site link<?php echo $i; ?>

                                                       <h3 style="  color: #1dbfd8;">OR</h3>-->

                        <input type="text" class="inp width ibox" name="user_default_listing_image_link2[]" id="slider-videolink-<?php echo $i; ?>" maxlength="80" value="<?php echo $videolink; ?>" style="" />

                        <br>

                        Video link<?php echo $i; ?>

                    </div>

                    <!-- <?php echo $i; ?>Image text -->

                    <?php
                    $h++;
                }
                ?>

                <br class="clear" />

            </div>

            <br class="clear" />

            <br class="clear" />

            <?php
            $model_new = Samplelisting::model()->find("user_default_listing_id ='".$model->user_default_listing_id."' ");
            if($model_new){
                $address = Samplelisting::model()->find("user_default_listing_id ='".$model->user_default_listing_id."' ");
            }
            else {
                $address = new Samplelisting;
            }

            echo $form->hiddenField($address,'user_default_sample_listing_company_image',array('size'=>60,'maxlength'=>100)) ?>

            <div class="clear">&nbsp;</div>
            <div class="sl-basic-info">
                <label class="Blue"><?php echo $form->labelEx($address,'user_default_sample_listing_details'); ?></label>
                <?php

                echo $form->textArea($address,'user_default_sample_listing_details',array('id'=>'user_default_sample_listing_details','tabindex'=>'1' ,'style'=>'height:60px;' ,'class'=>'threeareas','onfocus'=>"getNormal('#drg_list_businessidea');",));
                echo $form->error($address,'user_default_sample_listing_details');
                ?>

            </div>

            <div class="sl-basic-info">
                <label class="Blue"><?php echo $form->labelEx($address,'user_default_sample_listing_feedback'); ?></label>
                <?php

                echo $form->textArea($address,'user_default_sample_listing_feedback',array('id'=>'user_default_sample_listing_feedback','tabindex'=>'2' ,'style'=>'height:60px;' ,'class'=>'threeareas','onfocus'=>"getNormal('#drg_list_businessidea');",));
                echo $form->error($address,'user_default_sample_listing_feedback');
                ?>

            </div>

            <div class="sl-basic-info">
                <label class="Blue"><?php echo $form->labelEx($address,'user_default_sample_listing_obtain'); ?></label>
                <?php

                echo $form->textArea($address,'user_default_sample_listing_obtain',array('id'=>'user_default_sample_listing_obtain','tabindex'=>'3' ,'style'=>'height:60px;' ,'class'=>'threeareas','onfocus'=>"getNormal('#drg_list_businessidea');",));
                echo $form->error($address,'user_default_sample_listing_obtain');
                ?>

            </div>



            <div class="sample_listing_left">

                <div class="sl-basic-info">
                    <label class="Blue"><?php echo $form->labelEx($address,'user_default_sample_listing_instructions'); ?></label>
                    <?php

                    echo $form->textArea($address,'user_default_sample_listing_instructions',array('id'=>'user_default_sample_listing_instructions','tabindex'=>'4' ,'style'=>'height:60px;' ,'class'=>'onearea','onfocus'=>"getNormal('#drg_list_businessidea');",));
                    echo $form->error($address,'user_default_sample_listing_instructions');
                    ?>

                </div>


                <div class="sl-basic-info">
                    <label  class="Blue">Company Details</label>
                </div>
                <div  class="main-my-account">
                    <div class="my-account-left">

                        <table id="reg-table" class="sample-table">
                            <tr>
                                <td class="darkGrey-text"><?php echo $form->labelEx($address,'user_default_sample_listing_company_address1'); ?></td>
                                <td><?php echo $form->textField($address,'user_default_sample_listing_company_address1',array('size'=>60,'maxlength'=>500,'class'=>'inputfield')); ?></td>
                                <?php echo $form->error($address,'user_default_sample_listing_company_address1'); ?>
                            </tr>

                            <tr>
                                <td class="darkGrey-text"><?php echo $form->labelEx($address,'user_default_sample_listing_company_address2'); ?></td>
                                <td><?php echo $form->textField($address,'user_default_sample_listing_company_address2',array('size'=>60,'maxlength'=>500,'class'=>'inputfield')); ?></td>
                                <?php echo $form->error($address,'user_default_sample_listing_company_address2'); ?>
                            </tr>

                            <tr>
                                <td class="darkGrey-text"><?php echo $form->labelEx($address,'user_default_sample_listing_company_address3'); ?></td>
                                <td><?php echo $form->textField($address,'user_default_sample_listing_company_address3',array('size'=>60,'maxlength'=>500,'class'=>'inputfield')); ?></td>
                                <?php echo $form->error($address,'user_default_sample_listing_company_address3'); ?>
                            </tr>

                            <tr>
                                <td class="darkGrey-text"><?php echo $form->labelEx($address,'user_default_sample_listing_company_town'); ?></td>
                                <td><?php echo $form->textField($address,'user_default_sample_listing_company_town',array('size'=>60,'maxlength'=>100,'class'=>'inputfield')); ?></td>
                                <?php echo $form->error($address,'user_default_sample_listing_company_town'); ?>
                            </tr>

                            <tr>
                                <td class="darkGrey-text"><?php echo $form->labelEx($address,'user_default_sample_listing_company_county'); ?></td>
                                <td>
                                    <?php echo $form->textField($address,'user_default_sample_listing_company_county',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td>
                                <?php echo $form->error($address,'user_default_sample_listing_company_county'); ?>
                            </tr>


                            <tr>
                                <td class="darkGrey-text"><?php echo $form->labelEx($address,'user_default_sample_listing_company_postal'); ?></td>
                                <td><?php echo $form->textField($address,'user_default_sample_listing_company_postal',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td>
                                <?php echo $form->error($address,'user_default_sample_listing_company_postal'); ?>
                            </tr>
                            <tr>
                                <td class="darkGrey-text"><?php echo $form->labelEx($address,'user_default_sample_listing_company_tel'); ?></td>
                                <td>
                                    <?php echo $form->textField($address,'user_default_sample_listing_company_tel',array('size'=>50,'maxlength'=>50,'class'=>'inputfield')); ?></td>
                                <?php echo $form->error($address,'user_default_sample_listing_company_tel'); ?>
                            </tr>
                            <?php /* ?>

        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($addresslist,'user_default_country'); ?></td>
        		<td>
                    <?php $countrylist =  Country::model()->find("user_default_country_id = ".$model->user_default_country); ?>
                     <?php echo $countrylist->user_default_country_name;?>
                    <input type="hidden" id="Myaccount_user_default_country_old" name="Useraddress[user_default_country]" value="<?php echo $countrylist->user_default_country_id ?>" maxlength="30" size="30">
                </td>
        	</tr>

        	<tr>
        		<td class="darkGrey-text"><?php echo $form->labelEx($model,'user_default_tel'); ?></td>
        		<td><?php echo $form->textField($model,'user_default_tel',array('size'=>30,'maxlength'=>30,'class'=>'inputfield')); ?></td>
        		<?php echo $form->error($model,'user_default_tel'); ?>
        	</tr><?php */ ?>

                        </table>
                    </div>
                    <div class="my-account-right" style="width: 140px;">
                        <table id="reg-table2">
                            <tr>
                                <td class="darkGrey-text"><span>Sample picture</span></td>
                            </tr>
                            <tr>
                                <td class="Boarder" id="showImg">

                                    <?php
                                    if($address->user_default_sample_listing_company_image){
                                        $img = $address->user_default_sample_listing_company_image;

                                        $img_src = Yii::app()->baseUrl.'/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/'.$img;
                                        ?>
                                        <img src="<?php echo $img_src;?>"  style="width:105px;height:100px" />

                                    <?php }else {
                                        $img = 'avatar.jpg';

                                        ?>
                                        <img src="<?php echo Yii::app()->createUrl('/upload/logo/'.$img);?>" alt="Profile picture" height="99" />

                                    <?php }
                                    ?>

                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="javaScript:void(0)" onclick="show_picture_form()" title="Change Profile Picture" class="button black">Update picture</a>
                                    <?php

                                    //echo $form->fileField($model,'user_default_profile_image',array('id'=>'user_default_profile_image','style'=>'display:none !important'));
                                    //echo $form->error($model,'user_default_profile_image');
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="clear">&nbsp;</div>
                <div class="sl-basic-info-left">
                    <label  class="Blue" >Request a sample</label>
                    <div class="bottom-div">
                        <p class="symboltext">Enter the value without the currency symbol & then select the currency</p>

                        <table>
                            <tr>
                                <td width="29%">Cost of sample :
                                </td>
                                <td width="18%"><?php echo $form->textField($address,'user_default_sample_listing_cost',array('maxlength'=>50,'class'=>'sample_inner_textbox','id'=>'user_default_sample_listing_cost','style'=>'width:65px')); ?>
                                </td>
                                <td width="35%">Postage & packing :
                                </td>
                                <td width="18%"><?php echo $form->textField($address,'user_default_sample_listing_packaging',array('maxlength'=>50,'class'=>'sample_inner_textbox','id'=>'user_default_sample_listing_packaging','style'=>'width:65px')); ?>
                                </td>
                            </tr>
                        </table>
                        <table class="no_financeData"  style="    width: 100%;" >

                            <!--
                            <tr>
                                <td width="100%" valign="top" colspan="3">
                                    <input type="checkbox" value="1" name="drg_favailable" id="drg_favailable" onClick="enableDisable();" style="margin-left:30px;"/> <label style="color:#000;">Financial data available.<a href="#;" class="sl-tip tooltip">?<span class="classic">If you have entered data in the  above table you MUST select this box AND the currency of your figures below </span></a></label>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <td width="90%" valign="top" colspan="2">
                                    <label style="color:#000;">Please select your currency:-</label>
                                </td>
                                <td width="10%">&nbsp;  </td>
                            </tr>
                            <tr>
                                <td colspan="2" width="100%" valign="top">
                                    <div class="amountselectnew">
                                        <?php
                                        $samplemodelss = Samplelisting::model()->find("user_default_listing_id ='" . $model->user_default_listing_id . "'");
                                        $countsamples = count ( $samplemodelss );
                                        $amount_data = Data::model()->findByPk('1');
                                        $amount_data1 = CJSON::decode($amount_data->data);
                                        $t=1;
                                        foreach($amount_data1 as $key => $value)
                                        {
                                            $sel='';
                                            if($address->user_default_sample_listing_currency==$key){
                                                $sel='checked="checked"';
                                                $insert = false;
                                            }
                                            ?>
                                            <div class="amounts<?=$t;?>">
                                                <div class="flow_left mrgn_right">
                                                    <input <?php echo $sel;?> <?php if($countsamples == "0" && $t=="1") { echo "checked"; } ?> type="radio" name="user_default_sample_listing_currency" class="currency" value="<?php echo $key;?>"/>
                                                </div>
                                                <div class="flow_left"><?php echo $value;?></div>
                                            </div>
                                            <?php
                                            $t++;
                                        }
                                        ?>
                                    </div>
                                </td>

                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td class="darkGrey-text" valign="top"><span id="rulevalid"><input type="checkbox" name="rule" id="rule" value="Yes" <?php if($address->user_default_sample_listing_terms =="Yes") { echo "checked"; } ?> ></span></td>
                                <td valign="top" class="symboltext">I have taken every reasonable precaution to ensure that the sample is safe and designed to function as stated in the accompanying supporting literature on the right . I/we taken ful responsibility for any issues that may arise in the safe use and functionality of the product; and confirm I/we that the accompanying literature is true and accurate and we are able to prove its authencity.</td>
                            </tr>
                        </table>
                        <?php /* ?>
 <div class="sample-buttons-box"><span class="stext">Submit</span><button class="sample_submit" name="login_sbmt" type="submit" title="Log into your account"><img style="border-radius:5px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png" width="25"></button>
                        </div>
                        <?php */ ?>
                        <div class="sample-buttons-box sl-bottom-buttons bottombtns">
                            <input type="hidden" name="btnsaveforlater" id="btnsaveforlater" value="0">
                            <button type="button" class="button black"  onclick="window.location.href = '<?php echo Yii::app()->createUrl('listing/selectlisting/listid/' . $model->user_default_listing_id); ?>'">Cancel</button>
                            <button type="button" class="button blue" id="savelater">Save for later</button>
                            <button type="submit" name="login_sbmt" id="login_sbmt" class="button update-green">Save</button>
                        </div>

                    </div>

                </div>




            </div>

            <div class="sample_listing_right">


                <div style="text-align:center"><label class="Blue">Sample Supporting files</label></div>
                <div class="sample_rightbar">
                    For safety reasons you must supply sample supporting files that lists any health or safety issues or known hazards.
                    <div class="clear">&nbsp;</div>

                    Please note your product information files must be in pdf format as depicted by the adobe icon.
                    <div class="clear">&nbsp;</div>
                    Click the icon next to the input field to upload your file.
                    <div class="clear">&nbsp;</div>
                    <div class="clear">&nbsp;</div>

                    <p class="sample_inner_title">Upload information & specifications</p>
                    <div class="sample_inner_left">
                        <input type="text" class="sample_inner_textbox" name="attach1" id="attach1" value="<?php echo $address->user_default_sample_listing_att_specs; ?>">
                    </div>
                    <div class="sample_inner_right">
                        <input id="upload1" name="file1" type="file" onchange="updateFileName1()" accept=".doc,.docx,.pdf" /><a href="" id="upload_link1"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"></a>

                        <a href="javaScript:void(0)" id="delatt1" style="display:none"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Delete Attachment</a>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <p class="sample_inner_title">Upload instruction of how to use the sample</p>
                    <div class="sample_inner_left">
                        <input type="text" class="sample_inner_textbox" name="attach2" id="attach2" value="<?php echo $address->user_default_sample_listing_att_instruction; ?>">
                    </div>
                    <div class="sample_inner_right">
                        <input id="upload2" name="file2" type="file" onchange="updateFileName2()" accept=".doc,.docx,.pdf"  /><a href="" id="upload_link2"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"></a>

                        <a href="javaScript:void(0)" id="delatt2" style="display:none"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Delete Attachment</a>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <p class="sample_inner_title">Any known safety issues</p>
                    <div class="sample_inner_left">
                        <input type="text" class="sample_inner_textbox"  name="attach3" id="attach3" value="<?php echo $address->user_default_sample_listing_att_safety; ?>">
                    </div>
                    <div class="sample_inner_right">
                        <input id="upload3" name="file3" type="file" onchange="updateFileName3()" accept=".doc,.docx,.pdf" /><a href="" id="upload_link3"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"></a>

                        <a href="javaScript:void(0)" id="delatt3" style="display:none"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Delete Attachment</a>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <p class="sample_inner_title">Upload an image of your sample</p>
                    <div class="sample_inner_left">
                        <input type="text" class="sample_inner_textbox"  name="attach4" id="attach4" value="<?php echo $address->user_default_sample_listing_image; ?>">
                    </div>
                    <div class="sample_inner_right">
                        <input id="upload4" name="file4" type="file" onchange="updateFileName4()" accept=".gif,.jpg,.jpeg,.png" /><a href="" id="upload_link4"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/gallery.png" style="width: 35px;"></a>

                        <a href="javaScript:void(0)" id="delatt4" style="display:none"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Delete Attachment</a>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="sample_preview_text">
                        Preview and test your listing before you submit
                        <div class="clear">&nbsp;</div><div class="clear">&nbsp;</div>
                        <a onclick="preview()" class="button blue" value="Preview" name="preview" id="sl-pl">Preview</a>
                    </div>
                    <div class="clear">&nbsp;</div>


                </div>


            </div>
            <?php
            $this->endWidget();
            ?>

        </div>
        <div class="clear"></div>
    </div></div>


<div class="sample-preview sample_view" style="display:none;border-radius: 10px;background: white;border: #b1769c solid 1px;margin-top: 25px;">
    <div class="close_caform_sample"><a class="button white smallrounded" onclick="closesample();" title="Close" style="float: right;margin-top: -9px;" >X</a></div>
    <?php
    //$this->renderPartial('sample_view', array('model' => $model , 'show' => true));
    ?>
    <div align="center">
        <h1 style="color:#824682"><?php echo $model->user_default_listing_title;?></h1>
        Listing number:<br>
        <?php echo $model->user_default_listing_id;?>
    </div>
    <table>
        <tr>
            <td width="60%" valign="top">
                <h4 class="Blue">Details of Sample available</h4>
                <div style="height:auto;" class="gray_box" id="sample_box_1">
                    <div class="explain" style="overflow: hidden;">
                        <span id="f"></span>&nbsp;&nbsp;<a onclick="jQuery('.explainfull').show();jQuery('.explain').hide();" id="link" class="more readmore" style="display:none">Read more &gt;&gt;</a>
                    </div>
                    <div class="explainfull" style="display:none;">
                        <span id="s"></span> &nbsp;&nbsp; <a
                            onclick="jQuery('.explain').show();jQuery('.explainfull').hide();" class="more readmore">Read
                            less &gt;&gt;</a>
                    </div>
                </div>
                <h4 class="Blue">What feedback the business is looking for</h4>
                <div style="height:auto;" class="gray_box" id="sample_box_2">
                    <div class="explain1" style="overflow: hidden;">
                        <span id="f1"></span>&nbsp;&nbsp;<a onclick="jQuery('.explainfull1').show();jQuery('.explain1').hide();" id="link1" class="more readmore" style="display:none">Read more &gt;&gt;</a>
                    </div>
                    <div class="explainfull1" style="display:none;">
                        <span id="s1"></span> &nbsp;&nbsp; <a
                            onclick="jQuery('.explain1').show();jQuery('.explainfull1').hide();" class="more readmore">Read
                            less &gt;&gt;</a>
                    </div>
                </div>
                <h4 class="Blue">How to obtain a sample</h4>
                <div style="height:auto;" class="gray_box" id="sample_box_3">
                    <div class="explain2" style="overflow: hidden;">
                        <span id="f2"></span>&nbsp;&nbsp;<a onclick="jQuery('.explainfull2').show();jQuery('.explain2').hide();" id="link2" class="more readmore" style="display:none">Read more &gt;&gt;</a>
                    </div>
                    <div class="explainfull2" style="display:none;">
                        <span id="s2"></span> &nbsp;&nbsp; <a
                            onclick="jQuery('.explain2').show();jQuery('.explainfull2').hide();" class="more readmore">Read
                            less &gt;&gt;</a>
                    </div>
                </div>
                <?php /* ?>
                <h4 class="Blue">Details of Sample available</h4>
                <div class="gray_box" id="sample_box_1"></div>

                <h4 class="Blue">What feedback the business is looking for</h4>
                <div class="gray_box" id="sample_box_2"></div>

                <h4 class="Blue">How to obtain a sample</h4>
                <div class="gray_box" id="sample_box_3"></div>

                <h4 class="Blue">Special instructions</h4>
                <div class="gray_box" id="sample_box_4"></div>
                <?php */ ?>

                <h4 class="Blue">Delivery address details</h4>
                <div class="gray_box">

                    <table width="100%">
                        <tr class="addresstr">
                            <td class="gray-text" width="20%">Address 1</td>
                            <td id="address1"  class="addressdata" width="30%"></td>
                            <td class="gray-text" width="20%">Town</td>
                            <td id="address2" class="addressdata" width="30%"></td>
                        </tr>
                        <tr class="addresstr">
                            <td class="gray-text">Address 2</td>
                            <td id="address3" class="addressdata"></td>
                            <td class="gray-text">County</td>
                            <td id="address4" class="addressdata"></td>
                        </tr>
                        <tr class="addresstr">
                            <td class="gray-text">Address 3</td>
                            <td id="address5" class="addressdata"></td>
                            <td class="gray-text">Zip Code</td>
                            <td id="address6" class="addressdata"></td>
                        </tr>
                        <tr class="addresstr">
                            <td class="gray-text">Tel no</td>
                            <td id="address7"  class="addressdata"></td>
                            <td class="gray-text">&nbsp;</td>
                            <td id="">&nbsp;</td>
                        </tr>
                    </table>

                </div>

                <h4 class="Blue">Request a sample</h4>
                <div class="gray_box requestbox">
                    <table width="100%">
                        <tr>
                            <td width="21%" class="right titles">Username</td>
                            <td width="34%"><input type="text" name="in1" value="<?php echo Yii::app()->user->getState('username'); ?>"/></td>
                            <td width="45%" rowspan="5" valign="top" class="titles">Instruction to supplier<br>
                                <textarea name="txt1" id="sample_box_4" rows="5"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="right titles">Cost of sample</td>
                            <td id="cost"></td>
                        </tr>
                        <tr>
                            <td class="right titles">Cost of packing</td>
                            <td id="packing"></td>
                        </tr>
                        <tr>
                            <td class="right titles">Quantity required</td>
                            <td><input type="text" name="in2"/></td>
                        </tr>
                        <tr>
                            <td  class="right titles">Total cost</td>
                            <td><input type="text" name="in3"/></td>
                        </tr>
                    </table>
                    <input type="checkbox" name="chk1" id="chk1"/> <label for="chk1" class="chk1">By ticking the checkbox on the left I hereby confirm that I have read and understood the literature accompanying the sample. I agree to use the sample in a safe and responsible manner. I shall also agree to give any</label>
                </div>



            </td>

            <td width="30%" valign="top">
                <h4 class="Blue" align="center">Request a sample</h4>
                <div class="gray_box" style="padding: 10px;">
                    <p>Lorem ipsum dolor sit amet, eos at tritani ullamcorper, vim ei vitae oporteat volutpat, vel et atqui tibique.</p>

                    <p>Lorem ipsum dolor sit amet, eos at tritani ullamcorper, vim ei vitae oporteat volutpat, vel et atqui tibique.</p>

                    <p>Lorem ipsum dolor sit amet, eos at tritani ullamcorper, vim ei vitae oporteat volutpat, vel et atqui tibique. Lobortis inciderint ad has, has an illum alterum consulatu. Inani option ex cum, est in illum dissentias, labore impetus legimus sed ne.</p>
                    <a href="#" class="link">Sample information / specifications</a>
                    <table width="100%">
                        <tr>
                            <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_specs){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_specs);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                            <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_specs){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_specs);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                        </tr>
                    </table>

                    <br>
                    <a href="#" class="link">How to use the sample</a>
                    <table width="100%">
                        <tr>
                            <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_instruction){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_instruction);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                            <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_instruction){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_instruction);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                        </tr>
                    </table>

                    <br>
                    <a href="#" class="link">Any known Health & Saftey issues</a>
                    <table width="100%">
                        <tr>
                            <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_safety){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_safety);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png"/><br>View Online</a></td>
                            <td valign="middle" style="text-align:center !important"><a href='<?php if($address->user_default_sample_listing_att_safety){  echo Yii::app()->createUrl('/upload/attachments/'.$address->user_default_sample_listing_att_safety);} ?>' target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/pdf_icon.png"/><br>Download PDF</a></td>
                        </tr>
                    </table>


                    <br>
                    Check the forum at Voice your opinion for discussions regarding
                    the sample, before you order.
                </div>

                <div class="gray_box white_box" align="center" id="sample_image">

                    <?php
                    if($address->user_default_sample_listing_company_image){
                        $img = $address->user_default_sample_listing_company_image;
                        $img_src = '/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/big/'.$img;
                        ?>
                        <img src="<?php echo $img_src;?>" width="70%" align="middle"/>

                    <?php }else {
                        ?>
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/serverid.jpg" width="70%" align="middle"/>

                    <?php }
                    ?>
                </div>
                <p class="clear"></p>
                <div style="text-align:center">
                    <button type="button" class="button black" onclick="closesample();" >Return</button>
                </div>

            </td>
        </tr>
    </table>
</div>
<style>
    #photo-upload-box-tab {
        height: 97% !important;
        margin-top: -95px !important;
        width: 622px !important;
    }
    .photo-upload-box{
        height: 98% !important;
    }
    .side-robot-upload1 {
        position: absolute;
        top: 150px;
        left: 6px;
    }#upload-frame {
         width: 380px;
         margin-left: 140px;
     }
</style>
<script type="text/javascript">

    jQuery("#savelater").live("click", function () {
        jQuery(".confirm").show();
        jQuery('html, body').animate({scrollTop: '300px'}, 1000);
    });

    function close_form_confirm()
    {
        jQuery(".confirm").hide();
    }
    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value = 1;
        document.getElementById("sample_listing").submit();
    }


    function givealert(result){
        if(result.success){
            jQuery("#showImg").html('');
            var img = '<img style="width:105px;height:100px" src="<?php echo Yii::app()->getBaseUrl(true).'/upload/users/'.Yii::app()->user->getState('ufolder').'/listing/thumb/'; ?>' + result.filename + '"  />'
            jQuery("#Samplelisting_user_default_sample_listing_company_image").val(result.filename);
            jQuery("#showImg").html(img);
            jQuery("#sample_image").html(img);
            jQuery(".my-account-links,#update-table,.fBtn").css({
                'opacity': 1,
                '-ms-filter':"",
                'filter': ''
            });
            jQuery(".photo-upload-box").hide();
        }
    }

    function show_picture_formnew(openTabId) {
        jQuery("." + openTabId).show();
        openTabId = openTabId.replace('video-upload-box', '');
        jQuery('#pic_frame_' + openTabId).attr({'src': 'video-upload/step_1.php?id=' + openTabId});
    }

    function getUploadfilename(result, id) {
        if (result.success) {
            jQuery("#image_preview" + id).html('');
            var img = '<img src="<?php echo Yii::app()->baseUrl . '/upload/users/' . Yii::app()->user->getState('ufolder') . '/listing/thumb/'; ?>' + result.filename + '" />'
            jQuery("#logo_" + id).val(result.filename);
            jQuery("#image_preview" + id).html(img);
            jQuery(".photo-upload-box" + id).hide();
        }
    }

    function updateFileName1() {
        var img1 = document.getElementById('upload1');
        var allowedFiles = [".doc", ".docx", ".pdf"];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(img1.value.toLowerCase())) {
            var error = "only pdf,doc files allowed.";
            alert(error);
        }
        else
        {
            var file_name = document.getElementById('attach1');
            var fileNameIndex = img1.value.lastIndexOf("\\");

            file_name.value = img1.value.substring(fileNameIndex + 1);
        }
    }

    function updateFileName2() {
        var img1 = document.getElementById('upload2');
        var allowedFiles = [".doc", ".docx", ".pdf"];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(img1.value.toLowerCase())) {
            var error = "only pdf,doc files allowed.";
            alert(error);
        }
        else
        {
            var file_name = document.getElementById('attach2');
            var fileNameIndex = img1.value.lastIndexOf("\\");

            file_name.value = img1.value.substring(fileNameIndex + 1);
        }
    }

    function updateFileName3() {
        var img1 = document.getElementById('upload3');
        var allowedFiles = [".doc", ".docx", ".pdf"];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(img1.value.toLowerCase())) {
            var error = "only pdf,doc files allowed.";
            alert(error);
        }
        else
        {
            var file_name = document.getElementById('attach3');
            var fileNameIndex = img1.value.lastIndexOf("\\");

            file_name.value = img1.value.substring(fileNameIndex + 1);
        }
    }

    function updateFileName4() {
        var img1 = document.getElementById('upload4');
        var allowedFiles = [ ".jpg", ".png", ".jpeg"];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(img1.value.toLowerCase())) {
            var error = "only  image files allowed.";
            alert(error);
        }
        else
        {
            /*if(img1 != "")
             {
             jQuery("#upload_link").hide();

             jQuery("#delatt").show();
             } */
            var file_name = document.getElementById('attach4');
            var fileNameIndex = img1.value.lastIndexOf("\\");

            file_name.value = img1.value.substring(fileNameIndex + 1);
        }
    }

    $(function(){
        $("#upload_link1").on('click', function(e){
            e.preventDefault();
            $("#upload1:hidden").trigger('click');

        });
        $("#upload_link2").on('click', function(e){
            e.preventDefault();
            $("#upload2:hidden").trigger('click');

        });
        $("#upload_link3").on('click', function(e){
            e.preventDefault();
            $("#upload3:hidden").trigger('click');

        });
        $("#upload_link4").on('click', function(e){
            e.preventDefault();
            $("#upload4:hidden").trigger('click');

        });

        $("#delatt").on('click', function(e){
            e.preventDefault();
            jQuery("#upload_link").show();
            jQuery("#contact_attachment").val('');
            jQuery("#upload").val('');

            jQuery("#delatt").hide();

        });
    });

    $(".chzn-select").chosen();

    function show_picture_form(){
        /*jQuery(".my-account-links,#update-table,.fBtn").css({
         'opacity': 0,
         '-ms-filter':"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
         'filter': 'alpha(opacity=0)'
         });
         */
        jQuery(".photo-upload-box").show();
        jQuery('html, body').animate({scrollTop: $(".photo-upload-box").offset().top}, 350);
    }

    function hide_picture_form(){
        //jQuery("#user_default_profile_image").trigger("click");

        jQuery(".my-account-links,#update-table,.fBtn").css({
            'opacity': 1,
            '-ms-filter':"",
            'filter': ''
        });
        jQuery(".photo-upload-box").hide();
    }

    function preview(){

        var count1 = $('#user_default_sample_listing_details').val().split(' ').length;

        var count2 = $('#user_default_sample_listing_feedback').val().split(' ').length;

        var count3 = $('#user_default_sample_listing_obtain').val().split(' ').length;

        if(count1 > 50)
        {
            jQuery("#f").html(jQuery("#user_default_sample_listing_details").val().substring(0,320));
            jQuery("#link").show();
        }
        else
        {
            jQuery("#f").html(jQuery("#user_default_sample_listing_details").val());
        }

        if(count2 > 50)
        {
            jQuery("#f1").html(jQuery("#user_default_sample_listing_feedback").val().substring(0,320));
            jQuery("#link1").show();
        }
        else
        {
            jQuery("#f1").html(jQuery("#user_default_sample_listing_feedback").val());
        }

        if(count3 > 50)
        {
            jQuery("#f2").html(jQuery("#user_default_sample_listing_obtain").val().substring(0,320));
            jQuery("#link2").show();
        }
        else
        {
            jQuery("#f2").html(jQuery("#user_default_sample_listing_obtain").val());
        }

        jQuery("#s").html(jQuery("#user_default_sample_listing_details").val());

        jQuery("#s1").html(jQuery("#user_default_sample_listing_feedback").val());

        jQuery("#s2").html(jQuery("#user_default_sample_listing_obtain").val());

        jQuery("#sample_box_4").html(jQuery("#user_default_sample_listing_instructions").val());

        jQuery("#address1").html(jQuery("#Samplelisting_user_default_sample_listing_company_address1").val());

        jQuery("#address2").html(jQuery("#Samplelisting_user_default_sample_listing_company_town").val());

        jQuery("#address3").html(jQuery("#Samplelisting_user_default_sample_listing_company_address2").val());

        jQuery("#address4").html(jQuery("#Samplelisting_user_default_sample_listing_company_county").val());

        jQuery("#address5").html(jQuery("#Samplelisting_user_default_sample_listing_company_address3").val());

        jQuery("#address6").html(jQuery("#Samplelisting_user_default_sample_listing_company_postal").val());

        jQuery("#address7").html(jQuery("#Samplelisting_user_default_sample_listing_company_tel").val());

        jQuery("#cost").html(jQuery("#user_default_sample_listing_cost").val());

        jQuery("#packing").html(jQuery("#user_default_sample_listing_packaging").val());

        jQuery("#sample_image").html(jQuery("#showImg").html());

        jQuery(".sample-preview").show();

        jQuery(".registration-box").hide();

    }

    function closesample(){

        jQuery(".sample-preview").hide();

        jQuery(".registration-box").show();

    }


    function show_picture_form1(){

        jQuery(".photo-upload-box1").show();

        jQuery(".registration-box").hide();

    }



    $("#delatt").click(function(event){

        var d1=$('#member-form').serialize();

        $.ajax({

            type: "POST",

            url: "<?php echo Yii::app()->createUrl('site/delete_file'); ?>",

            data:  d1 ,

            success: function(result)

            {

                if(result =='success'){

                    $("#contact_attachment").val('');

                    $("#addatt").show();

                    $("#delatt").hide();

                }

            },

        })

    });


    function form_validation()

    {



        var failedvalidation = false;



        jQuery('#sample_listing input,textarea').removeClass('mandatoryerror');



        var user_default_sample_listing_details = document.getElementById("user_default_sample_listing_details").value;

        if((user_default_sample_listing_details == ""))

        {

            jQuery("#user_default_sample_listing_details").addClass('mandatoryerror');

            jQuery("#user_default_sample_listing_details").attr('placeholder','Enter details');

            failedvalidation = true;

        }

        var user_default_sample_listing_feedback = document.getElementById("user_default_sample_listing_feedback").value;

        if((user_default_sample_listing_feedback == ""))

        {

            jQuery("#user_default_sample_listing_feedback").addClass('mandatoryerror');

            jQuery("#user_default_sample_listing_feedback").attr('placeholder','Enter Feedback');

            failedvalidation = true;

        }

        var user_default_sample_listing_obtain = document.getElementById("user_default_sample_listing_obtain").value;

        if((user_default_sample_listing_obtain == ""))

        {

            jQuery("#user_default_sample_listing_obtain").addClass('mandatoryerror');

            jQuery("#user_default_sample_listing_obtain").attr('placeholder','Enter details');

            failedvalidation = true;

        }

        var user_default_sample_listing_instructions = document.getElementById("user_default_sample_listing_instructions").value;

        if((user_default_sample_listing_instructions == ""))

        {

            jQuery("#user_default_sample_listing_instructions").addClass('mandatoryerror');

            jQuery("#user_default_sample_listing_instructions").attr('placeholder','Enter details');

            failedvalidation = true;

        }

        var Samplelisting_user_default_sample_listing_company_image = $('#Samplelisting_user_default_sample_listing_company_image').val();

        if(Samplelisting_user_default_sample_listing_company_image==""){

            $("#showImg").addClass('mandatoryerror');

            $("#showImg").attr({'placeholder':'Please upload sample picture'});

            failedvalidation = true;

        }else {

            $("#showImg").removeClass('mandatoryerror');

            failedvalidation = false;

        }


        var user_default_sample_listing_cost = document.getElementById("user_default_sample_listing_cost").value;

        if((user_default_sample_listing_cost == ""))

        {

            jQuery("#user_default_sample_listing_cost").addClass('mandatoryerror');

            jQuery("#user_default_sample_listing_cost").attr('placeholder','Enter cost');

            failedvalidation = true;

        }



        var user_default_sample_listing_packaging= jQuery.trim(document.getElementById("user_default_sample_listing_packaging").value);

        if(user_default_sample_listing_packaging == '')

        {

            jQuery("#user_default_sample_listing_packaging").addClass('mandatoryerror');

            jQuery("#user_default_sample_listing_packaging").attr('placeholder','Enter details');

            failedvalidation = true;

        }

        var rule= document.getElementById("rule").value;

        if ($("#rule").is(':checked')) {

        }
        else
        {


            jQuery("#rulevalid").addClass('checkboxvalidation');

            //jQuery("#user_default_sample_listing_packaging").attr('placeholder','Enter details');

            failedvalidation = true;

        }



        if (failedvalidation)

        {

            return false;

        }

    }

</script>

<script type="text/javascript">
    $(".chzn-select").chosen();

    function ChangeColorMauve(tableRow, highLight)
    {
        if (highLight)
        {
            tableRow.closest("tr").style.backgroundColor = '#C9C';
        }
        else
        {
            tableRow.closest("tr").style.backgroundColor = '#EADDED';
        }
    }

    function ChangeColorGrey(tableRow, highLight)
    {
        if (highLight)
        {
            tableRow.closest("tr").style.backgroundColor = '#C2C2C2';
        }
        else
        {
            tableRow.closest("tr").style.backgroundColor = '#EBEBEB';
        }
    }



    function DoNav(theUrl)
    {
        document.location.href = theUrl;
    }

</script>