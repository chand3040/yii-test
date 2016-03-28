<style>
    td p {
        padding:2px 6px;
    }
     li.active a {
        color: #A84793;
        background: none repeat scroll 0% 0% #FFF;
    }
   .company_officers td{
        padding: 0 !important;
    }
    .Blue{
        margin:5px;
    }
</style>

<?php
/* @var $this InvestorFinancialController */

/* @var $dataProvider CActiveDataProvider */
?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/chart/jscharts.js"></script>
<div id="tabs_content_container">
<?php  $this->renderPartial('//../modules/investor/views/layouts/investor_area_menu');?>

    <div id="snapshot" class="investor-tab_content" style="display: block;">
        <h2 class="Blue align-center">Plummate</h2>

        <div class="investor_listing_info">Business Listing No </br>#1234567890</div>

        <div class="sharholder_info">
            <p>Total Shareholding in company : $120,000</p>
            <span> Total equity held in the Company by shareholders:25%</span>
            <br/>

            <div class="align-center"> My financial statement</div>
        </div>
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$investorFinancilDataProvider,
            'summaryText'=>'',
            'itemsCssClass' => 'table_style1 investor_table',
            'columns'=>array(
                array(
                    'name'=>'Date',
                    'value'=>'$data->user_default_investment_transaction_id',
                ),
                array(
                    'name'=>'Equity Purchased',
                    'value'=>'',
                ),
                array(
                    'name'=>'Equity Sold',
                    'value'=>'',
                ),
                array(
                    'name'=>'Debits',
                    'value'=>'',
                ),
                array(
                    'name'=>'Credits',
                    'value'=>'',
                ),
                array(
                    'name'=>'Balance',
                    'value'=>'',
                ),
            ),
        ));
        ?>
        <!--<table border="0" bordercolor="#fff" class="table_style1 investor_table" width="100%" cellpadding="0"
               cellspacing="0">
            <tbody>
            <tr>
                <th>Date</th>
                <th>Equity Purchased</th>
                <th>Equity Sold</th>
                <th>Debits</th>
                <th>Credits</th>
                <th>Balance</th>
            </tr>
            <tr onMouseOver="ChangeColorGrey(this, true);"
                onmouseout="ChangeColorGrey(this, false);"
                onclick="DoNav('#');"
                class="GreyRow">
                <td width="15%">21/10/2013</td>
                <td width="10%">0.12%</td>
                <td width="10%"></td>
                <td width="20%">$1.00</td>
                <td width="20%"></td>
                <td width="35%"><span class="red-color">-$1.00</span></td>
            </tr>

            <tr onMouseOver="ChangeColorMauve(this, true);"
                onmouseout="ChangeColorMauve(this, false);"
                onclick="DoNav('#');"
                class="MauveRow">
                <td>19/10/2013</td>
                <td></td>
                <td></td>
                <td></td>
                <td>$0.23</td>
                <td><span class="orange-color"> -$0.77</span></td>
            </tr>
            <tr onMouseOver="ChangeColorGrey(this, true);"
                onmouseout="ChangeColorGrey(this, false);"
                onclick="DoNav('#');"
                class="GreyRow">
                <td width="15%">21/10/2013</td>
                <td width="10%">0.12%</td>
                <td width="10%"></td>
                <td width="20%">$1.00</td>
                <td width="20%"></td>
                <td width="35%"><span class="red-color">-$1.00</span></td>
            </tr>

            <tr onMouseOver="ChangeColorMauve(this, true);"
                onmouseout="ChangeColorMauve(this, false);"
                onclick="DoNav('#');"
                class="MauveRow">
                <td>19/10/2013</td>
                <td></td>
                <td></td>
                <td></td>
                <td>$0.23</td>
                <td><span class="orange-color"> -$0.77</span></td>
            </tr>
            </tbody>
        </table>-->
        <hr class="investorhr_line"/>
        <table class=" avg" style="float:right;margin-top: -19px;">
            <tr>
                <td width="20%">21/11/2017</td>
                <td width="27%">0.36%</td>
                <td>$21.00</td>
                <td>$23.23</td>
                <td>$12.00</td>
            </tr>
        </table>
        <div id="chartid"></div>
    </div>
<div id="investment" class="investor-tab_content" style="display: none;">

    <h2 class="Blue align-center">Modify Investment</h2>

    <div class="investor_listing_info">Business Listing No </br>#1234567890</div>

    <div id="accountDetails" style="margin-top: 17px !important;
