<?php

/*
 * */
$currController = Yii::app()->controller->id;
$currControllerAction = Yii::app()->controller->action->id; //echo $currControllerAction;
?>

<ul class="secondary-top-menu">
    <li><a class="<?php echo ($currController == 'section' && $currControllerAction == 'index') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/faq') ?>" title="Module Defaults">Sections</a>
    </li>
    <li>
      <a class="<?php echo ($currController == 'section' && $currControllerAction == 'create') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/faq/section/create') ?>" title="Module Defaults">Create Sections</a>
    </li>
    <li>
      <a class="<?php echo ($currController == 'section' && $currControllerAction == 'displayfaq') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/faq/section/displayfaq') ?>" title="Display faq">Display Faq</a>
    </li>
    <li>
      <a class="<?php echo ($currController == 'section' && $currControllerAction == 'addinfo') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/faq/section/addinfo') ?>" title="Add fAQ">Add FAQ</a>
    </li>
    <li>
      <a class="<?php echo ($currController == 'section' && $currControllerAction == 'videos') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/faq/section/videos') ?>" title="Videos">Videos</a>
    </li>
    <li>
      <a class="<?php echo ($currController == 'section' && $currControllerAction == 'addvideo') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/faq/section/addvideo') ?>" title="Add Video">Add Video</a>
    </li>
    <li><a href="<?php echo $this->createUrl('/admin/website') ?>" title="Return to Website">Return</a>
    </li>
</ul>