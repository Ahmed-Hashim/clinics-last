<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['clinic_id']) && 
	isset($_POST['clinic_name']) && 
	isset($_POST['clinic_mobile']) && 
	isset($_POST['clinic_landline']) && 
	isset($_POST['clinic_website']) && 
	isset($_POST['clinic_email'])  ){
		
//data collection
	$clinic_id = (int) test_inputs($_POST['clinic_id']);
	$clinic_name = test_inputs($_POST['clinic_name']);
	
	$clinic_mobile = test_inputs($_POST['clinic_mobile']);
	$clinic_landline = test_inputs($_POST['clinic_landline']);
	$clinic_email = test_inputs($_POST['clinic_email']);
	$clinic_website = test_inputs($_POST['clinic_website']);
	
	
	
			$q = "UPDATE `clinics` SET 
			`clinic_name` = '".$clinic_name."', 
			`clinic_mobile` = '".$clinic_mobile."', 
			`clinic_landline` = '".$clinic_landline."', 
			`clinic_email` = '".$clinic_email."', 
			`clinic_website` = '".$clinic_website."' 
				WHERE ((`clinic_id` = ".$clinic_id."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Clinic_Updated'));
			
			} else {
				echo mysqli_error($KONN);
					die('0|ERROR no : js94sdds0');
			}

		
		

	
	
	
	
} elseif( isset($_POST['clinic_id']) && 
	isset($_POST['clinic_country']) && 
	isset($_POST['clinic_city']) && 
	isset($_POST['clinic_area']) && 
	isset($_POST['clinic_street'])  ){
		
//data collection
	$clinic_id = (int) test_inputs($_POST['clinic_id']);
	$clinic_country = test_inputs($_POST['clinic_country']);
	
	$clinic_city = test_inputs($_POST['clinic_city']);
	$clinic_area = test_inputs($_POST['clinic_area']);
	$clinic_street = test_inputs($_POST['clinic_street']);
	
	
	
			$q = "UPDATE `clinics` SET 
			`clinic_country` = '".$clinic_country."', 
			`clinic_city` = '".$clinic_city."', 
			`clinic_area` = '".$clinic_area."', 
			`clinic_street` = '".$clinic_street."' 
				WHERE ((`clinic_id` = ".$clinic_id."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Clinic_Updated'));
			
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