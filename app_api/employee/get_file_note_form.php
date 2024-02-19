<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['employee_id']) ){
	
	$employee_id = (int) test_inputs($_POST['employee_id']);
	
	
?>


<form id="emp_file_note_form">

<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$employee_id; ?>" type="hidden" name="employee_id">

	<div class="form-control">
		<label><?=lang('note'); ?></label>
		<textarea class="data-input" req="0" defaulter="na" denier="" alerter="please check inputs" name="note_content"></textarea>
	</div>


	<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>employee/insert_file_note.php';redirecter = 'close_modal';submit_form('emp_file_note_form');"><?=lang('add_note'); ?></button>
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
