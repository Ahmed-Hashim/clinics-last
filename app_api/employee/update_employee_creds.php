<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['employee_id']) && 
	isset($_POST['username']) && 
	isset($_POST['password']) ){
		
//data collection
	$employee_id = (int) test_inputs($_POST['employee_id']);
	$username = test_inputs($_POST['username']);
	$password = test_inputs($_POST['password']);
	
		
		//check if data already exist or not
		
		
		
		
$qur = "SELECT * FROM `employees_sys_cred` WHERE ( (`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$aur_exe = mysqli_query($KONN, $qur);
		
		
		
		
		
		
		
		
		
		
		if(mysqli_num_rows($aur_exe) == 1){
			//update data
			$q = "UPDATE `employees_sys_cred` SET 
			`username` = '".$username."', 
			`password` = '".$password."' WHERE ((`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_Updated'));
			
			} else {
				echo mysqli_error($KONN);
				die('0|ERROR no : js94sdds0');
			}
		} else {
			

$qurA = "SELECT * FROM `employees_sys_cred` WHERE ( (`username` = '".$username."') AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$aur_exeA = mysqli_query($KONN, $qurA);
	if(mysqli_num_rows($aur_exeA) != 0 ){
		die('0|'.lang('username existed', 'الاسم مستخدم من قبل'));
	}
		
	$department_id = 0;
	$qu_clinics_employees_sel = "SELECT `clinic_department_id` FROM  `clinics_employees` WHERE ((`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
	$qu_clinics_employees_EXE = mysqli_query($KONN, $qu_clinics_employees_sel);
	$clinics_employees_DATA;
	if(mysqli_num_rows($qu_clinics_employees_EXE) > 0){
		$clinics_employees_DATA = mysqli_fetch_array($qu_clinics_employees_EXE);
		$department_id = $clinics_employees_DATA[0];
	}

			
			
			//insetr data
			$q = "INSERT INTO `employees_sys_cred` (
			`employee_id`, 
			`username`, 
			`password`,
			`department_id`,
			`clinic_id`
			) VALUES (
			'$employee_id', 
			'$username', 
			'$password', 
			'$department_id', 
			'".$_SESSION['clinic_id']."')";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('employee_Updated'));
			
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
