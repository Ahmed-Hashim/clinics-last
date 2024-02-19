<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['dr_id']) && 
	isset($_POST['appointment_id']) 
	){
		
//data collection
	$dr_id = (int) test_inputs($_POST['dr_id']);
	$appointment_id = (int) test_inputs($_POST['appointment_id']);
	
		$date_time = date('Y-m-d h:i:00');
		
		$q = "UPDATE `clinics_appointments` SET `status` = '1' WHERE ((`appointment_id` = '".$appointment_id."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";

		
			if(mysqli_query($KONN, $q)){
				
				die(lang('Appointment_Activated'));
			
			} else {
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
?>