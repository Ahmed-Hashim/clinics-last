<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['insurance_category_id']) && 
	isset($_POST['insurance_category_name']) && 
	isset($_POST['discount']) ){
		
//data collection
	$insurance_category_id = test_inputs($_POST['insurance_category_id']);
	$insurance_category_name = test_inputs($_POST['insurance_category_name']);
	$discount = test_inputs($_POST['discount']);
	
	
	
			$q = "UPDATE `insurance_categories` SET 
			`insurance_category_name` = '".$insurance_category_name."', 
			`discount` = '".$discount."' 
				WHERE ((`insurance_category_id` = ".$insurance_category_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Catageory_Updated'));
			
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