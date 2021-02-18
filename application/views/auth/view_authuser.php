<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>authuser">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Backoffice
        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <!-- i class="icon-calendar"></i>&nbsp; 
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp; 
            <i class="fa fa-angle-down"></i-->
        </div>
    </div>
</div>
<h3 class="page-title">
    Backoffice 
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
                   <a style="color:white" href='<?php echo base_url(); ?>authuser/findapplication'> Applications</a>
                </div>
                <div class="desc">
                    Manage Applications
                </div>
            </div>
            <a class="more" href="<?php echo base_url(); ?>crud/applications">
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
                    <a style="color:white" href='<?php echo base_url(); ?>crud/servers'> Servers</a>
                </div>
                <div class="desc">
                    Manage Servers
                </div>
            </div>
            <a class="more" href="<?php echo base_url(); ?>crud/servers">
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
                   <a style="color:white" href='<?php echo base_url(); ?>crud/practiceregistration'>  Registrations</a>
                </div>
                <div class="desc">
                    Practice Registrations
                </div>
            </div>
            <a class="more" href="<?php echo base_url(); ?>crud/practiceregistration">
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
                  <a style="color:white" href='<?php echo base_url(); ?>crud/practiceaccounts'>Accounts</a>
                </div>
                <div class="desc">
                   Practice Accounts
                </div>
            </div>
            <a class="more" href="<?php echo base_url(); ?>crud/practiceaccounts">
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
        <!-- div class="portlet light calendar ">
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
        </div -->
        <!-- END PORTLET-->                             


    </div>
    <div class="col-md-6 col-sm-6">


    </div>

</div>
