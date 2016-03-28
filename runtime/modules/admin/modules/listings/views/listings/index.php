<style>
    .col-2{
        width: 28.33%
    }
</style>
<?php

$baseUrl = Yii::app()->theme->baseUrl;

$js = Yii::app()->getClientScript();

$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');

$js->registerCssFile($baseUrl . '/css/chosen.css');

$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');

$js->registerScriptFile($baseUrl . '/js/tinymce.min.js');


?>

<?php

$totalConsumers = 0;
$totalBusinessOwners = 0;
$totalBusinessUsers = 0;
$totalEntrepreneurs = 0;
$totalOther = 0;
$totalAll = 0;
$totalOnline = 0;

?>
<div style="width:100%">

<div class="user_statistics">
<div style="margin: 15px 250px;">
    <h2>Default User Listing submissions</h2>
</div>
<table style="width:98%;padding:8px;border-spacing:5px;">
<tr>
    <th style="width:12%">&nbsp;</th>
    <th>Consumers</th>
    <th>Business Owners</th>
    <th>Business Users</th>
    <th>Entrepreneurs</th>
    <th>Other</th>
    <th>Total</th>

</tr>
<tr class="odd">
    <td>Jan</td>
    <td>
        <?php
        $totalProfessions01 = 0;
        $professionId = 2;
        $month = '01';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions01 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions01 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions01 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions01 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions01 ? $totalProfessions01 : ''; ?></td>


</tr>
<tr class="even">
    <td>Feb</td>
    <td>
        <?php
        $totalProfessions02 = 0;
        $professionId = 2;
        $month = '02';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions02 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions02 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions02 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions02 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions02 ? $totalProfessions02 : ''; ?></td>

</tr>
<tr class="odd">
    <td>Mar</td>
    <td>
        <?php
        $totalProfessions03 = 0;
        $professionId = 2;
        $month = '03';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions03 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions03 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions03 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions03 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions03 ? $totalProfessions03 : ''; ?></td>

</tr>
<tr class="even">
    <td>April</td>
    <td>
        <?php
        $totalProfessions04 = 0;
        $professionId = 2;
        $month = '04';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions04 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions04 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions04 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions04 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions04 ? $totalProfessions04 : ''; ?></td>
</tr>
<tr class="odd">
    <td>May</td>
    <td>
        <?php
        $totalProfessions05 = 0;
        $professionId = 2;
        $month = '05';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions05 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions05 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions05 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions05 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions05 ? $totalProfessions05 : ''; ?></td>
</tr>
<tr class="even">
    <td>Jun</td>
    <td>
        <?php
        $totalProfessions06 = 0;
        $professionId = 2;
        $month = '06';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions06 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions06 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions06 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions06 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions06 ? $totalProfessions06 : ''; ?></td>
</tr>
<tr class="odd">
    <td>Jul</td>
    <td>
        <?php
        $totalProfessions07 = 0;
        $professionId = 2;
        $month = '07';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions07 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions07 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions07 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions07 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions07 ? $totalProfessions07 : ''; ?></td>
</tr>
<tr class="even">
    <td>Aug</td>
    <td>
        <?php
        $totalProfessions08 = 0;
        $professionId = 2;
        $month = '04';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions08 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions08 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions08 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions08 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions08 ? $totalProfessions08 : ''; ?></td>
</tr>
<tr class="odd">
    <td>Sep</td>
    <td>
        <?php
        $totalProfessions09 = 0;
        $professionId = 2;
        $month = '09';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions09 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions09 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions09 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions09 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions09 ? $totalProfessions09 : ''; ?></td>
</tr>
<tr class="even">
    <td>Oct</td>
    <td>
        <?php
        $totalProfessions10 = 0;
        $professionId = 2;
        $month = '04';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions10 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions10 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions10 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions10 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions10 ? $totalProfessions10 : ''; ?></td>
</tr>
<tr class="odd">
    <td>Nov</td>
    <td>
        <?php
        $totalProfessions11 = 0;
        $professionId = 2;
        $month = '11';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions11 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions11 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions11 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions11 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions11 ? $totalProfessions11 : ''; ?></td>
