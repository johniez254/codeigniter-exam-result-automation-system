<?php
$id		 =	$this->session->userdata('id');
$assigned_school       =	$this->db->get_where('lecturers' , array('login_id'=>$id))->row()->assigned_school;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
$lecturer_id       =	$this->db->get_where('lecturers' , array('login_id'=>$id))->row()->lecturer_id;
?>

 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Result Reports</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    
                                    
                                <center>
                                <h3>Select Course, Unit, &amp; Academic Year To View Results Report</h3>
                                    <form class="form-inline" role="form" method="get" action="<?php echo base_url().'lecturer/reports' ?>">
                                                <div class="form-group">
                                                    	<select name="s2example-7" id="s2example-7"onchange="return select_course(this.value)">
                                                                    <option></option>
                                                                      <?php 
                                                                        $where="school_id=".$assigned_school."";
																		$this->db->select('*');
																		$this->db->from('courses');
																		//$this->db->order_by('posted_date','desc');
																		$this->db->where($where);
																		$s	=	$this->db->get()->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['course_id'];?>">
                                                                            <?php echo $row['course_name'];?>
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    	<select name="s2example-8" id="s2example-8" class="">
                                                                    <option></option>
                                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                	<select name="s2example-6" id="s2example-6">
                                                                    <option></option>
                                                                      <?php 
                                                                        $s = $this->db->get('semesters')->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['semester_id'];?>">
                                                                            <?php echo $row['semester_year'];?> <i class="fa fa-angle-double-right"></i> <?php echo 'Year: '.substr($row['semester_name'],0,2);?> Semester: <?php echo substr($row['semester_name'],3);?> (<?php echo $row['semester_name']?>)
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Reload List</button>
                                            </form>
                                            </center>
                                            <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                            <?php if(isset($_GET['s2example-7']) && isset($_GET['s2example-8']) && isset($_GET['s2example-6'])){ ?>
                                            <?php
											 if($_GET['s2example-7']!=null && $_GET['s2example-8']!=null && $_GET['s2example-6']!=null){
												$course=$_GET['s2example-7'];
												$unit=$_GET['s2example-8'];
												$ac_year=$_GET['s2example-6'];
		
												$cs=array('course_id'=>$course,'unit_id'=>$unit,'semester_id'=>$ac_year);
												$this->db->select('*');
												$this->db->from('results');
												$this->db->where($cs);
												$check_data	=	$this->db->count_all_results();
											if($check_data!="0"){
												
												//$query = $this->db->query("select * from results where course_id = ".$course." and unit_id=".$unit." and semester_id=".$ac_year."");
		
												
												
												?>
                                                
                                                
											
                                            
                                                
                                                <div style="min-height:430px; overflow:auto">
                                                    <div class="flot-chart-content" id="students_column_report"></div>
                                                </div>
                                                
                                            <?php
											}//check data
											else{
												echo ' <div class="alert alert-warning alert-dismissible fade in">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
															<strong>Infor:</strong> You have not uploaded any results yet. Please Upload results to view reports!
														</div>
'; 
											}
											 }//not null
											 else{
												echo ' <div class="alert alert-error alert-dismissible fade in">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
															<strong>Error:</strong> You have not selected all fields. Please select all the fields and try again!
														</div>
'; 
											 }
												}//end if isset
											?>

                                    
                                    
                                     </div>
                                </div>
                          </section>
                      </div>
                      
                      
                      
                      <script>
	//select course
	function select_course(id) {

    	$.ajax({
            url: '<?php echo base_url()?>lecturer/units_crud/select_unit/' + id ,
            success: function(response)
            {
                jQuery('#s2example-8').html(response);
            }
        });

    }
	</script>  
