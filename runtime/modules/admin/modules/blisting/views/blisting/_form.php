<?php

$baseUrl = Yii::app()->theme->baseUrl;

$js = Yii::app()->getClientScript();

$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');

$js->registerCssFile($baseUrl . '/css/chosen.css');

$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');

$js->registerScriptFile($baseUrl . '/js/tinymce/tinymce.min.js');

?>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery(".chzn-select").chosen();


        jQuery("#registration-tabs a").live("click", function () {

            jQuery("#registration-tabs a").removeClass("active");

            jQuery(this).addClass("active");

            jQuery(".showhide").hide();

            /*var activediv =  jQuery(this).attr("data-active") ;

             jQuery(this).addClass("active");*/

            jQuery("#" + jQuery(this).attr("data-active")).show();

        });

    });


    //jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true});

</script>

<?php

/* @var $this AdminListingController */

/* @var $model AdminListing */

/* @var $form CActiveForm */

?>

<style>

    .black-popup, .my-account-popup-box {

        position: fixed;

        top: 20%;

        left: 35%;

        z-index: 99999999;

    }

    .mandatoryerror {
        color: black !important;
    }

    .user_info_container {

        right: 0px !important;

    }

    #registration-tabs a {
        background: #e6d7e8;
        color: #A84793;
        border-bottom: 1px solid #AC5099;
        font-size: 16px;
        height: 25px;
        line-height: 25px;
    }

    #registration-tabs a.active {
        background: #fff;
        color: #1DBFD8;
        border-bottom: 1px solid #fff;
    }

    .user_listing_search {
        margin-top: 6px;
    }

</style>

<?php

$user_details = Business::model()->findByAttributes(array('user_default_business_id' => $model->user_default_business_id));

?>

<div class="form">

<h2 class="Blue"><?php echo SharedFunctions::get_user_names($model['user_default_business_id']); ?></h2>

<div class="content-container">

    <h2 class="Blue"><?php echo $model->user_default_business_title; ?></h2>

    <p id="listing-number">Business Listing number
        : <?php echo $model->user_default_business_id; ?></p>

    <div class="companydetails">

        <table class="center-table">

            <tr>
                <td style="width:100">Company name:</td>
                <td class="last"><?php echo $user_details['user_default_business_name']; ?></td>
                <?php $Businessaddress = Businessaddress::model()->findByAttributes(array("user_default_business_id" => $user_details['user_default_business_id'])); ?>
                <td style="width:100">County:</td>
                <td class="last"><?php echo $Businessaddress['user_default_business_county']; ?></td>
            </tr>

            <tr>
                <td style="width:100">Address1:</td>
                <td class="last"><?php echo $Businessaddress['user_default_business_addr1']; ?></td>
                <td style="width:100;">Zip Code:</td>
                <td class="last"><?php echo $Businessaddress['user_default_business_zip']; ?></td>

            </tr>

            <tr>
                <td style="width:100">Address2:</td>
                <td class="last"><?php echo $Businessaddress['user_default_business_addr2']; ?></td>
                <td style="width:100;">Country:</td>
                <td class="last"><?php $cc = Country::model()->findByPk($Businessaddress['user_default_business_country']);
                    echo $cc['user_default_country_name']; ?></td>
            </tr>

            <tr>
                <td style="width:100">Address3:</td>
                <td class="last"><?php echo $Businessaddress['user_default_business_addr3']; ?></td>
                <td style="width:100">Tel No:</td>
                <td class="last"><?php echo $user_details['user_default_business_phone']; ?></td>
            </tr>


            <tr>
                <td style="width:100">Town:</td>
                <td class="last"><?php echo $Businessaddress['user_default_business_town']; ?></td>
                <td style="width:100">Mobile No:</td>
                <td class="last"><?php echo $user_details['user_default_business_fax']; ?></td>
            </tr>

        </table>

    </div>

</div>
<div class="clear">&nbsp;</div>
<div class="content-container">
<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'businesslisting-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('onSubmit' => 'return form_validation();')));

echo $form->errorSummary($model);

?>

