<?php
	session_start();
require_once('bootstrap/app_config.php');
$page_title = lang("Dashboard", 'لوحة التحكم', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 1;
$sub_id = 2;


	$go_to = "index.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}



	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){
?>
<!DOCTYPE html>
<html dir="<?=$lang_dir; ?>" lang="<?=$lang; ?>">
  <head>
	<?php include(main_app_url.'app/meta.php'); ?>
    <?php include(main_app_url.'app/assets.php'); ?>
	
  </head>
	<body>
<?php
	include(main_app_url.'app/header.php');
	//PAGE DATA START ----------------------------------------------///---------------------------------
?>
<?php if($show_page_title == true){ ?>
<section class="page-title">
	<li id="mob-mnu-btn" class="mob-mnu-button" onclick="show_main_menu();" title="<?=lang('show_main_menu', 'عرض القائمة الرئيسية', 1); ?>">
		<i class="fa fa-bars" area-hidden="true"></i>
	</li>
	<h1><?=$page_title; ?></h1>
	
	<section class="page-options">
		
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>


<div id="dashboard_page_div" style="background:url('<?=image_root; ?>bg.jpg') no-repeat 0 0;background-size: 100% 100%;">
<br>
<section class="panel panel-half panel-blue">
	<section class="panel-header">
		<?=lang('today_date', 'تاريخ اليوم', 1); ?>
	</section>
	<section class="panel-body dater">
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('day', 'يوم', 1); ?></div>
			<div class="info-tip-data"><?=date('d'); ?></div>
		</div>
		<div class="date-sep">-</div>
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('month', 'شهر', 1); ?></div>
			<div class="info-tip-data"><?=date('m'); ?></div>
		</div>
		<div class="date-sep">-</div>
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('year', 'سنة', 1); ?></div>
			<div class="info-tip-data"><?=date('Y'); ?></div>
		</div>
		
	</section>
</section>



<?php
$tod = date('Y-m-d');


$q = "SELECT COUNT(appointment_id) AS tot_completed_app FROM `clinics_appointments` WHERE ( (`status` = 7) AND  (`time_date` LIKE '%".$tod."%') AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$tot_completed_app = $q_row['tot_completed_app'];


$q = "SELECT COUNT(patient_id) AS tot_new_patients FROM `patients` WHERE ( (`reg_date` LIKE '%".$tod."%') AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$tot_new_patients = $q_row['tot_new_patients'];

?>

<a href="patient_list.php">
<section class="panel panel-half panel-orange">
	<section class="panel-header">
		<?=lang('patients'); ?>
	</section>
	<section class="panel-body">
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('treated', 'معالج', 1); ?></div>
			<div class="info-tip-data"><?=$tot_completed_app; ?></div>
		</div>
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('new_patients', 'مرضى جدد', 1); ?></div>
			<div class="info-tip-data"><?=$tot_new_patients; ?></div>
		</div>
		
	</section>
</section>
</a>





<br>





<?php

$q = "SELECT COUNT(employee_id) AS not_counts FROM `employees_notifications` WHERE ( (`is_seen` = 0) AND (`employee_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$notifications_unseen = $q_row['not_counts'];

$q = "SELECT COUNT(to_id) AS tasks_counts FROM `employees_tasks` WHERE ( (`is_done` = 0) AND (`to_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$tasks_counts = $q_row['tasks_counts'];

?>
	
	
<section onclick="show_opt(2);" class="panel panel-quarter panel-purple">
	<section class="panel-header">
		<?=lang('Notifications', 'الاشعارات', 1); ?>
	</section>
	<section class="panel-body">
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('new', 'جديدة', 1); ?></div>
			<div class="info-tip-data"><?=$notifications_unseen; ?></div>
		</div>
		
	</section>
</section>



<?php
$tod = date('Y-m-d');
$q = "SELECT COUNT(task_id) AS task_counts_tot FROM `employees_tasks` WHERE ( (`task_time` LIKE '%".$tod."%') AND (`to_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$task_counts_tot = $q_row['task_counts_tot'];

$q = "SELECT COUNT(to_id) AS task_counts_done FROM `employees_tasks` WHERE ( (`is_done` = 1) AND (`task_time` LIKE '%".$tod."%') AND (`to_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$task_counts_done = $q_row['task_counts_done'];

?>
	
<section onclick="show_opt(3);" class="panel panel-half panel-brown">
	<section class="panel-header">
		<?=lang("today's_tasks", 'المهام اليومية', 1); ?>
	</section>
	<section class="panel-body">
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('total', 'المجموع', 1); ?></div>
			<div class="info-tip-data"><?=$task_counts_tot; ?></div>
		</div>
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('done', 'المنتهية', 1); ?></div>
			<div class="info-tip-data"><?=$task_counts_done; ?></div>
		</div>
		
	</section>
</section>




<?php
$tod = date('Y-m-d');
$q = "SELECT COUNT(appointment_id) AS tot_reserved_app FROM `clinics_appointments` WHERE ( (`time_date` LIKE '%".$tod."%') AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$tot_reserved_app = $q_row['tot_reserved_app'];

$q = "SELECT COUNT(appointment_id) AS tot_confirmed_app FROM `clinics_appointments` WHERE ( ((`status` = 2) OR (`status` = 5)) AND  (`time_date` LIKE '%".$tod."%') AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$tot_confirmed_app = $q_row['tot_confirmed_app'];

$q = "SELECT COUNT(appointment_id) AS tot_canceled_app FROM `clinics_appointments` WHERE ( ((`status` = 3) OR (`status` = 6)) AND  (`time_date` LIKE '%".$tod."%') AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$tot_canceled_app = $q_row['tot_canceled_app'];

?>


<a href="calendar.php">
<section class="panel panel-half panel-lime">
	<section class="panel-header">
		<?=lang('today_appointments', 'مواعيد اليوم', 1); ?>
	</section>
	<section class="panel-body">
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('reserved', 'المحجوزة', 1); ?></div>
			<div class="info-tip-data"><?=$tot_reserved_app; ?></div>
		</div>
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('confirmed', 'المؤكدة', 1); ?></div>
			<div class="info-tip-data"><?=$tot_confirmed_app; ?></div>
		</div>
		
		<div class="info-tip">
			<div class="info-tip-title"><?=lang('canceled', 'الملغية', 1); ?></div>
			<div class="info-tip-data"><?=$tot_canceled_app; ?></div>
		</div>
		
	</section>
</section>
</a>
<br>
<br>


</div>
<?php
	//PAGE DATA END   ----------------------------------------------///---------------------------------
	include(main_app_url.'app/footer.php');
?>
	</body>
</html>
<?php
			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			} else {
			header('location:'.$go_to.'?fail=444132');	
			}
	} else {
			header('location:'.$go_to.'?fail=333123');	
	}
?>
