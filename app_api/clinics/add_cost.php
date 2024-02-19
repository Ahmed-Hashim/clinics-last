<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['expense_item']) && isset($_POST['expense_notes']) && isset($_POST['expense_total'])  ){
		
//data collection
	$expense_item = test_inputs($_POST['expense_item']);
	$expense_notes = test_inputs($_POST['expense_notes']);
	$expense_total = test_inputs($_POST['expense_total']);
	$date_time = date('Y-m-d h:i:00');
	
	
			$q = "INSERT INTO `clinic_expenses` (
				`expense_item`, 
				`expense_notes`, 
				`expense_total`, 
				`date_time`, 
				`clinic_id`
				) VALUES (
				'$expense_item', 
				'$expense_notes', 
				'$expense_total', 
				'$date_time', 
				'".$_SESSION['clinic_id']."'
				);";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('New_Department_Added'));
			
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