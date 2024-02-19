<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['pat_name']) && 
	isset($_POST['op']) 
	){
		
	$patient_id = 0;
//data collection

	// $profile_pic = isset($_FILES['profile_pic']) ? $_FILES['profile_pic'] : false;
	
	$pat_namer = test_inputs($_POST['pat_name']);
	$op = test_inputs($_POST['op']);
	
	if($op == 1){
		
		$q = "SELECT patient_id, CONCAT(`first_name`, ' ',`second_name`, ' ',`third_name`, ' ',`last_name`) AS pat_name, `file_num` FROM `patients` WHERE ( (( `first_name` LIKE '%".$pat_namer."%' ) OR ( `last_name` LIKE '%".$pat_namer."%' ) ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ";
		$q_exe = mysqli_query($KONN, $q);
		
		if(mysqli_num_rows($q_exe) > 0){
			
			while($pat_data = mysqli_fetch_assoc($q_exe)){
				$patient_id = $pat_data['patient_id'];
				$pat_name = $pat_data['pat_name'];
				$file_num = $pat_data['file_num'];
				?>
<li onclick="slct_pat_nw_app(<?=$patient_id; ?>, <?=$file_num; ?>, '<?=$pat_name; ?>');" id="li_<?=$patient_id; ?>_<?=$file_num; ?>" list_dest="nw_app_name_autocomp" id_dest="nw_app_pat_id" file_dest="nw_app_pat_file_num" name_dest="nw_app_pat_name"><?=$pat_name; ?></li>
				<?php
			}
			?>
			
			<?php
		} else {
			die(lang('no_records_found'));
		}

		
		
		
	} else if($op == 2){
		
		$q = "SELECT patient_id, CONCAT(`first_name`, ' ',`last_name`) AS pat_name, `file_num` FROM `patients` WHERE ( (( `first_name` LIKE '%".$pat_namer."%' ) OR ( `last_name` LIKE '%".$pat_namer."%' ) ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ";
		$q_exe = mysqli_query($KONN, $q);
		
		if(mysqli_num_rows($q_exe) > 0){
			
			while($pat_data = mysqli_fetch_assoc($q_exe)){
				$patient_id = $pat_data['patient_id'];
				$pat_name = $pat_data['pat_name'];
				$file_num = $pat_data['file_num'];
				?>
<li onclick="slct_pat_edit_app(<?=$patient_id; ?>, <?=$file_num; ?>, '<?=$pat_name; ?>');" id="li_<?=$patient_id; ?>_<?=$file_num; ?>" list_dest="edit_app_name_autocomp" id_dest="edit_app_pat_id" file_dest="edit_app_pat_file_num" name_dest="edit_app_pat_name"><?=$pat_name; ?></li>
				<?php
			}
			?>
			
			<?php
		} else {
			die(lang('no_records_found'));
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
