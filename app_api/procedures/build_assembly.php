<?php
require_once('../../bootstrap/app_config.php');

// var_dump($_POST);
// die();

	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['procedure_id'])&& 
	isset($_POST['itms']) && 
	isset($_POST['itms_names']) && 
	isset($_POST['itms_qty']) && 
	isset($_POST['itms_typo'])  
	){
		
// data collection
	$procedure_id = test_inputs($_POST['procedure_id']);
	$itms = $_POST['itms'];
	$itms_names = $_POST['itms_names'];
	$itms_qty = $_POST['itms_qty'];
	$itms_typo = $_POST['itms_typo'];
	
	
// delete old data
$q = "DELETE FROM `clinics_procedures_assembly` WHERE ((`procedure_id` = ".$procedure_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
mysqli_query($KONN, $q);
	
// insert new data
	for($i=0;$i<count($itms);$i++){
			$q = "INSERT INTO `clinics_procedures_assembly` (
				`procedure_id`, 
				`typo`, 
				`part_id`, 
				`part_name`, 
				`part_qty`, 
				`clinic_id`
				) VALUES (
				'".$procedure_id."', 
				'".$itms_typo[$i]."', 
				'".$itms[$i]."', 
				'".$itms_names[$i]."', 
				'".$itms_qty[$i]."', 
				'".$_SESSION['clinic_id']."'
				);";
			
			if(!mysqli_query($KONN, $q)){
				//echo mysqli_error($KONN);
				die('0|ERROR no : js94sdds0');
			}

	}
	
	
	
	die('1|'.lang('Procedure_Assembely_Succeeded'));
	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>
?>