  <!-- BEGIN HEADER -->
  <div class="page-header">
  	<!-- BEGIN HEADER TOP -->
  	<div class="page-header-top">
    		<div class="container">
    			<!-- BEGIN LOGO -->
    			<div class="page-logo">
    				<a href="<?php echo Config::get('URL'); ?>"><img src="<?php echo Config::get('URL'); ?>img/rab_logo.jpg" alt="logo" width="150" class="logo-default"></a>
    			</div>
    			<!-- END LOGO -->
    			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
    			<a href="javascript:;" class="menu-toggler"></a>
    			<!-- END RESPONSIVE MENU TOGGLER -->
    			<!-- BEGIN TOP NAVIGATION MENU -->
    			<div class="top-menu">
    			</div>
    			<!-- END TOP NAVIGATION MENU -->
    		</div>
    	</div>
    	<!-- END HEADER TOP -->
    	<!-- BEGIN HEADER MENU -->
    	<div class="page-header-menu">
    		<div class="container">
    			<!-- BEGIN MEGA MENU -->
    			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
    			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
    			<div class="hor-menu ">
            <!-- navigation -->
            <ul class="nav navbar-nav">
                <?php if (Session::userIsLoggedIn()) { ?>
                    <!-- <li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>dashboard/">Home</a>
                    </li> -->
                    <li <?php if (View::checkForActiveController($filename, "events")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>events/">Events</a>
                    </li>
                    <!-- <li <?php if (View::checkForActiveController($filename, "hours")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>hours/">Hours</a>
                    </li> -->
                    <li <?php if (View::checkForActiveController($filename, "sales")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>sales/">Sales</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "bikes")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>bikes/">Bikes</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "parts")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>parts/">Parts</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "people")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>people/type/volunteers">Volunteers</a>
                    </li>
                    <!-- <li <?php if (View::checkForActiveController($filename, "people")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>people/type/customers">Customers</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "people")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>people/type/donors">Donors</a>
                    </li> -->
                    <!-- <li <?php if (View::checkForActiveController($filename, "people")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>people/" data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle hover-initialized">People</a>
                        <ul class="dropdown-menu">
                          <li <?php if (View::checkForActiveController($filename, "people")) { echo ' class="active" '; } ?> >
                              <a href="<?php echo Config::get('URL'); ?>people/type/volunteers">Volunteers</a>
                          </li>
                          <li <?php if (View::checkForActiveController($filename, "people")) { echo ' class="active" '; } ?> >
                              <a href="<?php echo Config::get('URL'); ?>people/type/customers">Customers</a>
                          </li>
                          <li <?php if (View::checkForActiveController($filename, "people")) { echo ' class="active" '; } ?> >
                              <a href="<?php echo Config::get('URL'); ?>people/type/donors">Donors</a>
                          </li>
                        </ul>
                    </li> -->
                    <!-- <li <?php if (View::checkForActiveController($filename, "programs")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>programs/">Programs</a>
                    </li> -->
                    <!-- <li <?php if (View::checkForActiveController($filename, "part")) { echo ' class="active" '; } ?> >
                        <a href="" data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle hover-initialized">Settings</a>
                        <ul class="dropdown-menu">
                            <li <?php if (View::checkForActiveController($filename, "overview")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>profile/index">System Settings</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/showprofile">Account Settings</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
                            </li>
                        </ul>
                    </li>  -->                            
                <?php } else { ?>
                    <!-- for not logged in users -->
                    <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/">Login</a>
                    </li>
                    <!--<li <?php if (View::checkForActiveControllerAndAction($filename, "login/register")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/register">Register</a>
                    </li>-->
                <?php } ?>
            </ul>
          <!-- END MEGA MENU -->
          </div>
      	</div>
      	<!-- END HEADER MENU -->
      </div>
      <!-- END HEADER -->
      <!-- BEGIN PAGE CONTAINER -->
      <div class="page-container">
      	<!-- BEGIN PAGE CONTENT -->
      	<div class="page-content">
      		<div class="container">
      		  <!-- BEGIN PAGE CONTENT INNER -->
      			<div class="row margin-top-10">
      				<div class="col-md-12 col-sm-12">
      					<!-- BEGIN PORTLET-->
      					<div class="portlet light ">