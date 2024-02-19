<?php
require_once('bootstrap/app_config.php');
$page_title = lang("accredited labs List", 'قائمة المختبرات المعتمدة', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 132654;
$sub_id = 1;


	session_start();
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
	<li id="mob-mnu-btn" class="mob-mnu-button" onclick="show_main_menu();" title="<?=lang('show_main_menu'); ?>">
		<i class="fa fa-bars" area-hidden="true"></i>
	</li>
	<h1><?=$page_title; ?></h1>
	
	<section class="page-options">
		<button type="button" onclick="show_modal('nw_lab');"><?=lang('add_new_lab', 'إضافة مختبر جديد', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder">


<table>
	<thead>
		<tr>
			<td><?=lang('lab_id', 'المعرف', 1); ?></td>
			<td><?=lang('lab_name', 'اسم المختبر', 1); ?></td>
			<td><?=lang('lab_exams_count', 'عدد الفحوصات', 1); ?></td>
			<td><?=lang('options', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>

<?php
$Q = "SELECT * FROM `clinics_labs` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	$cou = 2;
	while($rec = mysqli_fetch_assoc($QEXE)){
		
		$Q1 = "SELECT COUNT(`lab_id`) FROM `clinics_labs_exams` WHERE ( (`lab_id` = ".$rec['lab_id'].") )";
		$QEXE1 = mysqli_query($KONN, $Q1);
		$NUM_REC = mysqli_fetch_array($QEXE1);
		$NUM_REC = $NUM_REC[0];
		
		
?>
		<tr>
			<td><?=$rec['lab_id']; ?></td>
			<td><?=$rec['lab_name']; ?></td>
			<td><?=$NUM_REC; ?></td>
			<td>
				<form method="post" action="clinic_lab_file.php" id="pat_frm_view<?=$rec['lab_id']; ?>" style="display:none;">
					<input type="hidden" name="p_id" value="<?=$rec['lab_id']; ?>">
				</form>
				<button type="button" onclick="$('#pat_frm_view<?=$rec['lab_id']; ?>').submit();"><?=lang('view', 'تحرير', 1); ?></button>
			</td>
		</tr>
<?php

	}
} else {

?>
	<tr>
		<td colspan="4"><?=lang('No_Data_Found', 'لا توجد بيانات', 1); ?></td>
	</tr>
<?php
}
?>
	</tbody>
</table>
	

	
	
	
</section>
<br>

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
			header('location:'.$go_to.'?fail=444');	
			}
	} else {
			header('location:'.$go_to.'?fail=333');	
	}
?>
