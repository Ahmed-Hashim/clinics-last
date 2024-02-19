<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['note']) && 
	isset($_POST['lab_exam_id'])
	){
	$patient_id = 0;
	
	$patient_id = (int) test_inputs($_POST['patient_id']);
	$lab_exam_id = (int) test_inputs($_POST['lab_exam_id']);
	
	$note = test_inputs($_POST['note']);
	$lab_exam_name = '';
	$dr_id =  $_SESSION['employee_id'];
	
	$date_time = date('Y-m-d h:i:00');
	
	$registerer = $_SESSION['employee_id'];
	
//-------------------- INSERT lab_exam FINANCIALS DETAILS AS WELL AS QTY ----------------------------------//
	

$Q1 = "SELECT * FROM `clinics_labs_exams` WHERE ( (`lab_exam_id` = ".$lab_exam_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$proc_db = mysqli_fetch_assoc($QEXE1);
$lab_exam_name = $proc_db['lab_exam_name'];
$lab_exam_price = $proc_db['cost'];




	$q = "INSERT INTO `patients_lab_exams` (
		`lab_exam_name`, 
		`price`, 
		`note`, 
		`date_time`, 
		`dr_id`, 
		`patient_id`, 
		`clinic_id`
		) VALUES (
		'$lab_exam_name', 
		'$lab_exam_price', 
		'$note', 
		'$date_time', 
		'$dr_id', 
		'$patient_id', 
		'".$_SESSION['clinic_id']."'
		);";
	
	if(mysqli_query($KONN, $q)){
		
		die('1|'.lang('Selected_lab_exam_Inserted'));
	
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