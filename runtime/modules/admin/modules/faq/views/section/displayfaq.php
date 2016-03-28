<?php
/* @var $this DefaultController */
?>
<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>FAQs</h3>
</div>

<div class="website-container remit">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>Frequently asked questions</h2></div>
                <div class="faq-sections" style="text-align:center;">
                    <form action="" style="text-align:left; display:inline-block;">
                        <select name="sections" id="sections">
                            <option value="">Select Section</option>
                            <?php
                                $data = UserSections::model()->findAll();
                                foreach($data as $key=>$d){
                                    echo "<option value='$d->id'>$d->title</option>";
                                }
                            ?>
                        </select>
                    </form>
                </div>
                <div class="all-faqs"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $("#sections").on("change", function(){
            var val=$(this).val();
            $.ajax({
                url:"<?php echo Yii::app()->createUrl('/admin/faq/section/getfaqs');?>",
                type:'POST',
                data:{ action:"get_faqs",sec_id:val},
                success: function (data) {
                    $(".all-faqs").html(data);
                }
            });
        });
        jQuery("#sections").chosen();
    });
</script>