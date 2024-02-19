<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['employee_id']) && 
	isset($_POST['mobile']) && 
	isset($_POST['landline']) && 
	isset($_POST['email'])  ){
		
//data collection
	$employee_id = (int) test_inputs($_POST['employee_id']);
	$mobile = test_inputs($_POST['mobile']);
	$landline = test_inputs($_POST['landline']);
	$email = test_inputs($_POST['email']);
	
		
		//check if data already exist or not
		
		

$qur = "SELECT * FROM `employees_contacts` WHERE ( (`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$aur_exe = mysqli_query($KONN, $qur);
		
		if(mysqli_num_rows($aur_exe) == 1){
			//update data
			$q = "UPDATE `employees_contacts` SET 
			`mobile` = '".$mobile."', 
			`landline` = '".$landline."', 
			`email` = '".$email."' WHERE ((`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_contacts_Updated'));
			
			} else {
				echo mysqli_error($KONN);
				die('0|ERROR no : js94sdds0');
			}
		} else {
			//insetr data
			$q = "INSERT INTO `employees_contacts` (
			`employee_id`, 
			`mobile`, 
			`landline`, 
			`email`, 
			`clinic_id`
			) VALUES (
			'".$employee_id."', 
			'".$mobile."', 
			'".$landline."', 
			'".$email."', 
			'".$_SESSION['clinic_id']."')";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_contacts_Updated'));
			
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
