<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['clinic_id']) && 
	isset($_POST['clinic_duty_id']) && 
	isset($_POST['open_hour']) && 
	isset($_POST['close_hour']) && 
	isset($_POST['is_onduty']) ){
		
//data collection
	$clinic_id = (int) test_inputs($_POST['clinic_id']);
	$clinic_duty_id = $_POST['clinic_duty_id'];
	$open_hour = $_POST['open_hour'];
	$close_hour = $_POST['close_hour'];
	$is_onduty = $_POST['is_onduty'];
	
	
	
	for($zz=0;$zz<count($clinic_duty_id);$zz++){
		
			$q = "UPDATE `clinics_duty` SET 
			`open_hour` = '".$open_hour[$zz]."', 
			`close_hour` = '".$close_hour[$zz]."', 
			`is_onduty` = '".$is_onduty[$zz]."' 
				WHERE ((`clinic_duty_id` = ".$clinic_duty_id[$zz].") AND (`clinic_id` = ".$clinic_id."))";
			
			if(!mysqli_query($KONN, $q)){
				echo mysqli_error($KONN);
					die('0|ERROR no : js94sdds0');
			}
			
	}
		
		

				die('1|'.lang('CLinic_Duty_Updated'));
	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>
?>