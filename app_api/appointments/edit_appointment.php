<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['appointment_id']) && 
	isset($_POST['doctor_id']) && 
	isset($_POST['date']) && 
	isset($_POST['hour']) && 
	isset($_POST['minute']) && 
	isset($_POST['duration']) 
	){
		
//data collection
	$patient_id = (int) test_inputs($_POST['patient_id']);
	$appointment_id = (int) test_inputs($_POST['appointment_id']);
	$dr_id = (int) test_inputs($_POST['doctor_id']);
	$date = test_inputs($_POST['date']);
	$hour = (int) test_inputs($_POST['hour']);
	$minute = (int) test_inputs($_POST['minute']);
	$app_duration = (int) test_inputs($_POST['duration']);
	
	
		$date_arr = explode('-', $date);
		$ths_y = $date_arr[0];
		$ths_m = (int) $date_arr[1];
		$ths_d = (int) $date_arr[2];
		
		if($ths_m < 10){$ths_m = '0'.$ths_m;}
		if($ths_d < 10){$ths_d = '0'.$ths_d;}
		
		if($hour < 10){$hour = '0'.$hour;}
		if($minute < 10){$minute = '0'.$minute;}
		
		$app_date = $ths_y.'-'.$ths_m.'-'.$ths_d.' '.$hour.':'.$minute.':00';
				
		//check if new time is blocked
		$q_01 = "SELECT COUNT(block_id) FROM `dr_blocked_times` WHERE ((block_time = '".$app_date."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		$q_01_exe = mysqli_query($KONN, $q_01);
		$block_data = mysqli_fetch_array($q_01_exe);
		$block_count = (int) $block_data[0];
		
		if($block_count > 0){
			//time is blocked
			die('0|'.lang('selected_time_is_blocked'));
		}
		
		//check if new time reserved
		$q_02 = "SELECT COUNT(appointment_id) FROM `clinics_appointments` WHERE ((appointment_id <> '".$appointment_id."') AND (time_date = '".$app_date."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		$q_02_exe = mysqli_query($KONN, $q_02);
		$reserved_data = mysqli_fetch_array($q_02_exe);
		$reserved_count = (int) $reserved_data[0];
		
		if($reserved_count > 0){
			//time is blocked
			die('0|'.lang('selected_time_is_reserved'));
		}
		
		//edit appointment
		
		
		
		
		
		$endTime = date('Y-m-d H:i:s',strtotime('+'.$app_duration.' minutes',strtotime($app_date)));
		
			$q = "UPDATE `clinics_appointments` SET 
				`time_date` = '".$app_date."', 
				`end_time_date` = '".$endTime."', 
				`patient_id` = '".$patient_id."', 
				`dr_id` = '".$dr_id."' 
				WHERE ((appointment_id = '".$appointment_id."') AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Appointment_Updated'));
			
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