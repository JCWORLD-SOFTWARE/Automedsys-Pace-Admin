<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>authuser">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            Selected Application
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
    <pre><?= $message ?></pre>
    </div>

    <div class="clearfix">
    </div>

    <!-- BEGIN PAGE CONTENT INNER -->

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Selected Application</span>
                </div>
            </div>

<? if (isset($application) && is_array($application) && array_key_exists("PracticeCode",$application)) { ?>
            <form name="approve" id="approve" method="post" action="?session=<?= $_SESSION["session"]?>&practicecode=<?=$application["PracticeCode"]?>">
            <input type="hidden" name="id" value="<?= $application["ID"] ?>"/>
            <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1" style="font-size:8.5pt;">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <td>
                                    <?= $application["ID"] ?>
                            </td>
                            <th>
                                    Address
                            </th>
                        </tr>
                        <tr>
                            <th nowrap>
                                Practice Name (Username)
                            </th>
                            <td>
                                    <?= $application["PracticeName"] ?> (<?= $application["username"] ?>)
                            </td>
                            <td rowspan="4">
                                    <?= $application["Street1"].'<br/>'.$application["Street2"]."<br/>".$application["City"]."<br/>".$application["State"]."<br/>".$application["ZipCode"]."<br/>".$application["Country"] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tax ID
                            </th>
                            <td>
                                    <?= $application["TaxID"] ?>
                            </td>
                        </tr>
                        <tr>
                            <th style="width:50px;">
                                Practice NPI (Reference)
                            </th>
                            <td>
                                    <?= $application["NPI"] ?> (<?= $application["PracticeCode"] ?>)<br/>
                            </td> 
                        </tr>
                        <tr>
                            <th style="width:50px;">
                                Provider NPI
                            </th>
                            <td>
                                    <?= $application["provider_NPI"] ?>
                            </td> 
                        </tr>
                        <tr>
                            <th>
                                Type / Status
                            </th> 
                            <td>
                                    <?= $application["PracticeType"] ?>
                            </td> 
                            <td class="center">
                                    <?= $application["status"] ?>
                            </td>  
                        </tr>
                        <tr>
                            <th>
                                Phone (Fax)
                            </th>
                            <td>
                                    <?= $application["phone"] ?> (<?= $application["fax"] ?>)
                            </td>
                            <th>
                                    Username / Password
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Contact Email (Name)
                            </th>
                            <td >
                                    <?= $application["contact_email"] ?><br/>(<?= ($application["contact_prefix"]!=NULL?($application["contact_prefix"]." "):"").$application["contact_firstname"]. ' '.$application["contact_firstname"].($application["contact_suffix"]!=NULL?(" ".$application["contact_suffix"]):"") ?>)
                            </td>  
                            <td>
                                    <?= $application["username"]."/".$application["userpwd"] ?>
                            </td>                        
                        </tr>
                        <tr>
                            <th>
                                Promotion Code / Extcode
                            </th>
                            <td class="center" nowrap>
                                    <?= $application["promotion_code"] ?>
                            </td>
                            <td class="center">
                                    <?= $application["extCode"] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Created Date
                            </th>
                            <td class="center" nowrap>
                                    <?= strtok($application["created_dt"],' ') ?>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <form name="crud" id="crud" method="post">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Database Server & Template</label>
                        <?= $templates_combobox ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Server</label>
                        <?= $servers_combobox ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Attach to tenant (Overrides Server)</label>
                        <?= $ranges_combobox ?>
                    </div>
                    <div class="form-group">
                        <?= $practices_combobox ?>
                    </div>

                </div>
                </form>
                <a class="edit" href="#" onclick="if (confirm('Are you sure you want to deploy?')) document.crud.submit();return false;">
                    <button id="deploy_button" class="btn green">Deploy</button></a>

                <a class="edit" href="/authuser/findapplication?search_key=<?=$search_key?>&search_val=<?=$search_val?>" onclick="return confirm('Are you sure you want to cancel?');">
                    <button id="cancel_button" class="btn red">Cancel</button> </a>
            </div>
            </form>
            <h1>NPI validation</h1>
            <a class="edit" href="?practicecode=<?=$application["PracticeCode"]?>&validate_npi=1" onclick="return confirm('Are you sure you want to validate NPIs?');">
                    <button id="validate_button" class="btn blue">Validate</button> </a>
            <table style="width:100%;">
            <thead>
            <tr><th>Practice NPI (<?= $application['NPI'] ?>)</th><th>Provider NPI (<?= $application['provider_NPI'] ?>)</th></tr>
            <thead>
            <tbody>
            <tr valign="top"><td><pre>
<?= json_encode($npi_validation, JSON_PRETTY_PRINT) ?>
            </pre></td>
            <td><pre>
<?= json_encode($provider_npi_validation, JSON_PRETTY_PRINT) ?>
            </pre></td></tr>
            </tbody>
            </table>
<? } ?>
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
    document.location = '<?php echo base_url(); ?>authuser/selectapplication?id='+id;
}
function practiceChanged(value) {
    let submit = $('#deploy_button');
    let range = $('select[name="range"]').val();
    // let practice = $('select[name="practice"]');
    if (value === '0' && range !== '0') {
        submit.prop('disabled', true);
    } else {
        submit.prop('disabled', false);
    }
}
function rangeChanged(value) {
    let template = $('select[name="template"]');
    let server = $('select[name="server"]');
    let range = $('select[name="range"]');
    let practice = $('select[name="practice"]');
    let submit = $('#deploy_button');
    if (value === '') {
        template.prop('disabled', false);
        server.prop('disabled', false);
        submit.prop('disabled', false);
        practice.prop('disabled', true);
    } else {
        practice.prop('disabled', false);
        template.prop('disabled', true);
        server.prop('disabled', true);
        if (practice.val() !== '0')
        {
            submit.prop('disabled', false);
        }
        else
        {
            submit.prop('disabled', true);
        }
    }
}
// -->
</script>
