<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Expenses List", 'تكاليف العيادة', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 469;
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
		<button type="button" onclick="show_modal('new_cost');"><?=lang('new_cost', 'إضافة جديد', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder">


<table>
	<thead>
		<tr>
			<td><?=lang('NO.', 'الرقم', 1); ?></td>
			<td><?=lang('Item', 'البند', 1); ?></td>
			<td><?=lang('Date', 'التاريخ', 1); ?></td>
			<td><?=lang('Notes', 'ملاحظات', 1); ?></td>
			<td><?=lang('Total', 'مجموع', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
$tt=1;
$toter=0;
		$q = "SELECT * FROM `clinic_expenses` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
			    $thsV = (double) $db_data['expense_total'];
				$toter = $toter + $thsV;

				
?>
		<tr>
			<td><?=$tt++; ?></td>
			<td><?=$db_data['expense_item']; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$db_data['expense_notes']; ?></td>
			<td><?=$thsV; ?></td>
		</tr>
<?php
			}
?>

		<tr>
			<td colspan="4"><?=lang('Total :', 'المجموع :', 1); ?></td>
			<td><?=$toter; ?></td>
		</tr>
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
