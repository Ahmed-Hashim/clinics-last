<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['op']) && 
	isset($_POST['lab_exam_id']) 
	){
		
//data collection
	$op = (int) test_inputs($_POST['op']);
	$lab_exam_id = (int) test_inputs($_POST['lab_exam_id']);
	
	if($op == 1){
		
		$q = "SELECT * FROM `clinics_labs_exams` WHERE ((`lab_exam_id` = ".$lab_exam_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		$qee = mysqli_query($KONN, $q);
		$counts = mysqli_num_rows($qee);
		$dept_data = mysqli_fetch_assoc($qee);
		
		if($counts > 0){
?>
		<br>
	<section class="form-holder">
		<form id="edit_lab_exam_form">
				<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$dept_data['lab_exam_id']; ?>" type="hidden" name="lab_exam_id">
		
			<div class="form-control">
				<label><?=lang('lab_exam_name'); ?></label>
				<input id="lab_exam_val01" class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$dept_data['lab_exam_name']; ?>" type="text" name="lab_exam_name">
			</div>
			
			<div class="form-control">
				<label><?=lang('cost'); ?></label>
				<input id="lab_exam_val02" class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$dept_data['cost']; ?>" type="text" name="cost">
			</div>
			
			
			
			
		</form>
			<br>
			
			
		<div class="form-control">
			<label><?=lang('submit_data'); ?></label>
			<button type="button" onclick="change_tr(<?=$dept_data['lab_exam_id']; ?>);URLer = '<?=api_root; ?>labs/update_lab_exam.php';redirecter = 'close_modal';submit_form('edit_lab_exam_form');"><?=lang('save'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel'); ?></button>
		</div>
			
			
	</section>
		<br>
			
<?php
		}

	} elseif($op == 2){
		
		$q = "DELETE FROM `clinics_labs_exams` WHERE ((`lab_exam_id` = ".$lab_exam_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";

		if(mysqli_query($KONN, $q)){
			echo lang('lab_exam_deleted');
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
