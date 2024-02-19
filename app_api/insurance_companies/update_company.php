<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['insurance_company_id']) && 
	isset($_POST['insurance_company_name']) && 
	isset($_POST['mobile']) && 
	isset($_POST['landline']) && 
	isset($_POST['email']) && 
	isset($_POST['fax_no']) && 
	isset($_POST['accreditation_no'])  ){
		
//data collection
	$insurance_company_id = test_inputs($_POST['insurance_company_id']);
	$insurance_company_name = test_inputs($_POST['insurance_company_name']);
	
	$mobile = test_inputs($_POST['mobile']);
	$landline = test_inputs($_POST['landline']);
	$email = test_inputs($_POST['email']);
	$fax_no = test_inputs($_POST['fax_no']);
	$accreditation_no = test_inputs($_POST['accreditation_no']);
	
	
	
			$q = "UPDATE `insurance_companies` SET 
			`insurance_company_name` = '".$insurance_company_name."', 
			`mobile` = '".$mobile."', 
			`landline` = '".$landline."', 
			`email` = '".$email."', 
			`fax_no` = '".$fax_no."', 
			`accreditation_no` = '".$accreditation_no."' 
				WHERE ((`insurance_company_id` = ".$insurance_company_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
			
			if(mysqli_query($KONN, $q)){
				
				die('1|'.lang('Company_Updated'));
			
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