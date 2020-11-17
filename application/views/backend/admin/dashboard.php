<div class="col-lg-12">
  <section class="box nobox">
    <div class="content-body">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="r4_counter db_box">
            <i class='pull-left fa fa-institution icon-md icon-rounded icon-primary'></i>
            <div class="stats">
              <h4>
                <strong>
                  <?php echo $total_schools;?>
                </strong>
              </h4>
              <span>Schools</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="r4_counter db_box">
            <i class='pull-left fa fa-building icon-md icon-rounded icon-orange'></i>
            <div class="stats">
              <h4>
                <strong>
                  <?php echo $total_departments; ?>
                </strong>
              </h4>
              <span>Department<?php if($total_departments>1){echo "s";}?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="r4_counter db_box">
            <i class='pull-left fa fa-group  icon-md icon-rounded icon-purple'></i>
            <div class="stats">
              <h4>
                <strong><?php echo $total_lecturers;?></strong>
              </h4>
              <span>Lecturer<?php if($total_lecturers>1){echo "s";}?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="r4_counter db_box">
            <i class='pull-left fa fa-graduation-cap icon-md icon-rounded icon-warning'></i>
            <div class="stats">
              <h4>
                <strong><?php echo $total_students;?></strong>
              </h4>
              <span>Student<?php if($total_students>1){echo "s";}?></span></span>
            </div>
          </div>
        </div>
      </div>
      <!-- End .row -->
    </div>
  </section>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="well primary">
    <?php if ($assigned_units=="0" && $total_units=="0"){?>
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
    <?php }else if($assigned_units=="0" && $total_units!="0"){?>
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
          <strong><?php echo $assigned_units;?></strong>
        </h2>
        <h3>
          <span class="semi-bold">Unit<?php if($assigned_units>1){echo "s";}?> 
            <?php if($assigned_units>1){
              echo "have";
            }
            else{
              echo "has";
            }?> not been assigned 
            <?php if($assigned_units>1){
              echo "";
            }else{echo "to";
            }?> lecturer<?php if($assigned_units>1){echo "s";}?>.
          </span>
        </h3>
        <hr />
        <a class="btn btn-default" href="<?php echo base_url()?>admin/units">View More</a>
      </center>
    <?php }?>
  </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="well well">
    <?php if ($assigned_departments=="0" && $total_departments!="0"){?>
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
    <?php if($assigned_departments=="0" && $total_departments=="0"){?>
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
    <?php }if($assigned_departments!="0" && $total_departments!="0"){?>
      <center>
        <h2>
          <strong><?php echo $assigned_departments;?></strong>
        </h2>
        <h3>
          <span class="semi-bold">Department<?php if($assigned_departments>1){
            echo "s";
            }?>
            <?php if($assigned_departments>1){
              echo "have";
            }else{
              echo "has";
            }?> not been assigned 
            <?php if($assigned_departments>1){
              echo "";
            }else{
              echo "a";
            }?> course<?php if($assigned_departments>1){
              echo "s";
            }?>
          </span>
        </h3>
        <hr />
        <a class="btn btn-default" href="<?php echo base_url()?>admin/departments">View More</a>
      </center>
    <?php }?>
  </div>
</div>