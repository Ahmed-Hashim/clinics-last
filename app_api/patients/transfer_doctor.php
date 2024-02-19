<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['old_dr']) && 
	isset($_POST['new_dr']) && 
	isset($_POST['transfer_note'])
	){
	$patient_id = 0;
	
	$patient_id = test_inputs($_POST['patient_id']);
	$old_dr = test_inputs($_POST['old_dr']);
	$new_dr = test_inputs($_POST['new_dr']);
	$transfer_note = test_inputs($_POST['transfer_note']);
	
	
	$transfer_date = date('Y-m-d h:i:00');
	
	$transferer = $_SESSION['employee_id'];
	
	//insert transfer patient data
	$q = "INSERT INTO `patients_doctors_transfers` (
		`patient_id`, 
		`old_dr`, 
		`new_dr`, 
		`transfer_note`, 
		`transfer_date`, 
		`transferer`, 
		`clinic_id`
		) VALUES (
		'$patient_id', 
		'$old_dr', 
		'$new_dr', 
		'$transfer_note', 
		'$transfer_date', 
		'$transferer', 
		'".$_SESSION['clinic_id']."'
		);";
		
	
	if(mysqli_query($KONN, $q)){
		
		$qRR = "UPDATE `patients` SET 
		`dr_id` = '".$new_dr."' WHERE ((`patient_id` = ".$patient_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		
		if(mysqli_query($KONN, $qRR)){
			
			die('1|'.lang('patient_transfered'));
		
		} else {
			echo mysqli_error($KONN);
			die('0|ERROR no : js94sdds0');
		}
		
	
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