
        <!-- Loads home slider -->
        <!-- /#dragongallery /.stepcarousel -->
        <p class="breadcrumb"><a href="index.php" >Home</a> &gt; my account &gt; Create Business Listing &gt; step 1 of 2</p>
        <!-- Where business meets invention -->
        <!-- /main-content -->
        <div class="clear"></div>
		  <div>
            <?php
             $this->renderPartial('//../modules/listing/views/layouts/listing_slider');
            ?>
        </div>
		<div style="clear:both;"></div>
        <div class="registration-box">
            <!-- registration box start-->
            <div class="close_caform">
            <!--<a class="button white smallrounded" href="<?php echo Yii::app()->createUrl('myaccount/update')?>" title="Close" >X</a>-->

            </div>
            <div id="registration-tabs"> <a href="javascript:void(0);">My account</a>
                <div class="clear"></div>
            </div>
		     <div class="registration-content" style="min-height:571px">
             <a class="pu-close pu-close-step2 pu-close1" href="javascript:void(0);" title="Close">X</a>

				<!--- Confirm close pop up---->
                <div class="confirm listingpage" style="width: 98%; height: 95%;">
                  <div class="u-email-box">
                  	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/robot/Robot-pointing-down.png" style="z-index:999999; position:relative; top:2px;" />
                    <div class="my-account-popup-box" style="margin-top:-38px !important">
                      <a title="Close" href="javaScript:void(0)" onclick="close_form()" class="pu-close">X</a>
                      <br />
                      <h2 class="Blue">Are you sure you want to leave this page?</h2>
                      <p>You form data has not been saved  leaving the listing submission process now will result in any data you have submitted being lost.<br /> Please save your listing first.</p>
                      <table align="center" width="100%">
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                      	<tr>
                      	<td align="center">
                            <input class="button black" title="Close and return to form" name="cancle" type="button" value="Cancel"  onclick="jQuery('.confirm').hide('slow');"/>
                            <input class="button black" title="Save and close form" name="register" type="button" value="Save & Close"  onclick="saveforlater();" />
                            <input class="button black" title="Discard ALL data and close form" onclick="saveforlater();" name="register" type="button" value="Discard"  />
                        </td>
                      </tr>
                      </table>
                    </div>
                  </div>
                </div>
               	<!--- Confirm close pop up---->

                <h2 align="center" class="Blue">Create a business services listing</h2>

         		<div style="text-align:center"><i style="font-size:7pt; color:#999999">Tell our members about your business</i></div>
				 <?php /*?><form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" id="business_listing_step1" ><?php */?>
                 <?php $form=$this->beginWidget('CActiveForm', array('id'=>'businesslisting-form','enableAjaxValidation'=>false, 'htmlOptions'=>array('onSubmit'=>'return form_validation();')));
				     echo $form->hiddenField($model,'user_default_business_blid',array('size'=>60,'maxlength'=>100));
                     if($model->isNewRecord){
                       $modelData = Business::model()->find("user_default_business_id = '".Yii::app()->user->getState('uid')."'");
                     }
				  ?>
                   <input type="hidden" name="btnsaveforlater" value="0" id="btnsaveforlater" />
				<div>
					<label style="color:#A47A8F;">Listing type <a class="sl-tip tooltip" href="#;">?<span class="classic">Please select a profession and exposure level from the drop down menus to continue</span></a></label>
				</div>
				<div>
					<table class="sl-select" style="width: 742px; margin-top:10px;">
					<tr class="select-listing business-listing">
						<td>Category:</td>
						<td>
                            <?php
								/*$data = CHtml::listData(Listingcategory::model()->findAll(),'list_category_id','list_category_name');
								echo $form->dropDownList($model,'user_default_business_category',$data, array('prompt' => 'Please Select','class'=>'chzn-select','tabindex'=>'1','data-placeholder'=>'Please select','onfocus'=>'getSelectNormal("#sl_category");','id'=>'sl_category'));
								echo $form->error($model,'user_default_business_category');*/
                            echo $form->textField($model,'user_default_business_category',array('readonly'=>'true','id'=>'sl_category','class'=>"static_textbox",'tabindex'=>1,'value'=>'Services','size'=>'25','onfocus'=>'getSelectNormal("#sl_category");'));
							?>

						</td>
					  	<td class="sl-select-space"></td>
					  	<td>Sector:</td>
					  	<td>
					  		 <?php
							 	/*$data = CHtml::listData(Profession::model()->findAll(), 'profession_id', 'user_default_business_profession');
							  echo $form->dropDownList($model,'user_default_business_profession',$data, array('prompt' => 'Please Select','class'=>'chzn-select','tabindex'=>'2','data-placeholder'=>'Please select','onfocus'=>'getSelectNormal("#sl_profession");','id'=>'sl_profession')); ?>
                              echo $form->error($model,'user_default_business_profession'); */?>

                            <?php echo $form->textField($model,'user_default_business_profession',array('readonly'=>'true','id'=>'sl_profession','class'=>"static_textbox",'tabindex'=>2,'value'=>ListingProfession::model()->findByPk($userData['user_default_business_sector'])->list_profession_name,'size'=>'25','onfocus'=>'getSelectNormal("#sl_profession");')); ?>
						</td>
					  	<td class="sl-select-space"></td>
					 	<td>Limit viewing to:</td>
					  	<td>
                        <?php
							$viewlimit = CHtml::listData(Country::model()->findAll(),'user_default_country_id','user_default_country_name');
							echo $form->dropDownList($model,'user_default_business_viewlimit',$viewlimit,array('prompt' => 'Worldwide (default)','class'=>'chzn-select','tabindex'=>'3','data-placeholder'=>'Worldwide (default)','onfocus'=>'getSelectNormal("#sl_vlimit");','id'=>'sl_vlimit'));
							echo $form->error($model,'user_default_business_viewlimit');
						?>

						</td>
					</tr>
					</table>
				</div>
				<div style="clear:both; height:20px;"></div>
				<div class="sl-basic-info">
					
					<label>Company Name <a href="#;" class="sl-tip tooltip">?<span class="classic">Enter your company name.</span></a></label>
					<br>
                    <?php if($modelNew->user_default_business_title)
					{
						 echo CHtml::textField('Businesslisting[user_default_business_title]', $modelNew->user_default_business_title,array('id'=>'slogon','class'=>'inp textarea-full','tabindex'=>4,'value'=>$model_user->user_default_business_title));
					}
					else
					{
					   if($model->user_default_business_title){
					       $slogan = $model->user_default_business_title;
					   }else {
					       $slogan = $modelData->user_default_business_name;
					   }
						echo $form->textField($model,'user_default_business_title',array('size'=>60,'maxlength'=>500,'id'=>'slogon','class'=>"inp textarea-full",'tabindex'=>4,'value'=>$slogan));
					}
						//echo $form->error($model,'user_default_business_slogon');
					?>
					<br>
					
