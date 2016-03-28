<?php

/* @var $this DefaultController */

// currency converter
$currencyConverter = new ECurrencyConverter();

$currency_code = 'USD';
$currency_symbol = '$';
if ($currency_id) {
    $currency_code = Currency::model()->findByPk($currency_id)->currency_code; //echo $currency_code;
    $currency_symbol = SharedFunctions::_get_currency_symbol($currency_code);
}
$currencyConverter->currencyConverter();

?>
<div class="content-container">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('../layouts/_top_menu'); ?>

</div>

<div class="heading">
    <h3>Module Defaults</h3>
</div>

<div class="website-container">
<div class="row">
    <div class="col-3">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>Business Listing Costs</h2></div>
            <?php

            // Module : Business Listing Costs result
            $resBLC = WebsiteDefaults::model()->findAllByAttributes(array('module' => 'Business Listing Costs'), array('order' => 'id ASC', 'limit' => 3));
            if ($resBLC) {

                $resBLC_cost1 = $resBLC[0]->cost;
                $resBLC_cost1_id = $resBLC[0]->id;

                $resBLC_cost2 = $resBLC[1]->cost;
                $resBLC_cost2_id = $resBLC[1]->id;

                $resBLC_cost3 = $resBLC[2]->cost;
                $resBLC_cost3_id = $resBLC[2]->id;

                $resBLC_currency_code = $resBLC[0]->currency->currency_code;
                if ($resBLC_currency_code != $currency_code) {
                    $resBLC_cost1 = $currencyConverter->convert($resBLC_cost1, $resBLC_currency_code, $currency_code);
                    $resBLC_cost2 = $currencyConverter->convert($resBLC_cost2, $resBLC_currency_code, $currency_code);
                    $resBLC_cost3 = $currencyConverter->convert($resBLC_cost3, $resBLC_currency_code, $currency_code);
                }
            }
            ?>
            <table width="100%" align="center">
                <tr>
                    <td>&nbsp;</td>
                    <td>3 Months</td>
                    <td>6 Months</td>
                    <td>12 Months</td>
                </tr>
                <tr>
                    <td style="width: 13%;text-align: left;">Cost</td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="blc_cost1"
                               value="<?php echo isset($resBLC_cost1) ? $resBLC_cost1 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="blc_cost1_id"
                               value="<?php echo isset($resBLC_cost1_id) ? $resBLC_cost1_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="blc_cost2"
                               value="<?php echo isset($resBLC_cost2) ? $resBLC_cost2 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="blc_cost2_id"
                               value="<?php echo isset($resBLC_cost2_id) ? $resBLC_cost2_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="blc_cost3"
                               value="<?php echo isset($resBLC_cost3) ? $resBLC_cost3 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="blc_cost3_id"
                               value="<?php echo isset($resBLC_cost3_id) ? $resBLC_cost3_id : ''; ?>"/>
                    </td>

                </tr>
            </table>
            <div class="update_btn-section">
                <input type="button" name="btnupdate" value="Update" class="button black black-btn"
                       onclick="return updateDefaults(this, 'Business Listing Costs');">
                <span class="statusControl">&nbsp;</span>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>Marketing Data Costs</h2></div>
            <?php

            // Module : Marketing Data Costs result
            $resMDC = WebsiteDefaults::model()->findAllByAttributes(array('module' => 'Marketing Data Costs'), array('order' => 'id ASC', 'limit' => 3));
            if ($resMDC) {

                $resMDC_cost1 = $resMDC[0]->cost;
                $resMDC_cost1_id = $resMDC[0]->id;

                $resMDC_cost2 = $resMDC[1]->cost;
                $resMDC_cost2_id = $resMDC[1]->id;

                $resMDC_cost3 = $resMDC[2]->cost;
                $resMDC_cost3_id = $resMDC[2]->id;

                $resMDC_currency_code = $resMDC[0]->currency->currency_code;
                if ($resMDC_currency_code != $currency_code) {
                    $resMDC_cost1 = $currencyConverter->convert($resMDC_cost1, $resMDC_currency_code, $currency_code);
                    $resMDC_cost2 = $currencyConverter->convert($resMDC_cost2, $resMDC_currency_code, $currency_code);
                    $resMDC_cost3 = $currencyConverter->convert($resMDC_cost3, $resMDC_currency_code, $currency_code);
                }
            }

            ?>
            <table width="100%" align="center">
                <tr>
                    <td>&nbsp;</td>
                    <td>3 Months</td>
                    <td>6 Months</td>
                    <td>12 Months</td>
                </tr>
                <tr>
                    <td style="width: 13%;text-align: left;">Cost</td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="mdc_cost1"
                               value="<?php echo isset($resMDC_cost1) ? $resMDC_cost1 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="mdc_cost1_id"
                               value="<?php echo isset($resMDC_cost1_id) ? $resMDC_cost1_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="mdc_cost2"
                               value="<?php echo isset($resMDC_cost2) ? $resMDC_cost2 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="mdc_cost2_id"
                               value="<?php echo isset($resMDC_cost2_id) ? $resMDC_cost2_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="mdc_cost3"
                               value="<?php echo isset($resMDC_cost3) ? $resMDC_cost3 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="mdc_cost3_id"
                               value="<?php echo isset($resMDC_cost3_id) ? $resMDC_cost3_id : ''; ?>"/>
                    </td>

                </tr>
            </table>
            <div class="update_btn-section">
                <input type="button" name="btnupdate" value="Update" class="button black black-btn"
                       onclick="return updateDefaults(this, 'Marketing Data Costs');">
                <span class="statusControl">&nbsp;</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>Admin Charges</h2></div>
            <?php

            // Module : Admin Charges result
            $resADC = WebsiteDefaults::model()->findAllByAttributes(array('module' => 'Admin Charges'), array('order' => 'id ASC', 'limit' => 3));
            if ($resADC) {

                $resADC_cost1 = $resADC[0]->cost;
                $resADC_cost1_id = $resADC[0]->id;

                $resADC_cost2 = $resADC[1]->cost;
                $resADC_cost2_id = $resADC[1]->id;

                $resADC_cost3 = $resADC[2]->cost;
                $resADC_cost3_id = $resADC[2]->id;

                $resADC_currency_code = $resADC[0]->currency->currency_code;
                if ($resADC_currency_code != $currency_code) {
                    $resADC_cost1 = $currencyConverter->convert($resADC_cost1, $resADC_currency_code, $currency_code);
                    $resADC_cost2 = $currencyConverter->convert($resADC_cost2, $resADC_currency_code, $currency_code);
                    $resADC_cost3 = $currencyConverter->convert($resADC_cost3, $resADC_currency_code, $currency_code);
                }

            }

            ?>
            <table width="100%" align="center">
                <tr>
                    <td>&nbsp;</td>
                    <td>Band 1</td>
                    <td>Band 2</td>
                    <td>Band 3</td>
                </tr>
                <tr>
                    <td style="width: 13%;text-align: left;">Cost</td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="adc_cost1"
                               value="<?php echo isset($resADC_cost1) ? $resADC_cost1 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="adc_cost1_id"
                               value="<?php echo isset($resADC_cost1_id) ? $resADC_cost1_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="adc_cost2"
                               value="<?php echo isset($resADC_cost2) ? $resADC_cost2 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="adc_cost2_id"
                               value="<?php echo isset($resADC_cost2_id) ? $resADC_cost2_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="adc_cost3"
                               value="<?php echo isset($resADC_cost3) ? $resADC_cost3 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="adc_cost3_id"
                               value="<?php echo isset($resADC_cost3_id) ? $resADC_cost3_id : ''; ?>"/>
                    </td>

                </tr>
            </table>
            <div class="update_btn-section">
                <input type="button" name="btnupdate" value="Update" class="button black black-btn"
                       onclick="return updateDefaults(this, 'Admin Charges');">
                <span class="statusControl">&nbsp;</span>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>PrizeDraw Points Cost</h2></div>
            <?php

            // Module : PrizeDraw Points Cost result
            $resPDP = WebsiteDefaults::model()->findAllByAttributes(array('module' => 'PrizeDraw Points Cost'), array('order' => 'id ASC', 'limit' => 3));
            if ($resPDP) {

                $resPDP_cost1 = $resPDP[0]->cost;
                $resPDP_cost1_id = $resPDP[0]->id;

                $resPDP_cost2 = $resPDP[1]->cost;
                $resPDP_cost2_id = $resPDP[1]->id;

                $resPDP_cost3 = $resPDP[2]->cost;
                $resPDP_cost3_id = $resPDP[2]->id;

                $resPDP_currency_code = $resPDP[0]->currency->currency_code;
                if ($resPDP_currency_code != $currency_code) {
                    $resPDP_cost1 = $currencyConverter->convert($resPDP_cost1, $resPDP_currency_code, $currency_code);
                    $resPDP_cost2 = $currencyConverter->convert($resPDP_cost2, $resPDP_currency_code, $currency_code);
                    $resPDP_cost3 = $currencyConverter->convert($resPDP_cost3, $resPDP_currency_code, $currency_code);
                }

            }

            ?>
            <table width="100%" align="center">
                <tr>
                    <td>&nbsp;</td>
                    <td>25</td>
                    <td>50</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td style="width: 13%;text-align: left;">Cost</td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="pdp_cost1"
                               value="<?php echo isset($resPDP_cost1) ? $resPDP_cost1 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="pdp_cost1_id"
                               value="<?php echo isset($resPDP_cost1_id) ? $resPDP_cost1_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="pdp_cost2"
                               value="<?php echo isset($resPDP_cost2) ? $resPDP_cost2 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="pdp_cost2_id"
                               value="<?php echo isset($resPDP_cost2_id) ? $resPDP_cost2_id : ''; ?>"/>
                    </td>
                    <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                        <input type="text" name="pdp_cost3"
                               value="<?php echo isset($resPDP_cost3) ? $resPDP_cost3 : ''; ?>" placeholder="0:00">
                        <input type="hidden" name="pdp_cost3_id"
                               value="<?php echo isset($resPDP_cost3_id) ? $resPDP_cost3_id : ''; ?>"/>
                    </td>

                </tr>
            </table>
            <div class="update_btn-section">
                <input type="button" name="btnupdate" value="Update" class="button black black-btn"
                       onclick="return updateDefaults(this, 'PrizeDraw Points Cost');">
                <span class="statusControl">&nbsp;</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-3">
    <div class="content-container box-area">
        <div class="sub-heading"><h2>Sample Costs</h2></div>

        <?php

        // Module : Sample Costs [category 1] result
        $resSampleCostsCat1 = WebsiteDefaults::model()->findAllByAttributes(array('module' => 'Sample Costs', 'category' => 1), array('order' => 'id ASC', 'limit' => 3));
        if ($resSampleCostsCat1) {

            $resSampleCostsCat1_cost1 = $resSampleCostsCat1[0]->cost;
            $resSampleCostsCat1_cost1_id = $resSampleCostsCat1[0]->id;

            $resSampleCostsCat1_cost2 = $resSampleCostsCat1[1]->cost;
            $resSampleCostsCat1_cost2_id = $resSampleCostsCat1[1]->id;

            $resSampleCostsCat1_cost3 = $resSampleCostsCat1[2]->cost;
            $resSampleCostsCat1_cost3_id = $resSampleCostsCat1[2]->id;

            $resSampleCostsCat1_currency_code = $resSampleCostsCat1[0]->currency->currency_code;
            if ($resSampleCostsCat1_currency_code != $currency_code) {
                $resSampleCostsCat1_cost1 = $currencyConverter->convert($resSampleCostsCat1_cost1, $resSampleCostsCat1_currency_code, $currency_code);
                $resSampleCostsCat1_cost2 = $currencyConverter->convert($resSampleCostsCat1_cost2, $resSampleCostsCat1_currency_code, $currency_code);
                $resSampleCostsCat1_cost3 = $currencyConverter->convert($resSampleCostsCat1_cost3, $resSampleCostsCat1_currency_code, $currency_code);
            }
        }

        ?>
        <table width="100%" align="center">
            <tr style="height: 25px;">
                <td colspan="4">Quantity</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="font-size: 11px;">1 - 1000</td>
                <td style="font-size: 11px;">100 - 10,000</td>
                <td style="font-size: 11px;">10,000 +</td>
            </tr>
            <tr>
                <td style="width: 13%;text-align: left;">Cost</td>
                <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="sample_costs_cat1_cost1"
                           value="<?php echo isset($resSampleCostsCat1_cost1) ? $resSampleCostsCat1_cost1 : ''; ?>"
                           placeholder="0:00">
                    <input type="hidden" name="sample_costs_cat1_cost1_id"
                           value="<?php echo isset($resSampleCostsCat1_cost1_id) ? $resSampleCostsCat1_cost1_id : ''; ?>"/>
                </td>
                <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="sample_costs_cat1_cost2"
                           value="<?php echo isset($resSampleCostsCat1_cost2) ? $resSampleCostsCat1_cost2 : ''; ?>"
                           placeholder="0:00">
                    <input type="hidden" name="sample_costs_cat1_cost2_id"
                           value="<?php echo isset($resSampleCostsCat1_cost2_id) ? $resSampleCostsCat1_cost2_id : ''; ?>"/>
                </td>
                <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="sample_costs_cat1_cost3"
                           value="<?php echo isset($resSampleCostsCat1_cost3) ? $resSampleCostsCat1_cost3 : ''; ?>"
                           placeholder="0:00">
                    <input type="hidden" name="sample_costs_cat1_cost3_id"
                           value="<?php echo isset($resSampleCostsCat1_cost3_id) ? $resSampleCostsCat1_cost3_id : ''; ?>"/>
                </td>

            </tr>
        </table>

        <?php

        // Module : Sample Costs [category 2] result
        $resSampleCostsCat2 = WebsiteDefaults::model()->findAllByAttributes(array('module' => 'Sample Costs', 'category' => 2), array('order' => 'id ASC', 'limit' => 3));
        if ($resSampleCostsCat2) {

            $resSampleCostsCat2_cost1 = $resSampleCostsCat2[0]->cost;
            $resSampleCostsCat2_cost1_id = $resSampleCostsCat2[0]->id;

            $resSampleCostsCat2_cost2 = $resSampleCostsCat2[1]->cost;
            $resSampleCostsCat2_cost2_id = $resSampleCostsCat2[1]->id;

            $resSampleCostsCat2_cost3 = $resSampleCostsCat2[2]->cost;
            $resSampleCostsCat2_cost3_id = $resSampleCostsCat2[2]->id;

            $resSampleCostsCat2_currency_code = $resSampleCostsCat2[0]->currency->currency_code;
            if ($resSampleCostsCat2_currency_code != $currency_code) {
                $resSampleCostsCat2_cost1 = $currencyConverter->convert($resSampleCostsCat2_cost1, $resSampleCostsCat2_currency_code, $currency_code);
                $resSampleCostsCat2_cost2 = $currencyConverter->convert($resSampleCostsCat2_cost2, $resSampleCostsCat2_currency_code, $currency_code);
                $resSampleCostsCat2_cost3 = $currencyConverter->convert($resSampleCostsCat2_cost3, $resSampleCostsCat2_currency_code, $currency_code);
            }
        }
        ?>
        <table width="100%" align="center" style="margin: 22px 8px;">
            <tr style="height: 25px;">
                <td colspan="4">Weight</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="font-size: 11px;">1 - 1000</td>
                <td style="font-size: 11px;">100 - 10,000</td>
                <td style="font-size: 11px;">10,000 +</td>
            </tr>
            <tr>
                <td style="width: 13%;text-align: left;">Cost</td>
                <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="sample_costs_cat2_cost1"
                           value="<?php echo isset($resSampleCostsCat2_cost1) ? $resSampleCostsCat2_cost1 : ''; ?>"
                           placeholder="0:00">
                    <input type="hidden" name="sample_costs_cat2_cost1_id"
                           value="<?php echo isset($resSampleCostsCat2_cost1_id) ? $resSampleCostsCat2_cost1_id : ''; ?>"/>
                </td>
                <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="sample_costs_cat2_cost2"
                           value="<?php echo isset($resSampleCostsCat2_cost2) ? $resSampleCostsCat2_cost2 : ''; ?>"
                           placeholder="0:00">
                    <input type="hidden" name="sample_costs_cat2_cost2_id"
                           value="<?php echo isset($resSampleCostsCat2_cost2_id) ? $resSampleCostsCat2_cost2_id : ''; ?>"/>
                </td>
                <td><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="sample_costs_cat2_cost3"
                           value="<?php echo isset($resSampleCostsCat2_cost3) ? $resSampleCostsCat2_cost3 : ''; ?>"
                           placeholder="0:00">
                    <input type="hidden" name="sample_costs_cat2_cost3_id"
                           value="<?php echo isset($resSampleCostsCat2_cost3_id) ? $resSampleCostsCat2_cost3_id : ''; ?>"/>
                </td>

            </tr>
        </table>
        <div class="update_btn-section">
            <input type="button" name="btnupdate" value="Update" class="button black black-btn"
                   onclick="return updateDefaults(this, 'Sample Costs');">
            <span class="statusControl">&nbsp;</span>
        </div>
    </div>
