<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>claimuser">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Schedule
        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; 
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp; 
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>
<h3 class="page-title">
    Schedule <small><?php echo $_SESSION["username"]; ?></small>
</h3>
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                   <a href='<?php echo base_url(); ?>authuser/findpatient'> Find Patient</a>
                </div>
                <div class="desc">
                   Add new patient
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <a href='<?php echo base_url(); ?>authuser/manageschedule'> Manage Appointment</a>
                </div>
                <div class="desc">
                    Schedule Report
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                   <a href='<?php echo base_url(); ?>authuser/manageorders'>  Manage Orders</a>
                </div>
                <div class="desc">
                    New Orders
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                  <a href='<?php echo base_url(); ?>authuser/findpatient'>  Recent Encounters</a>
                </div>
                <div class="desc">
                   Add Encounter
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<!-- END DASHBOARD STATS -->

<div class="clearfix">
</div>

<div class="row">
    <div class="col-md-6 col-sm-6">

        <!-- BEGIN PORTLET-->
        <div class="portlet light calendar ">
            <div class="portlet-title ">
                <div class="caption">
                    <i class="icon-calendar font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Schedule</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="calendar">
                </div>
            </div>
        </div>
        <!-- END PORTLET-->                             


    </div>
    <div class="col-md-6 col-sm-6">


    </div>

</div>
