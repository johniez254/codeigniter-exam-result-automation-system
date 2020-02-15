<?php 
        //get total segments
        $total_segments = $this->uri->total_segments();
        //$last_segment = $this->uri->segment($total_segments);
        if($total_segments==0){
        ?>
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
        <script src="<?php echo base_url(); ?>components/assets/plugins/icheck/icheck.min.js" type="text/javascript"></script>
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url(); ?>components/assets/js/scripts.js" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 
        
        <!--CUSTOM SCRIPTS -START-->
        <script src="<?php echo base_url(); ?>components/customs/login.js" type="text/javascript"></script>
        <!--CUSTOM SCRIPTS -START-->
        
        
        <?php }else{?>
        
        
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


       
        
         <!-- CORE JS FRAMEWORK - START --> 
        <script src="<?php echo base_url(); ?>components/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>components/assets/js/jquery.easing.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>  
        <?php /*?><script src="<?php echo base_url(); ?>components/assets/plugins/bootstrap-select/bootstrap-select.js" type="text/javascript"></script> <?php */?>
        <script src="<?php echo base_url(); ?>components/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
        <script src="<?php echo base_url(); ?>components/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
        <!-- CORE JS FRAMEWORK - END --> 


        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
         
        <!--START DATATABLES-->
        <script src="<?php echo base_url(); ?>components/assets/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>		        
		<script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>				        
		<script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/export/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/export/buttons.flash.min.js"></script>
        <script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/export/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/export/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/export/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/export/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>components/assets/plugins/datatables/extensions/export/buttons.print.min.js"></script>
        <!--END DATATABLES-->
        
        <!--START MESSENGER-->
        <script src="<?php echo base_url(); ?>components/assets/plugins/messenger/js/messenger.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>components/assets/plugins/messenger/js/messenger-theme-future.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>components/assets/plugins/messenger/js/messenger-theme-flat.js" type="text/javascript"></script>
        <!--END MESSENGER-->
        
        <!--START multiple select-->
        <?php /*?><script src="<?php echo base_url(); ?>components/assets/plugins/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/assets/plugins/tagsinput/js/bootstrap-tagsinput.min.js" type="text/javascript"></script><?php */?>
		 <script src="<?php echo base_url(); ?>components/assets/plugins/select2/select2.min.js" type="text/javascript"></script>
         <script src="<?php echo base_url(); ?>components/assets/plugins/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
        <!--END multiple select-->
        
        <!--START DATETIME-->
        <script src="<?php echo base_url(); ?>components/assets/plugins/datepicker/js/datepicker.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>components/assets/plugins/daterangepicker/js/moment.min.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>components/assets/plugins/daterangepicker/js/daterangepicker.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>components/assets/plugins/timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>components/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script> 																				        <script src="<?php echo base_url(); ?>components/assets/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.fr.js" type="text/javascript"></script>
        <!--END DATETIME-->
        
        <!-- Input masks - START --> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>components/assets/plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
        <!-- Input masks - End --> 
        
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url(); ?>components/assets/js/scripts.js" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 
        
        


        
        <?php if ($page_name=='units'){?>
		<script src="<?php echo base_url(); ?>components/customs/units.js"></script>
    	<?php }?> 
         <?php if ($page_name=='profile'){?>
		<script src="<?php echo base_url(); ?>components/customs/profile.js"></script>
    	<?php }?>
        <?php if ($page_name=='settings'){?>
		<script src="<?php echo base_url(); ?>components/customs/settings.js"></script>
    	<?php }?> 
        <?php if ($page_name=='schools'){?>
		<script src="<?php echo base_url(); ?>components/customs/schools.js"></script>
    	<?php }?> 
        <?php if ($page_name=='departments'){?>
		<script src="<?php echo base_url(); ?>components/customs/departments.js"></script>
    	<?php }?> 
        <?php if ($page_name=='courses'){?>
		<script src="<?php echo base_url(); ?>components/customs/courses.js"></script>
    	<?php }?> 
        <?php if ($page_name=='students'){?>
		<script src="<?php echo base_url(); ?>components/customs/students.js"></script>
    	<?php }?> 
        <?php if ($page_name=='lecturers'){?>
		<script src="<?php echo base_url(); ?>components/customs/lecturers.js"></script>
    	<?php }?> 
        <?php if ($page_name=='grades'){?>
		<script src="<?php echo base_url(); ?>components/customs/grades.js"></script>
    	<?php }?> 
        <?php if ($page_name=='semesters'){?>
		<script src="<?php echo base_url(); ?>components/customs/semesters.js"></script>
    	<?php }?> 
        <?php if ($page_name=='reports'){?>
		<script src="<?php echo base_url(); ?>components/customs/reports.js"></script>
    	<?php }?> 
        <?php if ($page_name=='results' or $page_name=='view result'){?>
		<script src="<?php echo base_url(); ?>components/customs/results.js"></script>
    	<?php }?><?php if ($page_name=='reports'){?>  
		<?php /*?><?php */?>
        <script src="<?php echo base_url(); ?>components/canvas/canvas.js"></script>
        <?php include"charts.php"?>
        <?php }?> 
        <?php if ($page_name=='student attendances'){?>
		<script src="<?php echo base_url(); ?>components/customs/attendance.js"></script>
    	<?php }?>
        
        <?php /*?>
        
		<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

        <!-- SMOOTHNESS - START --> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script> 
        <!-- SMOOTHNESS - END --> 

        
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url(); ?>components/assets/js/scripts.js" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>components/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> <?php */?>
        
		<?php }?>
		
        
        <!-- SHOW TOASTR NOTIFICATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">

 Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
        theme: 'flat'
    }

    Messenger().post({
        message: '<?php echo $this->session->flashdata("flash_message");?>',
        id: "Only-one-message",
        type: 'success',
        showCloseButton: true
    });

	
</script>

<?php endif;?>

<!-- SHOW TOASTR NOTIFICATION -->
<?php if ($this->session->flashdata('error_message') != ""):?>

<script type="text/javascript">
 Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
        theme: 'flat'
    }

    Messenger().post({
        message: '<?php echo $this->session->flashdata("error_message");?>',
        id: "Only-one-message",
        type: 'error',
        showCloseButton: true
    });
</script>

<?php endif;?>