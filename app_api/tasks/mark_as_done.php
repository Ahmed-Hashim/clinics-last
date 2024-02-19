<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['op']) && 
	isset($_POST['task_id']) 
	){
		
//data collection
	$op = (int) test_inputs($_POST['op']);
	$task_id = (int) test_inputs($_POST['task_id']);
	
	
	if($op == 1){
		$mark_time = date('Y-m-d h:i:00');
		
		$q = "UPDATE `employees_tasks` SET `is_done` = '1', `done_at` = '".$mark_time."' WHERE ((`task_id` = '".$task_id."') AND (`clinic_id` = ".$_SESSION['clinic_id']."))";

		
			if(mysqli_query($KONN, $q)){
				
				die(lang('Task_Marked_As_done'));
			
			} else {
					die('0|ERROR no : js94sdds0');
			}

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