<?php $this->renderPartial('application.modules.admin.views.layouts.listing_menu'); ?>
<div class="clear"></div>

<div class="content-container">

    <center><h2 class="Blue">Marketing Data</h2></center>

    <div class="submit_listing_box" style="height: 664px;">
        <div class="submit-listing_content">

            <div class="slisting-head">Marketing question 1 of 5</div>

            <!-- Top navigation menu -->
            <ul id="navlist" class="topNav" style="top:46px; left:752px; font-size: 1.2em; width:229px;">
                <li><a href="#">goto next marketing question &#062;&#062;</a></li>
            </ul>
            <!-- /Top navigation menu -->
            <textarea maxlength='100' name="drg_mktquestion" class="textarea-full"
                      style="text-align:center; padding:10px; font-size: 1.6em;" id="drg_mktquestion" cols="120"
                      rows="1"><?= $drg_mktquestion ?>
                If the plummate was available for $9.99 would you buy one?</textarea>

            <div class="clear"></div>
            <br/>

            <div class="row">
                <div class="col-1">
                    <label class="clearfix">Date Published
                        <input class="drg_fyear" id="drg_fyear1" value="21/10/2013" name="drg_fyear[]" type="text"/>
                    </label>
                </div>
                <div class="col-1">
                    <label class="clearfix">Number of days active
                        <input class="drg_fyear" id="drg_fyear2" value="45" name="drg_fyear[]" type="text"/>
                    </label>
                </div>
                <div class="col-1">
                    <label class="clearfix">Total votes received
                        <input class="drg_fyear" id="drg_fyear3" value="24,122,452" name="drg_fyear[]" type="text"/>
                    </label>
                </div>
                <div class="col-1">
                    <label class="clearfix" style="color:#96bc33;"><b> Yes </b>votes received
                        <input class="drg_fyear" id="drg_fyear4" value="20,123,100" name="drg_fyear[]" type="text"/>
                    </label>
                </div>
                <div class="col-1">
                    <label class="clearfix" style="color:#00acce;"><b> Maybe </b>votes received
                        <input class="drg_fyear" id="drg_fyear5" value="9,995,123" name="drg_fyear[]" type="text"/>
                    </label>
                </div>
                <div class="col-1">
                    <label class="clearfix" style="color:#BF1024;"><b> No </b>votes received
                        <input class="drg_fyear" id="drg_fyear6" value="12,123" name="drg_fyear[]" type="text"/>
                    </label>
                </div>
            </div>
            <div class="clear"></div>
            <div id="graph" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>


    </div>

</div><!--content-container-->

<script type="text/javascript">
    jQuery(function () {
        jQuery('#graph').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Recorded Marketing data for plummate'
            },
           /* subtitle: {
                text: 'Source: WorldClimate.com'
            },*/
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0
               /* title: {
                    text: 'Rainfall (mm)'
                }*/
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

            }]
        });
    });
</script>