margin-left: 5px !important;"><p>Transaction history for:<span>plummate</span> <br/><br/>
            Account No : <span>#1234567890</span></p>
        Download Statement :<img src="<?php echo Yii::app()->theme->baseUrl . '/images/icons/download.jpg' ?>"
                                 style="width: 10%;"></div>

    <div id="balance">
        <p class="accountBalance" style="margin-bottom:0px; margin-top:5px;"> Account balance: </p>
        <input value="0.00" readonly="readonly" name="addFundsw" type="text" class="investor_input grnt-btn" style="color:#000">
        <a class="tooltip" style="background:none;margin-left: 7px !important;" href="#;">
            <b>?</b>
            <span class="classic" style="text-align: left;">Balance</span>
        </a>

        <div class="clearfix"></div>
        <input style="margin-left: -2px; margin-top: 5px; font-size:1em;" id="withdraw_fund" class="button black"
               value="Withdraw funds" type="button">
        <input class="investor_input grnt-btn" style="margin-top:5px;"
               onblur="if(this.value=='')this.value=this.defaultValue;"
               onfocus="if(this.value==this.defaultValue)this.value='';" value="00.00" name="withdrawFunds" type="text">
        <a class="tooltip" style="background:none;margin-left: 7px !important;" href="#;">
            <b>?</b>
            <span class="classic" style="text-align: left;">Withdraw Funds</span>
        </a>
    </div>
    <table border="0" bordercolor="#fff" class="table_style1 modify_table" width="100%" cellpadding="0"
           cellspacing="0">
        <tbody>
        <tr>
            <th>Date</th>
            <th>Equity Purchased</th>
            <th>Equity Sold</th>
            <th>Debits</th>
            <th>Credits</th>
            <th>Balance</th>
        </tr>
        <tr onMouseOver="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="oddRow">
            <td width="15%">21/10/2013</td>
            <td width="10%">0.12%</td>
            <td width="10%"></td>
            <td width="20%">$1.00</td>
            <td width="20%"></td>
            <td width="35%"><span class="red-color">-$1.00</span></td>
        </tr>

        <tr onMouseOver="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="evenRow">
            <td>19/10/2013</td>
            <td></td>
            <td></td>
            <td></td>
            <td>$0.23</td>
            <td>-$0.77</td>
        </tr>
        <tr onMouseOver="ChangeColorGrey(this, true);"
            onmouseout="ChangeColorGrey(this, false);"
            onclick="DoNav('#');"
            class="oddRow">
            <td width="15%">21/10/2013</td>
            <td width="10%">0.12%</td>
            <td width="10%"></td>
            <td width="20%">$1.00</td>
            <td width="20%"></td>
            <td width="35%"><span class="red-color">-$1.00</span></td>
        </tr>

        <tr onMouseOver="ChangeColorMauve(this, true);"
            onmouseout="ChangeColorMauve(this, false);"
            onclick="DoNav('#');"
            class="evenRow">
            <td>19/10/2013</td>
            <td></td>
            <td></td>
            <td></td>
            <td>$0.23</td>
            <td>-$0.77</td>
        </tr>
        </tbody>
    </table>
    <div style="margin-left: 17.2%;">Page 1 of 25</div>
    <div class="investment">
        <ul>
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
        </ul>
    </div>

    <div id="sell_equity">
        <h3 class="header3color">Sell Equity</h3>
        <div>If you wish to sell any equity that you hold in this business you may auction it via the Open for Bidding tab.</div>
        <label class="heading " style="margin-left: 6px;margin-top: 15px;font-family:AuraBoldRegular,Helvetica,Arial">Enter details of the equity you are
            selling </label> <a class="tooltip" style="background:none;margin-left: 7px !important;" href="#;">
            <b>?</b>
            <span class="classic" style="text-align: left;">Equity Selling</span>
        </a>

        <div id="sell_equity_box">
            Please enter details of the equity for sale <br/><br/>

            Pop up wording:
            <br/>
            User need to know the reason you are selling your equity holding in the business venture.
            you need ot explain the financial gain the bidder wil get from purchasing this equity
            List details of how the business has performed. the income you have received etc.
        </div>
    </div>

    <?php
    $sellEquityModel = new SellEquity();
    $this->renderPartial('//../modules/investor/views/sellEquity/create',array('sellEquityModel'=>$sellEquityModel));?>
</div>
<div id="forum" class="investor-tab_content" style="display: none; min-height: 450px;">

    <h2 class="Blue align-center">My Messages</h2>
    <div class="investor_listing_info">This is a list of all your private messages</div>
