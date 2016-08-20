<?php
$themepath = Yii::app()->theme->baseUrl;
Yii::app()->clientScript->registerScriptFile($themepath . '/js/jquery.validate.min.js');
$years = explode(',', $model->user_default_listing_fprojections);
?>
<?php
/* @var $this ListingController */
/* @var $model Userlisting */
$type = $model->getType();
?>

<div class="breadcrumb" style="padding-bottom: 7px;">
    <a href="/">Home</a> » <a href="<?php echo $type['slug']; ?>"><?php echo strtolower($type['name']); ?></a> »
    <span><?php echo $model->user_default_listing_title; ?>  </span>
</div>
<?php
/*
$this->breadcrumbs=array(
  strtolower($type['name']) => $type['slug'],
  $model->user_default_listing_title
);
*/

if ($type['slug'] == "business-ideas") {
    $toclass = "#yw2 li";
} else if ($type['slug'] == "retail") {
    $toclass = "#yw4 li";
} else if ($type['slug'] == "industrial") {
    $toclass = "#yw6 li";
} else if ($type['slug'] == "science-and-technology") {
    $toclass = "#yw8 li";
}

?>


<script>
    $(function () {
        $('<?php echo $toclass; ?>').addClass('active');
    });
</script>


<?php
if(isset($_GET['mess']))
{
/*$msg=$_POST['message'];
$userid=$_POST['userid'];
$listid=$_POST['listid'];
$status=$_POST['drg_mktqstatus'];
$date_create = date('Y-m-d H:i:s');
$sql = "insert into user_default_interactions (user_default_interaction_message, user_default_profile_id, user_default_listing_id, user_default_attachment, user_default_first_interations, user_default_date_create) values (:user_default_interaction_message, :user_default_profile_id, :user_default_listing_id, :user_default_attachment, :user_default_first_interations, :user_default_date_create)";
$parameters = array(":user_default_interaction_message"=>$msg, ":user_default_profile_id" =>$userid,  ":user_default_listing_id" =>$listid, ":user_default_attachment" =>$status, ":user_default_first_interations" =>'1', ":user_default_date_create" =>$date_create);
Yii::app()->db->createCommand($sql)->execute($parameters);*/
?>
<script>
$(function() {

     jQuery(".contact_cont").fadeOut('fast');

	 jQuery(".contact_inner").fadeOut('fast');

	 jQuery(".sign-up-tabss").fadeIn('fast');	

	 jQuery("#tab2").fadeIn('fast');		

	 jQuery("#taba").show();			
	 
	 jQuery("#tabhide1").removeClass('active');	

	 jQuery("#tabshow2").addClass('active');
     console.log( jQuery('.thank-vote-box'),"dfgdgd");

   jQuery('.thank-vote-box').show();   
	 
});
</script>
<?php
}
?>

<div>
    <?php
    $listId = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $this->renderPartial('//../modules/listing/views/layouts/listing_slider', array('listid' => $listId));
    ?>
</div>
<div style="clear:both;"></div>
<div class="sign-up-tabss"> <!-- start sign up tab -->

<div id="tabs_container">
    <ul id="sign-up-tabs">

        <?php
        $address = Samplelisting::model()->find("user_default_listing_id ='".$model->user_default_listing_id."' ");

        if($address->user_default_sample_listing_status=='1')

        {
            ?>
            <li class="active" id="tabhide1"><a href="#taba"  onclick="javascript:stepcarousel.loadcontent('dragongallery', '<?php echo Yii::app()->createUrl('listing/listingsslider/listid/' . $model->user_default_listing_id) ?>')">Details<br/>

                    18/03/2012</a></li>

            <li id="tabshow2"><a href="#tab2" onclick="javascript:stepcarousel.loadcontent('dragongallery', '<?php echo Yii::app()->createUrl('listing/listingsslider/listid/' . $model->user_default_listing_id) ?>')">Voice your Opinion<br/>

                    <span id="totalComment">(No of comments)</span></a></li>

            <li id="tabshow3"><a href="#tab3" id="tabs3" onclick="javascript:stepcarousel.loadcontent('dragongallery', '<?php echo Yii::app()->createUrl('sample/sampleslider/listid/' . $model->user_default_listing_id) ?>')">Request a Sample<br/>

                    (1)</a></li>

            <li><a href="#tab4" onclick="javascript:stepcarousel.loadcontent('dragongallery', '<?php echo Yii::app()->createUrl('listing/listingsslider/listid/' . $model->user_default_listing_id) ?>')">Open for Bidding<br/>

                    (0)</a>
            </li>

            <li><a href="#tab5" onclick="javascript:stepcarousel.loadcontent('dragongallery', '<?php echo Yii::app()->createUrl('listing/listingsslider/listid/' . $model->user_default_listing_id) ?>')">Open for Investment<br/>

                    (0)</a></li>

            <li><a href="#tab6" onclick="javascript:stepcarousel.loadcontent('dragongallery', '<?php echo Yii::app()->createUrl('listing/listingsslider/listid/' . $model->user_default_listing_id) ?>')">Investor Area</a></li>
            <?php
        }
        else
        {
            ?>
            <li class="active" id="tabhide1"><a href="#taba">Details<br/>

                    18/03/2012</a></li>

            <li id="tabshow2"><a href="#tab2">Voice your Opinion<br/>

                    <span id="totalComment">(No of comments)</span></a></li>

            <li><a href="#tab3">Request a Sample<br/>

                    (0)</a></li>

            <li><a href="#tab4">Open for Bidding<br/>

                    (0)</a>
            </li>

            <li><a href="#tab5">Open for Investment<br/>

                    (0)</a></li>

            <li><a href="#tab6">Investor Area</a></li>
            <?php
        }
        ?>

        <div class="clear"></div>

    </ul>
    <div class="clear"></div>
