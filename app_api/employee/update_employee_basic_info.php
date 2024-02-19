<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['employee_id']) && 
	isset($_POST['first_name']) && 
	isset($_POST['second_name']) && 
	isset($_POST['third_name']) && 
	isset($_POST['last_name']) && 
	isset($_POST['dob']) && 
	isset($_POST['martial_status']) && 
	isset($_POST['nationality']) && 
	isset($_POST['join_date']) && 
	isset($_POST['certification']) && 
	isset($_POST['graduation_date']) && 
	isset($_POST['duty_start']) && 
	isset($_POST['duty_end']) && 
	isset($_POST['is_dr']) && 
	isset($_POST['gender']) ){
		
//data collection
	$employee_id = (int) test_inputs($_POST['employee_id']);
	$first_name = test_inputs($_POST['first_name']);
	$second_name = test_inputs($_POST['second_name']);
	$third_name = test_inputs($_POST['third_name']);
	$last_name = test_inputs($_POST['last_name']);
	$dob = test_inputs($_POST['dob']);
	$martial_status = (int) test_inputs($_POST['martial_status']);
	$gender = (int) test_inputs($_POST['gender']);
	
	$nationality = test_inputs($_POST['nationality']);
	$join_date = test_inputs($_POST['join_date']);
	$certification = test_inputs($_POST['certification']);
	$graduation_date = test_inputs($_POST['graduation_date']);
	$duty_start = test_inputs($_POST['duty_start']);
	$duty_end = test_inputs($_POST['duty_end']);
	$is_dr     = test_inputs($_POST['is_dr']);
	
	
		
			$q = "UPDATE `clinics_employees` SET 
			`first_name` = '".$first_name."', 
			`second_name` = '".$second_name."', 
			`third_name` = '".$third_name."', 
			`last_name` = '".$last_name."', 
			`dob` = '".$dob."', 
			`martial_status` = '".$martial_status."', 
			`nationality` = '".$nationality."', 
			`join_date` = '".$join_date."', 
			`certification` = '".$certification."', 
			`graduation_date` = '".$graduation_date."', 
			`duty_start` = '".$duty_start."', 
			`duty_end` = '".$duty_end."', 
			`is_dr` = '".$is_dr."', 
			`gender` = '".$gender."' WHERE ((`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_Updated'));
			
			} else {
				echo mysqli_error($KONN);
				die('0|ERROR no : js94sdds0');
			}
	


		
		

	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>
