<style>
    .col-1 {
        width: 12.66% !important;
    }

    .col-2 {
        width: 25.33% !important;
    }

    .col-3 {
        width: 36% !important;
    }

    table.dataTable tr td {
        padding: 10px !important;
    }

    table.dataTable tr {
        cursor: pointer;
    }

    table.dataTable tr.selected td, table.dataTable tr.selected:hover td {
        background: none repeat scroll 0 0 #CB99CC;
    }

    .member-form-container .chzn-container-single {
        margin-left: -24px;
        margin-top: -2px;
        width: 122px !important;
    }

    .member-form-container .chzn-drop {
        left: 0px;
        width: 112px !important;
        top: 22px;
        margin-left: 6px;
    }

</style>

<div class="heading">
    <h3>User Financial Information</h3>
</div>
<?php $this->renderPartial('profile_info', array('model' => $profileInfo)); ?>

<?php
// Search Form
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'financial-form',
));
?>
<div class="member-form-container outline">
    <div class="row">
        <div class="col-1">
            <label style="font-size: 12px;">Date</label>
            <?php echo $form->textField($model, 'user_default_transaction_date', array()); ?>
        </div>
        <div class="col-1">
            <label style="font-size: 12px;">Transaction Type</label>
            <?php echo $form->textField($model, 'user_default_transaction_type', array('maxlength' => 50)); ?>
        </div>
        <div class="col-3">
            <label style="font-size: 12px;">Details</label>
            <?php echo $form->textField($model, 'user_default_transaction_details', array()); ?>
        </div>
        <div class="col-2">
            <label style="font-size: 12px;">Transaction ID</label>
            <?php echo $form->textField($model, 'user_default_transaction_id', array()); ?>
        </div>
        <div class="col-1">
            <label style="font-size: 12px;">Amount</label>
            <input type="text" name="Financial[amount]" id="Financial_amount" size="12"/>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label style="font-size: 12px;">User Email Address</label>
            <input type="text" name="Financial[user_email]" id="Financial_user_email"/>
        </div>
        <div class="col-2">
            <label style="font-size: 12px;">Transaction References No</label>
            <input type="text" style="width: 94%;"/>
        </div>
        <div class="col-1">
            <label style="font-size: 12px; margin-left: -14px;">Bank</label>
            <?php echo $form->dropDownList($model, 'user_default_transaction_bank',
                /*CHtml::listData(Financial::model()->findAll(array(
                    'select' => 't.user_default_transaction_bank',
                    'group' => 't.user_default_transaction_bank',
                    'distinct' => true,
                )), 'user_default_transaction_bank', 'user_default_transaction_bank'),*/
                array(
                    'Paypal' => 'Paypal',
                    'Visa' => 'Visa',
                    'MasterCard' => 'MasterCard',
                    'Debit' => 'Debit',
                    'American Express' => 'American Express',
                    'HSBC' => 'HSBC',
                ),
                array('prompt' => 'Please select', 'class' => "chzn-select")
            );
            ?>
        </div>
        <div class="col-1" style="margin-left: -18px;">
            <label style="font-size: 12px;">Authorizing User</label>
            <input type="text"/>
        </div>
        <div class="col-1">
            <label style="font-size: 12px;">Date</label>
            <input type="text" size="12" style="width: 99%;"/>
        </div>
        <div class="col-1">
            <label style="font-size: 12px;">Time</label>
            <input type="text" size="12"/>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-6" align="center">
            <input type="button" value="Cancel" class="button black black-btn"> &nbsp;
            <input type="reset" value="Clear Data" class="button blue blue-btn"> &nbsp;
            <input type="button" value="Approve & Update" class="button green update-green">
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<div style="clear: both;">&nbsp;</div>
<div class="content-container">

    <div class="grid-dataTable">
        <?php

        $this->widget('zii.widgets.grid.CGridView', array(

            'id' => 'financial-grid',
            'dataProvider' => $model->search(),
            'summaryText' => FALSE,
            'pager' => array(
                'maxButtonCount' => 5,
                'firstPageLabel' => '',
                'lastPageLabel' => '',
                'prevPageLabel' => '< Previous',
                'nextPageLabel' => 'Next >',
                'header' => '',
                'htmlOptions' => array('id' => 'navlist', 'class' => 'pager')
            ),
            //'filter' => $model,
            'selectableRows' => 1,
            'selectionChanged' => 'function(id) {
            var selectedTransactionId = $.fn.yiiGridView.getSelection(id);
            showFinancialDetails(selectedTransactionId);
        }',
            'itemsCssClass' => 'table-class display dataTable',
            'columns' => array(

                array(
                    'header' => 'Date',
                    'name' => 'user_default_transaction_date',
                    'value' => 'CommonClass::convertDateAsDisplayFormat($data->user_default_transaction_date,"d-m-Y")',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Type',
                    'name' => 'user_default_transaction_type',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Details',
                    'name' => 'user_default_transaction_details',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Transaction ID',
                    'name' => 'user_default_transaction_id',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Paid out',
                    'name' => 'user_default_transaction_paid_out',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Paid in',
                    'name' => 'user_default_transaction_paid_in',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Balance',
                    'name' => 'user_default_transaction_balance',
                    'type' => 'raw',
                ),

            ),

        ));

        ?>

        <form method='post' id='showMoreRecordForm'>

            <?php

            $moreRecord = isset($_REQUEST['more_record']) ? $_REQUEST['more_record'] : Yii::app()->user->getState('pageSize');

            ?>

            <span id='more_record_label' class='more_record_label'>View</span>

            <?php

            echo CHtml::dropDownList('more_record', $moreRecord,
                array('10' => '10', '20' => '20', '50' => '50', '100' => '100'),
                array(
                    'class' => 'chzn-select',
                    'style' => 'width:75px;',
                    'data-placeholder' => 'Please select',
                    'name' => 'more_record',
                    'title' => 'Show more record',
                    'onchange' => "jQuery('#showMoreRecordForm').submit();"
                )
            );

            ?>


            <div class="clearfix">&nbsp;</div>

        </form>
        <div class="download-csv"><a href="<?php echo $this->createUrl('exportUserGrid') ?>"
                                     class="button black-btn"
                                     title="Download CSV" target="_blank">Download CSV</a></div>
    </div>