<div> <!-- Listing type drop down menu starts here -->

    <div class="slisting-head">

        <p>Listing type<a class="sl-tip tooltip" href="#;">?<span class="classic">Please select a listing type from each drop down menu to continue</span></a>
        </p>

    </div>
    <!-- /slisting-head -->

    <table class="slisting-head">

        <tr>

            <td>Category:</td>

            <td>

                <?php

                /*  $listingCategory = CHtml::listData(Listingcategory::model()->findAll(), 'list_category_id', 'list_category_name');

                  echo $form->dropDownList($model, 'user_default_business_category', $listingCategory, array('prompt' => 'Please Select', 'class' => 'chzn-select', 'data-placeholder' => 'Please select', 'onfocus' => 'getSelectNormal("#sl_category");', 'id' => 'sl_category'));

                  echo $form->error($model, 'user_default_business_category');*/


                echo $form->textField($model, 'user_default_business_category', array('id' => 'sl_category', 'class' => "textbox_style", 'tabindex' => 1, 'value' => 'Services', 'size' => '25', 'onfocus' => 'getSelectNormal("#sl_category");'));

                ?>

            </td>

            <td class="sl-select-space" style="width:74px;"></td>


            <td>Sector:</td>

            <td>

                <?php echo $form->textField($model, 'user_default_business_profession', array('id' => 'sl_profession', 'class' => "textbox_style", 'tabindex' => 2, 'value' => ListingProfession::model()->findByPk($userData['user_default_business_sector'])->list_profession_name, 'size' => '25', 'onfocus' => 'getSelectNormal("#sl_profession");')); ?>

            </td>

            <td class="sl-select-space" style="width:74px;"></td>


            <td>Limit viewing to:</td>

            <td>


                <?php


                $viewlimit = CHtml::listData(Country::model()->findAll(), 'user_default_country_id', 'user_default_country_name');

                echo $form->dropDownList($model, 'user_default_business_viewlimit', $viewlimit, array('prompt' => 'Worldwide (default)', 'class' => 'chzn-select', 'tabindex' => '3', 'data-placeholder' => 'Worldwide (default)', 'onfocus' => 'getSelectNormal("#sl_vlimit");', 'id' => 'sl_vlimit'));

                echo $form->error($model, 'user_default_business_viewlimit');

                ?>


            </td>

        </tr>

    </table>
    <!-- /Table slisting-head -->

</div>

<div style="margin-bottom: 3px;">

    <label style="color:#A47A8F;">Upload photographs <a class="sl-tip tooltip" href="#;">?<span class="classic">Select and upload five images in one of the following formats:- BMP, JPEG, PNG, GIF<br> Please NOTE image size MUST NOT exceed 6"x4" otherwise cropping will occur.</span></a></label>

</div>

<?php

$userimage = Businesslistingimages::model()->findAllByAttributes(array("user_default_business_blid" => $model->user_default_business_blid));


$username = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id));


$userfolder = $username[0]['user_default_business_username'] . "_" . $username[0]['user_default_business_id'];



?>

<?php for ($i = 1; $i <= 5; $i++) { ?>

    <div class="sl-photo-box admin-photo" style="margin:0; text-align:center">

        <div class="clear"></div>

        <br>

        <div class="sl-photograph image_preview">


            <?php

            if ($userimage[$i - 1]['user_default_business_listing_image'] != '') {


                $img_src = Yii::app()->baseUrl . '/upload/users/' . $userfolder . '/listing/thumb/' . $userimage[$i - 1]['user_default_business_listing_image'];



                ?>

                <div id="preview_logo_<?php echo $i; ?>"><img src="<?php echo $img_src; ?>" alt='Preview logo'/></div>

                <input type="hidden" name="img_name[]"
                       value="<?php echo $userimage[$i - 1]['user_default_business_listing_image']; ?>"
                       id="logo_<?php echo $i; ?>"/>

            <?php

            } else {

                ?>

                <div id="preview_logo_<?php echo $i; ?>"></div>

                <input type="hidden" name="img_name[]" value="" id="logo_<?php echo $i; ?>"/>

            <?php

            }

            ?>

        </div>

        <!-- File Upload for Company Logo -->

    </div>



<?php } ?>



<br class="clear"/>

<br class="clear"/>

<div class="slisting-head">

    <p>Enter a short description for each image <a class="sl-tip tooltip" href="#;">?<span class="classic">Enter a short description explaining each image. Please note text is limited to 4 lines.</span></a>
    </p>

</div>

<div class="sl-image-description admin-description">


    <?php for ($i = 1; $i <= 5; $i++) { ?>

        <div class="img_desc img_desc_text">

            <textarea rows="2" cols="9" class="drg_imgdesc" name="user_default_business_imgdesc[]"
                      id="image-description-<?php echo $i; ?>"
                      maxlength="80"><?php echo $userimage[$i - 1]['user_default_business_imgdesc']; ?></textarea>

            <br>

            Image <?php echo $i; ?> text

        </div>

        <!-- <?php echo $i; ?>Image text -->

    <?php } ?>

    <br class="clear"/>

</div>

<br class="clear"/>

<div class="slisting-head"><p>Enter a link to each slider <a class="sl-tip tooltip" href="#;">? <span class="classic">Enter video link for each slider image.</span>
        </a></p></div>
