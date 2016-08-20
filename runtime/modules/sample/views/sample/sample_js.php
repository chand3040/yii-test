<?php
$pathBootstrap = Yii::app()->assetManager->publish( Yii::getPathOfAlias('ext.dzraty.assets') );
?>
<script type="text/javascript">

    /**
     *
     *
     * @name Common : Common functions
     * @license Business Market
     * @author Riadh H.
     * @package feedback
     *
     *
     */


// Common object to store configuration feedback params
    var feedback = feedback || {};


    feedback.showChar = 300; // How many characters are shown by default
    feedback.ellipsesText = "...";
    feedback.moreText = "read more >>";
    feedback.lessText = "<< read less";

    /*
     *
     * Common functions
     *
     */

    // Add a new comment
    // params : message
    // params : listingId
    // params : commentReference
    // params : event
    // params : attachement

    $('body').on('click', '.flike_button, .fdislike_button', function(){

        if( $(this).hasClass("grayedOut") ){
            return false;
        }

        var commentId = $(this).parents('.flike_buuton_box').attr('data-commentid');
        var likeAction = $(this).attr('data-likeaction');

        feedback.likeComment(commentId, likeAction);

    });


    feedback.addComment = function(message, listingId, commentReference, rating, event){

        if( message == "" ){

            feedback.blockWriteInfeedback("You may have forgot to enter a comment<br/><span style='color: #6b6d6e;'> please enter a comment to continue</span>");

            return false;

        }

        //alert("message : "+message+" listing : "+listingId+"ref:"+commentReference+" rating : "+rating+" event : "+event);

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('sample/sample/addcomment'); ?>",
            type: "POST",
            dataType: 'json',
            async: true,
            data: {
                message : message,
                listingId: listingId,
                commentReference : commentReference,
                rating : rating
            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    feedback.blockWriteInfeedback("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            success: function(response){
                console.log(response);
                var listingId = $('#voice-your-opinions').attr('data-listingid');
                var viewLimitValue = $("#commentViewLimit").val();
                var feedbackpagenumber = $('.sfeedbackpagenumbers').find('.active').eq(0);
                var pageSelected = feedbackpagenumber.attr('page');
                var viewOffsetValue = feedbackpagenumber.attr('offset');

                feedback.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue);

            },
            complete: function(){
            }

        });

    };

    feedback.sendMailListOwmer = function(message, listingId, commentReference, event, attachement){

        // Add an attachement
        if( (attachement.val() != "") ){

            feedback.uploadAttachement(event, attachement);

            // Upload attachement success
            if( (attachement.attr("uploadsuccess") == "0") || (attachement.attr("uploadfile") == "null")  ){

                return false;

            }


        }

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('sample/sample/sendmaillistowner'); ?>",
            type: "POST",
            dataType: 'json',
            async: true,
            data: {
                message : message,
                listingId: listingId,
                commentReference : commentReference,
                attachementUploadFile : attachement.attr("uploadfile")

            },
            error: function(xhr,tStatus,e){
                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(response){
                console.log(response);
                var listingId = $('#voice-your-opinions').attr('listingid');
                var viewLimitValue = $("#commentViewLimit").val();
                var feedbackpagenumber = $('.sfeedbackpagenumbers').find('.active').eq(0);
                var pageSelected = feedbackpagenumber.attr('page');
                var viewOffsetValue = feedbackpagenumber.attr('offset');

                feedback.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue);

            },
            complete: function(){

                // Rest attachement values to avoid conflict for multiple post a comment with attachement
                attachement.attr("uploadsuccess", "0");
                attachement.attr("uploadfile", "null");

            }

        });

    };




    // like or dislike a new comment
    // params : commentId
    // params : likeAction
    feedback.likeComment = function(commentId, likeAction){

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: '<?php echo Yii::app()->createUrl('sample/sample/likecomment'); ?>',
            type: "POST",
            dataType: 'json',
            async: true,
            data: {
                commentId : commentId,
                likeAction: likeAction

            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    feedback.blockWriteInfeedback("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            success: function(response){
                console.log(response);
                var listingId = $('#voice-your-opinions').attr('data-listingid');
                var viewLimitValue = $("#commentViewLimit").val();
                var feedbackpagenumber = $('.sfeedbackpagenumbers').find('.active').eq(0);
                var pageSelected = feedbackpagenumber.attr('page');
                var viewOffsetValue = feedbackpagenumber.attr('offset');

                feedback.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue);

            },
            complete: function(){



            }
        });

    };

    // Ban user action by show a bloc contain
    // params : message to dispplay
    feedback.blockWriteInfeedback = function(message){

        $('#lights').show();
        $('#fade').show();
        $('#fade').css({ opacity: 0.6, 'width':'100%','height':'100%'});
        $('body').css({'overflow':'overflow'});

        $("#lights").find(".text-message").html(message);

    };

    // Close notification
    // params : no params
    feedback.closeNotification = function(){

        $('#lights').hide();
        $('#fade').hide();

    };



    // Ban user action by show a bloc contain
    // params : listingId
    // params : viewLimitValue number of comment to display
    feedback.UpdateViewLimit = function(listingId, viewLimitValue){

        var userProfession;

        if( $(".fuserProfession").find(".result-selected") ){

            $(".fuserProfession").find("select").find("option").each(function(){

                if( $(this).html() === $(".fuserProfession").find(".result-selected").html()){

                    userProfession = $(this).attr("value");

                }

            });

        }

        var userReputation;

        if( $(".fuserReputation").find(".result-selected") ){

            $(".fuserReputation").find("select").find("option").each(function(){

                if( $(this).html() === $(".fuserReputation").find(".result-selected").html()){

                    userReputation = $(this).attr("value");

                }

            });

        }

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('sample/sample/updateviewlimit'); ?>",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                viewLimitValue: viewLimitValue,
                commentOrderBy : userReputation,
                userProfession : userProfession

            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){
                var feedbackpage =  $(".feedbackpage");
                feedbackpage.html("");
                feedbackpage.html(resp.listingView);

            },
            complete: function(){

                feedback.showMoreComment();

            }
        });

    };

    // Navigate the comment list, useful to render the pagination
    // params : listingId
    // params : viewLimitValue number of comment to display
    // params : pageSelected
    // params : viewOffsetValue offset to start get data from database
    // params : commentOrderBy criteria to sort the comment list

    feedback.Navigate = function(listingId, viewLimitValue, pageSelected, viewOffsetValue, commentOrderBy){

        var userProfession;

        if( $(".fuserProfession").find(".result-selected") ){

            $(".fuserProfession").find("select").find("option").each(function(){

                if( $(this).html() === $(".fuserProfession").find(".result-selected").html()){

                    userProfession = $(this).attr("value");

                }

            });

        }

        var current_rating = $("#current_rating_value").val();


        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('sample/sample/navigate'); ?>",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                viewLimitValue: viewLimitValue,
                pageSelected : pageSelected,
                viewOffsetValue : viewOffsetValue,
                commentOrderBy : commentOrderBy,
                userProfession : userProfession

            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){
                var feedbackpage = $(".feedbackpage");
                feedbackpage.html("");
                feedbackpage.html(resp.listingView);
                //$("#voice-your-opinions").html("");
                //$("#voice-your-opinions").html(resp.listingView);
                if(current_rating != resp.crating)
                {
                    jQuery('#total_rating-raty').raty({'path':'<?php echo $pathBootstrap. '/img'; ?>','half':true,'starOff':'star-off.png','starOn':'star-on.png','starHalf':'star-half.png','cancelOff':'cancel-off.png','cancelOn':'cancel-on.png','readOnly':true,'score': resp.crating ,'target':'#total_rating'});
                    $('#rating_details').html(resp.crating+' out of 5 stars');
                }



            },
            complete: function(){

                feedback.showMoreComment();

            }
        });

    };


    // Report a comment as a spam
    // params : reportAsSpam onject to update after action
    // params : listingId
    // params : commentId
    feedback.reportAsSpam = function(reportAsSpam, listingId, commentId){

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('sample/sample/reportasspam'); ?>",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                commentId: commentId

            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    feedback.blockWriteInfeedback("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            success: function(resp){
                console.log(resp);
                reportAsSpam.html("Comment under review");
                reportAsSpam.addClass("redText");
                var body = $("body");
                body.find("[commentId='"+commentId+"']").find('.replyToPostComment').eq(0).addClass("grayedOut");
                body.find("[commentId='"+commentId+"']").find('.like_button').eq(0).addClass("grayedOut");
                body.find("[commentId='"+commentId+"']").find('.dislike_button').eq(0).addClass("grayedOut");

            },
            complete: function(){

                feedback.showMoreComment();

            }
        });

    };

    // Upload a new file attached to a comment
    // params : event
    // params : attachement file to attach
    feedback.uploadAttachement = function(event, attachement){

        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // Create a formdata object and add the files
        var formData = new FormData();

        var fileSelect = document.getElementById(attachement.attr('id'));

        // Loop through each of the selected files.
        for (var i = 0; i < fileSelect.files.length; i++) {

            var file = fileSelect.files[i];
            console.log(file);
            // Add the file to the request.
            formData.append('attachement', file);

        }
        $.ajax({

            url: "<?php echo Yii::app()->createUrl('sample/sample/uploadattachment'); ?>",
            type: 'POST',
            data: formData,
            async: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request

            success: function(resp)
            {

                if( resp.action_status == '0')
                {
                    feedback.blockWriteInfeedback(resp.message);

                }else
                {

                    attachement.attr("data-uploadsuccess", "1");
                    attachement.attr("data-uploadfile", resp.file_name);

                }
            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    feedback.blockWriteInfeedback("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            complete: function()
            {

            }

        });

    };


    // Upload a new file attached to a comment
    // params : event
    // params : thumb_attachement file to attach
    feedback.uploadThumbAttachement  = function(event, thumb_attchement){

        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // Create a formdata object and add the files
        var formData = new FormData();

        var fileSelect = document.getElementById(thumb_attchement.attr('id'));

        // Loop through each of the selected files.
        for (var i = 0; i < fileSelect.files.length; i++) {

            var file = fileSelect.files[i];

            // Add the file to the request.
            formData.append('thumb_attchement', file, file.name);

        }

        $.ajax({

            url: "<?php echo Yii::app()->createUrl('sample/sample/uploadthumbattachement'); ?>",
            type: 'POST',
            data: formData,
            async: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request

            success: function(resp)
            {
                if( resp.action_status == '0')
                {
                    feedback.blockWriteInfeedback(resp.message);

                }else
                {

                    thumb_attchement.attr("data-uploadsuccess", "1");
                    thumb_attchement.attr("data-uploadfile", resp.file_name);

                }
            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    feedback.blockWriteInfeedback("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            complete: function()
            {

            }

        });

    };

    // Update the comment list throught a criteria selected by the user
    // params : listingId
    // params : viewLimitValue number of comment to display
    // params : commentOrderBy the criteria
    feedback.setViewByCriteria = function(listingId, viewLimitValue, commentOrderBy){


        var userProfession;

        if( $(".fuserProfession").find(".result-selected") ){

            $(".fuserProfession").find("select").find("option").each(function(){

                if( $(this).html() === $(".fuserProfession").find(".result-selected").html()){

                    userProfession = $(this).attr("value");

                }

            });

        }


        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('sample/sample/setviewbycriteria'); ?>",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                viewLimitValue: viewLimitValue,
                commentOrderBy : commentOrderBy,
                userProfession : userProfession

            },
            error: function(xhr,tStatus,e){

                if(!xhr){
                    console.log(" We have an error ");
                    console.log(tStatus+" "+e.message);
                }else{
                    console.log("else: "+e.message); // the great unknown
                }
            },
            success: function(resp){
                var feedbackpage =  $(".feedbackpage");
                feedbackpage.html("");
                feedbackpage.html(resp.listingView);
                //$("#voice-your-opinions").html(resp.listingView);
            },
            complete: function(){

                feedback.showMoreComment();

            }

        });

    };


    // Delete a comment
    // params : listingId
    // params : commentId
    feedback.deleteComment = function(listingId, commentId){

        // Get messages appropriate with the current language
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo Yii::app()->createUrl('sample/sample/deletecomment'); ?>",
            type: "POST",
            dataType: 'json',
            data: {
                listingId : listingId,
                commentId: commentId

            },
            error: function(xhr,tStatus,e){

                if( xhr.status == 302 ){
                    // User in not loggued in
                    feedback.blockWriteInfeedback("You must be logged in to leave a comment.");

                }else{

                    if(!xhr){
                        console.log(" We have an error ");
                        console.log(tStatus+" "+e.message);
                    }else{
                        console.log("else: "+e.message); // the great unknown
                    }
                }
            },
            success: function(resp){

                var listingId = $('#voice-your-opinions').attr('data-listingid');
                var viewLimitValue = $("#commentViewLimit").val();
                var feedbackpagenumber = $('.sfeedbackpagenumbers').find('.active').eq(0);
                var pageSelected = feedbackpagenumber.attr('page');
                var viewOffsetValue = feedbackpagenumber.attr('offset');

                feedback.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue);

            },
            complete: function(){
            }

        });

    };


    // Show more comment
    // params : no params
    feedback.showMoreComment = function(){

        // Event for show more comment text button
        $('.more').each(function() {

            var content = $(this).html();

            if( content.length > feedback.showChar ) {

                var c = content.substr(0, feedback.showChar);
                var h = content.substr(feedback.showChar, content.length - feedback.showChar);

                var html = c + '<span class="moreellipses">' + feedback.ellipsesText+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="#;" class="morelink">' + feedback.moreText + '</a></span>';

                $(this).html(html);
            }

        });

    };


    /**
     *
     *
     * @name Engine : Engine js file
     * @license Business Market
     * @author RH
     * @package Forrum
     *
     *
     */


    jQuery(document).ready(function ($){


        // Event for post a comment button
        $('body').on('click', '#dd_feedback_button', function(event){
            if( $(this).parents('form').find(".feedback_message").attr('placeholder') != ""  ){
                feedback.blockWriteInfeedback("You must be logged in to leave a comment.");
                return false;
            }
            if( $(this).parents('form').find("#rating").val() == ""  ){
                feedback.blockWriteInfeedback("click the stars to rate.");
                return false;
            }
            var message = $(this).parents('form').find(".feedback_message").val();
            var rating = $(this).parents('form').find("#rating").val();
            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var commentReference = $(this).parents('form').attr('data-commentreference');


            feedback.addComment(message, listingId, commentReference, rating, event);

            $(this).parents('form').find(".feedback_message").val("");
            //$(this).parents('form').find("#rating").val("");


        });

        // Event for post a reply comment button
        $('body').on('click', '#dd_feedback_reply_button', function(event){
            if( $(this).parents('form').find(".message").attr('placeholder') != ""  ){
                feedback.blockWriteInfeedback("You must be logged in to leave a comment.");
                return false;
            }
            var message = $(this).parents('form').find(".message").val();
            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var commentReference = $(this).parents('form').attr('data-commentreference');
            //var attachement = $(this).parents('.postBlock').find('.attachement-file');
            //var thumb_attchement = $(this).parents('.postBlock').find('.attachement-thumb-file');

            feedback.addComment(message, listingId, commentReference, 0, event);
            // feedback.addComment(message, listingId, commentReference, event, attachement, thumb_attchement);

            $(this).parents('form').find(".message").val("");


        });

        // Event for post a comment button
        $('body').on('click', '.dd_sendmail_button', function(event){

            var message = $(this).parents('form').find("#message").val();
            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var commentReference = $(this).parents('form').attr('data-commentreference');
            var attachement = $(this).parents('.postBlock').find('.attachement-file');

            feedback.sendMailListOwmer(message, listingId, commentReference, event, attachement);

            $(this).parents('form').find("#message").val("");


        });



        // Event for reply a comment button
        $('body').on('click', '.replyToPostComment', function(){

            if( $(this).hasClass("grayedOut") ){
                return false;
            }

            var commentId = $(this).attr('data-commentid');
            var form = $(this).parents('.dd_coment_box').find(".replyToPostCommentForm-"+commentId);

            if( !form.is(":visible") ){
                form.show();
            }else{
                form.hide();
            }

        });

        // Event for send a mail to listing owner button
        $('body').on('click', '.sendMailListOwner', function(){

            var commentId = $(this).attr('data-commentid');
            var form = $(this).parents('.dd_coment_box').find(".sendMailListOwnerForm-"+commentId);

            if( !form.is(":visible") ){
                form.show();
            }else{
                form.hide();
            }

        });

        // Event for like or dislike button
        $('body').on('click', '.like_button, .dislike_button', function(){

            if( $(this).hasClass("grayedOut") ){
                return false;
            }

            var commentId = $(this).parents('.like_buuton_box').attr('data-commentid');
            var likeAction = $(this).attr('data-likeaction');

            feedback.likeComment(commentId, likeAction);

        });


        // Event for update the number of comment to display
        $('body').on('click', '.user-page-nav .active-result', function(){

            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var viewLimitValue = parseInt($(this).html());

            feedback.UpdateViewLimit(listingId, viewLimitValue);

        });

        // Event for navigation (pagination)
        $('body').on('click', '.sfeedbackpagenumbers a', function(){

            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var pageSelected = $(this).attr('page');
            var viewOffsetValue = $(this).attr('offset');
            var commentOrderBy = $(this).attr('data-orderby');

            feedback.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue, commentOrderBy);

        });


        // Event for report a comment as a spam button
        $('body').on('click', '.reportAsSpam', function(){

            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var commentId = $(this).attr('data-commentid');

            feedback.reportAsSpam($(this), listingId, commentId);

        });

        // Event to prevent user action access
        $('body').on('click', '.notAllowed', function(){

            feedback.blockWriteInfeedback();

            $("#light").find(".text-message").html("You must be logged in to show the attachement.");


        });

        // Event for attachement icon
        $('body').on('click', '.attachement-icon', function(){
            var attachment = $(this).parents('.postBlock').find('.attachement-file').attr('id');
            $('#data-'+attachment).removeAttr('style');
            $(this).parents('.attachement-div').find('.attachement-file').click();
        });

        // Event for attachement input
        $('body').on('change', '.attachement-file', function(){

            $(this).parents('.attachement-div').find('.attachement-icon').html(
                "<span class='defaultCursor'>"+$(this).val()+"</span><a style='padding-left:20px;' onclick=\"$(this).parents('.attachement-div').find('.attachement-icon').html('Add attachement'); $(this).val(''); \" class='deleteAttachement'>Delete</a>"
            );

        });

        // Event for thumb attachement icon
        $('body').on('click', '.attachement-thumb-icon', function(){

            $(this).parents('.thumb-attachement-div').find('.attachement-thumb-file').click();

        });

        // Event for thumb attachement input
        $('body').on('change', '.attachement-thumb-file', function(){

            $(this).parents('.thumb-attachement-div').find('.attachement-thumb-icon').html(
                "<span class='defaultCursor'>"+$(this).val()+"</span><a style='padding-left:20px;' onclick=\"$(this).parents('.thumb-attachement-div').find('.attachement-thumb-icon').html('Add thumbnail image'); $(this).val('');\" class='deleteAttachement'>Delete</a>"
            );

        });


        // Event for set comment list by criteria
        $('body').on('click', '.sviewByCriteria', function(){

            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy = $(this).attr('data-orderby');

            feedback.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);

        });

        // Event for open / close comment button
        $('body').on('click', '.sopenCloseComments', function(){
            //alert($(this).attr('status'));
            if( $(this).attr('status') == 'closed' ){

                $(this).parents('.dd_coment_box').find('.hiddenPostComments').each(function(){

                    $(this).removeClass('hiddenPostComments');
                    $(this).addClass('visiblePostComments');

                });

                $(this).attr('status', 'opened');
                $(this).html('Close all threads<span class="classic sopenCloseCommentsTooltip">Close all threads</span>');


            }else{

                $(this).parents('.dd_coment_box').find('.visiblePostComments').each(function(){

                    $(this).removeClass('visiblePostComments');
                    $(this).addClass('hiddenPostComments');

                });

                $(this).attr('status', 'closed');
                $(this).html('Open all threads<span class="classic sopenCloseCommentsTooltip">Open all threads</span>');

            }


        });


        var showChar = feedback.showChar;
        var ellipsestext = feedback.ellipsesText;
        var moretext = feedback.moreText;
        var lesstext = feedback.lessText;


        // Event for show more comment text button
        $('.more').each(function() {

            var content = $(this).html();

            if( content.length > showChar ) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="#;" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        // Event for show more comment text button
        $('body').on('click', '.morelink', function(){

            if($(this).hasClass("less")) {

                $(this).removeClass("less");
                $(this).html(moretext);

            }else {

                $(this).addClass("less");
                $(this).html(lesstext);
            }

            $(this).parent().prev().toggle();
            $(this).prev().toggle();

            return false;

        });


        // Event for delete a comment button
        $('body').on('click', '.deleteComment', function(){

            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var commentId = $(this).attr('data-commentid');

            feedback.deleteComment(listingId, commentId);

        });





        // Event for reputation select
        $('body').on('click', '.fuserReputation .active-result', function(){

            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy = $(this).html();

            $(".fuserReputation").find("select").find("option").each(function(){

                if( $(this).html() === commentOrderBy){

                    commentOrderBy = $(this).attr("value");

                }

            });

            //alert(commentOrderBy);

            feedback.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);

        });

        $('body').on('click', '.user-page-navfeed .active-result', function(){

            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var viewLimitValue = $(this).html();

            $(".user-page-navfeed").find("select").find("option").each(function(){

                if( $(this).html() === commentOrderBy){

                    viewLimitValue = $(this).attr("value");

                }

            });

            var commentOrderBy = $('.fuserReputation .active-result').html();

            $(".fuserReputation").find("select").find("option").each(function(){

                if( $(this).html() === commentOrderBy){

                    commentOrderBy = $(this).attr("value");

                }

            });


            //alert(commentOrderBy);

            feedback.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);

        });


        // Event for user select
        $('body').on('click', '.fuserProfession .active-result', function(){


            var listingId = $(this).parents('#voice-your-opinions').attr('data-listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy;

            if( $(".fuserReputation").find(".chzn-results").find(".result-selected").html() != "" ){

                $(".fuserReputation").find("select").find("option").each(function(){

                    if( $(this).html() === $(".fuserReputation").find(".chzn-results").find(".result-selected").html() ){

                        commentOrderBy = $(this).attr("value");

                    }

                });

            }

            feedback.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);

        });




    });

</script>