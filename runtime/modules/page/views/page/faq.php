<style>
a span:hover{color:rgb(165, 70, 134)}
a span{color:rgb(165, 70, 134)}
</style>
<div class="row-fluid-single">
<div class="span8">
<div id="left-content">

<div class="close_caform_faq_single"><a class="button white smallrounded" href="javascript:history.back()" title="Close" >X</a></div>

<div class="page_content">
<div class="faq-page-data">
<p class="linkclass" class="p10 ft9">
	<span class="heading"><span style="font-size:16px;"><?php echo $model->info_title; ?></span></span>
</p>
<?php echo $model->info_content; ?>
<?php
	/*$model=UserSections::model()->findAll();
	foreach($model as $key => $data){
		if($data->title=="Videos"){
			$html="";
			$html.='<p class="linkclass" class="p10 ft9">
					<span class="heading"><span style="font-size:16px;">'.$data->title.'</span></span>
				</p>';
			$m=UserSectioninfo::model()->findAllByAttributes(array("section_id"=>$data->id),array('order'=>'id'));
			foreach($m as $k=>$d){
				$html.= '<p class="infolink" data-id="'.$d->id.'" class="p11 ft10"><a href="'.Yii::app()->createUrl('/page/faq')."?id=".$d->id.'">'.$d->info_title.'</a></p>';
			}
		}else{
			echo '<p class="linkclass" class="p10 ft9">
				<span class="heading"><span style="font-size:16px;">'.$data->title.'</span></span>
			</p>';
			$m=UserSectioninfo::model()->findAllByAttributes(array("section_id"=>$data->id),array('order'=>'id'));
			foreach($m as $k=>$d){
				echo '<p class="infolink" data-id="'.$d->id.'" class="p11 ft10">'.$d->info_title.'</p>';
			}
		}
	}
	echo '<div class="faq-videos">'.$html.'</div>';*/
?>
</div>

<?php //echo $model->desc; ?>
</div>
</div>
</div>
<div class="span4">
</div></div> 
<style>
#left-content a:hover{color:#1dbfd8}
</style>