<label>Company slogon <a href="#;" class="sl-tip tooltip">?<span class="classic">Enter your business slogan.</span></a></label>
					<br>
                    <?php if($modelNew->user_default_business_slogon)
					{
						 echo CHtml::textField('Businesslisting[user_default_business_slogon]', $modelNew->user_default_business_slogon,array('id'=>'slogon','class'=>'inp textarea-full','tabindex'=>4,'value'=>$model_user->user_default_business_slogon));
					}
					else
					{
					   if($model->user_default_business_slogon){
					       $slogan = $model->user_default_business_slogon;
					   }else {
					       $slogan = $modelData->user_default_business_slogon;
					   }
						echo $form->textField($model,'user_default_business_slogon',array('size'=>60,'maxlength'=>500,'id'=>'slogon','class'=>"inp textarea-full",'tabindex'=>4,'value'=>$slogan));
					}
						//echo $form->error($model,'user_default_business_slogon');
					?>
					<br>
					 <label>Enter a short explanation of what does it do or what problem does it solve.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter a short explanation of your business idea or product in 1 to 2 sentences for example:-<br><em style="font-size:0.9em; color:#A84793">'A security system that uses patent protected stinger system to immobilise any vehicle by using a controlled deflation of the rear wheels.<br> The offending vehicle will come to rest at a known distance  from the point of theft.'.</em></span></a></label>

                     <?php
					 
					 echo $form->error($model,'user_default_business_summary');
					 
					 	if($modelNew->user_default_business_summary)
						{
							echo $form->textArea('Businesslisting[user_default_business_summary]', $modelNew->user_default_business_summary,array('size'=>60,'id'=>'offer','class'=>'textarea-full','style'=>'height:70px','tabindex'=>5,'maxlength'=>270));
						}
						else
						{
                        	echo $form->textArea($model,'user_default_business_summary',array('size'=>60,'id'=>'offer','class'=>'textarea-full','style'=>'height:70px','tabindex'=>5,'maxlength'=>270));    
						}


                     ?>
					
					<br>
					<label>Who we are<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter full details of your business activities, services, history etc.</span></a></label>
					<br>
                     <?php
					  echo $form->error($model,'user_default_business_whoweare');
					  
					 if($modelNew->user_default_business_whoweare)
					 {
                        echo $form->textArea('Businesslisting[user_default_business_whoweare]',$modelNew->user_default_business_whoweare,array('size'=>60,'id'=>'whoweare','class'=>'inp textarea-full','style'=>'height:196px','tabindex'=>6));
					 }else
					 {
						echo $form->textArea($model,'user_default_business_whoweare',array('size'=>60,'id'=>'whoweare','class'=>'inp textarea-full','style'=>'height:196px','tabindex'=>6));
					 }
					           
                     ?>
				</div>
				 <div class="sl-basic-info">
					 <label>What we offer.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter details of what your business has to offer including any special offers to new businesses.</span></a></label>

                     <?php
					 
					 echo $form->error($model,'user_default_business_offer');
					 
					 	if($modelNew->user_default_business_offer)
						{
							echo $form->textArea('Businesslisting[user_default_business_offer]', $modelNew->user_default_business_offer,array('size'=>60,'id'=>'offer','class'=>'textarea-full','style'=>'height:70px','tabindex'=>7));
						}
						else
						{
                        	echo $form->textArea($model,'user_default_business_offer',array('size'=>60,'id'=>'offer','class'=>'textarea-full','style'=>'height:70px','tabindex'=>7));                    }
							


                     ?>
				 </div>
                 <div class="sl-basic-info">
                     <label>What we can do for you.<a href="#;" class="sl-tip tooltip">?<span class="classic">Enter details of any services that your business has to offer our members.</span></a></label>

                     <?php
					 
					 echo $form->error($model,'user_default_business_whatwecando');
					 
                     if($modelNew->user_default_business_whatwecando)
                     {
                         echo $form->textArea('Businesslisting[user_default_business_whatwecando]', $modelNew->user_default_business_whatwecando,array('size'=>60,'id'=>'whatwecando','class'=>'textarea-full','style'=>'height:70px','tabindex'=>8));
                     }
                     else
                     {
                         echo $form->textArea($model,'user_default_business_whatwecando',array('size'=>60,'id'=>'whatwecando','class'=>'textarea-full','style'=>'height:70px','tabindex'=>8));
                     }
                     


                     ?>
                 </div>
				 <div class="sl-basic-info">

				  <label>Enter keywords for our search engine.<a class="sl-tip tooltip" href="#;">?<span class="classic">

						Be specific in the choice of your keywords. <br>A few well chosen descriptive words give better response than a large block of text that could make it difficult for you to attract the right kind of interest.<br>Separate each word with a comma and a space.</span></a></label>

                     <?php echo $form->error($model,'user_default_business_keyword'); ?>
					 
					 <?php echo $form->textArea($model,'user_default_business_keyword',array('class'=>'textarea-full','id'=>'user_default_business_list_keyword','style'=>'height:100px','tabindex'=>9)); ?>

                 

                 </div>
                 <br class="clear" />
                 <br class="clear" />
				 <div class="submit_button" style="text-align: center;">
                    <input type="button" name="saveforlater" id="savelater" class="button blue" value="Save for later" style="float:left; margin-left: 144px;" />
					<?php
                        if($model->isNewRecord){
                        ?>
                    <input type="submit" name="submit_user_listing_step1" class="button black newbutton" value="Insert" style="float:right; margin-right: 171px;" />

                        <?php
                        }else {
                        ?>
    					 <input type="submit" name="update_user_listing_step1" class="button black newbutton" value="Update" />
    				    <?php
                        }
                     ?>
					</div>
				<!--</form>  -->
                <div style="clear:both; height:20px;"></div>
                <div class="navigation">
					<div>&nbsp;</div>
                    <div> <a class="active" style="cursor: default;">1</a>
                    <a href="javascript:void(0);" id="page2">2</a>
                   <!-- <a href="javascript:void(0)" id="page3">3</a>--></div>
					<div><a href="javascript:void(0);" id="next">Next &gt;&gt;</a></div>
                </div>
				<div style="clear:both; height:20px;"></div>
            </div>
            <?php $this->endWidget(); ?>
            <div class="clear"></div>
        </div>
        <!--end bottom carousel----->


