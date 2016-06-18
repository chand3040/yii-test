
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
<form id="searchsmaples" action="" method="post">
<div class="samples-search-container">
<ul>

    <li><label>Date</label>
        <input type="date" id="date" name="date" value="<?php echo $_REQUEST['date']; ?>" size="13" tabindex="1"></li>
    <li><label>Username</label>
        <input type="text" id="username" name="username" value="<?php echo $_REQUEST['username']; ?>" size="15"  tabindex="2"></li>
    <li><label>Details</label>
        <input type="text" id="details" name="details" value="<?php echo $_REQUEST['details']; ?>"   size="50" tabindex="3"></li>
    <li><label>User Email Address</label>
        <input type="text" id="email" name="email" value="<?php echo $_REQUEST['email']; ?>"  size="30" tabindex="4"></li>
    <li><label>Amount</label>
        <input type="text" id="amount" name="amount" value="<?php echo $_REQUEST['amount']; ?>"   size="15" tabindex="5"></li>
</ul>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>

<div class="buttons" align="center">
    <input name="btnclear" value="Clear data" class="button blue" type="reset"/>
    <input name="btnsubmit" class="button dark-green" value="Submit" type="submit"/>
   <a href="index" class="button black black-btn">Return</a>
</div>
</form>
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
		<?php  if(count($list) > 0){
			 foreach($list as $row){
				 $listing_id = $row->user_default_listing_id;
				 $listing = Listings::model()->findByPk($listing_id);
				 $userid = $listing->user_default_profiles_id;
				 $userdata = User::model()->findByPk($userid);
				 
				 if($row->user_default_sample_listing_currency == "1")
					{
						$currency = "$";
					}
					if($row->user_default_sample_listing_currency == "2")
					{
						$currency = "&pound;";
					}
					if($row->user_default_sample_listing_currency == "3")
					{
						$currency = "&euro;";
					}
				 ?>
        <tr onclick="window.location='<?php echo Yii::app()->createUrl("/admin/listings/listings/sampleview/id/".$row->user_default_sample_listing_id); ?>'">

            <td><?php echo $userdata->user_default_username; ?></td>

            <td><?php echo $row->user_default_sample_listing_date; ?></td>

            <td><?php echo $listing->user_default_listing_title; ?></td>

            <td><?php echo substr($row->user_default_sample_listing_details,0,85).'...';?></td>

            <td><?php echo $userdata->user_default_email; ?></td>

            <td><?php echo $currency.$row->user_default_sample_listing_cost; ?></td>

        </tr>
		<?php 
		}
		}
		else 
		{
			?>
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
<?php 
}
?>
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
    <a href="<?php echo Yii::app()->createUrl("/admin/listings/listings/samplescsv"); ?>" class="button black black-btn" title="Download CSV">Download CSV</a>
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