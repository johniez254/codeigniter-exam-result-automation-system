 <?php 

$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 
?>

<script>	
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);	

			}
		});
	}
	</script>
 <!-- modal start -->
                                        <div class="modal fade" id="modal_ajax" data-backdrop="static">
                                            <div class="modal-dialog">
                                                <div class="modal-content"<?php /*?> style="margin-top:100px;"<?php */?>>
                                                    <div class="modal-header" style=" background-color:rgba(153, 114, 181, 1.0);">
                                                        <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;"><i class="fa fa-edit"></i> Edit Details</h4>
                                                    </div>
                                                    <div class="modal-body" style="height:470px; overflow:auto;">

                                                        

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal end -->
                                        
                                        
<script>
//responsible for all delete functions
	
	function confirm_modal(delete_url)
	{
		jQuery('#flexModal').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
		
         $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
	}
	
	</script>
    
        <!-- (Normal Modal)-->
          <div class="modal fade primary" id="flexModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header" style=" background-color:rgba(153, 114, 181, 1.0);">
                    <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">delete</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php if ($page_name=="units"){?>
    <script>
//responsible for all delete functions
	
	function confirm_unit_modal(delete_url)
	{
		jQuery('#unitflexModal').modal('show', {backdrop: 'static'});
		document.getElementById('delete_unit').setAttribute('href' , delete_url);
		
         $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
	}
	
	</script>
    
        <!-- (Normal Modal)-->
          <div class="modal fade primary" id="unitflexModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header" style=" background-color:rgba(153, 114, 181, 1.0);">
                    <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Are you sure you want to unassign this unit?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_unit">Unassign</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php }?>


<?php if($page_name=="lecturers" or $page_name=="students"){?>
<script>	
	function showCustomAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax_custom').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax_custom .modal-body').html(response);	

			}
		});
	}
	</script>
 <!-- modal start -->
                                        <div class="modal fade" id="modal_ajax_custom" data-backdrop="static">
                                            <div class="modal-dialog" style="width: 65%">
                                                <div class="modal-content"<?php /*?> style="margin-top:100px;"<?php */?>>
                                                    <div class="modal-header" style=" background-color:rgba(153, 114, 181, 1.0);">
                                                        <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;"><i class="fa fa-edit"></i> Edit Details</h4>
                                                    </div>
                                                    <div class="modal-body" style="height:470px; overflow:auto;">

                                                        

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal end -->
<?php }?>
