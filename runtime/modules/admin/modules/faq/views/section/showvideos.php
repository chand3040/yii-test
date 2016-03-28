<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>Videos Sections</h3>
</div>
<div class="">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>List of videos</h2></div>
                <div class="all-sections">
                    <table class="table table-striped" style="text-align:left;">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                            if($model){
                                foreach($model as $key=>$d){
                                    echo "<tr><td>".($key+1)."</td><td>$d->title</td><td><a href='".Yii::app()->createUrl('/admin/faq/section/editvideo')."?id=".$d->id."'>Edit</a></td><td>".
                                    "<a href='".Yii::app()->createUrl('/admin/faq/section/deletevideo')."?id=".$d->id."'>Delete</a></td></tr>";
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>