<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['teeth_no']) && 
	isset($_POST['patient_id']) 
	){
		
	$patient_id = 0;
//data collection

	$patient_id = (int) test_inputs($_POST['patient_id']);
	$teeth_no = (int) test_inputs($_POST['teeth_no']);
	
	if($patient_id != 0 && $teeth_no != 0){
		
		$q = "SELECT * FROM `patients_teeth_proc` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `teeth_no` = ".$teeth_no."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ";
		$q_exe = mysqli_query($KONN, $q);
		
?>
<br>
<table>
	<thead>
		<tr>
			<td><?=lang('teeth_no'); ?></td>
			<td><?=lang('procedure'); ?></td>
			<td><?=lang('doctor'); ?></td>
			<td><?=lang('date'); ?></td>
			<td><?=lang('note'); ?></td>
		</tr>
	</thead>
	<tbody>
		
<?php	
		if(mysqli_num_rows($q_exe) > 0){
			
			while($db_data = mysqli_fetch_assoc($q_exe)){
		
		
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['dr_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$doctor_db = mysqli_fetch_array($QEXE1);
?>
		<tr>
			<td><?=$db_data['teeth_no']; ?></td>
			<td><?=$db_data['procedure_name']; ?></td>
			<td><?=$doctor_db[0]; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$db_data['note']; ?></td>
		</tr>
<?php
			}
			?>
			
			<?php
		} else {
?>
		<tr>
			<td colspan="5"><?=lang('No_Records_Found'); ?></td>
		</tr>
<?php
		}
?>

	</tbody>
</table>
<br>
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
