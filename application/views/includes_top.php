 		<link rel="shortcut icon" href="<?php echo base_url()?>components/assets/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>components/assets/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url()?>components/assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url()?>components/assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url()?>components/assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->
        
        
		<?php 
        //get total segments
        $total_segments = $this->uri->total_segments();
        //$last_segment = $this->uri->segment($total_segments);
        if($total_segments==0){
        ?>

        <!-- CORE CSS FRAMEWORK - START -->
        <?php echo link_tag('components/assets/plugins/pace/pace-theme-flash.css')?>
        <?php echo link_tag('components/assets/plugins/bootstrap/css/bootstrap.min.css')?>
        <?php echo link_tag('components/assets/plugins/bootstrap/css/bootstrap-theme.min.css')?>
        <?php echo link_tag('components/assets/fonts/font-awesome/css/font-awesome.css')?>
        <?php echo link_tag('components/assets/css/animate.min.css')?>
        <?php echo link_tag('components/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')?>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <?php echo link_tag('components/assets/plugins/icheck/skins/square/orange.css')?>        
        
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <?php echo link_tag('components/assets/css/style.css')?>
        <?php echo link_tag('components/assets/css/responsive.css')?>
        <!-- CORE CSS TEMPLATE - END -->
        
        <?php }else{?>
        
         <!-- CORE CSS FRAMEWORK - START -->
        <?php echo link_tag('components/assets/plugins/pace/pace-theme-flash.css')?>
        <?php echo link_tag('components/assets/plugins/bootstrap/css/bootstrap.min.css')?>
        <?php /*?><?php echo link_tag('components/assets/plugins/bootstrap-select/bootstrap-select.css')?><?php */?>
        <?php echo link_tag('components/assets/plugins/bootstrap/css/bootstrap-theme.min.css')?>
        <?php echo link_tag('components/assets/fonts/font-awesome/css/font-awesome.css')?>
        <?php echo link_tag('components/assets/css/animate.min.css')?>
        <?php echo link_tag('components/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')?>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <?php echo link_tag('components/assets/plugins/morris-chart/css/morris.css')?>
		<?php echo link_tag('components/assets/plugins/jquery-ui/smoothness/jquery-ui.min.css')?>
		<?php /*?><?php echo link_tag('components/assets/plugins/rickshaw-chart/css/graph.css')?>
		<?php echo link_tag('components/assets/plugins/rickshaw-chart/css/detail.css')?>
		<?php echo link_tag('components/assets/plugins/rickshaw-chart/css/legend.css')?>
		<?php echo link_tag('components/assets/plugins/rickshaw-chart/css/extensions.css')?>
		<?php echo link_tag('components/assets/plugins/rickshaw-chart/css/rickshaw.min.css')?>
		<?php echo link_tag('components/assets/plugins/rickshaw-chart/css/lines.css')?>
		<?php echo link_tag('components/assets/plugins/jvectormap/jquery-jvectormap-2.0.1.css')?><?php */?>
		<?php echo link_tag('components/assets/plugins/icheck/skins/minimal/white.css')?>
        
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE MESSENGER - START -->
        
        <?php echo link_tag('components/assets/plugins/datatables/css/jquery.dataTables.css')?>
		<?php echo link_tag('components/assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css')?>
        <?php echo link_tag('components/assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css')?>
        <?php echo link_tag('components/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css')?> 
         
        <?php echo link_tag('components/assets/plugins/messenger/css/messenger.css')?>
		<?php echo link_tag('components/assets/plugins/messenger/css/messenger-theme-future.css')?>
		<?php echo link_tag('components/assets/plugins/messenger/css/messenger-theme-flat.css')?>       
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE MESSENGER - END --> 
        
        <!-- SMOOTHNESS - START --> 
        <?php echo link_tag('components/assets/plugins/jquery-ui/smoothness/jquery-ui.min.css')?>  
        <!-- SMOOTHNESS - END -->
        
        <!-- DATEPICKER - START --> 
        <?php echo link_tag('components/assets/plugins/datepicker/css/datepicker.css')?> 
		<?php echo link_tag('components/assets/plugins/daterangepicker/css/daterangepicker-bs3.css')?> 
		<?php echo link_tag('components/assets/plugins/timepicker/css/bootstrap-timepicker.css')?> 
		<?php echo link_tag('components/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')?> 
		<!-- DATEPICKER - END -->
        
        <!-- SELECTS - START -->
        <?php echo link_tag('components/assets/plugins/ios-switch/css/switch.css')?> 
		<?php echo link_tag('components/assets/plugins/tagsinput/css/bootstrap-tagsinput.css')?> 
		<?php echo link_tag('components/assets/plugins/select2/select2.css')?> 
		<?php echo link_tag('components/assets/plugins/typeahead/css/typeahead.css')?> 
		<?php echo link_tag('components/assets/plugins/multi-select/css/multi-select.css')?> 
        <!-- SELECTS - END -->  
        
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <?php echo link_tag('components/assets/css/style.css')?>
        <?php echo link_tag('components/assets/css/responsive.css')?>
        <!-- CORE CSS TEMPLATE - END -->
        
		<?php }?>