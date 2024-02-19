<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['op']) && 
	isset($_POST['main_id']) 
	){
		
//data collection
	$op = (int) test_inputs($_POST['op']);
	$main_id = (int) test_inputs($_POST['main_id']);
	
	if($op == 1){
		
		$q = "SELECT `insurance_category_id`, CONCAT(`insurance_category_name`, '-', `discount`) AS namer FROM `insurance_categories` WHERE ((`insurance_company_id` = ".$main_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		$qee = mysqli_query($KONN, $q);
		$counts = mysqli_num_rows($qee);
		
		
		if($counts > 0){
			while($dept_data = mysqli_fetch_assoc($qee)){
?>

			<option value="<?=$dept_data['insurance_category_id']; ?>"><?=$dept_data['namer']; ?>&nbsp;%</option>
<?php
			}
		}

	} elseif($op == 2){
		/*
		$q = "DELETE FROM `insurance_categories` WHERE ((`insurance_category_id` = ".$main_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";

		if(mysqli_query($KONN, $q)){
			echo lang('catageory_deleted');
		}
*/
	}
		

	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>
