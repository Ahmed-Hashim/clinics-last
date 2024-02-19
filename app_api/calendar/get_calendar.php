<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['day']) && 
	isset($_POST['month']) && 
	isset($_POST['year']) && 
	isset($_POST['frame'])
	){
		
		
		
	$employee_id = 0;
//data collection
	$day = (int) test_inputs($_POST['day']);
	$month = (int) test_inputs($_POST['month']);
	$year = (int) test_inputs($_POST['year']);
	$frame = (int) test_inputs($_POST['frame']);

	$cols_count = 0;
	$docs;
	$docs_input = isset($_POST['docs']) ? $_POST['docs'] : false;
	
	

//UPDATE DAY NAMES
?>
<script>
<?php
	for($dayTHS=1;$dayTHS<=7;$dayTHS++){
		$dayName = date('D',mktime(0, 0, 0, $month, $dayTHS));
		$dayNameRes = $dayName;
		switch( $dayName ){
			case 'Sat':
				$dayNameRes = lang("Sat", "السبت", 1);
				break;
			case 'Sun':
				$dayNameRes = lang("Sun", "الاحد", 1);
				break;
			case 'Mon':
				$dayNameRes = lang("Mon", "الاثنين", 1);
				break;
			case 'Tue':
				$dayNameRes = lang("Tue", "الثلاثاء", 1);
				break;
			case 'Wed':
				$dayNameRes = lang("Wed", "الاربعاء", 1);
				break;
			case 'Thu':
				$dayNameRes = lang("Thu", "الخميس", 1);
				break;
			case 'Fri':
				$dayNameRes = lang("Fri", "الجمعة", 1);
				break;
		}
?>
		$('#day-name-<?=$dayTHS; ?>').html('<?=$dayNameRes; ?>');
<?php
	}
?>
</script>
<?php
	
	
$ths_day_php = date('w');

switch ($ths_day_php){
	case 0:
		$ths_day_num = 2;
		break;
	case 1:
		$ths_day_num = 3;
		break;
	case 2:
		$ths_day_num = 4;
		break;
	case 3:
		$ths_day_num = 5;
		break;
	case 4:
		$ths_day_num = 6;
		break;
	case 5:
		$ths_day_num = 7;
		break;
	case 6:
		$ths_day_num = 1;
		break;
}

//get clinic duty for this day

$q = "SELECT * FROM `clinics_duty` WHERE ( (`week_day` = ".$ths_day_num.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) LIMIT 1";



$q_exe = mysqli_query($KONN, $q);
$duty_data = mysqli_fetch_assoc($q_exe);

$clinic_open_hour = $duty_data['open_hour'];
$clinic_close_hour = $duty_data['close_hour'];
	
	
$min_hour = $clinic_open_hour;
$max_hour = $clinic_close_hour;
$cur_hour = date('G');

	//detect frame
	if($frame == 1){
		//happening now
		$min_hour = $cur_hour - 1;
		$max_hour = $cur_hour + 2;
		
		if($cur_hour == 0){
			$min_hour = 0;
		}
		
		if($cur_hour == 23 || $cur_hour == 22){
			$min_hour = 22;
			$max_hour = 23;
		}
	}
	
	if($docs_input == false){
		//load default docs
		$aq = "SELECT `employee_id` FROM `clinics_employees` WHERE ( (`is_dr` = 1) AND (`is_deleted` = '0') AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		$q_exe = mysqli_query($KONN, $aq);
		if(mysqli_num_rows($q_exe) > 0){
			$cc = 0;
			while($dr_datas = mysqli_fetch_assoc($q_exe)){
				$docs[$cc] = (int) $dr_datas['employee_id'];
				$cc++;
			}
		}
	} else {
		$cc = 0;
		foreach($docs_input AS $s_dr){
				$docs[$cc] = (int) $s_dr;
				$cc++;
			}
	}
	
