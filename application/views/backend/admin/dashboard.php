<div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">

                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-institution icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $this->db->count_all('schools');?></strong></h4>
                                                <span>Schools</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-building icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $this->db->count_all('departments');?></strong></h4>
                                                <span>Departments</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-group  icon-md icon-rounded icon-purple'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $this->db->count_all('lecturers');?></strong></h4>
                                                <span>Lecturers</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-graduation-cap icon-md icon-rounded icon-warning'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $this->db->count_all('students');?></strong></h4>
                                                <span>Students</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- End .row --> 



                                
                            </div>
                        </section>
                        
                      </div>
                      
                      
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<?php
													
													$where=array("assigned_to_lec"=>0);
													$this->db->select('*');
													$this->db->from('units');
													$this->db->where($where);
													$c_units	=	$this->db->count_all_results();
													$t_c_units	=	$this->db->count_all('units');
									?>
                                     <div class="well primary">
                                     <?php if ($c_units=="0" && $t_c_units=="0"){?>
                                      <center>
                                          <h2>
                                          	<i class="icon-md fa fa-warning "></i>
                                          </h2>
                                          <h3>
                                          	<span class="semi-bold">No Unit Record Available.</span>
                                          </h3>
                                          <hr />
                                          <a class="btn btn-default" href="<?php echo base_url()?>admin/units">View More</a>
                                       </center>
                                       <?php }else if($c_units=="0" && $t_c_units!="0"){?>
                                      <center>
                                          <h2>
                                          	<i class="icon-md fa fa-check"></i>
                                          </h2>
                                          <h3>
                                          	<span class="semi-bold">All Units have been assigned to lecturers.</span>
                                          </h3>
                                          <hr />
                                          <a class="btn btn-default" href="<?php echo base_url()?>admin/units">View More</a>
                                       </center>
                                       
										   <?php }else{?>
                                       <center>
                                          <h2>
                                          	<strong><?php echo $c_units;?></strong>
                                          </h2>
                                          <h3>
                                          	<span class="semi-bold">Unit<?php if($c_units>1){echo "s";}?> <?php if($c_units>1){echo "have";}else{echo "has";}?> not been assigned <?php if($c_units>1){echo "";}else{echo "to";}?> lecturer<?php if($c_units>1){echo "s";}?>.</span>
                                          </h3>
                                          <hr />
                                          <a class="btn btn-default" href="<?php echo base_url()?>admin/units">View More</a>
                                       </center>
                                       <?php }?>
                                     </div>
                                     
                                     </div>
                                    
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <?php
													
													$where=array("added_course"=>0);
													$this->db->select('*');
													$this->db->from('departments');
													$this->db->where($where);
													$c_dept	=	$this->db->count_all_results();
													$t_c_dept	=	$this->db->count_all('departments');
									?>
                                     <div class="well well">
                                            <?php if ($c_dept=="0" && $t_c_dept!="0"){?>
                                      <center>
                                          <h2>
                                          	<i class="icon-md fa fa-check"></i>
                                          </h2>
                                          <h3>
                                          	<span class="semi-bold">All departments have been assigned courses.</span>
                                          </h3>
                                          <hr />
                                          <a class="btn btn-primary" href="<?php echo base_url()?>admin/departments">View More</a>
                                       </center>
                                       <?php }?>
                                       <?php if($c_dept=="0" && $t_c_dept=="0"){?>
                                      <center>
                                          <h2>
                                          	<i class="icon-md fa fa-warning"></i>
                                          </h2>
                                          <h3>
                                          	<span class="semi-bold">No Department Record Available.</span>
                                          </h3>
                                          <hr />
                                          <a class="btn btn-primary" href="<?php echo base_url()?>admin/departments">View More</a>
                                       </center>
                                       <?php }
									   if($c_dept!="0" && $t_c_dept!="0"){?>
                                       <center>
                                          <h2>
                                          	<strong><?php echo $c_dept;?></strong>
                                          </h2>
                                          <h3>
                                          	<span class="semi-bold">Department<?php if($c_dept>1){echo "s";}?> <?php if($c_dept>1){echo "have";}else{echo "has";}?> not been assigned <?php if($c_dept>1){echo "";}else{echo "a";}?> course<?php if($c_dept>1){echo "s";}?></span>
                                          </h3>
                                          <hr />
                                          <a class="btn btn-default" href="<?php echo base_url()?>admin/departments">View More</a>
                                       </center>
                                       <?php }?>
                                            
                                        </div>
                                        
                                     </div>
                                    
                                    
                                    <?php /*?><div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                     <div class="well transparent">
                                            <h3><span class="semi-bold">Latest Uploaded Results:</span></h3>

                                            
                                        </div>
                                        
                                     </div><?php */?>