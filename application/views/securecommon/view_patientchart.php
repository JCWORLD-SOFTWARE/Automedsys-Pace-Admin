<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Find Patient</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#"><?= show_name($result["Name"]) ?> - <?= $result["AccountNumber"] ?></a>

        </li>

    </ul>
    <div class="page-toolbar">

    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row margin-top-20">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->

        <?
        include("patientcommon/patientside.php");
        ?>	
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <?
                    include("patientcommon/patientchart.php");
                    ?>	
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- END PAGE CONTENT-->

