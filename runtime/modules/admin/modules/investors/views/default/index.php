<?php

/* @var $this SiteDefaultsController */

?>
<div class="content-container">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('../../../website/views/layouts/_top_menu'); ?>

</div>

<div class="heading">
    <h3>Equity Costing</h3>
</div>

<div class="website-container">
<div class="row">
    <div class="col-4">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>User 4 wants investment</h2></div>
            <table width="100%">
                <tr>
                    <td>Funding amount requested &nbsp;<?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>
                        &nbsp;<input type="text" value="<?php echo number_format('1000', 2) ?>"
                                     name="funding_amt_received" id="funding_amt_received" style="width: 50%"/></td>

                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Equity on offer
                        &nbsp;<input type="text" value="10" id="equity_offer" name="equity_offer"/>%
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Company Value
                        &nbsp;<?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;<input type="text"
                                                                                                      id="companyValue"
                                                                                                      name="companyValue"
                                                                                                      value=""/>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;1
                        &nbsp;<input type="text" value="" id="eurioValue" name="eurioValue"/>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Amount Received <?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;
                        <input type="text" value="<?php echo number_format('100', 2) ?>" style="width:35%"
                               id="amtReceived" name="amtReceived"/><input type="button" value="Distribute"
                                                                           class="button orange"
                                                                           onclick="">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-2">
        <div class="content-container box-area">
            <table width="100%" align="center">
                <tr>
                    <td>Amount Received<br/><?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;<input
                            type="text" id="amountReceived" name="amountReceived" value=""/>
                    </td>
                    <td valign="middle"><input type="button" value="Refund"
                                               class="button blue"
                                               onclick="">
                    </td>
                </tr>
                <tr>
                    <td>Equity Remaining
                    </td>
                    <td><input type="text" id="equityRemaining" name="equityRemaining" value=""/>%
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-2">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>User 1</h2></div>
            <table width="100%" align="center">
                <tr>
                    <td style="text-align: left;">Account Balance
                        &nbsp;<?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;
                        <input type="text" style="width: 50% " id="accountBalance1" value=""/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>

                    <td valign="middle">Equity Holding
                        <input type="text" style="width: 50% " id="equityHolding1"
                               value="<?php echo number_format('0', 5); ?>"/>%
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="middle">Buy Equity
                        <?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;<span><input type="text"
                                                                                                      style="width: 30% "
                                                                                                      id="buyEquity1"
                                                                                                      value=""/><input
                                type="button" value="Buy"
                                class="button orange"
                                onclick=""></span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="middle">Sell Equity
                        <?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp; <span><input type="text"
                                                                                                       style="width: 30% "
                                                                                                       id="sellEquity1"
                                                                                                       value=""/><input
                                type="button" value="Sell"
                                class="button update-green"
                                onclick=""></span></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-2">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>User 2</h2></div>
            <table width="100%" align="center">
                <tr>
                    <td style="text-align: left;">Account Balance
                        &nbsp;<?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;
                        <input type="text" style="width: 50% " id="accountBalance2" value=""/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>

                    <td valign="middle">Equity Holding
                        <input type="text" style="width: 50% " id="equityHolding2"
                               value="<?php echo number_format('0', 5); ?>"/>%
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="middle">Buy Equity
                        <?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp; <span><input type="text"
                                                                                                       style="width: 30% "
                                                                                                       id="buyEquity2"
                                                                                                       value=""/><input
                                type="button" value="Buy"
                                class="button orange"
                                onclick=""></span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="middle">Sell Equity
                        <?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp; <span><input type="text"
                                                                                                       style="width: 30% "
                                                                                                       id="sellEquity2"
                                                                                                       value=""/><input
                                type="button" value="Sell"
                                class="button update-green"
                                onclick=""></span></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-2">
        <div class="content-container box-area">
            <div class="sub-heading"><h2>User 3</h2></div>
            <table width="100%" align="center">
                <tr>
                    <td style="text-align: left;">Account Balance
                        &nbsp;<?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;
                        <input type="text" style="width: 50% " id="accountBalance3" value=""/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>

                    <td valign="middle">Equity Holding
                        <input type="text" style="width: 50% " id="equityHolding3"
                               value="<?php echo number_format('0', 5); ?>"/>%
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="middle">Buy Equity
                        <?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;<span><input type="text"
                                                                                                      style="width: 30% "
                                                                                                      id="buyEquity3"
                                                                                                      value=""/><input
                                type="button" value="Buy"
                                class="button orange"
                                onclick=""></span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="middle">Sell Equity<?php echo SharedFunctions::_get_currency_symbol('EUR'); ?>&nbsp;
                            <span><input type="text" style="width: 30% " id="sellEquity3" value=""/><input type="button"
                                                                                                           value="Sell"
                                                                                                           class="button update-green"
                                                                                                           onclick=""></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    function calculateFunds() {
        var fundingAmtReceived = jQuery('#funding_amt_received').val();
        var equityOffer = jQuery('#equity_offer').val();
        var percentageFundEquityOffer = parseFloat(jQuery('#funding_amt_received').val().replace(/,/g, "")) / jQuery('#equity_offer').val();

        // Converting Decimal to a percentage
        var companyValue = percentageFundEquityOffer * 100;
        jQuery('#companyValue').val(parseFloat(companyValue).toFixed(2));

        //Converting percentage to decimal
        var equityOfferPercentage = jQuery('#equity_offer').val() / 100;
        var equityRemaining = parseFloat(equityOfferPercentage) / fundingAmtReceived.replace(/,/g, "") * 100;
        // Converting Decimal to a percentage
        jQuery('#eurioValue').val(parseFloat(equityRemaining) + '000');
        var equityHolding1 = (jQuery('#equityHolding1').val() != '') ? jQuery('#equityHolding1').val().replace(/,/g, "") : 0;
        var equityHolding2 = (jQuery('#equityHolding2').val() != '') ? jQuery('#equityHolding2').val().replace(/,/g, "") : 0;
        var equityHolding3 = (jQuery('#equityHolding3').val() != '') ? jQuery('#equityHolding3').val().replace(/,/g, "") : 0;

        var buyEquity1 = (jQuery('#buyEquity1').val() != '') ? jQuery('#buyEquity1').val().replace(/,/g, "") : 0;
        var buyEquity2 = (jQuery('#buyEquity2').val() != '') ? jQuery('#buyEquity2').val().replace(/,/g, "") : 0;
        var buyEquity3 = (jQuery('#buyEquity3').val() != '') ? jQuery('#buyEquity3').val().replace(/,/g, "") : 0;

        var equityRemaining = jQuery('#equity_offer').val() - (parseFloat(equityHolding1) + parseFloat(equityHolding2) + parseFloat(equityHolding3));
        var amountReceived = parseFloat(buyEquity1) + parseFloat(buyEquity2) + parseFloat(buyEquity3);

        jQuery('#equityRemaining').val(parseFloat(equityRemaining) + '.0000');
        jQuery('#amountReceived').val(parseFloat(amountReceived).toFixed(2));

        var amtReceived = parseFloat(jQuery('#amtReceived').val());

        var accountBalance1 = amtReceived * equityHolding1;
        jQuery('#accountBalance1').val(parseFloat(accountBalance1));
        var accountBalance2 = amtReceived * equityHolding2;
        jQuery('#accountBalance2').val(parseFloat(accountBalance2));

        var accountBalance3 = amtReceived * equityHolding3;
        jQuery('#accountBalance3').val(parseFloat(accountBalance3));


    }
    jQuery(document).ready(function () {
        calculateFunds();
        jQuery('#funding_amt_received,#equity_offer,#company_value,#equityHolding1,#equityHolding2,#equityHolding3,#buyEquity1,#buyEquity2,#buyEquity3')
            .bind('keyup', function () {
                // do your keyup thing using $(this)
                // to refer back to the input
                //$('body').append($(this).attr('id') + ': keyup<br />');
                calculateFunds();


            })
            .bind('blur', function () {
                // do your blur thing using $(this)
                // to refer back to the input
                calculateFunds();


            })
    });
</script>