</div>
<div id="voting" class="investor-tab_content" style="display: none; min-height: 450px;">

    <h2 class="Blue align-center">Members Voting</h2>

    <div class="investor_listing_info">Business Listing No </br>#1234567890652342342345</div>

    <div id="voiting-info-box">
        Do you feel that the investment has run its course and we should consider cutting our losses and have our money refunded?
    </div>
    <div id="member_voting">
        <ul>
            <li class="checkbox">
                <input id="check2" type="checkbox" name="check" value="1">
                <label for="check2">Yes I would like to close this investment and get a refund</label>
            </li>
            <li class="checkbox">
                <input id="check3" type="checkbox" name="check" value="1">
                <label for="check3">No I do not want to close this investment and get a refund</label>
            </li>
            <li class="checkbox">
                <input id="check4" type="checkbox" name="check" value="1">
                <label for="check4">I am not sure</label>
            </li>
        </ul>
    </div>
    <div class="align-center" style="margin-left: 115px;"><span style="color: #808080;">Username</span> <br/>
        <input type="text" class="grnt-btn Blue" id="voter_name" value="Wingnut136a" /> <br/>
        <p style="margin-top: 5%;margin-bottom: 3%;">
            <input type="submit" value="Submit" class="button black" />
        </p>
        <p>
            <span style="color: #808080;">Vote closing date: </span> 2days 18hrs 21mins <span class="red-color">16sec</span>
        </p>
    </div>
</div>
<div id="company" class="investor-tab_content" style="display: none;">
    <h2 class="Blue align-center">Plummate Limited</h2>

    <div class="investor_listing_info">Company Reg No:#1234567890652342342345 </br>Incorporation date:21/10/2013</div>
    <div style="margin-left: 18%;color: #4E4B4B;">
        <h6 class="Blue">Company Details</h6>
        <div><div class="investor_company_header">Company Officers</div>
            <table class="company_officers">
                <tr>
                    <td>Company Officer 1 : Wingnut (Jaginder Singh Mudhar)</td>
                    <td>Company Officer 1 : Wingnut (Jaginder Singh Mudhar)</td>
                    <td>Company Officer 1 : Wingnut (Jaginder Singh Mudhar)</td>
                    </tr>
                <tr>
                    <td> email : <a href="mailto:wingnut@dragonsnet.biz" class="investor_comapany_email">wingnut@dragonsnet.biz</a></td>
                    <td> email : <a href="mailto:wingnut@dragonsnet.biz" class="investor_comapany_email">wingnut@dragonsnet.biz</a></td>
                    <td> email : <a href="mailto:wingnut@dragonsnet.biz" class="investor_comapany_email">wingnut@dragonsnet.biz</a></td>

                </tr>
                <tr>
                    <td>Officer since:21/10/2013</td>
                    <td>Officer since:21/10/2013</td>
                    <td>Officer since:21/10/2013</td>

                </tr>
                <tr>
                    <td> Company Officer for : 3 other companies.</td>
                    <td> Company Officer for : 3 other companies.</td>
                    <td> Company Officer for : 3 other companies.</td>
                </tr>
                   <!-- <td>Company Officer 1 : Wingnut(Jaginder Singh Mudhar)<br/>
                        email : <a href="mailto:wingnut@dragonsnet.biz" class="investor_comapany_email">wingnut@dragonsnet.biz</a><br/>
                        Officer since:21/10/2013<br/>
                        Company Officer for : 3 other companies.<br/></td>-->
                    <!--<td align="center">Company Officer 1 : Wingnut(Jaginder Singh Mudhar)<br/>
                        email : <a href="mailto:wingnut@dragonsnet.biz" class="investor_comapany_email">wingnut@dragonsnet.biz</a><br/>
                        Officer since:21/10/2013<br/>
                        Company Officer for : 3 other companies.<br/></td>
                    <td align="center">Company Officer 1 : Wingnut(Jaginder Singh Mudhar)<br/>
                        email : <a href="mailto:wingnut@dragonsnet.biz" class="investor_comapany_email">wingnut@dragonsnet.biz</a><br/>
                        Officer since:21/10/2013<br/>
                        Company Officer for : 3 other companies.<br/></td>-->

            </table>
            <table style="margin:5px 0"><tr>
                    <td><div class="investor_company_header">Company Owner</div>
                        <p>
                            Jaginder Singh Mudhar<br/><br/>

                            Head Office<br/>
                            Plummate Ltd,<br/>
                            18 Whitehouse Avenue<br/>
                            Churchill<br/>
                            Off Wellcroft Street,<br/>
                            WEDNESBURY<br/>
                            West Midlands<br/>
                            WS10 7HT<br/><br/>

                            Tel No: 012124523645<br/>
                            Fax:0124562622<br/>
                            email:jsingh99@dragonsnet.biz<br/>
                        </p></td>
                    <td><div class="investor_company_header">Company Accountant</div>
                        <p>Mrs. Shameem Mudhar<br/><br/>

                            Head Office<br/>
                            Plummate Ltd,<br/>
                            18 Whitehouse Avenue<br/>
                            Churchill<br/>
                            Off Wellcroft Street,<br/>
                            WEDNESBURY<br/>
                            West Midlands<br/>
                            WS10 7HT<br/><br/>

                            Tel No: 012124523645<br/>
                            Fax:0124562622<br/>
                            email:s.mudhar@j-accounts.com</p></td>
                    <td><div class="investor_company_header">Company Business Manager</div>
                        <p>Suniel Singh Mudhar
                            <br/><br/>
                            Head Office<br/>
                            Plummate Ltd,<br/>
                            18 Whitehouse Avenue<br/>
                            Churchill<br/>
                            Off Wellcroft Street,<br/>
                            WEDNESBURY<br/>
                            West Midlands<br/>
                            WS10 7HT<br/><br/>

                            Tel No: 012124523645<br/>
                            Fax:0124562622<br/>
                            email:s.mudhar@dragonsnet.biz</p></td>
                </tr>
                <tr>
                    <td> <p>Shareholders:<br/>
                            Jaginder Singh Mudhar : 46%<br/>
                            Shameem Mudhar :25%<br/>
                            Dragonsnet shareholders:29%<br/>
                            Total shareholding:100%<br/>
                            Current share value:0.12</p></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div  id="sharehoders">
            <h2 class="Blue">Shareholders</h2>
            <table cellspacing="0" cellpadding="0" style="width: 75%;margin:10px 0">
                <tr>
                    <th>Username</th>
                    <th>Title</th>
                    <th>Amount Invested</th>
                    <th>Shareholding</th>
                </tr>
                <?php for($i=1;$i<=6;$i++):?>
                    <tr class="odd">
                        <td>username1</td>
                        <td>Shareholder</td>
                        <td>$65</td>
                        <td>0.6%</td>
                    </tr>
                    <tr  class="even">
                        <td>username2</td>
                        <td>Shareholder</td>
                        <td>$13</td>
                        <td>0.1%</td>
                    </tr>
                <?php endfor;?>
            </table>
        </div>

    </div>
