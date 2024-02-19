<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['employee_id']) && 
	isset($_POST['basic_salary']) && 
	isset($_POST['clinic_department_id']) && 
	isset($_POST['commission']) ){
		
//data collection
	$employee_id = (int) test_inputs($_POST['employee_id']);
	$basic_salary = test_inputs($_POST['basic_salary']);
	$commission = test_inputs($_POST['commission']);
	$clinic_department_id = test_inputs($_POST['clinic_department_id']);
	
	
		
			$q = "UPDATE `clinics_employees` SET 
			`basic_salary` = '".$basic_salary."', 
			`clinic_department_id` = '".$clinic_department_id."', 
			`commission` = '".$commission."' WHERE ((`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_information_Updated'));
			
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
