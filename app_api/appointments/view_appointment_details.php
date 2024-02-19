<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['dr_id']) && 
	isset($_POST['appointment_id']) 
	){
		
//data collection
	$dr_id = (int) test_inputs($_POST['dr_id']);
	$appointment_id = (int) test_inputs($_POST['appointment_id']);
		
		//get app data
		$qq = "SELECT * FROM `clinics_appointments` WHERE ((`appointment_id` = '".$appointment_id."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].")) LIMIT 1";
		$qqee = mysqli_query($KONN, $qq);
		$app_data = mysqli_fetch_assoc($qqee);
		
		
		//get docotr data
		$qq = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS doc_name FROM `clinics_employees` WHERE ((`employee_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].")) LIMIT 1";
		$qqee = mysqli_query($KONN, $qq);
		$doc_data = mysqli_fetch_assoc($qqee);
		$doc_name = $doc_data['doc_name'];
		
		
		//get docotr data
		$qq = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS pat_name, `file_num` FROM `patients` WHERE ((`patient_id` = ".$app_data['patient_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].")) LIMIT 1";
		$qqee = mysqli_query($KONN, $qq);
		$patient_data = mysqli_fetch_assoc($qqee);
		$patient_name = $patient_data['pat_name'];
		$file_num = $patient_data['file_num'];
		
?>
<div class="form-control">
	<label><?=lang('patient_file_num'); ?></label>
	<input class="just_read" type="text" id="" value="<?=$file_num; ?>" readonly>
</div>
<div class="form-control">
	<label><?=lang('patient_name'); ?></label>
	<input class="just_read" type="text" id="" value="<?=$patient_name; ?>" readonly>
</div>

<div class="form-control">
	<label><?=lang('appointment_ref_no'); ?></label>
	<input class="just_read" type="text" id="" value="<?=$appointment_id; ?>" readonly>
</div>

<div class="form-control">
	<label><?=lang('doctor_name'); ?></label>
	<input class="just_read" type="text" id="" value="<?=$doc_name; ?>" readonly>
</div>



	<?php
		$appointment_date = $app_data['time_date'];
		$app_duration = $app_data['app_duration'];
		
		$treat_start_time = $app_data['treat_start_time'];
		
		$confirm_time = $app_data['confirm_time'];
		$check_in_time = $app_data['check_in_time'];
		$completed_time = $app_data['completed_time'];
		$no_show_time = $app_data['no_show_time'];
		$cancel_time = $app_data['cancel_time'];
		$status = $app_data['status'];
		$cur_date_time = date('Y-m-d h:i:00');
		$app_state = 'NA';
		
		switch($status){
			case 1:
				$app_state = lang('Pending');
				break;
			case 2:
				$app_state = lang('Confirmed');
				break;
			case 3:
				$app_state = lang('Canceled');
				break;
			case 4:
				$app_state = lang('Blocked');
				break;
			case 5:
				$app_state = lang('checked-in');
				break;
			case 6:
				$app_state = lang('No-Show');
				break;
			case 7:
				$app_state = lang('Completed');
				break;
		}
		$status = $app_state;
		
		
		
$awaiting_time = false;

		if($check_in_time != NULL && $treat_start_time != NULL ){
			
			$datetime1 = strtotime($check_in_time);
			$datetime2 = strtotime($treat_start_time);
			$interval  = abs($datetime2 - $datetime1);
			$minutes   = round($interval / 60);
			
			$awaiting_time = $minutes.''.lang('Minutes');
		}
		
$confirmed_at = false;
$checked_in_at = false;
$completed_at = false;
$canceled_at = false;
$marked_as_no_show = false;

		if($confirm_time != NULL){
			$confirmed_at = $confirm_time;
		}

		if($check_in_time != NULL){
			$checked_in_at = $check_in_time;
		}

		if($completed_time != NULL){
			$completed_at = $completed_time;
		}

		if($no_show_time != NULL){
			$marked_as_no_show = $no_show_time;
		}

		if($cancel_time != NULL){
			$canceled_at = $cancel_time;
		}

		if($cancel_time != NULL){
			$canceled_at = $cancel_time;
		}

		
?>


	<br>
<?php if($appointment_date != false){ ?>
		<div class="form-control">
			<label><?=lang('appointment_date'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$appointment_date; ?>" readonly>
		</div>
		<div class="form-control">
			<label><?=lang('appointment_duration'); ?>( <?=lang('minutes'); ?> )</label>
			<input class="just_read" type="text" id="" value="<?=$app_duration; ?>" readonly>
		</div>
<?php } ?>
<?php if($status != false){ ?>
		<div class="min-form-control">
			<label><?=lang('status'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$status; ?>" readonly>
		</div>
<?php } ?>
<?php if($awaiting_time != false){ ?>
		<div class="min-form-control">
			<label><?=lang('awaiting_time'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$awaiting_time; ?>" readonly>
		</div>
<?php } ?>
<?php if($confirmed_at != false){ ?>
		<div class="min-form-control">
			<label><?=lang('confirmed_at'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$confirmed_at; ?>" readonly>
		</div>
<?php } ?>
<?php if($checked_in_at != false){ ?>
		<div class="min-form-control">
			<label><?=lang('checked-in_at'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$checked_in_at; ?>" readonly>
		</div>
<?php } ?>
<?php if($completed_at != false){ ?>
		<div class="min-form-control">
			<label><?=lang('completed_at'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$completed_at; ?>" readonly>
		</div>
<?php } ?>
<?php if($canceled_at != false){ ?>
		<div class="min-form-control">
			<label><?=lang('canceled_at'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$canceled_at; ?>" readonly>
		</div>
<?php } ?>
<?php if($marked_as_no_show != false){ ?>
		<div class="min-form-control">
			<label><?=lang('marked_as_no-show_at'); ?></label>
			<input class="just_read" type="text" id="" value="<?=$marked_as_no_show; ?>" readonly>
		</div>
<?php } ?>
		
		
		<br><br>

<?php
		$qC = "SELECT * FROM `clinics_appointments_notes` WHERE ( ( `appointment_id` = ".$appointment_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) )";
		$q_exeC = mysqli_query($KONN, $qC);
		if(mysqli_num_rows($q_exeC) > 0){
?>
				<h3><?=lang('appointment_notes'); ?></h3>
				<table>
					<tbody>
<?php
			while($note_data = mysqli_fetch_assoc($q_exeC)){
?>
						<tr>
							<td><?=$note_data['note_content']; ?></td>
							<td><?=$note_data['date_added']; ?></td>
						</tr>
<?php
			}
?>
					</tbody>
				</table>
<?php
		}
		
		
		

	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>
