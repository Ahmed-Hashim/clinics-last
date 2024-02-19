<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['pat_file_num']) && 
	isset($_POST['op']) 
	){
		
	$patient_id = 0;
//data collection

	// $profile_pic = isset($_FILES['profile_pic']) ? $_FILES['profile_pic'] : false;
	
	$file_num = (int) test_inputs($_POST['pat_file_num']);
	$op = test_inputs($_POST['op']);
	
	if($op == 1){
		
		$q = "SELECT patient_id, CONCAT(`first_name`, ' ',`last_name`) AS pat_name FROM `patients` WHERE ( ( `file_num` = '".$file_num."' ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) LIMIT 1";
		$q_exe = mysqli_query($KONN, $q);
		
		if(mysqli_num_rows($q_exe) == 1){
			$pat_data = mysqli_fetch_assoc($q_exe);
			$patient_id = $pat_data['patient_id'];
			$pat_name = $pat_data['pat_name'];
			die($patient_id.'|'.$pat_name);
			
		} else {
			die('0|'.lang('no_records_found'));
		}

		
		
		
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