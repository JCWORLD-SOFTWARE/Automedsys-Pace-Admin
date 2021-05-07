<?
//print_r($_SESSION);
?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <br/>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>

            <li class="heading">
                <h3 class="uppercase">Objects</h3>
            </li>

    <!-- li class="start <?= (isset($screen) && $screen == 'crud') ? 'active open' : 'heading' ?>">
        <a href="crud.html?session=<?= $_SESSION["session"] ?>" >
        <i class="icon-home"></i>
        Crud
            <?= (isset($screen) && $screen == 'crud') ? '<span class="selected"></span><span class="arrow open"></span>' : '<span class="arrow "></span>' ?>
        </a>
        </li -->		

            <li>
                <a href="<?php echo base_url(); ?>crud/servers">
                    <i class="icon-cloud-upload"></i>
                    <span class="title">Servers</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>crud/practiceregistration">
                    <i class="icon-bulb"></i>
                    <span class="title">Practice Registration</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>authuser/findapplication" >
                    <i class="icon-pencil"></i>
                    <span class="title">Applications</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>crud/applicationcreate">
                            Add New Application
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->
