<?php

$lid=$_GET['listid'];
$listing = Listings::model()->findByPk($lid);
$userid = $listing->user_default_profiles_id;
$userdata = User::model()->findByPk($userid);
$upath = $userdata['user_default_username'] . '_' . $userdata['user_default_id'];


$samplesmodel = Userlistingimages::model()->findAll("user_default_listing_id ='" . $lid . "'");
$count = count ( $samplesmodel );
if($count > 0)
{
    foreach ($samplesmodel as $sliderdata)
    {

        ?>
        <div class="panel samplepanel" >
            <div class="paneloverlay-wrapper">
                <div class="paneloverlay-top">&nbsp;</div>
                <div class="paneloverlay">
                    <p class="speech-bubble"><?php echo $sliderdata->user_default_listing_image_text ; ?>
                        <?php
                        echo "<br/><a href='javascript:void(0)' onclick=\"show_video('$sliderdata->user_default_listing_image_link2');\" title='' >Find out more ></a>";


                        ?>
                    </p>
                    <p class="speech-bubble-sig"></p>
                </div> <!-- /paneloverlay -->

                <div class="paneloverlay-bottom">&nbsp;</div>
            </div> <!-- paneloverlay-wrapper -->

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/blank.png">
            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/users/<?php echo $upath; ?>/listing/big/<?php echo $sliderdata->	user_default_listing_image; ?>" alt=""
                 style="float: right;
                                  position: relative;
                                  overflow: hidden;
                                  top: -298px;width: 470px;
                                  height: 290px;
                                  margin-right: 24px;
                        }"/>
        </div> <!-- /panel -->
        <?php
    }
}
else
{
    ?>
    <div class="panel">
        <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
                <p class="speech-bubble">What is Business-supermarket?<br />
                    A website for you to help you change your financial future.<br />
                    <a href="javascript:void(0)" onclick="show_video('http://youtu.be/GQvhj2-dh-c');" title='Business supermaket designed to help you start your own business' >Find out more ></a></p>
                <p class="speech-bubble-sig"></p>
            </div>

            <!-- /paneloverlay -->
            <div class="paneloverlay-bottom">&nbsp;</div>
        </div> <!-- /End of paneloverlay-wrapper -->

        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/what-is-dragonsnet-business-supermarket.png" alt="Worlds first business supermarket" /> </div>
    <div class="panel">
        <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
                <p class="speech-bubble">Get free entry to our cash prize draw for your efforts every month.<br />
                    <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='Enter the Business supermarket free to enter cash prize draw' >Find out more ></a></p>
                <p class="speech-bubble-sig"></p>
            </div> <!-- /paneloverlay -->
            <div class="paneloverlay-bottom">&nbsp;</div>
        </div> <!-- / End of paneloverlay-wrapper -->

        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/consumer-visitor.png" alt="How Business supermarket can help the consumer or a visitor to change their financial future" /> </div>

    <!-- /panel -->
    <!-- Start of carousel contents 2-->
    <div class="panel">
        <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
                <p class="speech-bubble">If your idea is good enough; we will put up the funding you need to take it to market.<br />
                    <a href="javascript:void(0)" onclick="show_video('http://youtu.be/irhJrkLAZ0E');" title='How Business supermarket can help a new business get funding video' >Find out more ></a></p>
            </div> <!-- /paneloverlay -->

            <div class="paneloverlay-bottom">&nbsp;</div>
        </div>

        <!-- paneloverlay-wrapper -->
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/invention-funding.png" alt="How Business supermarket can help you get funding for your business idea or new startups." /> </div>

    <!-- /panel -->
    <div class="panel">
        <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
                <p class="speech-bubble">Got a skill? Then exploit it here; become a teacher, mentor or a business partner.<br />
                    <a href="javascript:void(0)" title='Get financially better off by offering your knowledge and skill to a business on Business supermarket video' >Find out more ></a></p>
                <p class="speech-bubble-sig"></p>
            </div> <!-- /End of paneloverlay -->
            <div class="paneloverlay-bottom">&nbsp;</div>
        </div> <!-- / End of paneloverlay-wrapper -->

        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/subcontracting.png" alt="How Business supermarket can help the consumer" /> </div>

    <!-- /panel -->
    <div class="panel">
        <div class="paneloverlay-wrapper">
            <div class="paneloverlay-top">&nbsp;</div>
            <div class="paneloverlay">
                <p class="speech-bubble">Voice your opinion and be part of the next big thing.<br />
                    <a href="javascript:void(0)" title='Voice your opinion and help on Business supermarket and shape the next big thing video' >Find out more ></a></p>
                <p class="speech-bubble-sig"></p>
            </div> <!-- /End of paneloverlay -->

            <div class="paneloverlay-bottom">&nbsp;</div>
        </div>

        <!-- paneloverlay-wrapper -->
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/carousel/public-opinion.png" alt="Business supermarket allows yo have your say" />
    </div>
    <?php
}

?> 