<?php
	$PAGE_TITLE = 'My site CP';
	$PG_title = 'My site CP';
	$PG_desc = 'desc';
	$PG_keywords = 'keywords';
	$PG_author = 'author';
	$pager = 1;
	$sub_page = 1;
	$has_sub = true;
	$has_slider = false;
session_start();
$no_session = true;
$main_pointer = '../../';
	require_once('../../bootstrap/app_config.php');
	
	
	
	
	
	
if( isset($_POST['clinic_name']) ){

	$clinic_id = 0;
	$clinic_name = test_inputs($_POST['clinic_name']);
	
	
	$qu_clinics_ins = "INSERT INTO `clinics` (
						`clinic_name`, 
						`system_account_id`
					) VALUES (
						'".$clinic_name."', 
						'0'
					);";

	if(mysqli_query($KONN, $qu_clinics_ins)){
		$clinic_id = mysqli_insert_id($KONN);
		if( $clinic_id != 0 ){
			
			
			
			
$q2 = "
INSERT INTO `clinics_departments` (`clinic_department_name`, `clinic_id`) VALUES ('general', '$clinic_id')
";
if(mysqli_query($KONN, $q2)){
	$department_id = mysqli_insert_id($KONN);
	if( $department_id != 0 ){
		
		$qu_clinics_employees_ins = "INSERT INTO `clinics_employees` (
							`title`, 
							`first_name`, 
							`second_name`, 
							`third_name`, 
							`last_name`, 
							`dob`, 
							`gender`, 
							`martial_status`, 
							`nationality`, 
							`join_date`, 
							`certification`, 
							`graduation_date`, 
							`clinic_department_id`, 
							`basic_salary`, 
							`commission`, 
							`duty_start`, 
							`duty_end`, 
							`profile_pic`, 
							`is_dr`, 
							`is_admin`, 
							`clinic_id` 
						) VALUES (
							'mr', 
							'employee', 
							'start', 
							'start', 
							'startup', 
							'1995-10-22', 
							'1', 
							'0', 
							'NA', 
							'2002-08-20', 
							'NA',
							'2002-08-20', 
							'".$department_id."', 
							'0', 
							'0', 
							'9', 
							'18', 
							'profile.png', 
							'1', 
							'1', 
							'".$clinic_id."' 
						);";

		if(mysqli_query($KONN, $qu_clinics_employees_ins)){
			$employee_id = mysqli_insert_id($KONN);
			if( $employee_id != 0 ){
				
				$qu_employees_sys_cred_ins = "INSERT INTO `employees_sys_cred` (
									`username`, 
									`password`, 
									`emp_level`, 
									`employee_id`, 
									`reg`, 
									`department_id`, 
									`clinic_id` 
								) VALUES (
									'clin_$clinic_id', 
									'123456', 
									'2', 
									'".$employee_id."', 
									'".date('Y-m-d H:i:00')."', 
									'".$department_id."', 
									'".$clinic_id."' 
								);";

				if(mysqli_query($KONN, $qu_employees_sys_cred_ins)){
					$record_id = mysqli_insert_id($KONN);
					if( $record_id != 0 ){
						
					}
				} else {
					die('345542'.mysqli_error($KONN));
				}
				
				
				
			}
		} else {
			die('657575'.mysqli_error($KONN));
		}
			
		
	} else {
		die('455'.mysqli_error($KONN));
	}
		
	
	
} else {
	die('222'.mysqli_error($KONN));
}

							
				$qu_clinics_duty_ins = "INSERT INTO `clinics_duty` (`open_hour`, `close_hour`, `week_day`, `week_day_name`, `is_onduty`, `clinic_id`) VALUES
                                                ( 9, 21, 1, 'Saturday', 1, ".$clinic_id."),
                                                ( 9, 21, 2, 'Sunday', 1, ".$clinic_id."),
                                                ( 9, 21, 3, 'Monday', 1, ".$clinic_id."),
                                                ( 9, 21, 4, 'Tuesday', 1, ".$clinic_id."),
                                                ( 9, 21, 5, 'Wednesday', 1, ".$clinic_id."),
                                                ( 9, 21, 6, 'Thursday', 1, ".$clinic_id."),
                                                ( 9, 21, 7, 'Friday', 0, ".$clinic_id.");";

				if(!mysqli_query($KONN, $qu_clinics_duty_ins)){
					die('34555552'.mysqli_error($KONN));
				}
				
			header("location:index.php?added=".$clinic_id);
		}
	}

}

	
	
	
	
	
	
	
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<?php
	include('app/includes.php');
?>
</head>
<body id="bodyer">
<?php
	include('app/header.php');
	//PAGE DATA START
	//-----------------------------
?>
	<form id="page_form" method="post" enctype="multipart/form-data">
	
	<h1 class="main-page-title">Add New Clinic</h1>
	
	<section class="page-btns-holder">
		<button class="page-btn" onclick="$('#page_form').submit();" type="submit">Add</button>
		<a href="page_clinics.php"><button class="page-btn" type="button" style="background:red;">Cancel</button></a>
	</section>
	
	<section class="page-content">
	

	
	
	
	

	<div class="row">
		<div class="col-1">
			<div class="form-item">
				<label>Clinic Name</label>
				<input type="text" name="clinic_name" id="clinic_name" value="" required />
			</div>
		</div>
	</div>
	
	
	
	
	
	
		
	</section>
	<section id="form_footer" class="page-btns-holder"></section>
	<script>$('#form_footer').html($('.page-btns-holder').html());</script>
	<br><br><br>
	</form>
	
<?php
	//-----------------------------
	//PAGE DATA END
	include('app/footer.php');
?>
</body>
</html>