<div
    class="sl-image-description admin-description">                                                <?php $userimage = Businesslistingimages::model()->findAllByAttributes(array("user_default_business_blid" => $model->user_default_business_blid)); ?>                                                     <?php $h = 0;
    for ($i = 1; $i <= 5; $i++) {
        $sitelink = $userimage[$h]->user_default_business_listing_link1;
        $videolink = $userimage[$h]->user_default_business_listing_link2; ?>
        <div class="img_desc img_desc_text"><input type="text" class="inp width"
                                                   name="user_default_business_listing_link1[]"
                                                   id="slider-sitelink-<?php echo $i; ?>"
                                                   value="<?php echo $sitelink; ?>"
                                                   style="background: none repeat scroll 0 0 #F1E5E2;  border: 1px solid #F1E5E2;  margin: 6px 0 10px;width: 126px;  overflow: hidden;  padding: 5px 4.5px;  resize: none"/>
            <br> Site link<?php echo $i; ?>                                       <h3 style="  color: #1dbfd8;">OR</h3>
            <input type="text" class="inp width" name="user_default_business_listing_link2[]"
                   id="slider-videolink-<?php echo $i; ?>" maxlength="80" value="<?php echo $videolink; ?>"
                   style="background: none repeat scroll 0 0 #F1E5E2;  border: 1px solid #F1E5E2;  margin: 6px 0 10px;width: 126px;  overflow: hidden;  padding: 5px 4.5px;  resize: none;"/>
            <br> Video link <?php echo $i; ?>
        </div>                                                   <!-- <?php echo $i; ?>Image text -->                                       <?php $h++;
    } ?>
</div>
<br class="clear"/></div>
<div class="clear">&nbsp;</div>

<div class="content-container">
<div style="margin-bottom: 10px;">

    <label style="color:#A47A8F;">Upload Videos <a class="sl-tip tooltip" href="#;">?<span class="classic">Upload your business videos in 3gp, avi, mpeg, mpg, mov, m4a, mj2, flv, wmv, mp4, ogg or webm formats only.<br>Long videos can be heavy going, so make your video short sharp and to the point and aim to get your main points across in 60 seconds or less.</span></a></label>

</div>

<?php

$uservideo = Businesslistingvideos::model()->findAllByAttributes(array("user_default_business_blid" => $model->user_default_business_blid));

//print_r($uservideo);

$k = 0;

