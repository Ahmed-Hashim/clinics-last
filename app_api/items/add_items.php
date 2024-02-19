<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['item_name']) && isset($_POST['qty']) && isset($_POST['cost_price']) && isset($_POST['selling_price']) ){
		
//data collection
	$item_name = test_inputs($_POST['item_name']);
	$qty = test_inputs($_POST['qty']);
	$cost_price = test_inputs($_POST['cost_price']);
	$selling_price = test_inputs($_POST['selling_price']);
	
	
	
			$q = "INSERT INTO `clinics_items` (
				`item_name`, 
				`qty`, 
				`cost_price`, 
				`selling_price`, 
				`clinic_id`
				) VALUES (
				'$item_name', 
				'$qty', 
				'$cost_price', 
				'$selling_price', 
				'".$_SESSION['clinic_id']."'
				);";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('New_item_Added'));
			
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