<?php
/* @var $this DefaultController */
?>
<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>Edit FAQ</h3>
</div>

<div class="website-container remit">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>Edit Panel</h2></div>
                <form id='section-form' action="<?php echo Yii::app()->createUrl('/admin/faq/section/editfaq');?>" method="post">
                    <?php
                        if(isset($m)){
                            echo CHtml::errorSummary($m);
                        } 
                        if(isset($data["success"])){
                            print_r($data["success"]);
                        }
                    ?>
                    <input type="hidden" name="id" value="<?php echo @$m->id; ?>">
                    <input type="hidden" name="section_id" value="<?php echo @$m->section_id; ?>">
                    <p><input type="text" name="info_title" class="form-control" value="<?php echo @$m->info_title; ?>" placeholder="Section Title"></p>
                    <p><textarea id="info_content" name="info_content"><?php echo @$m->info_content; ?></textarea></p>
                    <p><input type="submit" name="submit" value="Save" class="button black black-btn"></p>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
    tinymce.init({
      selector: 'textarea',
      height: 400,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons',
      image_advtab: true,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
      ]
     });
});
</script>