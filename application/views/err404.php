<?php
echo doctype('html5');
?>
<head>
	<meta charset="utf-8">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url()?>components/assets/images/favicon.png" type="image/x-icon" /> 
       
	<title>err404</title>
    <!-- CORE CSS FRAMEWORK - START -->
        <?php echo link_tag('components/assets/plugins/pace/pace-theme-flash.css'); ?>
        <?php echo link_tag('components/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>
        <?php echo link_tag('components/assets/plugins/bootstrap/css/bootstrap-theme.min.css'); ?>
        <?php echo link_tag('components/assets/fonts/font-awesome/css/font-awesome.css'); ?>
        <?php echo link_tag('components/assets/css/animate.min.css'); ?>
        <?php echo link_tag('components/assets/plugins/perfect-scrollbar/perfect-scrollbar.css'); ?>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <?php echo link_tag('components/assets/css/style.css'); ?>
        <?php echo link_tag('components/assets/css/responsive.css'); ?>
        <!-- CORE CSS TEMPLATE - END -->
</head>

 <!-- BEGIN BODY -->
    <body class=" ">

        <div class="col-lg-12">
            <section class="box nobox">
                <div class="content-body">    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <h1 class="page_error_code text-primary">404</h1>
                            <h1 class="page_error_info">Oops! Page Not Found!</h1>
                            <center><h2 class="lead"><b>URL</b> =  <?php echo base_url(uri_string()); ?></h2></center>

                            <div class="col-md-6 col-sm-6 col-xs-8 col-md-offset-3 col-sm-offset-3 col-xs-offset-2">
                             <p class="lead">The page you've requested could not be found on the server. Please <a href="Mailto:johnsonmatoke@gmail.com"><B class="text text-blue">contact your webmaster</B></a>, or use the back button <strong>(<i class="fa fa-arrow-left"></i>)</strong> in your browser to navigate back to your most recent active page.</p>
                             
                             <div class="text-center page_error_btn">
                                        <a class="btn btn-primary btn-lg" href='<?php echo base_url() ?>login/logout'><i class='fa fa-location-arrow'></i> &nbsp; Back to Login</a>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section></div>



        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


        <!-- CORE JS FRAMEWORK - START --> 
        <script src="<?php echo base_url(); ?>components/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>components/assets/js/jquery.easing.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
        <script src="<?php echo base_url(); ?>components/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
        <!-- CORE JS FRAMEWORK - END --> 


        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url(); ?>components/assets/js/scripts.js" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 