for ($j = 1; $j <= 2; $j++) {


    ?>

    <div class="video-upload-box<?php echo $j; ?>" id="video-upload-box-tab">

        <img class="side-robot-upload1" src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/robot-upload.png"
             alt="Upload your business supermarket user profile picture"/>

        <div class="my-account-popup-box" id="upload-frame">

            <a href="javaScript:void(0);" class="pu-close"
               onclick='jQuery(".video-upload-box<?php echo $j; ?>").hide();' title="Close">X</a>

            <h2>Upload user listing video</h2>

            Click <b>Browse...</b> to select a picture from your computer<br/>

            Click <b>Upload Video</b> to save your video and close this dialog box

            <br/><br/>

            <!-- <iframe src="video-upload/step_1.php?id=<?php echo $j; ?>" frameborder="0" width="390" height="340" id="pic_frame_<?php echo $j; ?>"></iframe>-->

        </div>

    </div>



    <div class="sl-photo-box" style="margin:<?php

    if ($j == 1) {

        echo '0 0 30px 80px;';

    } else {

        echo '0 0 30px 80px;';

    }

    ?> width:360px;">

        <div class="clear"></div>

        <br>

        <div id="preview-<?php echo $j; ?>" class="sl-photograph video_preview" style="margin-left: 90px;">

            <?php

            $uservideoname = "";
            $user_default_business_videodesc = "";
            if ($uservideo[$k]->user_default_business_listing_video != "") {
                $uservideoname = $uservideo[$k]->user_default_business_listing_video;
                $user_default_business_videodesc = $uservideo[$k]->user_default_business_videodesc;
                $user_default_business_listing_video_type = $Businesslistingvideos[$k]->user_default_business_listing_video_type;
            }

            ?>

            <div id="show-<?php echo $k; ?>">
                <input type="hidden" name="user_default_business_videos[]" value="<?php echo $uservideoname; ?>"
                       id="video-<?php echo $j; ?>"/>
                <input type="hidden" name="user_default_business_vid_<?php echo $j; ?>"
                       value="<?php echo $uservideoname; ?>" id="video-<?php echo $j; ?>"/>
            </div>

            <input type="hidden" name="user_default_business_old_videos[]" value="<?php echo $uservideoname; ?>"/>

        </div>

        <div id="ova-example-player-container_<?php echo $j; ?>" class="video_player_container">
            <div id="ova-example-player_<?php echo $j; ?>" style="position:relative;">
                <div id="ova-player-instance_<?php echo $j; ?>" data-loaded="false" class="video_player_instances">
                    <!-- SELECTED PLAYER INSTANCE GOES IN HERE -->
                </div>
                <?php
                if ($user_default_business_listing_video_type == "1") {
                    ?>
                    <script
                        type="text/javascript">                                jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
                            flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                            file: '<?php echo $uservideoname; ?>',
                            height: 260,
                            width: 338,
                        });                            </script>
                <?php
                }
                else
                {
                ?>
                    <script
                        type="text/javascript">                                jwplayer("ova-player-instance_<?php echo $j; ?>").setup({
                            flashplayer: "<?php echo Yii::app()->theme->baseUrl; ?>/js/jwplayer1/jwplayer.flash.swf",
                            file: '<?php echo Yii::app()->baseUrl; ?>/upload/users/<?php echo $userfolder;?>/videos/<?php echo $uservideoname; ?>',
                            height: 260,
                            width: 338,
                        });                            </script>
                <?php
                }
                ?>
            </div>
        </div>

        <br/>

        <div id="progressbox_<?php echo $j; ?>" class="progressbox" style="display:none;">

            <div class="uploading_<?php echo $j; ?>"> Uploading ....</div>

            <div id="progressbar_<?php echo $j; ?>" class="progressbar"></div>

            <div id="statustxt_<?php echo $j; ?>" class="statustxt">0%</div>

        </div>


        <div id="progressstatus_<?php echo $j; ?>" class="progressstatus" style="display:none;"></div>

        <?php
        if ($user_default_business_listing_video_type == "0" || $user_default_business_listing_video_type == "") {
            ?>

            <p class="slisting-head">Video <?php echo $j; ?> (Meet the company) <a class="sl-tip tooltip"
                                                                                   href="#;">?<span class="classic">Potential investors want to know the person behind the business; your skills, how you present yourself, your experience and credibility, all play a vital role if you wish to see your business idea succeed.<br><br/></span></a>
            </p>

            <input value="<?php echo $uservideoname; ?>" type="text" name="user_default_business_videodesc[]"
                   id="fileName<?php echo $j; ?>" class="file_input_textbox" style="width:335px;"/>

            <div class="clear"></div>

            <!-- File Upload for Company Logo -->

            <div style="margin-top:20px; margin-bottom:50px; text-align:center;">

                <?php

                if ($uservideoname != "") {

                    ?>

                    <a class="button gray" title="Upload logo"
                       href="<?php echo Yii::app()->baseUrl; ?>/admin/blisting/blisting/downloadvideo?file=<?php echo $uservideoname; ?>">
                        &nbsp; Download Video<?php echo $j; ?> &nbsp;</a>

                <?php

                } else {

                    ?>

                    <a class="button gray" title="Upload logo" href="#" onclick="alert('Video file not exist..');">
                        &nbsp; Download Video<?php echo $j; ?> &nbsp;</a>

                <?php

                }

                ?>

                <div class="upload_video_res_<?php echo $j; ?>"></div>

                <div id="loading_<?php echo $j; ?>" style="display: none;"><img src="loading.gif" alt='Loading image'>
                </div>


            </div>

            <p class="slisting-head">Video <?php echo $j; ?> (YouTube link) <a class="sl-tip tooltip" href="#;">?<span
                        class="classic">YouTube link place.<br><br/></span></a></p>

            <input size="60" maxlength="200" class="file_input_textbox" name="user_default_business_video[]"
                   id="Blisting_user_default_business_video<?php echo $j; ?>" type="text" style="  width: 335px;">


        <?php
        } else {
            ?>
            <p class="slisting-head">Video <?php echo $j; ?> (YouTube link) <a class="sl-tip tooltip" href="#;">?<span
                        class="classic">YouTube link place.<br><br/></span></a></p>

            <input size="60" maxlength="200" value="<?php echo $uservideoname; ?>" class="file_input_textbox"
                   name="user_default_business_video[]" id="Blisting_user_default_business_video<?php echo $j; ?>"
                   type="text" style="  width: 335px;">

        <?php
        }
        ?>


    </div>

    <?php

    $k++;

}

?>

<div style="clear:both;"></div>
</div>
<div class="clear">&nbsp;</div>
<div class="content-container">
<div class="sl-basic-info pro-field" style="width:925px; margin-left:24px;">

    <label>Company slogon <a href="#;" class="sl-tip tooltip">?<span class="classic">Enter your business slogan.</span></a></label>

    <br>

    <?php echo $form->textField($model, 'user_default_business_slogon', array('class' => 'inp', 'id' => 'slogon', 'style' => 'width: 96.6%', 'onfocus' => "getNormal('#user_default_business_list_title');")); ?>

    <br>

    <label>Who we are<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter full details of your business activities, services, history etc.</span></a></label>

    <br>

    <?php

    echo $form->textArea($model, 'user_default_business_whoweare', array('size' => 60, 'id' => 'whoweare', 'class' => 'textarea-full', 'style' => 'height:100px', 'onfocus' => "getNormal('#user_default_business_list_what');"));

    ?>



    <br>

    <label>What we offer.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter details of what your business has to offer including any special offers to new businesses.</span></a></label>



    <?php echo $form->textArea($model, 'user_default_business_offer', array('size' => 60, 'id' => 'offer', 'class' => 'textarea-full', 'style' => 'height:70px', 'onfocus' => "getNormal('#user_default_business_list_explanation');",)); ?>


</div>


