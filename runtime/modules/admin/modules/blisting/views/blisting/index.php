<?php
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".chzn-select").chosen();
    });
</script>

<?php $this->renderPartial('application.modules.admin.views.layouts.listing_submenu'); ?>
<div class="heading">
    <h3>Business user listing</h3>
</div>
<div class="searchbar_container">

    <h2 style="text-align:center">

        Business user listing search bar

    </h2>



    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'blistings-form',
        'enableAjaxValidation' => false,
    )); ?>

    <table class="sl-select">
        <tr>
            <td class="listing-col-align" title="Select a category from the dropdown menu">
                Business Sector
            </td>
            <td>
                <?php
                $listData = CHtml::listData(ListingProfession::model()->findAll(array("order" => 'list_profession_name asc')), 'list_profession_name', 'list_profession_name');
                echo CHtml::dropDownList('user_default_business_profession', $_REQUEST['user_default_business_profession'], $listData, array('empty' => 'Please select', 'class' => 'chzn-select', 'data-placeholder' => 'Please select', 'id' => 'sl_profession', 'title' => 'Select a what you are looking for from the list'));
                echo $form->error($model, 'user_default_business_profession');
                ?>
            </td>
            <td class="listing-col-align" title="Select a section from the dropdown menu">Month:
            </td>
            <td>
                <?php
                $months = array('1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July',
                    '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
                echo CHtml::dropDownList('month', $select, $months, array('class' => 'chzn-select', 'empty' => 'Please Select', 'data-placeholder' => 'Please Select'));?>
            </td>
            <td class="listing-col-align" title="Select country from the dropdown menu">Limit
                viewing to:
            </td>
            <td>
                <?php
                if (isset($_POST['user_default_business_viewlimit'])) {
                    $user_default_business_viewlimit = $_REQUEST['user_default_business_viewlimit'];
                } else {
                    $user_default_business_viewlimit = $model->user_default_business_viewlimit;
                }
                $listData = CHtml::listData(Country::model()->findAll(), 'user_default_country_id', 'user_default_country_name');

                echo CHtml::dropDownList('user_default_business_viewlimit', $user_default_business_viewlimit, $listData, array('empty' => 'Worldwide (default)', 'class' => 'chzn-select', 'data-placeholder' => 'Worldwide (default)', 'onfocus' => 'getSelectNormal("#sl_vlimit");', 'id' => 'sl_vlimit', 'tabindex' => '3', 'title' => 'Limit your exposure of your business idea to a country of your choice'));
                echo $form->error($model, 'user_default_business_viewlimit');
                ?>
            </td>
        </tr>
    </table>

    <div class="row">
        <div class="col-1">
            <label>Username:</label> <input type="text" name="username" id="username" style="width: 170px"
                                            value="<?php if (isset($_REQUEST['username'])) {
                                                echo $_REQUEST['username'];
                                            } else {
                                                echo "";
                                            } ?>"/>
        </div>

        <div class="col-3">
            <label>Company</label><input type="text" name="user_default_business_slogon" id="slogon"
                                         style="width: 490px;"
                                         value="<?php if (isset($_REQUEST['user_default_business_slogon'])) {
                                             echo $_REQUEST['user_default_business_slogon'];
                                         } else {
                                             echo "";
                                         } ?>"/>
        </div>
        <div class="col-1">
            <label>Email</label><input type="text" name="Email" id="email" style="width: 273px"
                                       value="<?php if (isset($_REQUEST['Email'])) {
                                           echo $_REQUEST['Email'];
                                       } else {
                                           echo "";
                                       } ?>"/>
        </div>
    </div>
    <div id="blisting-button">
        <span style="margin-right: 250px;"> <input type="reset" name="btnclear" value="Clear" id="btnclear"
                                                   class="button black black-btn"/></span>
        <span><input type="submit" name="btnsubmit" value="Submit" class="button dark-green "/></span>
    </div>

</div>



<?php $this->endWidget(); ?>



