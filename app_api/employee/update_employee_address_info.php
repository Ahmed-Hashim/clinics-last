<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['employee_id']) && 
	isset($_POST['country']) && 
	isset($_POST['city']) && 
	isset($_POST['area']) && 
	isset($_POST['block']) && 
	isset($_POST['street_name']) && 
	isset($_POST['building_no']) && 
	isset($_POST['floor_no']) && 
	isset($_POST['apartment_no']) ){
		
//data collection
	$employee_id = (int) test_inputs($_POST['employee_id']);
	$country = test_inputs($_POST['country']);
	$city = test_inputs($_POST['city']);
	$area = test_inputs($_POST['area']);
	$block = test_inputs($_POST['block']);
	$street_name = test_inputs($_POST['street_name']);
	$building_no = test_inputs($_POST['building_no']);
	$floor_no = test_inputs($_POST['floor_no']);
	$apartment_no = test_inputs($_POST['apartment_no']);
	
		
		//check if data already exist or not
		
$qur = "SELECT * FROM `employees_address` WHERE ( (`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$aur_exe = mysqli_query($KONN, $qur);
		
		if(mysqli_num_rows($aur_exe) == 1){
			//update data
			$q = "UPDATE `employees_address` SET 
			`country` = '".$country."', 
			`city` = '".$city."', 
			`area` = '".$area."', 
			`block` = '".$block."', 
			`street_name` = '".$street_name."', 
			`building_no` = '".$building_no."', 
			`floor_no` = '".$floor_no."', 
			`apartment_no` = '".$apartment_no."' WHERE ((`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_contacts_Updated'));
			
			} else {
				echo mysqli_error($KONN);
				die('0|ERROR no : js94sdds0');
			}
		} else {
			//insetr data
			$q = "INSERT INTO `employees_address` (
			`employee_id`, 
			`country`, 
			`city`, 
			`area`, 
			`block`, 
			`street_name`, 
			`building_no`, 
			`floor_no`, 
			`apartment_no`, 
			`clinic_id`
			) VALUES (
			'$employee_id', 
			'$country', 
			'$city', 
			'$area', 
			'$block', 
			'$street_name', 
			'$building_no', 
			'$floor_no', 
			'$apartment_no', 
			'".$_SESSION['clinic_id']."')";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_address_Updated'));
			
			} else {
				echo mysqli_error($KONN);
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