</div>
<!-- /tabs_container -->

<div id="tabs_content_container">
<div id="taba" class="preview-listing-box sign-up-tab_content" style="display:block;">
    <!-- vote-sign-in-box-->
    <div class="vote-sign-in-box" >
        <div id="terms-conditions" class="vote-sign-in"><img
                src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png"
                style="width:34%;    margin-left: -38px;"/>

            <div class="vote-popup-box">
                <a title="Close" href="javaScript:void(0)" onclick="close_vote_register_form()"
                   class="listing-close">X</a>

                <h2 style="color:#f7821f; font-size: 29px;">Oops!</h2>

                <h2>You must be logged in to register your vote</h2>

                <div id="email_error" class="error_msg"></div>
                <form method="post" name="frmloginforvote" id="frmloginforvote" class="vote-member-box">
                    <div class="vote-member-box">
                        <fieldset style="margin-bottom: 8px">
                            <div class="fieldset-label "> If you are a member</div>


                            <table width="100%">
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="username" id="username" placeholder="Username"
                                               class="input-style" tabindex="1" style="margin-right:10px">
                                    </td>
                                    <td>
                                        <input type="password" name="password" id="password" placeholder="Password"
                                               class="input-style" tabindex="2">
                                    </td>
                                    <td>
                                        <button class="login_sbmt" name="externalLogin" id="externalLogin" type="submit"
                                                title="Log into your account"><img
                                                style="border-radius:5px;margin-bottom:0px;"
                                                src="<?php echo Yii::app()->theme->baseUrl ?>/images/buttons/user.png"
                                                width="25"></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="floatRight forgotten" style="text-decoration:underline"><a
                                    href="<?php echo Yii::app()->baseUrl ?>?retrieve=password"
                                    title="Forgotten your password">forgotten your password?</a></div>

                        </fieldset>
                </form>
            </div>
            <!--  <form method="post" name="frmregisterforvote" id="frmregisterforvote">-->
            <div class="vote-popup-box-register">
                <fieldset>
                    <div class="fieldset-label"> If you are not a member</div>


                    <div align="center">So that we may register your vote for <span
                            style="color: orange;font-size: 12px"><?php echo $model->user_default_listing_title; ?></span>
                        we need to verify your vote for
                        security reasons
                    </div>
                    <div>&nbsp;</div>


                    <table width="100%">
                        <tbody>
                        <tr>
                            <td><label>Name</label></td>
                            <td>:</td>
                            <td>
                                <input type="text" name="name" id="name" tabindex="3">

                                <div id="registerVoteNameError"></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Surname</label></td>
                            <td>:</td>
                            <td>
                                <input type="text" name="surname" id="surname" tabindex="4">

                                <div id="registerVoteSurnameError"></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email address</label></td>
                            <td>:</td>
                            <td><input type="text" name="email" id="email" tabindex="5" value="">

                                <div id="registerVoteEmailError"></div>
                                <div id="validEmail"></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Confirm email address</label></td>
                            <td>:</td>
                            <td>
                                <input type="text" name="confirm_email" id="confirm_email" tabindex="6" value="">

                                <div id="registerVoteConfirmEmailError"></div>
                            </td>
                        </tr>


                        <tr> <td> </td>
                              <td>  </td>
                          <td>
                
                            <span>
                             <div class="vote-popup-box-reg-captcha" style="margin:0px;">
                                 <img id="siimage"
                                      style=" width:165px; height:45px; border:1px solid #ccc; margin-right: 18px"
                                      src="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>"
                                      alt="CAPTCHA Image" align="left"/>
                                 <object type="application/x-shockwave-flash"
                                         data="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.swf?audio_file=<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000"
                                         height="23" width="23">
                                     <param name="movie"
                                            value="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.swf?audio_file=<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
                                 </object>
                                 &nbsp; <a tabindex="-1" style="border-style: none;" href="#"
                                           title="Refresh Image"
                                           onclick="document.getElementById('siimage').src = '<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false">
                                     <img
                                         src="<?php echo Yii::app()->baseUrl; ?>/captcha/images/refresh.png"
                                         alt="Reload Image" onclick="this.blur()" align="bottom"
                                         border="0" height="23" width="23"
                                         style="/*margin-left: -34px;*/float:right;margin-bottom: -26px "/></a><br
                                     style="clear:both"/>
                                 <br/>
                                 <center style="font-size:8px;/*margin-top: 20px;*/margin-bottom:-15px">Type the
                                     characters you see in the
                                     picture below
                                 </center>
                                 <br/>
                                 <input type="text" id="User_drg_verifycode"
                                        name="User[drg_verifycode]" class="captcha_fld" size="20"
                                        maxlength="10"/>
                                 <br/>
                                 <input type="hidden" name="captcha_validation"
                                        id="captcha_validation" value=""/>

                                 <div id="registerVoteSecuriteCodeError"></div>
                             </div>
                            </span>
                          </td>
                          </tr>
                          <tr><td>  </td>
                              <td> </td>
                              <td>   
                                    <input style="margin-left:0px;" name="register_your_vote" id="register_your_vote" value="Register your vote"
                                           type="button" class="button reg-btn" tabindex="7"/>
                                 </td>
                           </tr>      
                    
                        </tbody>
                    </table>
               </fieldset>

            </div>

            <!--</form>-->
        </div>
    </div>
