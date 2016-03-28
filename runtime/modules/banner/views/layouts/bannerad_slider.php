<div class="add-carousel"><!--start advertiser carousel----->

    <?php

    //$user_all_banners=$db->selectArrRecords("drg_banner_ads","banner_path,banner_link,banner_id,drg_user_id","banner_approve_status=1");
    //$totalResults=$db->CountQuery("drg_banner_ads","*","banner_approve_status=1");

    if (Yii::app()->controller->id == 'banner' && in_array(Yii::app()->controller->action->id, array('reject'))) {

        $bannerId = Yii::app()->request->getParam('code');
        $user_all_banners1 = Bannerads::model()->findByPk($bannerId);
        if (count($user_all_banners1) > 0) {
            ?>

            <ul id="add-carousel-wrap" class="jcarousel-skin-ie7 banner-item">

                <li>

                    <?php

                    $username = User::model()->findByPk($user_all_banners1['user_default_id']);
                    ?>

                    <a href="http://<?php echo str_replace("http", "", $bannerval->user_default_listing_banner_link); ?>"
                       target="_blank"
                       onclick="javascript:updateHit(<?php echo $user_all_banners1['user_default_listing_banner_id']; ?>);'"><img
                            src="<?php echo Yii::app()->getBaseUrl(true) . '/upload/' . $user_all_banners1['user_default_listing_banner_path']; ?>"
                            height="77" width="420"
                            title="Image Name: <?php echo $user_all_banners1['user_default_listing_banner_path']; ?>"/>
                    </a>

                </li>

            </ul>

        <?php
        }

    } else {

        // get banners of logged in user else show the active banners
        /*if ($loggedInUser)
            $user_all_banners = Bannerads::model()->findAll("user_default_id=" . $loggedInUser);
        else
            $user_all_banners = Bannerads::model()->findAll("user_default_listing_banner_status = 1");*/


        $criteria = new CDbCriteria();

        //$criteria->condition = "user_default_id = :user_default_id AND DATE_ADD(`user_default_listing_banner_submission_date`, INTERVAL `user_default_listing_banner_duration` DAY) >= NOW()";
        $criteria->params=(array(':user_default_id'=>Yii::app()->user->getID()));
        $user_all_banners = Bannerads::model()->findAll($criteria);
        if (count($user_all_banners) != 0) {
            ?>

            <ul id="add-carousel-wrap" class="jcarousel-skin-ie7 banner-item">

                <?php foreach ($user_all_banners as $bannerval) {

                    $bannerLink = $bannerval->user_default_listing_banner_link ? $bannerval->user_default_listing_banner_link : '#';
                    $banner_id  = $bannerval->user_default_listing_banner_status == 1 && $bannerval->user_default_listing_banner_link != '' ? $bannerval->user_default_listing_banner_id : '';
                    $target = $bannerval->user_default_listing_banner_link ? '_blank' : '_self';

                    ?>

                    <li>
                        <a href="<?php echo $bannerLink; ?>" target="<?php echo $target; ?>"
                           onclick="javascript:updateHit(<?php echo $banner_id; ?>);"><img
                                src="<?php echo Yii::app()->baseUrl . '/upload/' . $bannerval->user_default_listing_banner_path; ?>"
                                height="77" width="420"
                                title="Image Name: <?php echo $bannerval->user_default_listing_banner_path; ?>"/>
                        </a>

                    </li>

                <?php

                }

                ?>

            </ul>

        <?php } else { ?>

            <?php

            // get database instance
            $connection = Yii::app()->db;

            // Listing Banner Query
            $command = $connection->createCommand();
            $command->text = "SELECT * FROM (
                SELECT user_default_banner_path, user_default_banner_link
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
                            $bannerLink = $bannerAd['user_default_banner_link'];
                            $target = "_blank";
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

    }

    ?>

</div>


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

    };

    jQuery(document).ready(function () {

        jQuery('#add-carousel-wrap').jcarousel({

            wrap: 'circular',
            scroll: 1,
            hoverPause: true,
            initCallback: mycarousel_initCallback

        });

    });

</script>

