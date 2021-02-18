<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>authuser"> Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Fetures Management
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
                    <span class="caption-subject font-green-sharp bold uppercase">Features Management</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                            <h3>Update</h3>
                            </div>
                        </div>
                        <div class="col-md-6">
    
                        </div>
                    </div>
                </div>
                
      <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="<?= $message ?>">
            <!-- i class="icon-calendar"></i>&nbsp; 
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp; 
            <i class="fa fa-angle-down"></i -->
            <?= $message ?>
        </div>
    </div>

    		
<form name="crud" id="crud" method="post">

<div class="form-group">
        <label class="control-label">Feature</label>
        <input type="text" name="feature" placeholder="Feature name" value="<?=$feature?>" class="form-control"/>
</div>
<div class="form-group">
        <label class="control-label">List Order</label>
        <input type="text" name="list_order" placeholder="0" value="<?=$list_order?>" class="form-control"/>
</div>
<div class="form-group">
        <label class="control-label">Short Detail</label>
        <input type="text" name="short_detail" placeholder="Cool feature" value="<?=$short_detail?>" class="form-control"/>
</div>
<div class="form-group">
        <label class="control-label">Long Detail</label>
        <textarea name="long_detail" class="form-control" placeholder="Very cool feature"><?=$long_detail?></textarea>
</div>
<div class="form-group">
        <label class="control-label">Feature Group</label>
        <input type="text" name="feature_group" placeholder="1" value="<?=$feature_group?>" class="form-control"/>
</div>
<div class="form-group">
        <label class="control-label">Status</label>
        <label class="uniform-inline">
        <input type="radio" name="status" value="1" <?=$status==1?"checked":""?>/>
        Active </label>
        <label class="uniform-inline">
        <input type="radio" name="status" value="0" <?=$status!=1?"checked":""?>/>
        Inactive </label>
</div>

</form>
    <a class="edit" href="#" onclick="document.crud.submit();return false;">
        <button id="sample_editable_1_new" class="btn green">Update</button></a>

    <a class="edit" href="<?php echo base_url(); ?>crud/features" onclick="return confirm('Are you sure you want to cancel?');">
        <button id="sample_editable_1_new" class="btn red">Cancel</button> </a>

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