</tr>
<tr class="even">
    <td>Dec</td>
    <td>
        <?php
        $totalProfessions12 = 0;
        $professionId = 2;
        $month = '04';
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions12 += $professionUserListingCount;
        $totalConsumers += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 1;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions12 += $professionUserListingCount;
        $totalBusinessOwners += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>&nbsp;</td>
    <td>
        <?php
        $professionId = 3;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions12 += $professionUserListingCount;
        $totalEntrepreneurs += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td>
        <?php
        $professionId = 5;
        $professionUserListingCount = Listings::getProfessionUserListingCount($professionId, $month);
        $totalProfessions12 += $professionUserListingCount;
        $totalOther += $professionUserListingCount;

        echo $professionUserListingCount ? $professionUserListingCount : '';
        ?>
    </td>
    <td><?php echo $totalProfessions12 ? $totalProfessions12 : ''; ?></td>
</tr>
<tr class="odd">
    <td>Totals</td>
    <td> <?php
        $totalAll += $totalConsumers;
        echo $totalConsumers ? $totalConsumers : '';
        ?></td>
    <td> <?php
        $totalAll += $totalBusinessOwners;
        echo $totalBusinessOwners ? $totalBusinessOwners : '';
        ?></td>
    <td>&nbsp;</td>
    <td><?php
        $totalAll += $totalEntrepreneurs;
        echo $totalEntrepreneurs ? $totalEntrepreneurs : '';
        ?></td>
    <td>   <?php
        $totalAll += $totalOther;
        echo $totalOther ? $totalOther : '';
        ?></td>
    <td><?php echo $totalAll ? $totalAll : ''; ?></td>

</tr>
<tr class="even">
    <td>To Date</td>
    <td> <?php
        $professionId = 2;
        $toDateProfessions = Listings::getToDateProfessionUsersListingCount($professionId);
        $totalConsumers += $toDateProfessions;
        $totalToDates += $totalConsumers;

        echo $totalConsumers ? $totalConsumers : '';
        ?></td>
    <td> <?php
        $professionId = 1;
        $toDateProfessions = Listings::getToDateProfessionUsersListingCount($professionId);
        $totalConsumers += $toDateProfessions;
        $totalToDates += $totalConsumers;

        echo $totalConsumers ? $totalConsumers : '';
        ?></td>
    <td>&nbsp;</td>
    <td> <?php
        $professionId = 3;
        $toDateProfessions = Listings::getToDateProfessionUsersListingCount($professionId);
        $totalConsumers += $toDateProfessions;
        $totalToDates += $totalConsumers;

        echo $totalConsumers ? $totalConsumers : '';
        ?></td>
    <td> <?php
        $professionId = 5;
        $toDateProfessions = Listings::getToDateProfessionUsersListingCount($professionId);
        $totalConsumers += $toDateProfessions;
        $totalToDates += $totalConsumers;

        echo $totalConsumers ? $totalConsumers : '';
        ?></td>
    <td>&nbsp;</td>

</tr>

<tr class="odd">
    <td>Online</td>
    <td> <?php
        $professionId = 2;
        $professionUsersListingCountOnline = Listings::getProfessionUserListingCountOnline($professionId);
        $totalUsersCountOnline += $professionUsersListingCountOnline;

        echo $professionUsersListingCountOnline ? $professionUsersListingCountOnline : '';
        ?></td>
    <td><?php
        $professionId = 1;
        $professionUsersListingCountOnline = Listings::getProfessionUserListingCountOnline($professionId);
        $totalUsersCountOnline += $professionUsersListingCountOnline;

        echo $professionUsersListingCountOnline ? $professionUsersListingCountOnline : '';
        ?></td>
    <td>&nbsp;</td>
    <td><?php
        $professionId = 3;
        $professionUsersListingCountOnline = Listings::getProfessionUserListingCountOnline($professionId);
        $totalUsersCountOnline += $professionUsersListingCountOnline;

        echo $professionUsersListingCountOnline ? $professionUsersListingCountOnline : '';
        ?></td>
    <td><?php
        $professionId = 5;
        $professionUsersListingCountOnline = Listings::getProfessionUserListingCountOnline($professionId);
        $totalUsersCountOnline += $professionUsersListingCountOnline;

        echo $professionUsersListingCountOnline ? $professionUsersListingCountOnline : '';
        ?></td>

    <td><?php echo $totalUsersCountOnline ? $totalUsersCountOnline : '';?></td>

</tr>

</table>

<div style="margin-bottom:25px;text-align:center"><a
        href="<?php echo $this->createUrl('exportDefaultListings') ?>"
        class="button black black-btn" title="Download CSV">Download
        CSV</a></div>


</div>
<div class="right_verticalmenu">
    <ul class="">
        <li class="active">
            <a href="<?php echo $this->createUrl('index') ?>">Default User Listings</a>
        </li>
        <li class="">
            <a href="<?php echo Yii::app()->createUrl('admin/blisting/blisting/index') ?>">Business User Listings</a>
        </li>
        <li class=""><a href="#" class="textalign">Samples</a></li>
    </ul>


