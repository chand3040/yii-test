<?php
$baseUrl = Yii::app()->theme->baseUrl;
$themeurl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($themeurl . '/js/tinymce/tinymce.min.js');
Yii::app()->clientScript->registerCssFile($themeurl . '/css/button.css');

$model = new Listings;
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
    #categorybox .chzn-container  { float: right;
        margin-right: 23px;}
    .chzn-container { float: right;
    }

    #contacttable label { border:none !important; }
    #Listings_user_default_listing_lookingfor_id_chzn {
        width: 137px !important;
    }

    #Listings_user_default_listing_lookingfor_id_chzn .chzn-search, #Listings_user_default_listing_lookingfor_id_chzn .chzn-drop , #Listings_user_default_listing_lookingfor_id_chzn .chzn-search {
        width: 135px!important;
    }
    #Listings_user_default_listing_lookingfor_id_chzn .chzn-search input {
        width: 101px!important;
    }


    #sl_category_chzn {
        width: 140px!important;
    }
    #sl_category_chzn .chzn-search, #sl_category_chzn .chzn-drop , #sl_category_chzn .chzn-search {
        width: 138px!important;
    }
    #sl_category_chzn .chzn-search input {
        width: 104px!important;
    }
</style>
<div class="content-container" id="maindiv">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('_top_menu'); ?>

</div>

<div class="heading">
    <h3>Contact Members</h3>
</div>

<div class="content-container">

    <h2 align="center" class="Blue">Email / Contact Members</h2>

	<span class="warning" id="warning"
        <?php
        if($message == "")
        { ?>
            style="text-align:center;display:none"
            <?php
        }
        ?> ><?php echo $message; ?></span>

    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'contact-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('enctype' => 'multipart/form-data'))); ?>

        <table width="100%" border="0" cellpadding="5" cellspacing="0" id="contacttable">

            <tr>

                <td colspan="4">&nbsp;</td>

            </tr>

            <tr>
                <td width="26%">

                    <label class="companymsg">Member Status :</label>

                    <?php
                    $static = array(
                        'all'     => Yii::t('fim','All'),
                    );
                    $data=CHtml::listData(Profession::model()->findAll(), 'profession_id', 'profession_name');?>

                    <?php echo $form->dropDownList($model,'user_default_listing_category_id',$static + $data, array('prompt' => 'none','tabindex'=>1,'class'=>'chzn-select')); ?>


                </td>

                <td width="25%" id="categorybox">

                    <label class="companymsg">Category :</label>

                    <?php
                    $listData =  CHtml::listData(Listingcategory::model()->findAll(array("order"=>'user_default_listing_category_sort_order asc')),'user_default_listing_category_id','user_default_listing_category_name');
                    echo CHtml::dropDownList('Userlisting[user_default_listing_category_id]',$model->user_default_listing_category_id,$static + $listData,array('empty' => 'none','class'=>'chzn-select','data-placeholder'=>'Please select','onfocus'=>'getSelectNormal("#sl_category");','id'=>'sl_category','tabindex'=>'2','title'=>'Select a category from the drop down menu'));
                    echo $form->error($model,'user_default_listing_category_id');
                    ?>

                </td>

                <td width="21%" id="sectorbox">

                    <label class="companymsg">Sector :</label>

                    <?php
                    $sector = CHtml::listData(ListingProfession::getAll(),'list_profession_id','list_profession_name');
                    echo $form->dropDownList($model,'user_default_listing_lookingfor_id',$static + $sector, array('prompt' => 'none','tabindex'=>3,'class'=>'chzn-select')); ?>
                    <?php echo $form->error($model,'user_default_business_sector'); ?>
                </td>

                <td width="28%"  id="countrybox">

                    <label class="countrymsg">Geolocation :</label>

                    <?php $data=CHtml::listData(Country::model()->findAll(), 'user_default_country_id', 'user_default_country_name');?>

                    <?php echo $form->dropDownList($model,'user_default_profiles_id',$static + $data, array('prompt' => 'none','tabindex'=>4,'class'=>'chzn-select')); ?>


                </td>

            </tr>

            <tr>

                <td colspan="4">&nbsp;</td>

            </tr>

            <tr>

                <td colspan="4" id="contentbox">

                    <?php echo $form->textArea($model, 'user_default_listing_title', array('rows' => 20, 'cols' => 50)); ?>

                </td>

            </tr>

            <tr>

                <td colspan="4">&nbsp;</td>

            </tr>

            <tr>

                <td colspan="4" style="text-align:center"><button type="submit" name="sendmail" class="button black" style="font-size: 20px;" onclick="return form_validation();">Send</button></td>

            </tr>

            <tr>

                <td colspan="4">&nbsp;</td>

            </tr>

        </table>

        <?php $this->endWidget(); ?>
    </div>

</div>

<script type="text/javascript">

    tinymce.init({
        selector: "textarea",
        plugins: ["advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"],
        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        menubar: false,
        toolbar_items_size: 'small',
        style_formats: [{title: 'Bold text', inline: 'b'}, {
            title: 'Red text',
            inline: 'span',
            styles: {color: '#ff0000'}
        }, {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}}, {
            title: 'Example 1',
            inline: 'span',
            classes: 'example1'
        }, {title: 'Example 2', inline: 'span', classes: 'example2'}, {title: 'Table styles'}, {
            title: 'Table row 1',
            selector: 'tr',
            classes: 'tablerow1'
        }],
        setup: function(ed){
            ed.on("blur", function () {
                jQuery("#" + ed.id).val(tinyMCE.activeEditor.getContent());
            });
        },
        templates: [{title: 'Test template 1', content: 'Test 1'}, {title: 'Test template 2', content: 'Test 2'}]
    });


    function form_validation(frm){
        /*remove the error class for financial data*/
        jQuery('.select_error').remove();
        var failedvalidation = false;
        //var regexPattern = /^\d{0,8}(\.\d{1,2})?$/;

        //var regexPattern = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;

        var regexPattern = /^[0-9.,\b]+$/;



        /**	@validation for listing category */
        var status = jQuery('#Listings_user_default_listing_category_id option:selected').val();
        var category = jQuery('#sl_category option:selected').val();
        var sector = jQuery('#Listings_user_default_listing_lookingfor_id option:selected').val();
        var country = jQuery('#Listings_user_default_profiles_id option:selected').val();
        if(status == "" && category == "" && sector == "" && country == ""){
            jQuery(".warning").addClass('mandatoryerror');
            jQuery(".warning").html('Select atleast one option from below.');
            jQuery(".warning").show();
            jQuery(window).scrollTop(100);
            //document.getElementById("maindiv").focus();
            //jQuery("#status").siblings().addClass('mandatoryerror');
            //jQuery("#status").siblings().css('border','1px solid red');
            //var sibling_id = jQuery("#status").siblings().attr('id');
            //jQuery('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
            failedvalidation = true;
        }
        else
        {
            jQuery(".warning").removeClass('mandatoryerror');
            jQuery(".warning").html('');
            jQuery(".warning").hide();
        }

        var content = jQuery('#Listings_user_default_listing_title').val();
        if(content == "")
        {
            jQuery("#contentbox").css('border','1px solid red');
            //jQuery("#contentbox").addClass('mandatoryerror');
            //jQuery("#contentbox").html('Select atleast one option from below.');
            failedvalidation = true;
        }
        else
        {
            jQuery("#contentbox").css('border','none');
        }



        if (failedvalidation){
            return false;
        }else {
        }

    }




    //$(".chzn-select").chosen();
</script>