<br class="clear"/>

<div class="sl-basic-info pro-field" style="width:925px; margin-left:24px;">

    <label>What we can do for you.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter details of any services that your business has to offer our members.</span></a></label>



    <?php

    if ($modelNew->user_default_business_whatwecando) {

        echo $form->textArea('Businesslisting[user_default_business_whatwecando]', $modelNew->user_default_business_whatwecando, array('size' => 60, 'id' => 'whatwecando', 'class' => 'textarea-full', 'style' => 'height:70px', 'tabindex' => 7));

    } else {

        echo $form->textArea($model, 'user_default_business_whatwecando', array('size' => 60, 'id' => 'whatwecando', 'class' => 'textarea-full', 'style' => 'height:70px', 'tabindex' => 7));
    }

    echo $form->error($model, 'user_default_business_whatwecando');





    ?>

</div>

<div class="sl-basic-info" style="width:925px; margin-left:24px;">

    <label>Enter keywords for our search engine.<a href="#;" class="sl-tip tooltip">?<span class="classic">Be specific in the choice of your keywords. <br>A few well chosen descriptive words give better response than a large block of text that could make it difficult for you to attract the right kind of interest.<br>Separate each word with a comma and a space. </span></a></label>

    <?php echo $form->textArea($model, 'user_default_business_keyword', array('id' => 'keyword', 'class' => 'textarea-full', 'style' => 'height:100px;', 'onfocus' => "getNormal('#user_default_business_list_businessidea');",)); ?>


</div>


<br class="clear"/>

<br class="clear"/>

<div class="sl-bottom-buttons admin-button">


    <!--<a href="<?php echo $this->createUrl('delete', array('id' => $model->user_default_business_blid)); ?>" class="button red">Delete</a>-->

    <?php if ($model->user_default_business_lstatus == 3) { ?>

        <a href="<?php echo $this->createUrl('restore', array('id' => $model->user_default_business_blid)); ?>"
           class="button pink">Restore</a>



    <?php

    } else {

        ?>

        <a href="javaScript:void(0)" onClick="delete_confirm()" class="button red">Delete</a>

    <?php } ?>

    <a href="javaScript:void(0)" onClick="show_reject_form()" class="button orange">Reject</a>

    <!--  <a href="javaScript:void(0)" onClick="show_email_form()" class="button blue">Update</a></td>-->

    <a href="javaScript:void(0)" onClick="validform()" class="button blue">Update</a>

    <?php

    if ($model->user_default_business_lstatus == 1) {

        ?>

        <a href="javaScript:void(0)" onClick="show_suspension_form()" class="button black">Suspend</a>

    <?php

    } else {

        ?>

        <a href="<?php echo $this->createUrl('publish', array('id' => $model->user_default_business_blid)); ?>"
           class="button update-green">Publish</a>

    <?php } ?>

    <div class="clear"></div>

</div>


<div class="row buttons">

    <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

</div>

<!--- Update User Listing -->

<div class="update-email-box big-popup" style="display: none;">

    <div class="terms-conditions u-email-box">

        <div class="my-account-popup-box">

            <a title="Close" href="javaScript:void(0)" onclick="close_email_form()" class="pu-close">X</a>

            <h2>User listing update notification</h2>

            <?php $userdetails = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id)); ?>

            <h3><span
                    class="fltL">User: <span><?php echo $userdetails[0]['user_default_business_name']; ?></span></span>
                <span
                    class="fltR">Listing title: <span><?php echo $model['user_default_business_slogon']; ?></span></span>
            </h3>

            <div id="email_error" class="error_msg"></div>


            <table id="reg-table" style="width: 100%;">

                <tr>
                    <th class="black-text">Details of changes made</th>
                </tr>
                <tr>
                    <td><?php echo $model['user_default_business_slogon']; ?></td>
                </tr>


            </table>

            <div class="confirmbtn">

                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Submit', array('class' => 'button black', 'name' => 'update')); ?>

            </div>


        </div>

    </div>

</div>









<?php $this->endWidget(); ?>

<div class="admin-popup">

<div class="show_reject_form big-popup" style="display: none;">

    <form
        action="<?php echo $this->createUrl('rejection', array('id' => $model->user_default_business_blid)); ?>"
        method="post">

        <div class="terms-conditions u-email-box">

            <div class="my-account-popup-box">

                <a title="Close" href="javaScript:void(0)" onclick="close_reject_form()" class="pu-close">X</a>

                <h2>User listing rejection notification</h2>

                <?php $userdetails = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id)); ?>

                <h3><span
                        class="fltL">User: <span><?php echo $userdetails[0]['user_default_business_name']; ?></span></span><span
                        class="fltR">Listing title: <span><?php echo $model['user_default_business_slogon']; ?></span></span>
                </h3>

                <div class="error_msg"></div>


                <table class="reg-table" style="width: 100%;">

                    <tr>

                        <th class="black-text">Reason for rejection</th>

                    </tr>

                    <tr>

                        <th>

                            <textarea rows="4" cols="50" name="rejectval"
                                      placeholder="Text entered here by admin appears here"></textarea>

                        </th>


                    </tr>


                </table>

                <div class="confirmbtn">

                    <!--<a href="<?php echo $this->createUrl('rejection', array('id' => $model->user_default_business_blid)); ?>" class="button black">Sumbit</a>-->

                    <input type="submit" name="rejection" value="Submit" class="button black"/>

                </div>


            </div>

        </div>

    </form>

