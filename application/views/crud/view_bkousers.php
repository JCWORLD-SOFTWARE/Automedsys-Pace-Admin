<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>authuser">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Backoffice User Management
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
                    <span class="caption-subject font-green-sharp bold uppercase">Backoffice User Management</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                            <a class="edit" href="<?php echo base_url(); ?>crud/bkousercreate">
                                <button id="sample_editable_1_new" class="btn green">
                                    Add Backoffice User <i class="fa fa-plus"></i>
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
                
                <table class="table table-striped table-hover table-bordered" id="schedule_management_1">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Username
                            </th>
                            <th>
                                Name
                            </th>
                            <th style="width:50px;" >
                                Status
                            </th>
                            <th>
                                Added
                            </th>
                            <th>
                                Edit
                            </th>
                            <th>
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($res as $item) : ?>

                            <tr>
                                <td style="width:50px;">
                                    <?= $item["id"] ?>
                                </td>
                                <td>
                                    <?= $item["username"] ?>
                                </td>
                                <td >
                                    <?= $item["name"] ?>
                                </td>
                                <td class="center">
                                    <?= $item["status"] ?>
                                </td>

                                <td class="center">
                                    <?= strtok($item["added"],'.') ?>
                                </td>
                                <td style="width:100px;">
                                    <a class="edit" href="<?php echo base_url(); ?>crud/bkouserupdate?id=<?= $item["id"] ?>">
                                        <button id="sample_editable_1_new" class="btn green">Edit</button></a>
                                </td>
                                <td style="width:100px;">
                                    <a class="edit" href="<?php echo base_url(); ?>crud/bkouserdelete?id=<?= $item["id"] ?>">
                                        <button id="sample_editable_1_new" class="btn red" onclick="return confirm('Are you sure you want to delete this backoffice user?');">Delete</button> </a>
                                </td>
                            </tr>



                        <?php endforeach; ?>

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
