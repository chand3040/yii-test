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
    //jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true});
</script>
<!--<h1 class="cms_page_title">Search For a Listing</h1>-->

<style>
    *:focus {
        outline: none;
    }
</style>
<div class="content-container">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('../layouts/_top_menu'); ?>

</div>

<div class="heading">
    <h3>Slider Module</h3>
</div>

<div class="content-container">

    <h2 align="center" class="Blue">Create a new page </h2>

    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'slider-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('enctype' => 'multipart/form-data'))); ?>

        <!--<div class="sl-basic-info pro-field">

                <label>Slider Title <a class="sl-tip tooltip" href="#;">?<span
                            class="classic">Give your slider a title</span></a></label>
                <?php /*echo $form->textField($model, 'slider_title', array('class' => 'inp width-500', 'id' => 'slider_title', 'style' => 'width:450px', 'onfocus' => "getNormal('#slider_title');")); */ ?>

            </div>-->

        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td width="25%" style="text-align:right;"><label>Slider Title</label>&nbsp;<a class="sl-tip tooltip"
                                                                                              style="text-align: left;"
                                                                                              href="#;">?<span
                            class="classic">Give your slider title</span></a></td>
                <td width="75%">
                    <div class="sl-basic-info pro-field">
                        <?php echo $form->textField($model, 'slider_title', array('class' => 'inp width-500', 'id' => 'slider_title', 'style' => 'height:26px; width:92%;', 'onfocus' => "getNormal('#slider_title');")); ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td width="25%" style="text-align:right;"><label>Controller Name</label>&nbsp;<a class="sl-tip tooltip"
                                                                                                 style="text-align: left;"
                                                                                                 href="#;">?<span
                            class="classic">Give the controller name where this slider to be displayed</span></a></td>
                <td width="75%">
                    <div class="sl-basic-info pro-field">
                        <?php echo $form->textField($model, 'slider_title', array('class' => 'inp width-500', 'id' => 'slider_title', 'style' => 'height:26px; width:92%;', 'onfocus' => "getNormal('#slider_title');")); ?>

                    </div>
                </td>
            </tr>

            <tr>
                <td width="25%" style="text-align:right;"><label>Action Name</label>&nbsp; <a class="sl-tip tooltip"
                                                                                              style="text-align: left;"
                                                                                              href="#;">?<span
                            class="classic">Give the action name of the above controller</span></a></td>
                <td width="75%">
                    <div class="sl-basic-info pro-field">
                        <?php echo $form->textField($model, 'slider_title', array('class' => 'inp width-500', 'id' => 'slider_title', 'style' => 'height:26px; width:92%;', 'onfocus' => "getNormal('#slider_title');")); ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="sl-bottom-buttons admin-button">

                        <button type="submit" class="button blue" style="margin: 0 40px;height: 34px;font-size: 16px;">
                            Create
                        </button>
                        <a style="margin: 0 40px;height: 34px;width: 100px;font-size: 16px;"
                           href="http://localhost/super-market/www/admin/website/slider/index" class="button black">Cancel</a>

                        <div class="clear"></div>

                    </div>
                </td>
            </tr>

        </table>

        <?php $this->endWidget(); ?>
    </div>

</div>

<br/>

<div class="user_listing_search content-container"><br>

    <div>
        <h2 align="center" class="Blue" style="margin:15px 0;">Create / Update Slider Page </h2>

        <div>&nbsp;</div>
        <div>
            <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%"
                   cellpadding="1"
                   cellspacing="2">
                <tr class="tableHeading">
                    <!--<td class="date_column" style="cursor:default; text-align: center; width:50px;" title="Date published">Submitted</td>-->
                    <td class="title_column" style="cursor:default" title="Listing title">Slider Title</td>
                    <td class="title_column" style="cursor:default" title="Listing title">Controller Name</td>
                    <td class="title_column" style="cursor:default" title="Listing title">Action Name</td>
                </tr>
                <?php
                if ($list > 0) {
                    foreach ($list as $row) {
                        if ($i % 2 == 0) {
                            ?>
                            <tr onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('<?php echo Yii::app()->createUrl('admin/website/slider/create/id/' . $row->slider_id); ?>');" class="GreyRow">
                        <?php
                        } else {
                            ?>
                            <tr onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);" onclick="DoNav('<?php echo Yii::app()->createUrl('admin/website/slider/create/id/' . $row->slider_id); ?>');" class="MauveRow">

                        <?php
                        }
                        ?>
                        <td><?php echo $row->slider_title; ?></td>
                        <td><?php
                            $id = $row->page_name;
                            /*
    $page =  Pages::model()->find("pslug = ".$row->page_name);
    echo $page->pname;
    */
                            $connection = Yii::app()->db;
                            $getslider = $connection->createCommand("select * from `user_default_site_actions` where `pslug`='$id'");
                            $sliderresult = $getslider->queryRow();
                            echo $sliderfile = $sliderresult['pname'];
                            ?></td>
                        <td><?php echo $row->page_slug; ?></td>
                        </tr>

                        <?php
                        $i++;
                    }
                }
                ?>
            </table>
            <div class="clear"></div>
            <div id="page_nav" class="art-page-nav">
                <table width="100%" class="sl-select" id="example" border="0">
                    <tr>
                        <td style="cursor: default;" width="2%"
                            title="Select number of records to view from the dropdown menu">View
                        </td>
                        <td width="15%" valign="middle">
                            <?php if (isset($_REQUEST['rows'])) {
                                $count = $_REQUEST['rows'];
                            } else {
                                $count = 10;
                            } ?><select name="drg_category" data-placeholder="12"
                                        class="chzn-select" style="width:60px;"
                                        tabindex="2"
                                        onchange="window.location.href = '?rows='+jQuery(this).val();">
                                <option <?php echo ($count == 10) ? 'selected=selected' : ''; ?> value="10">10
                                </option>
                                <option <?php echo ($count == 20) ? 'selected=selected' : ''; ?> value="20">20
                                </option>
                                <option <?php echo ($count == 50) ? 'selected=selected' : ''; ?> value="50">50
                                </option>
                                <option <?php echo ($count == 100) ? 'selected=selected' : ''; ?> value="100">100
                                </option>
                            </select></td>

                        <td width="30%" valign="middle">
                            <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '', 'firstPageLabel' => '<', 'prevPageLabel' => 'previous', 'nextPageLabel' => 'next', 'maxButtonCount' => 5, 'lastPageLabel' => '>', 'htmlOptions' => array('name' => 'test', 'id' => 'navlist', 'class' => 'pager'))); ?>
                            <ul name="test" id="navlist" class="pager"></ul>
                        </td>
                    </tr>
                    <tr>

                        <td style="text-align: center" colspan="3">
                            <div style="margin-top: -20px">
                                <a
                                    href="<?php echo $this->createUrl('/admin/website/slider/create'); ?>"
                                    class="button blue">+Add New Slider</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- Bottom navigation menu -->
            <!-- /Bottom navigation menu -->
            <div class="clear"></div>

        </div>


        <script language="javascript" type="text/javascript">

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
        </script>