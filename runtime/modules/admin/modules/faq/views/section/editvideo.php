<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>FAQ Videos</h3>
</div>

<div class="website-container remit">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>Edit video to faq</h2></div>
                <div class="all-sections"></div>
                <form id='section-form' enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('/admin/faq/section/editvideo');?>" method="post">
                    <?php
                        if(isset($m)){
                            echo CHtml::errorSummary($m);
                        } 
                        if(isset($data["success"])){
                            print_r($data["success"]);
                        }
                        if(isset($error) && strlen($error)>0){
                            echo $error;
                        }
                    ?>
                    <p><input type="hidden" name="action" value="edit"></p>
                    <p><input type="hidden" name="id" value="<?php echo @$model->id; ?>"></p>
                    <p><input type="text" name="title" class="form-control" value="<?php echo @$model->title; ?>" placeholder="Title"></p>
                    <p><input type="file" name="video_url" class="form-control" placeholder="Section Video"></p>
                    <p><input type="submit" name="submit" value="Save" class="button black black-btn"></p>
                </form>
            </div>
        </div>
    </div>
</div>