</div>


<div class="show_publish_form" style="display: none;">

    <form
        action="<?php echo $this->createUrl('publish', array('id' => $model->user_default_business_blid)); ?>"
        method="post">

        <div class="terms-conditions u-email-box">

            <div class="my-account-popup-box">

                <a title="Close" href="javaScript:void(0)" onclick="close_publish_form()" class="pu-close">X</a>

                <h2>User listing publish notification</h2>

                <?php $userdetails = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id)); ?>

                <h3>User:<?php echo $userdetails[0]['user_default_business_name']; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; Listing title:<?php echo $model['user_default_business_slogon']; ?></h3>

                <div class="error_msg"></div>


                <table class="reg-table" style="width: 100%;">

                    <tr>

                        <th class="darkGrey-text">Notification of publish</th>

                    </tr>

                    <tr>


                        <th>
                            <input type="hidden" name="listing_title"
                                   value="<?php echo $model['user_default_business_slogon']; ?>"/>
                            <textarea rows="4" cols="50" name="publishval">

                                Text entered here by admin appears here

                            </textarea>

                        </th>


                    </tr>


                </table>

                        <span class="middle">

                            <input type="submit" name="publish" value="Submit" class="button black"/>

                        </span>


            </div>

        </div>

    </form>

</div>

<div class="show_suspension_form big-popup" style="display: none;">

    <form
        action="<?php echo $this->createUrl('suspension', array('id' => $model->user_default_business_blid)); ?>"
        method="post">

        <div class="terms-conditions u-email-box">

            <div class="my-account-popup-box">

                <a title="Close" href="javaScript:void(0)" onclick="close_suspension_form()" class="pu-close">X</a>

                <h2>User listing suspension notification</h2>

                <?php $userdetails = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id)); ?>

                <h3><span
                        class="fltL">User: <span><?php echo $userdetails[0]['user_default_business_name']; ?></span></span>
                    <span
                        class="fltR"> Listing title: <span><?php echo $model['user_default_business_slogon']; ?></span></span>
                </h3>

                <div class="error_msg"></div>
                <input type="hidden" name="listing_title"
                       value="<?php echo $model['user_default_business_slogon']; ?>"/>

                <table class="reg-table" style="width: 100%;">

                    <tr>

                        <th class="darkGrey-text">Notification of suspension</th>

                    </tr>
                    <tr>
                        <th>
                            <textarea rows="4" cols="50" name="suspensionval">
                                Text entered here by admin appears here
                            </textarea>
                        </th>


                    </tr>


                </table>

                <div class="confirmbtn">

                    <input type="submit" name="suspension" value="Submit" class="button black"/>

                </div>


            </div>

        </div>

    </form>

</div>

<div class="show_delete_form big-popup" style="display: none;">

    <form
        action="<?php echo $this->createUrl('rdelete', array('id' => $model->user_default_business_blid)); ?>"
        method="post">

        <div class="terms-conditions u-email-box">

            <div class="my-account-popup-box">

                <a title="Close" href="javaScript:void(0)" onclick="close_delete_form()" class="pu-close">X</a>

                <h2>User listing deletion notification</h2>

                <?php $userdetails = Business::model()->findAllByAttributes(array("user_default_business_id" => $model->user_default_business_id)); ?>

                <h3><span
                        class="fltL">User:<span><?php echo $userdetails[0]['user_default_business_name']; ?></span></span><span
                        class="fltR">Listing title:<span><?php echo $model['user_default_business_slogon']; ?></span></span>
                </h3>

                <div class="error_msg"></div>


                <table class="reg-table" style="width: 100%;">

                    <tr>

                        <th class="black-text">Reason for deletion</th>

                    </tr>

                    <tr>

                        <th>

                            <textarea rows="4" cols="50" name="deletionval"
                                      placeholder="Text entered here by admin appears here"></textarea>

                        </th>


                    </tr>


                </table>

                <div class="confirmbtn">

                    <input type="submit" name="delete" value="Submit" class="button black"/>

                </div>


            </div>

        </div>

    </form>

</div>


