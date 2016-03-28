<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jvectormap/jquery-jvectormap-2.0.4.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/js/jvectormap/jquery-jvectormap-2.0.4.css"
      type="text/css" media="screen"/>

<div id="shadow-wrap">

<!-- left content starts here -->

<div id="leftcontent">

    <div style="position: absolute; margin: -80px 0 0 184px; width: 55%;">
        <h1 style="text-align:center; font-size:2em;">Marketing Data</h1>
    </div>

    <div style="margin:-31px 0 16px -128px;">
        <p class="breadcrumb"><a
                href="<?php echo Yii::app()->createUrl('/user/myaccount/update'); ?>"
                title="Goto to my account">my account</a> >
            <a href="<?php echo Yii::app()->createUrl('/listing'); ?>" title="Goto manage listings menu"> manage
                listings</a> >
            <a href="<?php echo Yii::app()->createUrl('/listing/selectlisting', array('listid' => $listid)); ?>"
               title="Goto select listings menu"> select listing action</a> > marketing data</p>
    </div>
</div>
<div class="clear"></div>
<div class="full-width-content" style="margin-top: -10px;"><!-- /full-width-content start -->

<?php if ($listingMarketing) { ?>
    <div class="submit_listing_box" style="height: 664px;">
    <div class="submit-listing_content">

    <div class="slisting-head">Marketing question <?php echo($offset + 1) ?>
        of <?php echo($totalRecords) ?></div>

    <!-- Top navigation menu -->
    <?php
    if ($totalRecords > 1) {
        $prevRecord = (int)(($offset - 1) >= 0) ? ($offset - 1) : $offset;
        $nextRecord = (int)(($offset + 1) < $totalRecords) ? ($offset + 1) : $offset;
        ?>
        <ul id="navlist" class="topNav" style="font-size: 1.2em; /*margin-top: 10px;*/ float: right;">
            <?php if ($prevRecord || $prevRecord == 0) : ?>
                <a href="<?php echo Yii::app()->createUrl('/listing/marketingdata?id=' . $listid . '&offset=' . $prevRecord); ?>"
                   title="Goto previous marketing question">&#60;&#60; </a></li>
            <?php endif; ?> &nbsp;&nbsp;&nbsp;&nbsp;

            <?php if ($nextRecord) : ?>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/listing/marketingdata?id=' . $listid . '&offset=' . $nextRecord); ?>"
                       title="Goto next marketing question">&#062;&#062;</a></li>
            <?php endif; ?>

        </ul>
    <?php } ?>
    <!-- /Top navigation menu -->
    <textarea maxlength='100' name="drg_mktquestion" class="textarea-full"
              style="text-align:center; padding:10px; font-size: 1.6em;" id="drg_mktquestion" cols="120"
              rows="1"><?php echo $listingMarketing->user_default_listing_marketing_question; ?></textarea>

    <div class="clear"></div>
    <br/>

    <div class="sl-financial">
        <label class="clearfix">Date Published
            <input class="drg_fyear" id="drg_fyear1"
                   value="<?php echo SharedFunctions::convertDateAsDisplayFormat($listingMarketing->user_default_listing_marketing_question_submission_date, 'd/m/Y'); ?>"
                   name="date_published" type="text"/>
        </label>
        <label class="clearfix">Number of days active
            <?php
            $questionId = $listingMarketing->user_default_listing_marketing_id;
            $date1 = $listingMarketing->user_default_listing_marketing_question_submission_date;
            $date2 = $listingMarketing->user_default_listing_marketing_question_end_date;
            $noOfDaysActive = SharedFunctions::getDateDiffAsDays($date1, $date2);

            // REQUESTED VARS
            $params2 = SharedFunctions::decodeStringAsArray($params);
            //$listid = $params2['listid'];
            $start_date = $params2['start_date'];
            $end_date = $params2['end_date'];
            $userType = $params2['userType'];
            $graphType = $params2['graphType'];
            $voteType = $params2['voteType'];

            $totalVotes = ListingMarketingConnection::getTotalVotes($questionId, $start_date, $end_date, '', $userType);
            $yesVotes = ListingMarketingConnection::getYesVotes($questionId, $start_date, $end_date, '', $userType);
            $maybeVotes = ListingMarketingConnection::getMaybeVotes($questionId, $start_date, $end_date, '', $userType);
            $noVotes = ListingMarketingConnection::getNoVotes($questionId, $start_date, $end_date, '', $userType);
            ?>
            <input class="drg_fyear" id="drg_fyear2" value="<?php echo $noOfDaysActive; ?>"
                   name="noOfActiveDays" type="text"/>
        </label>
        <label class="clearfix">Total votes received
            <input class="drg_fyear" id="drg_fyear3" value="<?php echo $totalVotes ? $totalVotes : ''; ?>"
                   name="totalVotes" type="text"/>
        </label>
        <label class="clearfix" style="color:#96bc33;"><b> Yes </b>votes received
            <input class="drg_fyear" id="drg_fyear4" value="<?php echo $yesVotes ? $yesVotes : ''; ?>" name="yesVotes"
                   type="text"/>
        </label>
        <label class="clearfix" style="color:#00acce;"><b> Maybe </b>votes received
            <input class="drg_fyear" id="drg_fyear5" value="<?php echo $maybeVotes ? $maybeVotes : ''; ?>"
                   name="maybeVotes" type="text"/>
        </label>
        <label class="clearfix" style="color:#BF1024;"><b> No </b>votes received
            <input class="drg_fyear" id="drg_fyear6" value="<?php echo $noVotes ? $noVotes : ''; ?>" name="noVotes"
                   type="text"/>
        </label>
    </div>
    <div class="clear"></div>

    <?php
    if ($graphType != 'geolocation') {
        //
        if ($graphType == 'line')
            $chartType = 'MSLine';
        else if ($graphType == 'pie')
            $chartType = 'Pie2D';
        else
            $chartType = 'MSColumn2D';

        $this->widget('ext.fusioncharts.fusionChartsWidget', array(
            'chartNoCache' => true, // disabling chart cache
            //'debugMode' => true,
            'registerWithJS' => true,
            'chartType' => $chartType, // MSColumn2D, MSLine & Pie2D
            'chartWidth' => '970',
            'chartHeight' => '420',
            'chartAction' => Yii::app()->createUrl('/listing/marketingDataChart?params=' . $params),
            'chartId' => 'marketingData')); // If you display more then one chart on a single page then make sure you specify and id

    } else if ($graphType == 'geolocation') {

        // user listing
        $userListing = Userlisting::model()->findByPk($listid);

        $caption = 'Recorded Marketing Data for ' . $userListing->user_default_listing_title;
        $subCaption = date('d/m/Y', strtotime($start_date)) . ' - ' . date('d/m/Y', strtotime($end_date));

        // Marketing Data by each type
        $markers = array();
        if ($voteType == 'Yes')
            SharedFunctions::setLatLngUserVotes($markers, ListingMarketingConnection::getYesVoteUsersAddressInfo($questionId, $start_date, $end_date, '', $userType), '#CF0');
        else if ($voteType == 'Maybe')
            SharedFunctions::setLatLngUserVotes($markers, ListingMarketingConnection::getMaybeVoteUsersAddressInfo($questionId, $start_date, $end_date, '', $userType), '#CFF');
        else if ($voteType == 'No')
            SharedFunctions::setLatLngUserVotes($markers, ListingMarketingConnection::getNoVoteUsersAddressInfo($questionId, $start_date, $end_date, '', $userType), '#F5A');
        else {
            SharedFunctions::setLatLngUserVotes($markers, ListingMarketingConnection::getYesVoteUsersAddressInfo($questionId, $start_date, $end_date, '', $userType), '#CF0');
            SharedFunctions::setLatLngUserVotes($markers, ListingMarketingConnection::getMaybeVoteUsersAddressInfo($questionId, $start_date, $end_date, '', $userType), '#CFF');
            SharedFunctions::setLatLngUserVotes($markers, ListingMarketingConnection::getNoVoteUsersAddressInfo($questionId, $start_date, $end_date, '', $userType), '#F5A');
        }

        $markersJSON = json_encode($markers); //echo '<pre>'; print_r($markersJSON);
    }
    ?>

    <div class="world-map-container" style="display: none;">
        <div class="world-map-title"><?php echo $caption; ?></div>
        <div class="world-map-duration"><?php echo $subCaption; ?></div>
        <div style="margin: -5% 0% 0px 82%;">
            <label style="color: palevioletred;">Vote</label>

            <div><select id="vote-type" data-placeholder="Please select" class="chzn-select"
                         onchange="reloadPage(self.location+'&voteType='+this.options[this.selectedIndex].value); return false;"
                         style="width:100px;">
                    <option value="" title="All">All</option>
                    <option value="Yes"
                            title="Yes" <?php if ($voteType == 'Yes') : ?> selected="selected" <?php endif; ?>>Yes
                    </option>
                    <option value="Maybe"
                            title="Maybe" <?php if ($voteType == 'Maybe') : ?> selected="selected" <?php endif; ?>>Maybe
                    </option>
                    <option value="No" title="No" <?php if ($voteType == 'No') : ?> selected="selected" <?php endif; ?>>
                        No
                    </option>
                </select></div>
            <div style="margin: -30px 102px 5px 100px">
                <div style="background-color:#CF0;width: 11px;height: 11px;margin:3px;"><span
                        style="padding-left: 13px; color: #808080">&nbsp;Yes</span></div>

                <div style="background-color:#CFF;width: 11px;height: 11px;margin:3px;"><span
                        style="padding-left: 13px; color: #808080">&nbsp;Maybe</span></div>

                <div style="background-color:#F5A;width: 11px;height: 11px;margin:3px;"><span
                        style="padding-left: 13px; color: #808080">&nbsp;No</span></div>
            </div>

        </div>

        <div id="world-map">Loading map...</div>

    </div>

    <div class="nav-button">
        <button class="prev" data-value="prev"
                onclick="reloadPage(self.location+'&nav=prev'); return false;">&nbsp;</button>
        <button class="next" data-value="next"
                onclick="reloadPage(self.location+'&nav=next'); return false;">&nbsp;</button>
    </div>
    <div class="clear"></div>
    <div>&nbsp;</div>

    <div class="clear"></div>

    <div class="sl-filters">

        <div class="select-box">
            <?php
            $selectedPeriod = Yii::app()->request->getQuery('period');
            ?>
            <select id="sl_period" name="sl_period" data-placeholder="Please select"
                    class="chzn-select" style="width:200px;"
                    onchange="reloadPage(self.location+'&period='+this.options[this.selectedIndex].value); return false;"
                    tabindex="2">
                <option value="weekly"
                        title="Get 12 hours access to your listing" <?php if ($selectedPeriod == 'weekly') : ?> selected="selected" <?php endif; ?> >
                    Week view
                </option>
                <option value="monthly"
                        title="Get 7 days access to your listing" <?php if ($selectedPeriod == 'monthly') : ?> selected="selected" <?php endif; ?>>
                    Month view
                </option>
            </select>

            <div class="label">
                <label class="label" for="sl_period">Select period</label>
                <a href="#;" style="background:none;" class="tooltip"> <b> ? </b><span class="classic"
                                                                                       style="text-align: left;">View your voting data by week or by month</span>
                </a>
            </div>
        </div>
        <div class="select-box">

            <?php
            $resultProfessions = Profession::model()->findAll(array('order' => 'profession_name'));
            //$selectedProfession = Yii::app()->request->getQuery('userType');
            ?>
            <select id="sl_user_profession" name="sl_user_profession" data-placeholder=" "
                    class="chzn-select"
                    onchange="reloadPage(self.location+'&nav=&userType='+this.options[this.selectedIndex].value);return false;"
                    style="width:200px;" tabindex="2">
                <option value="">All</option>
                <?php if ($resultProfessions) : ?>
                    <?php foreach ($resultProfessions as $profession) : ?>
                        <option
                            value="<?php echo $profession->profession_id; ?>" <?php if ($userType == $profession->profession_id) : ?> selected="selected" <?php endif; ?>><?php echo $profession->profession_name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <div class="label">
                <label class="label" for="sl_user_profession">Select user type</label>
                <a href="#;" style="background:none;" class="tooltip"> <b> ? </b><span class="classic"
                                                                                       style="text-align: left;">Select a user type to see how they voted on your business idea</span>
                </a>
            </div>
        </div>
        <div class="select-box">
            <?php
            //$selectedGraphType = Yii::app()->request->getQuery('graphType', 'bar');
            ?>
            <select id="sl_graph_type" name="sl_graph_type" data-placeholder="Please select"
                    class="chzn-select"
                    onchange="reloadPage(self.location+'&nav=&graphType='+this.options[this.selectedIndex].value); return false;"
                    style="width:200px;" tabindex="2">
                <option value="bar"
                        title="Bar graph" <?php if ($graphType == 'bar') : ?> selected="selected" <?php endif; ?>>
                    Bar Graph
                </option>
                <option value="line"
                        title="Line graph" <?php if ($graphType == 'line') : ?> selected="selected" <?php endif; ?>>
                    Line Graph
                </option>
                <option value="pie"
                        title="Pie chart" <?php if ($graphType == 'pie') : ?> selected="selected" <?php endif; ?>>
                    Pie Chart
                </option>
                <option value="geolocation"
                        title="View data by geolocation" <?php if ($graphType == 'geolocation') : ?> selected="selected" <?php endif; ?>>
                    View data by geolocation
                </option>
            </select>

            <div class="label">
                <label class="label" for="sl_graph_type">Select graph type</label>
                <a href="#;" style="background:none;" class="tooltip"> <b> ? </b><span class="classic"
                                                                                       style="text-align: left;">Select a graph format that best visualises your data</span>
                </a>
            </div>
        </div>
    </div>
    </div>
    <div class="clear"></div>

    </div>
<?php } else { ?>
    <div>No questions for this listing.</div>
<?php } ?>
</div>
</div> <!-- /shadow-wrap -->

