<div class="breadcrumb" style="top:5px">
<a href="/">Home</a> » <span>Contact</span></div>
<style>
#upload{
    display:none
}
</style>

	<div class="sl-photo-box" style="margin-left:0px; text-align:center">
					
					<div class="photo-upload-box1 listing-upload" style="  margin-top: 65px;
  height: 0%;">
						<div class="my-account-popup-box" id="upload-frame"> 
							<a class="pu-close" onclick=jQuery(".registration-box").show();jQuery(".photo-upload-box1").hide(); href="javaScript:void(0)" title="Close">X</a>
							<h2>Upload Attachment</h2>
							
                            
							<!--<iframe src="photo-upload/logo_listing.php" frameborder="0" width="390" height="310" id="pic_frame"></iframe>--> 
                            <div id="wrap" style="height: auto;">    
                                <div id="uploader">
                                    <div id="big_uploader">
                                    <div id="notice"><img src="ajax-loader.gif" /></div>
                            		
                                    <br />
                                    Browse for a legal document on your computer
                                    <br />
                                    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                                'id'=>'uploadFile',
                                                'config'=>array(
                                                       'action'=>Yii::app()->createUrl('site/fileupload'),
                                                       'allowedExtensions'=>array("jpg",'png','rar','txt'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                       'minSizeLimit'=>10,// minimum file size in bytes 
                                                       'onComplete'=>"js:function(id, fileName, responseJSON){getUploadfilename(responseJSON);}",                                                  
                                                )
                                        )); 
                                    ?>
                                	</div><!-- big_uploader --> 
                                       
                                </div><!-- uploader --> 
                            </div>
						</div>
					</div>
					</div>
					
					