</div>
<!-- end vote-sign-in-box-->

<div class="thank-vote-box">
    <div id="terms-conditions" class="u-email-box"><img
            src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/robot-torso.png" style="margin-bottom: -38px;"/>

        <div class="vote-popup-box">
            <h2 class="Blue" style="margin-top: 15px;">Thank you for your vote</h2>

            <div align="center" style="margin-top: 15px;font-size: 13px;">You have earned <span style="color: orange;">75</span>
                points in just this visit.
                Why not become a member and use those points to enter our monthly prize draw?
            </div>
            <div>&nbsp;</div>
            <div align="center" style="margin-top: 15px;font-size: 13px;">Membership is completely FREE.
                But it will open up a whole new world of what you can achieve on this website
            </div>
            <div>&nbsp;</div>
            <div align="center" style="margin-top: 15px;font-size: 13px;">To become a member please click here >></div>
            <div>&nbsp;</div>
                 <span class="middle">
                <input name="close" id="btnclose" value="Close" type="button" class="button black"
                       onclick="close_thank_vote_box();"/>
                </span>

        </div>
    </div>
</div>
<div class="vote_registration_link_notice">
    <div id="terms-conditions" class="u-email-box"><img
            src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/pink-robot-2.png"
            style="margin-bottom: -46px; !important;"/>

        <div class="vote-popup-box">
            <h2 class="Blue" style="margin-top: 25px;">Thank you <span id="RegisterVoteUsername1"></span> .
                <input type="hidden" id="RegisterVoteUsername" value="">
                <input type="hidden" id="RegisterVoteEmail" value="">
                <br/>
                A vote registration link has been sent to your email address.</h2>

            <div align="center" style="margin-top: 24px; font-size: 15px;margin-bottom: 10px;">Didn't get the
                email? <span style="color:#666;"> Please check your Span/Junk email folder
                If you didn't receive an email please click <a href="#" id="resendVoteRegisterLink"> here>></a></span>
                to resend the vote registration link
            </div>
            <div>&nbsp;</div>
                 <span class="middle">
                <input name="close" id="btnclose" value="Close" type="button" class="button black"
                       onclick="close_vote_registration_link_notice();"/>
                </span>

        </div>
    </div>
</div>
<!-- submit-listing box starts -->
<div>
    <?php if (!Yii::app()->user->isGuest) {
        $user_id = Yii::app()->user->id;
        $fav_exists = Favourites::model()->findByAttributes(array('user_default_profile_id' => $user_id, 'user_default_listing_id' => $model->user_default_listing_id));
        if ($fav_exists) {
            $btn_text = 'Remove from favourites';
            $btn_link = 'remove_favourite';
        } else {
            $btn_text = 'Add to favourites';
            $btn_link = 'add_favourite';
        }
        ?>

        <?php
        $abimage = $this->createAbsoluteUrl('upload/users/' . Yii::app()->user->getState('ufolder') . '/listing/big/' . $model->user_default_listing_thumbnail);
        $siteurl = $this->createAbsoluteUrl('/listing/view?id=' . $model->user_default_listing_id);
        ?>
    <a href="<?php echo Yii::app()->createUrl('listing/' . $btn_link . '?listid=' . $model->user_default_listing_id) ?>"
       class="button black float_right exitpreview"
       style="z-index:9999 !important"> <?php echo $btn_text; ?></a><?php } ?>

    <!-- <img src="<?php //echo Yii::app()->theme->baseUrl; ?>/images/social-network-icons.png" alt="business supermarket social network links" style="position: absolute; margin-left: 640px; margin-top: 32px;" /> -->
    <div class="social-share-button">
        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $model->user_default_listing_title; ?>&amp;p[summary]=<?php echo $model->user_default_listing_summary; ?>&amp;p[url]=<?php echo urlencode($siteurl); ?>&amp;
                                  p[images][0]=<?php echo $abimage; ?>" class="social-icon icon-facebook"
           target="_blank" alt="Facebook"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/facebook.png"
                                               style="width: 20px;"/></a>
        <!-- twitter -->
        <a class="social-icon icon-twitter"
           href="https://twitter.com/home?status=<?php echo $model->user_default_listing_summary; ?>+<?php echo urlencode($siteurl); ?>"
           target="_blank" alt="Twitter"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/twitter.png"
                                              style="width: 20px;"/></a>
        <!-- linkedin -->
        <a class="social-icon icon-linkedin"
           href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($siteurl); ?>&amp;title=<?php echo $model->user_default_listing_title; ?>&amp;summary=<?php echo $model->user_default_listing_summary; ?>"
           target="_blank" alt="LinkedIn"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/linkedin.png"
                                               style="width: 20px;"/></a>
        <!-- Google+ -->
        <a class="social-icon icon-google"
           href="https://plus.google.com/share?url=<?php echo urlencode($siteurl); ?>&amp;title=<?php echo $model->user_default_listing_title; ?>&amp;summary=<?php echo $model->user_default_listing_summary; ?>"
           target="_blank" alt="Google+"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/google+.png"
                                              style="width: 20px;"/></a>
    </div>

