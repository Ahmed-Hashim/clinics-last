<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['qty']) && 
	isset($_POST['procedure_id'])
	){
	$patient_id = 0;
	
	$patient_id = (int) test_inputs($_POST['patient_id']);
	$procedure_id = (int) test_inputs($_POST['procedure_id']);
	$qty = test_inputs($_POST['qty']);
	$note = test_inputs($_POST['note']);
	$procedure_name = '';
	$dr_id =  $_SESSION['employee_id'];
	
	$date_time = date('Y-m-d h:i:00');
	
	$registerer = $_SESSION['employee_id'];
	
//-------------------- INSERT procedure FINANCIALS DETAILS AS WELL AS QTY ----------------------------------//
	

$Q1 = "SELECT * FROM `clinics_procedures` WHERE ( (`procedure_id` = ".$procedure_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$proc_db = mysqli_fetch_assoc($QEXE1);
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
		'$qty', 
		'$procedure_price', 
		'$note', 
		'$date_time', 
		'$dr_id', 
		'$patient_id', 
		'".$_SESSION['clinic_id']."'
		);";
	
	if(mysqli_query($KONN, $q)){

		// *************Tawfiq passed by here****************
			$clinicsProceduresAssembly = "SELECT * FROM `clinics_procedures_assembly` WHERE ( (`procedure_id` = ".$procedure_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
			$assemblyQEXE = mysqli_query($KONN, $clinicsProceduresAssembly);

			foreach ($assemblyQEXE as $key => $value) {

				if ($value['typo'] == 'inventory') {

					$clinicItem = "SELECT * FROM `clinics_items` WHERE ( (`item_id` = ".$value['part_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
					$clinicItemKonn = mysqli_query($KONN, $clinicItem);
					$clinicItemData = mysqli_fetch_assoc($clinicItemKonn);
					
					$part_qty = $clinicItemData['qty'] - $value['part_qty'] * $qty;
					if (isset($clinicItemData)) {
						$Q11 = "UPDATE `clinics_items` SET `qty` = '$part_qty' WHERE ( (`item_id` = ".$clinicItemData['item_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		    			$QEXE11 = mysqli_query($KONN, $Q11);
						

					}

				}elseif($value['typo'] == 'medications'){

					$clinicItem = "SELECT * FROM `clinics_medications` WHERE ( (`medication_id` = ".$value['part_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
					$clinicItemKonn = mysqli_query($KONN, $clinicItem);
					$clinicItemData = mysqli_fetch_assoc($clinicItemKonn);
					
					$part_qty = $clinicItemData['qty'] - $value['part_qty'] * $qty;
					if (isset($clinicItemData)) {
						$Q11 = "UPDATE `clinics_medications` SET `qty` = '$part_qty' WHERE ( (`medication_id` = ".$clinicItemData['medication_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		    			$QEXE11 = mysqli_query($KONN, $Q11);
						

					}

				}
				


			}
			
		// *************.Tawfiq passed by here****************
		
		die('1|'.lang('Selected_procedure_Inserted'));
	
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