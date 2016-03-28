<?php
$this->breadcrumbs = array(
    'my account' => Yii::app()->user->_user_Type == 'user' ? array('/user/myaccount/update') : array('/business/myaccount/update'),
    'manage business listing' => Yii::app()->user->_user_Type == 'user' ? array('/listing') : array('/businesslisting'),
    'my marketing tools',
);
$currencyConveter = new ECurrencyConverter();
$currencyConveter->currencyConverter();
if (Yii::app()->user->_user_Type == 'user') {
    $UserData = User::model()->findByPk(Yii::app()->user->getID());
    $Currency = Currency::model()->findByPk($UserData->user_default_currency);
} else {
    $UserData = Business::model()->findByPk(Yii::app()->user->getID());
    $Currency = Currency::model()->findByPk($UserData->user_default_business_currency);
}
?>

<div id="displayDialog" style="display: none;"><?php echo $displayDialog; ?></div>
<div id="registration-tabs"><a href="javascript:void(0);">My Account</a>
<style>
.table_style1 td { font-size:10px}
</style>
    <div class="clear"></div>
</div>

<div class="registration-content banner-add-section" style="min-height:580px;float:left;">
<div class="my-account-links">
    <?php
    $this->renderPartial("//layouts/my-account-links");
    ?>
</div>
<div class="marketing_tab">
<div class="row">
    <div class="heading_part">
        <h1>My Marketing Tools</h1>

        <h2>Marketing tools for
              <span class="orange-color">
              <?php
              $title = '';
              $listId = Yii::app()->request->getParam('listid');
              if (Yii::app()->user->_user_Type == 'user') {
                  $listData = UserDefaultListing::model()->findByPk(array('user_default_listing_id' => $listId));
                  $title = $listData->user_default_listing_title;
              } else {
                  $listData = Businesslisting::model()->findByPk(array('user_default_business_blid' => $listId));
                  $title = $listData->user_default_business_title;
              }
              print ucfirst($title);
              ?>
              </span>
        </h2>

        <p class="darkGrey-text">Market your listing to business supermarket members and your social network
            contacts</p>

        <div class="thank-vote-box">
            <div id="terms-conditions" class="u-email-box"><img
                    src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png"/>

                <div class="vote-popup-box">
                    <h2 class="Blue">Success</h2>

                    <div align="center" style="font-size: 12px;">You have successfully offered <span
                            style="color: #f58345;"><?php echo $purchasePoints; ?></span> points to all users who
                        visit your listing and make a vote on your marketing
                        question.
                    </div>
                    <div>&nbsp;</div>
                    <div align="center" style="font-size: 12px;">Your users will get a further <span
                            style="color: #f58345;"><?php echo $purchasePoints; ?></span> points if the take part in
                        your forum and leave a comment
                    </div>
                    <div>&nbsp;</div>
                 <span class="middle">
                <input name="close" id="btnclose" value="Close" type="button" class="button black"
                       onclick="close_thank_vote_box();"/>
                </span>

                </div>
            </div>
        </div>
    </div>

    <div id="offerInfo">
        <form action="<?php echo Yii::app()->createUrl("banner/marketing_payment/listid/$listId"); ?>"
              name="frmmarketing" id="frmmarketing" method="post">
            <h2 class="mrg-left-20 color-blue">1. Offer prize points to attract traffic to your listing
                <label class="offer-label"></label>
            </h2>

            <h3>(number of members that will receive your invitation: <span style="color:#1DBFD8">
            <?php
            if (Yii::app()->user->_user_Type == 'user') {
                $count = User::model()->count("user_default_account_status = '1'");
            }
            if (Yii::app()->user->_user_Type == 'business') {
                $count = Business::model()->count("user_default_business_status = '1'");
            }
            echo $count;
            ?></span>)</h3>

            <p class="darkGrey-text">Offering prize points to members is an excellent way to drive traffic to your
                listing.
                Members will receive the value of
                the prize points you select below when they visit your listing and vote and they can double them if they
                take
                part in</p>
            <?php if ($dataProvider): ?>
                <label class="heading">History</label>
                <table border="0" bordercolor="#fff" class="table_style1" width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Date</th>
                        <th>Points purchased</th>
                        <th>Cost</th>
                        <th>Number of click through</th>
                        <th>Visitor acquisition rate</th>
                    </tr>
                    <?php foreach ($dataProvider as $index => $record):
                        $color = ($index % 2 == 0) ? 'Grey' : 'Mauve';
                        $style = ($index % 2 == 0) ? 'GreyRow' : 'MauveRow';?>
                        <tr onMouseOver="ChangeColor<?php echo $color; ?>(this, true);"
                            onmouseout="ChangeColor<?php echo $color; ?>(this, false);"
                            onclick="DoNav('#');"
                            class="<?php echo $style; ?>">
                            <td width="90px;"><?php echo date('d/m/Y', strtotime($record->user_default_listing_points_date)); ?></td>
                            <td><?php echo $record->user_default_listing_points_purchased; ?></td>
                            <td><?php echo $record->user_default_listing_points_cost; ?></td>
                            <td><?php echo $record->user_default_listing_points_required; ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                // the pagination widget with some options to mess
                $this->widget('CLinkPager', array(
                    'currentPage' => $pages->getCurrentPage(),
                    'itemCount' => $itemCount,
                    'pageSize' => $pageSize,
                    'maxButtonCount' => 5,
                    'firstPageLabel' => '',
                    'lastPageLabel' => '',
                    'prevPageLabel' => 'Previous',
                    'nextPageLabel' => 'Next',
//'nextPageLabel'=>'My text >',
                    'header' => '',
                    'htmlOptions' => array('id' => 'navlist'),
                    'cssFile' => Yii::app()->request->baseUrl . '/css/style.css'
                ));
                ?>
            <?php endif; ?>
            <div class="clearBoth">&nbsp;</div>
            <table class="table_style2">
                <tr>
                    <td width="95"><label class="heading">Purchase Points:</label></td>
                    <td><select class="chzn-select width-80" name="purchasePoints" id="purchase-points"
                                onchange="calculate_cost();">
                            <option value="">Select</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="75">75</option>
                            <option value="100">100</option>
                        </select></td>
                    <td><label
                            class="heading">Cost:<?php echo SharedFunctions::_get_currency_symbol($Currency->currency_code) ?></label>
                    </td>
                    <td width="95">
                        <span class="point-clc">1 point = $1</span>
                        <input class="disable-input" id="cost" type="text" readonly name="cost" id="point-input"
                               placeholder="0:00"/></td>
                    <td class="proceed-checkout" align="center" width="176">
                        <label class="heading" style="cursor: pointer;">Make payment and submit</label>
                    </td>
                    <td>
                        <button class="login_sbmt" name="login_sbmt" type="button" title="Submit your vote"
                                onclick="return checkOfferPoints();">
                            <img class="border-radius5"
                                 src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png">
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div id="bannerInfo">
<div class="row">
<h2 class="mrg-left-20 color-blue">2. Submit a banner advertisement
    <label class="submit-label"></label>
