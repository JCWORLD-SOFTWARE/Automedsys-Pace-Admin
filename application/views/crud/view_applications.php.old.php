<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>authuser"> Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Applications Management
        </li>
    </ul>
    <!-- div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; 
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp; 
            <i class="fa fa-angle-down"></i>
        </div>
    </div -->
</div>

<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->
<div class="row">







    <!-- BEGIN PAGE CONTENT INNER -->

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Applications Management</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                            <a class="edit" href="<?php echo base_url(); ?>crud/applicationcreate">
                                <button id="sample_editable_1_new" class="btn green">
                                    Add Application <i class="fa fa-plus"></i>
                                </button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
    
                        </div>
                    </div>
                </div>
                
      <!-- div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; 
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp; 
            <i class="fa fa-angle-down"></i>
        </div>
    </div -->
                
                <table class="table table-striped table-hover table-bordered" id="schedule_management_1" style="font-size:8.5pt;">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th nowrap>
                                Practice Name<br/>(Username)
                            </th>
                            <th>
                                Tax ID
                            </th>
                            <th style="width:50px;">
                                Practice NPI<br/>(Reference)
                            </th>
                            <th>
                                Type / Status
                            </th>  
                            <th>
                                Phone (Fax)
                            </th>
                            <th>
                                Contact Email<br/>(Name)
                            </th>                          
                            <th>
                                Added / Verified
                            </th>
                            <th>
                                Start Date
                            </th>
                            <th>
                                Edit / Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($res as $item) { ?>
                            <tr>
                                <td style="width:50px;" rowspan="2">
                                    <?= $item["id"] ?>
                                </td>
                                <td>
                                    <?= $item["practicename"] ?> (<?= $item["username"] ?>)
                                </td>                               
                                <td>
                                    <?= $item["taxid"] ?>
                                </td>
                                <td>
                                    <?= $item["practicenpi"] ?><br/>(<?= $item["practicereferencenumber"] ?>)
                                </td>  
                                <td>
                                    <?= $item["practicetype"] ?>
                                </td>  
                                <td>
                                    <?= $item["phone"] ?> (<?= $item["fax"] ?>)
                                </td>
                                <td >
                                    <?= $item["contact_email"] ?><br/>(<?= $item["contact_firstname"]. ' '.$item["contact_firstname"] ?>)
                                </td>
                                <td class="center" nowrap>
                                    <?= str_replace(' ','<br/>',strtok($item["added_date"],'.')) ?>
                                </td>
                                <td class="center" nowrap>
                                    <?= strtok($item["start_date"],' ') ?>
                                </td>
                                <!-- td class="center">
                                    <?= $item["statuscode"] ?>
                                </td>
                                <td class="center">
                                    <?= $item["port_number"] ?>
                                </td -->
                                <td>
                                    <a class="edit" href="<?php echo base_url(); ?>crud/applicationupdate?session=<?= $_SESSION["session"]?>&id=<?= $item["id"] ?>">
                                        <button id="sample_editable_1_new" class="btn green">Edit</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?= $item["street1"].' '.$item["street2"].", ".$item["city"].", ".$item["state"].", ".$item["zipcode"].", ".$item["country"] ?>
                                </td>
                                <td class="center">
                                    <?= $item["status"] ?>
                                </td>
                                <td colspan="2">
                                    <?= $item["verification_link"] ?>
                                </td>
                                <td class="center">
                                    <?= strtok($item["verify_date"],' ') ?>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <a class="edit" href="<?php echo base_url(); ?>crud/applicationdelete?session=<?= $_SESSION["session"]?>&id=<?= $item["id"] ?>">
                                        <button id="sample_editable_1_new" class="btn red" onclick="return confirm('Are you sure you want to delete this application?');">Delete</button> </a>
                                </td>
                            </tr>


                        <? } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT -->
