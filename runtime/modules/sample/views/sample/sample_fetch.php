<?php

$listingId = $address->user_default_sample_listing_id;

// Default values
if( $commentViewLimit === NULL ){

    $commentViewOffset = Samplefeedback::$commentViewOffset;
    $commentViewLimit = Samplefeedback::$commentViewLimit;
    $commentOrderBy = Samplefeedback::$commentOrderBy;
    $userProfession = Samplefeedback::$userProfession;
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;

$professionText = "&nbsp;"; $reputationText = "&nbsp;";

if( ($commentOrderBy == "user_default_reputation desc") || ($commentOrderBy == "user_default_reputation asc") ){

    $reputationText = "Reputation";
}

if( ($userProfession != "0") && ($pageSelected == 1) ){

    $professionText = "User";
}

// $commentOrderBy = "user_default_reputation asc";

$comments = Samplefeedback::getFeedbacksByListing($listingId, $commentViewOffset, $commentViewLimit, $commentOrderBy, $userReputation, $userProfession);

$usersStats = Samplefeedback::getUserStats($listingId);

//echo Yii::app()->user->Id;
//echo $listing->user_default_profiles_id;
// Report as spam is only permitted for the listing's owner
$reportAsSpamAllow = ( Yii::app()->user->getState('uid') == $listing->user_default_profiles_id ) ? TRUE : FALSE;

$totalComments = sizeof($comments);

$pathBootstrap = Yii::app()->assetManager->publish( Yii::getPathOfAlias('ext.DzRaty.assets') );

$countrating = Samplefeedback::getTotalFeedbacks($address->user_default_sample_listing_id);
$countrating1 = Samplefeedback::getTotalFeedbacksbyrating($address->user_default_sample_listing_id , "1");
$countrating2 = Samplefeedback::getTotalFeedbacksbyrating($address->user_default_sample_listing_id , "2");
$countrating3 = Samplefeedback::getTotalFeedbacksbyrating($address->user_default_sample_listing_id , "3");
$countrating4 = Samplefeedback::getTotalFeedbacksbyrating($address->user_default_sample_listing_id , "4");
$countrating5 = Samplefeedback::getTotalFeedbacksbyrating($address->user_default_sample_listing_id , "5");
$tt="100";
$rating1 = $countrating1[0]['ratings'] / $countrating[0]['total_comments'] * $tt;
$rating2 = $countrating2[0]['ratings'] / $countrating[0]['total_comments'] * $tt;
$rating3 = $countrating3[0]['ratings'] / $countrating[0]['total_comments'] * $tt;
$rating4 = $countrating4[0]['ratings'] / $countrating[0]['total_comments'] * $tt;
$rating5 = $countrating5[0]['ratings'] / $countrating[0]['total_comments'] * $tt;

?>
<div class="starbardiv">
    <div class="col-5"> 5 star
        <br>
        <div class="starbar">
            <div class="bar" style="width:<?php echo $rating5; ?>%"></div></div>
        <?php echo is_null($countrating5[0]['ratings'])?0:$countrating5[0]['ratings']; ?>
    </div>
    <div class="col-5"> 4 star
        <br>
        <div class="starbar">
            <div class="bar" style="width:<?php echo $rating4; ?>%"></div></div>
        <?php echo is_null($countrating4[0]['ratings'])?0:$countrating4[0]['ratings']; ?>
    </div>
    <div class="col-5"> 3 star
        <br>
        <div class="starbar">
            <div class="bar" style="width:<?php echo $rating3; ?>%"></div>
        </div>
        <?php echo is_null($countrating3[0]['ratings'])?0:$countrating3[0]['ratings']; ?>
    </div>
    <div class="col-5"> 2 star
        <br>
        <div class="starbar">
            <div class="bar" style="width:<?php echo $rating2; ?>%"></div></div>
        <?php echo is_null($countrating2[0]['ratings'])?0:$countrating2[0]['ratings']; ?>
    </div>
    <div class="col-5"> 1 star
        <br>
        <div class="starbar">
            <div class="bar" style="width:<?php echo $rating1; ?>%"></div></div>
        <?php echo is_null($countrating1[0]['ratings'])?0:$countrating1[0]['ratings']; ?>
    </div>
</div>

<div class="clerboth"></div>



<ul class="comments_button_list" style="padding-top:0px !important;    margin-left: 120px;">
    <li style="margin-top: 14px;"><a href="javascript:void(0)" class="sviewByCriteria" data-orderby="user_default_sample_listing_feedback_date DESC">Newest</a></li>
    <li style="margin-top: 14px;"><a href="javascript:void(0)" class="sviewByCriteria" data-orderby="user_default_sample_listing_feedback_date ASC">Oldest</a></li>
    <li class="fuserReputation">
        <div class="fuserReputationText">&nbsp;</div>
        <div class="fuserReputationSelect">
            <select data-placeholder="Reputation" class="chzn-select" style="width: 120px; display: none;" tabindex="-1">
                <option value="">Reputation</option>
                <option value="user_default_reputation desc" <?php if( $commentOrderBy == "user_default_reputation desc" ) echo "selected";?>>Highest first</option>
                <option value="user_default_reputation asc" <?php if( $commentOrderBy == "user_default_reputation asc" ) echo "selected";?>>Lowest first</option>
            </select>
        </div>
        <script type="text/javascript"> $(".chzn-select").chosen();</script>
    </li>
    <li class="fuserProfession">
        <div class="fuserProfessionText"><?=$professionText;?></div>
        <div class="fuserProfessionSelect">
            <select data-placeholder="User" class="chzn-select" style="width: 150px; display: none;" tabindex="-1">

                <option value="0" <?php if( $userProfession == "0" ) echo "selected";?>>User status = all</option>
                <option value="1" <?php if( $userProfession == "1" ) echo "selected";?>>Business owner</option>
                <option value="2" <?php if( $userProfession == "2" ) echo "selected";?>>Consumer</option>
                <option value="3" <?php if( $userProfession == "3" ) echo "selected";?>>Entrepreneur</option>
                <option value="4" <?php if( $userProfession == "4" ) echo "selected";?>>Investor</option>
                <option value="5" <?php if( $userProfession == "5" ) echo "selected";?>>Other</option>
            </select>
        </div>
        <script type="text/javascript"> $(".chzn-select").chosen();</script>
    </li>
</ul>
<div class="clear"></div>
<?php

if( $totalComments > 0 ){

    $i = 1;

    foreach ($comments as $commentId => $commentDetails) {

        $commentBoxClassColor = ($i%2 == 0) ? "": "even";
        $grayedOutClass = ( $commentDetails['comment']->user_default_profiles_id == Yii::app()->user->Id ) ? "grayedOut" : "";

        $spamCommentStyle = "";

        if( (Yii::app()->session['adminKey'] == '1') ){

            $spamCommentStyle = "border:2px solid #ED1C24;";

        }

        ?>

        <div class="dd_coment_box <?=$commentBoxClassColor;?>" style="width:98%;<?=$spamCommentStyle?>">

            <div class="user_image">
                <?php

                if($usersStats[$commentDetails['comment']->user_default_profiles_id]['user_default_profile_image']) {
                    $img = $usersStats[$commentDetails['comment']->user_default_profiles_id]['user_default_profile_image'];
                    $user_dirname = strtolower($usersStats[$commentDetails['comment']->user_default_profiles_id]['username']) . '_' . $usersStats[$commentDetails['comment']->user_default_profiles_id]['user_id'];
                    if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                        ?>
                        <img
                            src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                            alt="<?php echo $usersStats[$commentDetails['comment']->user_default_profiles_id]['user_default_first_name'] . ' ' . $usersStats[$commentDetails['comment']->user_default_profiles_id]['user_default_surname']; ?>"
                            width="60"/>
                        <?php
                    }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/' . $img)){ ?>
                        <img
                            src="<?php echo Yii::app()->createUrl('/upload/logo/'. $img); ?>"
                            alt="<?php echo $usersStats[$commentDetails['comment']->user_default_profiles_id]['user_default_first_name'] . ' ' . $usersStats[$commentDetails['comment']->user_default_profiles_id]['user_default_surname']; ?>"
                            width="60"/>
                    <?php } else {
                        $img = 'avatar.jpg';
                        ?>
                        <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                             alt="Profile picture" width="60"/>

                        <?php
                    }
                }else{
                    $img = 'avatar.jpg';
                    ?>
                    <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                         alt="Profile picture" width="60"/>
                <?php }
                ?>
                <?php /*<img src="<?=Yii::app()->theme->getBaseUrl().'/images/icons/user.png';?>" width="60px"> */?></div>
            <div class="ratting_box" style="width: 95px;">
                <span class="rating_title" data-href="#">Rating</span>
                <span class="tooltip like_icon" data-href="#"><?=$commentDetails['comment']->user_default_feedback_likes_total;?><span class="classic">Total number of Likes</span></span>
                <span class="tooltip dislike_icon" data-href="#"><?=$commentDetails['comment']->user_default_feedback_dislikes_total;?><span class="classic">Total number of Dislikes</span></span><span style="    display: block;
    margin-top: 15px;">
							<?php
                            $ratingname = 'text'.$commentDetails['comment']->user_default_sample_listing_feedback_id;
                            /* $this->widget('ext.DzRaty.DzRaty', array(
        'name' => uniqid(),'id' => uniqid(),'value' => $commentDetails['comment']->user_default_sample_listing_feedback_rating,
        'options' => array(
            'readOnly' => TRUE,
        ),
        ));*/
                            $currentrating = $commentDetails['comment']->user_default_sample_listing_feedback_rating;
                            $pathBootstrap = Yii::app()->assetManager->publish( Yii::getPathOfAlias('ext.DzRaty.assets') );
                            //$pathdata = explode("www/assets/",$pathBootstrap);

                            for($i=1;$i<=$currentrating;$i++)
                            {
                                echo '<img src="' . Yii::app()->createUrl($pathBootstrap.'/img/star-on.png') . '" />';
                            }
                            ?></span>
            </div>
            <div class="dd_coment" data-commentid="<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" style="width: 545px;">

                <ul class="dd_coment_heading" style="overflow: visible;">
                    <li><a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$commentDetails['comment']->user_default_profiles_id]['username'];?><span class="classic">Username</span></a></li>
                    <li><a class="tooltip reputation" href="#" style="margin-right: 5px;" title="User reputation">*<?=abs($usersStats[$commentDetails['comment']->user_default_profiles_id]['user_default_reputation']);?><span class="classic">User reputation</span></a></li>
                    <li><a class="tooltip" href="#" style="margin-right: 5px;"><?php $o = Samplefeedback::formatDate($commentDetails['comment']->user_default_sample_listing_feedback_date); echo $o['date'];?><span class="classic">Date of comment</span></a></li>
                    <li><a class="tooltip" href="#" style="margin-right: 5px;"><?=$o['time'];?><span class="classic">Time of comment</span></a></li>

                    <?php

                    // There's a post comment
                    if( count($commentDetails['post_comment']) > 0 ){ ?>

                        <li><a class="tooltip sopenCloseComments" data-status="closed" style="margin-right: 5px;color:#e5a404;cursor:pointer">Open all threads<span class="classic sopenCloseCommentsTooltip">Open all threads</span></a></li>

                    <?php }

                    if( isset($commentDetails['comment']->user_default_attachment)) {

                        // Display original file name
                        $attachement = explode(".", $commentDetails['comment']->user_default_attachment);
                        $fileNameLength = (int)((strlen($attachement[0])) + 1);

                        $originaleFileName = substr($commentDetails['comment']->user_default_attachment, $fileNameLength);
                        $thumbFileName = ($commentDetails['comment']->user_default_thumb_attachment) ? '<span><img src="' . Yii::app()->createUrl('/upload/comments/thumb/' . $commentDetails['comment']->user_default_thumb_attachment) . '" width="90"  /></span>' : '<span class="classic">No thumbnail</span>';
                        $classNotAllowed = "notAllowed";
                        $dowloadAttachementLink = "";

                        if (!(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id))) {
                            $classNotAllowed = "";
                            if (file_exists(Yii::app()->basePath . '/../www/upload/comments/large/' . $commentDetails['comment']->user_default_attachment)) {
                                $dowloadAttachementLink = "href='../forum/downloadAttachement/{$commentDetails['comment']->user_default_sample_listing_feedback_id}'";

                                ?>

                                <li>
                                    <a class="user-attach-icon tooltip attachement <?= $classNotAllowed; ?>" <?= $dowloadAttachementLink; ?>
                                       style="margin-right: 5px;"><?= $thumbFileName; ?></a></li>

                                <?php
                            }
                        }
                    }
                    else if(isset($commentDetails['comment']->user_default_thumb_attachment)   ) {

                        // Display original file name
                        $attachement = explode(".", $commentDetails['comment']->user_default_attachment);
                        $fileNameLength = (int)((strlen($attachement[0])) + 1);

                        $originaleFileName = substr($commentDetails['comment']->user_default_attachment, $fileNameLength);
                        $thumbFileName = ($commentDetails['comment']->user_default_thumb_attachment) ? '<span style="width:0px"><img src="' . Yii::app()->createUrl('/upload/comments/thumb/' . $commentDetails['comment']->user_default_thumb_attachment) . '" width="90"  /></span>' : '<span class="classic">No thumbnail</span>';
                        $classNotAllowed = "notAllowed";
                        $dowloadAttachementLink = "";

                        if (!(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id))) {
                            $classNotAllowed = "";
                            if (file_exists(Yii::app()->basePath . '/../www/upload/comments/large/' . $commentDetails['comment']->user_default_attachment)) {
                                $dowloadAttachementLink = "href='../forum/downloadAttachement/{$commentDetails['comment']->user_default_sample_listing_feedback_id}'";

                                ?>

                                <li>
                                    <a class="user-attach-icon tooltip attachement <?= $classNotAllowed; ?>" <?= $dowloadAttachementLink; ?>
                                       style="margin-right: 5px;"><?= $thumbFileName; ?></a></li>

                                <?php
                            }
                        }
                    }?>


                </ul>
                <div class="clear"></div>
                <span class="comment more"><?=$commentDetails['comment']->user_default_sample_listing_feedback_message;?></span>
                <div class="flike_buuton_box" data-commentid="<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>">
                    <a><span class="flike_button <?=$grayedOutClass;?>" data-likeaction="like">Like</span></a>
                    <a><span class="fdislike_button <?=$grayedOutClass;?>" data-likeaction="dislike">Dislike</span></a>
                </div>
                <div class="clear"></div>
                <a class="floatLeft replyToPostComment <?=$grayedOutClass;?>" data-commentid="<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" style="cursor: pointer; font-size:0.8em;">Reply to post</a>

                <!-- <div class="commentLink" style="margin-right: 0px;"><span> In reply to </span> <a href="#;">Jourdan (show original message)</a></div> -->
                <ul class="dd_social_list ">
                    <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span> </a></li>
                    <li><a href="http://www.twtter.com" class="tooltip twitter"><span class="classic">Send to my twitter account</span></a></li>
                    <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to my googleplus account</span> </a></li>
                    <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to my linkedin account</span></a></li>
                </ul>
                <div class='postBlock'>
                    <form class="submit-comment sub-text-field hiddenForm replyToPostCommentForm-<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" data-commentreference="<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>">
                        <br/><br/>
                        <textarea class="message" placeholder="<?=$notLogguedInText;?>"></textarea>
                        <!-- <div class="submitBtn">--><a class="dd_feedback_button" id="dd_feedback_reply_button" title="Submit comment" >Post</a><!--</div>-->
                        <?php /* ?><br/><br/>
                               <div class='attachement-div'>
                                   <input type="file" class='attachement-file' id="attachement<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" name="attachement<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                   <span class="user-attach-icon attachement-icon" style="width: 25%; margin-top: 8px;padding-left: 18px;" data-content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded">
                                       Add attachment
                                       <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                   </span>
                               </div>
                                    <div class="thumb-attachement-div" id="data-attachement<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" style="display: none;">
                                        <input type="file" class='attachement-thumb-file' id="thumb_attachement<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" name="thumb_attachement<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                        <span class="user-attach-icon attachement-thumb-icon"  style="width: 30%; margin-top: 4px;padding-left: 18px;">
                                            Add thumbnail image
                                            <span class="attachement-text" style="padding-left: 17px !important;"></span>

                                        </span>
                                    </div><?php */ ?>
                    </form>

                    <form class="submit-comment sub-text-field hiddenForm sendMailListOwnerForm-<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" data-commentreference="<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>">
                        <br />
                        <textarea class="message"></textarea>
                        <!--<div class="submitBtn">--><a class="dd_sendmail_button" title="Submit comment" >Post</a><!--</div>-->
                        <br/><br/><br/>
                        <?php /* ?>
                                    <div class='attachement-div'>
                                        <input type="file" class='attachement-file' id="attachement<?=$postsComments['user_default_sample_listing_feedback_id'];?>" name="attachement<?=$postsComments['user_default_sample_listing_feedback_id'];?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                                                <span class="user-attach-icon attachement-icon" style="width: 25%; margin-top: 4px;padding-left: 18px;" data-content_title="Click to add an attachment Please note attachment must be an image or in a  PDF file format. zip & rar file can only be downloaded">
                                                    Add attachment
                                                    <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                                </span>

                                    </div>

                                    <div class="thumb-attachement-div" id="data-attachement<?=$postsComments['user_default_sample_listing_feedback_id'];?>" style="display: none;">
                                        <input type="file" class='attachement-thumb-file' id="thumb_attachement<?=$postsComments['user_default_sample_listing_feedback_id'];?>" name="thumb_attachement<?=$postsComments['user_default_sample_listing_feedback_id'];?>" data-uploadsuccess="0" data-uploadfile="null" multiple />
                    <span class="user-attach-icon attachement-thumb-icon"  style="width: 30%; margin-top: 4px;padding-left: 18px;">
                        Add thumbnail image
                        <span class="attachement-text" style="padding-left: 17px !important;"></span>

                    </span>
                                    </div> <?php */ ?>
                    </form>
                </div>

                <div class="clear"></div>

                <?php

                $k = 1;

                foreach ($commentDetails['post_comment'] as $postsComments) {

                    $postCommentBoxClassColor = ($k%2 == 0) ? "": "even";
                    $grayedOutClass = ( $postsComments['user_default_profiles_id'] == Yii::app()->user->Id) ? "grayedOut" : "";


                    $spamCommentStyle = "";

                    if( (Yii::app()->session['adminKey'] == '1') ){

                        $spamCommentStyle = "border: 2px solid #ED1C24;";

                    }

                    ?>
                    <div class="dd_coment_box <?=$postCommentBoxClassColor;?> hiddenPostComments" style="width:98%; <?=$spamCommentStyle;?>">
                        <div class="user_image">
                            <?php

                            if($usersStats[$postsComments['user_default_profiles_id']]['user_default_profile_image']) {
                                $img = $usersStats[$postsComments['user_default_profiles_id']]['user_default_profile_image'];
                                $user_dirname = strtolower($usersStats[$postsComments['user_default_profiles_id']]['username']) . '_' . $usersStats[$postsComments['user_default_profiles_id']]['user_id'];
                                if (file_exists(Yii::app()->basePath . '/../www/upload/users/' . $user_dirname . '/images/' . $img)) {
                                    ?>
                                    <img
                                        src="<?php echo Yii::app()->createUrl('/upload/users/' . $user_dirname . '/images/' . $img); ?>"
                                        alt="<?php echo $usersStats[$postsComments['user_default_profiles_id']]['user_default_first_name'] . ' ' . $usersStats[$postsComments['user_default_profiles_id']]['user_default_surname']; ?>"
                                        width="60"/>
                                    <?php
                                }else if(file_exists(Yii::app()->basePath . '/../www/upload/logo/' . $img)){ ?>
                                    <img
                                        src="<?php echo Yii::app()->createUrl('/upload/logo/'. $img); ?>"
                                        alt="<?php echo $usersStats[$postsComments['user_default_profiles_id']]['user_default_first_name'] . ' ' . $usersStats[$postsComments['user_default_profiles_id']]['user_default_surname']; ?>"
                                        width="60"/>
                                <?php } else {
                                    $img = 'avatar.jpg';
                                    ?>
                                    <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                         alt="Profile picture" width="60"/>

                                    <?php
                                }
                            }else{
                                $img = 'avatar.jpg';
                                ?>
                                <img src="<?php echo Yii::app()->createUrl('/upload/logo/' . $img); ?>"
                                     alt="Profile picture" width="60"/>
                            <?php }
                            ?>
                            <?php /*  <img src="<?=Yii::app()->theme->getBaseUrl().'/images/icons/user.png';?>" width="60px"> */?>

                        </div>
                        <div class="ratting_box">
                            <span class="rating_title">Rating</span>
                            <span class="tooltip like_icon" data-href="#"><?=$postsComments['user_default_feedback_likes_total'];?><span class="classic">Total number of Likes</span></span>
                            <span class="tooltip dislike_icon" data-href="#"><?=$postsComments['user_default_feedback_dislikes_total'];?><span class="classic">Total number of Dislikes</span></span>
                        </div>
                        <div class="dd_coment" data-commentid="<?=$postsComments['user_default_sample_listing_feedback_id'];?>">
                            <ul class="dd_coment_heading">
                                <li><a class="tooltip" href="#" style="color:#A84793 !important; margin-right: 5px;"><?=$usersStats[$postsComments['user_default_profiles_id']]['username'];?><span class="classic">Username</span></a></li>
                                <li><a class="tooltip reputation" href="#" style="margin-right: 5px;">*<?=abs($usersStats[$postsComments['user_default_profiles_id']]['user_default_reputation']);?><span class="classic">User reputation</span></a></li>
                                <li><a class="tooltip" href="#" style="margin-right: 5px;"><?php $u = ForumClass::formatDate($postsComments['user_default_date_create']); echo $u['date'];?><span class="classic">Date of comment</span></a></li>
                                <li><a class="tooltip" href="#" style="margin-right: 5px;"><?=$u['time'];?><span class="classic">Time of comment</span></a></li>
                                <!-- a class="tooltip" href="#" style="margin-right: 5px;">open all<span class="classic">Open ALL comments</span></a>-->
                                <!--<a class="user-attach-icon tooltip" href="#" style="margin-right: 5px;"><span class="classic">Attachment</span></a> -->

                                <?php

                                if( isset($postsComments['user_default_attachment']) ){

                                    // Display original file name
                                    $attachement = explode(".", $postsComments['user_default_attachment']);
                                    $fileNameLength = (int) ( (strlen($attachement[0])) + 1);

                                    $originaleFileName = substr($postsComments['user_default_attachment'], $fileNameLength);

                                    $thumbFileName = ($postsComments['user_default_thumb_attachment'])?'<span><img src="' . Yii::app()->createUrl('/upload/comments/thumb/' . $postsComments['user_default_thumb_attachment']) . '" width="90"  /></span>' : '<span class="classic">No thumbnail</span>';

                                    $classNotAllowed = "notAllowed";
                                    $dowloadAttachementLink = "";

                                    if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                                        $classNotAllowed = "";
                                        if (file_exists(Yii::app()->basePath . '/../www/upload/comments/large/' . $postsComments['user_default_attachment'])) {
                                            $dowloadAttachementLink = "href='../forum/downloadAttachement/{$postsComments['user_default_sample_listing_feedback_id']}'";

                                        }

                                        ?>

                                        <li><a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="margin-right: 5px;"><?=$thumbFileName;?></a></li>

                                    <?php } }

                                else if( isset($postsComments['user_default_thumb_attachment']) ){

                                    // Display original file name
                                    $attachement = explode(".", $postsComments['user_default_attachment']);
                                    $fileNameLength = (int) ( (strlen($attachement[0])) + 1);

                                    $originaleFileName = substr($postsComments['user_default_attachment'], $fileNameLength);

                                    $thumbFileName = ($postsComments['user_default_thumb_attachment'])?'<span style="width:0px;"><img src="' . Yii::app()->createUrl('/upload/comments/thumb/' . $postsComments['user_default_thumb_attachment']) . '" width="90"  /></span>' : '<span class="classic">No thumbnail</span>';

                                    $classNotAllowed = "notAllowed";
                                    $dowloadAttachementLink = "";

                                    if( !(Yii::app()->user->isGuest) && (isset(Yii::app()->user->Id)) ){

                                        $classNotAllowed = "";
                                        if (file_exists(Yii::app()->basePath . '/../www/upload/comments/large/' . $postsComments['user_default_attachment'])) {
                                            $dowloadAttachementLink = "href='../forum/downloadAttachement/{$postsComments['user_default_sample_listing_feedback_id']}'";

                                        }

                                        ?>

                                        <li><a class="user-attach-icon tooltip attachement <?=$classNotAllowed;?>" <?=$dowloadAttachementLink;?> style="margin-right: 5px;"><?=$thumbFileName;?></a></li>

                                    <?php } }

                                ?>

                            </ul>
                            <div class="clear"></div>
                            <span class="comment more"><?=$postsComments['user_default_sample_listing_feedback_message'];?></span>
                            <div class="flike_buuton_box" data-commentid="<?=$postsComments['user_default_sample_listing_feedback_id'];?>" >
                                <a><span class="flike_button <?=$grayedOutClass;?>" data-likeaction="like">Like</span></a>
                                <a><span class="fdislike_button <?=$grayedOutClass;?>" data-likeaction="dislike">Dislike</span></a>
                            </div>
                            <div class="clear"></div>

                            <?php

                            if( $postsComments['user_default_is_spam'] == '1' ){

                                if( Yii::app()->session['adminKey'] == '1' ){?>

                                    <a class="floatLeft deleteComment" data-commentid="<?=$postsComments['user_default_sample_listing_feedback_id'];?>" style="font-size:0.8em; margin-left:25px;cursor: pointer;"><em>Delete comment</em></a>
                                    <a class="floatLeft  greenText sendMailListOwner" data-commentid="<?=$commentDetails['comment']->user_default_sample_listing_feedback_id;?>" style="cursor: pointer;font-size:0.8em; margin-left:25px;"><em>Sendmail to list owner</em></a>

                                    <?php

                                }else{?>

                                    <label class="floatLeft redText" data-commentid="<?=$postsComments['user_default_sample_listing_feedback_id'];?>" style="font-size:0.8em; margin-left:25px;"><em>Comment under review</em></label>

                                <?php }


                            }else{

                                if( $reportAsSpamAllow ){?>

                                    <a class="floatLeft reportAsSpam" data-commentid="<?=$postsComments['user_default_sample_listing_feedback_id'];?>" style="cursor:pointer;font-size:0.8em; margin-left:25px;"><em>Report as spam</em></a>

                                    <?php

                                }
                            }

                            ?>

                            <div class="commentLink" style="margin-right: 0px;"><span> In reply to </span> <a href="#;"><?=$usersStats[$commentDetails['comment']->user_default_profiles_id]['username'];?></a></div>
                            <ul class="dd_social_list ">
                                <li><a href="http://www.facebook.com" class="tooltip face_book"><span class="classic">Send to my facebook account</span></a></li>
                                <li><a href="http://www.twtter.com" class="tooltip twitter"><span class="classic">Send to my twitter account</span></a></li>
                                <li><a href="https://plus.google.com" class="tooltip googleplus"><span class="classic">Send to my googleplus account</span></a></li>
                                <li><a href="https://www.linkedin.com" class="tooltip linked"><span class="classic">Send to my linkedin account</span></a></li>
                            </ul>

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

        <div class="user-page-navfeed">

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
        <div class="page_numbers sfeedbackpagenumbers">
            <?php

            echo Samplefeedback::renderPagination($commentViewLimit, $pageSelected, $commentOrderBy, $listingId, $userProfession );

            ?>

            <input type='hidden' id='feedbackViewLimit' value='<?=$commentViewLimit;?>' />
        </div>


    </div>

    <div class="clear"></div>
    <?php
}
?>
