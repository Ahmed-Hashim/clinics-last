<?php
require_once('bootstrap/app_config.php');
$page_title = lang("employee List", 'قائمة الموظفين', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 5;
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
	<h1><?=$page_title; ?></h1>
	
	
	<section class="page-options">
		<button type="button" onclick="show_modal('nw_emp');"><?=lang('new_employee', 'موظف جديد', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>





<section class="panel-holder">





<script>
    function delPatFile( pId ){
       
        var cc = confirm("<?=lang('Are_you_sure?', 'هل_انت_متأكد؟', 1); ?>");
        if( cc == true ){

            $.ajax({
            	url     : '<?=api_root; ?>employee/del_emp.php',
            	data    : { 'employee_id': pId },
            	dataType  : 'html',
            	method  : 'POST',
            	success : function(data){
            		$('#emp-' + pId).remove();
            	},
            	error : function(data){
            		alert('load error' + data);
            	}
            });


        }
    }
</script>



<table>
	<thead>
		<tr>
			<td></td>
			<td><?=lang('file_no', 'رقم الملف', 1); ?></td>
			<td><?=lang('employee_name', 'أسم الموظف', 1); ?></td>
			<td><?=lang('department', 'القسم', 1); ?></td>
			<td><?=lang('options', 'الخيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
$Q = "SELECT * FROM `clinics_employees` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") AND ( `is_deleted` = 0 ))";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	$cou = 2;
	while($rec = mysqli_fetch_assoc($QEXE)){
		$gender_class = 'male';
		switch($rec['gender']){
			case 1:
				$gender_class = 'male';
				break;
			case 2:
				$gender_class = 'female';
				break;
		}
		
		$Q1 = "SELECT `clinic_department_name` FROM `clinics_departments` WHERE ( (`clinic_department_id` = ".$rec['clinic_department_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		$QEXE1 = mysqli_query($KONN, $Q1);
		$dept = mysqli_fetch_array($QEXE1);
		
?>
		<tr id="emp-<?=$rec['employee_id']; ?>">
			<td>&nbsp;&nbsp;&nbsp;<i class="fa fa-<?=$gender_class; ?>" area-hidden="true"></i>&nbsp;&nbsp;&nbsp;</td>
			<td><?=$rec['employee_id']; ?></td>
			<td><?=$rec['title'].'. '.$rec['first_name'].' '.$rec['last_name'];?></td>
			<td><?=lang($dept[0]); ?></td>
			<td>
				<form method="post" action="emp_file.php" id="pat_frm_view<?=$rec['employee_id']; ?>" style="display:none;">
					<input type="hidden" name="p_id" value="<?=$rec['employee_id']; ?>">
				</form>
				<button onclick="$('#pat_frm_view<?=$rec['employee_id']; ?>').submit();" type="button"><?=lang('view-edit', 'عرض - تحرير', 1); ?></button>
				<button onclick="delPatFile(<?=$rec['employee_id']; ?>);" type="button" style="background: red;color: white;"><?=lang('Delete_file', 'حذف_الملف', 1); ?></button>
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
