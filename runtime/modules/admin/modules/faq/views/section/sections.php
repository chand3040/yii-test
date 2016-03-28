<div class="content-container">
    <?php $this->renderPartial('../layouts/_top_menu'); ?>
</div>
<div class="heading">
    <h3>FAQ Sections</h3>
</div>
<div class="">
    <div class="row">
        <div class="">
            <div class="content-container box-full-area">
                <div class="sub-heading"><h2>Section for questions</h2></div>
                <div class="all-sections">
                    <table class="table table-striped" style="text-align:left;">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                            $data = UserSections::model()->findAll(array("order"=>"id"));
                            foreach($data as $key=>$d){
                                echo "<tr><td>".($key+1)."</td><td>$d->title</td><td><a href='".Yii::app()->createUrl('/admin/faq/section/edit')."?id=".$d->id."'>Edit</a></td><td>".
                                "<a href='".Yii::app()->createUrl('/admin/faq/section/delete')."?id=".$d->id."'>Delete</a></td></tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>