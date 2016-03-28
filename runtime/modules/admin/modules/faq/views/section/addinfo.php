<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>Add Information</h3>
</div>

<div class="website-container remit">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>Information Panel</h2></div>
                <form id='section-form' action="<?php echo Yii::app()->createUrl('/admin/faq/section/addinfo');?>" method="post">
                    <?php
                        if(isset($m)){
                            echo CHtml::errorSummary($m);
                        } 
                        if(isset($data["success"])){
                            print_r($data["success"]);
                        }
                    ?>
                    <p style="text-align:left; display:inline-block;">
                    <select id="sections" name="section_id">
                        <option value="">Select Section</option>
                    <?php
                        $data = UserSections::model()->findAll();
                        foreach($data as $key=>$d){
                            echo "<option value='".$d->id."'>".$d->title."</option>";
                        }
                    ?>
                    </select>
                    </p>
                    <p><input type="text" name="info_title" class="form-control" placeholder="Section Title"></p>
                    <p><textarea id="info_content" name="info_content"></textarea></p>
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
    jQuery("#sections").chosen();
});
</script>