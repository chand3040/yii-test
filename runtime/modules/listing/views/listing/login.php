	 <div class="login_box">
        <div id="terms-conditions" class="u-email-box">
		    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png" />
            <div class="my-account-popup-box" id="new_login_box" style="text-align: center;"> 
			<h4 style="margin-top: 30px;">Please enter your username and password to continue</h4>
			  <form  action="/login" method="post" name="login_form" id="login_form" onsubmit="return login_validation1(this.form)">
              <input type="text" name="drg_username" id="dname" placeholder=" Username" size="45px" style="height: 23px;margin-top: 17px;border: 1px solid rgb(134, 131, 131);" /><br>
			   <input type="password" name="drg_pass"  id="dpass" placeholder=" Password" size="45px"  style="height: 23px;margin-top: 12px;border: 1px solid rgb(134, 131, 131);" /><br>
			   
			  <div class="retrieve" style="margin-top: 10px;margin-left: 153px;"> <a href="#" onclick="show_lost_pass()">Retrieve username and password</a> </div>
		<?php $action = Yii::app()->controller->action->id ; $BaseUrl=Yii::app()->getBaseUrl(true); $lid = Yii::app()->request->getParam('listid'); 
		$request_id = $BaseUrl."/"."listing"."/".$action."/listid/".$lid; ?>
		<input type="hidden" name="rid"  id="rid" value="<?php echo $request_id; ?>" />
                            <input type="submit"  name="login_sbmt" value="Login" class="button black" style="margin-top: 12px;"/>
            
			   </form>
            </div>
			
			<div class="my-account-popup-box" id="lost_pass_request_new" style="display:none">   	

<h4 style="margin-top: 30px;">Password reset request</h4>

<input type="hidden" value="3ba438573918e10c268ddd357f8878e433910cbf" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN">
<input onblur="if(this.value=='')this.value='Enter your Email address'" onfocus="if(this.value=='Enter your Email address' || this.value=='Please enter your email' || this.value=='Email address does not exist')this.value=''" onclick="if(this.value=='Enter your Email address')this.value=''" type="text" name="user_default_lost_email_new" id="user_default_lost_email_new" title="Enter your Email address" value="Enter your Email address" size="45px" style="height: 23px;margin-top: 17px;border: 1px solid rgb(134, 131, 131);">
      <div class="retrieve" style="margin-top: 10px;margin-left: 153px;"> <a href="#" onclick="show_login_box()">Back to login</a> </div>
		<?php $action = Yii::app()->controller->action->id ; $BaseUrl=Yii::app()->getBaseUrl(true); $lid = Yii::app()->request->getParam('listid'); 
		$request_id = $BaseUrl."/"."listing"."/".$action."/listid/".$lid; ?>
		<input type="hidden" name="rid"  id="rid" value="<?php echo $request_id; ?>" />
                            <input type="button"  name="login_sbmt" value="Submit"  onclick="return lost_password_new();" class="button black" style="margin-top: 12px;"/>           
</div>

<div id="reset_success_new" class="my-account-popup-box" style="display:none">      



        <h4 style="margin-top: 30px;">Your password reset instructions have been sent to your email address. Please allow a few minutes to receive the email.</h4>

        <span style="text-align:right; padding-top:44px;"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>">Close &gt;&gt; </a></span>

	

</div>

<div id="reset_success_box2_new" style="display:none">

        <h3 style="text-align:center;">Didn't get the email?</h3>

        <p class="click-here">

            Please check your Spam or Junk folder.

            If you still didn't receive an email then 

        </p>

        <p style="text-align:right;">

        	<a href="help.php" title="contact us"> click here &gt;&gt; </a>

        </p>

      </div>

