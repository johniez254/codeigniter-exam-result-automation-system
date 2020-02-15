<?php
$user_id= $this->session->userdata('id');
$role=$this->db->get_where('login' , array('login_id'=>$user_id))->row()->role;

if($role=="admin"){
?>

<div id="chartContainer"></div>

<?php
	//$tp="employee_from=".$employee_id."";
	$this->db->select('*');
	$this->db->from('lecturers');
	//$this->db->where($tp);
	$count_lec	=	$this->db->count_all_results();
?>

<script type="text/javascript">
$(function () {CanvasJS.addColorSet("ColourShades",
                [//colorSet Array
 
                "#9972b5", //purple 
				"#1fb5ac",//green
				"#fa8564", //orange 
				"#ffcc00", //yellow 
				"#e74c3c",//red colour           
                ]);
        var chart = new CanvasJS.Chart("lecturers_school_piechart", {
			colorSet: "ColourShades",
            theme: "light2",
            title: {
				<?php if($count_lec=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: "Lectures per School"
				<?php }?>
            },
            exportFileName: "Pie Chart",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                verticalAlign: "bottom",
                horizontalAlign: "center"
            },
            data: [
            {
                type: "pie",
                showInLegend: true,
                toolTipContent: "{legendText}: <strong>{y} Lecturers</strong>",
                indexLabel: "{label} {y} Lecturers",
                dataPoints: [
				<?php
					$this->db->select('*');
					$this->db->from('lecturers');
					//$this->db->select_sum('days_assigned');
					$this->db->group_by('assigned_school');
					//$this->db->order_by('course_id', 'desc');
					//$this->db->limit('5');
					//$this->db->join('schools', 'schools.school_id = courses.school_id');
					$desc=$this->db->get()->result_array();
					foreach($desc as $row):
					
					$l_s_n       =	$this->db->get_where('schools' , array('school_id'=>$row['assigned_school']))->row()->school_name;
					
					$tp="assigned_school=".$row['assigned_school']."";
					$this->db->select('*');
					$this->db->from('lecturers');
					$this->db->where($tp);
					$l_count_c	=	$this->db->count_all_results();
					
					
				?>
                    { y: <?php echo $l_count_c;?>, legendText: "<?php echo $l_s_n;?>", label: "<?php echo $l_s_n;?>" },
					
				<?php endforeach;?>
                ]
            }
            ]
        });
        chart.render();
    });
</script>
<?php
	//$tp="employee_from=".$employee_id."";
	$this->db->select('*');
	$this->db->from('courses');
	//$this->db->where($tp);
	$count_courses	=	$this->db->count_all_results();
?>

<script type="text/javascript">


    $(function () {CanvasJS.addColorSet("ColourShades",
                [//colorSet Array
 
                "#9972b5", //purple 
				"#1fb5ac",//green
				"#fa8564", //orange 
				"#ffcc00", //yellow 
				"#e74c3c",//red colour           
                ]);
        var chart2 = new CanvasJS.Chart("school_course_bar_chart", {
			colorSet: "ColourShades",
            theme: "light2",
            animationEnabled: true,
            title: {
				<?php if($count_courses=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: "Bar Chart Showing Total Courses per School"
				<?php }?>
            },
            exportFileName: "school/total_courses bar chart",
            exportEnabled: true,
            axisY: {
                title: "Total Courses",
                reversed: false,
            },
            toolTip: {
                shared: true,
                content: "<span style='\"'color: {color};'\"'>{label}</span> : {y} Courses"
            },
            data: [
            {
                type: "column",
                dataPoints: [
				<?php
					$this->db->select('*');
					$this->db->from('courses');
					//$this->db->select_sum('days_assigned');
					$this->db->group_by('school_id');
					$this->db->order_by('course_id', 'desc');
					//$this->db->limit('5');
					//$this->db->join('schools', 'schools.school_id = courses.school_id');
					$desc=$this->db->get()->result_array();
					foreach($desc as $row):
					
					$s_n       =	$this->db->get_where('schools' , array('school_id'=>$row['school_id']))->row()->school_name;
					
					$tp="school_id=".$row['school_id']."";
					$this->db->select('*');
					$this->db->from('courses');
					$this->db->where($tp);
					$count_c	=	$this->db->count_all_results();
					
					
				?>
                    { y: <?php echo $count_c;?>, label: "<?php echo $s_n;?>" },
					
				<?php endforeach;?>
                ]
            }
            ]
        });
        chart2.render();
    });
</script>
<?php
	//$tp="employee_from=".$employee_id."";
	$this->db->select('*');
	$this->db->from('schools');
	//$this->db->where($tp);
	$count_stud	=	$this->db->count_all_results();
?>

