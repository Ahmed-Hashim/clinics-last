<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['op']) ){
		
//data collection
	$op = (int) test_inputs($_POST['op']);
	$typer = '';
	$selctr = '';
	if($op == 1){
		$typer = 'medication';
		$selctr = 'medication';
	} elseif($op == 2){
		$typer = 'item';
		$selctr = 'item';
	} elseif($op == 3){
		$typer = 'labs_exam';
		$selctr = 'lab_exam';
	}
		$q = "SELECT * FROM `clinics_".$typer."s` WHERE ((`clinic_id` = ".$_SESSION['clinic_id']."))";
		$qee = mysqli_query($KONN, $q);
		$counts = mysqli_num_rows($qee);
		
		if($counts > 0){
?>
			<option value="0" selected><?=lang('select_item'); ?></option>
<?php
			while($dp_data = mysqli_fetch_assoc($qee)){
?>
	<option value="<?=$dp_data[$selctr.'_id']; ?>" id="slctd_item_<?=$dp_data[$selctr.'_id']; ?>"><?=$dp_data[$selctr.'_name']; ?></option>
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
