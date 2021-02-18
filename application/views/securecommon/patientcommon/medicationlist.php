
<!-- BEGIN PORTLET -->
<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase">Medications</span>
        </div>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tabm_1_1" data-toggle="tab">
                    Medication List </a>
            </li>

        </ul>
    </div>
    <?
    /*
      array(21) {
      ["RecordId"]=>
      string(3) "263"
      ["ProviderId"]=>
      string(1) "1"
      ["PatientRecordId"]=>
      string(4) "2423"
      ["BrandName"]=>
      string(35) "Accu-Chek Comfort Curve Test Strips"
      ["DrugName"]=>
      string(35) "Accu-Chek Comfort Curve Test Strips"
      ["DrugCode"]=>
      string(0) ""
      ["CodeType"]=>
      string(0) ""
      ["Take"]=>
      string(0) ""
      ["TakeQualifier"]=>
      string(0) ""
      ["FreqCode"]=>
      string(0) ""
      ["FreqDescr"]=>
      string(0) ""
      ["Direction"]=>
      string(0) ""
      ["Strength"]=>
      string(0) ""
      ["StrengthUOM"]=>
      string(0) ""
      ["StartDate"]=>
      string(4) "/  /"
      ["EndDate"]=>
      string(4) "/  /"
      ["MedicationStatus"]=>
      string(1) "A"
      ["MedicationNote"]=>
      string(0) ""
      ["DosageForm"]=>
      string(0) ""
      ["ICDCode"]=>
      string(0) ""
      ["RxCount"]=>
      int(0)
      }
     */
    ?>
    <div class="portlet-body">
        <!--BEGIN TABS-->
        <div class="tab-content">
            <div class="tab-pane active" id="tabm_1_1">
                <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                    <ul class="feeds">
                        <? foreach ($medications as $item) { ?>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                <?= $item->DrugName ?>. <span class="label label-sm label-info">
                                                    Take action <i class="fa fa-share"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        Just now
                                    </div>
                                </div>
                            </li>
                        <? } ?>
                        <!-- li>
                                <a href="#">
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New version v1.4 just lunched!
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 20 mins
                                        </div>
                                </div>
                                </a>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                                <i class="fa fa-bolt"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Database server #12 overloaded. Please fix the issue.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 24 mins
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New order received and pending for process.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 30 mins
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New payment refund and pending approval.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 40 mins
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-warning">
                                                                <i class="fa fa-plus"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New member registered. Pending approval.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 1.5 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
                                                                Overdue </span>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 2 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Prod01 database server is overloaded 90%.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 3 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-warning">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New group created. Pending manager review.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 5 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Order payment failed.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 18 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New application received.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 21 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Dev90 web server restarted. Pending overall system check.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 22 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New member registered. Pending approval
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 21 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 L45 Network failure. Schedule maintenance.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 22 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Order canceled with failed payment.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 21 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Web-A2 clound instance created. Schedule full scan.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 22 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 Member canceled. Schedule account review.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 21 hours
                                        </div>
                                </div>
                        </li>
                        <li>
                                <div class="col1">
                                        <div class="cont">
                                                <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                </div>
                                                <div class="cont-col2">
                                                        <div class="desc">
                                                                 New order received. Please take care of it.
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col2">
                                        <div class="date">
                                                 22 hours
                                        </div>
                                </div>
                        </li -->
                    </ul>
                </div>
            </div>

        </div>
        <!--END TABS-->
    </div>
</div>
<!-- END PORTLET -->
