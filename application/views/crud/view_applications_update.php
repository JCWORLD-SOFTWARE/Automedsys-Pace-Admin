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

<div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Practice Name</label>
            <input type="text" name="practicename" placeholder="practicename" value="<?=$practicename?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Street1</label>
            <input type="text" name="street1" placeholder="street1" value="<?=$street1?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Street2</label>
            <input type="text" name="street2" placeholder="street2" value="<?=$street2?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">City</label>
            <input type="text" name="country" placeholder="city" value="<?=$city?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">State</label>
            <input type="text" name="state" placeholder="state" value="<?=$state?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Zip Code</label>
            <input type="text" name="zipcode" placeholder="zipcode" value="<?=$zipcode?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Country</label>
            <input type="text" name="country" placeholder="US" value="<?=$country?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Fax</label>
            <input type="text" name="fax" placeholder="18008008001" value="<?=$fax?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Phone</label>
            <input type="text" name="phone" placeholder="18008008001" value="<?=$phone?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Practice Reference Number</label>
            <input type="text" name="practicereferencenumber" placeholder="ABCDEF" value="<?=$practicereferencenumber?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Status</label><br/>
            <label class="uniform-inline">
            <input type="radio" name="status" value="1" <?=$status==1?"checked":""?>/>
            Active </label>
            <label class="uniform-inline">
            <input type="radio" name="status" value="0" <?=$status!=1?"checked":""?>/>
            Inactive </label>
        </div>
        <div class="form-group">
            <label class="control-label">Verify Date</label>
            <input type="text" name="verify_date" placeholder="<?=date('Y-m-d H:i:s')?>" value="<?=$verify_date?>" class="form-control"/>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Contact Email</label>
            <input type="text" name="contact_email" placeholder="john@doe.com" value="<?=$contact_email?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Contact Firstname</label>
            <input type="text" name="contact_firstname" placeholder="John" value="<?=$contact_firstname?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Contact Lastname</label>
            <input type="text" name="contact_lastname" placeholder="Doe" value="<?=$contact_lastname?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Username</label>
            <input type="text" name="username" placeholder="jdoe" value="<?=$username?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input type="text" name="password" placeholder="pass" value="<?=$password?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Verification Link</label>
            <input type="text" name="verification_link" placeholder="urlcode" value="<?=$verification_link?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Tax ID</label>
            <input type="text" name="taxid" placeholder="taxid" value="<?=$taxid?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Practice NPI</label>
            <input type="text" name="practicenpi" placeholder="ABCDEF" value="<?=$practicenpi?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Practice Type</label>
            <?= $practicetype_combobox ?>
        </div>
        <div class="form-group">
            <label class="control-label">Status Code</label>
            <input type="text" name="statuscode" placeholder="0" value="<?=$statuscode?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Port Number</label>
            <input type="text" name="port_number" placeholder="0" value="<?=$port_number?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Start Date</label>
            <input type="text" name="start_date" placeholder="<?=date('Y-m-d H:i:s')?>" value="<?=$start_date?>" class="form-control"/>
        </div>  
    </div>

</form>
    <a class="edit" href="#" onclick="document.crud.submit();return false;">
        <button id="sample_editable_1_new" class="btn green">Update</button></a>

    <a class="edit" href="/crud/applications" onclick="return confirm('Are you sure you want to cancel?');">
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



