<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>Edit Section</h3>
</div>

<div class="website-container">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>Section for questions</h2></div>
                <div class="all-sections"></div>
                <form id='section-form' method="post" action="<?php echo Yii::app()->createUrl('/admin/faq/section/edit');?>">
                    <input type="hidden" name="id" value="<?php echo $m->id; ?>">
                    <?php
                        if(isset($m)){
                            echo CHtml::errorSummary($m);
                        } 
                        if(isset($data["success"])){
                            print_r($data["success"]);
                        }
                    ?>
                    <p><input type="text" name="title" class="form-control" placeholder="Section Title" value="<?php echo $m->title; ?>"></p>
                    <p><input type="submit" name="btnupdate" value="Save" class="button black black-btn"></p>
                </form>
            </div>
        </div>
    </div>
</div>