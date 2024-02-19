<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['lab_id']) && 
	isset($_POST['lab_name']) && 
	isset($_POST['mobile']) && 
	isset($_POST['landline']) && 
	isset($_POST['email'])  ){
		
//data collection
	$lab_id = test_inputs($_POST['lab_id']);
	$lab_name = test_inputs($_POST['lab_name']);
	
	$mobile = test_inputs($_POST['mobile']);
	$landline = test_inputs($_POST['landline']);
	$email = test_inputs($_POST['email']);
	
	
	
			$q = "UPDATE `clinics_labs` SET 
			`lab_name` = '".$lab_name."', 
			`mobile` = '".$mobile."', 
			`landline` = '".$landline."', 
			`email` = '".$email."' 
				WHERE ((`lab_id` = ".$lab_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Lab_Updated'));
			
			} else {
				echo mysqli_error($KONN);
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