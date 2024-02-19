<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) && 
	isset($_POST['note']) && 
	isset($_POST['payment_type']) && 
	isset($_POST['payment_amount'])
	){
	$patient_id = 0;
	
	$patient_id = (int) test_inputs($_POST['patient_id']);
	
	
	$note = test_inputs($_POST['note']);
	$payment_amount =  test_inputs($_POST['payment_amount']);
	$payment_type    =  test_inputs($_POST['payment_type']);
	$reciepent =  $_SESSION['employee_id'];
	
	$date_time = date('Y-m-d h:i:00');
	
	
	// **********************
	// *************Tawfiq passed by here****************
$Q13 = "SELECT * FROM `patients_procedures` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";

$QEXE13 = mysqli_query($KONN, $Q13);

$totla_dbPay = 0;
foreach ($QEXE13 as $key => $pat) {

	
	$totla_price =  ($pat['price'] * $pat['qty']);

}
$remaining_amount = 0;
$Q17 = "SELECT * FROM `patients_payments` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) )";
		$QEXE17 = mysqli_query($KONN, $Q17);
		$total_patient_pay = 0;
		foreach($QEXE17 as $key => $pay){
			$total_patient_pay = $total_patient_pay + $pay['payment_amount'];
		}

		$remaining_amount = ($totla_price - $total_patient_pay) - $payment_amount;
			//. *************Tawfiq passed by here****************


	$q = "INSERT INTO `patients_payments` (
		`payment_amount`, 
		`payment_type`, 
		`note`, 
		`date_time`, 
		`reciepent`, 
		`patient_id`,
		`remaining_amount`,
		`clinic_id`
		) VALUES (
		'$payment_amount', 
		'$payment_type', 
		'$note', 
		'$date_time', 
		'$reciepent', 
		'$patient_id',
		'$remaining_amount',
		'".$_SESSION['clinic_id']."'
		);";
	
	if(mysqli_query($KONN, $q)){
		
		die('1|'.lang('Payment_Inserted'));
	
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