</div>
<div class="sl-page3">
<div class="pl-logo-box">
    <!--<img  src="users/subhjain_147/images/fcb70c8093a501ef1a0a83acb506c085.jpg" />-->
    <div id="pl-logo" class="pl-photograph">
        <?php
        if (!empty($model->user_default_listing_thumbnail)) {
            $userimage = Userlistingimages::model()->findAllByAttributes(array("user_default_listing_id" => $model->user_default_listing_id));

            $username = User::model()->findAllByAttributes(array("user_default_id" => $model->user_default_profiles_id));

            $ufolder = $username[0]['user_default_username'] . '_' . $username[0]['user_default_id'];
            $img_src = 'upload/users/' . $ufolder . '/listing/big/' . $model->user_default_listing_thumbnail;
            ?>
            <img id="pl-logo" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_src; ?>"
                 style="height:120px;width:185px;"/>
        <?php
        } else {
            ?>
            <br/><br/>Image coming soon.
        <?php
        }
        ?>
    </div>
    <div class="headings">
        <h2><?php echo $model->user_default_listing_title; ?></h2>

        <h3><?php echo $model->user_default_listing_what_is_it; ?></h3>

        <div class="content">
            <label class="heading">Listing number: <?php echo $model->user_default_listing_id; ?></label>

            <div style="height:auto;"><!--<span class="width_20">&nbsp;</span>--><?php
                $count = str_word_count($model->user_default_listing_summary);
                $expaln = implode(' ', array_slice(explode(' ', $model->user_default_listing_summary), 0, 150));
                ?>
                <div class="explain" style="overflow: hidden;">
                    <?php echo $expaln; ?><!--&nbsp;&nbsp;<a onclick="jQuery('.explainfull').show();jQuery('.explain').hide();" class="more readmore">Read more &gt;&gt;</a>-->
                </div>
                <div class="explainfull" style="display:none;">
                    <?php echo $model->user_default_listing_summary; ?> &nbsp;&nbsp; <a
                        onclick="jQuery('.explain').show();jQuery('.explainfull').hide();" class="more readmore">Read
                        less &gt;&gt;</a>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<br class="clear"/>

<div class="content">
    <label class="heading">Business history &amp; activities</label><br class="clear"/>

    <div>
        <div class="prevew_text" style="height:auto">
            <span class="width_20">&nbsp;</span>
            <?php $count = str_word_count($model->user_default_listing_details); ?>
            <?php //echo $model->user_default_listing_details; ?>

            <?php
            if ($count > 100) {
                $test = implode(' ', array_slice(explode(' ', $model->user_default_listing_details), 0, 50));
            } else {
                $test = implode(' ', array_slice(explode(' ', $model->user_default_listing_details), 0, 25));
            }
            ?>
            <div class="less1">
                <?php echo $test; ?>&nbsp;&nbsp;<?php if ($count > 25) { ?><a
                    onclick="jQuery('.full').show();jQuery('.less1').hide();" class="more readmore">Read more
                    &gt;&gt;</a><?php } ?>
            </div>
            <div class="full" style="display:none;">
                <?php
                $test1 = $model->user_default_listing_details;
                $test2 = str_replace("\n", "</p><p>", $test1);
                echo $test2;
                ?> &nbsp;&nbsp; <a onclick="jQuery('.less1').show();jQuery('.full').hide();" class="more readmore">Read
                    less &gt;&gt;</a>
            </div>

        </div>


        <!--<a class="readmore less">Read more &gt;&gt;</a>-->
    </div>
</div>
<br class="clear"/>
<label class="heading">Financial Projections</label><br/>
<?php if ($model->user_default_listing_table_currency_code) { ?>

    <div class="pl-financial-view">
        <label> Year 1<br/> <span><?php echo number_format($years[0], 2, '.', ','); ?></span> </label>
        <label> Year 2<br/> <span><?php echo number_format($years[1], 2, '.', ','); ?></span> </label>
        <label> Present<br/> <span><?php echo number_format($years[2], 2, '.', ','); ?></span> </label>
        <label> Year 1<br/> <span><?php echo number_format($years[3], 2, '.', ','); ?></span> </label>
        <label> Year 2<br/> <span><?php echo number_format($years[4], 2, '.', ','); ?></span> </label>
        <label> Year 3<br/> <span><?php echo number_format($years[5], 2, '.', ','); ?></span> </label>

        <div class="clear"></div>
    </div>
    <br class="clear"/>
    <?php

    $amount_data = Data::model()->findByPk('1');
    $amount_data1 = CJSON::decode($amount_data->data);
    $info = "";
    foreach ($amount_data1 as $key => $value) {
        if ($model->user_default_listing_table_currency_code == $key) {
            $info = $value;
            break;
        }
    }
    ?>
    <div class="flow_right mrgn_r1"><em> Financial projections are in <?php echo $info; ?> </em></div>
<?php
} else {
    $financial_data = Data::model()->findByPk('2');
    $financial_data1 = CJSON::decode($financial_data->data);
    $info = '';
    foreach ($financial_data1 as $key => $value) {
        if ($model->user_default_listing_financial_table_status == $key) {
            $info = $value;
            break;
        }
    }
    ?>
    <div class="flow_left mrgn_l1"><span class="width_20">&nbsp;</span><?php echo $info; ?> </div>
<?php
}
?>
<div class="clear"></div>
<br/>

<div class="content">
    <label class="heading">What the entrepreneur/business wants</label><br class="clear"/>

    <div>
        <div class="prevew_text" style="height:auto;">
            <span class="width_20">&nbsp;</span>
            <?php $count = str_word_count($model->user_default_listing_want); ?>
            <?php //echo $model->user_default_listing_want;?>

            <?php
            if ($count > 100) {
                $test = implode(' ', array_slice(explode(' ', $model->user_default_listing_want), 0, 50));
            } else {
                $test = implode(' ', array_slice(explode(' ', $model->user_default_listing_want), 0, 25));
            }
            ?>
            <div class="less2">
                <?php echo $test; ?>&nbsp;&nbsp;<?php if ($count > 25) { ?><a
                    onclick="jQuery('.full1').show();jQuery('.less2').hide();" class="more readmore">Read more
                    &gt;&gt;</a><?php } ?>
            </div>
            <div class="full1" style="display:none;">
                <?php $user_default_listing_want = $model->user_default_listing_want;
                $content = str_replace("\n", "</p><p>", $user_default_listing_want);
                echo $content;

                ?>  &nbsp;&nbsp; <a onclick="jQuery('.less2').show();jQuery('.full1').hide();" class="more readmore">Read
                    less &gt;&gt;</a>
            </div>

        </div>
        <!--<a class="readmore less">Read more &gt;&gt;</a>-->
    </div>
