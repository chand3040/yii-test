<?php
/* @var $this MymessagesController */

$this->breadcrumbs=array(
    'Mymessages',
);


// Default values
if( $messageViewLimit === NULL ){

    $messageViewOffset = MessageClass::$messageViewOffset;
    $messageViewLimit = MessageClass::$messageViewLimit;
}

if(isset($_REQUEST['rows']))
{
    $messageViewLimit = $_REQUEST['rows'];
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;


if(Yii::app()->user->_user_Type == 'business'){
    $blistings = Businesslisting::model()->findAllByAttributes(array('drg_uid'=>Yii::app()->user->getState('uid')));

    $user_default_listing_id = array();
    foreach($blistings as $index=>$listing)
    {
        $user_default_listing_id[] = $listing->drg_blid;
    }
    $blistIds = implode(',',$user_default_listing_id);

    // generate sql query for geting purchased details
    $sql = "SELECT us.* FROM drg_user_messages us WHERE us.user_default_listing_id IN($blistIds) AND  first_message = '1' ";
    $sql .= " ORDER BY us.id DESC "; // to set ordr by
    $sql .= " LIMIT ".$messageViewOffset.",".$messageViewLimit; //this query contains all the data

    $userMessages  = UserMessages::model()->findAllBySql($sql);
}

if(Yii::app()->user->_user_Type == 'user'){

    $ulistings = Userlisting::model()->findAllByAttributes(array('user_default_profiles_id'=>Yii::app()->user->getState('uid')));
    $ulisting_id = array();
    foreach($ulistings as $index=>$listing)
    {
        $ulisting_id[] = $listing->user_default_listing_id;
    }
    $ulistIds = implode(',',$ulisting_id);

    if($ulistIds!="")
    {
        $sql = "SELECT * FROM user_default_profiles_messages  WHERE user_default_listing_id IN($ulistIds) AND first_message = '1' ORDER BY id DESC "; // to set ordr by
        $sql .= " LIMIT ".$messageViewOffset.",".$messageViewLimit; //this query contains all the data

        $userMessages  = UserMessages::model()->findAllBySql($sql);

        $sql1 = "update user_default_profiles_messages set `notice_flag` = :notice_flag WHERE user_default_listing_id IN($ulistIds)";
        $parameters = array(":notice_flag" =>'1');
        Yii::app()->db->createCommand($sql1)->execute($parameters);
    }
    else
    {
        $userMessages ="0";
    }

}

$totalComments = count($userMessages);
$comments = $userMessages;
?>

<div class="clear"></div>
<div class="registration-box">
    <div id="registration-tabs"> <a href="javascript:void(0);">My Account</a>
        <div class="clear"></div>
    </div>
    <div class="registration-content" style="min-height:580px">
        <div class="my-account-links">
            <?php
            $this->renderPartial("//layouts/my-account-links");
            ?>
        </div>
        <div class="">
            <h1 align="center">My Messages</h1>
            <p align="center">This is a list of all your private messages regarding your listings</p>

            <div class="my-account-left" style="width: 625px;margin-left: 5px;">
                <div id="voice-your-opinion " class="message-box">

                    <?php if( $totalComments > 0 ){

                        $i = 1;

                        foreach ($comments as $commentId => $commentDetails) {

                            $commentBoxClassColor = ($i%2 == 0) ? "": "even";

                            $usersStats = UserMessages::getUserStats( $commentDetails->user_default_listing_id );
                            $listingData = Userlisting::model()->findByAttributes(array('user_default_listing_id'=>$commentDetails->user_default_listing_id));
                            $userInfo = User::model()->findByAttributes(array('user_default_id'=>$commentDetails->user_default_profiles_id));

                            ?>

                            <div class="dd_coment_box <?=$commentBoxClassColor;?>">
                                <ul class="dd_coment_heading" style="overflow: visible;">
                                    <a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$commentDetails->user_default_profiles_id]['username'];?><span class="classic">Username</span></a>
                                    <a class="tooltip reputation" href="#" style="margin-right: 5px;">*<?=$usersStats[$commentDetails->user_default_profiles_id]['user_reputation'];?><span class="classic">User reputation</span></a>
                                    <a class="tooltip" href="#" style="float:right;margin: 0"><?php $o = UserMessages::formatDate($commentDetails->created_date); echo $o['date'];?>&nbsp;<?=$o['time'];?>&nbsp;GMT<span class="classic">Date of comment</span></a>
                                </ul>
                                <div class="user_image">
                                    <?php
                                    if($userInfo['user_default_profile_image']) {
                                        $img = $userInfo['user_default_profile_image'];
                                        $user_dirname = strtolower($userInfo['user_default_username']) . '_' . $userInfo['user_default_id'];
                                        if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                                            ?>
                                            <img
                                                src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                                                alt="<?php echo $userInfo['user_default_first_name'] . ' ' . $userInfo['user_default_surname']; ?>"
                                                width="60px"/>
                                            <?php
                                        }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/'. $img)){ ?>
                                            <img
                                                src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                                alt="<?php echo $userInfo['user_default_first_name'] . ' ' . $userInfo['user_default_surname']; ?>"
                                                width="60px"/>

                                        <?php }else {
                                            $img = 'avatar.jpg';
                                            ?>
                                            <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                                 alt="Profile picture" width="60px"/>

                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <span style="color: #7d7e7d;"> listing title</span> <span class="tooltip reputation"> <a href="<?php echo Yii::app()->baseUrl.'/listing/view?id='.$listingData['user_default_listing_id'];?>" style="color: #00ACCE !important;"><?php echo isset($listingData) ? $listingData['user_default_listing_title'] : '';?>
                                        <span class="classic">Click on the title to go to that listing</span></span></a>  </span><br/>
                                <span style="color: #7d7e7d;">subject</span> <span style="color: #E254E8"><?php echo $commentDetails->subject;?></span>
                                <br/>
        <span class="comment moremsg">
            <?=$commentDetails->message;?></span>

                                <div class="dd_coment" commentId="<?=$commentDetails->id;?>">
                                    <div class="message-tools">
                                        <?php if(Yii::app()->user->_user_Type == 'user'){?>
                                            <a class="closeMsg" commentId="<?=$commentDetails->id;?>"  style="display:none;cursor: pointer;font-size:0.8em;margin-left: 400px;">Close</a>
                                        <?php } ?>
                                        <?php

                                        $post_comment = UserMessages::model()->getPostComments($commentDetails->id);

                                        // There's a post comment
                                        if( count($post_comment) > 0 ){ ?>

                                            <div class="open_reply_box">   <a class="tooltip openCloseMessages" status="closed" style="margin-left: 1px;cursor: pointer; font-size:0.8em;">My Message <span class="classic openCloseCommentsTooltip">Open Thread</span></a><img class="arrowClass" src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/down-bluearrow.gif"/> <img style="display: none;" class="uparrowClass" src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/up-bluearrow.gif"/>
                                            </div>

                                        <?php }

                                        if( isset($commentDetails->attachement) && !empty($commentDetails->attachement)){

                                            // Display original file name
                                            $attachement = explode(".", $commentDetails->attachement);
                                            $fileNameLength = (int) ( (strlen($attachement[0])) + 1);
                                            $originaleFileName = substr($commentDetails->attachement, $fileNameLength);

                                            $classNotAllowed = "notAllowed";
                                            $dowloadAttachementLink = "";

                                            if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                                                $classNotAllowed = "";
                                                $dowloadAttachementLink = "href='".Yii::app()->createUrl('mymessage/mymessages/downloadAttachement')."?messageId={$commentDetails->id}'";

                                            }

                                            ?>

                                            <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="float:right;margin-right: 18px;margin-top:4px"><span class="classic"><?=$originaleFileName;?></span></a>

                                        <?php } ?>



                                        <div class="clear"></div>


                                        <div class="reply_box">  <a class="floatRight replpToPostMsgComment" commentId="<?=$commentDetails->id;?>" style="cursor: pointer; font-size:0.8em;">Reply to post <span> <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/down-yellowarrow.gif"/></span></a>
                                        </div>
                                    </div>

                                    <div class="clear"></div><input type="hidden" id="baseurl" value="<?php echo Yii::app()->getBaseUrl(true);?>">
                                    <ul class="dd_social_list" style="top:15px !important;">
                                        <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
                                        <li><a href="http://www.twitter.com" class="tooltip twitter"><span class="classic">Send to my twitter account</span> </a></li>
                                        <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to my google plus account</span> </a></li>
                                        <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to my linked In account</span></a> </li>
                                    </ul>
                                    <div class='postBlock'>

                                        <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$commentDetails->id;?>" commentReference="<?=$commentDetails->id;?>" listingid="<?=$commentDetails->id;?>" subject="<?=$commentDetails->subject;?>">
                                            <br/><br/><?php /* ?>
                    <span style="float: left;">
                       <?php         $this->widget('ext.DzRaty.DzRaty', array(
                           'name' => 'my_rating_field_'.$commentDetails->id,
                           'value' => 0,
                           'options' => array(
                               'path' => Yii::app()->theme->baseUrl. '/images/raty',
                               'cancel' => TRUE,
                               'cancelPlace' => 'right',
                               'half' => TRUE,
                               'width' => 200,
                               'starOff' => 'raty-star-off.png',
                               'starOn' => 'raty-star-on.png',
                               'starHalf' => 'raty-star-half.png',
                               'cancelOff' => 'raty-cancel-off.png',
                               'cancelOn' => 'raty-cancel-on.png',
                               'click' => "js:function(score, evt){
                                 $.ajax({
                                type: 'POST',
                                url: '".Yii::app()->createUrl('user/myaccount/rating')."',
                                data: {'rate':score, 'user_default_profiles_id': ".Yii::app()->user->getId().", 'msg_id': ".$commentDetails->id.",'user_default_listing_id': ".$commentDetails->user_default_listing_id."},
                                success: function(name,value,exdays) {
                                }
                            });

                                }",
                           ),
                       ));?>

                   </span><?php */ ?>
                                            <textarea style="margin-left: 100px;padding: 0 !important;width: 58%;" id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                                            <div class="submitBtn" style="top: 0px;"><a class="dd_post_msg_button" title="Submit comment" >Post</a></div>
                                            <br/><br/><br/>
                                            <div class='attachement-div'>
                                                <input type="file" class='attachement-file' id="attachement<?=$commentDetails->id;?>" name="attachement<?=$commentDetails->id;?>" uploadsuccess="0" uploadfile="null" multiple />
                                   <span class="user-attach-icon attachement-icon" content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded" style="width: 25%; margin-top: -43px;padding-left: 18px;float:right">
                                    <span class="attachement-text" style="padding-left: 17px !important;"> </span>
                                   </span>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="clear"></div>

                                    <?php

                                    $k = 1;
                                    // echo '<pre>';
                                    //  print_r($post_comment);
                                    // exit;
                                    foreach ($post_comment as $postsComments) {

                                        $userDetail = User::model()->findByAttributes(array('user_default_id'=>$postsComments['user_default_profiles_id']));

                                        $postCommentBoxClassColor = ($k%2 == 0) ? "": "even";

                                        ?>
                                        <div class="dd_coment_box <?=$postCommentBoxClassColor;?> hiddenPostComments" style="width:98%;">




                                            <div class="dd_coment" commentId="<?=$postsComments['id'];?>">
                                                <?php

                                                if( isset($postsComments['attachement']) && !empty($postsComments['attachement']) ){

                                                    // Display original file name
                                                    $attachement = explode(".", $postsComments['attachement']);
                                                    $fileNameLength = (int) ( (strlen($attachement[0])) + 1);

                                                    $originaleFileName = substr($postsComments['attachement'], $fileNameLength);

                                                    $classNotAllowed = "notAllowed";
                                                    $dowloadAttachementLink = "";

                                                    if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                                                        $classNotAllowed = "";
                                                        $dowloadAttachementLink = "href='".Yii::app()->createUrl('mymessage/mymessages/downloadAttachement')."?messageId={$postsComments['id']}'";

                                                    }

                                                    ?>

                                                    <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" target="_blank" <?=$dowloadAttachementLink;?> style="top: 45px;float: right;"><span class="classic"><?=$originaleFileName;?></span></a>

                                                <?php }  ?>
                                                <ul class="dd_coment_heading">
                                                    <a class="tooltip" href="#" style="float:right;"><?php $u = UserMessages::formatDate($postsComments['created_date']); echo $u['date'];?><span class="classic">Date of comment</span>
                                                        <?=$u['time'];?>&nbsp;GMT<span class="classic">Time of comment</span></a>
                                                </ul>
                                                <div class="clear"></div>
                    <span class="comment moremsg" style="color:#808080">
                         <?php
                         $regards = 'Hi ';
                         if($usersStats[$commentDetails->user_default_profiles_id]['username']){
                             $regards .=$usersStats[$commentDetails->user_default_profiles_id]['username'];
                         }
                         echo $regards.' ,';
                         echo '</br>';
                         echo '</br>';
                         ?>
                         <?=$postsComments['message'];?></span>
                                                <?php /*<div class="msg_like_buuton_box" commentId="<?=$postsComments['id'];?>">
                        <a><span class="like_button" likeAction="like">Like</span></a>
                        <a><span class="dislike_button" likeAction="dislike">Dislike</span></a>
                    </div> */ ?>
                                                <div class="clear"></div>
                                                <a class="floatRight  replpToPostMsgComment" commentId="<?=$postsComments['id'];?>" style="cursor: pointer;font-size:0.8em;">Reply to post</a>

                                                <div class="commentLink"><span> In reply to </span> <a href="#;"><?=$usersStats[$commentDetails->user_default_profiles_id]['username'];?></a></div>
                                                <ul class="dd_social_list">
                                                    <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
                                                    <li><a href="http://www.twtter.com" class="tooltip twitter"><span class="classic">Send to twitter account</span> </a></li>
                                                    <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to google plus account</span> </a></li>
                                                    <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to linkedIn account</span> </a></li>
                                                </ul>
                                                <div class='postBlock'>
                                                    <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$postsComments['id'];?>" commentReference="<?=$postsComments['id'];?>" listingid="<?=$postsComments['user_default_listing_id'];?>" subject="<?=$postsComments['subject'];?>">
                                                        <br />
                                                        <textarea id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                                                        <div class="submitBtn"><a class="dd_post_msg_button" title="Submit comment" >Post</a></div>
                                                        <br/><br/><br/>
                                                        <div class='attachement-div'>
                                                            <input type="file" class='attachement-file' id="attachement<?=$postsComments['id'];?>" name="attachement<?=$postsComments['id'];?>" uploadsuccess="0" uploadfile="null" multiple />
                                                <span class="user-attach-icon attachement-icon" style="width: 25%;margin-top: -47px;margin-right: -16px;float: right;">
                                                    <span class="attachement-text" style="padding-left: 17px !important;"> </span>
                                                </span>

                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <?php

                                        $k++;

                                    } ?>


                                </div>
                            </div>

                            <?php

                            $i++;

                        }
                        ?>
                        <!-- Comment box grey -->

                        <div class="clear"></div>
                        <div class="user-pagination">
                            <!-- Number of records to view drop down menu -->

                            <div class="user-msgpage-nav">
                                <span title="Select number of records to view from the dropdown menu">View</span>
                                <select data-placeholder=""  onchange="window.location = '?rows='+$(this).val();" class="chzn-select" style="width: 60px; display: none;" tabindex="-1">
                                    <option value="6"<?php if( $messageViewLimit == 6 ) echo "selected";?>>6</option>
                                    <option value="12"<?php if( $messageViewLimit == 12 ) echo "selected";?>>12</option>
                                    <option value="25"<?php if( $messageViewLimit == 25 ) echo "selected";?>>25</option>
                                    <option value="50"<?php if( $messageViewLimit == 50 ) echo "selected";?>>50</option>
                                    <option value="100"<?php if( $messageViewLimit == 100 ) echo "selected";?>>100</option>
                                </select>
                                <script type="text/javascript"> $(".chzn-select").chosen();</script>
                            </div>


                            <!-- Bottom navigation menu -->
                            <div class="page_numbers messagePageNumbers">
                                <?php

                                // echo MessageClass::renderPagination($messageViewLimit, $pageSelected, $listingId);

                                ?>

                                <input type='hidden' id='messageViewLimit' value='<?=$messageViewLimit;?>' />

                                <!-- <a href="#">< Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#" class="active">3</a> <a href="#">4</a> <a href="#">5</a> <a href="#">Next ></a> --></div>
                        </div>

                        <div class="clear"></div><?php } ?>
                </div>

            </div>
            <!-- Message List Starts -->

            <div class="clear"></div>
        </div> <!-- my_account End -->

    </div>