</div>
<div class="col-3">
    <div class="content-container box-area">
        <div class="sub-heading"><h2>Banner cost</h2></div>
        <?php

        // Module : Banner cost result
        $resBanner = WebsiteDefaults::model()->findByAttributes(array('module' => 'Banner cost'));
        if ($resBanner) {

            $resBanner_cost = $resBanner->cost;
            $resBanner_cost_id = $resBanner->id;
            $resBanner_currency_code = $resBanner->currency->currency_code;
            if ($resBanner_currency_code != $currency_code) {
                $resBanner_cost = $currencyConverter->convert($resBanner_cost, $resBanner_currency_code, $currency_code);
            }
        }

        ?>
        <table id="banner-cost" width="100%" align="center" style="margin: 3px 0 0 24px;">
            <tr>
                <td style="width: 20%;">Cost</td>
                <td style="width: 25%;"><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="banner_cost" style="width: 60%;"
                           value="<?php echo isset($resBanner_cost) ? $resBanner_cost : ''; ?>" placeholder="0:00"/>
                    <input type="hidden" name="banner_cost_id"
                           value="<?php echo isset($resBanner_cost_id) ? $resBanner_cost_id : ''; ?>"/>
                </td>
                <td style="width: 32%;">
                    <div style="text-align: left;">
                        <input style="margin-top: -2px;" type="button" name="btnupdate" value="Update"
                               class="button black black-btn" onclick="return updateDefaults(this, 'Banner cost');">
                        <span class="statusControl">&nbsp;</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="content-container box-area">
        <div class="sub-heading"><h2>Auction cost</h2></div>
        <?php

        // Module : Auction cost result
        $resAuction = WebsiteDefaults::model()->findByAttributes(array('module' => 'Auction cost'));
        if ($resAuction) {

            $resAuction_cost = $resAuction->cost;
            $resAuction_cost_id = $resAuction->id;
            $resAuction_currency_code = $resAuction->currency->currency_code;
            if ($resAuction_currency_code != $currency_code) {
                $resAuction_cost = $currencyConverter->convert($resAuction_cost, $resAuction_currency_code, $currency_code);
            }
        }

        ?>
        <table width="100%" align="center" style="margin: 3px 0 0 24px;">
            <tr>
                <td style="width: 20%;">Cost</td>
                <td style="width: 25%;"><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="auction_cost" style="width: 60%;"
                           value="<?php echo isset($resAuction_cost) ? $resAuction_cost : ''; ?>" placeholder="0:00"/>
                    <input type="hidden" name="auction_cost_id"
                           value="<?php echo isset($resAuction_cost_id) ? $resAuction_cost_id : ''; ?>"/>
                </td>
                <td style="width: 32%;">
                    <div style="text-align: left;">
                        <input style="margin-top: -2px;" type="button" name="btnupdate" value="Update"
                               class="button black black-btn"
                               onclick="return updateDefaults(this, 'Auction cost');">
                        <span class="statusControl">&nbsp;</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="content-container box-area">
        <div class="sub-heading"><h2>Portfolio cost</h2></div>
        <?php

        // Module : Portfolio cost result
        $resPortfolio = WebsiteDefaults::model()->findByAttributes(array('module' => 'Portfolio cost'));
        if ($resPortfolio) {

            $resPortfolio_cost = $resPortfolio->cost;
            $resPortfolio_cost_id = $resPortfolio->id;
            $resPortfolio_currency_code = $resPortfolio->currency->currency_code;
            if ($resPortfolio_currency_code != $currency_code) {
                $resPortfolio_cost = $currencyConverter->convert($resPortfolio_cost, $resPortfolio_currency_code, $currency_code);
            }
        }

        ?>
        <table width="100%" align="center" style="margin: 3px 0 0 24px;">
            <tr>
                <td style="width: 20%;">Cost</td>
                <td style="width: 25%;"><span class="currency_symbol"><?php echo $currency_symbol; ?></span>
                    <input type="text" name="portfolio_cost" style="width: 60%;"
                           value="<?php echo isset($resPortfolio_cost) ? $resPortfolio_cost : ''; ?>"
                           placeholder="0:00"/>
                    <input type="hidden" name="portfolio_cost_id"
                           value="<?php echo isset($resPortfolio_cost_id) ? $resPortfolio_cost_id : ''; ?>"/>
                </td>
                <td style="width: 32%;">
                    <div style="text-align: left;">
                        <input style="margin-top: -2px;" type="button" name="btnupdate" value="Update"
                               class="button black black-btn"
                               onclick="return updateDefaults(this, 'Portfolio cost');">
                        <span class="statusControl">&nbsp;</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
