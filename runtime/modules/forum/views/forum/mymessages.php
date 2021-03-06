<?php
/* @var $this MymessagesController */

$this->breadcrumbs=array(
    'Mymessages',
);


// Default values
if( $commentViewLimit === NULL ){

    $commentViewOffset = ForumClass::$commentViewOffset;
    $commentViewLimit = ForumClass::$commentViewLimit;
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
$sql .= " LIMIT ".$commentViewOffset.",".$commentViewLimit; //this query contains all the data

    $userMessages  = UserMessages::model()->findAllBySql($sql);
}
else if(Yii::app()->user->_user_Type == 'user'){
	
$ulistings = Userlisting::model()->findAllByAttributes(array('user_default_profiles_id'=>Yii::app()->user->getState('uid')));
	$ulisting_id = array();
foreach($ulistings as $index=>$listing)
{
    $ulisting_id[] = $listing->user_default_listing_id;
}
$ulistIds = implode(',',$ulisting_id);

	if($ulistIds!="")
	{
    $sql = "SELECT * FROM user_default_interactions WHERE user_default_listing_id IN($ulistIds) AND user_default_first_interations = '1' ORDER BY user_default_interaction_id DESC "; // to set ordr by
    $sql .= " LIMIT ".$commentViewOffset.",".$commentViewLimit; //this query contains all the data

    $userMessages  = Comments::model()->findAllBySql($sql);
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

        $usersStats = Comments::getUserStats( $commentDetails->user_default_listing_id );
        $listingData = Userlisting::model()->findByAttributes(array('user_default_listing_id'=>$commentDetails->user_default_listing_id));
        $userInfo = User::model()->findByAttributes(array('user_default_id'=>$commentDetails->user_default_profile_id));

        ?>

        <div class="dd_coment_box <?=$commentBoxClassColor;?>">
        <ul class="dd_coment_heading" style="overflow: visible;">
            <a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$commentDetails->user_default_profile_id]['username'];?><span class="classic">Username</span></a>
            <a class="tooltip reputation" href="#" style="margin-right: 5px;">*<?=$usersStats[$commentDetails->user_default_profile_id]['user_default_reputation'];?><span class="classic">User reputation</span></a>
            <a class="tooltip" href="#" style="float:right;margin: 0"><?php $o = ForumClass::formatDate($commentDetails->user_default_date_create); echo $o['date'];?>&nbsp;<?=$o['time'];?>&nbsp;GMT<span class="classic">Date of comment</span></a>
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
        <?php /* ?><span style="color: #7d7e7d;">subject</span> <span style="color: #E254E8"><?php echo $commentDetails->subject;?></span><?php */ ?>
        <br/>
        <span class="comment moremsg">
            <?=$commentDetails->user_default_interaction_message;?></span>

        <div class="dd_coment" commentId="<?=$commentDetails->user_default_interaction_id;?>">
        <?php if(Yii::app()->user->_user_Type == 'user'){?>
            <a class="closeMsg" commentId="<?=$commentDetails->user_default_interaction_id;?>"  style="display:none;cursor: pointer;font-size:0.8em;margin-left: 400px;">Close</a>
        <?php } ?>
        <?php
		
        $post_comment = Comments::model()->getPostmessages($commentDetails->user_default_interaction_id);

        // There's a post comment
        if( count($post_comment) > 0 ){ ?>

            <a class="tooltip openCloseMessages" status="closed" style="margin-left: 1px;cursor: pointer; font-size:0.8em;">My Message <span class="classic openCloseCommentsTooltip">Open Thread</span></a><img class="arrowClass" src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/down-bluearrow.gif"/> <img style="display: none;" class="uparrowClass" src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/up-bluearrow.gif"/>

        <?php }

        if( isset($commentDetails->user_default_attachment) && !empty($commentDetails->user_default_attachment)){

            // Display original file name
            $attachement = explode(".", $commentDetails->user_default_attachment);
            $fileNameLength = (int) ( (strlen($attachement[0])) + 1);
            $originaleFileName = substr($commentDetails->user_default_attachment, $fileNameLength);

            $classNotAllowed = "notAllowed";
            $dowloadAttachementLink = "";

            if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                $classNotAllowed = "";
                $dowloadAttachementLink = "href='../mymessage/mymessages/downloadAttachement?messageId={$commentDetails->user_default_interaction_id}'";

            }

            ?>

            <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="float:right;margin-right: 18px;"><span class="classic"><?=$originaleFileName;?></span></a>

        <?php } ?>



        <div class="clear"></div>


        <a class="floatRight replpToPostMsgComment" commentId="<?=$commentDetails->user_default_interaction_id;?>" style="cursor: pointer; font-size:0.8em;margin-top: -16px;">Reply to post <span style="margin-top: 5px;"> <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/icons/down-yellowarrow.gif"/></span></a>
        <?php /*<div class="msg_like_buuton_box" commentId="<?=$commentDetails->user_default_interaction_id;?>">
            <a><span class="msg_like_button" likeAction="like">Like</span></a>
            <a><span class="msg_dislike_button" likeAction="dislike">Dislike</span></a>
        </div>*/ ?>
        <div class="clear"></div>
        <ul class="dd_social_list" style="top:15px !important;">
            <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
            <li><a href="http://www.twitter.com" class="tooltip twitter"><span class="classic">Send to my twitter account</span> </a></li>
            <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to my google plus account</span> </a></li>
            <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to my linked In account</span></a> </li>
        </ul>
        <div class='postBlock'>

            <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$commentDetails->user_default_interaction_id;?>" commentReference="<?=$commentDetails->user_default_interaction_id;?>" listingid="<?=$commentDetails->user_default_interaction_id;?>" >
                <br/><br/><?php /* ?>
                    <span style="float: left;">
                       <?php         $this->widget('ext.DzRaty.DzRaty', array(
                           'name' => 'my_rating_field_'.$commentDetails->user_default_interaction_id,
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
                                data: {'rate':score, 'user_default_profiles_id': ".Yii::app()->user->getId().", 'msg_id': ".$commentDetails->user_default_interaction_id.",'user_default_listing_id': ".$commentDetails->user_default_listing_id."},
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
                    <input type="file" class='attachement-file' id="attachement<?=$commentDetails->user_default_interaction_id;?>" name="attachement<?=$commentDetails->user_default_interaction_id;?>" uploadsuccess="0" uploadfile="null" multiple />
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

            $userDetail = User::model()->findByAttributes(array('user_default_id'=>$postsComments['user_default_profile_id']));

            $postCommentBoxClassColor = ($k%2 == 0) ? "": "even";

            ?>
            <div class="dd_coment_box <?=$postCommentBoxClassColor;?> hiddenPostComments" style="width:98%;">


                <div class="user_image">
                    <?php
                    if($userDetail['user_default_profile_image']) {
                        $img = $userDetail['user_default_profile_image'];
                        $user_dirname = strtolower($userDetail['user_default_username']) . '_' . $userDetail['user_default_id'];
                        if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                            ?>
                            <img
                                src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                                alt="<?php echo $userDetail['user_default_first_name'] . ' ' . $userDetail['user_default_surname']; ?>"
                                width="60px"/>
                        <?php
                        }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/'. $img)){ ?>
                            <img
                                src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                alt="<?php echo $userDetail['user_default_first_name'] . ' ' . $userDetail['user_default_surname']; ?>"
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

                <div class="dd_coment" commentId="<?=$postsComments['user_default_interaction_id'];?>">
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
                            $dowloadAttachementLink = "href='../mymessage/mymessages/downloadAttachement?messageId={$postsComments['user_default_interaction_id']}'";

                        }

                        ?>

                        <a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="margin-left: 97px;
top: 36px;"><span class="classic"><?=$originaleFileName;?></span></a>

                    <?php }  ?>
                    <ul class="dd_coment_heading">
                       <a class="tooltip" href="#" style="float:right;"><?php $u = UserMessages::formatDate($postsComments['user_default_date_create']); echo $u['date'];?><span class="classic">Date of comment</span>
                            <?=$u['time'];?>&nbsp;GMT<span class="classic">Time of comment</span></a>
                    </ul>
                    <div class="clear"></div>
                    <span class="comment moremsg" style="margin-left: 120px;color:#808080">
                         <?php
                         $regards = 'Hi ';
                         if($usersStats[$commentDetails->user_default_profile_id]['username']){
                             $regards .=$usersStats[$commentDetails->user_default_profile_id]['username'];
                         }
                         echo $regards.' ,';
                         echo '</br>';
                         echo '</br>';
                         ?>
                        <?=$postsComments['message'];?></span>
                    <?php /*<div class="msg_like_buuton_box" commentId="<?=$postsComments['user_default_interaction_id'];?>">
                        <a><span class="like_button" likeAction="like">Like</span></a>
                        <a><span class="dislike_button" likeAction="dislike">Dislike</span></a>
                    </div> */ ?>
                    <div class="clear"></div>
                    <a class="floatLeft replpToPostMsgComment" commentId="<?=$postsComments['user_default_interaction_id'];?>" style="cursor: pointer;font-size:0.8em;">Reply to post</a>

                    <div class="commentLink" style="margin-right: -70px;"><span> In reply to </span> <a href="#;"><?=$usersStats[$commentDetails->user_default_profile_id]['username'];?></a></div>
                    <ul class="dd_social_list">
                        <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
                        <li><a href="http://www.twtter.com" class="tooltip twitter"><span class="classic">Send to twitter account</span> </a></li>
                        <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to google plus account</span> </a></li>
                        <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to linkedIn account</span> </a></li>
                    </ul>
                    <div class='postBlock'>
                        <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$postsComments['user_default_interaction_id'];?>" commentReference="<?=$postsComments['user_default_interaction_id'];?>" listingid="<?=$postsComments['user_default_listing_id'];?>" subject="<?=$postsComments['subject'];?>">
                            <br />
                            <textarea id="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                            <div class="submitBtn"><a class="dd_post_msg_button" title="Submit comment" >Post</a></div>
                            <br/><br/><br/>
                            <div class='attachement-div'>
                                <input type="file" class='attachement-file' id="attachement<?=$postsComments['user_default_interaction_id'];?>" name="attachement<?=$postsComments['user_default_interaction_id'];?>" uploadsuccess="0" uploadfile="null" multiple />
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
            <select data-placeholder=" " class="chzn-select" style="width: 60px; display: none;" tabindex="-1">
                <option value="6"<?php if( $commentViewLimit == 6 ) echo "selected";?>>6</option>
                <option value="12"<?php if( $commentViewLimit == 12 ) echo "selected";?>>12</option>
                <option value="25"<?php if( $commentViewLimit == 25 ) echo "selected";?>>25</option>
                <option value="50"<?php if( $commentViewLimit == 50 ) echo "selected";?>>50</option>
                <option value="100"<?php if( $commentViewLimit == 100 ) echo "selected";?>>100</option>
            </select>
            <script type="text/javascript"> $(".chzn-select").chosen();</script>
        </div>


        <!-- Bottom navigation menu -->
        <div class="page_numbers messagePageNumbers">
            <?php

           // echo ForumClass::renderPagination($commentViewLimit, $pageSelected, $listingId);

            ?>

            <input type='hidden' id='commentViewLimit' value='<?=$commentViewLimit;?>' />

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

</script>

