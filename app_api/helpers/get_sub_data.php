<?php
require_once('../../bootstrap/app_config.php');

if(isset($_POST['main_id']) && isset($_POST['operation']) ){
	
	$main_id = test_inputs($_POST['main_id']);
	$operation = test_inputs($_POST['operation']);
	
	if($main_id != 0 && $operation != 0){
		if($operation == 1){
			
			
			
			//get sub banks------------------------------------------
$q = "SELECT * FROM `banks_branches` WHERE `bank_id` = '".$main_id."' AND `branch_id` = '".$branch_id."' AND company_id = '".$company_id."' ";

$q_exe = mysqli_query($KONN, $q);
if(mysqli_num_rows($q_exe) > 0){
?>
<option value="0"><?=lang('Please_Select'); ?></option>
<?php
	while($record = mysqli_fetch_assoc($q_exe)){
?>
							<option value="<?=$record['bank_branch_id']; ?>"><?=lang($record['bank_branch_name']); ?></option>
<?php
		}
	}
			//get sub banks------------------------------------------	
			
			
			
			
			
		} else if($operation == 2) {
			
			
			
			//get sub insurance------------------------------------------
$q = "SELECT * FROM `insurance_categories` WHERE `insurance_company_id` = '".$main_id."' AND `branch_id` = '".$branch_id."' AND company_id = '".$company_id."' ";

$q_exe = mysqli_query($KONN, $q);
if(mysqli_num_rows($q_exe) > 0){
?>
<option value="0"><?=lang('Please_Select'); ?></option>
<?php
	while($record = mysqli_fetch_assoc($q_exe)){
?>
							<option value="<?=$record['insurance_category_id']; ?>"><?=lang($record['insurance_category_name']); ?></option>
<?php
		}
	}
			//get sub insurance------------------------------------------	
			
			
			
			
			
			
		} else if($operation == 3) {
			
		}
	
	
	
	
	
	//---------------
	}
	
	
	
	
	}
?>