<script type="text/javascript">
$(function () {CanvasJS.addColorSet("ColourShades",
                [//colorSet Array
 
                "#9972b5", //purple 
				"#1fb5ac",//green
				"#fa8564", //orange 
				"#ffcc00", //yellow 
				"#e74c3c",//red colour           
                ]);
        var chart3 = new CanvasJS.Chart("student_school_piechart", {
			colorSet: "ColourShades",
            theme: "light2",
            title: {
				<?php if($count_stud=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: "Students per School"
				<?php }?>
            },
            exportFileName: "Pie Chart",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                verticalAlign: "bottom",
                horizontalAlign: "center"
            },
            data: [
            {
                type: "pie",
                showInLegend: true,
                toolTipContent: "{legendText}: <strong>{y} Students</strong>",
                indexLabel: "{label} {y} Students",
                dataPoints: [
				<?php
					$this->db->select('*');
					$this->db->from('students');
					//$this->db->select_sum('days_assigned');
					$this->db->group_by('assigned_school');
					//$this->db->order_by('course_id', 'desc');
					//$this->db->limit('5');
					//$this->db->join('schools', 'schools.school_id = courses.school_id');
					$desc=$this->db->get()->result_array();
					foreach($desc as $row):
					
					$s_s_n       =	$this->db->get_where('schools' , array('school_id'=>$row['assigned_school']))->row()->school_name;
					
					$tp="assigned_school=".$row['assigned_school']."";
					$this->db->select('*');
					$this->db->from('students');
					$this->db->where($tp);
					$s_count_c	=	$this->db->count_all_results();
					
					
				?>
                    { y: <?php echo $s_count_c;?>, legendText: "<?php echo $s_s_n;?>", label: "<?php echo $s_s_n;?>" },
					
				<?php endforeach;?>
                ]
            }
            ]
        });
        chart3.render();
    });
</script>

<?php }

//------------------------------------------------------------------------------------------------------------------------------

if($role=="lecturer"){
	if(isset($_GET['s2example-7']) && isset($_GET['s2example-8']) && isset($_GET['s2example-6'])){
	if($_GET['s2example-7']!=null && $_GET['s2example-8']!=null && $_GET['s2example-6']!=null){
		
	$course=$_GET['s2example-7'];
	$unit=$_GET['s2example-8'];
	$ac_year=$_GET['s2example-6'];
		
		$cs=array('course_id'=>$course,'unit_id'=>$unit,'semester_id'=>$ac_year);
		$this->db->select('*');
		$this->db->from('results');
		$this->db->where($cs);
		$check_data	=	$this->db->count_all_results();
	
	if($check_data!='0'){
	$q = $this->db->query("select * from results where course_id = ".$course." and unit_id=".$unit." and semester_id=".$ac_year."");
	foreach ($q->result() as $row){
		$unit_id=$row->unit_id;
	}
	
	$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course))->row()->course_name;
	$unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
	$unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
	$sem_year       =	$this->db->get_where('semesters' , array('semester_id'=>$ac_year))->row()->semester_year;
	$sem       =	$this->db->get_where('semesters' , array('semester_id'=>$ac_year))->row()->semester_name;
?>

<script type="text/javascript">


													$(function () {
														CanvasJS.addColorSet("ColourShades",
																[//colorSet Array
												 
																"#9972b5", //purple 
																"#1fb5ac",//green
																"#fa8564", //orange 
																"#ffcc00", //yellow 
																"#e74c3c",//red colour           
																]);
														var chart = new CanvasJS.Chart("students_column_report", {
															colorSet: "ColourShades",
															theme: "light2",
															animationEnabled: true,
															title: {
																text: "Student's Result Bar Chart Report"
															}, subtitles: [
															{
																text: "COURSE: <?php echo $course_name; ?>, UNIT: <?php echo $unit_name;?> (<?php echo $unit_code;?>), YEAR: <?php echo $sem_year;?>, SEMESTER: <?php echo $sem;?>"
															}
														],

															exportFileName: "<?php echo $course_name;?>",
															exportEnabled: true,
															axisY: {
																title: "Total Students",
																reversed: false,
																//valueFormatString: "#0.##",
															},
															toolTip: {
																shared: true,
																content: "<span style='\"'color: {color};'\"'>{label}</span> : {y} Students"
															},
															data: [
															{
																type: "column",
																dataPoints: [
																	<?php
																	$query = $this->db->query("select * from results where course_id = ".$course." and unit_id=".$unit." and semester_id=".$ac_year." group by grade");
																	foreach ($query->result() as $row){
																	$grade=$row->grade;
																	
																	$cs=array('lecturer_id'=>$lecturer_id,'grade'=>$grade,'unit_id'=>$unit);
																	$this->db->select('*');
																	$this->db->from('results');
																	$this->db->where($cs);
																	//$this->db->group_by('grade');
																	$count_bar_students	=	$this->db->count_all_results();
																	?>
																	{ y:<?php echo $count_bar_students;?>,label: "Grade <?php echo $grade;?>" },
																	
																	<?php }?>
																							
																]
															}
															]
														});
														chart.render();
													});
												</script>
        

<?php
	}//check data
	}//not null
	}//isset value
}//end lecturer =-----------------------------------------------------------------------------------------------------------
?>

<?php

//------------------------------------------------------------------------------------------------------------------------------

if($role=="student"){
?>

<?php }?>