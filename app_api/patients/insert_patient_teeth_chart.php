<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['teeth_no']) && 
	isset($_POST['proc_id']) && 
	isset($_POST['dr_id']) && 
	isset($_POST['note'])
	){
	$patient_id = 0;
	
	$patient_id = test_inputs($_POST['patient_id']);
	$teeth_no = test_inputs($_POST['teeth_no']);
	$proc_id = test_inputs($_POST['proc_id']);
	$procedure_name = '';
	$dr_id = test_inputs($_POST['dr_id']);
	$note = test_inputs($_POST['note']);
	
	$date_time = date('Y-m-d h:i:00');
	
	$registerer = $_SESSION['employee_id'];
	
//------------------------ INSERT PROCEDURE FINANCIALS DETAILS -----------------------------------------------//
	

$Q1 = "SELECT procedure_name FROM `clinics_procedures` WHERE ( (`procedure_id` = ".$proc_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$proc_db = mysqli_fetch_array($QEXE1);
$procedure_name = $proc_db[0];


	$q = "INSERT INTO `patients_teeth_proc` (
		`patient_id`, 
		`teeth_no`, 
		`proc_id`, 
		`procedure_name`, 
		`dr_id`, 
		`note`, 
		`date_time`, 
		`registerer`, 
		`clinic_id`
		) VALUES (
		'$patient_id', 
		'$teeth_no', 
		'$proc_id', 
		'$procedure_name', 
		'$dr_id', 
		'$note', 
		'$date_time', 
		'$registerer',  
		'".$_SESSION['clinic_id']."'
		);";

	if(mysqli_query($KONN, $q)){

		// *************Tawfiq passed by here****************
		
		$Q1 = "SELECT * FROM `clinics_procedures` WHERE ( (`procedure_id` = ".$proc_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		$QEXE2 = mysqli_query($KONN, $Q1);
		$proc_db = mysqli_fetch_assoc($QEXE2);
		$procedure_name = $proc_db['procedure_name'];
		$procedure_price = $proc_db['price'];

		$q = "INSERT INTO `patients_procedures` (
		`procedure_name`, 
		`qty`, 
		`price`, 
		`note`, 
		`date_time`, 
		`dr_id`, 
		`patient_id`, 
		`clinic_id`
		) VALUES (
		'$procedure_name', 
		'1', 
		'$procedure_price', 
		'$note', 
		'$date_time', 
		'$dr_id', 
		'$patient_id', 
		'".$_SESSION['clinic_id']."'
		);";

		//. *************Tawfiq passed by here****************

		if(mysqli_query($KONN, $q)){// *************Tawfiq passed by here****************
			die('1|'.lang('Selected_Procedure_Inserted'));
		}// *************Tawfiq passed by here****************
	
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