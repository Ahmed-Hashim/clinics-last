<?php
require_once('bootstrap/app_config.php');
$page_title = lang("insurance companies List", 'قائمة شركات التأمين المعتمدة', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 66;
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
	<li id="mob-mnu-btn" class="mob-mnu-button" onclick="show_main_menu();" title="<?=lang('show_main_menu', 'القائمة الرئيسية', 1); ?>">
		<i class="fa fa-bars" area-hidden="true"></i>
	</li>
	<h1><?=lang($page_title); ?></h1>
	
	<section class="page-options">
		<button type="button" onclick="show_modal('nw_insurance_company');"><?=lang('new_insurance_company', 'إضافة شركة جديدة', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder">


<table>
	<thead>
		<tr>
			<td><?=lang('company_id', 'المعرف', 1); ?></td>
			<td><?=lang('company_name', 'اسم الشركة', 1); ?></td>
			<td><?=lang('catageories', 'الفئات', 1); ?></td>
			<td><?=lang('options', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>

<?php
$Q = "SELECT * FROM `insurance_companies` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	$cou = 2;
	while($rec = mysqli_fetch_assoc($QEXE)){
		
		$Q1 = "SELECT COUNT(`insurance_company_id`) FROM `insurance_categories` WHERE ( (`insurance_company_id` = ".$rec['insurance_company_id'].") )";
		$QEXE1 = mysqli_query($KONN, $Q1);
		$NUM_REC = mysqli_fetch_array($QEXE1);
		$NUM_REC = $NUM_REC[0];
		
		
?>
		<tr>
			<td><?=$rec['insurance_company_id']; ?></td>
			<td><?=$rec['insurance_company_name']; ?></td>
			<td><?=$NUM_REC; ?></td>
			<td>
				<form method="post" action="insurance_comp_file.php" id="pat_frm_view<?=$rec['insurance_company_id']; ?>" style="display:none;">
					<input type="hidden" name="p_id" value="<?=$rec['insurance_company_id']; ?>">
				</form>
				<button type="button" onclick="$('#pat_frm_view<?=$rec['insurance_company_id']; ?>').submit();"><?=lang('view', 'عرض', 1); ?></button>
			</td>
		</tr>
<?php

	}
} else {

?>
	<tr>
		<td colspan="3"><?=lang('No_Data_Found', 'لا توجد بيانات', 1); ?></td>
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
