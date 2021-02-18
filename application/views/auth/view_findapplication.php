<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>authuser">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Practice Requests
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
                    <span class="caption-subject font-green-sharp bold uppercase">Practice Requests</span>
                </div>

            </div>
            
            <!-- div class="portlet-title">
                <div class="caption">
             <form name="search_form" id="search_form" method="post">
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

            </div -->
            
            
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- div class="btn-group">
                                <a class="edit" href="/crud/applicationcreate?session=<?= $_SESSION["session"]?>">
                                <button id="sample_editable_1_new" class="btn green">
                                    Add New <i class="fa fa-plus"></i>
                                </button>
                                </a>
                            </div -->
                        </div>
                        <div class="col-md-6">
                            <!-- div class="btn-group pull-right">
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
                            </div -->
                        </div>
                    </div>
                </div>
                <?= $links ?>
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
                    <?php foreach ($result as $item): ?> 
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
                                    <a class="edit" href="/crud/applicationupdate?id=<?= $item["ID"] ?>">
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
                                <td>
                                    <a class="edit" onclick="return confirm('Are you sure you want to approve this practice?')" href="<?php echo base_url(); ?>authuser/selectapplication?practicecode=<?= $item["PracticeCode"] ?>">
                                        <button id="sample_editable_1_new" class="btn green">Approve Practice</button></a>
                                </td>
                                <td>
                                    <a class="edit" href="<?php echo base_url(); ?>crud/applicationdelete?id=<?= $item["ID"] ?>">
                                        <button id="sample_editable_1_new" class="btn red" onclick="return confirm('Are you sure you want to delete this application?');">Delete</button> </a>
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
<style>
.resultitem {
    cursor: default;
}
.resultitem:hover {
    cursor: pointer;
}
</style>
<script type="text/javascript">
<!-- 
function selectResult(id) {
    document.location = '<?php echo base_url(); ?>authuser/selectapplication?id='+id+'&search_key='+document.search_form.search_key.value+'&search_val='+document.search_form.search_val.value;
}
// -->
</script>
