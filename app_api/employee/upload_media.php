<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['employee_id']) && isset($_POST['media_title']) ){
	$employee_id = 0;
	$media_path = 'profile.png';
	$employee_id = (int) test_inputs($_POST['employee_id']);
	$media_title = test_inputs($_POST['media_title']);
	
	$upload_res = upload_file('nw_emp_media_path');
	
	
	if( $upload_res != false ){
		$media_path = $upload_res;
	} else {
		die('0|'.$upload_res);
		// die('0|'.lang('error'));
	}
	
	$added_by = $_SESSION['employee_id'];
	
	$media_arr = explode('.', $media_path);
	
	$media_ext = $media_arr[1];
	
	$q = "INSERT INTO `employees_media` (
		`employee_id`, 
		`media_title`, 
		`media_path`, 
		`media_ext`, 
		`added_by`, 
		`clinic_id`
		) VALUES (
		'$employee_id', 
		'$media_title', 
		'$media_path', 
		'$media_ext', 
		'$added_by', 
		'".$_SESSION['clinic_id']."'
		);";
	
	
	
	
	
		if(mysqli_query($KONN, $q)){
			
			die('1|'.lang('employee_media_uploaded'));
		
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