</div>
<div class="right_verticalmenu"  style="margin-top: 25%">
    <ul class="">
        <li><a href="<?php echo Yii::app()->createUrl('admin/member') ?>" class="textalign">Return</a></li>
        </ul>
    </div>
<!--right_verticalmenu-->
</div>
<div style="clear: both">&nbsp;</div>

<div class="searchbar_container" style="margin-top: -4px;">
    <div style="text-align:center;"><h2>Default user listing search bar</h2></div>
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'listings-form', 'enableAjaxValidation' => false, 'method' => 'post')); ?>

    <table class="sl-select">

        <tr>

            <td style="text-align: right; cursor: default;" title="Select a category from the dropdown menu">Category:</td>

            <td>

                <?php

                $listData =  CHtml::listData(Listingcategory::model()->findAll(),'user_default_listing_category_id','user_default_listing_category_name');

                echo CHtml::dropDownList('user_default_listing_category_id',$_REQUEST['user_default_listing_category_id'],$listData,array('prompt' => 'Please Select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'sl_category'));

                echo $form->error($model,'user_default_listing_category_id');

                ?>

            </td>

            <td style="text-align: right; cursor:default;" title="Select a section from the dropdown menu">Looking For:</td>

            <td>

                <?php

                $listData =  CHtml::listData(Listinglookingfor::model()->findAll(array("order"=>'user_default_listing_lookingfor_sort_order asc')),'user_default_listing_lookingfor_id','user_default_listing_lookingfor_name');

                echo CHtml::dropDownList('user_default_listing_lookingfor_id',$_REQUEST['user_default_listing_lookingfor_id'],$listData,array('empty' => 'Please select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'sl_profession','title'=>'Select a what you are looking for from the list'));

                echo $form->error($model,'user_default_listing_lookingfor_id');

                ?>

            </td>

            <td style="text-align: right; cursor: default;" title="Select country from the dropdown menu">Limit search to:</td>

            <td>

                <?php

                if(isset($_POST['user_default_listing_limit_viewing_id'])){

                    $drg_viewlimit = $_REQUEST['user_default_listing_limit_viewing_id'];

                }else

                {

                    $drg_viewlimit = $model->user_default_listing_limit_viewing_id;

                }

                $listData = CHtml::listData(Country::model()->findAll(),'user_default_country_id','user_default_country_name');

                echo CHtml::dropDownList('user_default_listing_limit_viewing_id',$drg_viewlimit,$listData,array('empty' => 'Worldwide (default)','class'=>'chzn-select','data-placeholder'=>'Worldwide (default)','onfocus'=>'getSelectNormal("#sl_vlimit");','id'=>'sl_vlimit','tabindex'=>'3','title'=>'Limit your exposure of your business idea to a country of your choice'));

                echo $form->error($model,'user_default_listing_limit_viewing_id');

                ?>

            </td>

        </tr>

    </table>
    <div style="clear: both">&nbsp;</div>
    <div class="row">
        <div class="col-1">
            <label>Username:</label>
            <input type="text" name="username" id="username" style="width: 165px;" value="<?php if (isset($_REQUEST['username'])) {
                echo $_REQUEST['username'];
            } else {
                echo "";
            } ?>"/>

            <input type="hidden" name="Listings[drg_uid]" value="" />
        </div>
        <div class="col-3">
            <label>Listing title:</label><input type="text" id="user_default_listing_title"
                                                name="user_default_listing_title" style="width: 490px;"
                                                value="<?php if (isset($_REQUEST['user_default_listing_title'])) {
                                                    echo $_REQUEST['user_default_listing_title'];
                                                } else {
                                                    echo "";
                                                } ?>"/>
        </div>
        <div class="col-2">
            <label>Keywords: </label>
            <input type="text" name="Keyword" id="keyword" style="width: 279px;" value="<?php if (isset($_REQUEST['Keyword'])) {
                echo $_REQUEST['Keyword'];
            } else {
                echo "";
            } ?>"/>
        </div>
    </div>

     <div style="margin:15px 250px;">
     <span style="margin-right: 250px;"> <input type="reset" name="btnclear" value="Clear" id="btnclear" class="button black black-btn"/></span>
      <input type="submit" name="btnsubmit" value="Submit" class="button dark-green"/>
     </div>
   
    <?php $this->endWidget(); ?>
</div><!--searchbar_container-->
<div>&nbsp;</div>
<div>&nbsp;</div>

<?php  if(count($list) > 0){?>
<div class="content-container">
    <div style="text-align:center;"><h2>Search result</h2></div>
        <table class="gernal_table" border="0" bordercolor="#fff" style="background-color:#fff" width="100%" cellpadding="1" cellspacing="2">

            <tr class="tableHeading">

                <td class="date_column" title="Date of submission">Date</td>

                <td class="username_column" title="Username of member">Username</td>

                <td class="title_column" title="Title of listing">Title</td>

                <td class="details_column"title="Listing description">Description</td>

                <td class="details_column"title="Listing type">Listing Type</td>

                <td class="details_column"title="Listing description">Listing Status</td>

            </tr>

            <?php
                foreach($list as $row){

                    ?>

                    <tr <?php if($i%2==0){?>onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('#');"<?php }else{?>onmouseover="ChangeColorMauve(this, true);"  onmouseout="ChangeColorMauve(this, false);"  onclick="DoNav('#');"<?php }?> class="<?php if($i%2==0){echo "MauveRow";}else{echo "GreyRow";}?>">

                        <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>"><?php echo CommonClass::convertDateAsDisplayFormat($row->user_default_listing_date, 'd/m/Y');?></a></td>

                        <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>"><?php echo SharedFunctions::get_user_names($row->user_default_profiles_id);?></a></td>

                        <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>"><?php echo substr($row->user_default_listing_title,0,30);?></a></td>

                        <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>"><?php echo substr($row->user_default_listing_summary,0,150);?></a></td>

                        <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>"><?php echo SharedFunctions::get_listingcat($row->user_default_listing_category_id);?></a></td>

                        <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>'"><a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$row->user_default_listing_id)); ?>"><?php echo SharedFunctions::get_listingtype($row->user_default_listing_submission_status);?></a></td>

                    </tr>

                    <?php $i++;}        ?>

        </table>


<div class="clear"></div>

        <div style="width:100%;background-color: #fff">
            <?php
            if (isset($_REQUEST['rows'])) {

                $count = $_REQUEST['rows'];

            } else {

                $count = 5;

            }

            ?>

            <div class="view">
                View <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;"
                             tabindex="2" onchange="pagin(this.value);">

                    <option <?php echo ($count == 5) ? 'selected=selected' : ''; ?> value="5">5</option>

                    <option <?php echo ($count == 10) ? 'selected=selected' : ''; ?> value="10">10</option>

                    <option <?php echo ($count == 20) ? 'selected=selected' : ''; ?> value="20">20</option>

                    <option <?php echo ($count == 50) ? 'selected=selected' : ''; ?> value="50">50</option>

                    <option <?php echo ($count == 100) ? 'selected=selected' : ''; ?> value="100">100</option>

                </select>

                <form id="paging" method="post">

                    <?php

                    if (isset($_REQUEST)) {

                        foreach ($_REQUEST as $key => $val) {

                            echo '<input type="hidden" name="' . $key . '" value="' . $val . '" />';

                        }
                    }

                    ?>

                    <input type="hidden" name="rows" id="rows"/>

                </form>
            </div>
            <div style="width:50%;float:right;margin-top: -35px;">
                <!-- Bottom navigation menu -->

                <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '', 'firstPageLabel' => '<', 'prevPageLabel' => 'previous', 'nextPageLabel' => 'next', 'maxButtonCount' => 5, 'lastPageLabel' => '>', 'htmlOptions' => array('name' => 'test', 'id' => 'navlist', 'class' => 'pager'))); ?>

                <!-- /Bottom navigation menu -->
            </div>
        </div>

    </div>

<?php } ?>
<script type="text/javascript">

    function pagin(val) {
        jQuery("#rows").val(val);
        jQuery("#paging").submit();
    }

    function ChangeColorMauve(tableRow, highLight)    {
        if (highLight)            {
            tableRow.style.backgroundColor = '#C9C';
        }
        else
        {
            tableRow.style.backgroundColor = '#EADDED';
        }
    }

    function ChangeColorGrey(tableRow, highLight)    {
        if (highLight)            {
            tableRow.style.backgroundColor = '#C2C2C2';
        }
        else
        {
            tableRow.style.backgroundColor = '#EBEBEB';
        }
    }

    function DoNav(theUrl)
    {
        document.location.href = theUrl;
    }
    jQuery(".chzn-select").chosen();

    jQuery(document).on("click", "#btnclear", function () {
        jQuery('#sl_category').val('');
        jQuery('#user_default_listing_title').val('');
        jQuery('#keyword').val('');
        jQuery('#username').val('');
        jQuery('#listings-form').submit();
    });
</script>