</div>
<div class="clear"></div>
<br/>

<div class="clear"></div>
<br/>
<label class="heading">Market Research</label><br class="clear"/>
<?php
$user_id = yii::app()->user->getId();
if ($user_id != "") {
    ?>
    <div class="pl-mrquestion" style="height: 214px;">
        <p class="pl-question">

        <form action="<?php echo $this->createUrl("listing/submitvote") ?>" method="post">
            <?php
            $listMarketing = Userlistingmarketing::model()->findAllByAttributes(array('user_default_listing_id' => $model->user_default_listing_id));
            echo(isset($listMarketing[0]) ? $listMarketing[0]->user_default_listing_marketing_question : '');
            ?>
            <input type="hidden" id="listingQuestionId" name="listingQuestionId"
                   value="<?php echo(isset($listMarketing[0]) ? $listMarketing[0]->user_default_listing_marketing_id : ''); ?>">
            <br/>

            <div class="amountselect">
                <div style="width:100px;">Yes&nbsp;<input id="1" name="drg_mktqstatus" class="drg_mktqstatus"
                                                          type="radio" value="y" checked/></div>
                <div style="width:100px;">Maybe&nbsp;<input id="2" name="drg_mktqstatus" class="drg_mktqstatus"
                                                            type="radio" value="m"/></div>
                <div style="width:100px;">No&nbsp;<input id="3" name="drg_mktqstatus" class="drg_mktqstatus"
                                                         type="radio" value="n"/></div>
            </div>
        </p>
        <br/><br/>

        <div class="pl-reason">
            Please leave a reason for your voting choice below<br/>
            <textarea id="message" name="message" style="margin: 0px;width: 477px;height: 50px;" required=""></textarea>
            <?php
            $lid = $model->user_default_listing_id;
            ?>
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>"><input type="hidden" name="listid"
                                                                                      value="<?php echo $lid; ?>"/>
        </div>
        <p class="pl-question"><em class="grey">
                Your comments will be added to the forum (see voice your opinion tab above).<br/>
                where you may discuss your opinion further or take part in the debate.
            </em></p>
        <br class="clear"/>

        <div class="flow_right mrgn_r1 width70" style="margin-top:-23px;">
            <label class="heading">Submit</label>
                                        <span class="buttons-box flow_right">
                                                <button class="login_sbmt" id="login_sbmt" name="login_sbmt"
                                                        type="submit"
                                                        title="Submit your vote"><img
                                                        style="border-radius:5px; -moz-border-radius:5px; -o-border-radius:5px; -webkit-border-radius:5px;"
                                                        src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png"
                                                        width="25"></button>
                                        </span></form>
        </div>
    </div>
<?php
} else {
    ?>
    <div class="pl-mrquestion" style="height: 214px;">
        <p class="pl-question">
            <?php //echo $model->user_default_listing_marketing_question;
            $listMarketing = Userlistingmarketing::model()->findAllByAttributes(array('user_default_listing_id' => $model->user_default_listing_id));
            echo(isset($listMarketing[0]) ? $listMarketing[0]->user_default_listing_marketing_question : '');
            ?>
            <input type="hidden" id="listingQuestionId" name="listingQuestionId"
                   value="<?php echo(isset($listMarketing[0]) ? $listMarketing[0]->user_default_listing_marketing_id : ''); ?>">
            <br/>

        <div class="amountselect">
            <div style="width:100px;">Yes&nbsp;<input id="1" name="drg_mktqstatus" class="drg_mktqstatus" type="radio"
                                                      value="y"/></div>
            <div style="width:100px;">Maybe&nbsp;<input id="2" name="drg_mktqstatus" class="drg_mktqstatus" type="radio"
                                                        value="m"/></div>
            <div style="width:100px;">No&nbsp;<input id="3" name="drg_mktqstatus" class="drg_mktqstatus" type="radio"
                                                     value="n"/></div>
        </div>
        </p>
        <br/><br/>

        <div class="pl-reason">
            Please leave a reason for your voting choice below<br/>
            <textarea id="voteReason" name="voteReason" style="margin: 0px;
width: 477px;
height: 50px;"></textarea>
        </div>
        <p class="pl-question"><em class="grey">
                Your comments will be added to the forum (see voice your opinion tab above).<br/>
                where you may discuss your opinion further or take part in the debate.
            </em></p>
        <br class="clear"/>

        <div class="flow_right mrgn_r1 width70">
            <label class="heading">Submit</label>
                                        <span class="buttons-box flow_right">
                                                <button class="login_sbmt" id="submitVote" name="submitVote"
                                                        type="submit" title="Submit your vote"><img
                                                        style="border-radius:5px; -moz-border-radius:5px; -o-border-radius:5px; -webkit-border-radius:5px;"
                                                        src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png"
                                                        width="25"></button>
                                        </span>
        </div>
    </div>
<?php
}
?>
<div>
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/graph-image.jpg" width="236px" style="height: 224px;"/>
</div>
<div class="clear"></div>
<br/>
<br/>
</div>
</div>

