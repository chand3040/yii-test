<?php $this->renderPartial('application.modules.admin.views.layouts.listing_submenu'); ?>
<div class="heading">
    <h3>User Listing YTD Snapshot</h3>
</div>
<div class="content-container">

    <div class="user_statistics">
        <?php
        $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Num', '12' => 'Dec');

        // Default User Professions
        $resultProfessions = Profession::model()->findAll(array('order' => 'profession_name'));

        $totalProfessionsForMonth = array();
        $totalProfessionsForYearAll = 0;
        $totalToDatesAll = 0;
        $totalOnlineAll = 0;
        ?>
        <table style="width:98.5%; padding:8px; border-spacing:5px; border-collapse: collapse;" border="0">
            <tr class="first-row">
                <td width="11%" class="column-odd">&nbsp;</td>
                <?php if ($months) {
                    $i = 0; ?>
                    <?php foreach ($months as $index => $month) { ?>
                        <td valign="bottom"
                            class="min-width bold <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $month; ?></td>
                        <?php
                        $i++;
                    } ?>
                <?php } ?>
                <td valign="bottom" class="max-width bold column-even">Total for year</td>
                <td valign="bottom" class="max-width bold column-odd">Total to date</td>
                <td valign="bottom" class="max-width bold column-even">Users online</td>
            </tr>

            <?php if ($resultProfessions) { ?>
                <?php foreach ($resultProfessions as $key => $profession) {

                    $professionId = $profession->profession_id;
                    $totalProfessions = 0;
                    $totalToDates = 0;
                    $professionUsersCountOnline = 0;
                    ?>
                    <tr class="<?php echo $key % 2 == 0 ? 'row-even' : 'row-odd'; ?>">
                        <td class="bold" style="text-align: left;"><?php echo $profession->profession_name; ?></td>
                        <?php if ($months) {
                            $i = 0; ?>
                            <?php foreach ($months as $index => $month) {
                                $monthIndex = $index;
                                $professionUsersCount = Listings::getProfessionUserListingCount($professionId, $monthIndex);
                                $totalProfessions += $professionUsersCount;
                                $totalProfessionsForMonth[$index] += $professionUsersCount;
                                ?>
                                <td class="min-width count <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $professionUsersCount ? $professionUsersCount : ''; ?></td>
                                <?php
                                $i++;
                            } ?>
                        <?php } ?>
                        <td class="max-width countAll column-even">
                            <?php
                            $totalProfessionsForYearAll += $totalProfessions;
                            echo $totalProfessions ? $totalProfessions : '';
                            ?>
                        </td>
                        <td class="max-width countAllToDates column-odd">
                            <?php
                            $toDateProfessions = Listings::getToDateProfessionUsersListingCount($professionId);
                            $totalToDates = $totalProfessions + $toDateProfessions;
                            $totalToDatesAll += $totalToDates;
                            echo $totalToDates ? $totalToDates : '';
                            ?>
                        </td>
                        <td class="max-width countAllOnline column-even">
                            <?php
                            $professionUsersCountOnline = Listings::getProfessionUserListingCountOnline($professionId);
                            $totalOnlineAll += $professionUsersCountOnline;
                            echo $professionUsersCountOnline ? $professionUsersCountOnline : '';
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="<?php echo count($resultProfessions) % 2 == 0 ? 'row-even' : 'row-odd'; ?>">
                    <td class="bold" style="text-align: left;">Total for month</td>
                    <?php if ($months) {
                        $i = 0;
                        ?>
                        <?php foreach ($months as $index => $month) { ?>
                            <td class="min-width count <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $totalProfessionsForMonth[$index] ? $totalProfessionsForMonth[$index] : '' ?></td>
                            <?php
                            $i++;
                        } ?>
                    <?php } ?>
                    <td class="max-width countAll column-even"><?php echo $totalProfessionsForYearAll ? $totalProfessionsForYearAll : ''; ?></td>
                    <td class="max-width countAllToDates column-odd"><?php echo $totalToDatesAll ? $totalToDatesAll : ''; ?></td>
                    <td class="max-width countAllOnline column-even"><?php echo $totalOnlineAll ? $totalOnlineAll : ''; ?></td>
                </tr>
            <?php } else { ?>
                <tr class="row-even">
                    <td style="text-align: center;" colspan="16">No listing professions found.</td>
                </tr>
            <?php } ?>
        </table>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div style="margin-bottom:25px;text-align:center"><a
                href="<?php echo $this->createUrl('exportDefaultListings') ?>"
                class="button  black-btn" title="Download CSV"
                target="_blank">Download CSV</a></div>

    </div>
</div>

<div class="heading">
    <h3>Business Listing YTD Snapshot</h3>
</div>
<div class="content-container">

    <div class="user_statistics">
        <?php
        $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Num', '12' => 'Dec');

        // Default User Professions
        $resultProfessions = ListingProfession::model()->findAll(array('order' => 'list_profession_name'));

        $totalProfessionsForMonth = array();
        $totalProfessionsForYearAll = 0;
        $totalToDatesAll = 0;
        $totalOnlineAll = 0;
        ?>
        <table style="width:98.5%; padding:8px; border-spacing:5px; border-collapse: collapse;" border="0">
            <tr class="first-row">
                <td width="11%" class="column-odd">&nbsp;</td>
                <?php if ($months) {
                    $i = 0; ?>
                    <?php foreach ($months as $index => $month) { ?>
                        <td valign="bottom"
                            class="min-width bold <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $month; ?></td>
                        <?php
                        $i++;
                    } ?>
                <?php } ?>
                <td valign="bottom" class="max-width bold column-even">Total for year</td>
                <td valign="bottom" class="max-width bold column-odd">Total to date</td>
                <td valign="bottom" class="max-width bold column-even">Users online</td>
            </tr>

            <?php if ($resultProfessions) { ?>
                <?php foreach ($resultProfessions as $key => $profession) {

                    $professionId = $profession->list_profession_id;
                    $totalProfessions = 0;
                    $totalToDates = 0;
                    $professionUsersCountOnline = 0;
                    ?>
                    <tr class="<?php echo $key % 2 == 0 ? 'row-even' : 'row-odd'; ?>">
                        <td class="bold" style="text-align: left;"><?php echo $profession->list_profession_name; ?></td>
                        <?php if ($months) {
                            $i = 0; ?>
                            <?php foreach ($months as $index => $month) {
                                $monthIndex = $index;
                                $professionUsersCount = Blisting::model()->getSectorBlistingCount($professionId, $monthIndex);
                                $totalProfessions += $professionUsersCount;
                                $totalProfessionsForMonth[$index] += $professionUsersCount;
                                ?>
                                <td class="min-width count <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $professionUsersCount ? $professionUsersCount : ''; ?></td>
                                <?php
                                $i++;
                            } ?>
                        <?php } ?>
                        <td class="max-width countAll column-even">
                            <?php
                            $totalProfessionsForYearAll += $totalProfessions;
                            echo $totalProfessions ? $totalProfessions : '';
                            ?>
                        </td>
                        <td class="max-width countAllToDates column-odd">
                            <?php
                            $toDateProfessions = Blisting::model()->getSectorBlistingToDateCount($professionId);
                            $totalToDates = $totalProfessions + $toDateProfessions;
                            $totalToDatesAll += $totalToDates;
                            echo $totalToDates ? $totalToDates : '';
                            ?>
                        </td>
                        <td class="max-width countAllOnline column-even">
                            <?php

                            $professionUsersCountOnline = Blisting::model()->getSectorBlistingCountOnline($professionId);
                            $totalOnlineAll += $professionUsersCountOnline;
                            echo $professionUsersCountOnline ? $professionUsersCountOnline : '';
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="<?php echo count($resultProfessions) % 2 == 0 ? 'row-even' : 'row-odd'; ?>">
                    <td class="bold" style="text-align: left;">Total for month</td>
                    <?php if ($months) {
                        $i = 0;
                        ?>
                        <?php foreach ($months as $index => $month) { ?>
                            <td class="min-width count <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $totalProfessionsForMonth[$index] ? $totalProfessionsForMonth[$index] : '' ?></td>
                            <?php
                            $i++;
                        } ?>
                    <?php } ?>
                    <td class="max-width countAll column-even"><?php echo $totalProfessionsForYearAll ? $totalProfessionsForYearAll : ''; ?></td>
                    <td class="max-width countAllToDates column-odd"><?php echo $totalToDatesAll ? $totalToDatesAll : ''; ?></td>
                    <td class="max-width countAllOnline column-even"><?php echo $totalOnlineAll ? $totalOnlineAll : ''; ?></td>
                </tr>
            <?php } else { ?>
                <tr class="row-even">
                    <td style="text-align: center;" colspan="16">No listing professions found.</td>
                </tr>
            <?php } ?>
        </table>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div style="margin-bottom:25px;text-align:center"><a href="<?php echo $this->createUrl('exportbListings') ?>"
                                                             class="button  black-btn" title="Download CSV"
                                                             target="_blank">Download CSV</a></div>

    </div>
</div>

</div>
<script>
    jQuery(".chzn-select").chosen();
</script>