</div>
<div id="adminarea" class="investor-tab_content" style="display: none;">
   <div id="investor-adminrestricted-area">
    <div class="invest-robo-img"><img src="<?php echo Yii::app()->theme->baseUrl?>/images/robot/Robot-pointing-down.png" alt="Robot pointing to login form" height="135" width="168"></div>
       <div id="investor-adminrestricted-info">
        <div class="orange-color" style="margin: 10px" >Restricted Area</div>
      <div style="font-size: 13px"> You must be a company officer to get access</div>
       <input type="button" class="button black investorMiddle" value="Close" id="btnClose" name="btnClose" onclick="investorAdminRestrictedBoxClose();">
    </div>
   </div>

    <div id="investor-mail-sentbox" style="display: none;">
        <div class="invest-robo-img"><img src="<?php echo Yii::app()->theme->baseUrl?>/images/robot/robot-torso.png" alt="Robot pointing to login form" height="135" width="168"></div>
        <div id="investor-mail-sentinfo">
            <h2 style="color:#00aeef">Your email to</h2>
            <div class="orange-color" >%users%</div>
            <h2 style="color:#00aeef">has been sent</h2>
            <input type="button" class="button black investorMiddle" value="Close" id="btnClose" name="btnClose">
        </div>
    </div>

    <div id="investor-voting-submitbox" style="display: none;">
        <div class="invest-robo-img"><img src="<?php echo Yii::app()->theme->baseUrl?>/images/robot/robot-torso.png" alt="Robot pointing to login form" height="135" width="168"></div>
        <div id="investor-voting-submitinfo">
            <h2 style="color:#00aeef">You have successfully submitted the voting module for all shareholders.</h2>
           <div style="font-style: italic;color: #808080;margin-top: 4%;">All shareholders will receive a notification of this</div>
            <input type="button" class="button black investorMiddle" value="Close" id="btnClose" name="btnClose">
        </div>
    </div>

    <div id="adminarea-tabs" style="display: none;">
        <ul>
            <li class="active"><a href="#contactMember"> <h3>Contact the business & members</h3>Select this if you wish to send communication to either the business or its shareholders >>
                </a></li>
            <li><a href="#openMemberVoting"> <h3>Open up member voting interface</h3>Open up member voting interface</a></li>
        </ul>
    </div>

    <div id="contactMember" class="adminarea_tab_content" style="display: none;">
        <h2 class="Blue align-center"> Contact the business and its members</h2>
        <div class="investor_listing_info">You may use this email form to contact the business and its shareholders</div>
        <div class="investor_compose_mail">
            <a class="pu-close listing-close" href="#" onclick="contactMemberPopupClose();">X</a>
            <div class="help-form">

                <table>
                    <tr>
                        <td rowspan="2" ><div class="send-button">Send</div></td>
                        <td><div class="help_btn_labels">To</div></td>
                        <td><select class="chzn-select" style="width:400px">
                                <option>Please Select</option>
                                <option>All shareholders</option>
                                <option>Business Owner</option>
                                <option>Business Accountant</option>
                                <option>Business Manager</option>
                                <option>Dragonsnet Support</option></select></td>
                    </tr>
                    <tr>

                        <td><div class="help_btn_labels">Subject</div></td>
                        <td><input type="text" value="" name="" style="width:400px"></td>
                    </tr>

                </table>
                <div class="help_form_body" style="height:auto !important;  padding: 17px 10px !important;">
                    Message<a class="tooltip"
                              style="background:none;margin-left: 7px !important;"
                              href="#;">
                        <b>?</b>
                        <span class="classic" style="text-align: left;">Message</span>
                    </a></br>
                    <textarea></textarea>

                </div>
            </div>
        </div>
    </div>

    <div id="openMemberVoting" class="adminarea_tab_content" style="display: none;">
        <h2 class="Blue align-center"> Create members voting interface</h2>
        <div class="investor_listing_info">You may use this email form to contact the business and its shareholders</div>
        <div id="vote_input_box">
            <label>Enter voting text</label>
            <textarea id="vote_textarea" name="vote_text" rows="3"></textarea>
            <div id="member_voting" style="margin-left: 12% !important;">
                <ul>
                    <li class="checkbox">
                        <input id="check5" type="checkbox" name="check" value="1">
                        <label for="check5"></label>
                        <input type="text" class="vote_answer" value="" placeholder="Click to enter answer text" tabindex="2">
                    </li>
                    <li class="checkbox"><input id="check6" type="checkbox" name="check" value="1">
                        <label for="check6"></label>
                        <input type="text" class="vote_answer" value="" placeholder="Click to enter answer text" tabindex="4">
                    </li>
                    <li class="checkbox"><input id="check7" type="checkbox" name="check" value="1">
                        <label for="check7"></label>
                        <input type="text" class="vote_answer" value="" placeholder="Click to enter answer text" tabindex="6">
                    </li>
                </ul>
            </div>
            <div id="vote_open_input">Number of days you wish the voting to be open for: <select id="noofdays" name="noofdays" class="chzn-select" style="width: 90px">
                    <?php for($i=0;$i<=100;$i++):?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php endfor; ?></select></div>
            <div class="vote_box_middle">
                <input type="submit" name="btnSubmit" id="btnSubmit" class="button black" value="Submit" onclick="votingInterfaceClose();">
            </div>
        </div>
    </div>
    </div>
