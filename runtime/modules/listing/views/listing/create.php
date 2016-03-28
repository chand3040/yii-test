<?php
$this->breadcrumbs=array(
	'my profile'=>array('/user/myaccount/update'),
	'manage listings'=>array('/listing'),
	'modify listing - step 1 of 4'
);
?>
<style>
.breadcrumb
{
margin-bottom: 8px;
}
</style>
	<?php
 
 echo $this->renderPartial('_form', array(    'model' => $model));
 
 ?> 