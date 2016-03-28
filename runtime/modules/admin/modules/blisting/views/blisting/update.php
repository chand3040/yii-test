<?php /*<h1 class="cms_page_title">Admin Business listing preview</h1> */ ?>
<?php
/*$this->breadcrumbs=array(
	' Search for a Business listing '=>array('./blisting'),'Business Listing'." - ".SharedFunctions::get_user_names($model['user_default_business_id']) ,	 
);*/
?>
<?php /*<div class="user_info_container">
        <ul>
          <li><?php echo SharedFunctions::get_user_names($row->user_default_business_id);?>
            <label class="field">Registered users:</label>
            <strong><?php 	echo 	Business::model()->count(); ?></strong></li>
          <li>
            <label class="field">Users Online:</label>
           <strong><?php 	echo 	Blisting::model()->count(); ?></strong></li>
          <li>
            <label class="field">Business Listing submissions:</label>
       <strong><?php 	echo 	Blisting::model()->count(); ?></strong></li>
          <li>
            <label class="field">Active Business listings:</label>
               <strong><?php
 echo    $count = Blisting::model()->count( 'user_default_business_lstatus=:userid', array(':userid' => 1));
 ?></strong></li>
        </ul>
</div>*/
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>