</div>
</div>
<!-- END PAGE CONTENT -->
<?
/* 	
  <hr>
  <table border=1>
  <thead>
  <th style="text-align:center">Record Id</th>
  <th style="text-align:center">Account Number</th>
  <th style="text-align:center">Name</th>
  <th style="text-align:center">Gender</th>
  <th style="text-align:center">Date of Birth</th>
  <th style="text-align:center">Address</th>
  <th style="text-align:center">Email</th>
  <th style="text-align:center">Phone Numbers</th>
  <th style="text-align:center">Insurance Policy</th>
  <th style="text-align:center">Segment Type ID</th>
  <th style="text-align:center">Marital Status</th>
  <th style="text-align:center">Patient ID List</th>
  </thead>
  <tbody>
  <? foreach($result as $item) { ?>
  <tr>
  <td style="text-align:center"><?=$item["RecordId"] ?></td>
  <td style="text-align:center"><?=$item["AccountNumber"] ?></td>
  <td><?=$item["Name"]["FirstName"] ?> <?=$item["Name"]["MiddleName"] ?> <?=$item["Name"]["LastName"] ?></td>
  <td style="text-align:center"><?=$item["Gender"] ?></td>
  <td style="text-align:center"><?=$item["DateOfBirth"] ?></td>
  <td><?=$item["Address"]["AddressLine1"] ?> <?=$item["Address"]["AddressLine2"] ?>,<br/><?=$item["Address"]["City"] ?> <?=$item["Address"]["ZipCode"] ?><br/><?=$item["Address"]["State"] ?> <?=$item["Address"]["Country"] ?></td>
  <td><?=$item["Email"] ?></td>
  <td><? var_dump($item["PhoneNumbers"]) ?></td>
  <td><? vaR_dump($item["InsurancePolicySet"]) ?></td>
  <td style="text-align:center"><?=$item["SegmentTypeID"] ?></td>
  <td style="text-align:center"><?=$item["MaritalStatus"] ?></td>
  <td><ul><? foreach ($item["PatientIDList"]["PatientIDType"] as $id) { foreach ($id as $key=>$val) { ?>
  <li><?= "<b>".$key.":</b> ".$val ?></li>
  <? } } ?></ul></td>
  </tr>
  <? } ?>
  </tbody>
  </table>
 */
?>









</div>
<!-- END DASHBOARD STATS -->

<!-- <?










// </div>
// <!-- END DASHBOARD STATS -->

// <script type="text/javascript">

//     function render_schedule(data) {
//         $("#schedule_management_1 tr").remove();
//         $('#schedule_management_1').append('<tr><th style="width:50px">Appt ID</th><th>Appt Date</th><th>Full Name</th><th>Phone</th><th>Gender</th><th>Profile</th><th>Records</th></tr>');
//         var items = new Array();
//         $.each(data, function (num, item) {
//             $.each(item, function (key, val) {
//                 items[key] = val;
//             });
            
//             $('#schedule_management_1').append('<tr><td>' + items['AccountNumber'] + '</td><td>' + items['AppDate'] + '</td><td>' + items['FullName'] + '</td><td>' + items['Phone'] + '</td><td align="center">' +
//                     items['Gender'] + '</td><td style="width:100px;"><a class="edit" href="patientprofile.html?AutoMedSysRecordId=' + items['Profile'] +
//                     '"><button id="sample_editable_1_new" class="btn green">Profile</button></a></td><td style="width:100px;"><a class="edit" href="patientrecords.html?s=' +
//                     items['Records'] + '"><button id="sample_editable_1_new" class="btn green">Records</button> </a></td></tr>');
//         });
//     }
    /*
     </td>
     <td style="width:100px;">
     <a class="edit" href="patientprofile.html?session=">
     <button id="sample_editable_1_new" class="btn green">Profile</button></a>
     </td>
     <td style="width:100px;">
     <a class="edit" href="patientrecords.html?session=">
     <button id="sample_editable_1_new" class="btn green">Records</button> </a>
     </td>
     */
// -->
// </script>
?> -->

