<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['op']) && 
	isset($_POST['cat_id']) 
	){
		
//data collection
	$op = (int) test_inputs($_POST['op']);
	$cat_id = (int) test_inputs($_POST['cat_id']);
	
	if($op == 1){
		
		$q = "SELECT * FROM `insurance_categories` WHERE ((`insurance_category_id` = ".$cat_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";
		$qee = mysqli_query($KONN, $q);
		$counts = mysqli_num_rows($qee);
		$dept_data = mysqli_fetch_assoc($qee);
		
		if($counts > 0){
?>
		<br>
	<section class="form-holder">
		<form id="edit_insurance_cat_form">
				<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$dept_data['insurance_category_id']; ?>" type="hidden" name="insurance_category_id">
		
			<div class="form-control">
				<label><?=lang('catageory_name'); ?></label>
				<input id="catageory_val01" class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$dept_data['insurance_category_name']; ?>" type="text" name="insurance_category_name">
			</div>
			
			<div class="form-control">
				<label><?=lang('catageory_discount'); ?></label>
				<input id="catageory_val02" class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$dept_data['discount']; ?>" type="text" name="discount">
			</div>
			
			
			
			
		</form>
			<br>
			
			
		<div class="form-control">
			<label><?=lang('submit_data'); ?></label>
			<button type="button" onclick="change_tr(<?=$dept_data['insurance_category_id']; ?>);URLer = '<?=api_root; ?>insurance_companies/update_cat.php';redirecter = 'close_modal';submit_form('edit_insurance_cat_form');"><?=lang('save'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel'); ?></button>
		</div>
			
			
	</section>
		<br>
			
<?php
		}

	} elseif($op == 2){
		
		$q = "DELETE FROM `insurance_categories` WHERE ((`insurance_category_id` = ".$cat_id.") AND (`clinic_id` = ".$_SESSION['clinic_id']."))";

		if(mysqli_query($KONN, $q)){
			echo lang('catageory_deleted');
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
