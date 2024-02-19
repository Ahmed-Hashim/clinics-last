<?php
require_once('bootstrap/app_config.php');
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 132654;
$sub_id = 2;

$lab_id = 0;
	session_start();
	$go_to = "clinic_labs_list.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){

			if(isset($_POST['p_id'])){
				$lab_id = (int) test_inputs($_POST['p_id']);
$Q = "SELECT * FROM `clinics_labs` WHERE ( (`lab_id` = ".$lab_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$p_data = mysqli_fetch_assoc($QEXE);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC != 1){
	header('location:'.$go_to.'?fail=5646');	
}
$p_name = $p_data['lab_name'];

$page_title = lang("lab_file", 'ملف المختبر ', 1)." :: ".$p_name;


	
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
		<button type="button" onclick="$('#new_main_lab_exam_id').val('<?=$p_data['lab_id']; ?>');show_modal('nw_lab_exam');"><?=lang('new_lab_exam', 'تعريف فحص جديد', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder"><br>


<section class="profile-taber">
	<section class="taber-tabs" id="tabs_holder">
		<div class="tab"><?=lang('lab_information', 'معلومات المختبر', 1); ?></div>
		<div class="tab"><?=lang('lab_examinations', 'الفحوصات', 1); ?></div>
		<div class="zero"></div>
	</section>
	<section class="taber-body">
	
		<!-- lab_information -->
		<section class="tab-holder">
			<h1><?=lang('lab_information', 'معلومات المختبر', 1); ?></h1>
		<form id="edit_lab_form">
				<div class="info-cont">
					<div class="info-title"><?=lang('lab_id', 'المعرف', 1); ?></div>
					<div class="info-value"><?=$p_data['lab_id']; ?></div>
				</div>
			
				<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="hidden" name="lab_id" value="<?=$p_data['lab_id']; ?>">
				<div class="info-cont">
					<div class="info-title"><?=lang('lab_name', 'اسم المختبر', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['lab_name']; ?>" name="lab_name">
					</div>
				
				</div>
				
				<br>
				<br>
			<h1><?=lang('lab_contact_details', 'معلومات التواصل', 1); ?></h1>
				<div class="info-cont">
					<div class="info-title"><?=lang('mobile', 'الهاتف الجوال', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['mobile']; ?>" name="mobile">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('landline', 'الهاتف الارضي', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['landline']; ?>" name="landline">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('email', 'البريد الاكتروني', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['email']; ?>" name="email">
					</div>
				</div>
				
		</form>	
				<br>
				<br>
<button type="button" onclick="URLer = '<?=api_root; ?>labs/update_lab.php';redirecter = 'close_modal';submit_form('edit_lab_form');"><?=lang('save_changes'); ?></button>
		</section>
	
		<!-- lab_examinations -->
		<section class="tab-holder">
			<h1><?=lang('lab_examinations', 'الفحوصات المخبرية', 1); ?></h1>
			
			
			


<table>
	<thead>
		<tr>
			<td><?=lang('catageory', 'الفئة', 1); ?></td>
			<td><?=lang('cost', 'التكلفة', 1); ?></td>
			<td><?=lang('options', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>

<?php
$Q = "SELECT * FROM `clinics_labs_exams` WHERE ( (`lab_id` = ".$p_data['lab_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	$cou = 2;
	while($rec = mysqli_fetch_assoc($QEXE)){
		
?>
		<tr id="lab_exam_tr_<?=$rec['lab_exam_id']; ?>">
			<td id="v1_<?=$rec['lab_exam_id']; ?>"><?=$rec['lab_exam_name']; ?></td>
			<td id="v2_<?=$rec['lab_exam_id']; ?>"><?=$rec['cost']; ?></td>
			<td>
				<button type="button" onclick="edit_lab_exam(<?=$rec['lab_exam_id']; ?>);"><?=lang('edit', 'عرض', 1); ?></button>
				<button type="button" onclick="del_lab_exam(<?=$rec['lab_exam_id']; ?>);"><?=lang('delete', 'حذف', 1); ?></button>
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
			


<script>
function change_tr(idd){
	var v_name = $('#lab_exam_val01').val();
	var v_cost = $('#lab_exam_val02').val();
	
	$('#v1_' + idd).html(v_name);
	$('#v2_' + idd).html(v_cost);
	
}



function del_lab_exam(idd){
	idd = parseInt(idd);
	if(idd != 0){
		var aa = confirm('<?=lang('are_you_sure_?', 'هل أنت متأكد؟', 1); ?>');
		if(aa != false){
			
			var snt_data = new FormData();
			snt_data.append('lab_exam_id', idd);
			snt_data.append('op', 2);
			$.ajax({
				url     : '<?=api_root; ?>labs/edit_lab_exam.php',
				data    : snt_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					
				},
				success : function(data){
					mk_alert(data, 'suc');
					$('#lab_exam_tr_' + idd).remove();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
		}
	}
	
}



function edit_lab_exam(idd){
	idd = parseInt(idd);
	if(idd != 0){
		
		var snt_data = new FormData();
		//continue
		//send ajax request to load patient data
		snt_data.append('lab_exam_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>labs/edit_lab_exam.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('edit_lab_exam', 'تحرير الفحص المخبري', 1); ?>');
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

			
			
			
			
		</section>
	
	
	</section>
	<div class="zero"></div>
</section>

















	
</section>
<br>






<?php
	//PAGE DATA END   ----------------------------------------------///---------------------------------
	include(main_app_url.'app/footer.php');
?>
	</body>
</html>
<?php

} else {
	header('location:'.$go_to.'?fail=34234');	
}

			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			} else {
			header('location:'.$go_to.'?fail=444');	
			}
	} else {
			header('location:'.$go_to.'?fail=333');	
	}
?>
