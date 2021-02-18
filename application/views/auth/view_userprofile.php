<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>authuser"> Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Profile Management
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
                    <i class="fa fa-user font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">User Profile</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <label class="control-label">LastName</label>

                            </div><br>
                            <span><?php echo $this->session->userdata('LastName') ?></span>

                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <label class="control-label">FirstName</label>

                            </div><br>
                            <span><?php echo $this->session->userdata('FirstName') ?></span>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <label class="control-label">Email</label>

                            </div><br>
                            <span><?php echo $this->session->userdata('Email') ?></span>

                        </div>
                    </div>

                    
                </div>




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