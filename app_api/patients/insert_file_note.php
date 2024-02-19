<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && isset($_POST['note_content']) ){
	$patient_id = 0;
	
	$patient_id = (int) test_inputs($_POST['patient_id']);
	$note_content = test_inputs($_POST['note_content']);
	
	
	$added_date = date('Y-m-d h:i:00');
	
	$added_by = $_SESSION['employee_name'];
	
	//insert transfer patient data
	$q = "INSERT INTO `patients_notes` (
		`patient_id`, 
		`note_content`, 
		`added_date`, 
		`added_by`, 
		`clinic_id`
		) VALUES (
		'$patient_id', 
		'$note_content', 
		'$added_date', 
		'$added_by', 
		'".$_SESSION['clinic_id']."'
		);";
		
	
	if(mysqli_query($KONN, $q)){
			die('1|'.lang('patient_note_added'));
	
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