<div class="delete_confirm black-popup" style="display: none;">


    <div class="terms-conditions u-email-box">

        <div class="my-account-popup-box">

            <h1 style="color:black;  text-align: center; font-size:20px;">WARNING</h1><br/>

            <span>Are you sure you want to move this listing to the recycle bin?</span><br/>

            <span>This listing will be totally removed off the server in 7 days</span><br/>

            <span>After 7 days you will NOT be able to recover this listing.</span>

            <div class="confirmbtn">

                <button onClick="deleteDilog()">OK</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button onClick="jQuery('.delete_confirm').hide();

        return false;">Cancel
                </button>

            </div>

        </div>

    </div>

</div>


<div class="delete_confirm1 black-popup" style="display: none;">


    <div class="terms-conditions u-email-box">

        <div class="my-account-popup-box">

            <span>Are you sure you want to delete this listing from the website?</span><br/>

            <span>Warning this action cannot be undone</span><br/>


            <div class="confirmbtn">

                <button onClick="jQuery('.delete_confirm1').hide();

        jQuery('.show_delete_form').fadeIn();

        return false;">OK
                </button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button onClick="jQuery('.delete_confirm1').hide();

        return false;">Cancel
                </button>

            </div>

        </div>

    </div>

</div>


</div>

</div>

<script type="text/javascript">

function delete_confirm() {

    jQuery(".delete_confirm").fadeIn();

}

function deleteDilog() {

    jQuery(".delete_confirm").hide();

    jQuery(".delete_confirm1").fadeIn();

}


jQuery(document).ready(function () {

    jQuery(".show_reject_form").hide();

    jQuery(".show_delete_form").hide();

    jQuery(".show_suspension_form").hide();

    jQuery(".show_publish_form").hide();

    jQuery(".delete_confirm").hide();

    jQuery(".delete_confirm1").hide();

});

// show email form

function show_email_form() {

    jQuery(".update-email-box").fadeIn();

}

function close_email_form() {

    jQuery(".update-email-box").fadeOut();


}

function show_reject_form() {

    jQuery(".show_reject_form").fadeIn();

}

function close_reject_form() {

    jQuery(".show_reject_form").fadeOut();

}

function show_delete_form() {

    jQuery(".show_delete_form").fadeIn();

}

function close_delete_form() {

    jQuery(".show_delete_form").fadeOut();

}

function show_suspension_form() {

    jQuery(".show_suspension_form").fadeIn();

}

function close_suspension_form() {

    jQuery(".show_suspension_form").fadeOut();

}

function show_publish_form() {

    jQuery(".show_publish_form").fadeIn();

}

function close_publish_form() {

    jQuery(".show_publish_form").fadeOut();

}


var checkForFinance = false;

jQuery('.financial input').click(function () {

    if (jQuery('.amountselect input[name="user_default_business_famount"]:checked').length) {

        jQuery('.amountselect input').prop('checked', false);

    }

    checkForFinance = false;

    if (jQuery('.no_financeData input[type="text"]').hasClass('mandatoryerror')) {

        jQuery('.no_financeData input[type="text"]').removeClass('mandatoryerror');

    }

    jQuery('.no_financeData input[type="text"]').attr({'disabled': 'disabled', 'placeholder': ''});

    jQuery('.no_financeData input[type="text"]').css({'background': '#F0F0F0'});

});


jQuery('.amountselect input').click(function () {

    if (jQuery('.financial input[name="user_default_business_financial_data"]:checked').length) {

        jQuery('.financial input').prop('checked', false);

    }

    checkForFinance = true;

    jQuery('.no_financeData input[type="text"]').removeAttr('disabled');

    jQuery('.no_financeData input[type="text"]').css({'background': '#F1E5E2'});

});


// Advert Carousel

var JQ1 = jQuery.noConflict();


//form validations

