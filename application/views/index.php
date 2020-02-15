<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$system_abbr       =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_abbr;
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 

$name       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->name;
$reg_no       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->username;
?>

<?php if($role=="admin"){?>
<!DOCTYPE html>
<html lang="en">

<head>
       
        
	<meta charset="utf-8">
	<title><?php echo $system_abbr?> :: <?php echo ucwords($page_title);?></title>
    
       <?php include "includes_top.php"?>

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
    
    <!-- START TOPBAR -->
        <?php include 'top-bar.php';?>
        <!-- END TOPBAR -->
        
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <!-- SIDEBAR - START -->
            <div class="page-sidebar ">

                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="<?php echo base_url()?>admin/profile">
                                <img src="<?php echo $this->adm->get_image_url('user',$id);?>" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3>
                                <a href="<?php echo base_url()?>admin/profile"><?php echo $name;?></a>

                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>

                            <p class="profile-title"><?php if($role=='admin'){echo 'Administrator';}else{echo $role;}?></p>

                        </div>

                    </div>
                    <!-- USER INFO - END -->



                    <ul class='wraplist'>	

						<!-- dashboard -->
                        <li <?php if($page_name=="dashboard"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>admin/dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<!-- dashboard end-->
                        
                        <!--institution start-->
                        <li  <?php if($page_name=="schools" or $page_name=="departments" or $page_name=="courses" or $page_name=="view school"){echo 'class="open"';}else{}?>> 
                            <a href="javascript:;">
                                <i class="fa fa-university"></i>
                                <span class="title">Institution</span>
                                <span class="arrow <?php if($page_name=="schools" or $page_name=="departments" or $page_name=="courses"){echo 'open';}else{}?>"></span><!--<span class="label label-orange">4</span>-->
                            </a>
                            <ul class="sub-menu"  <?php if($page_name=="schools" or $page_name=="departments" or $page_name=="courses"){echo 'style="display:block"';}else{}?>>
                                <li>
                                	<a href="<?php echo base_url()?>admin/schools" <?php if($page_name=="schools"){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Schools</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>admin/departments" <?php if($page_name=="departments" ){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Departments</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>admin/courses" <?php if($page_name=="courses" ){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Courses</a>
                                </li>
                            </ul>
                        </li>

                        <!--institution end-->
                        
                        <!--Academics start-->
                        <li  <?php if($page_name=="semesters" or $page_name=="units" or  $page_name=="grades"){echo 'class="open"';}else{}?>> 
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span class="title">Education</span>
                                <span class="arrow <?php if($page_name=="semesters" or $page_name=="units" or  $page_name=="grades"){echo 'open';}else{}?>"></span><!--<span class="label label-orange">4</span>-->
                            </a>
                            <ul class="sub-menu"  <?php if($page_name=="semesters" or $page_name=="units" or  $page_name=="grades"){echo 'style="display:block"';}else{}?>>
                                <li>
                                	<a href="<?php echo base_url()?>admin/semesters" <?php if($page_name=="semesters"){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Semesters</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>admin/units" <?php if($page_name=="units" ){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Units</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>admin/grades" <?php if($page_name=="grades" ){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Grades</a>
                                </li>
                            </ul>
                        </li>

                        <!--academics end-->
                        
                        <!--users start-->
                        <li  <?php if($page_name=="lecturers" or $page_name=="students"  or $page_name=="view result" ){echo 'class="open"';}else{}?>> 
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span class="title">Users</span>
                                <span class="arrow <?php if($page_name=="lecturers" or $page_name=="students" ){echo 'open';}else{}?>"></span><!--<span class="label label-orange">4</span>-->
                            </a>
                            <ul class="sub-menu"  <?php if($page_name=="lecturers" or $page_name=="students" ){echo 'style="display:block"';}else{}?>>
                                <li>
                                	<a href="<?php echo base_url()?>admin/lecturers" <?php if($page_name=="lecturers"){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Lecturers</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>admin/students" <?php if($page_name=="students"  or $page_name=="view result"){echo 'class="active"';}else{}?>><i class="fa fa-angle-double-right"></i> Students</a>
                                </li>
                            </ul>
                        </li>

                        <!--users end-->
                        
                        
                        <!-- reports -->
                         <li <?php if($page_name=="reports"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>admin/reports">
                                <i class="fa fa-bar-chart"></i>
                                <span class="title">Reports</span>
                            </a>
                        </li>
						<!-- reports end -->

                    </ul>

                </div>
                <!-- MAIN MENU - END -->



                <div class="project-info">

                    <div class="block1">
                    	<a href="<?php echo base_url()?>admin/settings"><i class="fa fa-cog"></i> <strong>Settings</strong></a>

                    </div>
			
                    <div class="block2">
                    <a href="<?php echo base_url()?>admin/logout"><i class="fa fa-lock"></i> <strong>Logout</strong></a>
                    </div>

                </div>



            </div>
            <!--  SIDEBAR - END -->
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <?php include 'breadcrumb.php';?>

                    <?php include 'backend/'.$role.'/'.$page_name.'.php';?>



                </section>
            </section>
            <!-- END CONTENT -->
            </div>
        <!-- END CONTAINER -->

        <?php include 'modal.php';?>
        <?php include 'includes_bottom.php';?>
        
    </body>

</html>

<?php }?>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<?php if($role=="lecturer"){?>
<!DOCTYPE html>
<html lang="en">

<head>
       
        
	<meta charset="utf-8">
	<title><?php echo $system_abbr?> :: <?php echo ucwords($page_title);?></title>
    
       <?php include "includes_top.php"?>

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
    
    <!-- START TOPBAR -->
        <?php include 'top-bar.php';?>
        <!-- END TOPBAR -->
        
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <!-- SIDEBAR - START -->
            <div class="page-sidebar ">

                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="<?php echo base_url()?>lecturer/profile">
                                <img src="<?php echo $this->lec->get_image_url('user',$id);?>" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3>
                            	<?php $stringed_name=explode(' ', trim($name));?>
                                <a href="<?php echo base_url()?>lecturer/profile"><?php echo ucwords($stringed_name[0]) . ' <span style="font-size:small; font-weight:bold;">('. ($reg_no).')</span>';?></a>

                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>

                            <p class="profile-title"><?php if($role=='admin'){echo 'Administrator';}else{echo ucwords($role);}?></p>

                        </div>

                    </div>
                    <!-- USER INFO - END -->



                    <ul class='wraplist'>	

						<!-- dashboard -->
                        <li <?php if($page_name=="dashboard"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>lecturer/dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<!-- dashboard end-->
                        
                        
                        
                        <!-- courses -->
                        <li <?php if($page_name=="courses" or $page_name=="view student"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>lecturer/courses">
                                <i class="fa fa-building"></i>
                                <span class="title">Courses</span>
                            </a>
                        </li>
						<!-- courses end-->
                        
                        <!-- Units -->
                        <li <?php if($page_name=="units"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>lecturer/units">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">Units</span>
                            </a>
                        </li>
						<!-- Departments end-->
                        
                        <!-- Attendance -->
                        <li <?php if($page_name=="student attendances" or $page_name=="view attendance"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>lecturer/attendance">
                                <i class="fa fa-clock-o"></i>
                                <span class="title">Attendance</span>
                            </a>
                        </li>
						<!-- attendance end-->
                        
                        <!-- results -->
                        <li <?php if($page_name=="results" or $page_name=="view result"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>lecturer/results">
                                <i class="fa fa-book"></i>
                                <span class="title">Results</span>
                            </a>
                        </li>
						<!-- results end-->
                        
                       
                        
                        <!-- reports -->
                         <li <?php if($page_name=="reports"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>lecturer/reports">
                                <i class="fa fa-bar-chart"></i>
                                <span class="title">Reports</span>
                            </a>
                        </li>
						<!-- reports end -->

                    </ul>

                </div>
                <!-- MAIN MENU - END -->



                <div class="project-info">

                    <div class="block1">
                    <a href="<?php echo base_url()?>lecturer/profile"><i class="fa fa-user"></i> <strong>Profile</strong></a>
                    </div>

                    <div class="block2">
                    <a href="<?php echo base_url()?>lecturer/logout"><i class="fa fa-lock"></i> <strong>Logout</strong></a>
                    </div>

                </div>



            </div>
            <!--  SIDEBAR - END -->
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <?php include 'breadcrumb.php';?>

                    <?php include 'backend/'.$role.'/'.$page_name.'.php';?>



                </section>
            </section>
            <!-- END CONTENT -->
            </div>
        <!-- END CONTAINER -->

        <?php include 'modal.php';?>
        <?php include 'includes_bottom.php';?>
        
    </body>

</html>
<?php }?>
<!-- ---------------------------------------------------------------------------------------------------------------------- -->

<?php if($role=="student"){?>

<!DOCTYPE html>
<html lang="en">

<head>
       
        
	<meta charset="utf-8">
	<title><?php echo $system_abbr?> :: <?php echo ucwords($page_title);?></title>
    
       <?php include "includes_top.php"?>

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
    
    <!-- START TOPBAR -->
        <?php include 'top-bar.php';?>
        <!-- END TOPBAR -->
        
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <!-- SIDEBAR - START -->
            <div class="page-sidebar ">

                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="<?php echo base_url()?>student/profile">
                                <img src="<?php echo $this->stud->get_image_url('user',$id);?>" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3>
                            <?php $stringed_name=explode(' ', trim($name));?>
                                <a href="<?php echo base_url()?>student/profile"><?php echo ucwords($stringed_name[0]).'<br/><small>'.$reg_no.'</small>';?></a>

                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>

                            <p class="profile-title"><?php if($role=='admin'){echo 'Administrator';}else{echo ucwords($role);}?></p>

                        </div>

                    </div>
                    <!-- USER INFO - END -->



                    <ul class='wraplist'>	

						<!-- dashboard -->
                        <li <?php if($page_name=="dashboard"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>student/dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<!-- dashboard end-->
                       
                        
                        <!-- units -->
                         <li <?php if($page_name=="units"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>student/units">
                                <i class="fa fa-book"></i>
                                <span class="title">Units</span>
                            </a>
                        </li>
						<!-- units end -->
                       
                        
                        <!-- lecturers -->
                         <li <?php if($page_name=="lecturers"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>student/lecturers">
                                <i class="fa fa-users"></i>
                                <span class="title">Lectures</span>
                            </a>
                        </li>
						<!-- lecturers end -->
                        
                        
                         <!-- results -->
                         <li <?php if($page_name=="results"){echo 'class="open"';}else{}?>> 
                            <a href="<?php echo base_url()?>student/results">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">Results</span>
                            </a>
                        </li>
						<!-- results end -->

                    </ul>

                </div>
                <!-- MAIN MENU - END -->



                <div class="project-info">

                    <div class="block1">
                     <a href="<?php echo base_url()?>student/profile"><i class="fa fa-user"></i> <strong>Profile</strong></a>
                    </div>

                    <div class="block2">
                     <a href="<?php echo base_url()?>student/logout"><i class="fa fa-lock"></i> <strong>Logout</strong></a>
                    </div>

                </div>



            </div>
            <!--  SIDEBAR - END -->
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <?php include 'breadcrumb.php';?>

                    <?php include 'backend/'.$role.'/'.$page_name.'.php';?>



                </section>
            </section>
            <!-- END CONTENT -->
            </div>
        <!-- END CONTAINER -->

        <?php include 'modal.php';?>
        <?php include 'includes_bottom.php';?>
        
    </body>

</html>
<?php }?>