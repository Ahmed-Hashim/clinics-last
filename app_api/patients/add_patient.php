<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['first_name']) && 
	isset($_POST['last_name']) && 
	isset($_POST['nat_no']) && 
	isset($_POST['dob']) && 
	isset($_POST['gender']) && 
	isset($_POST['mobile']) && 
	isset($_POST['dr_id']) && 
	isset($_POST['file_num']) && 
	isset($_POST['insurance_type']) 
	){
	$patient_id = 0;
//data collection

	// $profile_pic = isset($_FILES['profile_pic']) ? $_FILES['profile_pic'] : false;
	$nat_no = test_inputs($_POST['nat_no']);
	$first_name = test_inputs($_POST['first_name']);
	$second_name = 'na';
	if(isset($_POST['second_name'])){
		$second_name = test_inputs($_POST['second_name']);
	}
	
	$third_name = 'na';
	if(isset($_POST['third_name'])){
		$third_name = test_inputs($_POST['third_name']);
	}
	
	
	$last_name = test_inputs($_POST['last_name']);
	
	$nationality = 'na';
	if(isset($_POST['nationality'])){
		$nationality = test_inputs($_POST['nationality']);
	}
	
	$dob = test_inputs($_POST['dob']);
	$gender = test_inputs($_POST['gender']);
	$mobile = test_inputs($_POST['mobile']);
	$file_num = test_inputs($_POST['file_num']);
	$dr_id = test_inputs($_POST['dr_id']);
	
	$insurance_type = test_inputs($_POST['insurance_type']);
	$insurance_company = $insurance_category = '0';
	if(isset($_POST['insurance_company'])){
		$insurance_company = test_inputs($_POST['insurance_company']);
		$insurance_category = test_inputs($_POST['insurance_category']);
	}
	
	$reg_date = date('Y-m-d h:i:00');
	
	$registerer = $_SESSION['employee_id'];
	
	
	//check if file num exists
	
	$QT = "SELECT COUNT(`patient_id`) FROM `patients` WHERE `file_num` = '".$file_num."' AND `clinic_id` =  '".$_SESSION['clinic_id']."'";
	$QTE = mysqli_query($KONN, $QT);
	$QTRES = mysqli_fetch_array($QTE);
	
	if($QTRES[0] == 0){
		

	$QTW = "SELECT MAX(`file_num`) FROM `patients` WHERE `clinic_id` =  '".$_SESSION['clinic_id']."'";
	$QTEW = mysqli_query($KONN, $QTW);
	$QTRESW = mysqli_fetch_array($QTEW);
		
		if($file_num == ''){
			$file_num = $QTRESW[0] + 1;
		}
		
		
		
		
		//insert patient data
		$q = "INSERT INTO `patients` (
			`nat_no`, 
			`nationality`, 
			`first_name`, 
			`second_name`, 
			`third_name`, 
			`last_name`, 
			`dob`, 
			`gender`, 
			`mobile`, 
			`file_num`, 
			`insurance_type`, 
			`insurance_company`, 
			`insurance_category`, 
			`dr_id`, 
			`reg_date`, 
			`registerer`, 
			`clinic_id`
			) VALUES (
			'$nat_no', 
			'$nationality', 
			'$first_name', 
			'$second_name', 
			'$third_name', 
			'$last_name', 
			'$dob', 
			'$gender', 
			'$mobile', 
			'$file_num', 
			'$insurance_type', 
			'$insurance_company', 
			'$insurance_category', 
			'$dr_id', 
			'$reg_date', 
			'$registerer', 
			'".$_SESSION['clinic_id']."'
			);";
		
		if(mysqli_query($KONN, $q)){
			// $patient_id = mysqli_insert_id($KONN);
			die('1|New Patient Added');
		} else {
				die('0|ERROR no : js94sdds0'.mysqli_error($KONN));
		}
		
	} else {
		die('0|File Number Exists');
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