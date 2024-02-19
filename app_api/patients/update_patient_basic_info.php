<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['nat_no']) && 
	isset($_POST['file_num']) && 
	isset($_POST['first_name']) && 
	isset($_POST['second_name']) && 
	isset($_POST['third_name']) && 
	isset($_POST['last_name']) && 
	isset($_POST['dob']) && 
	isset($_POST['gender']) && 
	isset($_POST['mobile']) && 
	isset($_POST['landline']) && 
	isset($_POST['email'])  ){
		
//data collection
	$patient_id = (int) test_inputs($_POST['patient_id']);
	$nat_no = test_inputs($_POST['nat_no']);
	$file_num = (int) test_inputs($_POST['file_num']);
	$first_name = test_inputs($_POST['first_name']);
	$second_name = test_inputs($_POST['second_name']);
	$third_name = test_inputs($_POST['third_name']);
	$last_name = test_inputs($_POST['last_name']);
	$dob = test_inputs($_POST['dob']);
	$gender = (int) test_inputs($_POST['gender']);
	$mobile = test_inputs($_POST['mobile']);
	$landline = test_inputs($_POST['landline']);
	$email = test_inputs($_POST['email']);
	$insurance_type = test_inputs($_POST['insurance_type']);
	
	$nationality = 'na';
	if(isset($_POST['nationality'])){
		$nationality = test_inputs($_POST['nationality']);
	}
	
	
	//check if file num is taken or not
	$qr = "SELECT COUNT(`patient_id`) FROM `patients` WHERE ((`patient_id` <> ".$patient_id.") AND (`file_num` = ".$file_num.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
	$qr_e = mysqli_query($KONN, $qr);
	$res_data = mysqli_fetch_array($qr_e);
	$res = (int) $res_data[0];
	
	// die('0|'.$res);
	
	if($res != 0){
		//might be same file
		//check if file num is for same patient or not
		$qrA = "SELECT COUNT(`patient_id`) FROM `patients` WHERE ((`patient_id` = ".$patient_id.") AND (`file_num` = ".$file_num.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		$qr_eA = mysqli_query($KONN, $qrA);
		$res_dataA = mysqli_fetch_array($qr_eA);
		$resA = (int) $res_dataA[0];
		
		if($resA != 1){
			//file num is for other patient
			//reject file num
		$qrB = "SELECT `file_num` FROM `patients` WHERE (`clinic_id` = ".$_SESSION['clinic_id'].") ORDER BY `file_num` DESC LIMIT 1";
		$qr_eB = mysqli_query($KONN, $qrB);
		$res_dataB = mysqli_fetch_array($qr_eB);
		$resB = (int) $res_dataB[0];
		$resB++;
		
		$qrB = "SELECT `file_num` FROM `patients` WHERE (`clinic_id` = ".$_SESSION['clinic_id'].") ORDER BY `file_num` ASC LIMIT 1";
		$qr_eB = mysqli_query($KONN, $qrB);
		$res_dataB = mysqli_fetch_array($qr_eB);
		$resC = (int) $res_dataB[0];
		$resC--;
		
		$res_2 = ',_';
		if($resC != 0){
			$res_2 = ',_min_availble_:_'.$resC.',_max_';
		}
			
			die('0|'.lang('file_number_is_taken_please_change_'.$res_2.'availble_number_:_'.$resB));
		}
		
		
		
		
	} else {
		
			$q = "UPDATE `patients` SET 
			`file_num` = '".$file_num."', 
			`nat_no` = '".$nat_no."', 
			`nationality` = '".$nationality."', 
			`first_name` = '".$first_name."', 
			`second_name` = '".$second_name."', 
			`third_name` = '".$third_name."', 
			`last_name` = '".$last_name."', 
			`dob` = '".$dob."', 
			`gender` = '".$gender."', 
			`mobile` = '".$mobile."', 
			`landline` = '".$landline."', 
			`email` = '".$email."', 
			`insurance_type` = '".$insurance_type."' 
				WHERE ((`patient_id` = ".$patient_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Patient_Updated'));
			
			} else {
				echo mysqli_error($KONN);
				die('0|ERROR no : js94sdds0'.mysqli_error($KONN));
			}
			
			
	}
	
	
	
	


		
		

	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			} else {
				die('0|no sess');
			}
	} else {
			die('0|no sess');	
			}
?>
