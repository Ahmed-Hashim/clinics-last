<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['first_name']) && 
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
	isset($_POST['gender']) ){
		
//data collection
	$employee_id = 0;
	$first_name = test_inputs($_POST['first_name']);
	$second_name = test_inputs($_POST['second_name']);
	$third_name = test_inputs($_POST['third_name']);
	$last_name = test_inputs($_POST['last_name']);
	$dob = test_inputs($_POST['dob']);
	$martial_status = (int) test_inputs($_POST['martial_status']);
	$gender = (int) test_inputs($_POST['gender']);
	$is_dr = (int) test_inputs($_POST['is_dr']);
	$clinic_department_id = (int) test_inputs($_POST['clinic_department_id']);
	
	$nationality = test_inputs($_POST['nationality']);
	$join_date = test_inputs($_POST['join_date']);
	$certification = test_inputs($_POST['certification']);
	$graduation_date = test_inputs($_POST['graduation_date']);
	$duty_start = test_inputs($_POST['duty_start']);
	$duty_end = test_inputs($_POST['duty_end']);
	// *************Tawfiq passed by here****************
	$title = $is_dr == 1 ? 'Dr' : 'mr';
	//. *************Tawfiq passed by here****************

	// *************Tawfiq passed by here (add title to array)****************
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
						`duty_start`, 
						`duty_end`, 
						`is_dr`, 
						`clinic_id` 
					) VALUES (
						'".$title."', 
						'".$first_name."', 
						'".$second_name."', 
						'".$third_name."', 
						'".$last_name."', 
						'".$dob."', 
						'".$gender."', 
						'".$martial_status."', 
						'".$nationality."', 
						'".$join_date."', 
						'".$certification."', 
						'".$graduation_date."', 
						'".$clinic_department_id."', 
						'".$duty_start."', 
						'".$duty_end."', 
						'".$is_dr."', 
						'".$_SESSION['clinic_id']."' 
					);";
					
			if(mysqli_query($KONN, $qu_clinics_employees_ins)){
				
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