function validform() {

    var failedvalidation = false;

    /*

     for(var i=1;i<=5;i++){



     if(JQ1('#image-description-'+i).val() == "")

     {

     JQ1('#image-description-'+i).addClass('mandatoryerror');

     JQ1('#image-description-'+i).attr('placeholder','Please enter image description');

     failedvalidation = true;

     }

     else

     {

     JQ1('#image-description-'+i).removeClass('mandatoryerror');

     JQ1('#image-description-'+i).attr('placeholder','');



     }

     if(JQ1('#image-description-'+i).val()=='Please enter image description'){

     JQ1('#image-description-'+i).val('');

     }





     }*/


    JQ1('.select_error').remove();


    /**    @validation for listing category */

    /*var sl_category = JQ1('#sl_category option:selected').val();

     if(sl_category == ""){

     JQ1("#sl_category").siblings().addClass('mandatoryerror');

     JQ1("#sl_category").siblings().css('border-radius','5px');

     var sibling_id = JQ1("#sl_category").siblings().attr('id');

     JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");

     failedvalidation = true;

     }else{

     JQ1("#sl_category").siblings().removeClass('mandatoryerror');

     JQ1("#sl_category").siblings().css('border-radius','0');

     }*/


    /**    @validation for listing profession */

    /*var sl_profession = JQ1('#sl_profession option:selected').val();

     if(sl_profession == ""){

     JQ1("#sl_profession").siblings().addClass('mandatoryerror');

     JQ1("#sl_profession").siblings().css('border-radius','5px');

     var sibling_id = JQ1("#sl_profession").siblings().attr('id');

     JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");

     failedvalidation = true;

     }else{

     JQ1("#sl_profession").siblings().removeClass('mandatoryerror');

     JQ1("#sl_profession").siblings().css('border-radius','0');

     }*/


    /** @check address1 empty or not */

    var category = JQ1('#sl_category').val();

    if (category == "") {

        JQ1("#sl_category").addClass('mandatoryerror');

        JQ1("#sl_category").attr('placeholder', 'Please enter your profession');

        failedvalidation = true;

    } else {

        JQ1("#sl_category").removeClass('mandatoryerror');

        JQ1("#sl_category").attr('placeholder', '');

    }


    var profession = JQ1('#sl_profession').val();

    if (profession == "") {

        JQ1("#sl_profession").addClass('mandatoryerror');

        JQ1("#sl_profession").attr('placeholder', 'Please enter your profession');

        failedvalidation = true;

    } else {

        JQ1("#sl_profession").removeClass('mandatoryerror');

        JQ1("#sl_profession").attr('placeholder', '');

    }


    var slogon = JQ('#slogon').val();

    if (slogon == "") {

        JQ1("#slogon").addClass('mandatoryerror');

        JQ1("#slogon").attr('placeholder', 'Please enter company slogon');

        failedvalidation = true;

    }

    else {

        JQ1("#slogon").removeClass('mandatoryerror');

        JQ1("#slogon").attr('placeholder', '');

    }

    /** @check town empty or not */

    var whoweare = JQ1('#whoweare').val();

    if (whoweare == "") {

        JQ1("#whoweare").addClass('mandatoryerror');

        JQ1("#whoweare").attr('placeholder', 'Please enter who we are');

        failedvalidation = true;

    } else {

        JQ1("#whoweare").removeClass('mandatoryerror');

        JQ1("#whoweare").attr('placeholder', '');

    }

    /** @check county empty or not */

    var offer = JQ1('#offer').val();

    if (offer == "") {

        JQ1("#offer").addClass('mandatoryerror');

        JQ1("#offer").attr('placeholder', 'Please write what we offer');

        failedvalidation = true;

    } else {

        JQ1("#offer").removeClass('mandatoryerror');

        JQ1("#offer").attr('placeholder', '');

    }

    /** @check zip_code empty or not */

    var keyword = JQ1('#keyword').val();

    if (keyword == "") {

        JQ1("#keyword").addClass('mandatoryerror');

        JQ1("#keyword").attr('placeholder', 'Please enter your keyword');

        failedvalidation = true;

    } else {

        JQ1("#keyword").removeClass('mandatoryerror');

        JQ1("#keyword").attr('placeholder', '');

    }

    /** @check tel_no empty or not */

    /*var tel_no = JQ1('#testimonial').val();

     if(tel_no == ""){

     JQ1("#testimonial").addClass('mandatoryerror');

     JQ1("#testimonial").attr('placeholder','Please enter your testimonial');

     failedvalidation = true;

     }else{

     JQ1("#testimonial").removeClass('mandatoryerror');

     JQ1("#testimonial").attr('placeholder','');

     }*/


    if (failedvalidation) {

        JQ1('#submit_user_listing_step1').val(0);

        return false;

    } else {



        //JQ1("#businesslisting-form").submit();

        //jQuery('#submit_user_listing_step1').val(1);

        JQ1(".update-email-box").fadeIn();


    }


}

jQuery(document).ready(function () {

    jQuery(".pu-close1").live("click", function () {

        jQuery(".confirm").show();

    })


    close_form();

});


function close_form() {
    JQ1(".confirm").hide();

}


function saveforlater() {

    document.getElementById("btnsaveforlater").value = 1;

    document.getElementById("businesslisting-form").submit();

}

//--></script>


<script type="text/javascript">


    /* tinymce.init({

     selector: "#testimonial",

     plugins: [

     "advlist autolink lists link  charmap  preview anchor",

     "searchreplace visualblocks  ",

     ],

     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"

     });



     tinyMCE.init({

     selector: "#whoweare",

     menubar:false,

     statusbar: false,

     toolbar: false

     //etc

     });





     tinyMCE.init({

     selector: "#offer",

     menubar:false,

     statusbar: false,

     toolbar: false

     //etc

     });



     tinyMCE.init({

     selector: "#whatwecando",

     menubar:false,

     statusbar: false,

     toolbar: false

     //etc

     });
     */


    jQuery(document).ready(function () {

        jQuery(".pu-close1").live("click", function () {

            jQuery(".confirm").show();

        })


        close_form();

    });


    function close_form() {
        jQuery(".confirm").hide();

    }


    function saveforlater() {

        document.getElementById("btnsaveforlater").value = 1;

        document.getElementById("business_listing_step4").submit();

    }

</script>