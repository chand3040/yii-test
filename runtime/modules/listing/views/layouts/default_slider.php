<div class="add-carousel"><!--start advertiser carousel-->

    <?php

    // get database instance
    $connection = Yii::app()->db;

    // Listing Banner Query
    $command = $connection->createCommand();
	if($listing_category_id!="")
	{
    $command->text = "SELECT * FROM (
        SELECT * FROM (
            SELECT user_default_banner_id, user_default_banner_link, user_default_banner_path
            FROM `user_default_site_bannerads`
            WHERE `user_default_banner_status` = '1'
            ORDER BY `user_default_banner_id`
        ) AS siteBannerAds
        UNION
        SELECT * FROM (
            SELECT user_default_listing_banner_id AS user_default_banner_id, user_default_listing_banner_link AS user_default_banner_link, user_default_listing_banner_path AS user_default_banner_path
            FROM `user_default_banner_ads` AS ads
            INNER JOIN `user_default_listing` AS listing ON (listing.user_default_listing_id = ads.user_default_listing_id)
            WHERE `user_default_listing_banner_status`= 1
                AND `user_default_listing_category_id`= " . $listing_category_id . "
            ORDER BY `user_default_listing_banner_id`
        ) AS userBannerAds
    ) AS bannerAds";
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
                        $bannerLinkOnclick = "updateHit(" . $bannerAd['user_default_banner_id'] . "); show_video('" . $bannerAd['user_default_banner_link'] . "');";
                    } else {
                        $bannerLink = $bannerAd['user_default_banner_link'];
                        $bannerLinkOnclick = "updateHit(" . $bannerAd['user_default_banner_id'] . ");";
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
	
	<?php 
	}
	else
	{
		?>
		
		
        <ul id="add-carousel-wrap" class="jcarousel-skin-ie7">

            <?php /* ?> <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/advertise-here.png" height="77" /></li> <?php */ ?>

            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/business-help-ad.png" height="77" /></li>

            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/dragonsnet.png" height="77" /></li>

            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/member-listing-ad.png" height="77" /></li>

            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/business-support-ad.png" height="77" /></li>

            <li><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/upload/banner-images/skill-mentor-ad.png" height="77" /></li>

        </ul>
		<?php
	}
	?>

</div>

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
                <img
                    src="<?php echo Yii::app()->baseUrl; ?>/themes/business/images/buttons/<?php echo $data['btn_image']; ?>"
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

        <a href="#;" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/View-videos.png" width="30"/>How to
            navigate the site</a>

        <a href="#;" class="clearfix">

            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/FAQ-button.png" width="30"/>Contact us
            and FAQ's</a>

    </div>
<?php
}
?>

<script language="javascript" type="text/javascript">

    function updateHit(bannerId) {

        var updateHitUrl = "<?php echo Yii::app()->createUrl('banner/banner/updatehit')?>";
        if (bannerId) {

            jQuery.ajax({
                type: "GET",
                url: updateHitUrl,
                data: {banner_id: bannerId},
                cache: false,
                success: function (response) {
                    return true;
                },
                fail: function (error) {
                    alert(error);
                    return false;
                }
            });

        }
        return false;

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

    function show_video(video) {

        $('.home-slider-wrap').css('display', 'none');
        $('.home-video-wrap').fadeIn('fast');
        jwplayer('my-video').setup({

            file: video,
            image: '$surl/themes/business/images/robot/defult-video.png',
            width: '640',
            height: '360',
            autostart: 'true',
            events: {
                onComplete: function () {
                    show_slider();
                }

            }

        });


    }

    function play_video(video) {
        $('.home-slider-wrap').css('display', 'none');

        $('.home-video-wrap').fadeIn('fast');
        jwplayer('my-video').setup({
            file: video,
            image: '/themes/business/images/robot/defult-video.png',
            width: '640',
            height: '360',
            autostart: 'true',
            events: {
                onComplete: function () {
                    show_slider();
                }
            }
        });
    }


    function show_slider() {

        $('.home-slider-wrap').css('display', 'inline');
        $('.home-video-wrap').css('display', 'none');

    }

</script>