<div class="row">&nbsp;</div>
<div class="row">
    <div style="margin:0 40%;">
        <input type="button" name="btnupdate" value="Change currency" class="button black black-btn"
               onclick="return show_currency_form()">
    </div>
</div>
</div>

<!--update currency-box-->
<div class="change-currency-box update_height">
    <div id="terms-conditions" class="u-email-box" style="margin-left: 42px;"><img
            src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robot/Robot-pointing-down.png"/>

        <div class="my-account-popup-box">
            <a title="Close" href="javaScript:void(0)" onclick="close_currency_form()" class="pu-close">X</a>

            <h2>Update Your Currency</h2>
            <table id="reg-table" style="width: 330px; margin-left: 52px; border-spacing: 2px;">
                <tr>
                    <td class="mandatory-field">*</td>
                    <td><label style="margin: 0;">Currency</label></td>
                    <td>
                        <?php
                        $cur = CHtml::listData(Currency::model()->findAll(), 'currency_id', 'currency_name');
                        ?>
                        <?php echo CHtml::dropDownList('currency_id', 'currency_id', $cur, array('options' => array($currency_id => array('selected' => 'selected')))); ?>
                    </td>
                </tr>
            </table>
            <br/>
            <span class="middle"><input name="email_edit" value="Change Currency" type="button"
                                        onclick="return change_currency()" class="button black"/></span>
        </div>
    </div>
