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
        <div class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
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
            
            <div class="portlet-body overflow-x-scroll">
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
        <div class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; 
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp; 
            <i class="fa fa-angle-down"></i>
        </div>
    </div -->
            <?php if (isset($result) && is_array($result) && count($result)>0) { ?>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1" style="font-size:8.5pt;">
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
                                Practice NPI<br/>(Code)
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
                                Created
                            </th>
                            <th>
                                Edit / Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $item) : ?>
                            <tr class="resultitem" onclick='selectResult(<?= $item["ID"] ?>);'>
                                <td style="width:50px;" rowspan="2">
                                    <?= $item["ID"] ?>
                                </td>
                                <td>
                                    <?= $item["PracticeName"] ?> (<?= $item["PracticeName"] ?>)
                                </td>                               
                                <td>
                                    <?= $item["TaxID"] ?>
                                </td>
                                <td>
                                    <?= $item["NPI"] ?><br/>(<?= $item["PracticeCode"] ?>)
                                </td>  
                                <td>
                                    <?= $item["PracticeType"] ?>
                                </td>  
                                <td>
                                    <?= $item["phone"] ?> (<?= $item["fax"] ?>)
                                </td>
                                <td >
                                    <?= $item["contact_email"] ?><br/>(<?= $item["contact_firstname"]. ' '.$item["contact_firstname"] ?>)
                                </td>
                                <td class="center" nowrap>
                                    <?= str_replace(' ','<br/>',strtok($item["created_dt"],'.')) ?>
                                </td>
                                <!-- td class="center">
                                    <?= $item["statuscode"] ?>
                                </td>
                                <td class="center">
                                    <?= $item["port_number"] ?>
                                </td -->
                                <td>
                                    <a class="edit" href="<?php echo base_url(); ?>crud/applicationupdate?id=<?= $item["ID"] ?>">
                                        <button id="sample_editable_1_new" class="btn green">Edit</button></a>
                                </td>
                            </tr>
                            <tr class="resultitem" onclick='selectResult(<?= $item["ID"] ?>);'>
                                <td colspan="3">
                                    <?= $item["Street1"].' '.$item["Street2"].", ".$item["City"].", ".$item["State"].", ".$item["ZipCode"].", ".$item["Country"] ?>
                                </td>
                                <td class="center">
                                    <?= $item["status"] ?>
                                </td>
                                <td colspan="2">
                                    <?= $item["Server"] ?> / <?= $item["DBName"] ?>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <a class="edit" href="<?php echo base_url(); ?>crud/applicationdelete?id=<?= $item["ID"] ?>">
                                        <button id="sample_editable_1_new" class="btn red" onclick="return confirm('Are you sure you want to delete this application?');">Delete</button> </a>
                                </td>
                            </tr>


                        <?php endforeach; ?>

                    </tbody>
                </table>
            <?php } else { ?> 
                NO REQUESTS LOADED<br/>
                <div style="font-weight:bold;color:red;"><?= $message ?></div>
            <?php } ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT -->
</div>
</div>
<!-- END PAGE CONTENT -->

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

