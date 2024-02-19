<?php
require_once('../../bootstrap/app_config.php');


	session_start();

	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){
			
			
			
			
if( isset($_POST['opt']) ){
	$employee_id = 0;
//data collection

	$opt = (int) test_inputs($_POST['opt']);
	
	if($opt == 1){
?>
		<h1><i class="fa fa-user" area-hidden="true"></i><br><?php echo $_SESSION['user_name']; ?></h1>
		
		<ul id="user-opt-menu">
			<li><a href="#"><?=lang('my_profile'); ?></a></li>
			<li><a href="logout.php"><?=lang('Log_out'); ?></a></li>
		</ul>
		

<?php
	} elseif($opt == 2) {
		//$_SESSION['usr_id']
		$q = "SELECT * FROM `employees_notifications` WHERE ( (`employee_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ORDER BY `notification_time` DESC  LIMIT 10";
		$q_exe = mysqli_query($KONN, $q);
		
		$num_records = mysqli_num_rows($q_exe);
		
		
?>
		<h1><i class="fa fa-bell-o" area-hidden="true"></i><br><?=lang('my_notifications'); ?></h1>
		
		<ul id="user-opt-menu">
		
		<?php 
		if($num_records > 0){
			while($row = mysqli_fetch_assoc($q_exe)){ 
		?>
			<li is_seen="<?=$row['is_seen']; ?>"><a href="<?=$row['notification_link']; ?>">
				<p style="text-align:left;"><strong><?=$row['notification_title']; ?> :</strong><br><?=$row['notification_content']; ?></p>
			</a></li>
		<?php 
			}
		} else {
		?>
			<li>
				<p style="text-align:left;"><strong><?=lang('no_notifications'); ?></strong><br></p>
			</li>
		<?php
		}
		?>
		
		</ul>
		

<?php
	} elseif($opt == 3) {
		//$_SESSION['usr_id']
		$q = "SELECT * FROM `employees_tasks` WHERE ( (`to_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ORDER BY `task_time` DESC  LIMIT 10";
		$q_exe = mysqli_query($KONN, $q);
		$num_records = mysqli_num_rows($q_exe);
?>

		<h1><i class="fa fa-list-ol" area-hidden="true"></i><br><?=lang('my_tasks'); ?></h1>
		<ul id="user-opt-menu">
		<?php 
		if($num_records > 0){
			while($row = mysqli_fetch_assoc($q_exe)){
			$sender = $row['from_id'];
		$qSD = "SELECT * FROM `clinics_employees` WHERE ( (`employee_id` = ".$sender.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) LIMIT 1";
		$q_exeSD = mysqli_query($KONN, $qSD);
		$sender_data = mysqli_fetch_assoc($q_exeSD);
		$sender_name = $sender_data['first_name'].' '.$sender_data['last_name'];
			
			$done_state = ($row['is_done'] == '0') ? lang('Not_Finished') : lang('Finished_AT').' '.$row['done_at'];
			$priority = $row['priority'];
			$task_time = $row['task_time'];
			$deadline = $row['deadline'];
			$priority_color = 'red';
			$priority_class = 'star-o';
			
			switch($priority){
				case '0'://low
					$priority_class = 'star-o';
					$priority_color = 'blue';
					break;
				case '1'://normal
					$priority_class = 'star-half-o';
					$priority_color = 'brown';
					break;
				case '2'://high
					$priority_class = 'exclamation-triangle';
					$priority_color = 'red';
					break;
			}
			
			if($row['is_done'] == '1'){
				$priority_class = 'check';
				$priority_color = 'green';
			}
			
			
		?>
			<li class="emp_task">
			<i style="color:<?=$priority_color; ?>;" class="fa fa-<?=$priority_class; ?>" aria-hidden="true"></i>
			<a>
				<p style="text-align:left;"><strong><?=$sender_name; ?> ( <b style="color:var(--color-01);"><?=$done_state; ?></b> ):</strong><br><?=$row['task_content']; ?></p>
			<?php if($row['is_done'] == '0'){ ?>
				<button type="button" onclick="mark_task_as_done(<?=$row['task_id']; ?>)"><?=lang('Mark_as_done'); ?></button>
			<?php } ?>
			</a>
			<div class="zero"></div>
			</li>
		
		<?php 
			}
		?>
			
		<?php
		} else {
		?>
			<li>
				<p style="text-align:left;"><strong><?=lang('no_tasks'); ?></strong><br></p>
			</li>
		<?php
		}
		?>
		</ul>
		

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