</div>
<div class="notification-popup">&nbsp;</div>

<?php

$userId = $profileId;
?>
<script type="text/javascript">
    jQuery(".chzn-select").chosen();
    jQ = jQuery.noConflict();

    jQ(document).ready(function () {

        jQ('input[type="reset"], button[type="reset"]').click(function () {
            jQ('.member-form-container .chzn-select').val('').trigger('liszt:updated');
        });

    });

    function showFinancialDetails(id) {

        var transactionId = id;
        if (transactionId) {

            jQ.ajax({
                type: 'GET',
                url: '<?php echo Yii::app()->createUrl("admin/member/financialDetails");?>',
                async: false,
                contentType: "application/json",
                data: {transactionId: transactionId},
                dataType: 'json',
                success: function (data) {

                    var resultData = {};
                    if (data === null) {
                        jQ(':input', '#financial-form')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .removeAttr('checked')
                            .removeAttr('selected');
                        jQ('select#Financial_user_default_transaction_bank').val('').trigger('liszt:updated');
                    } else {

                        resultData = data.resultData;

                        jQ('#Financial_user_default_transaction_date').val(resultData.user_default_transaction_date);
                        jQ('#Financial_user_default_transaction_type').val(resultData.user_default_transaction_type);
                        jQ('#Financial_user_default_transaction_details').val(resultData.user_default_transaction_details);
                        jQ('#Financial_user_default_transaction_id').val(resultData.user_default_transaction_id);

                        var transaction_type = resultData.user_default_transaction_type;
                        if (transaction_type.toLowerCase() == 'credit') {
                            jQ('#Financial_amount').val(resultData.user_default_transaction_paid_in);
                        }

                        if (transaction_type.toLowerCase() == 'debit') {
                            jQ('#Financial_amount').val(resultData.user_default_transaction_paid_out);
                        }

                        jQ('#Financial_user_email').val(resultData.user_email);
                        jQ('select#Financial_user_default_transaction_bank').val(resultData.user_default_transaction_bank).trigger('liszt:updated');

                    }
                },
                error: function (e) {
                    alert(e.message);
                }
            });

        }
    }
</script>