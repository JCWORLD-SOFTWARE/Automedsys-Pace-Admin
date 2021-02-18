<form method="post" action="viewchart.html" name="viewchart_nav">
    <input type="hidden" name="PatientChartNo" value="" />
    <input type="hidden" name="EncounterRecordId" value="" />
</form>
<script type="text/javascript">
<!--
    function viewchart_nav_action(PatientChartNo, EncounterRecordId) {
        document.viewchart_nav.PatientChartNo.value = PatientChartNo;
        document.viewchart_nav.EncounterRecordId.value = EncounterRecordId;
        document.viewchart_nav.submit();
        return false;
    }
// -->
</script>
<!-- BEGIN PORTLET -->
<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase">Encounters</span>
        </div>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab">
                    Encounter List </a>
            </li>
            <li>
                <a href="#tab_1_2" data-toggle="tab">
                    Add New Encounter </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <!--BEGIN TABS-->
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                    <ul class="feeds">									
                        <?
                        /*
                          array(8) {
                          ["EncounterDescription"]=>
                          string(12) "Office Visit"
                          ["EncounterTypeID"]=>
                          string(1) "0"
                          ["ChartNo"]=>
                          string(8) "TT000916"
                          ["RecordID"]=>
                          string(4) "3627"
                          ["EncouterStatus"]=>
                          string(2) "15"
                          ["CareGiverName"]=>
                          array(3) {
                          ["LastName"]=>
                          string(7) "Chapman"
                          ["FirstName"]=>
                          string(5) "Larry"
                          ["Suffix"]=>
                          string(3) "FNP"
                          }
                          ["EncounterDate"]=>
                          string(10) "08/27/2010"
                          ["PatientName"]=>
                          array(3) {
                          ["LastName"]=>
                          string(4) "test"
                          ["FirstName"]=>
                          string(5) "testy"
                          ["MiddleName"]=>
                          string(0) ""
                          }
                          }
                         */
                        foreach ($encounters as $key => $item) {
                            ?>
                            <li>
                                <a href="#" onclick="return viewchart_nav_action('<?= $item->ChartNo ?>', '<?= $item->RecordID ?>')">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-success">
                                                    <i class="fa fa-bell-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    <?= $item->EncounterDate . " " . show_name($result["Name"]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            View 
                                        </div>
                                    </div>
                                </a>
                            </li>														 



                            <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="tab_1_2">											
                <div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                    IMPLEMENT ADD NEW ENCOUNTER STUFFS HERE LATTER
                </div>
            </div>
        </div>
        <!--END TABS-->
    </div>
</div>
<!-- END PORTLET -->
