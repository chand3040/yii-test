<?php

$this->breadcrumbs = array(

    'Members' => array('index'),

    'Member Details',

);

?>

<div class="white-bg">

    <h1>Update Page</h1>

    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>

</div>

<?php



/*

    Add Charts in User Profile page 



*/

if (!$model->isNewRecord) {


    ?>

    <div class="clearboth"></div>

    <div class="chart">

        <h1>User data graph</h1>

        <div id="chartcontainer">Please wait.....</div>

        <script type="text/javascript">

            var myData = new Array(['unit', 20], ['unit two', 10], ['unit three', 30], ['other unit', 10], ['last unit', 30]);

            var myChart = new JSChart('chartcontainer', 'bar');

            myChart.setDataArray(myData);

            myChart.draw();

        </script>

    </div>

<?php

}

?>

                                                                                                                                                                                                                                            