<div class="clear">&nbsp;</div>
<?php if (count($list) > 0) { ?>
    <div class="content-container">
        <table class="gernal_table listing-table"
               cellpadding="1" cellspacing="2">
            <tr class="tableHeading">
                <td class="date_column" title="Date of submission">Date</td>
                <td class="username_column" title="Username of member">Username</td>
                <td class="details_column" title="Listing description">Slogon</td>
                <td class="title_column" title="Title of listing">Who We Are</td>
                <td class="details_column" title="Listing description">Offer</td>

            </tr>
            <?php


            foreach ($list as $row) {

                ?>
                <tr <?php if ($i % 2 == 0){ ?>onmouseover="ChangeColorGrey(this, true);"
                    onmouseout="ChangeColorGrey(this, false);" onclick="DoNav('#');"
                    <?php }else{ ?>onmouseover="ChangeColorMauve(this, true);"
                    onmouseout="ChangeColorMauve(this, false);" onclick="DoNav('#');"<?php } ?>
                    class="<?php if ($i % 2 == 0) {
                        echo "GreyRow";
                    } else {
                        echo "MauveRow";
                    } ?>">
                    <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>'">
                        <a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>"><?php $timestamp = strtotime($row->user_default_business_datetime);
                            echo date('d/m/Y', $timestamp); ?></a></td>
                    <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>'">
                        <a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>"><?php $usernames = Business::model()->findByPk($row->user_default_business_id);
                            echo $usernames->user_default_business_username; ?></a></td>
                    <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>'">
                        <a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>"><?php echo substr($row->user_default_business_slogon, 0, 150); ?></a>
                    </td>
                    <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>'">
                        <a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>"><?php echo substr($row->user_default_business_whoweare, 0, 30); ?></a>
                    </td>
                    <td onclick="window.location='<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>'">
                        <a href="<?php echo Yii::app()->createUrl("/admin/blisting/blisting/update", array("id" => $row->user_default_business_blid)); ?>"><?php echo substr($row->user_default_business_offer, 0, 30); ?></a>
                    </td>


                </tr>

                <?php $i++;
            }
            ?>

        </table>
        <div class="clear"></div>
        <div id="page_nav" class="art-page-nav">
            <table class="sl-select" id="example">
                <tr>
                    <td
                        title="Select number of records to view from the dropdown menu">View

                        <?php
                        if (isset($_REQUEST['rows'])) {
                            $count = $_REQUEST['rows'];
                        } else {
                            $count = 5;
                        }

                        ?>
                        <select name="user_default_business_category" data-placeholder="12" id="view"
                                class="chzn-select"
                                style="width:60px;" tabindex="2"
                                onchange="window.location.href = '?rows='+jQuery(this).val();">
                            <option <?php echo ($count == 5) ? 'selected=selected' : ''; ?> value="5">5</option>
                            <option <?php echo ($count == 10) ? 'selected=selected' : ''; ?> value="10">10</option>
                            <option <?php echo ($count == 20) ? 'selected=selected' : ''; ?> value="20">20</option>
                            <option <?php echo ($count == 50) ? 'selected=selected' : ''; ?> value="50">50</option>
                            <option <?php echo ($count == 100) ? 'selected=selected' : ''; ?> value="100">100</option>
                        </select>

                    </td>
                </tr>
            </table>
        </div>


        <!-- Bottom navigation menu -->
        <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '',
                'firstPageLabel' => '<',
                'prevPageLabel' => 'previous',
                'nextPageLabel' => 'next',
                'maxButtonCount' => 5,
                'lastPageLabel' => '>', 'htmlOptions' => array('name' => 'test', 'id' => 'navlist', 'class' => 'pager'))
        ); ?>

        <!-- /Bottom navigation menu -->
        <ul name="test" id="navlist" class="pager"></ul>
        <div class="clear"></div>


        <?php
        $user_name = CHtml::listData(Business::model()->findAll(), 'user_default_business_id', 'user_default_business_name');
        ?>
    </div>
<?php } ?>
</div>
<script type="text/javascript">

    jQuery(document).on("change", "#professionID", function () {
        var sectorValue = this.value;

        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo $this->createUrl('blistingStatistics') ?>",
            type: "POST",
            dataType: 'json',
            data: {
                sectorId: sectorValue
            },
            success: function (resp) {
                jQuery('#janSector').text(resp.janSector);
                jQuery('#janTotalSector').text(resp.janSector);

                jQuery('#fbSector').text(resp.febSector);
                jQuery('#fbTotalSector').text(resp.febSector);

                jQuery('#marSector').text(resp.marSector);
                jQuery('#marTotalSector').text(resp.marSector);

                jQuery('#aprilSector').text(resp.aprilSector);
                jQuery('#aprilTotalSector').text(resp.aprilSector);

                jQuery('#maySector').text(resp.maySector);
                jQuery('#mayTotalSector').text(resp.maySector);

                jQuery('#juneSector').text(resp.juneSector);
                jQuery('#juneTotalSector').text(resp.juneSector);

                jQuery('#julySector').text(resp.julySector);
                jQuery('#julyTotalSector').text(resp.julySector);

                jQuery('#augSector').text(resp.augSector);
                jQuery('#augTotalSector').text(resp.augSector);

                jQuery('#sepSector').text(resp.septSector);
                jQuery('#sepTotalSector').text(resp.septSector);

                jQuery('#octSector').text(resp.octSector);
                jQuery('#octTotalSector').text(resp.octSector);

                jQuery('#novSector').text(resp.novSector);
                jQuery('#novTotalSector').text(resp.novSector);

                jQuery('#decSector').text(resp.decSector);
                jQuery('#decTotalSector').text(resp.decSector);


                var totalSector = parseInt(resp.janSector) + parseInt(resp.febSector) + parseInt(resp.marSector) +
                    parseInt(resp.aprilSector) + parseInt(resp.maySector) + parseInt(resp.juneSector) + parseInt(resp.julySector) + parseInt(resp.augSector) +
                    parseInt(resp.septSector) + parseInt(resp.octSector) + parseInt(resp.novSector) + parseInt(resp.decSector);

                jQuery('#totalSector').text(totalSector);
                jQuery('#totalAllSector').text(totalSector);

                jQuery('#totalToDateSector').text(resp.toDateSector);
                jQuery('#totalAllToDateSector').text(resp.toDateSector);


                jQuery('a#download_csv').attr('href', '<?php echo Yii::app()->baseUrl.'/admin/blisting/blisting/exportBusinessListings/?sectorId=' ?>' + resp.sector);

            },
            complete: function () {
            }
        });


    });
    // Change colour of table row on mouse over
    function ChangeColorMauve(tableRow, highLight) {
        if (highLight) {
            tableRow.style.backgroundColor = '#C9C';
        }
        else {
            tableRow.style.backgroundColor = '#EADDED';
        }
    }

    function ChangeColorGrey(tableRow, highLight) {
        if (highLight) {
            tableRow.style.backgroundColor = '#C2C2C2';
        }
        else {
            tableRow.style.backgroundColor = '#EBEBEB';
        }
    }

    function DoNav(theUrl) {
        document.location.href = theUrl;
    }

    //$(".chzn-select").chosen();

    jQuery(document).on("click", "#btnclear", function () {
        jQuery('#sl_category').val('');
        jQuery('#sl_profession').val('');
        jQuery('#sl_vlimit').val('');
        jQuery('#username').val('');
        jQuery('#slogon').val('');
        jQuery('#email').val('');
        jQuery('#blistings-form').submit();
    });
</script> 
