<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) ){
	$patient_id = 0;
	$profile_pic = 'profile.png';
	$patient_id = (int) test_inputs($_POST['patient_id']);
	
	$upload_res = upload_img('profile_pic_choser');
	
	
	if( $upload_res != false ){
		$profile_pic = $upload_res;
	}
	
		$qRR = "UPDATE `patients` SET 
		`profile_pic` = '".$profile_pic."' WHERE ((`patient_id` = ".$patient_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		
		if(mysqli_query($KONN, $qRR)){
			
			die('1|'.lang('patient_profile_picture_updated'));
		
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