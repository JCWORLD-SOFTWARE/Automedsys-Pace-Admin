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
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                            <h3>Create</h3>
                            </div>
                        </div>
                        <div class="col-md-6">
    
                        </div>
                    </div>
                </div>
                
      <div class="page-toolbar">
        <!-- div class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="<?= $message ?>">
            <i class="icon-calendar"></i>&nbsp; 
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp; 
            <i class="fa fa-angle-down"></i>
        </div-->
        <?= $message ?>
    </div>
    <form name="crud" id="crud" method="post">
    <!-- ClinicData>

      </ClinicData -->
    <div class="col-md-6">
        <!--
        <PromotionCode xmlns="http://www.automedsys.com/messaging">string</PromotionCode>
        <ClinicPracticeCode xmlns="http://www.automedsys.com/messaging">string</ClinicPracticeCode>
        <NPI xmlns="http://www.automedsys.com/messaging">string</NPI>
        <EIN xmlns="http://www.automedsys.com/messaging">string</EIN>
        <ClinicID xmlns="http://www.automedsys.com/messaging">string</ClinicID>
        <ClinicName xmlns="http://www.automedsys.com/messaging">string</ClinicName>
        -->
        <div class="form-group">
            <label class="control-label">Promotion Code</label>
            <input type="text" name="promocode" placeholder="CHRISTMAS" value="<?=$promocode?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Practice Code</label>
            <input type="text" name="practicecode" placeholder="ABCDEF" value="<?=$practicecode?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Practice NPI</label>
            <input type="text" name="practicenpi" placeholder="ABCDEF" value="<?=$practicenpi?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Practice EIN</label>
            <input type="text" name="practiceein" placeholder="EIN" value="<?=$practiceein?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Clinic ID</label>
            <input type="text" name="clinicid" placeholder="" value="<?=$clinicid?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Clinic Name</label>
            <input type="text" name="clinicname" placeholder="Your Clinic" value="<?=$clinicname?>" class="form-control"/>
        </div>
        <!--
        <ClinicContact xmlns="http://www.automedsys.com/messaging">
          <LastName>string</LastName>
          <FirstName>string</FirstName>
          <MiddleName>string</MiddleName>
          <Suffix>string</Suffix>
          <Prefix>string</Prefix>
        </ClinicContact>
        -->
        <div class="form-group">
            <label class="control-label">Contact Prefix</label>
            <input type="text" name="contact_prefix" placeholder="Mr." value="<?=$contact_prefix?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Contact Firstname</label>
            <input type="text" name="contact_firstname" placeholder="John" value="<?=$contact_firstname?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Contact Middlename</label>
            <input type="text" name="contact_middlename" placeholder="Dwayne" value="<?=$contact_middlename?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Contact Lastname</label>
            <input type="text" name="contact_lastname" placeholder="Doe" value="<?=$contact_lastname?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Contact Suffix</label>
            <input type="text" name="contact_suffix" placeholder="Jr." value="<?=$contact_suffix?>" class="form-control"/>
        </div>
    </div>

    <div class="col-md-6">
        <!-- 
        <Address xmlns="http://www.automedsys.com/messaging">
          <Country>string</Country>
          <AddressLine1>string</AddressLine1>
          <AddressLine2>string</AddressLine2>
          <City>string</City>
          <State>string</State>
          <ZipCode>string</ZipCode>
        </Address>
        -->
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
            <input type="text" name="city" placeholder="city" value="<?=$city?>" class="form-control"/>
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
<!--
        <Email xmlns="http://www.automedsys.com/messaging">string</Email>
        <username xmlns="http://www.automedsys.com/messaging">string</username>
        <password xmlns="http://www.automedsys.com/messaging">string</password>
-->
        <div class="form-group">
            <label class="control-label">Email</label>
            <input type="text" name="contact_email" placeholder="john@doe.com" value="<?=$contact_email?>" class="form-control"/>
        </div>

        <div class="form-group">
            <label class="control-label">Username</label>
            <input type="text" name="username" placeholder="jdoe" value="<?=$username?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input type="text" name="password" placeholder="pass" value="<?=$password?>" class="form-control"/>
        </div>
        <!--
        <Phone xmlns="http://www.automedsys.com/messaging">
          <PhoneType>
            <Number>string</Number>
            <Qualifier>string</Qualifier>
          </PhoneType>
          <PhoneType>
            <Number>string</Number>
            <Qualifier>string</Qualifier>
          </PhoneType>
        </Phone>
        -->
        <div class="form-group">
            <label class="control-label">Fax</label>
            <input type="text" name="fax" placeholder="18008008001" value="<?=$fax?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">phone</label>
            <input type="text" name="phone" placeholder="18008008001" value="<?=$phone?>" class="form-control"/>
        </div>
    </div>

    </form>
    <a class="edit" href="#" onclick="document.crud.submit();return false;">
        <button id="sample_editable_1_new" class="btn green">Create</button></a>

    <a class="edit" href="<?php echo base_url(); ?>crud/applications" onclick="return confirm('Are you sure you want to cancel?');">
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

