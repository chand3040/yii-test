<div class='home-slider-wrap'><div id='carousel-wrapper'><div id='dragongallery' class='stepcarousel'><div class='belt'><div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>Not sure what to do next? Then check out this short video to get you going.<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/gQVy7JGWq08');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1424708328.png' alt='' style='float: right;

position: relative;

overflow: hidden;height: 287px;

  top: -295px;

margin-right: 24px;

'/>

                                </div><div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>It costs nothing to list your business idea but the rewards could be lucrative.<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/N65U3m00esw');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1424708332.png' alt='' style='float: right;

position: relative;

overflow: hidden;height: 287px;

  top: -295px;

margin-right: 24px;

'/>

                                </div><div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>Need legal advice? Then check out the Business Services section for help<br /><a href='<?php echo Yii::app()->getBaseUrl(true); ?>/businesslisting/business-services'  target='_blank' title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1424708337.png' alt='' style='float: right;

position: relative;

overflow: hidden;height: 287px;

  top: -295px;

margin-right: 24px;

'/>

                                </div><div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>A fraid that someone will steal your idea? Then check out this short video to put your mind at ease<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/DfBGPXuCeFo');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1424708342.png' alt='' style='float: right;

position: relative;

overflow: hidden;height: 287px;

  top: -295px;

margin-right: 24px;

'/>

                                </div><div class='panel'><div class='paneloverlay-wrapper'><div class='paneloverlay-top'>&nbsp;</div><div class='paneloverlay'><p class='speech-bubble'>Get comprehensive data to show if your business idea has a good chance of success<br /><a href='javascript:void(0)' onclick="show_video('http://youtu.be/KFCg1N-FbNI');" title='' >Find out more ></a></p><p class='speech-bubble-sig'></p></div><!-- /paneloverlay --><div class='paneloverlay-bottom'>&nbsp;</div></div><!-- paneloverlay-wrapper -->
 <img src='<?php echo Yii::app()->getBaseUrl(true); ?>/themes/business/images/blank.png'><img src='<?php echo Yii::app()->getBaseUrl(true); ?>/upload/sliders/big/Business_supermarket_1424708347.png' alt='' style='float: right;

position: relative;

overflow: hidden;height: 287px;

  top: -295px;

margin-right: 24px;

'/>

                                </div><!-- /panel -->

                            <!-- End of carousel content -->

                        </div>

                        <!-- /belt -->

                    </div>

                    <p class='hideme'> <b>Current Panel:</b> <span id='statusA'></span> <b style='margin-left: 30px'>Total Panels:</b> <span id='statusC'></span> </p>

                    <div id='gallery-navigation'>

                        <p id='dragongallery-paginate' style='width: 740px'> <img src='/themes/business/images/opencircle.png' alt='Dragonsnet business supermarket navigation buttons' data-over='/themes/business/images/graycircle.png' data-select='/themes/business/images/closedcircle.png' data-moveby='1' /> </p>

                    </div>

                    <!-- /gallery-navigation -->                
					<?php include('searchfunction.php'); ?>

                </div>

                <!-- /carousel-wrapper -->

            </div>

            <!-- /slider-wrapper ends here -->          <div class='home-video-wrap' style='display:none'> <!-- slider-wrapper start -->

                <a href='javascript:void(0)' onclick='show_slider();' class='video-close'><img src='/themes/business/images/close.png' alt='business supermarket close button' width='24' />

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
