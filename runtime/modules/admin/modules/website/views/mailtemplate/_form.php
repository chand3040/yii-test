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

    .errorMessage {
        color: #ff0000;
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


<div class="content-container">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('../layouts/_top_menu'); ?>

</div>


<div class="heading">
    <h3>Site Emails</h3>
</div>

<div class="content-container">

    <div align="center">
        <h2 class="Blue" style="margin:5px 0;"><?php
            if ($model->isNewRecord) {
                echo "Create a new MailTemplate";
            } else {
                echo "Edit MailTemplate";
            } ?></h2>
        <br/>
    </div>

    <div class="form">


        <?php $form = $this->beginWidget('CActiveForm', array(

            'id' => 'mail-template-form',

            'enableAjaxValidation' => false,

            //'action'=>$this->createUrl("/update",array("id"=>$model->template_id)),

        )); ?>



        <!---<p class="note">Fields with <span class="required">*</span> are required.</p>-->


        <div class="userData" style="width:100%">

            <?php //echo $form->errorSummary($model); ?>

            <fieldset style="border: none;">

                <table border="0" cellspacing="0" cellpadding="5">

                    <tr>

                        <td><?php echo $form->labelEx($model, 'template_module', array('class' => 'field')); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'template_module', array('size' => '85', 'maxlength' => 255)); ?>
                            <?php echo $form->error($model, 'template_module'); ?>
                        </td>

                    </tr>

                    <tr>

                        <td><?php echo $form->labelEx($model, 'template_subject', array('class' => 'field')); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'template_subject', array('size' => '85', 'maxlength' => 255)); ?>
                            <?php echo $form->error($model, 'template_subject'); ?>
                        </td>


                    </tr>

                    <tr>

                        <td valign="top"><?php echo $form->labelEx($model, 'template_body', array('class' => 'field')); ?></td>
                        <td>
                            <?php echo $form->textArea($model, 'template_body', array('rows' => 20, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'template_body'); ?>
                        </td>


                    </tr>

                </table>

            </fieldset>

            <br/><br/>

            <div class="userData_btns">
               <span style="margin-left: 20%;"> <a href="<?php echo Yii::app()->createUrl('/admin/website/siteemails/delete',array('id'=>$model->template_id)); ?>" title="Delete"
                   class="button red">Delete</a></span>
              <span style="margin-left: 14%"> <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'button update-green')); ?></span>

               <span style="margin-left: 12%"><a href="<?php echo Yii::app()->createUrl('/admin/website/siteemails'); ?>" title="Back to list"
                   class="button black">Back to list</a></span>
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