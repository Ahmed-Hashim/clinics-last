<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['patient_id']) ){
		
	$patient_id = 0;
	$patient_id = (int) test_inputs($_POST['patient_id']);
	
	//get patient current doctor
$Q1 = "SELECT `dr_id` FROM `patients` WHERE ( (`patient_id` = ".$patient_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$cur_db = mysqli_fetch_array($QEXE1);
	
	
	
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$cur_db[0].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$cur_dr_data = mysqli_fetch_array($QEXE1);
	
	$cur_dr_id = $cur_db[0];
	$cur_dr_name = $cur_dr_data[0];
	
?>


<form id="pat_file_note_form">

<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$patient_id; ?>" type="hidden" name="patient_id">

	<div class="form-control">
		<label><?=lang('note'); ?></label>
		<textarea class="data-input" req="0" defaulter="na" denier="" alerter="please check inputs" name="note_content"></textarea>
	</div>


	<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>patients/insert_file_note.php';redirecter = 'close_modal';submit_form('pat_file_note_form');"><?=lang('add_transfer'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel'); ?></button>
		</div>




</form>






<?php
		
	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>
