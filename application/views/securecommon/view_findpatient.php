<?
//  print_r($search_by);

        $search_by2 = array(
            "AutoMedSysChartNo" => "AutoMedSys Chart Number",
            "SocialSecurity" => "Social Security Number",
            "AutoMedSysRecordId" => "AutoMedSys Record ID",
            "MedicareNumber" => "Medicare Number",
            "MedicaidNumber" => "Medicaid Number",
            "AutoMedSysLastname" => "AutoMedSys Lastname",
        );
        
        
        
?>
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/practiceuser/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Find Patient
        </li>
    </ul>
    <div class="page-toolbar">
        
    </div>
</div>
<h3 class="page-title">
   
</h3>
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->
<div class="row">
    <div class="col-md-12">			

    </div>

    <div class="clearfix">
    </div>

    <form method="post" name="post_nav_find" action="">
        <input type="hidden" name="AutoMedSysChartNo" value="">
    </form>
    <script type="text/javascript">
    <!--
        function post_nav_find_action(what, value) {
            document.post_nav_find.action = what + '';
            document.post_nav_find.AutoMedSysChartNo.value = value;
            document.post_nav_find.submit();
            return false;
        }
    // -->
    </script>

    <!-- BEGIN PAGE CONTENT INNER -->

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Find Patient</span>
                </div>

            </div>
            
            <div class="portlet-title">
                <div class="caption">
             <form method="post">
            <table>
                <tr><td>
                        <select name="search_key" class="form-control" style="width:250px;">
                            <? foreach ($search_by as $key => $val) { ?>
                                <option value="<?= $key ?>"<?= $key == $search_key ? ' selected' : '' ?>><?= $val ?></option>
                            <? } ?>
                        </select>
                    </td>
                    <td>
                    <input type="text" name="search_val" value='<?=$search_val ?>' class="form-control"  /><td>
                    <td>
                        <input type="submit" name="search" value="Search" class="form-control" />
                    </td>
                </tr></table>
        </form>
                </div>

            </div>
            
            
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button id="sample_editable_1_new" class="btn green">
                                    Add New <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;">
                                            Print </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            Save as PDF </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            Export to Excel </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th>
                                Account Number
                            </th>
                            <th>
                                Full Name
                            </th>
                            <th>
                                Gender
                            </th>
                            <th>
                                Marital Status
                            </th>
                            <th>
                                Profile
                            </th>
                            <th>
                                Records
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($result as $item) { 
                            
                            ?>

                            <tr>
                                <td style="width:140px;">
                                     <? echo $item->AccountNumber; ?>
                                   
                                </td>
                                <td>
                                   <?php echo $item->Name->FirstName; ?> <?php echo $item->Name->MiddleName; ?> <?php echo $item->Name->LastName; ?>
                                </td>
                                <td style="width:100px;">
                                    <?php echo $item->Gender; ?>
                                </td>
                                <td class="center" style="width:140px;">
                                    <?php echo $item->MaritalStatus; ?>
                                </td>
                                <td style="width:100px;">
                                    <a class="edit" href="#" onclick="return post_nav_find_action('patientprofile', '<?php echo $item->AccountNumber; ?>')">
                                        <button id="sample_editable_1_new" class="btn green">Profile</button></a>
                                </td>
                                <td style="width:100px;">
                                    <a class="edit" href="#" onclick="return post_nav_find_action('patientrecords', '<?php echo $item->AccountNumber; ?>')">
                                        <button id="sample_editable_1_new" class="btn green">Records</button> </a>
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


