<div class="col-lg-12">
 <div class="well primary">
  <h3><span class="semi-bold"><strong>School : </strong> <?php echo $schoolAttached; ?></span></h3>
</div>

<section class="box nobox">
  <div class="content-body">

    <div class="row">
      <div class="col-md-4 col-sm-8 col-xs-12">
        <div class="r4_counter db_box">
          <i class='pull-left fa fa-institution icon-md icon-rounded icon-primary'></i>
          <div class="stats">
            <h4><strong><?php echo $countCourses;?></strong></h4>
            <span>All Courses</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-8 col-xs-12">
        <div class="r4_counter db_box">
          <i class='pull-left fa fa-book icon-md icon-rounded icon-orange'></i>
          <div class="stats">
            <h4><strong><?php echo $countUnits;?></strong></h4>
            <span>My Units</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-8 col-xs-12">
        <div class="r4_counter db_box">
          <i class='pull-left fa fa-book  icon-md icon-rounded icon-purple'></i>
          <div class="stats">
            <h4><strong><?php echo $countResults;?></strong></h4>
            <span>Uploaded Results</span>
          </div>
        </div>
      </div>

    </div> <!-- End .row --> 


  </div>
</section>

</div>



<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
 <div class="well transparent">
   <?php if ($countResults=="0"){?>
    <center>
      <h2>
       <i class="icon-lg fa fa-meh-o"></i>
     </h2>
     <h3>
       You have not yet uploaded any results
     </h3>
   </center>
 <?php }else{?>
   <center>
    <h2>
     <strong><?php echo $countResults;?></strong>
   </h2>
   <hr />
   <h3>
     Uploaded Results
   </h3>
   <hr />
   <a class="btn btn-primary" href="<?php echo base_url()?>lecturer/results">View More</a>
 </center>
<?php }?>
</div>

</div>


<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
 <div class="well well">
  <h3><span class="semi-bold">Latest Uploaded Results:</span></h3>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Units</th>
        <th>Mean Score</th>
        <th>Average grade</th>
      </tr>
    </thead>
    <tbody>
     <?php

     $r=1;
     foreach($resultsQuery as $row):
       $unit_name=$row['unit_name'];
       $unit_code=$row['unit_code'];
       $result_code=$row['result_code'];
       $grade=$row['grade'];
													//$adm_no       =	$this->db->get_where('login' , array('name'=>$student_name))->row()->username;
       $where=array("lecturer_id"=>$lecturer_id,"result_code"=>$result_code);
       $this->db->select_sum('total_marks');
       $this->db->from('results');
       $this->db->where($where);
       $desc=$this->db->get()->result_array();
       $final_total=0;
       foreach($desc as $row):
        $final_total+=$row['total_marks'];
      endforeach;

      $where=array("lecturer_id"=>$lecturer_id,"result_code"=>$result_code);
      $this->db->select('*');
      $this->db->from('results');
      $this->db->where($where);
      $count_result	=	$this->db->count_all_results();

													//get average total
      $ave_total=$final_total/$count_result;

													//get average grade
      $round_ave_total=round($ave_total);
													//get average grade
      $where="".$round_ave_total." BETWEEN start_mark AND end_mark";
      $this->db->select('grade');
      $this->db->from('grades');
      $this->db->where($where);
      $desc	=	$this->db->get()->result_array();
      foreach($desc as $row):
       $ave_grade= $row['grade'];
     endforeach;
     ?>
     <tr>
      <th scope="row"><?php echo $r++;?></th>
      <td><?php echo $unit_name;?> (<?php echo $unit_code; ?>)</td>
      <td class="text-center"><?php echo $round_ave_total;?></td>
      <td class="text-center"><?php echo $ave_grade;?></td>
    </tr>
  <?php endforeach;?>
</tbody>
</table>


</div>


</div>