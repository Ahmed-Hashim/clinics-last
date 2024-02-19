<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['dose']) && 
	isset($_POST['medication_id'])
	){
	$patient_id = 0;
	
	$patient_id = (int) test_inputs($_POST['patient_id']);
	$medication_id = (int) test_inputs($_POST['medication_id']);
	$dose = ( double ) test_inputs($_POST['dose']);
	$medication_name = '';
	$dr_id =  $_SESSION['employee_id'];
	
	$date_time = date('Y-m-d h:i:00');
	
	$registerer = $_SESSION['employee_id'];
	
//-------------------- INSERT medication FINANCIALS DETAILS AS WELL AS QTY ----------------------------------//
	

$Q1 = "SELECT `medication_name`, `qty` FROM `clinics_medications` WHERE ( (`medication_id` = ".$medication_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$proc_db = mysqli_fetch_array($QEXE1);
$medication_name = $proc_db[0];
$oldQty = ( double ) $proc_db[1];

	$q = "INSERT INTO `patients_medications` (
		`patient_id`, 
		`medication_id`, 
		`medication_name`, 
		`dose`, 
		`dr_id`, 
		`date_time`, 
		`registerer`, 
		`clinic_id`
		) VALUES (
		'$patient_id', 
		'$medication_id', 
		'$medication_name', 
		'$dose', 
		'$dr_id', 
		'$date_time', 
		'$registerer',  
		'".$_SESSION['clinic_id']."'
		);";
	
	if(mysqli_query($KONN, $q)){
		
		$nwQty = $oldQty - $dose;
		
$Q2 = "UPDATE `clinics_medications` SET `qty` = '$nwQty' WHERE ( (`medication_id` = ".$medication_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
if(mysqli_query($KONN, $Q2)){
		die('1|'.lang('Selected_medication_Inserted'));
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