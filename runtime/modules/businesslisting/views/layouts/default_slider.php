<div class="add-carousel"><!--start advertiser carousel-->

    <?php

    // get database instance
    $connection = Yii::app()->db;

    // Listing Banner Query
    $command = $connection->createCommand();
    $command->text = "SELECT * FROM (
                SELECT NULL AS user_default_banner_id, user_default_banner_link, user_default_banner_path
                FROM `user_default_site_bannerads`
                WHERE `user_default_banner_status` = '1'
                ORDER BY `user_default_banner_id`
            ) AS siteBannerAds";
    $bannerAds = $command->queryAll();

    ?>
    <ul id="add-carousel-wrap" class="jcarousel-skin-ie7 banner-item">

        <?php if ($bannerAds) : ?>
            <?php foreach ($bannerAds as $bannerAd) :

                $bannerLink = "javascript:void(0)";
                $bannerLinkOnclick = "return true;";
                $target = "_self";
                if ($bannerAd['user_default_banner_link'] != '') {

                    if (SharedFunctions::isYoutubeUrl($bannerAd['user_default_banner_link'])) {
                        $bannerLinkOnclick = "show_video('" . $bannerAd['user_default_banner_link'] . "');";
                    } else {
                        $bannerLink = $bannerAd['user_default_banner_link'];
                        $target = "_blank";
                    }
                }
                ?>
                <li>
                    <a href="<?php echo $bannerLink; ?>" target="<?php echo $target; ?>"
                       onclick="<?php echo $bannerLinkOnclick; ?>"><img
                            src="<?php echo Yii::app()->baseUrl . '/upload/' . $bannerAd['user_default_banner_path']; ?>"
                            height="77" width="420"
                            title="Image Name: <?php echo $bannerAd['user_default_banner_path']; ?>"/>

                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>

    </ul>

</div> <!-- /end advertiser carousel -->


<?php
$connection = Yii::app()->db;
$contract = Yii::app()->controller->id . "/" . Yii::app()->controller->action->id;
$getslider = $connection->createCommand("select * from `user_default_slider_listing` where `page_name`='$contract'");
$sliderresult = $getslider->queryRow();
$sliderid = $sliderresult['slider_id'];

$getsliderbtns = $connection->createCommand("select * from `user_default_slider_btns` where `slider_id`='$sliderid'");
$sliderresults = $getsliderbtns->queryRow();
$sliderids = $sliderresults['slider_id'];
if ($sliderids != "") {
    ?>
    <div id="how-to-div" class="clearfix">
        <?php
        $getsliderbtnss = $connection->createCommand("select * from `user_default_slider_btns` where `slider_id`='$sliderid' order by `btn_id` ASC");
        $getbtns = $getsliderbtnss->queryAll();
        foreach ($getbtns as $data)
        {
        if ($data['btn_videolink'] != "")
        {
        ?>
        <a href="javascript:void(0)" onclick="play_video('<?php echo $data['btn_videolink']; ?>');" class="clearfix">
            <?php
            }
            else
            {
            ?>
            <a href="<?php echo $data['btn_sitelink']; ?>" class="clearfix">
                <?php
                }
                ?>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/<?php echo $data['btn_image']; ?>"
                     width="30"/><?php echo $data['btn_text']; ?></a>

            <?php
            }
            ?>
    </div>
<?php
} else {
    ?>

    <div id="how-to-div" class="clearfix">

        <a href="#;" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30"/>How to list
            your business idea</a>

        <a href="<?php echo $this->createUrl('/page/faq'); ?>" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30"/>How to
            navigate the site</a>

        <a href="<?php echo $this->createUrl('/page/faq'); ?>" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30"/>Contact us
            and FAQ's</a>

    </div>
<?php
}
?>





<script language="javascript" type="text/javascript">

    function updateHit(bannerId) {

        var updateHitUrl = "<?php echo Yii::app()->createUrl('banner/banner/updatehit')?>";
        if(bannerId) {

            jQuery.ajax({
                type: "GET",
                url: updateHitUrl,
                data: { banner_id:bannerId },
                cache: false,
                success: function (response) {
                    return true;
                },
                fail: function (error) {
                    alert(error); return false;
                }
            });
ss
        }
        return false;

    }
    function show_video(video) {

        $('.home-slider-wrap').fadeOut();
        $('.home-video-wrap').fadeIn('slow');
        jwplayer('my-video').setup({

            file: video,
            image: '$surl/themes/business/images/robot/defult-video.png',
            width: '640',
            height: '360',
            autostart: 'true'

        });


    }

    function play_video(video) {
        $('.home-slider-wrap').fadeOut();
        $('.home-video-wrap').fadeIn('slow');
        jwplayer('my-video').setup({
            file: video,
            image: '/themes/business/images/robot/defult-video.png',
            width: '640',
            height: '360',
            autostart: 'true',
            events: {
                onComplete: function () {
                    $('.home-slider-wrap').fadeIn('slow');
                    $('.home-video-wrap').fadeOut('fast');
                }
            }
        });
    }


    function show_slider() {

        $('.home-slider-wrap').fadeIn('slow');
        $('.home-video-wrap').fadeOut('fast');

    }


    // Advert Carousel
    function mycarousel_initCallback(carousel) {

        carousel.clip.hover(function () {
            carousel.stopAuto();
        }, function () {
            carousel.startAuto();
        });

    }
    ;

    jQuery(document).ready(function () {

        jQuery('#add-carousel-wrap').jcarousel({

            wrap: 'circular',
            scroll: 1,
            hoverPause: true,
            initCallback: mycarousel_initCallback

        });

    });

</script>