</div>

<script type="text/javascript">

    // Chosen dropbox styling code
    $(".chzn-select").chosen();
    $(".chzn-select-deselect").chosen({allow_single_deselect:true});


    /**
     *
     *
     * @name Engine : Engine js file
     * @license Business Market
     * @author RH
     * @package Forrum
     *
     *
     */


    jQuery(document).ready(function ($){


        // Event for post a comment button
        $('body').on('click', '.dd_post_msg_button', function(event){

            if( $(this).parents('form').find("#message").attr('placeholder') != ""  ){

                mymessages.blockWriteInForum("You must be logged in to leave a comment.");

                return false;

            }

            var message = $(this).parents('form').find("#message").val();
            var listingId = $(this).parents('form').attr('listingid');
            var commentReference = $(this).parents('form').attr('commentreference');
            var subject = $(this).parents('form').attr('subject');
            var attachement = $(this).parents('.postBlock').find('.attachement-file');

            mymessages.addComment(message, listingId, commentReference,subject, event, attachement);

            $(this).parents('form').find("#message").val("");


        });


        // Event for reply a comment button
        $('body').on('click', '.replpToPostMsgComment', function(){
            if( $(this).hasClass("grayedOut") ){
                return false;
            }
            $('.raty-icons').hide();
            var commentId = $(this).attr('commentId');
            var form = $(this).parents('.dd_coment_box').find(".replyToPostCommentForm-"+commentId);

            if( !form.is(":visible") ){
                form.show();
            }else{
                form.hide();
            }

        });

        $('body').on('click', '.closeMsg', function(){
            if( $(this).hasClass("grayedOut") ){
                return false;
            }
            var commentId = $(this).attr('commentId');
            var form = $(this).parents('.dd_coment_box').find(".replyToPostCommentForm-"+commentId);

            if( !form.is(":visible") ){
                form.show();
            }else{
                form.hide();
            }

            if( !$('.raty-icons').is(":visible") ){
                $('.raty-icons').show();
            }else{
                $('.raty-icons').hide();
            }

        });

        // Event for like or dislike button
        $('body').on('click', '.msg_like_button, .msg_dislike_button', function(){

            if( $(this).hasClass("grayedOut") ){
                return false;
            }

            var messageId = $(this).parents('.msg_like_buuton_box').attr('commentId');
            var likeAction = $(this).attr('likeAction');

            mymessages.likeMessage(messageId, likeAction);

        });

        // Event for update the number of comment to display
        $('body').on('click', '.user-msgpage-nav .active-result', function(){

            var viewLimitValue = parseInt($(this).html());

            mymessages.UpdateViewLimit( viewLimitValue);

        });

        // Event for navigation (pagination)
        $('body').on('click', '.messagePageNumbers a', function(){

            var viewLimitValue = $("#messageViewLimit").val();
            var pageSelected = $(this).attr('page');
            var viewOffsetValue = $(this).attr('offset');

            mymessages.Navigate(viewLimitValue, pageSelected, viewOffsetValue);

        });

        // Event for report a comment as a spam button
        $('body').on('click', '.reportAsSpam', function(){

            var listingId = $(this).parents('#voice-your-opinion').attr('listingid');
            var commentId = $(this).attr('commentId');

            mymessages.reportAsSpam($(this), listingId, commentId);

        });

        // Event to prevent user action access
        $('body').on('click', '.notAllowed', function(){

            mymessages.blockWriteInForum();

            $("#light").find(".text-message").html("You must be logged in to show the attachement.");


        });

        // Event for attachement icon
        $('body').on('click', '.attachement-icon', function(){

            $(this).parents('.attachement-div').find('.attachement-file').click();

        });

        // Event for attachement input
        $('body').on('change', '.attachement-file', function(){

            $(this).parents('.attachement-div').find('.attachement-icon').html(
                "<span class='defaultCursor'>"+$(this).val()+"</span><a style='padding-left:20px;' onclick=\"$(this).parents('.attachement-div').find('.attachement-icon').html('Add attachement'); $(this).val('');\" class='deleteAttachement'>Delete</a>"
            );

        });


        // Event for set comment list by criteria
        $('body').on('click', '.msgviewByCriteria', function(){

            var listingId = $(this).parents('#voice-your-opinion').attr('listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy = $(this).attr('orderby');

            mymessages.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);

        });

        // Event for open / close comment button
        $('body').on('click', '.openCloseMessages', function(){

            if( $(this).attr('status') == 'closed' ){

                $(this).parents('.dd_coment_box').find('.hiddenPostComments').each(function(){

                    $(this).removeClass('hiddenPostComments');
                    $(this).addClass('visiblePostComments');

                });

                $('.arrowClass').hide();
                $(".uparrowClass").css("display", "inline");

                $(this).attr('status', 'opened');
                $(this).html('My Message<span class="classic openCloseCommentsTooltip">Close Thread</span>');



            }else{

                $(this).parents('.dd_coment_box').find('.visiblePostComments').each(function(){

                    $(this).removeClass('visiblePostComments');
                    $(this).addClass('hiddenPostComments');

                });
                $('.arrowClass').show();
                $(".uparrowClass").css("display", "none");
                $(this).attr('status', 'closed');
                $(this).html('My Message<span class="classic openCloseCommentsTooltip">Open Thread</span>');

            }


        });


        var showChar = mymessages.showChar;
        var ellipsestext = mymessages.ellipsesText;
        var moretext = mymessages.moreText;
        var lesstext = mymessages.lessText;


        // Event for show more comment text button
        $('.moremsg').each(function() {

            var content = $(this).html();

            if( content.length > showChar ) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="#;" class="moremsglink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        // Event for show more comment text button
        $('body').on('click', '.moremsglink', function(){

            if($(this).hasClass("less")) {

                $(this).removeClass("less");
                $(this).html(moretext);

            }else {

                $(this).addClass("less");
                $(this).html(lesstext);
            }

            $(this).parent().prev().toggle();
            $(this).prev().toggle();

            return false;

        });


        // Event for delete a comment button
        $('body').on('click', '.deleteComment', function(){

            var listingId = $(this).parents('#voice-your-opinion').attr('listingid');
            var commentId = $(this).attr('commentId');

            mymessages.deleteComment(listingId, commentId);

        });


    });


    /**
     *
     *
     * @name Common : Common functions
     * @license Business Market
     * @author Riadh H.
     * @package Forum
     *
     *
     */


// Common object to store configuration forum params
    var mymessages = mymessages || {};


    mymessages.showChar = 300; // How many characters are shown by default
    mymessages.ellipsesText = "...";
    mymessages.moreText = "read more >>";
    mymessages.lessText = "<< read less";

    /*
     *
     * Common functions
     *
     */

    // Add a new comment
    // params : message
    // params : listingId
    // params : commentReference
    // params : event
    // params : attachement

    mymessages.addComment = function(message, listingId, commentReference ,subject , event, attachement){

        //alert(message);
        if( message == "" ){

            mymessages.blockWriteInForum("You should write a comment before to contiune.");

            return false;

        }

        // Add an attachement
        if( (attachement.val() != "") ){

            mymessages.uploadAttachement(event, attachement);

            // Upload attachement success
            if( (attachement.attr("uploadsuccess") == "0") || (attachement.attr("uploadfile") == "null")  ){

                return false;

            }


        }


        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('mymessage/mymessages/addmessage'); ?>",
            type: "POST",
            dataType: 'json',
            async: true,
            data: {
                message : message,
                listingId: listingId,
                commentReference : commentReference,
                subject:subject,
                attachementUploadFile : attachement.attr("uploadfile")

            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    mymessages.blockWriteInForum("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            success: function(resp){
                var viewLimitValue = $("#messageViewLimit").val();
                var pageSelected = $('.messagePageNumbers').find('.active').eq(0).attr('page');
                var viewOffsetValue = $('.messagePageNumbers').find('.active').eq(0).attr('offset');

                mymessages.Navigate(viewLimitValue, pageSelected, viewOffsetValue);

            },
            complete: function(){

                // Rest attachement values to avoid conflict for multiple post a comment with attachement
                attachement.attr("uploadsuccess", "0");
                attachement.attr("uploadfile", "null");
            }

        });

    }

    // Ban user action by show a bloc contain
    // params : listingId
    // params : viewLimitValue number of comment to display
    mymessages.UpdateViewLimit = function( viewLimitValue){

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('mymessage/mymessages/UpdateViewLimit'); ?>",
            type: "POST",
            dataType: 'json',
            data: {
                viewLimitValue: viewLimitValue,
            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){

                $(".messagePage").html("");
                $(".messagePage").html(resp.listingView);

            },
            complete: function(){

                mymessages.showMoreComment();

            }
        });

    }




    // like or dislike a new message
    // params : messageId
    // params : likeAction
    mymessages.likeMessage = function(messageId, likeAction){

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('mymessage/mymessages/likeMessage'); ?>",
            type: "POST",
            dataType: 'json',
            async: true,
            data: {
                messageId : messageId,
                likeAction: likeAction

            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    mymessages.blockWriteInForum("You must be logged in to leave a message.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            success: function(resp){

                var listingId = $('#voice-your-opinion').attr('listingid');
                var viewLimitValue = $("#commentViewLimit").val();
                var pageSelected = $('.forumPageNumbers').find('.active').eq(0).attr('page');
                var viewOffsetValue = $('.forumPageNumbers').find('.active').eq(0).attr('offset');

                mymessages.Navigate( viewLimitValue, pageSelected, viewOffsetValue);

            },
            complete: function(){


            }
        });

    }
    // Navigate the comment list, useful to render the pagination
    // params : listingId
    // params : viewLimitValue number of comment to display
    // params : pageSelected
    // params : viewOffsetValue offset to start get data from database
    // params : commentOrderBy criteria to sort the comment list

    mymessages.Navigate = function(viewLimitValue, pageSelected, viewOffsetValue){

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('mymessage/mymessages/Navigate'); ?>",
            type: "POST",
            dataType: 'json',
            data: {
                viewLimitValue: viewLimitValue,
                pageSelected : pageSelected,
                viewOffsetValue : viewOffsetValue

            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){
                $(".messagePage").html("");
                $(".messagePage").html(resp.listingView);

            },
            complete: function(){

                mymessages.showMoreComment();

            }
        });

    }



    // Ban user action by show a bloc contain
    // params : message to dispplay
    mymessages.blockWriteInForum = function(message){

        $('#light').show();
        $('#fade').show();

        $("#light").find(".text-message").html(message);

    }

    // Close notification
    // params : no params
    mymessages.closeNotification = function(){

        $('#light').hide();
        $('#fade').hide();

    }

    // Upload a new file attached to a message
    // params : event
    // params : attachement file to attach
    mymessages.uploadAttachement = function(event, attachement){

        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // Create a formdata object and add the files
        var formData = new FormData();

        var fileSelect = document.getElementById(attachement.attr('id'));

        // Loop through each of the selected files.
        for (var i = 0; i < fileSelect.files.length; i++) {

            var file = fileSelect.files[i];

            // Add the file to the request.
            formData.append('attachement', file, file.name);

        }

        $.ajax({

            url: "<?php echo Yii::app()->createUrl('mymessage/mymessages/uploadAttachement'); ?>",
            type: 'POST',
            data: formData,
            async: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request

            success: function(resp)
            {
                if( resp.action_status == '0')
                {
                    mymessages.blockWriteInForum(resp.message);

                }else
                {

                    attachement.attr("uploadsuccess", "1");
                    attachement.attr("uploadfile", resp.file_name);

                }
            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    mymessages.blockWriteInForum("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            complete: function()
            {

            }

        });

    }

    // Show more comment
    // params : no params
    mymessages.showMoreComment = function(){

        // Event for show more comment text button
        $('.moremsg').each(function() {

            var content = $(this).html();

            if( content.length > mymessages.showChar ) {

                var c = content.substr(0, mymessages.showChar);
                var h = content.substr(mymessages.showChar, content.length - mymessages.showChar);

                var html = c + '<span class="moreellipses">' + mymessages.ellipsesText+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="#;" class="moremsglink">' + mymessages.moreText + '</a></span>';

                $(this).html(html);
            }

        });

    }

</script>