</div>

<script>

    function investorAdminRestrictedBoxClose(){
        $('#investor-adminrestricted-area').fadeOut();
        $('#adminarea-tabs').fadeIn();
    }

    function contactMemberPopupClose(){
        $('#contactMember').fadeOut();
        $('#adminarea-tabs').fadeIn();
    }

    function votingInterfaceClose(){
        $('#openMemberVoting').fadeOut();
        $('#adminarea-tabs').fadeIn();
    }
 /*   $('#investor-adminrestricted-area').fadeOut();*/
    var myData = new Array([10, -2], [15, 0], [18, 3], [19, 6], [20, 8.5], [25, 10], [30, 9], [35, 8], [40, 5], [45, 6], [50, 2.5]);
    var myChart = new JSChart('chartid', 'line');
    myChart.setDataArray(myData);
    myChart.setLineColor('#8D9386');
    myChart.setLineWidth(4);
    myChart.setAxisNameX('Data');
    myChart.setAxisNameY('Value');
    myChart.setTitleColor('#7D7D7D');
    myChart.setAxisColor('#9F0505');
    myChart.setGridColor('#a4a4a4');
    myChart.setAxisValuesColor('#333639');
    myChart.setAxisNameColor('#333639');
    myChart.setTextPaddingLeft(0);
    myChart.draw();
</script>