?>
<div class="newCalendar">
		<section class="calendar-col time-frame">
			<div onclick="show_dr_opt(1986);" class="calendar-col-header col-settings" id="dr-col-1986">
				<span title="<?=lang('calendar_settings'); ?>" onclick="show_cal_settings();"><i class="fa fa-cogs" aria-hidden="true"></i></span>|
				<span title="<?=lang('happening_now'); ?>" onclick="change_cal_frame(1);"><i class="fa fa-clock-o" aria-hidden="true"></i></span>|
				<span title="<?=lang('show_all_day'); ?>" onclick="change_cal_frame(2);"><i class="fa fa-sun-o" aria-hidden="true"></i></span>
			</div>
		<?php for($tt=$min_hour;$tt<=$max_hour;$tt++){ ?>
			<div class="calendar-col-block">
				<span><?=$tt; ?>:00</span>
			</div>
			<div class="calendar-col-block">
				<span><?=$tt; ?>:15</span>
			</div>
			<div class="calendar-col-block">
				<span><?=$tt; ?>:30</span>
			</div>
			<div class="calendar-col-block">
				<span><?=$tt; ?>:45</span>
			</div>
		<?php } ?>	
		</section>
	
	<?php 
	for($looper=0;$looper<count($docs);$looper++){
		$dr_id = $docs[$looper];
		// *************Tawfiq passed by here (add duty_start & duty_end to select)****************
		$qFF = "SELECT `title`, `first_name`, `last_name`, `duty_start`, `duty_end` FROM `clinics_employees` WHERE ( (`is_dr` = 1) AND (`employee_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) LIMIT 1";
		$q_exeFF = mysqli_query($KONN, $qFF);
		$dr_data = mysqli_fetch_assoc($q_exeFF);
		$cols_count++;
		
		// *************Tawfiq passed by here****************
			$duty_start = $dr_data['duty_start'];
			$duty_end 	= $dr_data['duty_end'];


		//. *************Tawfiq passed by here****************
		
$chk15 = true;
$chk30 = true;
$chk45 = true;
$chk60 = true;
$chk120 = true;
	?>
		<section class="calendar-col appointment-frame" id="dr_col_<?=$dr_id; ?>">
			
			<div class="calendar-col-header" dr_id="<?=$dr_id; ?>" onclick="show_dr_opt(<?=$dr_id; ?>);" id="dr-col-<?=$dr_id; ?>">
				<span><?=$dr_data['first_name'].' '.$dr_data['last_name']; ?></span>
				<i class="fa fa-sort-desc" aria-hidden="true"></i>
				<div id="dr-opt-<?=$dr_id; ?>" class="dr-opt-mnu">
					<div onclick="remove_doc(<?=$dr_id; ?>);"><?=lang('remove'); ?></div>
				</div>
			</div>
		
		<?php 
		for($z=$min_hour;$z<=$max_hour;$z++){

			// *************Tawfiq passed by here****************
			$showed = 'cursor: not-allowed !important; background: none;';
			if (($duty_start <= $z) && ($duty_end >= $z) ) {
				$showed = '';
			}

			//. *************Tawfiq passed by here****************

			$ths_hour = $z;
			$hh = $dds = $mm = '';
			if($ths_hour < 10){$hh = '0'.$ths_hour;} else {$hh = $ths_hour;}
			if($day < 10){$dds = '0'.$day;} else {$dds = $day;}
			if($month < 10){$mm = '0'.$month;} else {$mm = $month;}
			$ths_date = $year.'-'.$mm.'-'.$dds.' '.$hh.':'.'00:00';
			
			//check if its blocked
			$qB = "SELECT COUNT(dr_id) AS az FROM `dr_blocked_times` WHERE ( (`block_time` = '".$ths_date."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			
			
			$q_exeB = mysqli_query($KONN, $qB);
			$blocked_data = mysqli_fetch_assoc($q_exeB);
			$blocked_count = $blocked_data['az'];
			
			if($blocked_count > 0){
				//time is blocked
				?>
			<div class="calendar-col-block blocked_app" onclick="slct_time_block('timeframe-<?=$z; ?>00-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>00-<?=$dr_id; ?>" status="4" dr_id="<?=$dr_id; ?>" t_min="00" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
				<span class="patient-name"><?=lang('blocked'); ?></span>
				<span class="patient-number">&nbsp;</span>
			</div>
				<?php
			} else {
				//time isnt blocked
				//check if its inside another app
				//---------------------------------------------------------------
	$contChk = true;
	$qu_clinics_appointments_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` <= '".$ths_date."') AND (`end_time_date` >= '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
	$qu_clinics_appointments_EXE = mysqli_query($KONN, $qu_clinics_appointments_sel);
	$clinics_appointments_DATA;
	if(mysqli_num_rows($qu_clinics_appointments_EXE)){
		//its inside app
		//add new HHH
		//check if this is the start
		$qu_chkStrt_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` = '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
		$qu_chkStrt_EXE = mysqli_query($KONN, $qu_chkStrt_sel);
		$chkStrt_DATA;
		// *************Tawfiq passed by here****************
		$appointment_data = mysqli_fetch_assoc($qu_chkStrt_EXE);
		
		if ($appointment_data['status'] == 1) {
			$background_color = '60B8C2';
		}elseif ($appointment_data['status'] == 2) {
			$background_color = '3F51B5';
		}elseif ($appointment_data['status'] == 3) {
			$background_color = '795548';
		}elseif ($appointment_data['status'] == 4) {
			$background_color = 'F44336';
		}elseif ($appointment_data['status'] == 5) {
			$background_color = 'FF875C';
		}elseif ($appointment_data['status'] == 6) {
			$background_color = '636F7F';
		}elseif ($appointment_data['status'] == 7) {
			$background_color = 'AFB42B';
		}else{
			$background_color = '60B8C2';
		}
		//. *************Tawfiq passed by here****************
		
		if(mysqli_num_rows($qu_chkStrt_EXE) == 0){
			$contChk = false;
		?>
<div class="calendar-col-block app-filled" onclick="" status="0">
	<span class="patient-name">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
</div>
		<?php
		}
		
	} 
	if( $contChk == true ) {
		//continue old
				//check if it has appointment
			$qAS = "SELECT * FROM `clinics_appointments` WHERE ( (`time_date` LIKE '".$ths_date."%') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exeAS = mysqli_query($KONN, $qAS);
			$app_count = mysqli_num_rows($q_exeAS);
			$app_data = mysqli_fetch_assoc($q_exeAS);
				
				if($app_count > 0){
					//app is reserved
					//check status
					switch($app_data['status']){
						case 1:
							$app_state_class = 'pending_app';
							break;
						case 2:
							$app_state_class = 'confirmed_app';
							break;
						case 3:
							$app_state_class = 'canceled_app';
							break;
						case 4:
							$app_state_class = 'blocked_app';
							break;
						case 5:
							$app_state_class = 'checkin_app';
							break;
						case 6:
							$app_state_class = 'noshow_app';
							break;
						case 7:
							$app_state_class = 'completed_app';
							break;
					}
					$procID = ( int ) $app_data['procedure_id'];
					$procName = "<br>";
					if( $procID != 0 ){
						$qu_clinics_procedures_sel = "SELECT `procedure_name` FROM  `clinics_procedures` WHERE `procedure_id` = $procID";
						$qu_clinics_procedures_EXE = mysqli_query($KONN, $qu_clinics_procedures_sel);
						if(mysqli_num_rows($qu_clinics_procedures_EXE)){
							$clinics_procedures_DATA = mysqli_fetch_assoc($qu_clinics_procedures_EXE);
							$procName = $clinics_procedures_DATA['procedure_name'];
						}
					}
					//fetch patient data
			$q = "SELECT * FROM `patients` WHERE ( (`patient_id` = ".$app_data['patient_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exe = mysqli_query($KONN, $q);
			$patient_data = mysqli_fetch_assoc($q_exe);
			$patient_name = "NA";
			$patient_mob = "NA";
			$patient_file_num = "NA";
			$patient_ID = 0;
			if( $patient_data ){
					$patient_name = $patient_data['first_name'].' '.$patient_data['last_name'];
					$patient_mob = $patient_data['mobile'];
					$patient_ID = $patient_data['patient_id'];
					$patient_file_num = $patient_data['file_num'];
			}
					?>
					<div class="calendar-col-block <?=$app_state_class; ?>" patient_file_num="<?=$patient_file_num; ?>" patient_id="<?=$patient_ID; ?>" onclick="slct_time_block('timeframe-<?=$z; ?>00-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>00-<?=$dr_id; ?>" status="<?=$app_data['status']; ?>" appointment_id="<?=$app_data['appointment_id']; ?>" dr_id="<?=$dr_id; ?>" t_min="00" t_dur="<?=$app_data['app_duration']; ?>" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
						<span class="patient-name"><?=$patient_name; ?></span>
						<span class="patient-number"><?=$patient_mob; ?></span>
						<span class="patient-number" style="color: yellow;"><?=$procName; ?></span>
					</div>
					<?php
					
				} else {
					//time is free
					?>
					<div class="calendar-col-block" onclick="slct_time_block('timeframe-<?=$z; ?>00-<?=$dr_id; ?>');" status="0" id="timeframe-<?=$z; ?>00-<?=$dr_id; ?>" dr_id="<?=$dr_id; ?>" t_min="00" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>" 
						style="<?= $showed?>">
						<span class="patient-name">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
					</div>
					<?php
				//end of else for app if
				}
		
		
		
	} // end of app inside check

				
				
				
				
				
				
			//end of else for blocked if
			}
			
			
		//other sec ----------------------------------------------------------------- 00:15
			$ths_hour = $z;
			$hh = $dds = $mm = '';
			if($ths_hour < 10){$hh = '0'.$ths_hour;} else {$hh = $ths_hour;}
			if($day < 10){$dds = '0'.$day;} else {$dds = $day;}
			if($month < 10){$mm = '0'.$month;} else {$mm = $month;}
			$ths_date = $year.'-'.$mm.'-'.$dds.' '.$hh.':'.'15:00';
			
			//check if its blocked
			$qB = "SELECT COUNT(dr_id) AS az FROM `dr_blocked_times` WHERE ( (`block_time` = '".$ths_date."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			
			
			$q_exeB = mysqli_query($KONN, $qB);
			$blocked_data = mysqli_fetch_assoc($q_exeB);
			$blocked_count = $blocked_data['az'];
			
			
			if($blocked_count > 0){
				//time is blocked
				?>
			<div class="calendar-col-block blocked_app" onclick="slct_time_block('timeframe-<?=$z; ?>15-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>15-<?=$dr_id; ?>" status="4" dr_id="<?=$dr_id; ?>" t_min="15" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
				<span class="patient-name"><?=lang('blocked'); ?></span>
				<span class="patient-number">&nbsp;</span>
				<span class="patient-number">&nbsp;</span>
			</div>
				<?php
			} else {
				//time isnt blocked
				//check if its inside another app
				//---------------------------------------------------------------
	$contChk = true;
	$qu_clinics_appointments_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` <= '".$ths_date."') AND (`end_time_date` >= '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
		//echo $qu_clinics_appointments_sel;
	$qu_clinics_appointments_EXE = mysqli_query($KONN, $qu_clinics_appointments_sel);
	$clinics_appointments_DATA;
	if(mysqli_num_rows($qu_clinics_appointments_EXE)){
		//its inside app
		//add new HHH
		//check if this is the start
		$qu_chkStrt_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` = '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
		$qu_chkStrt_EXE = mysqli_query($KONN, $qu_chkStrt_sel);
		$chkStrt_DATA;
		// echo $background_color;
		if(mysqli_num_rows($qu_chkStrt_EXE) == 0){
			$contChk = false;
		?>
<!--  *************Tawfiq passed by here**************** -->
<div class="calendar-col-block app-filled" style="background: #<?= $background_color ?> !important;" onclick="" status="0">
	<span class="patient-name">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
</div>
		<?php
		}
		
	} 
	if( $contChk == true ) {
		//continue old
				
				//check if it has appointment
			$q = "SELECT * FROM `clinics_appointments` WHERE ( (`time_date` LIKE '".$ths_date."%') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exe = mysqli_query($KONN, $q);
			$app_count = mysqli_num_rows($q_exe);
			$app_data = mysqli_fetch_assoc($q_exe);
				
				if($app_count > 0){
					//app is reserved
					//check status
					switch($app_data['status']){
						case 1:
							$app_state_class = 'pending_app';
							break;
						case 2:
							$app_state_class = 'confirmed_app';
							break;
						case 3:
							$app_state_class = 'canceled_app';
							break;
						case 4:
							$app_state_class = 'blocked_app';
							break;
						case 5:
							$app_state_class = 'checkin_app';
							break;
						case 6:
							$app_state_class = 'noshow_app';
							break;
						case 7:
							$app_state_class = 'completed_app';
							break;
					}
					$procID = ( int ) $app_data['procedure_id'];
					$procName = "<br>";
					if( $procID != 0 ){
						$qu_clinics_procedures_sel = "SELECT `procedure_name` FROM  `clinics_procedures` WHERE `procedure_id` = $procID";
						$qu_clinics_procedures_EXE = mysqli_query($KONN, $qu_clinics_procedures_sel);
						if(mysqli_num_rows($qu_clinics_procedures_EXE)){
							$clinics_procedures_DATA = mysqli_fetch_assoc($qu_clinics_procedures_EXE);
							$procName = $clinics_procedures_DATA['procedure_name'];
						}
					}
					//fetch patient data
			$q = "SELECT * FROM `patients` WHERE ( (`patient_id` = ".$app_data['patient_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exe = mysqli_query($KONN, $q);
			$patient_data = mysqli_fetch_assoc($q_exe);
					$patient_name = $patient_data['first_name'].' '.$patient_data['last_name'];
					$patient_mob = $patient_data['mobile'];
					
					?>
					<div class="calendar-col-block <?=$app_state_class; ?>" patient_file_num="<?=$patient_data['file_num']; ?>" patient_id="<?=$patient_data['patient_id']; ?>" onclick="slct_time_block('timeframe-<?=$z; ?>15-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>15-<?=$dr_id; ?>" status="<?=$app_data['status']; ?>" appointment_id="<?=$app_data['appointment_id']; ?>" dr_id="<?=$dr_id; ?>" t_min="15" t_dur="<?=$app_data['app_duration']; ?>" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
						<span class="patient-name"><?=$patient_name; ?></span>
						<span class="patient-number"><?=$patient_mob; ?></span>
						<span class="patient-number" style="color: yellow;"><?=$procName; ?></span>
					</div>
					<?php
					
				} else {
					//time is free
					?>
					<div class="calendar-col-block" onclick="slct_time_block('timeframe-<?=$z; ?>15-<?=$dr_id; ?>');" status="0" id="timeframe-<?=$z; ?>15-<?=$dr_id; ?>" dr_id="<?=$dr_id; ?>" t_min="15" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>" style="<?= $showed?>">
						<span class="patient-name">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
					</div>
					<?php
				//end of else for app if
				}
		
	} // end of app inside check
				
				
				
				
				
				
				
				
				
				
				
			//end of else for blocked if
			}
			//---------------------------------------------------- 00:15
			
		//other sec ----------------------------------------------------------------- 00:30
			$ths_hour = $z;
			$hh = $dds = $mm = '';
			if($ths_hour < 10){$hh = '0'.$ths_hour;} else {$hh = $ths_hour;}
			if($day < 10){$dds = '0'.$day;} else {$dds = $day;}
			if($month < 10){$mm = '0'.$month;} else {$mm = $month;}
			$ths_date = $year.'-'.$mm.'-'.$dds.' '.$hh.':'.'30:00';
			
			//check if its blocked
			$qB = "SELECT COUNT(dr_id) AS az FROM `dr_blocked_times` WHERE ( (`block_time` = '".$ths_date."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			
			
			$q_exeB = mysqli_query($KONN, $qB);
			$blocked_data = mysqli_fetch_assoc($q_exeB);
			$blocked_count = $blocked_data['az'];
			
			
			if($blocked_count > 0){
				//time is blocked
				?>
			<div class="calendar-col-block blocked_app" onclick="slct_time_block('timeframe-<?=$z; ?>30-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>30-<?=$dr_id; ?>" status="4" dr_id="<?=$dr_id; ?>" t_min="30" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
				<span class="patient-name"><?=lang('blocked'); ?></span>
				<span class="patient-number">&nbsp;</span>
				<span class="patient-number">&nbsp;</span>
			</div>
				<?php
			} else {
				//time isnt blocked
				//check if its inside another app
				//---------------------------------------------------------------
	$contChk = true;
	$qu_clinics_appointments_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` <= '".$ths_date."') AND (`end_time_date` >= '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
	$qu_clinics_appointments_EXE = mysqli_query($KONN, $qu_clinics_appointments_sel);
	$clinics_appointments_DATA;

	// *************Tawfiq passed by here****************
	$appointment_data = mysqli_fetch_assoc($qu_clinics_appointments_EXE);
		if ($appointment_data['status'] == 1) {
			$background_color = '60B8C2';
		}elseif ($appointment_data['status'] == 2) {
			$background_color = '3F51B5';
		}elseif ($appointment_data['status'] == 3) {
			$background_color = '795548';
		}elseif ($appointment_data['status'] == 4) {
			$background_color = 'F44336';
		}elseif ($appointment_data['status'] == 5) {
			$background_color = 'FF875C';
		}elseif ($appointment_data['status'] == 6) {
			$background_color = '636F7F';
		}elseif ($appointment_data['status'] == 7) {
			$background_color = 'AFB42B';
		}else{
			$background_color = '60B8C2';
		}
		// *************Tawfiq passed by here****************
	if(mysqli_num_rows($qu_clinics_appointments_EXE)){
		//its inside app
		//add new HHH
		//check if this is the start
		$qu_chkStrt_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` = '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
		$qu_chkStrt_EXE = mysqli_query($KONN, $qu_chkStrt_sel);
		$chkStrt_DATA;
		

		if(mysqli_num_rows($qu_chkStrt_EXE) == 0){
			$contChk = false;
		?>
		<!--  *************Tawfiq passed by here**************** -->
<div class="calendar-col-block app-filled" style="background:#<?=$background_color?> !important;" onclick="" status="0">
	<span class="patient-name">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
</div>
		<?php
		}
		
		
	} 
	if( $contChk == true ) {
		//continue old
				//check if it has appointment
			$q = "SELECT * FROM `clinics_appointments` WHERE ( (`time_date` LIKE '".$ths_date."%') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exe = mysqli_query($KONN, $q);
			$app_count = mysqli_num_rows($q_exe);
			$app_data = mysqli_fetch_assoc($q_exe);
				
				if($app_count > 0){
					//app is reserved
					//check status
					switch($app_data['status']){
						case 1:
							$app_state_class = 'pending_app';
							break;
						case 2:
							$app_state_class = 'confirmed_app';
							break;
						case 3:
							$app_state_class = 'canceled_app';
							break;
						case 4:
							$app_state_class = 'blocked_app';
							break;
						case 5:
							$app_state_class = 'checkin_app';
							break;
						case 6:
							$app_state_class = 'noshow_app';
							break;
						case 7:
							$app_state_class = 'completed_app';
							break;
					}
					$procID = ( int ) $app_data['procedure_id'];
					$procName = "<br>";
					if( $procID != 0 ){
						$qu_clinics_procedures_sel = "SELECT `procedure_name` FROM  `clinics_procedures` WHERE `procedure_id` = $procID";
						$qu_clinics_procedures_EXE = mysqli_query($KONN, $qu_clinics_procedures_sel);
						if(mysqli_num_rows($qu_clinics_procedures_EXE)){
							$clinics_procedures_DATA = mysqli_fetch_assoc($qu_clinics_procedures_EXE);
							$procName = $clinics_procedures_DATA['procedure_name'];
						}
					}
					//fetch patient data
			$q = "SELECT * FROM `patients` WHERE ( (`patient_id` = ".$app_data['patient_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exe = mysqli_query($KONN, $q);
			$patient_data = mysqli_fetch_assoc($q_exe);
			$patient_name = "NA";
			$patient_mob = "NA";
			$patient_file_num = "NA";
			$patient_ID = 0;
			if( $patient_data ){
					$patient_name = $patient_data['first_name'].' '.$patient_data['last_name'];
					$patient_mob = $patient_data['mobile'];
					$patient_ID = $patient_data['patient_id'];
					$patient_file_num = $patient_data['file_num'];
			}
					?>
					<div class="calendar-col-block <?=$app_state_class; ?>" patient_file_num="<?=$patient_file_num; ?>" patient_id="<?=$patient_ID; ?>" onclick="slct_time_block('timeframe-<?=$z; ?>30-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>30-<?=$dr_id; ?>" status="<?=$app_data['status']; ?>" appointment_id="<?=$app_data['appointment_id']; ?>" dr_id="<?=$dr_id; ?>" t_min="30" t_dur="<?=$app_data['app_duration']; ?>" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
						<span class="patient-name"><?=$patient_name; ?></span>
						<span class="patient-number"><?=$patient_mob; ?></span>
						<span class="patient-number" style="color: yellow;"><?=$procName; ?></span>
					</div>
					<?php
					
				} else {
					//time is free
					?>
					<div class="calendar-col-block" onclick="slct_time_block('timeframe-<?=$z; ?>30-<?=$dr_id; ?>');" status="0" id="timeframe-<?=$z; ?>30-<?=$dr_id; ?>" dr_id="<?=$dr_id; ?>" t_min="30" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>" style="<?= $showed?>">
						<span class="patient-name">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
					</div>
					<?php
				//end of else for app if
				}
		
	} // end of app inside check
	
				
				
				
			//end of else for blocked if
			}
			//---------------------------------------------------- 00:30
			
			
			
			
			
		//other sec ----------------------------------------------------------------- 00:45
			$ths_hour = $z;
			$hh = $dds = $mm = '';
			if($ths_hour < 10){$hh = '0'.$ths_hour;} else {$hh = $ths_hour;}
			if($day < 10){$dds = '0'.$day;} else {$dds = $day;}
			if($month < 10){$mm = '0'.$month;} else {$mm = $month;}
			$ths_date = $year.'-'.$mm.'-'.$dds.' '.$hh.':'.'45:00';
			
			//check if its blocked
			$qB = "SELECT COUNT(dr_id) AS az FROM `dr_blocked_times` WHERE ( (`block_time` = '".$ths_date."') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			
			
			$q_exeB = mysqli_query($KONN, $qB);
			$blocked_data = mysqli_fetch_assoc($q_exeB);
			$blocked_count = $blocked_data['az'];
			
			
			if($blocked_count > 0){
				//time is blocked
				?>
			<div class="calendar-col-block blocked_app" onclick="slct_time_block('timeframe-<?=$z; ?>45-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>45-<?=$dr_id; ?>" status="4" dr_id="<?=$dr_id; ?>" t_min="45" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
				<span class="patient-name"><?=lang('blocked'); ?></span>
				<span class="patient-number">&nbsp;</span>
				<span class="patient-number">&nbsp;</span>
			</div>
				<?php
			} else {
				//time isnt blocked
				//check if its inside another app
				//---------------------------------------------------------------
	$contChk = true;
	$qu_clinics_appointments_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` <= '".$ths_date."') AND (`end_time_date` >= '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
	$qu_clinics_appointments_EXE = mysqli_query($KONN, $qu_clinics_appointments_sel);
	$clinics_appointments_DATA;
	if(mysqli_num_rows($qu_clinics_appointments_EXE)){
		//its inside app
		//add new HHH
		//check if this is the start
		$qu_chkStrt_sel = "SELECT * FROM  `clinics_appointments` WHERE ( 
											( (`time_date` = '".$ths_date."') )
											AND (`dr_id` = ".$dr_id.") 
											AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
		$qu_chkStrt_EXE = mysqli_query($KONN, $qu_chkStrt_sel);
		$chkStrt_DATA;
		
		if(mysqli_num_rows($qu_chkStrt_EXE) == 0){
			$contChk = false;
		?>
<div class="calendar-col-block app-filled" onclick="" status="0">
	<span class="patient-name">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
	<span class="patient-number">&nbsp;</span>
</div>
		<?php
		}
		
		
	} 
	if( $contChk == true ) {
		//continue old
				//check if it has appointment
			$q = "SELECT * FROM `clinics_appointments` WHERE ( (`time_date` LIKE '".$ths_date."%') AND (`dr_id` = ".$dr_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exe = mysqli_query($KONN, $q);
			$app_count = mysqli_num_rows($q_exe);
			$app_data = mysqli_fetch_assoc($q_exe);
				
				if($app_count > 0){
					//app is reserved
					//check status
					switch($app_data['status']){
						case 1:
							$app_state_class = 'pending_app';
							break;
						case 2:
							$app_state_class = 'confirmed_app';
							break;
						case 3:
							$app_state_class = 'canceled_app';
							break;
						case 4:
							$app_state_class = 'blocked_app';
							break;
						case 5:
							$app_state_class = 'checkin_app';
							break;
						case 6:
							$app_state_class = 'noshow_app';
							break;
						case 7:
							$app_state_class = 'completed_app';
							break;
					}
					$procID = ( int ) $app_data['procedure_id'];
					$procName = "<br>";
					if( $procID != 0 ){
						$qu_clinics_procedures_sel = "SELECT `procedure_name` FROM  `clinics_procedures` WHERE `procedure_id` = $procID";
						$qu_clinics_procedures_EXE = mysqli_query($KONN, $qu_clinics_procedures_sel);
						if(mysqli_num_rows($qu_clinics_procedures_EXE)){
							$clinics_procedures_DATA = mysqli_fetch_assoc($qu_clinics_procedures_EXE);
							$procName = $clinics_procedures_DATA['procedure_name'];
						}
					}
					//fetch patient data
			$q = "SELECT * FROM `patients` WHERE ( (`patient_id` = ".$app_data['patient_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
			$q_exe = mysqli_query($KONN, $q);
			$patient_data = mysqli_fetch_assoc($q_exe);
					$patient_name = $patient_data['first_name'].' '.$patient_data['last_name'];
					$patient_mob = $patient_data['mobile'];
					
					?>
					<div class="calendar-col-block <?=$app_state_class; ?>" patient_file_num="<?=$patient_data['file_num']; ?>" patient_id="<?=$patient_data['patient_id']; ?>" onclick="slct_time_block('timeframe-<?=$z; ?>45-<?=$dr_id; ?>');" id="timeframe-<?=$z; ?>45-<?=$dr_id; ?>" status="<?=$app_data['status']; ?>" appointment_id="<?=$app_data['appointment_id']; ?>" dr_id="<?=$dr_id; ?>" t_min="45" t_dur="<?=$app_data['app_duration']; ?>" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>">
						<span class="patient-name"><?=$patient_name; ?></span>
						<span class="patient-number"><?=$patient_mob; ?></span>
						<span class="patient-number" style="color: yellow;"><?=$procName; ?></span>
					</div>
					<?php
					
				} else {
					//time is free
					?>
					<div class="calendar-col-block" onclick="slct_time_block('timeframe-<?=$z; ?>45-<?=$dr_id; ?>');" status="0" id="timeframe-<?=$z; ?>45-<?=$dr_id; ?>" dr_id="<?=$dr_id; ?>" t_min="45" t_hour="<?=$z; ?>" t_day="<?=$day; ?>" t_month="<?=$month; ?>" t_year="<?=$year; ?>" title="<?=lang('Click_To_View_Details'); ?>" style="<?= $showed?>">
						<span class="patient-name">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
						<span class="patient-number">&nbsp;</span>
					</div>
					<?php
				//end of else for app if
				}
		
	} // end of app inside check
				
				
				
				
			//end of else for blocked if
			}
			//---------------------------------------------------- 00:45
			
			
			
			
			
			
			
			
			
			
		}
		?>	
			
		</section>
	<?php } ?>

</div>
<section id="calendar_settings" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('calendar_settings'); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
<?php

function is_doc_slcted($dr_id, $dr_array){
	$is_there = 0;
	foreach($dr_array AS $db_dr){
		if($dr_id == $db_dr){
			$is_there++;
		}
	}
	if($is_there > 0){
		return true;
	} else {
		return false;
	}
}



		$qZX = "SELECT `employee_id` AS dr_id, CONCAT(`first_name`, ' ', `last_name`) AS dr_name FROM `clinics_employees` WHERE ( (`is_dr` = 1) AND (`is_deleted` = '0') AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		$q_exeZX = mysqli_query($KONN, $qZX);
		
			
			
		if(mysqli_num_rows($q_exeZX) > 0){
			while($dr_datas = mysqli_fetch_assoc($q_exeZX)){
				$doc_id = (int) $dr_datas['dr_id'];
				$doc_name = $dr_datas['dr_name'];
				$inputer = '';
				?>
<div class="form-control">
	<label><?=$doc_name.' dsdsds'; ?></label>
				<?php
				if(is_doc_slcted($doc_id , $docs) == true){
					//doctor is selected
					?>
					<input class="cal_docs" id="cal_doc_<?=$doc_id; ?>" is_selected="1" onclick="toggle_doc(<?=$doc_id; ?>);" dr_id="<?=$doc_id; ?>" type="checkbox" checked>
					<?php
				} else {
					?>
					<input class="cal_docs" id="cal_doc_<?=$doc_id; ?>" is_selected="0" onclick="toggle_doc(<?=$doc_id; ?>);" dr_id="<?=$doc_id; ?>" type="checkbox">
					<?php
				}
				
		?>
</div>
		<?php
			}
		}
		
?>
<div class="form-control">
	<button type="button" onclick="hide_modal();load_calendar();"><?=lang('Save'); ?></button>
	<button type="button" onclick="hide_modal();"><?=lang('Cancel'); ?></button>
</div>

	</section>
</section>

<script>
cal_day = <?=$day; ?>;
cal_month = <?=$month; ?>;
cal_year = <?=$year; ?>;
cal_frame_setting = <?=$frame; ?>;



<?php
$res = 0;
switch ($cols_count){
	case 12:
		$res = 7.5;
		break;
	case 11:
		$res = 7;
		break;
	case 10:
		$res = 8;
		break;
	case 9:
		$res = 10;
		break;
	case 8:
		$res = 11;
		break;
	case 7:
		$res = 12;
		break;
	case 6:
		$res = 14;
		break;
	case 5:
		$res = 16;
		break;
	case 4:
		$res = 19;
		break;
	case 3:
		$res = 24;
		break;
	case 2:
		$res = 32;
		break;
	case 1:
		$res = 48;
		break;
	default :
		$res = 8;
		break;
}

?>

var ss = <?=$res; ?>;
$('.calendar-col').css('width', '' + ss + '%');
</script>

<?php

	
} else {
			die('0|ERROR no : 56468fesaew');
}











			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>