<script type="text/javascript"><!--
    // Advert Carousel
    var JQ1 =jQuery.noConflict();
    JQ1(document).ready(function() {
        JQ1('#add-carousel-wrap').jcarousel({
            wrap: 'circular',
            scroll: 1
        });
        JQ1("#page2,#page3,#next").on("click",function(){
           jQuery(".newbutton").trigger("click");
        });

        jQuery("#savelater").live("click",function(){
        	jQuery(".pu-close1").trigger("click");
        	jQuery('html, body').animate({scrollTop: '300px'}, 1000);
        });
    });


      $(".chzn-select").chosen();
	  $(".chzn-select-deselect").chosen({allow_single_deselect:true});


     function formSubmit(){
        $("#businesslisting").submit();
     }
     function getNormal(id){
    	$(id).attr('placeholder','');
    	if($(id).hasClass('mandatoryerror')){
    	   $(id).removeClass('mandatoryerror');
    	}
    }
    function getSelectNormal(id){
        if($(id).hasClass('mandatoryerror')){
            $(id).removeClass('mandatoryerror');
        }
    }




      //form validations
	function form_validation(frm){
		var failedvalidation = false;

		JQ1('.select_error').remove();


		/**	@validation for listing category */
	/*var sl_category = JQ1('#sl_category option:selected').val();
    if(sl_category == ""){
		JQ1("#sl_category").siblings().addClass('mandatoryerror');
		JQ1("#sl_category").siblings().css('border-radius','5px');
		var sibling_id = JQ1("#sl_category").siblings().attr('id');
		JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		JQ1("#sl_category").siblings().removeClass('mandatoryerror');
		JQ1("#sl_category").siblings().css('border-radius','0');
	}*/

	/**	@validation for listing profession */
	/*var sl_profession = JQ1('#sl_profession option:selected').val();
	if(sl_profession == ""){
		JQ1("#sl_profession").siblings().addClass('mandatoryerror');
		JQ1("#sl_profession").siblings().css('border-radius','5px');
		var sibling_id = JQ1("#sl_profession").siblings().attr('id');
		JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		JQ1("#sl_profession").siblings().removeClass('mandatoryerror');
		JQ1("#sl_profession").siblings().css('border-radius','0');
	}*/

	/**	@validation for listing visibilty limit */
	var sl_vlimit = JQ1('#sl_vlimit option:selected').val();
	if(sl_vlimit == ""){
		JQ1("#sl_vlimit").siblings().addClass('mandatoryerror');
		JQ1("#sl_vlimit").siblings().css('border-radius','5px');
		var sibling_id = JQ1("#sl_vlimit").siblings().attr('id');
		JQ1('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		JQ1("#sl_vlimit").siblings().removeClass('mandatoryerror');
		JQ1("#sl_vlimit").siblings().css('border-radius','0');
	}

		/** @check address1 empty or not */
		var category = JQ1('#sl_category').val();
		if(category == ""){
			JQ1("#sl_category").addClass('mandatoryerror');
			JQ1("#sl_category").attr('placeholder','Please enter your profession');
			failedvalidation = true;
		}else{
			JQ1("#sl_category").removeClass('mandatoryerror');
			JQ1("#sl_category").attr('placeholder','');
		}

        var profession = JQ1('#sl_profession').val();
        if(profession == ""){
            JQ1("#sl_profession").addClass('mandatoryerror');
            JQ1("#sl_profession").attr('placeholder','Please enter your profession');
            failedvalidation = true;
        }else{
            JQ1("#sl_profession").removeClass('mandatoryerror');
            JQ1("#sl_profession").attr('placeholder','');
        }

		var slogon = JQ('#slogon').val();
		if(slogon == "")
		{
			JQ1("#slogon").addClass('mandatoryerror');
			JQ1("#slogon").attr('placeholder','Please enter company slogon');
			failedvalidation = true;
		}
		else
		{
			JQ1("#slogon").removeClass('mandatoryerror');
			JQ1("#slogon").attr('placeholder','');
		}
		/** @check town empty or not */
		var whoweare = JQ1('#whoweare').val();
		if(whoweare == ""){
			JQ1("#whoweare").addClass('mandatoryerror');
			JQ1("#whoweare").attr('placeholder','Please describe your organisation');
			failedvalidation = true;
		}else{
			JQ1("#whoweare").removeClass('mandatoryerror');
			JQ1("#whoweare").attr('placeholder','');
		}
		
		/** @check county empty or not */
		var offer = JQ1('#offer').val();
		if(offer == ""){
			JQ1("#offer").addClass('mandatoryerror');
			JQ1("#offer").attr('placeholder','Please explain the services that you offer');
			failedvalidation = true;
		}else{
			JQ1("#offer").removeClass('mandatoryerror');
			JQ1("#offer").attr('placeholder','');
		}

        var whatwecando = JQ1('#whatwecando').val();
        if(whatwecando == ""){
            JQ1("#whatwecando").addClass('mandatoryerror');
            JQ1("#whatwecando").attr('placeholder','Please describe what we can do for you');
            failedvalidation = true;
        }else{
            JQ1("#whatwecando").removeClass('mandatoryerror');
            JQ1("#whatwecando").attr('placeholder','');
        }
		
		/** @check zip_code empty or not 
		var keyword = JQ1('#keyword').val();
		if(keyword == ""){
			JQ1("#keyword").addClass('mandatoryerror');
			JQ1("#keyword").attr('placeholder','Please enter your keyword');
			failedvalidation = true;
		}else{
			JQ1("#keyword").removeClass('mandatoryerror');
			JQ1("#keyword").attr('placeholder','');
		}
*/
        /**	@validation for listing search engine keyword */
        var user_default_business_list_keyword = JQ1('#user_default_business_list_keyword').val();
        if(user_default_business_list_keyword == ""){
            JQ1("#user_default_business_list_keyword").addClass('mandatoryerror');
            JQ1("#user_default_business_list_keyword").attr({'placeholder':'Enter search engine keyword'});
            failedvalidation = true;
        }else{
            JQ1("#user_default_business_list_keyword").removeClass('mandatoryerror');
            JQ1("#user_default_business_list_keyword").attr({'placeholder':''});
            failedvalidation = false;
        }

		/** @check tel_no empty or not 
		var tel_no = JQ1('#testimonial').val();
		if(tel_no == ""){
			JQ1("#testimonial").addClass('mandatoryerror');
			JQ1("#testimonial").attr('placeholder','Please enter your testimonial');
			failedvalidation = true;
		}else{
			JQ1("#testimonial").removeClass('mandatoryerror');
			JQ1("#testimonial").attr('placeholder','');
		}
		*/
		
		if (failedvalidation){
			JQ1('#submit_user_listing_step1').val(0);
            return false;
		}else{
			JQ1("#businesslisting-form").submit();
            //jQuery('#submit_user_listing_step1').val(1);

		}
	}

   jQuery(document).ready(function(){
       jQuery(".pu-close1").live("click",function(){
            jQuery(".confirm").show();
        })

        close_form();
    });

    function close_form()
    {   JQ1(".confirm").hide();
    }

    function saveforlater()
    {
        document.getElementById("btnsaveforlater").value=1;
        document.getElementById("businesslisting-form").submit();
    }
  //--></script>
