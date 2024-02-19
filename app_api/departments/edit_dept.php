<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['op']) && 
	isset($_POST['dept_id']) 
	){
		
//data collection
	$op = (int) test_inputs($_POST['op']);
	$dept_id = (int) test_inputs($_POST['dept_id']);
	
	if($op == 1){
		
		$q = "SELECT * FROM `clinics_departments` WHERE ((`clinic_department_id` = ".$dept_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		$qee = mysqli_query($KONN, $q);
		$counts = mysqli_num_rows($qee);
		$dept_data = mysqli_fetch_assoc($qee);
		
		if($counts > 0){
?>
		<br>
	<section class="form-holder">
		<form id="edit_department_form">
				<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$dept_data['clinic_department_id']; ?>" type="hidden" name="clinic_department_id">
		
			<div class="form-control">
				<label><?=lang('department_name'); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$dept_data['clinic_department_name']; ?>" type="text" name="clinic_department_name">
			</div>
			
			
			
			
		</form>
			<br>
			
			
		<div class="form-control">
			<label><?=lang('submit_data'); ?></label>
			<button type="button" onclick="URLer = '<?=api_root; ?>departments/update_department.php';redirecter = 'self';submit_form('edit_department_form');"><?=lang('save'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel'); ?></button>
		</div>
			
			
	</section>
		<br>
			
<?php
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