<!-- Where business meets invention --><div class="registration-box contact_cont" style="margin-left: 10px; display: block;  top: 390px !important;width: auto;">    

          	<form action="<?php echo Yii::app()->createUrl('contact/index'); ?>" method="post" id="member-form" enctype="multipart/form-data" onsubmit="return help_form_vaidations()"> 

			<div class="contact_inner" style="height: auto; display: block;    width: 755px;">    

			<div class="closebutton_pop" style="position: relative; top: -13px; z-index: 100;left: 379px; text-align: center;"> 

			<?php /* ?><a title="Close" href="<?php echo $this->createAbsoluteUrl('/'); ?>" id="close">
				
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" alt="business supermarket close button" width="24"></a>   <?php */ ?>

			</div>     								<div style="text-align: center; ">   	

			<br/>							

			<h2 style="color:#A14B93;">Business Supermarket User Contact Form</h2>    

			<br/>	

			</div>
			
			<?php
			
			$user_id = Yii::app()->user->id;
			
			
			
			if($user_id!="")
			
			{
				$usertype = Yii::app()->user->_user_Type;
				if($usertype == "user")
				{
					$user_details = User::model()->findAllByAttributes(array("user_default_id"=>$user_id));
				}
				else if($usertype == "business")
				{
				    $business_details = Business::model()->findAllByAttributes(array("user_default_business_id"=>$user_id));
				}
			
			
			
			}
			
			?>
			
			<table width="100%" align="center">    

			<tbody>					

			<tr>
			
			<td class="tbl1" align="right" style="  width: 100px;">Department:</td>		

			<td class="last" id="tbl2">						

			<span id="emailresult" style="border: medium none !important;background: transparent none repeat scroll 0% 0% !important;"></span>
			
			<?php					

            $listData =  CHtml::listData(Department::model()->findAll(array("order"=>'dept_name asc')),'dept_email','dept_email');
           
    	    echo CHtml::dropDownList('dept_email','',$listData,array('prompt' => 'Please Select Department','class'=>'chzn-select','data-placeholder'=>'Please select','onfocus'=>'getSelectNormal("#dept_email");','style'=>'  width: 302px;','id'=>'dept_email','tabindex'=>'1','title'=>'Select a department from the drop down menu'));
             
			?>	

			</td>	
			
			<td rowspan="3">
			<span id="captcherr" style="margin-left: 65px;"></span>
			<p style="border: 2px solid #f4dfd9;padding: 2px;width: 180px;background: white;display: table-cell; float: right; margin-right: 48px;">
			
                     <img id="siimage" style=" width:130px; height:50px; border:1px solid #ccc; margin-right: 15px" src="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left"/>                    
                     <object type="application/x-shockwave-flash" data="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.swf?audio_file=<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="23" width="23" >
                        <param name="movie" value="<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.swf?audio_file=<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
                     </object>
                     &nbsp; <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo Yii::app()->baseUrl; ?>/captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false"> 
					 <img src="<?php echo Yii::app()->baseUrl; ?>/captcha/images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0" height="23" width="23"/></a><br style="clear:both" /> 
					 <font style="font-size:7px;">Type the characters you see in the picture below</font>
					 <br /><br /> 
					 <input type="text" id="User_drg_verifycode" name="User[drg_verifycode]" class="captcha_fld" size="20" maxlength="10" />
					 <br />
					 <input type="hidden" name="captcha_validation" id="captcha_validation" value="" />                 
            </p>
				  
			</td>

			</tr>
			
			<tr>										

			<td class="tbl1" align="right" width="12%">Username:</td>		

			<td class="last" id="tbl2" width="30%">
			
			<input type="text" name="username" id="contact_username" class="file_input_textbox contact_textbox" placeholder="Enter Username"  value="<?php if($usertype == "user"){ echo $user_details[0]['user_default_username']; } else if($usertype == "business") { echo $business_details[0]['user_default_business_username']; }?>" /></td>

			

			</tr>					

			<tr>					

			<td width="100" class="tbl1" align="right">Email:</td>		

			<td class="last" id="tbl2" style="width: 184px;">
			
			<input type="email" name="email" id="contact_email" class="file_input_textbox contact_textbox" placeholder="Enter Email"  value="<?php  if($usertype == "user"){ echo $user_details[0]['user_default_email']; } else if($usertype == "business"){ echo $business_details[0]['user_default_business_email']; } ?>" /></td>									

			<td class="tbl1" align="right">&nbsp;</td>

			<td class="last" id="tbl2">&nbsp;</td>		

			</tr>											

			<tr>
			
			<tr>										

			<td width="100" class="tbl1" align="right">Subject:</td>	

			<td class="last" id="tbl2"  colspan="3"><input type="text" name="subject" id="contact_subject" class="file_input_textbox contact_textbox_full" placeholder="Enter Subject" /></td>	

			</tr>							

			<tr>							

			<td width="100" class="tbl1" valign="top" align="right">Attachment:</td>		

			<td class="last" id="tbl2" colspan="3"><input type="text" name="attachment" id="contact_attachment" class="file_input_textbox contact_textbox_full"    />								

			<br/><br/> 											

			<input id="upload" name="file" type="file" onchange="updateFileName()" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.pdf,.txt,.rar,.zip" /><a href="" id="upload_link"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png"><span>Add Attachment</span></a>	

			<a href="javaScript:void(0)" id="delatt" style="display:none"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Attachment.png">Delete Attachment</a>											</td>							
			
			</tr>		

			<tr>				

			<td width="100" class="tbl1"  align="right">Message:</td>	

			<td class="last" id="tbl2" colspan="3">						

			<textarea  class="file_input_textbox contact_textarea" placeholder="Describe your message" name="msg" id="contact_message"  > </textarea>                            

			</td>					

			<td class="tbl1" align="right">&nbsp;</td>		

			<td class="last" id="tbl2">&nbsp;</td>			

			</tr>										

			<tr>									

			<td colspan="4" class="last" id="tbl2" align="center">			

			 <label for="memail" class="contact_checkbox">Send a copy to my email address for my records &nbsp; <input type="checkbox" name="memail" value="yes" id="memail" /> </label>

			</td>								

			</tr>						

			<tr>								

			<td colspan="4" class="last" id="tbl2" align="center">		

			<input type="button" name="contactus" title="Close" onclick="window.location.href='<?php echo $this->createAbsoluteUrl('/'); ?>'" id="close" tabindex="12" id="sendmaillist" class="button black" value="Close" />							

			&nbsp;&nbsp;<input type="submit" name="contactus" tabindex="12" id="sendmaillist" class="button black" value="Send" />							

			</td>				

			</tr>				

			</tbody>			

			</table> 
			
</div></form>
			
			</div>
			
	
	<script type="text/javascript">	  
	function updateFileName() {
        var img1 = document.getElementById('upload');
		var allowedFiles = [".doc", ".docx", ".pdf", ".rar", ".jpg", ".png", ".txt"];
		var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(img1.value.toLowerCase())) {
            var error = "only pdf, rar or image files allowed.";
            alert(error);
        }
		else
		{	
		if(img1 != "")
		{
			jQuery("#upload_link").hide();	

	jQuery("#delatt").show();
		}
        var file_name = document.getElementById('contact_attachment');
        var fileNameIndex = img1.value.lastIndexOf("\\");

        file_name.value = img1.value.substring(fileNameIndex + 1);
    }
	}
	
	$(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#upload:hidden").trigger('click');

    });
	
	$("#delatt").on('click', function(e){
        e.preventDefault();
        jQuery("#upload_link").show();
jQuery("#contact_attachment").val('');
jQuery("#upload").val('');		

	jQuery("#delatt").hide();

    });
});

	$(".chzn-select").chosen();
	
	function show_picture_form1(){  

	jQuery(".photo-upload-box1").show();

	jQuery(".registration-box").hide();  

	}		

	function getUploadfilename(result){  

	if(result.success){ 	   

	jQuery("#contact_attachment").val(result.filename);	

	jQuery(".photo-upload-box1").hide();

	jQuery(".registration-box").show();		
	
	jQuery("#addatt").hide();	

	jQuery("#delatt").show();

	}

	}  

    $("#delatt").click(function(event){   

	var d1=$('#member-form').serialize();

	$.ajax({      

	type: "POST",    

	url: "<?php echo Yii::app()->createUrl('site/delete_file'); ?>",   

	data:  d1 ,         

    success: function(result)          

	{                  

	if(result =='success'){         

	$("#contact_attachment").val('');         

	$("#addatt").show();		  

	$("#delatt").hide();           

	}       

 	},         

	})	

	});


