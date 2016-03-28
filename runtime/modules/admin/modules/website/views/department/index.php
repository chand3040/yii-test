<?php
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
?>

<style>

    ul#navlist.pager {
        margin-top: 10px !important;
    }

</style>
<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery(".chzn-select").chosen();
    });
    //jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true});
</script>
<!--<h1 class="cms_page_title">Search For a Listing</h1>-->

<div class="user_listing_search content-container">

    <div align="center">
        <h2 class="Blue" style="margin:5px 0;">Add / Update Departments</h2>
    </div>

    <table class="gernal_table manageListing" border="0" bordercolor="#fff" style="" width="50%" cellpadding="1"
           cellspacing="2">
        <tr class="tableHeading">
            <!--<td class="date_column" style="cursor:default; text-align: center; width:50px;" title="Date published">Submitted</td>-->
            <td class="title_column" style="cursor:default" title="Listing title">Department Name</td>
            <td class="title_column" style="cursor:default" title="Listing title">Department Email ID</td>
        </tr>
        <?php
        if ($list > 0) {
            foreach ($list as $row) {
                if ($i % 2 == 0) {
                    ?>
                    <tr onmouseover="ChangeColorGrey(this, true);" onmouseout="ChangeColorGrey(this, false);"  onclick="DoNav('<?php echo Yii::app()->createUrl('admin/website/department/create/id/' . $row->dept_id); ?>');" class="GreyRow">
                <?php
                } else {
                    ?>
                    <tr onmouseover="ChangeColorMauve(this, true);" onmouseout="ChangeColorMauve(this, false);" onclick="DoNav('<?php echo Yii::app()->createUrl('admin/website/department/create/id/' . $row->dept_id); ?>');" class="MauveRow">

                <?php
                }
                ?>
                <td><?php echo $row->dept_name; ?></td>
                <td><?php echo $row->dept_email; ?></td>
                </tr>

                <?php
                $i++;
            }
        }
        ?>
    </table>

    <div id="page_nav" class="art-page-nav">
        <table width="100%" class="sl-select" id="example" border="0">
            <tr>
                <td style="cursor: default;" width="2%"
                    title="Select number of records to view from the dropdown menu">View
                </td>
                <td width="30%" valign="middle">
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
                        <a href="<?php echo $this->createUrl('/admin/website/department/create'); ?>"
                           class="button black">+Add</a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
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