</div>

<script type="text/javascript">

jQuery(".chzn-select").chosen();

function show_currency_form() {
    jQuery(".website-container").css({
        'opacity': 0.5,
        '-ms-filter': "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
        'filter': 'alpha(opacity=0)'
    });

    jQuery('.website-container input').attr("disabled", true);
    jQuery(".change-currency-box").show();
}
function close_currency_form() {
    jQuery(".website-container").css({
        'opacity': 1,
        '-ms-filter': "",
        'filter': ''
    });

    jQuery('.website-container input').removeAttr("disabled");
    jQuery(".change-currency-box").hide();
}

function change_currency() {

    var currency_id = jQuery('select[name="currency_id"] option:selected').val();
    location.href = location.protocol + '//' + location.host + location.pathname + "?currency_id=" + currency_id;
}

function updateDefaults(_this, defaultModule) {

    var statusControl = jQuery(_this).next();
    var currency_id = jQuery('select[name="currency_id"] option:selected').val();
    var WebsiteDefaults = {};
    var invalid = false;

    // set defaults for Business Listing Costs
    if (defaultModule == 'Business Listing Costs') {
        var costControl1 = jQuery('input[name="blc_cost1"]');
        if (costControl1.val() == '') {
            costControl1.addClass('invalid');
            invalid = true;
        } else
            costControl1.removeClass('invalid');

        var costControl2 = jQuery('input[name="blc_cost2"]');
        if (costControl2.val() == '') {
            costControl2.addClass('invalid');
            invalid = true;
        } else
            costControl2.removeClass('invalid');

        var costControl3 = jQuery('input[name="blc_cost3"]');
        if (costControl3.val() == '') {
            costControl3.addClass('invalid');
            invalid = true;
        } else
            costControl3.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="blc_cost1_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 3,
                uom: '3 Months',
                cost: costControl1.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="blc_cost2_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 6,
                uom: '6 Months',
                cost: costControl2.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="blc_cost3_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 12,
                uom: '12 Months',
                cost: costControl3.val(),
                currency_id: currency_id
            }
        ];
    }

    // set defaults for Marketing Data Costs
    if (defaultModule == 'Marketing Data Costs') {
        var costControl1 = jQuery('input[name="mdc_cost1"]');
        if (costControl1.val() == '') {
            costControl1.addClass('invalid');
            invalid = true;
        } else
            costControl1.removeClass('invalid');

        var costControl2 = jQuery('input[name="mdc_cost2"]');
        if (costControl2.val() == '') {
            costControl2.addClass('invalid');
            invalid = true;
        } else
            costControl2.removeClass('invalid');

        var costControl3 = jQuery('input[name="mdc_cost3"]');
        if (costControl3.val() == '') {
            costControl3.addClass('invalid');
            invalid = true;
        } else
            costControl3.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="mdc_cost1_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 3,
                uom: '3 Months',
                cost: costControl1.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="mdc_cost2_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 6,
                uom: '6 Months',
                cost: costControl2.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="mdc_cost3_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 12,
                uom: '12 Months',
                cost: costControl3.val(),
                currency_id: currency_id
            }
        ];
    }

    // set defaults for Admin Charges
    if (defaultModule == 'Admin Charges') {

        var costControl1 = jQuery('input[name="adc_cost1"]');
        if (costControl1.val() == '') {
            costControl1.addClass('invalid');
            invalid = true;
        } else
            costControl1.removeClass('invalid');

        var costControl2 = jQuery('input[name="adc_cost2"]');
        if (costControl2.val() == '') {
            costControl2.addClass('invalid');
            invalid = true;
        } else
            costControl2.removeClass('invalid');

        var costControl3 = jQuery('input[name="adc_cost3"]');
        if (costControl3.val() == '') {
            costControl3.addClass('invalid');
            invalid = true;
        } else
            costControl3.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="adc_cost1_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 1,
                uom: 'Band 1',
                cost: costControl1.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="adc_cost2_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 2,
                uom: 'Band 2',
                cost: costControl2.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="adc_cost3_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 3,
                uom: 'Band 3',
                cost: costControl3.val(),
                currency_id: currency_id
            }
        ];
    }

    // set defaults for PrizeDraw Points Cost
    if (defaultModule == 'PrizeDraw Points Cost') {

        var costControl1 = jQuery('input[name="pdp_cost1"]');
        if (costControl1.val() == '') {
            costControl1.addClass('invalid');
            invalid = true;
        } else
            costControl1.removeClass('invalid');

        var costControl2 = jQuery('input[name="pdp_cost2"]');
        if (costControl2.val() == '') {
            costControl2.addClass('invalid');
            invalid = true;
        } else
            costControl2.removeClass('invalid');

        var costControl3 = jQuery('input[name="pdp_cost3"]');
        if (costControl3.val() == '') {
            costControl3.addClass('invalid');
            invalid = true;
        } else
            costControl3.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="pdp_cost1_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 25,
                uom: '25 points',
                cost: costControl1.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="pdp_cost2_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 50,
                uom: '50 points',
                cost: costControl2.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="pdp_cost3_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 100,
                uom: '100 points',
                cost: costControl3.val(),
                currency_id: currency_id
            }
        ];
    }

    // set defaults for Sample Costs
    if (defaultModule == 'Sample Costs') {

        var costControl1 = jQuery('input[name="sample_costs_cat1_cost1"]');
        if (costControl1.val() == '') {
            costControl1.addClass('invalid');
            invalid = true;
        } else
            costControl1.removeClass('invalid');

        var costControl2 = jQuery('input[name="sample_costs_cat1_cost2"]');
        if (costControl2.val() == '') {
            costControl2.addClass('invalid');
            invalid = true;
        } else
            costControl2.removeClass('invalid');

        var costControl3 = jQuery('input[name="sample_costs_cat1_cost3"]');
        if (costControl3.val() == '') {
            costControl3.addClass('invalid');
            invalid = true;
        } else
            costControl3.removeClass('invalid');

        var costControl4 = jQuery('input[name="sample_costs_cat2_cost1"]');
        if (costControl4.val() == '') {
            costControl4.addClass('invalid');
            invalid = true;
        } else
            costControl4.removeClass('invalid');

        var costControl5 = jQuery('input[name="sample_costs_cat2_cost2"]');
        if (costControl5.val() == '') {
            costControl5.addClass('invalid');
            invalid = true;
        } else
            costControl5.removeClass('invalid');

        var costControl6 = jQuery('input[name="sample_costs_cat2_cost3"]');
        if (costControl6.val() == '') {
            costControl6.addClass('invalid');
            invalid = true;
        } else
            costControl6.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="sample_costs_cat1_cost1_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: '1 - 1000',
                uom: '1 - 1000',
                cost: costControl1.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="sample_costs_cat1_cost2_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: '100 - 10,000',
                uom: '100 - 10,000',
                cost: costControl2.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="sample_costs_cat1_cost3_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: '10,000 +',
                uom: '10,000 +',
                cost: costControl3.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="sample_costs_cat2_cost1_id"]').val(),
                module: defaultModule,
                category: 2,
                unit: '1 - 1000',
                uom: '1 - 1000',
                cost: costControl4.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="sample_costs_cat2_cost2_id"]').val(),
                module: defaultModule,
                category: 2,
                unit: '100 - 10,000',
                uom: '100 - 10,000',
                cost: costControl5.val(),
                currency_id: currency_id
            },
            {
                id: jQuery('input[name="sample_costs_cat2_cost3_id"]').val(),
                module: defaultModule,
                category: 2,
                unit: '10,000 +',
                uom: '10,000 +',
                cost: costControl6.val(),
                currency_id: currency_id
            }
        ];

        console.log(WebsiteDefaults);
    }

    // set defaults for Banner cost
    if (defaultModule == 'Banner cost') {

        var costControl = jQuery('input[name="banner_cost"]');
        if (costControl.val() == '') {
            costControl.addClass('invalid');
            invalid = true;
        } else
            costControl.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="banner_cost_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 1,
                uom: '1 week',
                cost: costControl.val(),
                currency_id: currency_id
            }
        ];
    }

    // set defaults for Auction cost
    if (defaultModule == 'Auction cost') {

        var costControl = jQuery('input[name="auction_cost"]');
        if (costControl.val() == '') {
            costControl.addClass('invalid');
            invalid = true;
        } else
            costControl.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="auction_cost_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 1,
                uom: '1 week',
                cost: costControl.val(),
                currency_id: currency_id
            }
        ];
    }

    // set defaults for Portfolio cost
    if (defaultModule == 'Portfolio cost') {

        var costControl = jQuery('input[name="portfolio_cost"]');
        if (costControl.val() == '') {
            costControl.addClass('invalid');
            invalid = true;
        } else
            costControl.removeClass('invalid');

        if (invalid === true) return false;

        // post values
        WebsiteDefaults = [
            {
                id: jQuery('input[name="portfolio_cost_id"]').val(),
                module: defaultModule,
                category: 1,
                unit: 1,
                uom: '1 week',
                cost: costControl.val(),
                currency_id: currency_id
            }
        ];
    }

    // ajax post and responses
    jQuery.ajax({
        url: "<?php echo Yii::app()->createUrl('/admin/website/moduledefaults/update');?>",
        type: 'POST',
        data: {WebsiteDefaults: WebsiteDefaults},
        async: false,
        beforeSend: function () {
            statusControl.html('<img class="ajax-loading" src="<?php echo Yii::app()->theme->baseUrl;?>/images/loader2.gif" />');
        },
        success: function (result) {
            location.reload();
        }
    });

}


</script>