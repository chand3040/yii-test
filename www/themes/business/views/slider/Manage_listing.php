<div class='home-slider-wrap'><div id='carousel-wrapper'><div id='dragongallery' class='stepcarousel'><div class='belt'><div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>hi<br /></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png'>
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1426615714.png' alt='' style='float: right;position: relative;overflow: hidden;height: 287px; top: -295px;margin-right: 24px;'/>
                                </div><!-- /panel -->

                            <!-- End of carousel content -->

                        </div>

                        <!-- /belt -->

                    </div>

                    <p class='hideme'> <b>Current Panel:</b> <span id='statusA'></span> <b style='margin-left: 30px'>Total Panels:</b> <span id='statusC'></span> </p>

                    <div id='gallery-navigation'>

                        <p id='dragongallery-paginate' style='width: 740px'> <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/opencircle.png' alt='Dragonsnet business supermarket navigation buttons' data-over='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/graycircle.png' data-select='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/closedcircle.png' data-moveby='1' /> </p>

                    </div>

                    <!-- /gallery-navigation -->                  
					<?php include('searchfunction.php'); ?>

                </div>

                <!-- /carousel-wrapper -->

            </div>

            <!-- /slider-wrapper ends here -->          <div class='home-video-wrap' style='display:none'> <!-- slider-wrapper start -->

                <a href='javascript:void(0)' onclick='show_slider();' class='video-close'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/close.png' alt='business supermarket close button' width='24' />

                </a>

                <div id='carousel-wrapper'>

                    <div id='dragongallery' class='stepcarousel'>

                        <div id='my-video'></div>

                      <script type='text/javascript'>                      </script>

                    </div>

                    <!-- /dragongallery End -->

                </div>

                <!-- /carousel-wrapper End -->

            </div>
			<script type='text/javascript'>

    function show_video(video)

    {

        $('.home-slider-wrap').fadeOut();

        $('.home-video-wrap').fadeIn('slow');

        jwplayer('my-video').setup({

            file: video,

            image: '<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/robot/defult-video.png',

            width: '640',

            height: '360',

            autostart:'true',

                      events: {                onComplete: function() { 								$('.home-slider-wrap').fadeIn('slow');				$('.home-video-wrap').fadeOut('fast'); 								}            }        

        });



    }



    function show_slider()

    {

        $('.home-slider-wrap').fadeIn('slow');

        $('.home-video-wrap').fadeOut('fast');

    }

</script>