<script>
    /*Styles the dropdown menu listbox This must be at the bottom to work*/
    $(".chzn-select").chosen();

    /* Gets striped url and reload page with params */
    function reloadPage(url) {
        var tempParams = {};
        var paramsArray = new Array();
        var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            if (key != 'params') {
                tempParams[key] = value;
            }

        });
        for (key in tempParams) {
            paramsArray.push(key + '=' + encodeURIComponent(tempParams[key]));
        }

        var newParams = paramsArray.join('&');
        var url = window.location.href.split('?')[0];
        window.location.href = url + '?' + newParams + '&params=<?php echo $params;?>';
    }

    function drawMarkersGeoLocation(data) {

        $('#world-map').empty();
        $('#world-map').vectorMap({
            map: 'world_mill_en',
            scaleColors: ['#C8EEFF', '#0071A4'],
            normalizeFunction: 'polynomial',
            hoverOpacity: 0.7,
            hoverColor: false,
            markerStyle: {
                initial: {
                    fill: '#F8E23B',
                    stroke: '#383f47',
                    r: 2
                }
            },
            backgroundColor: '#B5D5F3',
            markers: data
        });
    }

</script>

<?php if ($graphType == 'geolocation') { ?>
    <script>

        $('.world-map-container')
            .show()
            .css({'margin-top': '10px'});
        $('#world-map').css({height: '400px', 'margin-left': '34px'});
        var markers = {};
        markers = <?php echo $markersJSON;?>; //console.log(markers);

        // Draw markes on world map
        drawMarkersGeoLocation(markers);
    </script>
<?php } ?>

