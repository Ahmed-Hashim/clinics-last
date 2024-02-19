<?php
require_once('../../bootstrap/app_config.php');


if(isset($_POST['employee_id']) && isset($_POST['username']) && isset($_POST['password']) ){
	
//data collection

	$employee_id = test_inputs($_POST['employee_id']);
	$username = test_inputs($_POST['username']);
	$password = test_inputs($_POST['password']);
	
	
	//insert employee data
	$q = "INSERT INTO `employees_sys_cred` (
		`employee_id`, 
		`username`, 
		`password`, 
		`branch_id`, 
		`company_id`
		) VALUES (
		'$employee_id', 
		'$username', 
		'$password', 
		'$branch_id', 
		'$company_id');";
	
	if(mysqli_query($KONN, $q)){
			//employee permissions yet to go
			
			
			echo '1|Employee Credentials Added';
			
			
	} else {
			die('0|ERROR no : js94s343ds0');
	}
} else {
			die('0|ERROR no : 56465664ew');
}
?>