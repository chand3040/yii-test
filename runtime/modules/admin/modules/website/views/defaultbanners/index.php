<div class="content-container">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('../layouts/_top_menu'); ?>

</div>
<div class="heading">
    <h3>Default Website Banners</h3>
</div>

<div class="content-container">

    <!--Default Banner Box-->
    <?php foreach (range(1, 6) as $number) {

        $bannerId = $number;
        $siteBannerAds = SiteBannerads::model()->findByPk($number);
        ?>

        <div class="site-bannerAds-box <?php echo ($number % 2 != 0) ? 'banneradvert-left' : 'banneradvert-right'; ?>">
            <label
                style="color: #BC6B9B;font-size: 16px;font-weight: 550;">Banner <?php echo($number); ?></label>

            <div class="row" style="padding-left: 16px;margin:10px 0;">

                <div class="col-6 banner-image">
                    <?php if ($siteBannerAds->user_default_banner_path != '' && file_exists('upload/' . $siteBannerAds->user_default_banner_path)) { ?>
                        <a class="single_image"
                           href="<?php echo Yii::app()->getBaseUrl(true) . '/upload/' . $siteBannerAds->user_default_banner_path; ?>"><img
                                src="<?php echo Yii::app()->getBaseUrl(true) . '/upload/' . $siteBannerAds->user_default_banner_path; ?>"
                                alt="<?php echo $siteBannerAds->user_default_banner_link; ?>"
                                class="dragonMain"/></a>
                    <?php } else { ?>
                        <img
                            src="<?php echo Yii::app()->getBaseUrl(true) . '/upload/banner-images/banners_index/blank.png'; ?>"
                            alt="<?php echo $siteBannerAds->user_default_banner_link; ?>"
                            class="dragonMain"/>
                    <?php } ?>

                </div>
            </div>
            <div class="row" style="padding-left: 16px;margin:5px 0;">
                <div style="width:80%">
                    <input type="hidden" name="banner_id"
                           value="<?php echo $siteBannerAds->user_default_banner_id; ?>"/>
                    <input type="file" name="fileBannerAds" class="fileBannerAds" style="display:none;"/>
                    <input type="text" class="uploader-field" name="banner_path"
                           value="<?php echo $siteBannerAds->user_default_banner_path; ?>" readonly
                           style="width: 310px;height: 15px;border: 1px solid #000;margin-left: 2%"/>
                    <label class="upload-img" onclick="javascript:getFile(this);"
                           style="/*margin: 11px -93px 0px -14px;*/font-size: 10px">Upload image</label>
                    <button class="login_sbmt" name="login_sbmt" type="button" onclick="javascript:getFile(this);"
                            title="" style="margin: 0 -80px 0px 0px;">
                        <img class="user-btn-img"
                             src="<?php echo Yii::app()->theme->baseUrl; ?>/images/buttons/user.png">
                    </button>
                </div>
            </div>
            <div class="row" style="margin-top: 8px;padding-left: 16px;margin:5px 0;">

                <div class="col-3">
                        <span><input type="text" name="banner_link"
                                     value="<?php echo $siteBannerAds->user_default_banner_link; ?>"
                                     style="width: 310px;height: 15px;border:1px solid #000;margin-left: 2%;font-size: 13px;"/></span>
                    <div
                        style="float: right;  margin-right: -50%;margin-bottom: 15px;margin-top: -8%;"><label
                            style=" float: right;font-size: 10px">Enter banner link</label></div>

                </div>
            </div>
            <div class="row" style="margin-left: 10%;margin-bottom:5%">
                <div class="col-2" align="center" style="margin-right:80px;">
                    <input type="submit" class="deleteBanner button red" value="Delete"></div>
                <?php if ($siteBannerAds->user_default_banner_status == '1') { ?>
                    <input type="submit" class="unpublishBanner button black" value="Unpublish">
                <?php } else { ?>
                    <input type="submit" class="publishBanner button black" value="Publish">
                <?php } ?>

            </div>
        </div>


    <?php } ?>
    <div class="clear">&nbsp;</div>

</div>

<script>

jQuery(".chzn-select").chosen();
jQuery(".chzn-select-deselect").chosen({allow_single_deselect: true});
jQuery(".single_image").fancybox();

