<style>
    .col-2{
        width: 28.33%
    }
    th{
        text-align: center;
    }
    tr:nth-child(even){
        background: #E3D6E9;
    }
    tr:nth-child(odd){
        background: #E6E6E7;
    }
    th{
        background: #00ACCD;
        color: #ffffff;
    }
</style>
<?php
$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');
$js->registerScriptFile($baseUrl . '/js/jwplayer/jwplayer.js');
$js->registerScriptFile($baseUrl . '/js/tinymce.min.js');
$totalConsumers = 0;
$totalBusinessOwners = 0;
$totalBusinessUsers = 0;
$totalEntrepreneurs = 0;
$totalOther = 0;
$totalAll = 0;
$totalOnline = 0;

function user_status($var){
    switch ($var) {
        case '0':
            return "Not active";
            break;
        case '1':
            return "Active";
            break;
        case '2':
            return "Suspended";
            break;
        
        default:
            return "";
            break;
    }
}
?>
<div style="width:100%">
<?php $this->renderPartial("/layouts/sub_menu"); ?>

<div class="heading">
    <h3>New Listing Submissions</h3>
</div>

<?php  if(count($list) > 0){?>
<div class="content-container">
    <div style="text-align:center;"><h2>Search result</h2></div>
        <table cellpadding="5" width="100%" style="text-align:center;">
            <thead style="background:#00ACCD; color:#ffffff;">
            <!-- <tr class="tableHeading"> -->
            <tr style="background:#00ACCD; color:#ffffff;">
                <td class="date_column" title="Date of submission">Date</td>
                <td class="username_column" title="Username of member">Username</td>
                <td class="title_column" title="Title of listing">Title</td>
                <td class="details_column"title="Listing description">Description</td>
                <td class="details_column"title="Listing type">Listing Type</td>
                <td class="details_column"title="Listing description">Listing Status</td>
            </tr>
            </thead>
            <tbody>
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
            </tbody>
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
                <span style="position: relative; display: block; float: left; margin-top:6px; margin-right:10px;">View</span>
                <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;"
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
<?php }else{ ?>
<div class="content-container">
<table cellpadding="5" width="100%" style="text-align:center;">
    <thead style="background:#00ACCD; color:#ffffff;">
        <tr>
            <th>Date</th>
            <th>Username</th>
            <th>Email</th>
            <th>Country</th>
            <th>User Status</th>
            <th>User Type</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            //print_r($model);
            foreach($model as $data){
                $user=User::model()->findByPK($data->user_default_profiles_id);
                $country=Country::model()->findByPK($user->user_default_country);
                echo "<tr>";
                echo '<td><a target="_blank" href="'.Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->user_default_listing_id)).'">'.$data->user_default_listing_date."</a></td>";
                echo '<td><a target="_blank" href="'.Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->user_default_listing_id)).'">'.$user->user_default_username."</a></td>";
                echo '<td><a target="_blank" href="'.Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->user_default_listing_id)).'">'.$user->user_default_email."</a></td>";
                echo '<td><a target="_blank" href="'.Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->user_default_listing_id)).'">'.$country->user_default_country_name."</a></td>";
                echo '<td><a target="_blank" href="'.Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->user_default_listing_id)).'">'.user_status($user->user_default_account_status)."</a></td>";
                echo '<td><a target="_blank" href="'.Yii::app()->createUrl("/admin/listings/listings/update",array("id"=>$data->user_default_listing_id)).'">'.$user->user_default_type."</a></td>";
                echo "</tr>";
            }
        ?>

    </tbody>
</table>
<select class="table-view">
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="75">75</option>
    <option value="100">100</option>
</select>
</div>
<?php } ?>

</div>

<!-- <div class="content-container"> -->
<div style="clear:both;">&nbsp;</div>
<div class="searchbar_container" style="margin-top: -4px;">
    <div style="text-align:center;"><h2>New user listing search bar</h2></div>
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'listings-form', 'enableAjaxValidation' => false, 'method' => 'post')); ?>
    <table class="sl-select">
        <tr>
            <td style="text-align: right; cursor: default;" title="Select a category from the dropdown menu">Category:</td>
            <td>
                <?php
                $listData =  CHtml::listData(Listingcategory::model()->findAll(),'user_default_listing_category_id','user_default_listing_category_name');
                echo CHtml::dropDownList('user_default_listing_category_id',$_REQUEST['user_default_listing_category_id'],$listData,array('prompt' => 'Please Select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'sl_category'));
                //echo $form->error(@$model,'user_default_listing_category_id');
                ?>
            </td>
            <td style="text-align: right; cursor:default;" title="Select a section from the dropdown menu">Looking For:</td>
            <td>
                <?php
                $listData =  CHtml::listData(Listinglookingfor::model()->findAll(array("order"=>'user_default_listing_lookingfor_sort_order asc')),'user_default_listing_lookingfor_id','user_default_listing_lookingfor_name');
                echo CHtml::dropDownList('user_default_listing_lookingfor_id',$_REQUEST['user_default_listing_lookingfor_id'],$listData,array('empty' => 'Please select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'sl_profession','title'=>'Select a what you are looking for from the list'));
                //echo $form->error($model,'user_default_listing_lookingfor_id');
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
                //echo $form->error($model,'user_default_listing_limit_viewing_id');
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
    
<!-- </div> -->

<script>
    jQuery("tr").css({"border-bottom":"1px solid #000000"});
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