</h2>

<h3>(number of members that will receive your invitation: <span class="purple-color"><strong> <?php
            if (Yii::app()->user->_user_Type == 'user') {
                $count = User::model()->count("user_default_account_status = '1'");
            }
            if (Yii::app()->user->_user_Type == 'business') {
                $count = Business::model()->count("user_default_business_status = '1'");
            }
            echo $count;
            ?></strong></span>)</h3>

<p class="darkGrey-text">A banner ad is on every page and a good way to maximize your exposure at only $1 a day it
    offers
    excellent value for money. <a href="https://db.tt/M0lGFinr" class="color-blue" target="_blank">Download a banner
        template here >> </a></p>
<label class="heading">History</label>
<table border="0" bordercolor="#fff" class="table_style1" width="100%" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <th>Date <br>Published</th>
        <th>Expire <br>Date</th>
        <th>Duration</th>
        <th>Cost</th>
        <th>Number<br> of<br> clicks</th>
        <th>Visitor<br> acquisition<br> cost</th>
    </tr>
    <?php
    $page = Yii::app()->request->getParam('page');
    if (!isset($page)) {
        $page = 0;
        $firstLimit = 0;
    } else {
        if ($page == 0) {
            $page = 0;
            $firstLimit = 0;
        } else {
            $page = $page;
            $firstLimit = ($page - 1) * 3;
        }
    }
    $connection = Yii::app()->db;
    $qry = "SELECT date_format(user_default_listing_banner_submission_date,'%d/%m/%Y') as banner_date,user_default_listing_banner_submission_date,user_default_listing_banner_duration,user_default_listing_banner_cost,user_default_listing_banner_clicks,user_default_listing_banner_path,user_default_listing_banner_id,user_default_listing_banner_status";
    $qry .= " FROM user_default_banner_ads WHERE user_default_id ='" . Yii::app()->user->getID() . "' and user_default_listing_id ='" .$listId. "'  limit $firstLimit ,3";
    $command = $connection->createCommand($qry);
    $user_banners = $command->queryAll();
    $connection = Yii::app()->db;
    $qry1 = "SELECT date_format(user_default_listing_banner_submission_date,'%d/%m/%Y') as banner_date,user_default_listing_banner_submission_date,user_default_listing_banner_cost,user_default_listing_banner_clicks,user_default_listing_banner_path,user_default_listing_banner_id,user_default_listing_banner_status";
    $qry1 .= " FROM user_default_banner_ads WHERE user_default_id ='" . Yii::app()->user->getID() . "' and user_default_listing_id ='" .$listId. "'";
    $command = $connection->createCommand($qry1);
    $user_all_banners = $command->queryAll();
    $totalResults = Bannerads::model()->countByAttributes(array("user_default_id" => Yii::app()->user->getID()));
    $totalPages = (int)($totalResults / 3);
    $checkExtraPage = $totalResults % 3;
    if ($checkExtraPage > 0) {
        $totalPages += 1;
    }
    $j = 0;
    for ($i = 0; $i < count($user_banners); $i++) {
        ?>
        <tr <?php if ($user_banners[$i]['user_default_listing_banner_status'] == 3){ ?>style='color:red;' <?php
        }
        if ($j == 0) {
            ?> onMouseOver="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="javascript: location.href='?<?php if ($user_banners[$i]['user_default_listing_banner_status'] != 3) { ?>renewBannerId<?php } else { ?>updateBanner<?php } ?>=<?= $user_banners[$i]['user_default_listing_banner_id']; ?>&page=<?= $page; ?>#bannerSection'"
            class="GreyRow"<?php $j = 1;
        } else  {
            ?>
            onMouseOver="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="javascript: location.href='?<?php if ($user_banners[$i]['user_default_listing_banner_status'] != 3) { ?>renewBannerId<?php } else { ?>updateBanner<?php } ?>=<?= $user_banners[$i]['user_default_listing_banner_id']; ?>&page=<?= $page; ?>#bannerSection'"
            class="MauveRow"
            <?php $j = 0;
        } ?> >
            <td width="100">
                <?php echo $user_banners[$i]['banner_date']; ?>
            </td>
			<td width="100"><?php $duration = $user_banners[$i]['user_default_listing_banner_duration']; $dur = explode(':',$duration); if($user_banners[$i]['banner_date']!=""){ $date = new DateTime($user_banners[$i]['user_default_listing_banner_submission_date']);$date->modify("+".$dur[0]." hours");echo $date->format("d/m/Y"); } ?></td>
			<td width="100"><?php echo $user_banners[$i]['user_default_listing_banner_duration']; ?></td>
            <td width="100"><?php echo SharedFunctions::_get_currency_symbol($Currency->currency_code) . $user_banners[$i]['user_default_listing_banner_cost']; ?></td>
           
			<td width="100"><?php echo $user_banners[$i]['user_default_listing_banner_clicks']; ?></td>
			
            <td width="100">
                <?php
                if ($user_banners[$i]['user_default_listing_banner_clicks'] != 0) {
                    $val = $user_banners[$i]['user_default_listing_banner_cost'] / $user_banners[$i]['user_default_listing_banner_clicks'];
                    echo SharedFunctions::_get_currency_symbol($Currency->currency_code) . number_format((float)$val, 2, '.', '');
                } else {
                    echo "0";
                }
                ?>
            </td>
        </tr>
    <?php } ?>
    <?php if (count($user_banners) == 0) { ?>
        <tr onMouseOver="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);" onclick="DoNav('#');"
            class="GreyRow">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
			<td></td>
            <td></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<label class="heading">Active banner</label>
<ul id="navlist">
    <?php if ($page == 0 || $page == 1) { ?>
        <li class="prev">&lt; previous</li><?php
    } else {
        ?>
        <li><a href="?page=0#bannerSection">&lt; previous</a></li>
    <?php
    }
    for ($p = 1; $p <= $totalPages; $p++) {
        if ($p == $page) {
            ?>
            <li><?= $p; ?></li>
        <?php
        } else {
            ?>
            <li><a href="?page=<?= $p; ?>#bannerSection"><?= $p; ?></a></li>
        <?php
        }
    }
    if ($page == $totalPages) {
        ?>
        <li class="next">next &gt;</li>
    <?php
    } else {
        ?>
        <li><a href="?page=<?= ($page + 1); ?>#bannerSection">next &gt;</a></li>
    <?php } ?>
</ul>
<form action="<?php echo Yii::app()->createUrl("banner/makepayment/listid/$listId"); ?>" method="post" id="bannerForm"
      enctype="multipart/form-data" onsubmit="return checkbanner();">
<!-- <input type="file" style="display:none;" name="bannerImage" id="bannerImage" onChange="javascript:sub(this)" /> -->
<input type="file" style="display:none;" name="bannerImage" id="bannerImage"/>
<?php
$renewBannerId = Yii::app()->request->getParam('renewBannerId');
if (isset($renewBannerId)) {
    $connection = Yii::app()->db;
    $qry1 = "SELECT date_format(user_default_listing_banner_submission_date,'%d/%m/%Y') as banner_date,user_default_listing_banner_cost,user_default_listing_banner_clicks,user_default_listing_banner_path,user_default_listing_banner_id,user_default_listing_banner_status";
    $qry1 .= " FROM user_default_banner_ads  WHERE user_default_id ='" . Yii::app()->user->getID() . "' and user_default_listing_id ='" .$listId. "'";
    $command = $connection->createCommand($qry1);
    $user_all_banners = $command->queryAll();
}
$this->renderPartial('//../modules/banner/views/layouts/bannerad_slider');
if (isset($renewBannerId)) {
    ?>
    <div class="renew-banner">
        <form action="" method="post" enctype="multipart/form-data" id="formSubmit">
            <input type="checkbox" name="renew_banner"
                   value="<?php echo $user_all_banners[0]['user_default_listing_banner_id']; ?>"
                   style="margin-top:4px;" id="term_agree" value="1"/>
            <label style="color:#A47A8F;">Renew <a class="sl-tip tooltip" href="#;">?<span class="classic">Select this to renew your existing banner for another term </span></a></label>
        </form>
    </div>
<?php
}
?>
<?php
if (!isset($renewBannerId)) {
    ?>
    <?php
    $updateBanner = Yii::app()->request->getParam('updateBanner');
    ?>
    <div class="update-banner">
        <?php
        if (isset($updateBanner)) {
            ?>
            <form action="" method="post" id="formSubmit">
                <input type="hidden" name="updateBanner" value="<?= $updateBanner; ?>"/>
            </form>
        <?php
        }
        ?>
        <?php if (!isset($updateBanner)) { ?>

            <input type="text" placeholder="708px wide x 129px high" class="uploader-field" id="uploader-field"
                   name="<?php if (!isset($_GET['updateBanner'])) { ?>banner_path<?php
                   } else {
                       echo "update_banner_path";
                   } ?>" value="<?php if (isset($_GET['uploaded_banner_path'])) {
                echo $_GET['uploaded_banner_path'];
            } else {
                if (isset($_GET['updateBanner'])) {
                    echo $ban[0]['banner_path'];
                }
            } ?>" readonly/>
            <label class="upload-img heading" onclick="javascript:getFile()">Upload image</label>
            <span class="confirm-img" style=" <?php if (isset($_GET['confirm'])) {
                echo "color:red;";
            } ?>">
                                 <?php if (isset($payment)) {
                                     if (isset($_GET['confirm']) && $_GET['confirm'] == "wrongFile") {
                                         echo "File format not supported";
                                     }
                                     if (isset($_GET['confirm']) && $_GET['confirm'] == "bigSize") {
                                         echo "Image file size is larger than 100K.<br /> Please select another file or reduce the size to 100K or lower";
                                     }
                                     if ($payment == "confirm") {
                                         ?>
                                         <div class="confirm-email banner-confirm-email">
                                             <div class="u-email-box banner-email-box">
                                                 <img class="banner-robot"
                                                      src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png"/>

                                                 <div class="my-account-popup-box banner-account-popup">
                                                     <div class="pop-up-content">
                                                         <h1 class="brown-color" align="center">Success</h1>
                                                         <br/>

                                                         <p class="success-submit"> Your banner advert has been
                                                             successfully submitted</p>
                                                         <br/>

                                                         <p class="banner-note">You will be notified by email when your
                                                             banner ad is published <br/>
                                                             You may close this dialogue box and return to your form
                                                         </p>
                                                         <br/>
                                                         <br/>

                                                         <p><a class="button black" href="javascript:void(0);"
                                                               onclick="jQuery('.banner-confirm-email').hide();">Close</a>
                                                         </p>
                                                         <br/>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     <?php
                                     }
                                 } else {
                                     ?>
                                     <span class="image-size"><em>Image size must not exceed 100K</em></span>
                                 <?php } ?>
                              </span>
            <button class="login_sbmt" name="login_sbmt" type="button" onClick="javascript:getFile()"
                    title="Upload image">
                <img class="user-btn-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png">
            </button>

            <div class="sl-select-purchase">
                <table class="sl-select purchase-access">
                    <tr>
                        <td>
                            <select id="drg_category" name="drg_category" data-placeholder="Please select banner link"
                                    class="chzn-select"
                                    style="width:425px;" tabindex="2" onchange="update_listing_link();">
                                <option value="" title="">None</option>
                                <?php
                                if (Yii::app()->user->_user_Type == 'user') {
                                    $listData = UserDefaultListing::model()->findAllByAttributes(array("user_default_profiles_id" => Yii::app()->user->getState('uid')));
                                    if ($listData) {
                                        foreach ($listData as $listing) {
                                            echo '<option value="' . $listing->user_default_listing_id . '" title="">' . $listing->user_default_listing_title . '</option>';
                                        }
                                    }
                                } else {
                                    $listData = Businesslisting::model()->findAllByAttributes(array("drg_uid" => Yii::app()->user->getState('uid')));
                                    if ($listData) {
                                        foreach ($listData as $listing) {
                                            echo '<option value="' . $listing->user_default_listing_id . '" title="">' . $listing->user_default_listing_title . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <label class="select-banner">Select banner link</label>
                <br/>

                <div class="err" id="add_err" style="color:red"></div>
            </div>
            <!--<input type="text" class="uploader-field banner-input" name="banner_link" id="banner_link" value=""
                   placeholder="Please select a link for your banner"
                   readonly/>
            <label class="banner-link">Banner link</label>-->
            <div class="clear"></div> <?php } ?>
    </div>
<?php
}
?>
<?php if (!isset($_GET['updateBanner'])) {

    $resBannerDefault = WebsiteDefaults::model()->findByAttributes(array('module' => 'Banner cost'));
    $defaultBannerCostDisplay = '';
    if ($resBannerDefault) {
        $bannerCostPerWeek = number_format($currencyConveter->convert($resBannerDefault->cost, $resBannerDefault->currency->currency_code, $Currency->currency_code), 2);
        $defaultBannerCostDisplay = $resBannerDefault->uom . ' = ' . SharedFunctions::_get_currency_symbol($resBannerDefault->currency->currency_code) . number_format($resBannerDefault->cost, 2);
    } else {
        $bannerCostPerWeek = number_format($currencyConveter->convert(3,'USD',$Currency->currency_code), 2);
    }


    ?>
    <table class="table_style2">
        <tr>
            <td width="112"><label class="heading">Enter duration </label></td>
            <td><select class="chzn-select" <?php if (!isset($_GET['renewBannerId'])){ ?>name="totalWeeks"
                        <?php }else{ ?>name="editTotalWeeks"<?php } ?> id="totalWeeks" style="width:80px;"
                        onchange="calculate_banner_cost('<?php echo $bannerCostPerWeek; ?>');">
                    <option value="0">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="25">25</option>
                    <option value="52">52</option>
                </select></td>
            <td width="48"><label class="heading">week/<br/> weeks</label></td>
            <td>
            <td width="180"><label
                    class="heading">Cost:<?php echo SharedFunctions::_get_currency_symbol($Currency->currency_code); ?></label>
                <input class="disable-input" type="text" id="banner-cost" readonly
                       <?php if (!isset($_GET['renewBannerId'])){ ?>name="cost"
                       <?php }else{ ?>name="editCost"<?php } ?> placeholder="0:00"/>
                <span
                    class="currency-code"><?php echo $defaultBannerCostDisplay; ?></span></td>
            <td width="280">
                <label class="make-payment-lable heading" onclick="javascript: $('#pay').trigger('click');">Make payment
                    & submit</label>

                <button class="login_sbmt" name="login_sbmt" type="submit" id="pay" title="Make your payment"
                        style="float: right; margin: -20px 0;">
                    <img class="user-btn-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png">
                    <!--<img class="border-radius5"
                         src="<?php /*echo Yii::app()->theme->baseUrl; */ ?>/images/buttons/Proceed-to-checkout-default.png"
                         width="50" style="cursor: pointer;"/>-->
                </button>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                                      <span class="payment-error" id="paymentError">
                                      You must select a duration from the dropdown list before you can continue
                                      </span>
            </td>
        </tr>
    </table>
<?php
}
if (isset($_GET['updateBanner'])) {
    ?>
    <table class="table_style2">
        <tr>
            <td width="500" class="align-center">
                <input type="submit" value="Update" class="button gray"/>
            </td>
        </tr>
    </table>
<?php } ?>
</form>
</div>
</div>
<!-- Banner advert module -->
<div id="professionalInfo">
    <div class="row">
        <h2 style="margin-left:-20px; color: #00acce;">3. Get professional help
            <label style="color:#A47A8F;  font-size:12px; line-height:8px;"></label>
        </h2>

        <h3>(number of members that will receive your invitation: <span style="color:#1DBFD8"> <?php
                $count = Business::model()->count("user_default_business_status = '1'");
                echo $count;?> </span>)</h3>

        <p class="darkGrey-text">Use this if you wish to target your listing to all members or a particular sector. <i
                style="font-size:10px; float:left">(This is a good way to let the market know of any new developments or
                the number of prize points you are offering)</i></p>
        <br/>

        <div id="errorMessage"></div>
        <label class="heading">Subject</label>
        <textarea style="height:20px; padding:4px 0 0 4px; width: 606px;" id="subject" name="subject"></textarea>

        <div class='attachement-div'>
            <input type="file" class='attachement-file' id="attachement" name="attachement" data-uploadsuccess="0"
                   data-uploadfile="null" value=""/>
                                   <span class="user-attach-icon attachement-icon"
                                         style="width: 25%; margin-top: 52px;padding-left: 18px;">
                                       Add attachement
                                       <span class="attachement-text" style="padding-left: 17px !important;"></span>
                                   </span>
        </div>
        <br/>
        <label class="heading">Message</label>
        <textarea id="message" name="message"></textarea>
        <table class="table_style2">
            <tr>
                <td width="50"><label>Sector:</label></td>
                <td>
                    <?php
                    $sectorData = ListingProfession::model()->findAll();
                    $countryData = Country::model()->findAll();
                    ?>
                    <select onFocus="getSelectNormal('#sl_profession')" title="Click to select a profession"
                            tabindex="2" style="width:140px;" class="chzn-select" data-placeholder="Please select"
                            name="drg_profession" id="sl_profession">
                        <option value="all">All</option>
                        <?php
                        foreach ($sectorData as $index => $record):
                            echo '<option value=' . $record->list_profession_id . '>' . $record->list_profession_name . '</option>';
                        endforeach;
                        ?>
                    </select>
                </td>
                <td width="" align="right"><label>Limit request to:</label></td>
                <td width=""><select id="drf_ctry" name="drg_country" data-placeholder="Worldwide" class="chzn-select"
                                     style="width:110px;" tabindex="2">
                        <option value="worldwide">Worldwide</option>
                        <?php
                        foreach ($countryData as $index => $record):
                            echo '<option value=' . $record->user_default_country_id . '>' . $record->user_default_country_name . '</option>';
                        endforeach;
                        ?>
                    </select></td>
                <td align="right" width=""><label>Submit Query</label></td>
                <td width="35">
                    <button class="login_sbmt" name="send_message" id="send_message" type="button" title="Submit Query">
                        <img style="border-radius:5px;"
                             src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png"></button>
                </td>
            </tr>
        </table>
    </div>
    <!-- Get professional help module -->
</div>

<div id="socialNetworkInfo">
    <div class="row">
        <h2 style="margin:0 0 4px -20px; color: #00acce;">4. Get a link to your listing for your social networking
            sites</h2>

        <p class="darkGrey-text"><em>(Copy & paste the link below on your social media site to invite friends and
                followers to your listing)</em></p>
        <?php /* <input class="full_width textfield" style="width: 100.2%" type="text" readonly
               value="<?php echo Yii::app()->getBaseUrl(true) ?>/listing/view?id=<?php echo $listId; ?>"/> */ ?>
        <label style="color: #A84793">Please select your button text below</label>
        <div class="clear">&nbsp;</div>
        <div class="radio-btn">
            <table width="100%"  >
                <tr>
                    <td><input type="radio" class="listingVoteText" name="listingVoteText" id="listingVoteText_1" value=""/></td>
                    <td><input type="radio" class="listingVoteText" name="listingVoteText" id="listingVoteText_2" value="Click me and vote"/></td>
                    <td><input type="radio" class="listingVoteText" name="listingVoteText" id="listingVoteText_3" value="Checkout my listing"/></td>
                    <td><input type="radio" class="listingVoteText" name="listingVoteText" id="listingVoteText_4" value="Tell me what you think"/></td>
                    <td><input type="radio" class="listingVoteText" name="listingVoteText" id="listingVoteText_5" value="Is it a good idea?"/></td>
                    <td><input type="radio" class="listingVoteText" name="listingVoteText" id="listingVoteText_6" value="I need your support"/></td>
                </tr>
                <tr>
                    <td style="width:10%;color:#A84793">No text</td>
                    <td>Click me and vote</td>
                    <td>Checkout my listing</td>
                    <td>Tell me what you think</td>
                    <td>Is it a good idea?</td>
                    <td>I need your support</td>
                </tr>
            </table>
            <div style="border: 1px solid #A84793;margin-bottom:10px;padding: 10px;height:100px">
                <div id="listingVoteLink"><a href="<?php echo Yii::app()->getBaseUrl(true) . '/listing/view?id=' . $listId; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true) ?>/themes/business/images/buttons/UserListing_Btn.png"></a><br/><span id="listingVoteBtnText" style="font-size: 15px;font-size: 15px;color: #A84793;font-weight: bold;"></span> </div>
            </div>
        </div>


        <div style="float: left">
            <input type="hidden" id="hiddenFieldCopyClipboard" />
            <input type="button" onclick="copyToClipboard('listingVoteLink')" class="button black" id="copyToClipboard" value="Copy To Clipboard" style="font-size:10px;" />
        </div>
        <div id="socialNetworkBox" style="display: none;float: right">
            <select id="social_sites" class="chzn-select" name="social_sites" style="width: 200px;" onchange="socialNetworkSites();" >
                <option value="">Select Social Sites</option>
                <option value="https://www.instagram.com/">Instagram</option>
                <option value="https://myspace.com/">MySpace</option>
                <option value="http://digg.com/">Digg</option>
                <option value="https://www.facebook.com/">Facebook</option>
                <option value="https://www.linkedin.com/">LinkedIn</option>
                <option value="https://twitter.com/">Twitter</option>
                <option value="https://vimeo.com/">Vimeo</option>
                <option value="http://www.skype.com/en/" >Skype</option>
                <option value="https://www.dropbox.com/" >Dropbox</option>
                <option value="https://dribbble.com/" >Dribbble</option>
                <option value="https://www.youtube.com" >Youtube</option>
                <option value="https://in.pinterest.com/">Pinterest</option>
                <option value="https://plus.google.com/collections/featured">Google Plus+</option>
                <option value="http://www.last.fm/" >Last Fm</option>
                <option value="https://www.blogger.com/" >Blogger</option>
                <option value="http://www.rss.org/" >Rss</option>
                <option value="http://www.sharethis.com/" >Share This</option>
                <!-- <option value="tumblr" data-href="https://www.tumblr.com/">tumblr</option>
                 <option value="vk" data-href="http://vk.com/">VK</option>
                 <option value="flickr" data-href="https://www.flickr.com/">Flickr</option>
                 <option value="vine" data-href="https://vine.co/">Vine</option>
                 <option value="meetup" data-href="http://www.meetup.com/">Meetup</option>
                 <option value="tagged" data-href="http://www.tagged.com/">Tagged</option>
                 <option value="ask.fm" data-href="https://m.ask.fm/">Ask.fm</option>
                 <option value="meetMe" data-href="https://www.meetme.com/">MeetMe</option>
                 <option value="classMates" data-href="http://www.classmates.com/">ClassMates</option> -->
            </select>
        </div>

        <div>&nbsp;</div>

        <?php /* <div align="right">
            <!-- Facebook -->
            <div id="fb-root"></div>
            <script>(function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-share-button" data-href="<?php echo Yii::app()->baseUrl . '/listing/view?id=' . $listId; ?>"
                 data-width="200" data-type="button_count"></div>


            <!-- Google Plus -->
            <div class="g-plus" data-href="<?php echo Yii::app()->baseUrl . '/listing/view?id=' . $listId; ?>"
                 data-action="share" data-annotation="bubble"></div>

            <script type="text/javascript">
                (function () {
                    var po = document.createElement('script');
                    po.type = 'text/javascript';
                    po.async = true;
                    po.src = 'https://apis.google.com/js/platform.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(po, s);
                })();
            </script>

            <!-- Linkedin -->
            <script src="//platform.linkedin.com/in.js" type="text/javascript">
                lang: en_US
            </script>
            <script type="IN/Share" data-url="<?php echo Yii::app()->baseUrl . '/listing/view?id=' . $listId; ?>"
                    data-counter="right"></script>

            <!-- Twitter -->
            <a href="https://twitter.com/share" class="twitter-share-button"
               data-url="<?php echo Yii::app()->baseUrl . '/listing/view?id=' . $listId; ?>" data-lang="en"
               data-count="<?= $style ?>">Tweet</a>

            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "https://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");</script>


            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <!--<button class="login_sbmt" id="copy_to_clipboard"  name="copy_to_clipboard" type="submit" title="Copy to Clipboard"><img style="border-radius:5px;" src="<?php //echo Yii::app()->theme->baseUrl;?>/images/buttons/user.png" ></button>-->
        </div> */?>
    </div>
    <!-- Social network link module -->
</div>

</div>
</div>
<div id="screen"></div>
<script type="text/javascript">

$(".chzn-select").chosen();

if ($('#displayDialog').text() == '1') {

    $('#offerInfo').hide();
    $('#socialNetworkInfo').hide();
    $('#professionalInfo').hide();
    $('#bannerInfo').hide();

    $('.thank-vote-box').fadeIn();
} else {
    $('.thank-vote-box').fadeOut();
}

function close_thank_vote_box() {
    $('#offerInfo').show();
    $('#socialNetworkInfo').show();
    $('#professionalInfo').show();
    $('#bannerInfo').show();
    $('.thank-vote-box').fadeOut();
}
function ChangeColorGrey(tableRow, highLight) {
    if (highLight) {
        tableRow.style.backgroundColor = '#C2C2C2';
    }
    else {
        tableRow.style.backgroundColor = '#EBEBEB';
    }
}

function ChangeColorMauve(tableRow, highLight) {
    if (highLight) {
        tableRow.style.backgroundColor = '#C9C';
    }
    else {
        tableRow.style.backgroundColor = '#EADDED';
    }
}

function getFile() {
    document.getElementById("bannerImage").click();
}

function sub(obj) {
    $('#bannerForm').submit();
}

function checkOfferPoints() {
    var failedvalidation = false;
    var cost = $("#cost").val();

    $("#cost").removeClass('mandatoryerror');
    if (cost == "" || isNaN(cost)) {
        $("#cost").addClass('mandatoryerror');
        $("#cost").attr('placeholder', 'Please enter total cost');
        failedvalidation = true;
    }

    if (failedvalidation) {
        return false;
    }
    else {
        $('#frmmarketing').submit();
        return true;
    }
}
function checkbanner() {

    var failedvalidation = false;
    var category = $("#drg_category option:selected").val();
    var banner_link = $("#banner_link").val();
    var uploaderfield = $("#uploader-field").val();
    var totalWeeks = $("#totalWeeks option:selected").val();
    var cost = $("#banner-cost").val();

    /*$("#drg_category").removeClass('mandatoryerror');
     if (category == "") {
     $("#drg_category").addClass('mandatoryerror');
     $("#drg_category").attr('placeholder', 'Please select banner link');
     failedvalidation = true;
     }*/

    $("#banner_link").removeClass('mandatoryerror');
    if (category != '' && banner_link == "") {
        $("#banner_link").addClass('mandatoryerror');
        $("#banner_link").attr('placeholder', 'Please upload banner to for banner link');
        failedvalidation = true;
    }

    $("#uploader-field").removeClass('mandatoryerror');
    if (uploaderfield == "") {
        $("#uploader-field").addClass('mandatoryerror');
        $("#uploader-field").attr('placeholder', 'Please upload banner image');
        failedvalidation = true;
    }

    $("#totalWeeks").removeClass('mandatoryerror');
    if (totalWeeks == "") {
        $("#totalWeeks").addClass('mandatoryerror');
        $("#totalWeeks").attr('placeholder', 'Please select duration ');
        failedvalidation = true;
    }

    $("#banner-cost").removeClass('mandatoryerror');
    if (cost == "" || cost == 'Nan') {
        $("#banner-cost").addClass('mandatoryerror');
        $("#banner-cost").attr('placeholder', 'Please enter total cost');
        failedvalidation = true;
    }

    if (failedvalidation) {
        return false;
    }
    return true;
}

function socialNetworkSites(){
    var socialNetworlUrl = $('#social_sites option:selected').val();
    var win = window.open(socialNetworlUrl, '_blank');
    win.focus();
}

function update_listing_link() {
    var selectedListingID = $('select#drg_category option:selected').val();
    var listingURL = '';
    if (selectedListingID != 0) {
        listingURL = "<?php echo Yii::app()->getBaseUrl(true); ?>/listing/view?id=" + selectedListingID;
    }
    $('input#banner_link').val(listingURL);
}

function calculate_cost() {
    var selectedWeeks = $('select#purchase-points option:selected').val();
    var totalCost = '';
    if (selectedWeeks != 0) {
        totalCost = parseInt(selectedWeeks) * <?php echo number_format($currencyConveter->convert(1,'USD',$Currency->currency_code),2);?>;
    }
    jQuery('input#cost').val(totalCost);
}

function calculate_banner_cost(costPerWeek) {
    var selectedWeeks = $('select#totalWeeks option:selected').val();
    var totalCost = '';
    if (selectedWeeks != 0) {
        totalCost = parseInt(selectedWeeks) * costPerWeek;
    }
    jQuery('input#banner-cost').val(totalCost);
}

function mycarousel_initCallback(carousel) {
    carousel.stopAuto();
}

function copyToClipboard(elementId) {
    if($('.listingVoteText').is(':checked')){
        // Create a "hidden" input
        var aux = document.createElement("input");

        // Assign it the value of the specified element
        aux.setAttribute("value", document.getElementById(elementId).innerHTML);

        // Append it to the body
        document.body.appendChild(aux);

        // Highlight its content
        aux.select();

        // Copy the highlighted text
        document.execCommand("copy");

        // Remove it from the body
        document.body.removeChild(aux);
        $('#socialNetworkBox').fadeIn();
    }

    return false;
}
jQuery(document).ready(function () {
    jQuery('#add-carousel-wrap').jcarousel({
        wrap: 'circular',
        scroll: 1,
        initCallback: mycarousel_initCallback
    });

    /*jQuery('.active-result').click(function () {
     jQuery('#cost').val(parseInt(jQuery(this).html()) * 3);
     });*/

    jQuery('.listingVoteText').click(function (){
        var listingVoteTextId = $(this).attr('id');
        $('#listingVoteBtnText').text($('#'+listingVoteTextId).val());
    });
    jQuery('#pay').live("click", function () {
        //jQuery('#banner-cost,#banner_link').prop("disabled", false);
    });


    jQuery('#bannerImage').change(function (e) {
        if ($(this).val() != '') {
            var file = jQuery(this)[0].files[0];
            var currentDate = '<?php echo date('Y-m-d-h-i-s'); ?>';
            var fileNameFull = file.name;
            var fileName = fileNameFull.substr(0, fileNameFull.lastIndexOf('.')) || fileNameFull;
            var ext = fileNameFull.split('.').pop();
            var fileSize = parseInt(file.size / 1024);
            var filePath = 'users/<?php echo Yii::app()->user->getState('username')."_".Yii::app()->user->getID();?>/banners/' + fileName + '-' + currentDate + '.' + ext;
            if (fileSize < 101) {
                //jQuery("#banner_link").removeAttr('disabled').val();
                jQuery("#uploader-field").attr("readonly", "true").val(filePath);

                // show preview of the image with
                var tempFilePath = URL.createObjectURL(e.target.files[0]);
                var itemLast = $('#add-carousel-wrap li').length;
                itemLast = 1;

                var prevImage = '<img src="' + tempFilePath + '" height="77" width="420" title="new uploaded banner image"/>'
                jQuery('#add-carousel-wrap').empty().html('<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-' + itemLast + ' jcarousel-item-' + itemLast + '-horizontal" jcarouselindex="' + itemLast + '" style="float: left; list-style: none;">' +
                '<a href="#">' + prevImage + '</a></li>');

                // set and stop jcarousel
                jQuery('#add-carousel-wrap').jcarousel('scroll', itemLast, false);
                jQuery('#add-carousel-wrap').jcarousel('stop');

            } else {
                alert("please select other image ");
            }
        } else {
            alert('Please select a file.')
        }
    });

    $('#send_message').click(function (event) {
        if (professional_help_form_validation() == true) {
            var message = $('#message').val();
            var subject = $('#subject').val();
            var attachment = $('.attachement-file').val();
            var sector = $('#sl_profession').val();
            var limitRequest = $('#drf_ctry').val();
            var fileattachment = $('.attachement-file');

            if ((attachment != '')) {
                /*var formData = new FormData();
                 var fileSelect = document.getElementById(fileattachment.attr('id'));
                 var file = fileSelect.files[0];
                 // Add the file to the request.
                 formData.append('attachement', file, file.name);*/
                uploadProfessionalAttachement(fileattachment);
            }
            var d1 = 'listid=<?php echo $listid;?>&subject=' + subject + '&message=' + message + '&sector=' + sector + '&limitRequest=' + limitRequest + '&attachment=' + attachment;

            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->baseUrl; ?>/banner/send_message",
                data: d1,
                success: function (result) {
                    var jsonData = $.parseJSON(result);
                    if (jsonData.messageDisplay == 'success') {
                        $("#subject").val('');
                        $("#message").val('');
                        $('.attachement-file').val('');
                        $('#sl_profession').val('');
                        //  window.location.href="<?php //echo Yii::app()->baseUrl; ?>/admin/member/index";

                    }
                },
                error: function (xhr, tStatus, e) {

                    if (xhr.status == 302) {
                        // User in not loggued in
                        alert("You must be logged in.");

                    } else {

                        if (!xhr) {
                            console.log(" We have an error ");
                            console.log(tStatus + " " + e.message);
                        } else {
                            console.log("else: " + e.message); // the great unknown
                        }
                    }
                },
                complete: function () {
                    return true;
                }
            });
        }
    });
});

