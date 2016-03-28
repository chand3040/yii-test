<div style="width: 100%; overflow: hidden;">
    <div class="sample_audit" style="float: right;text-align: center">
        <div style="text-align:center">
            <span class="pinkTitle">Samples audit</span>

            <h3>Listing Title</h3>

            <h2>Drivestop rev 3.01</h2></div>
        <table class="drivestop">
            <tr>
                <td>Samples ordered:</td>
                <td><input type="text" value="" id="sample_ordered" name="sample_ordered"></td>
            </tr>
            <tr>
                <td>Samples sent out:</td>
                <td><input type="text" value="" id="sampleSentOut" name="sampleSentOut"></td>
            </tr>
            <tr>
                <td>
                   Total cost:
                </td>
                <td><input type="text" value="" id="total_cost" name="total_cost"></td>
            </tr>
            <tr>
                <td>Feedback received:</td>
                <td><input type="text" name="feedback_received" name="feedback_received" value=""></td>
            </tr>
        </table>
        <div class="history"><h2>History</h2>

            <p>Sample submissions to date</p>
            1
            <p>Title</p>
            <span>%name of previous sample%</span>

            <p>Date in</p>
            <span>%21/10/2015%</span>

            <p>Date out</p>
            <span>%21/10/2016%</span>

            <p>Duration</p>
            <span>%256days%</span>

            <p>Samples sent out</p>
            <span>%23,526%</span>

            <p>Total cost</p>
            <span>%$456.00%</span>

            <p>Feedback received</p>
            <span>%356,256,000%</span>

        </div>
        <br style="clear:both;"/>
        <div style="margin-right: 92px;">
            <ul name="test" id="navlist" class="pager">
                <li class="first hidden"><a href="#">&lt;</a></li>
                <li class="previous hidden"><a href="#">previous</a></li>
                <li class="page selected"><a href="#">1</a></li>
                <li class="page"><a href="#">2</a></li>
                <li class="next"><a href="#">next</a></li>
                <li class="last"><a href="#">&gt;</a></li>
            </ul>
        </div>

    </div>

    <div class="sample-view-container">

        <div class="orangetitle"> %sample title to go here%</div>

        <label>Details of samples available</label>
        <textarea rows="4" class="textarea-medium"></textarea>
        <label>What feedback the business is looking for</label>
        <textarea rows="4" class="textarea-medium"></textarea>
        <label>How to obtain a sample</label>
        <textarea rows="4" class="textarea-medium"></textarea>
        <label>Special instructions</label>
        <textarea rows="4" class="textarea-medium" style="width:350px !important"></textarea>

        <label>Company Details</label>

        <div class="company_details">
            <div class="sample_image">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/avatar.jpg"/>

                <div class="clear">&nbsp;</div>
                <input type="button" class="button black-btn" value="Upload">
            </div>
            <div class="company_address" style="float: left;">
                <label>Address 1</label>
                <input type="text" id="address1" name="adddress1" value=""/>
                <label>Address 2</label>
                <input type="text" id="address2" name="address2" value=""/>
                <label>Address 3</label>
                <input type="text" id="address3" name="address3" value=""/>
                <label>Town</label>
                <input type="text" id="town" name="town" value=""/>
                <label>Zip Code</label>
                <input type="text" id="zip_code" name="zip_code" value=""/>
            </div>


            <div style="clear:both;"></div>

        </div>


    </div>
    <br style="clear:both;"/>

    <script type="text/javascript">

    </script>

