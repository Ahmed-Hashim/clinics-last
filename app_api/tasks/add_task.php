<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['from_id']) && 
	isset($_POST['to_id']) && 
	isset($_POST['priority']) && 
	isset($_POST['task_date']) && 
	isset($_POST['task_hour']) && 
	isset($_POST['deadline_date']) && 
	isset($_POST['task_content']) 
	){
		
//data collection
	$from_id = (int) test_inputs($_POST['from_id']);
	$to_id = (int) test_inputs($_POST['to_id']);
	$priority = (int) test_inputs($_POST['priority']);
	$task_date = test_inputs($_POST['task_date']);
	$task_hour = (int) test_inputs($_POST['task_hour']);
	$deadline = test_inputs($_POST['deadline_date']);
	$task_content = test_inputs($_POST['task_content']);
	
		$date_arr = explode('-', $task_date);
		$ths_y = $date_arr[0];
		$ths_m = (int) $date_arr[1];
		$ths_d = (int) $date_arr[2];
		
		if($ths_m < 10){$ths_m = '0'.$ths_m;}
		if($ths_d < 10){$ths_d = '0'.$ths_d;}
		
		if($task_hour < 10){$task_hour = '0'.$task_hour;}
		
		$task_time = $ths_y.'-'.$ths_m.'-'.$ths_d.' '.$task_hour.':00:00';
				
				
		if($task_content == ''){
			//time is blocked
			die('0|'.lang('please_insert_task_content'));
		}
		
		//place task
			$q = "INSERT INTO `employees_tasks` (
				`from_id`, 
				`to_id`, 
				`priority`, 
				`task_time`, 
				`deadline`, 
				`task_content`, 
				`clinic_id`
				) VALUES (
				'$from_id', 
				'$to_id', 
				'$priority', 
				'$task_time', 
				'$deadline', 
				'$task_content', 
				'".$_SESSION['clinic_id']."'
				);";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('New_Task_Added'));
			
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