</div>

        </div>

    </div>
			
			<style>
			.login_box #terms-conditions {  margin-left: 235px; }
			#menu-container { display:none; }
			#rightbar { display:none; }
			#hrLine { display:none; }
			#footer { display:none; }
			.home-slider-wrap { display:none; }
			</style>
	<script type="text/javascript">
	function login_validation1(frm)
{
	var failedvalidation = false;
    var drf_name = document.getElementById("dname").value;
	var drf_pass = document.getElementById("dpass").value;
var rid = document.getElementById("rid").value;
    if(drf_name == "Username" || drf_name == "Please enter your username" || drf_name == "")
        {
            $("#dname").css('border','1px solid #f00');
			$("#dname").val('Please enter your username');
            failedvalidation = true;
        }

    if(drf_pass == "Password" || drf_pass == "Please enter your password" || drf_pass=='')
	{
		$("#dpass").css('border','1px solid #f00');
		$("#dpass").val('Please enter your password');
		failedvalidation = true;
	}


	if(failedvalidation==false)
	{
	     if($("#rememberme").is(':checked'))
         {    setCookie('username',drf_name);
              setCookie('password',drf_pass);

         }

		 $.ajax({
             type: "POST",
             url: "/login",
			 async: false,
             data: 'LoginForm[username]='+drf_name+'&LoginForm[password]='+drf_pass+'&YII_CSRF_TOKEN=a83e4344f76803a5a985b08d9d9556f6ea5b60b2',
             success: function(data)
			 {

                var result = jQuery.parseJSON(data);
				                //alert(result.success);
				 if(result.success=='true')
				 {
				    window.location.href = rid;
					failedvalidation = true;

				 } else{

                    if(result=='User name Exist'){
				 	$("#dpass").css('border','1px solid #f00');
                    $("#dname").css('border','1px solid #999999');
					$('#dpass').attr('type', 'text');
					$("#dpass").val('Password not recognized');
				    failedvalidation = true;
            	 }else{
                    $("#dname").css('border','1px solid #f00');
                    $("#dname").val('Username not recognized');
                    $("#dpass").css('border','1px solid #f00');
					$('#dpass').attr('type', 'text');
					$("#dpass").val('Password not recognized');
				    failedvalidation = true;
                 }

                }
				 return false;
        	},
			error: function(a)
			 {
				 //alert(a);
			 }
  		});
	}

    if(failedvalidation)
	{
        return false;
    }
}
</script>

<script type="text/javascript"> 



//show lost password form

function show_lost_pass()

{

	$("#new_login_box").hide();

	$("#lost_pass_request_new").show();	

}

function show_login_box()

{

	$("#new_login_box").show();

	$("#lost_pass_request_new").hide();	

}


function lost_password_new() 

{

	var failedvalidation = false;

    var user_default_lost_email_new = document.getElementById("user_default_lost_email_new").value;

	if(user_default_lost_email_new == "Enter your Email address" || user_default_lost_email_new == "Please enter your email" || user_default_lost_email_new == "")

        {                

            $("#user_default_lost_email_new").css('border','1px solid #f00'); 

			$("#user_default_lost_email_new").val('Please enter your email');            

            failedvalidation = true;            

        } 

	

	if(failedvalidation==false)

	{

		 $.ajax({

             type: "POST",

             url: "<?php echo Yii::app()->getBaseUrl(true);?>/forget",

			 async: false,

             //data: 'type=lost_password&email='+user_default_lost_email_new,

              data: 'user_default_lost_email='+user_default_lost_email_new+'&YII_CSRF_TOKEN=3ba438573918e10c268ddd357f8878e433910cbf',

             success: function(result)

			 {
				 var result1 = jQuery.parseJSON(result);

				 if(result1.success=='true')

				 {  

				     $("#lost_pass_request_new").css('display','none');

					 //$("#lostpass-inst").css('display','none');

					 $("#reset_success_new").fadeIn('slow');

					 //$("#reset_success_box2_new").fadeIn('slow');

					//window.location.href ='';

					failedvalidation = false;

                      

				 }				  

				 else

				 {	 

				 	$("#user_default_lost_email_new").css('border','1px solid #f00');

					$("#user_default_lost_email_new").css('color','#f00');

					$("#user_default_lost_email_new").val('Email address does not exist');

				    failedvalidation = true;

            	 }  

				 return false;

        	},

			error: function(a)

			 {

				 alert(a);

			 }

  		});

	}

		

	if(failedvalidation) 

	{

        return false;

    }   

	

}


</script>