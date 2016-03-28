<p class="breadcrumb">
    <a href="index.php" >Home</a> &gt; 
    <a href="<?php echo Yii::app()->createUrl('business/myaccount/update');?>"> my profile</a> &gt; 
    <a href="<?php echo Yii::app()->createUrl('businesslisting');?>" title="Goto manage listings menu" > manage business </a>&gt;  select action
</p>
<style>
.inactive h2, .inactive a { color : #8D8F90 !important;}
.active a{color: #00acce;}
</style>
 <div class="clear"></div>
 <div class="registration-box"><!-- registration box start-->
      <div id="registration-tabs"> <a href="javascript:void(0);">My Profile</a>
        <div class="clear"></div>
      </div> 
      <div class="registration-content" style="min-height:580px">
       	 <div class="my-account-links">
          <?php 
            //$this->renderPartial('//../modules/listing/views/layouts/my-account-links');                             
          ?>
          <?php 
          $this->renderPartial("//layouts/my-account-links");      
$userData =Business::model()->findByPk(Yii::app()->user->getId());		  
          ?>
        </div> 
        
        <div style="float:right;">            
            <h1 style="text-align:center;"><?php echo $userData->user_default_business_name; ?> </h1>
            <p Style="text-align:center; color:#808080;"><em>Listing edit menu</em></p>
            <div style="float:right; width:624px;">
                <ul id="sl-front-page" style="height:383px; margin:-18px 0 0 12px;">
				<?php
				
				 $blistCount = Businesslisting::model()->count("user_default_business_id ='".Yii::app()->user->getState('uid')."'"); 
                 if($blistCount<1){  
				 ?>
				 <li class="active">
                        <h2>1. Create a new business listing</h2>
                        <a href="<?php echo Yii::app()->createUrl('businesslisting/create'); ?>"> Select this if you wish to offer your services to our members</a>
                    </li>
					<li class="inactive">
                        <h2>2. Offer samples or prototypes for testing</h2>
                        <a href="#"> You may only submit samples if you have an active listing</a> 
                    </li>
                    <li class="inactive">
                        <h2>3. My downloads</h2>
                        <a href="#"> Offer goodies to attract new business</a> 
                    </li>
                    <li class="inactive">
                        <h2>4. Create / Update a banner advertisement</h2>
                        <a href="#"> A banner advertisement is a very efficient way to draw traffic to your business listing and your business</a> 
                    </li>
                    <li class="inactive">
                        <h2>5. My marketing tools</h2>
                        <a href="#"> If you have an active listing, then use the tools in this section to market your listing to our memebers</a>
                    </li>
                    <li class="inactive">
                        <h2>6. Access marketing data</h2>
                        <a href="#"> Get comprehensive marketing data that will pin point your strengths and weakness</a>
                    </li> 
					<?php
					}
					else
					{
						?>
                    <li  class="active">
                        <h2>1. Modify business listing</h2>
                        <a href="<?php echo Yii::app()->createUrl('businesslisting/create/blistid/'.$model->user_default_business_blid); ?>"> Select this if you wish to offer your services to our members</a>
                    </li>
                    <li >
                        <h2>2. Offer samples or prototypes for testing</h2>
                        <a href="#"> You may only submit samples if you have an active listing</a> 
                    </li>
                    <li>
                        <h2>3. My downloads</h2>
                        <a href="#"> Offer goodies to attract new business</a> 
                    </li>
                    <li >
                        <h2>4. Create / Update a banner advertisement</h2>
                        <a href="#"> A banner advertisement is a very efficient way to draw traffic to your business listing and your business</a> 
                    </li>
                    <li>
                        <h2>5. My marketing tools</h2>
                        <a href="#"> If you have an active listing, then use the tools in this section to market your listing to our memebers</a>
                    </li>
                    <li>
                        <h2>6. Access marketing data</h2>
                        <a href="<?php echo Yii::app()->createUrl('businesslisting/purchaseaccess/blistid/'.$model->user_default_business_blid); ?>"> Get comprehensive marketing data that will pin point your strengths and weakness</a>
                    </li> 
                    <?php } ?>                    
                </ul>
            </div>
        </div>
          
          
       </div>
      <div class="clear"></div>
    </div>