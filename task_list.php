<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Tasks List", 'جدول الاوامر', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 4;
$sub_id = 2;


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
		<button onclick="show_modal('nw_task');" type="button"><?=lang('new_task', 'مهمة جديدة', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>


<section class="panel-holder">

<table>
	<thead>
		<tr>
			<td><?=lang('task_id', 'معرف المهمة', 1); ?></td>
			<td><?=lang('task_date', 'التاريخ', 1); ?></td>
			<td><?=lang('issued_by', 'أضيفة بواسطة', 1); ?></td>
			<td><?=lang('priority', 'الأهمية', 1); ?></td>
			<td><?=lang('time_left', 'الوقت المتبقي', 1); ?></td>
			<td><?=lang('finished_at', 'تنتهي في', 1); ?></td>
			<td><?=lang('task_options', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>


<?php

$q = "SELECT * FROM `employees_tasks` WHERE ( (`to_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ORDER BY `task_time` DESC  LIMIT 10";


if($_SESSION['is_admin'] == 1){
$q = "SELECT * FROM `employees_tasks` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") ) ORDER BY `task_time` DESC  LIMIT 10";

}

$q_exe = mysqli_query($KONN, $q);
$num_records = mysqli_num_rows($q_exe);

if($num_records > 0){
	
	while($row = mysqli_fetch_assoc($q_exe)){
		
		$sender = $row['from_id'];
		$qSD = "SELECT * FROM `clinics_employees` WHERE ( (`employee_id` = ".$sender.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) LIMIT 1";
		$q_exeSD = mysqli_query($KONN, $qSD);
		$sender_data = mysqli_fetch_assoc($q_exeSD);
		$sender_name = $sender_data['first_name'].' '.$sender_data['last_name'];
			
			$done_state = ($row['is_done'] == '0') ? lang('Not_Finished') : $row['done_at'];
			$priority = $row['priority'];
			$task_id = $row['task_time'];
			$task_time = $row['task_time'];
			$deadline = $row['deadline'];
			$priority_color = 'red';
			$priority_class = 'star-o';
			
			switch($priority){
				case '0'://low
					$priority_class = lang('LOW', 'غير مهمة', 1);
					$priority_color = 'blue';
					break;
				case '1'://normal
					$priority_class = lang('NORMAL', 'عادية', 1);
					$priority_color = 'brown';
					break;
				case '2'://hight
					$priority_class = lang('HIGH', 'عالية الأهمية', 1);
					$priority_color = 'red';
					break;
			}
			
			if($row['is_done'] == '1'){
				
				$priority_color = 'green';
			}
			$cur_time = date('Y-m-d H:i:s');
			$hourdiff = round((strtotime($deadline) - strtotime($cur_time))/3600, 1);
?>
		<tr>
			<td><?=$row['task_id']; ?></td>
			<td><?=$task_time; ?></td>
			<td><?=$sender_name; ?></td>
			<td><?=$priority_class; ?></td>
			<td><?=$hourdiff.' '.lang('hours', 'ساعة', 1); ?></td>
			<td><?=$done_state; ?></td>
			<td>
				<button type="button" onclick="view_task(<?=$row['task_id']; ?>)"><?=lang('view_task', 'عرض', 1); ?></button>
				<?php if($row['is_done'] == '0'){ ?>
					<button type="button" onclick="mark_task_as_done(<?=$row['task_id']; ?>)"><?=lang('Mark_as_done', 'إنهاء المهمة', 1); ?></button>
				<?php } ?>
			</td>
		</tr>
<?php

	}
} else {

?>
	<tr>
		<td colspan="6"><?=lang('No_Tasks_Found', 'لا توجد مهام', 1); ?></td>
	</tr>
<?php
}
?>
	</tbody>
</table>
	
</section>

<script>
function view_task(idd){
	idd = parseInt(idd);
	if(idd!=0){
		
		var snt_data = new FormData();
		snt_data.append('task_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>tasks/view_task.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('view_task', 'عرض', 1); ?>');
				$('#data_fetch_modal .modal-body').html(data);
				show_modal('data_fetch_modal');
			},
			error : function(data){
				alert('load error' + data);
			}
		});
		
	}
}
</script>

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