<div id="tab2" class="sign-up-tab_content">


    <?php

    if (($model instanceof Userlisting)) {

        $this->renderPartial('//../modules/forum/views/forum/page', array('listing' => $model, 'adminKey' => $adminKey, 'admin' => false));
    }

    ?>

</div>
<!-- /End of tab2 Promotions tab -->


<div id="tab3" class="sign-up-tab_content">

    <?php
    //$this->renderPartial('sample_view', array('model' => $model));
    $this->renderPartial('//../modules/sample/views/sample/sample_view', array('model' => $model));

    ?>

</div>

<!-- /End of tab3 Product samples tab -->


<div id="tab4" class="sign-up-tab_content">
    <div>
        <div style="text-align:center;">
            <h2 class="headings"><?php echo $model->user_default_listing_title; ?></h2>
            <div class="investor_listing_info">Business Listing No </br>#1234567890</div>
        </div>

        <table width="100%" style="text-align:center;" >
            <tr>
                <td class="blue-font" style="width: 18%;">Investment Required


                    <a class="tooltip" style="background:none;position: absolute" href="#;">
                        <b>?</b>
                        <span class="classic" style="text-align: left;">Investment Required</span>
                    </a>

                </td>
                <td class="blue-font" style="width: 15%;">Equity on offer

                    <a class="tooltip" style="background:none;position: absolute" href="#;">
                        <b>?</b>
                        <span class="classic" style="text-align: left;">Equity on offer</span>
                    </a>
                </td>
                <td class="blue-font" style="width: 15%;">Equity available

                    <a class="tooltip" style="background:none;position: absolute" href="#;">
                        <b>?</b>
                        <span class="classic" style="text-align: left;">Equity Available</span>
                    </a>
                </td>
                <td class="blue-font" style="width: 20%;">Min Investment Value

                    <a class="tooltip" style="background:none;position: absolute" href="#;">
                        <b>?</b>
                        <span class="classic" style="text-align: left;">Min Investment Value</span>
                    </a>
                </td>
                <td class="blue-font" style="width: 15%;">Amount Funded

                    <a class="tooltip" style="background:none;position: absolute" href="#;">
                        <b>?</b>
                        <span class="classic" style="text-align: left;">Amount Funded</span>
                    </a>
                </td>
                <td class="blue-font" style="width: 20%;">Time Remaining

                    <a class="tooltip" style="background:none;position: absolute" href="#;">
                        <b>?</b>
                        <span class="classic" style="text-align: left;">Time Remaining</span>
                    </a>
                </td>
            </tr>
            <tr>
                <td>120,00</td>
                <td>20%</td>
                <td>15.12%</td>
                <td>$1.00</td>
                <td>$110,256.00</td>
                <td>2days 18hrs 21mins 16sec</td>
            </tr>
        </table>

        <label class="heading " >What the funding will be used for</label><div class="clearfix">&nbsp;</div>
        <textarea placeholder="" id="drg_list_businessidea" tabindex="7" style="height:80px;" class="textarea-full investBackgroundColor"> </textarea>
        <div class="clearfix">&nbsp;</div>
        <label class="heading " >How will the funding be used</label>
        <div class="clearfix">&nbsp;</div>
        <textarea placeholder="" id="drg_list_businessidea" tabindex="7" style="height:50px;" class="textarea-full investBackgroundColor"> </textarea>
        <div class="clearfix">&nbsp;</div>
        <table width="90%" style="text-align: center">

            <tr>
                <td width="20%" style="color: #A84793;">Expected returns</td>
                <td><label>Year 1</label><input value="" name="year1" id="year1" class="investBackgroundColor" style="width: 90%"></td>
                <td><label>Year 2</label><input value="" name="year2" id="year2" class="investBackgroundColor" style="width: 90%"></td>
                <td><label>Year 3</label><input value="" name="year3" id="year3" class="investBackgroundColor" style="width: 90%"></td>
                <td><label>Year 4</label><input value="" name="year4" id="year4" class="investBackgroundColor" style="width: 90%"></td>
                <td><label>Year 5</label><input value="" name="year5" id="year5" class="investBackgroundColor" style="width: 90%"></td>
            </tr>
        </table>

        <div style="text-align: center;font-weight: bold;margin:10px;"> Please enter the amount you would like to invest</div>
        <div style="text-align: center"><input value="00.00" name="investAmount" id="investAmount" class="grnt-btn input_small" style="width: 25% !important"></div>

        <div style="text-align: center;margin:10px;"> I wish to be considered for the position of Company Officer for this business  <input type="checkbox"> &nbsp; <a class="tooltip" style="background:none;position: absolute" href="#;">
                <b>?</b>
                <span class="classic" style="text-align: left;">I wish to be considered for the position of Company Officer for this business</span>
            </a></div>
        <div class="clearfix">&nbsp;</div>


        <div style="text-align: center;"><input type="button" id="btnPurchase" name="btnPurchase" value="Purchase" class="button black" ></div>

    </div>

</div>

<!-- /End of tab4 Open for bidding tabb -->


<div id="tab5" class="sign-up-tab_content">

    <div style="text-align:center;">
            <?php $this->renderPartial('//../modules/auction/views/default/index');?>
    </div>

</div>

<!-- /End of tab5 Investment opportunity tab -->


