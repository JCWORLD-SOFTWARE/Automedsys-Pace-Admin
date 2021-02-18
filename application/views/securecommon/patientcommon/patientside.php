<div class="profile-sidebar">
    <!-- PORTLET MAIN -->
    <div class="portlet light profile-sidebar-portlet">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <img src="/webtool/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?= show_name($result["Name"]) ?>
            </div>
            <div class="profile-usertitle-job">
                <?= $result["AccountNumber"] ?>
            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->	
        <script type="text/javascript">
        <!--
            function post_nav_action(what) {
                document.post_nav.action = what + '.html';
                document.post_nav.submit();
                return false;
            }
        // -->
        </script>
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li<?= $screen == 'patientprofile' ? ' class="active"' : '' ?>>
                    <a href="#" onclick="return post_nav_action('patientprofile')">
                        <i class="icon-home"></i>
                        View Profile </a>
                </li>
                <li<?= $screen == 'patientrecords' ? ' class="active"' : '' ?>>
                    <a href="#" onclick="return post_nav_action('patientrecords')">
                        <i class="icon-settings"></i>
                        View Records </a>
                </li>									
                <li<?= $screen == 'editpatprofile' ? ' class="active"' : '' ?>>
                    <a href="#" onclick="return post_nav_action('editpatprofile')">
                        <i class="icon-settings"></i>
                        Edit Profile </a>
                </li>

                <li<?= $screen == 'findpatient' ? ' class="active"' : '' ?>>
                    <a href="findpatient.html">
                        <i class="icon-info"></i>
                        Find Patient </a>
                </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
    <form name="post_nav" id="post_nav" method="post" action="?">
        <input type="hidden" name="<?= $ident_key ?>" value="<?= $ident_val ?>">
    </form>
    <!-- PORTLET MAIN -->
    <div class="portlet light">

        <div>
            <h4 class="profile-desc-title">Notes</h4>
            <span class="profile-desc-text"> We will implement Notes listing latter</span>

        </div>
    </div>
    <!-- END PORTLET MAIN -->
</div>
