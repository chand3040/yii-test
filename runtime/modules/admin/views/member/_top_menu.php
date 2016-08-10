<?php

/*
 * */
$currController = Yii::app()->controller->id;
$currControllerAction = Yii::app()->controller->action->id; //echo $currControllerAction;
?>

<ul class="secondary-top-menu">
    <li>
        <a class="<?php echo ($currController == 'member' && ($currControllerAction == 'newusers' || $currControllerAction == 'newUsers')) ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('newUsers') ?>" title="New Registrations">New Registrations</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'member' && $currControllerAction == 'defaultusers') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('defaultUsers') ?>" title="Default Users">Default Users</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'member' && $currControllerAction == 'newbusinessusers') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('newBusinessUsers') ?>" title="New Business Users">New Business
            Users</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'member' && $currControllerAction == 'businessusers') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('businessUsers') ?>" title="Business Users">Business Users</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'member' && $currControllerAction == 'contact') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('contact') ?>" title="Business Users">Contact Members</a>
    </li>
</ul>