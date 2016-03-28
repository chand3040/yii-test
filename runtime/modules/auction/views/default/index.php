<?php

/* @var $this DefaultController */

?>

<style>

    .listing-auctions .heading {
        margin: 10px 0px 16px 150px;
    }

    .listing-auctions .instruction {
        font-size: 12px;
        font-style: italic;
        color: #808080;
    }

    .listing-auctions h3 {
        font-family: Verdana, Helvetica, Arial;
        /*margin: 15px 0;*/
    }

    .listing-auctions p {
        font-size: 12px;
        margin-bottom: 10px;
    }

    .listing-auctions .message {
        margin-bottom: 12%;
        text-align: left
    }

    .listing-auctions table {
        text-align: center;
    }

    .listing-auctions table th {
        font-size: 12px;
        text-align: center;
        font-weight: normal;
        padding: 4px;
    }

    .listing-auctions table td {
        vertical-align: text-bottom;
    }

    .listing-auctions table td:nth-child(5) {
        vertical-align: middle;
    }

    .label {
        text-align: right;
        width: 80px;
        display: inline-block;
    }

    .listing-auctions table input[type="text"] {
        width: 84px;
        height: 10px;
        margin: 1px 2px;
        border: 1px solid #000;
        padding: 2px;
    }

    .listing-auctions .tooltip {
        border: 1px solid #000;
        background-color: #00abeb;
        padding: 0px 2px;
        font-weight: bold;
    }

    .listing-auctions .tooltip b {
       font-weight: bold !important;
    }

    .listing-auctions .black {
        padding: 0.5em 3em .55em;
    }

    .listing-auctions .list {
        margin-bottom: 20px;
    }

    .listing-auctions .list table {
        margin: 5px 45px;
    }

    .listing-auctions .list table tr td {
        padding: 4px 0;
    }

    .listing-auctions .list table tr th, .listing-auctions .list table tr td:nth-child(1) {
        text-align: left !important;
    }
    .listing-auctions .tooltip b {
         background: none;
        font-weight: normal;
        /* color: #000; */
        /* padding: 2px 3px; */
    }
</style>

<div class="listing-auctions">

    <div style="text-align:center;">

        <div class="heading"><p class="instruction">Before you bid please checkout the terms & conditions here <a href="#">&nbsp;>>&nbsp;</a></p>
            <h3>Business Listing No</h3>
            <h3>#1234567890123456789</h3>
        </div>

    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="message">
        <p>What you are bidding on</p>

        <p>Full details of what is included in the sale of the business idea</p>
    </div>
    <div class="message">
        <p>What is not included in the bid</p>

        <p>Full details of what is NOT included in the sale of the business idea ie legal fees, transfer costs etc.</p>
    </div>
    <table border="0" width="100%" style="margin-left: -6px;" cellspacing="0" cellpadding="0">
        <tr>
            <th>Current bid</th>
            <th>Time remaining</th>
            <th>Your current bid</th>
            <th>Place a new bid</th>
            <th style="font-size: 8px">I have read and agree </br>
                to the terms & conditions
            </th>
            <th><input type="checkbox"></th>
        </tr>
        <tr>
            <td style="color: #1dbfd8">£25,961.00</td>
            <td width="27%">2 days 18 hrs 21 mins 16 sec</td>
            <td style="color: #f00">£25,950 .00</td>
            <td>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="text-align: right;"><div class="label">Your bid:</div></td>
                        <td style="text-align: left;"><input type="text" name="" value="">&nbsp;<a class="tooltip"  href="#"><b>?</b>
                                <span class="classic" style="text-align: left;">Your bid</span></a></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><div class="label">Your max bid:</div></td>
                        <td style="text-align: left;"><input type="text" name="" value="">&nbsp;<a class="tooltip"  href="#"><b>?</b>
                                <span class="classic" style="text-align: left;">Your max bid</span></a></td>
                    </tr>
                </table>
            </td>
            <td colspan="2">
                <div class="button black">Place Bid
            </td>
        </tr>

    </table>


    <div>&nbsp;</div>
    <p style="margin: 20px 0 0 0;text-align: left">Only actual bids (not automatic bids generated up to a bidder's
        maximum) are shown.</br>Automatic bids may be
        placed days or hours before a listing ends.</p>

    <div class="instruction" style="text-align: left;margin: 0;font-size: 12px;font-style: normal;">Learn more about bidding<a href="#">&nbsp;>>&nbsp;</a></div>


</div>
<div>&nbsp;</div>
<div class="list">
    <table border="0" width="100%" cellspacing="5" cellpadding="0" style="text-align: left;">
        <tr>
            <th width="30%">Bidder</th>
            <th width="30%">Bid amount</th>
            <th width="30%">Bid time</th>

        </tr>
        <tr>
            <td>Jsingh99(<span style="color: #1dbfd8;">*215</span>)</td>
            <td>£123,122.00</td>
            <td>24-Aug-13 11:20:28 GMT</td>
        </tr>
        <tr>
            <td>Wingnut</td>
            <td>£123,122.00</td>
            <td>24-Aug-13 11:20:28 GMT</td>
        </tr>
        <tr>
            <td>SteveGreen(<span style="color: #1dbfd8;">*12</span>)</td>
            <td>£123,122.00</td>
            <td>24-Aug-13 11:20:28 GMT</td>
        </tr>
        <tr>
            <td>Moonraker(<span style="color: #1dbfd8;">*45</span>)</td>
            <td>£123,122.00</td>
            <td>24-Aug-13 11:20:28 GMT</td>
        </tr>
        <tr>
            <td>AndyWilliams(<span style="color: #1dbfd8;">*415</span>)</td>
            <td>£123,122.00</td>
            <td>24-Aug-13 11:20:28 GMT</td>
        </tr>
    </table>
    <div>&nbsp;</div>
    <p style="text-align:left; margin-left: 20px;">Once bidding has ended you must arrange for your own legal representatives to arrange
        exchange of contracts</p>
</div>