function help_form_vaidations() 

{    

    

	var failedvalidation = false;	

    

    jQuery('#member-form input,textarea').removeClass('mandatoryerror');



	var dept_email = $('#dept_email option:selected').val();
	if(dept_email == ""){
		$("#dept_email").siblings().addClass('mandatoryerror');
		$("#dept_email").siblings().css('border-radius','5px');
		$("#emailresult").html('<font color=\"red\">Please select a department from the list</font>'); 
		var sibling_id = $("#dept_email").siblings().attr('id');
		$('#'+sibling_id).attr('onfocus',"getSelectNormal('#"+sibling_id+"')");
		failedvalidation = true;
	}else{
		$("#emailresult").html(''); 
		$("#dept_email").siblings().removeClass('mandatoryerror');
		$("#dept_email").siblings().css('border-radius','0');
	}		

	
	var contact_username = document.getElementById("contact_username").value;

    if((contact_username == ""))

    {                

       jQuery("#contact_username").addClass('mandatoryerror');

	   jQuery("#contact_username").attr('placeholder','Enter your username or name'); 

       failedvalidation = true;            

    } 



  /*  var dept_email = document.getElementById("dept_email").value;

    if(dept_email == "")

        {                

            jQuery("#dept_email").addClass('mandatoryerror');            

            failedvalidation = true;             

        } */

    var x = document.getElementById("contact_email").value;           

    var atpos=x.indexOf("@");            

    var dotpos=x.lastIndexOf(".");            

    if ((atpos < 1 || dotpos<atpos+2 || dotpos+2>=x.length)  || (x==''))             

        {              

            jQuery("#contact_email").addClass('mandatoryerror');

            jQuery("#contact_email").attr('placeholder','Please enter a valid email'); 

            failedvalidation = true;               

        }



	var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

/*	var drf_zip= document.getElementById("drf_zip").value;

    if(drf_zip == '' || !numberRegex.test(drf_zip))

    {                

       $("#drf_zip").addClass('mandatoryerror');

	   $("#drf_zip").attr('placeholder','Enter Your Correct Zip Code'); 

       failedvalidation = true;             

    } 

*/	

/*	var drf_dob= document.getElementById("drf_dob").value;

    if(drf_dob == '')

    {                

       $("#drf_dob").addClass('mandatoryerror');

	   $("#drf_dob").attr('placeholder','Enter Your DOB'); 

       failedvalidation = true;             

    }

*/

	var drg_verifycode = document.getElementById("User_drg_verifycode").value;
	
	if(drg_verifycode ==""){               
            JQ("#User_drg_verifycode").addClass('mandatoryerror'); 
    	    JQ("#User_drg_verifycode").attr('placeholder','Enter Captcha');
			JQ("#captcherr").html('<font color=\"red\">Please enter the captcha</font>'); 
			
    	    JQ("#User_drg_verifycode").val("");
    		failedvalidation = true;            
        }else {
            if(!process_captcha())
            {
                failedvalidation = true;
            }  
     } 
        

	var contact_subject = document.getElementById("contact_subject").value;

    if((contact_subject == ""))

    {                

       jQuery("#contact_subject").addClass('mandatoryerror');

	   jQuery("#contact_subject").attr('placeholder','Enter Subject'); 

       failedvalidation = true;            

    } 

	

	var contact_message= jQuery.trim(document.getElementById("contact_message").value);

    if(contact_message == '')

    {                

       jQuery("#contact_message").val('');
	   
	   jQuery("#contact_message").addClass('mandatoryerror');

	   jQuery("#contact_message").attr('placeholder','Please enter a message'); 

       failedvalidation = true;             

    }

 	

	if (failedvalidation) 

	{

        return false;

    }

}

</script>  

	