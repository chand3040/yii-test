<?php

/*
 * */
$currController = Yii::app()->controller->id;
$currControllerAction = Yii::app()->controller->action->id; //echo $currController;
?>

<ul class="secondary-top-menu">
    <li>
        <a class="<?php echo ($currController == 'moduledefaults' && $currControllerAction == 'index') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/website/moduledefaults') ?>" title="Module Defaults">Module
            Defaults</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'sitedefaults' && $currControllerAction == 'index') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/website/sitedefaults') ?>" title="Site Defaults">Site Defaults</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'slider' && ($currControllerAction == 'index' || $currControllerAction == 'create')) ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/website/slider') ?>" title="Slider Module">Slider Module</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'defaultbanners' && $currControllerAction == 'index') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/website/defaultbanners') ?>" title="Default Banners">Default
            Banners</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'siteemails' || $currController == 'department' || $currController == 'mailtemplate') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/website/siteemails') ?>" title="Site Emails">Emails</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'faq' || $currController == 'section') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/faq') ?>" title="Support & FAQ's">Support & FAQ's</a>
    </li>
    <li>
        <a class="<?php echo ($currController == 'investors' || $currController == 'default') ? ' active' : '' ?>"
           href="<?php echo $this->createUrl('/admin/investors') ?>" title="Equity Costing">Equity Costing</a>
    </li>
</ul>