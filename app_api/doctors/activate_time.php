<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['dr_id']) && 
	isset($_POST['year']) && 
	isset($_POST['month']) && 
	isset($_POST['day']) && 
	isset($_POST['hour']) && 
	isset($_POST['min'])
	){
		
//data collection
	$dr_id = (int) test_inputs($_POST['dr_id']);
	$year = (int) test_inputs($_POST['year']);
	$month = (int) test_inputs($_POST['month']);
	$day = (int) test_inputs($_POST['day']);
	$hour = (int) test_inputs($_POST['hour']);
	$min = (int) test_inputs($_POST['min']);
	
		
		$time_date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
				
				
				
		//place block
			//insert patient data
		$q = "DELETE FROM `dr_blocked_times` WHERE ((block_time = '".$time_date."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Time_Activated'));
			
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