<?php  if(count($list) > 0){
    foreach($list as $row){

        $sampleid = $row->user_default_sample_listing_id;
        $sorder = Sampleorder::model()->findByPk($sampleid);
        $sfeed = Samplefeedback::model()->findByPk($sampleid);
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

        $totalorders = count ( $sorder );
        $totalfeeds = count ( $sfeed );
        $outorders = Sampleorder::model()->findAll("user_default_sample_listing_id ='" . $sampleid . "' and 	user_default_sample_listing_order_status = '1'" );
        $ordersout = count ( $outorders );

        $date=date('Y-m-d h:i:s');
        $outorderss = Sampleorder::model()->findAll("user_default_sample_listing_id ='" . $sampleid . "' and 	user_default_sample_listing_order_date <= '$date'" );
        $ordersouts = count ( $outorderss );

        $cost = $ordersout * $row->user_default_sample_listing_cost;


        ?>
        <div class="history">
            <h2>History</h2>

            <p>Sample submissions to date</p>
            <?=$ordersouts;?>
            <p>Title</p>
            <span><?=$listing->user_default_listing_title;?></span>

            <p>Date in</p>
            <span>%21/10/2015%</span>

            <p>Date out</p>
            <span>%21/10/2016%</span>

            <p>Duration</p>
            <span>%256days%</span>

            <p>Samples sent out</p>
            <span><?=$ordersout;?></span>

            <p>Total cost</p>
            <span><?php echo $currency.$cost; ?></span>

            <p>Feedback received</p>
            <span><?=$totalfeeds;?></span>

        </div>
        <br style="clear:both;"/>
        <div class="view" style="float:left">

            <form action="" id="paging" method="post">

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

        <?php
    }
}
?>