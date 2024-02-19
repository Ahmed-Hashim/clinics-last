<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['lab_name']) && isset($_POST['mobile']) && isset($_POST['landline']) && isset($_POST['email']) ){
		
//data collection
	$lab_name = test_inputs($_POST['lab_name']);
	$mobile = test_inputs($_POST['mobile']);
	$landline = test_inputs($_POST['landline']);
	$email = test_inputs($_POST['email']);
	
	
	
			$q = "INSERT INTO `clinics_labs` (
				`lab_name`, 
				`mobile`, 
				`landline`, 
				`email`, 
				`clinic_id`
				) VALUES (
				'$lab_name', 
				'$mobile', 
				'$landline', 
				'$email', 
				'".$_SESSION['clinic_id']."'
				);";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('New_lab_Added'));
			
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