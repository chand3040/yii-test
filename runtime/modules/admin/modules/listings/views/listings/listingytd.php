<style>
    .col-2{
        width: 28.33%
    }
    .tablecontainer th{
        text-align: center;
    }
    .tablecontainer td:nth-child(even),.tablecontainer th:nth-child(even){
        background: #E6E6E7;
    }
    .tablecontainer tr:nth-child(even){
        background: #E3D6E9;
    }
    .tablecontainer tr:nth-child(even) > td:nth-child(even){
        background: #E3D6E9;
    }
    .tablecontainer td:not(:first-child){
        text-align: center;
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
    <h3>Listing YTD Snapshot</h3>
</div>

<div class="content-container tablecontainer">
    <table cellpadding="7" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Aug</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
                <th>Total for year</th>
                <th>Total to date</th>
                <th>Active Listings</th>
            </tr>
        </thead>
        <tbody>
    <?php
        $types=Listingcategory::model()->findAll();
        $totalforyeartotal=0;
        foreach ($types as $type) {
        $totalforyear=0;
        ?>
            <tr>
                <td><?php echo $type["user_default_listing_category_name"]; ?></td>
                <?php for($i=1;$i<=12;$i++){ ?>
                    <td>
                        <?php
                            $sql  = "SELECT user_default_listing_category_id FROM user_default_listing WHERE DATE_FORMAT(user_default_listing_date,'%m') = '$i' && DATE_FORMAT(user_default_listing_date,'%Y') = '".date("Y")."' && user_default_listing_category_id='".$type["user_default_listing_category_id"]."'";
                            $data = Yii::app()->db->createCommand($sql)->queryAll();
                            echo $count=count($data);
                            $totalforyear+=$count;
                            if($count){
                                ${"row".$i}+=$count;
                            }
                        ?>
                    </td>
                <?php } ?>
                <td><?php echo $totalforyear;$totalforyeartotal+=$totalforyear; ?></td>
                <td><?php echo $row1; ?></td>
                <td>
                    <?php
                        $sql1  = "SELECT user_default_listing_category_id FROM user_default_listing WHERE  DATE_FORMAT(user_default_listing_date,'%Y') = '".date("Y")."' && user_default_listing_category_id='".$type["user_default_listing_category_id"]."' && user_default_listing_submission_status=1";
                        $data1 = Yii::app()->db->createCommand($sql)->queryAll();
                        echo $count=count($data1);
                    ?>
                </td>
            </tr>

            <?php //print_r($type["user_default_listing_category_id"]." ".$type["user_default_listing_category_name"]); echo "<br />"; ?>
            <?php //$data=Listings::model()->findAllByAttributes(array("user_default_listing_category_id"=>$type["user_default_listing_category_id"])); print_r($data); ?>
        <?php  
        } ?>
        <tr>
            <td>Total for Month</td>
            <td><?php echo ($row1)? $row1:"0"; ?></td>
            <td><?php echo ($row2)? $row2:"0"; ?></td>
            <td><?php echo ($row3)? $row3:"0"; ?></td>
            <td><?php echo ($row4)? $row4:"0"; ?></td>
            <td><?php echo ($row5)? $row5:"0"; ?></td>
            <td><?php echo ($row6)? $row6:"0"; ?></td>
            <td><?php echo ($row7)? $row7:"0"; ?></td>
            <td><?php echo ($row8)? $row8:"0"; ?></td>
            <td><?php echo ($row9)? $row9:"0"; ?></td>
            <td><?php echo ($row10)? $row10:"0"; ?></td>
            <td><?php echo ($row11)? $row11:"0"; ?></td>
            <td><?php echo ($row12)? $row12:"0"; ?></td>
            <td><?php echo $totalforyeartotal; ?></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>

</div>

<!-- <div class="content-container"> -->
<div style="clear:both;">&nbsp;</div>
<div class="searchbar_container" style="margin-top: -4px;">
    <div style="text-align:center;"><h2>Listing search</h2></div>
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
            <!-- <td style="text-align: right; cursor:default;" title="Select a section from the dropdown menu">Looking For:</td>
            <td>
                <?php
                //$listData =  CHtml::listData(Listinglookingfor::model()->findAll(array("order"=>'user_default_listing_lookingfor_sort_order asc')),'user_default_listing_lookingfor_id','user_default_listing_lookingfor_name');
                //echo CHtml::dropDownList('user_default_listing_lookingfor_id',$_REQUEST['user_default_listing_lookingfor_id'],$listData,array('empty' => 'Please select','class'=>'chzn-select','data-placeholder'=>'Please select','id'=>'sl_profession','title'=>'Select a what you are looking for from the list'));
                //echo $form->error($model,'user_default_listing_lookingfor_id');
                ?>
            </td> -->
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