<div id="tab6" class="sign-up-tab_content">
        <?php
       /* if($_SESSION['protectUsername'] == 'jag'
        && $_SESSION['protectPassword'] == hash('sha256','123'))
        {*/
            /*if (($model instanceof Userlisting)) {

                $this->renderPartial('//../modules/investor/views/investorFinancial/index', array('listing' => $model, 'investorFinancilDataProvider' => $investorFinancilDataProvider));
            }
        /*}else{
            include_once(dirname(Yii::app()->basePath).'/password-protected.php');
        }*/
?>
        </div>
</div>
<!-- /End of tab6 Open for investment tab -->
</div>


<div id="screen"></div>
<script type="text/javascript">
$(".chzn-select").chosen();
function close_vote_register_form() {
    $('.vote-sign-in-box').fadeOut();
    $('#screen').removeAttr('style');
}
function close_thank_vote_box() {
    $('.thank-vote-box').fadeOut();
    $('#screen').removeAttr('style');
}
function close_vote_registration_link_notice() {
    $('.vote_registration_link_notice').fadeOut();
    $('#screen').css({opacity: 0.6, 'width': '100%', 'height': '110%'});
    $('body').css({'overflow': 'overflow'});
    $('.thank-vote-box').fadeIn();
    $('#screen').removeAttr('style');
}
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

function isValidateEmail(email) {
    isValid = true;

    if (!email.match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)) {
        isValid = false;
    }
    return isValid;

    alert(isValid);
}

function externalFrmValidation() {
    var isValid = true;
    var username = $('#username').val();
    var password = $('#password').val();
    if (username == '') {
        $('#username').css({'border': '1px solid red'});
        isValid = false;
    }
    if (password == '') {
        $('#password').css({'border': '1px solid red'});
        isValid = false;
    }
    return isValid;
}
$('.vote_registration_link_notice').fadeOut();
$('.thank-vote-box').fadeOut();
//  When user clicks on tab, this code will be executed
$("#sign-up-tabs li").click(function () {
    //  First remove class "active" from currently active tab
    $("#sign-up-tabs li").removeClass('active');
    //  Now add class "active" to the selected/clicked tab
    $(this).addClass("active");
    //  Hide all tab content
    $(".sign-up-tab_content").hide();
    //  Here we get the href value of the selected tab
    var selected_tab = $(this).find("a").attr("href");
    //  Show the selected tab content
    $(selected_tab).fadeIn();
    //  At the end, we add return false so that the click on the link is not executed
    return false;
});

$('#adminarea-tabs li').click(function () {
    //  First remove class "active" from currently active tab
    $('#adminarea-tabs').hide();
    $("#adminarea-tabs li").removeClass('active');
    //  Now add class "active" to the selected/clicked tab
    $(this).addClass("active");
    //  Hide all tab content
    $(".adminarea_tab_content").hide();
    //  Here we get the href value of the selected tab
    var selected_tab = $(this).find("a").attr("href");
    //  Show the selected tab content
    $(selected_tab).fadeIn();
    //  At the end, we add return false so that the click on the link is not executed
    return false;
});


$(".my-account-links li").click(function () {
    //  First remove class "active" from currently active tab
    $(".my-account-links li").removeClass('active');
    //  Now add class "active" to the selected/clicked tab
    $(this).addClass("active");
    //  Hide all tab content
    $(".investor-tab_content").hide();
    //  Here we get the href value of the selected tab
    var selected_tab = $(this).find("a").attr("href");
    //  Show the selected tab content
    $(selected_tab).fadeIn();
    //  At the end, we add return false so that the click on the link is not executed
    return false;
});
$('#submitVote').click(function () {

    var reason = $("#voteReason").val();

    if (reason == '') {
        $("#voteReason").css({'border': '1px solid red'});
        return false;
    }
    else {
        <?php if (Yii::app()->user->isGuest) { ?>
        $('.vote-sign-in-box').fadeIn();
        $('#screen').css({opacity: 0.6, 'width': '100%', 'height': '110%'});
        $('body').css({'overflow': 'overflow'});
        <?php }else{ ?>
        if ($("input:radio[name='drg_mktqstatus']").is(":checked") && $("#voteReason").val() != '') {

            var vote = $("input[name='drg_mktqstatus']:checked").val();
            var reason = $("#voteReason").val();
            var questionId = $('#listingQuestionId').val();

            $.ajax({
                type: "GET",
                url: "<?php echo Yii::app()->request->baseUrl.'/listing/Vote'; ?>",
                data: {
                    listingId: "<?php echo $model->user_default_listing_id;?>",
                    reason: reason,
                    vote: vote,
                    questionId: questionId

                },
                cache: false,
                success: function (result) {
                    alert(result);

                    $("input[name='drg_mktqstatus']:checked").checked = false;
                    $("#voteReason").val('');
                    return true;

                }
            });

        }
        <?php } ?>
    }
});

$('#resendVoteRegisterLink').click(function () {

    var username = $('#RegisterVoteUsername').val();
    var email = $('#RegisterVoteEmail').val();

    var dataString = 'username=' + username + '&email=' + email + '&listid=' +<?php echo $model->user_default_listing_id; ?>;

    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->request->baseUrl.'/listing/Registerforvotelink'; ?>",
        data: dataString,
        cache: false,
        success: function (value) {
            var data = JSON.parse(value);
            if (data.message == 'Success') {
                $('#screen').css({opacity: 0.6, 'width': '100%', 'height': '100%'});
                $('body').css({'overflow': 'overflow'});
                $('.vote_registration_link_notice').fadeIn();
            }
        }
    });
});

