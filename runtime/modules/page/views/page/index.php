<style>
a span:hover{color:rgb(165, 70, 134)}
a span{color:rgb(165, 70, 134)}
</style>
<div>
<div class="span8">
<div id="left-content">
 <?php $this->breadcrumbs = array("$model->title"); ?>

<?php if($model->page_seo == 'faq'){

	if(Yii::app()->request->urlReferrer)
	$returnUrl = Yii::app()->request->urlReferrer;
else
	$returnUrl = $this->createUrl('/');
?>
    <br />
    <br />
<div class="close_caform_faq"><a class="button white smallrounded" href="<?php echo $returnUrl;?>" title="Close" >X</a></div>
<?php } ?>
<div class="page_content">
<?php if($model->page_seo == 'faq'){?>
<p class="p8 ft7" style="color: rgb(165, 70, 134);  text-align: left; margin-top: 9px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
	<strong><span style="font-size:18px;">Browse By Topic</span></strong></p>
<p class="p9 ft8" style=" color: rgb(35, 31, 32);  text-align: left; margin-top: 2px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
	Last Updated:<?php echo gmdate('d/m/Y H:i A', $model->created_date);?> GMT</p><hr />
<?php } ?>

<div class="faq-page-data">
<?php
	$model=UserSections::model()->findAll();
	echo "<div class='faq-sections'>";
	foreach($model as $key => $data){
		echo '<p class="linkclass" class="p10 ft9">
			<span class="heading"><span style="font-size:16px;">'.$data->title.'</span></span>
		</p>';
		$m=UserSectioninfo::model()->findAllByAttributes(array("section_id"=>$data->id),array('order'=>'id'));
		foreach($m as $k=>$d){
			echo '<p class="infolink" data-id="'.$d->id.'" class="p11 ft10"><a href="'.Yii::app()->createUrl('/page/faq')."?id=".$d->id.'">'.$d->info_title.'</a></p>';
		}
	}
	echo '</div>';
	$html="";
	$html.='<p class="linkclass" class="p10 ft9">
			<span class="heading"><span style="font-size:16px;">Videos</span></span>
		</p>';
	$md=UserSectionvideos::model()->findAll(array('order'=>'id'));
	foreach($md as $k=>$d){
		$html.= '<p class="infolink" class="p11 ft10"><a href="javascript:void(0)" data-link="'.$d->video_url.'">'.$d->title.'</a></p>';
	}
	echo '<div class="faq-videos">'.$html.'</div>';
?>
<a href="javascript:void(0);" class="video_inks" data-link="https://www.youtube.com/embed/CKIqz08O7MI">Test Link</a>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$(".infolink a").on("click", function(){
			show_video($(this).data("link"));
		});
	});
</script>
<?php //echo $model->desc; ?>
</div>
</div>
</div>
<div class="span4">
</div></div> 
<?php 
if($model->page_seo='faq')
{?>
<style>
#left-content a:hover{color:#1dbfd8}
</style>
<?php }
?>