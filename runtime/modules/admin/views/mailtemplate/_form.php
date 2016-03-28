<style>
    .white-bg .userData input[type="text"] {
        width: 98%;
    }

    .userData_btns input[type="submit"] {
        width: 100px !important;
    }

    .userData_btns {
        left: 256px;
        margin-top: 10px;
    }

    h1 {
        display: none
    }

    .breadcrumb {
        display: none
    }

    .gg {
        display: block !important;
    }
</style>
<?php
/* @var $this MailTemplateController */
/* @var $model MailTemplate */
/* @var $form CActiveForm */

$themeurl = Yii::app()->theme->baseUrl;
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($themeurl . '/js/tinymce/tinymce.min.js');
Yii::app()->clientScript->registerCssFile($themeurl . '/css/button.css');
?>
<div class="breadcrumb gg">
    <a href="<?php echo $this->createUrl('/admin/'); ?>">Module Details</a> | <a
        href="<?php echo $this->createUrl('/admin/pages/pages'); ?>">Slider Pages</a> | <a
        href="<?php echo $this->createUrl('/admin/slider/slider/index'); ?>">Slider Module</a> | <a
        href="<?php echo $this->createUrl('/admin/banner/banner/index'); ?>">Default Banners</a> | <a
        href="<?php echo $this->createUrl('/admin/mailtemplate'); ?>" class="navactive">Emails</a>
</div>
<h2 class="module_title"> Site Emails </h2>
<div class="user_listing_search">
    <div class="form">
        <h2 align="center" class="Blue" style="margin:15px 0;"><?php
            if ($model->isNewRecord) {
                echo "Create a new Email template";
            } else {
                echo "Edit Email template";
            } ?></h2><br>

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'mail-template-form',
            'enableAjaxValidation' => false,
            //'action'=>$this->createUrl("/update",array("id"=>$model->template_id)),
        )); ?>

        <!---<p class="note">Fields with <span class="required">*</span> are required.</p>-->

        <div class="userData" style="width:85%">
            <?php echo $form->errorSummary($model); ?>
            <fieldset style="    border: none;">
                <table>
                    <tr height="40">
                        <td><?php echo $form->labelEx($model, 'template_module', array('class' => 'field')); ?></td>
                        <td><?php echo $form->textField($model, 'template_module', array('maxlength' => 255)); ?></td>
                        <?php echo $form->error($model, 'template_module'); ?>
                    </tr>
                    <tr height="40">
                        <td><?php echo $form->labelEx($model, 'template_subject', array('class' => 'field')); ?></td>
                        <td><?php echo $form->textField($model, 'template_subject', array('maxlength' => 255)); ?></td>
                        <?php echo $form->error($model, 'template_subject'); ?>
                    </tr>
                    <tr height="40">
                        <td><?php echo $form->labelEx($model, 'template_body', array('class' => 'field')); ?></td>
                        <td><?php echo $form->textArea($model, 'template_body', array('rows' => 20, 'cols' => 50)); ?></td>
                        <?php echo $form->error($model, 'template_body'); ?>
                    </tr>
                </table>
            </fieldset>
            <br/><br/>

            <div class="userData_btns">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'button update-green', 'style' => 'margin-left:135px;')); ?>
                <a href="<?php echo Yii::app()->createUrl('/admin/mailtemplate/index'); ?>"
                   class="button black">Cancel</a>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="clearBoth"></div>

    </div>
    <!-- form -->
</div>
<script type="text/javascript">tinymce.init({
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
        templates: [{title: 'Test template 1', content: 'Test 1'}, {title: 'Test template 2', content: 'Test 2'}]
    });</script>