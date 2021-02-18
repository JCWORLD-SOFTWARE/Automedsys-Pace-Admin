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
                <h3 class="uppercase">Objects2</h3>
            </li>

    <!-- li class="start <?= $screen == 'schedule' ? 'active open' : 'heading' ?>">
        <a href="schedule.html?session=<?= $_SESSION["session"] ?>" >
        <i class="icon-home"></i>
        Schedule
            <?= $screen == 'schedule' ? '<span class="selected"></span><span class="arrow open"></span>' : '<span class="arrow "></span>' ?>
        </a>
        </li -->		

            <li>
                <a href="<?php echo base_url(); ?>practiceuser/schedule?session=<?= $_SESSION["session"] ?>">
                    <i class="icon-bulb"></i>
                    Schedule</a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>practiceuser/manageschedule?session=<?= $_SESSION["session"] ?>">
                    <i class="icon-bulb"></i>
                    Manage Schedule</a>
            </li>
            <li>
                <a href="schedulereports.html?session=<?= $_SESSION["session"] ?>">
                    <i class="icon-graph"></i>
                    Reports</a>
            </li>


            <li class="heading">
                <h3 class="uppercase">Patient</h3>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>practiceuser/findpatient?session=<?= $_SESSION["session"] ?>" >  <i class="icon-settings"></i>Find Patient </a>
               
            </li>

            <li class="heading">
                <h3 class="uppercase">Front Desk</h3>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>practiceuser/findpatient?session=<?= $_SESSION["session"] ?>">
                    <i class="icon-settings"></i>
                    <span class="title">Find Patient</span>
                    <span class="arrow "></span>
                </a>					
            </li>
            <li>
                <a href="findpatient.html?session=<?=$_SESSION["session"] ?>">
                    <i class="icon-settings"></i>
                    <span class="title">New Patient</span>
                    <span class="arrow "></span>
                </a>					
            </li>
            <li>
                <a href="<?php echo base_url(); ?>practiceuser/electronicrx?session=<?=$_SESSION["session"] ?>">
                    <i class="icon-settings"></i>
                    <span class="title">Electronic Rx</span>
                    <span class="arrow "></span>
                </a>					
            </li>				
            <li class="heading">
                <h3 class="uppercase">Encounter</h3>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span class="title">Waiting List</span>
                    <span class="arrow "></span>
                </a>

            </li>


        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->