function professional_help_form_validation() {

    var isFormValidation = true;
    var message = $('#message').val();
    var subject = $('#subject').val();
    var attachment = $('.attachement-file').val();

    var sector = $('#sl_profession').val();
    var limitRequest = $('#drf_ctry').val();

    if (subject == '') {
        $("#subject").css('border', '1px solid #f00');
        isFormValidation = false;
    }
    if (message == '') {
        $("#message").css('border', '1px solid #f00');
        isFormValidation = false;
    }

    /*
     if (sector == '') {
     $("#sl_profession_chzn").css('border', '1px solid #f00');
     isFormValidation = false;
     }
     */
    /*  // Add an attachement
     if( (attachment != '') ){
     var fileattachment = $('.attachement-file');
     if(uploadProfessionalAttachement(fileattachment) == true)
     isFormValidation = true;
     // Upload attachement success
     if( (fileattachment.attr("data-uploadsuccess") == "0") || (fileattachment.attr("data-uploadfile") == "null")  ){
     isFormValidation=false;
     }

     }*/

    return isFormValidation;
}

function uploadProfessionalAttachement(attachement) {
    // Create a formdata object and add the files
    var formData = new FormData();
    var fileSelect = document.getElementById(attachement.attr('id'));

    if (fileSelect) {
        // Loop through each of the selected files.
        for (var i = 0; i < fileSelect.files.length; i++) {

            var file = fileSelect.files[i];
            // Add the file to the request.
            formData.append('attachement', file, file.name);
        }

        $.ajax({

            url: "<?php echo Yii::app()->baseUrl?>/banner/banner/uploadAttachement",
            type: 'POST',
            data: formData,
            async: true,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request

            success: function (resp) {

                if (resp.action_status == '0') {
                    alert(resp.message);
                } else {

                    attachement.attr("data-uploadsuccess", "1");
                    attachement.attr("data-uploadfile", resp.file_name);

                }
            },
            error: function (xhr, tStatus, e) {

                if (xhr.status == 302) {
                    // User in not loggued in
                    alert("You must be logged in.");

                } else {

                    if (!xhr) {
                        console.log(" We have an error ");
                        console.log(tStatus + " " + e.message);
                    } else {
                        console.log("else: " + e.message); // the great unknown
                    }
                }
            },
            complete: function () {
                return true;
            }

        });
    }


}
</script>