function getFile(_this) {
    var fileInputControl = jQuery(_this).closest('div').find('input[type="file"]');
    fileInputControl.click();
}
jQuery(window).load(function () {
    var bannerAdvertLeftHeight = jQuery(".banneradvert-left").height();
    jQuery(".banneradvert-right").css("height", bannerAdvertLeftHeight);
});
jQuery(document).ready(function () {

    jQuery('.fileBannerAds').change(function (e) {

        var fileInputControl = jQuery(this);
        var bannerParentControl = fileInputControl.closest('div.site-bannerAds-box');
        var banner_path = bannerParentControl.find('input[name="banner_path"]');
        if (fileInputControl.val() != '') {
            var uploadFile = fileInputControl[0].files[0]; //console.log(uploadFile.name);
            var currentDate = '<?php echo date('Y-m-d-h-i-s'); ?>';
            var fileNameFull = uploadFile.name;
            var fileName = fileNameFull.substr(0, fileNameFull.lastIndexOf('.')) || fileNameFull;
            var ext = fileNameFull.split('.').pop();
            var filePath = 'banner-images/banners_index/' + fileName + '.' + ext; //console.log(filePath);
            if (parseInt(uploadFile.size / 1024) < 101) {

                banner_path.val(filePath);

                // show preview of the image with
                var tempFilePath = URL.createObjectURL(e.target.files[0]);
                var prevImage = '<img src="' + tempFilePath + '" ' +
                    'height="77" width="420" ' +
                    'title="new uploaded banner image" class="dragonMain"/>';
                bannerParentControl.find('div.banner-image').html(prevImage);

            } else {
                alert("please select other image ");
            }
        } else {
            alert('Please select a file.')
        }
    });

    jQuery('.deleteBanner').click(function () {

        if (confirm("Are you sure? Do you want to delete this banner")) {

            var bannerControlBox = jQuery(this).closest('div.site-bannerAds-box');
            var banner_id = bannerControlBox.find('input[name="banner_id"]').val();
            jQuery.ajax({
                type: "GET",
                url: '<?php echo Yii::app()->baseUrl?>/admin/website/defaultBanners/deleteBanner',
                data: {
                    banner_id: banner_id
                },
                success: function (result) {
                    var jsonData = jQuery.parseJSON(result);
                    if (jsonData.action_status != '1') {
                        alert(jsonData.message);
                    } else {
                        window.location.reload('<?php echo Yii::app()->createUrl("admin/website/defaultBanners");?>');
                    }
                },
                error: function (xhr, tStatus, e) {

                    if (xhr.status == 302) {
                        // User in not loggued in
                        alert("You must be logged in.");

                    } else {

                        if (!xhr) {
                            console.log(" We have an error ");
                            console.log(tStatus + " " + e.message);
                        } else {
                            console.log("else: " + e.message); // the great unknown
                        }
                    }
                },
                complete: function () {
                    return true;
                }
            });
        }
        return false;
    });

    jQuery('.publishBanner').click(function (e) {

        var bannerControlBox = jQuery(this).closest('div.site-bannerAds-box');
        var resultValid = validateBannerAds(bannerControlBox);
        if (resultValid == true) {

            var banner_id = bannerControlBox.find('input[name="banner_id"]').val();
            var banner_path = bannerControlBox.find('input[name="banner_path"]').val();
            var banner_link = bannerControlBox.find('input[name="banner_link"]').val();

            var fileInputControl = bannerControlBox.find('input[name="fileBannerAds"]');
            if (fileInputControl.val() != '') {
                uploadBannerAttachement(fileInputControl);
            }

            jQuery.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('admin/website/defaultBanners/publish'); ?>",
                data: {
                    banner_id: banner_id,
                    banner_path: banner_path,
                    banner_link: banner_link
                },
                success: function (result) {
                    var jsonData = jQuery.parseJSON(result);
                    if (jsonData.action_status != '1') {
                        alert(jsonData.message);
                    } else {
                        window.location.reload('<?php echo Yii::app()->createUrl("admin/website/defaultBanners");?>');
                    }
                },
                error: function (xhr, tStatus, e) {

                    if (xhr.status == 302) {
                        // User in not loggued in
                        alert("You must be logged in.");

                    } else {
                        if (!xhr) {
                            console.log(" We have an error ");
                            console.log(tStatus + " " + e.message);
                        } else {
                            console.log("else: " + e.message); // the great unknown
                        }
                    }
                },
                complete: function () {
                    return true;
                }
            });
        }
        e.preventDefault();
    });

    jQuery('.unpublishBanner').click(function (e) {

        var bannerControlBox = jQuery(this).closest('div.site-bannerAds-box');
        var banner_id = bannerControlBox.find('input[name="banner_id"]').val();
        jQuery.ajax({
            type: "GET",
            url: "<?php echo Yii::app()->createUrl('admin/website/defaultBanners/unpublish'); ?>",
            data: {
                banner_id: banner_id
            },
            success: function (result) {
                var jsonData = jQuery.parseJSON(result);
                if (jsonData.action_status != '1') {
                    alert(jsonData.message);
                } else {
                    window.location.reload('<?php echo Yii::app()->createUrl("admin/website/defaultBanners");?>');
                }
            },
            error: function (xhr, tStatus, e) {

                if (xhr.status == 302) {
                    // User in not loggued in
                    alert("You must be logged in.");

                } else {
                    if (!xhr) {
                        console.log(" We have an error ");
                        console.log(tStatus + " " + e.message);
                    } else {
                        console.log("else: " + e.message); // the great unknown
                    }
                }
            },
            complete: function () {
                return true;
            }
        });
        e.preventDefault();
    });
});

function validateBannerAds(bannerControlBox) {

    var banner_path = bannerControlBox.find('input[name="banner_path"]');
    var banner_link = bannerControlBox.find('input[name="banner_link"]');
    var resultValid = true;
    if (banner_path.val() == '') {
        banner_path.css('border', '1px solid #f00');
        resultValid = false;
    }
    return resultValid;
}
function uploadBannerAttachement(attachement) {

    // Create a formdata object and add the files
    var formData = new FormData();
    var fileSelect = attachement;

    var file = fileSelect[0].files[0];
    // Add the file to the request.
    formData.append('attachement', file, file.name);

    jQuery.ajax({

        url: "<?php echo Yii::app()->baseUrl?>/admin/website/defaultBanners/uploadAttachement",
        type: 'POST',
        data: formData,
        async: true,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request

        success: function (resp) {
            if (resp.action_status == '0') {
                alert(resp.message);
            }
        },
        error: function (xhr, tStatus, e) {

            if (xhr.status == 302) {
                // User in not loggued in
                alert("You must be logged in.");

            } else {

                if (!xhr) {
                    console.log(" We have an error ");
                    console.log(tStatus + " " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            }
        },
        complete: function () {
            return true;
        }

    });

}
</script>