$("#email").blur(function () {

    var email = $("#email").val();
    $("#validEmail").text('');
    $("#validEmail").removeAttr('style');
    if (email != '' && isValidateEmail(email)) {

        var dataString = 'email=' + email;
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl.'/listing/CheckEmailUnique'; ?>",
            data: dataString,
            cache: false,
            success: function (value) {

                var data = JSON.parse(value);
                if (data.msg == 'isUnique') {

                    $("#validEmail").css({
                        //  "background-image": "url('<?php echo Yii::app()->theme->baseUrl?>/images/validNo.png')",
                        "height": "13px",
                        "background-repeat": "no-repeat",
                        "color": '#F00'
                    });
                    $("#validEmail").text('Email is already exists!');

                    return true;
                } else {

                    $("#validEmail").text('Email is available');
                    $("#validEmail").css({
                        // "background-image": "url('<?php echo Yii::app()->theme->baseUrl?>/images/validYes.png')",
                        "height": "13px",
                        "background-repeat": "no-repeat",
                        "color": '#00A600'
                    });
                    return true;
                }
            }
        });
    }

    return false;
});

$("#externalLogin").click(function (event) {
    event.preventDefault();
    var username = $('#username').val();
    var password = $('#password').val();

    var vote = $("input[name='drg_mktqstatus']:checked").val();
    var reason = $("#voteReason").val();
    var questionId = $('#listingQuestionId').val();

    if (externalFrmValidation() == true) {
        var dataString = 'username=' + username + '&password=' + password + '&vote=' + vote + '&reason=' + reason + '&questionId=' + questionId + '&listingId=' +<?php echo $model->user_default_listing_id;?>;
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl.'/listing/Externallogin'; ?>",
            data: dataString,
            cache: false,
            success: function (value) {
                var data = $.parseJSON(value);

                if (data.voteMessage == 'VoteSuccess' || data.LoginMessage == 'LoginSuccess') {
                    window.location.reload();
                    /*  $('.vote-sign-in-box').fadeOut();
                     $('#screen').removeAttr('style');*/
                }
                else if (data.voteMessage == 'VoteFail' || data.LoginMessage == 'LoginSuccess') {
                    alert('Your vote is not taken. Please try again!');
                    window.location.reload();
                }
                else if (data.message == 'LoginFail') {
                    alert('Username or password is not correct. Try again! If you are not a member register to vote.');
                    $('.vote-sign-in-box').fadeIn();
                    $('#screen').css({opacity: 0.6, 'width': '100%', 'height': '110%'});
                    $('body').css({'overflow': 'overflow'});
                }
            }
        });
    }

});

$("#register_your_vote").click(function () {

    var name = $('#name').val();
    var surname = $('#surname').val();
    var email = $('#email').val();
    var confirmEmail = $('#confirm_email').val();
    var drg_verifycode = $('#User_drg_verifycode').val();
    $("#registerVoteNameError").html('');
    $("#registerVoteSurnameError").html('');
    $("#registerVoteEmailError").html('');
    $("#registerVoteConfirmEmailError").html('');
    $("#registerVoteSecuriteCodeError").html('');

    if (name == "") {
        $("#registerVoteNameError").html('Name is required').css({'margin-top': '2px', 'color': 'red'});
    }

    if (surname == "") {
        $("#registerVoteSurnameError").html('Surname is required').css({'margin-top': '2px', 'color': 'red'});
    }

    if (email == "") {
        $("#registerVoteEmailError").html('Email is required').css({'margin-top': '2px', 'color': 'red'});
    }

    if (email != '' && !isValidateEmail(email)) {

        $("#registerVoteEmailError").html('Invalid email').css({'margin-top': '2px', 'color': 'red'});
    }

    if (confirmEmail == "") {
        $("#registerVoteConfirmEmailError").html('Confirm email is required').css({
            'margin-top': '2px',
            'color': 'red'
        });
    }

    if (email != confirmEmail) {
        if (email.length != 0) {
            $("#registerVoteConfirmEmailError").html('Mail does not match').css({'margin-top': '2px', 'color': 'red'});
        }
    }

    if (drg_verifycode == "") {
        $("#registerVoteSecuriteCodeError").html('Please enter the code').css({
            'margin-top': '-5px',
            'color': 'red',
            'text-align': 'center'
        });
    } else {
        if (!process_captcha()) {
            $("#registerVoteSecuriteCodeError").html('Invalid code').css({
                'margin-top': '-5px',
                'color': 'red',
                'text-align': 'center'
            });
        }
    }

    var dataString = 'name=' + name + '&surname=' + surname + '&email=' + email + '&listid=' +<?php echo $model->user_default_listing_id; ?>;

    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->request->baseUrl.'/listing/registerforvote'; ?>",
        data: dataString,
        cache: false,
        success: function (value) {
            console.log(value);
            var data = JSON.parse(value);
            if (data.message == 'RegisterSuccess') {
                $('.vote-sign-in-box').fadeOut();
                $('#RegisterVoteUsername').val(data.username);
                $('#RegisterVoteUsername1').text(data.username);
                $('#RegisterVoteEmail').val(data.email);
                $('#screen').css({opacity: 0.6, 'width': '100%', 'height': '100%'});
                $('body').css({'overflow': 'overflow'});
                $('.vote_registration_link_notice').fadeIn();
            }
        }
    });
});

<?php
if(isset($_GET['sample']) && $_GET['sample']=="true")
{
?>
jQuery(function()
{

    jQuery('#tabhide1').removeClass("active");
    jQuery('#tabshow3').addClass("active");
    jQuery('#taba').hide();
    jQuery('#tab3').show();

    setTimeout(function () { jQuery('#tabs3').click(); }, 100);
});
<?php
}
?>

</script>
