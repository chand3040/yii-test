
<style>
    .buttons > .button.blue,
    .buttons > .button.green,
    .buttons > .button.black{
        margin: 0 70px;
    }
    .chzn-container .chzn-results li{
        width: 100%;
    }
</style>
<?php $this->renderPartial("/layouts/sub_menu"); ?>
<center><h2 class="Blue">User sample search</h2></center>

<div class="samples-search-container">
<ul>

    <li><label>Date</label>
        <input type="text" id="date" name="date" value="12-02-2014" size="13" tabindex="1"></li>
    <li><label>Username</label>
        <input type="text" id="username" name="username" size="15" value="jsingh99" tabindex="2"></li>
    <li><label>Details</label>
        <input type="text" id="details" name="details" value="Sample face cream" size="50" tabindex="3"></li>
    <li><label>User Email Address</label>
        <input type="text" id="email" name="email" value="dsp7@blueyonder.co.uk" size="30" tabindex="4"></li>
    <li><label>Amount</label>
        <input type="text" id="amount" name="amount" value="$250" size="15" tabindex="5"></li>
</ul>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>

<div class="buttons" align="center">
    <input name="btnclear" value="Clear data" class="button blue" type="reset"/>
    <input name="btnsubmit" class="button dark-green" value="Submit" type="button"/>
    <input name="btnreturn" value="Return" class="button black black-btn" type="button"/>
</div>

<div class="clear">&nbsp;</div>
<div class="samples-list-container">
<div class="grid-container">
    <table class="gernal_table" style="background-color:#fff" width="100%" border="0" bordercolor="#fff" cellpadding="1"
           cellspacing="2">

        <tbody>
        <tr>

            <th>User</th>

            <th>Date</th>

            <th>Listing Title</th>

            <th>Details</th>

            <th>Email</th>

            <th>Amount</th>

        </tr>
        <tr onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/sampleview"); ?>'">

            <td>jsingh99</td>

            <td>21/10/1961</td>

            <td>Drivestop</td>

            <td>Sample face cream</td>

            <td>dsp7@blueyonder.co.uk</td>

            <td>$250</td>

        </tr>
        <tr>
            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>
        </tr>

        </tbody>
    </table>
</div>
<div style="width:100%;">
    <div class="view" style="float:left">
        <span style="position: relative; display: block; float: left; margin-top:6px; margin-right:10px;">View</span>
        <form action="" id="paging" method="post">
        <select name="drg_category" data-placeholder="12" class="chzn-select" style="width:60px;" tabindex="2">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
            <?php
            if (isset($_REQUEST)) {
                foreach ($_REQUEST as $key => $val) {
                    echo '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
                }
            }
            ?>
            <input type="hidden" name="rows" id="rows"/>
        </form>
    </div>

    <!-- <div style="float:right;">
        <ul id="navlist" class="pager">
            <li class="first hidden"><a href="#">&lt;</a></li>
            <li class="previous hidden"><a href="#">previous</a></li>
            <li class="page selected"><a href="#">1</a></li>
            <li class="page"><a href="#">2</a></li>
            <li class="next"><a href="#">next</a></li>
            <li class="last"><a href="#">&gt;</a></li>
        </ul>
    </div> -->
</div>

</div>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div align="center">
    <a href="#" class="button black black-btn" title="Download CSV">Download CSV</a>
</div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
    jQuery(".chzn-select").chosen();
    $(".chzn-select").on("change",function(){
        var val=$(this).val();
        $(".gernal_table tbody").html("");
        $(".gernal_table tbody").append('<tr><th>User</th><th>Date</th><th>Listing Title</th><th>Details</th><th>Email</th><th>Amount</th></tr><tr onclick="window.location=<?php echo Yii::app()->createUrl("/admin/listings/listings/sampleview"); ?>"><td>jsingh99</td><td>21/10/1961</td><td>Drivestop</td><td>Sample face cream</td><td>dsp7@blueyonder.co.uk</td><td>$250</td></tr>');
        for(i=1;i<val;i++){
            $(".gernal_table tbody").append("<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>");
        }
    });
});
</script>