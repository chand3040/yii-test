<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>FAQ Sections</h3>
</div>

<div class="website-container remit">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>Section for questions</h2></div>
                <div class="all-sections"></div>
                <form id='section-form' action="<?php echo Yii::app()->createUrl('/admin/faq/section/create');?>" method="post">
                    <?php
                        if(isset($m)){
                            echo CHtml::errorSummary($m);
                        } 
                        if(isset($data["success"])){
                            print_r($data["success"]);
                        }
                    ?>
                    <p><input type="text" name="title" class="form-control" placeholder="Section Title"></p>
                    <p><input type="submit" name="btnupdate" value="Create" class="button black black-btn"></p>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
    function create_section(){
    }
});
/*jQuery.ajax({
    url: "<?php echo Yii::app()->createUrl('/admin/website/moduledefaults/update');?>",
    type: 'POST',
    data: {WebsiteDefaults: WebsiteDefaults},
    async: false,
    beforeSend: function () {
        statusControl.html('<img class="ajax-loading" src="<?php echo Yii::app()->theme->baseUrl;?>/images/loader2.gif" />');
    },
    success: function (result) {
        location.reload();
    }
});*/
</script>