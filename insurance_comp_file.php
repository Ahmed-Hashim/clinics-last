<?php
require_once('bootstrap/app_config.php');
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 66;
$sub_id = 2;

$insurance_company_id = 0;
	session_start();
	$go_to = "insurance_companies.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){

			if(isset($_POST['p_id'])){
				$insurance_company_id = (int) test_inputs($_POST['p_id']);
$Q = "SELECT * FROM `insurance_companies` WHERE ( (`insurance_company_id` = ".$insurance_company_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$p_data = mysqli_fetch_assoc($QEXE);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC != 1){
	header('location:'.$go_to.'?fail=5646');	
}
$p_name = $p_data['insurance_company_name'];

$page_title = lang("insurance_company_file", 'ملف شركة التأمين ', 1)." :: ".$p_name;


	
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
		<button type="button" onclick="$('#new_cat_main_comp_id').val('<?=$p_data['insurance_company_id']; ?>');show_modal('nw_insurance_catt');"><?=lang('new_company_catageory', 'فئة جديدة', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder"><br>


<section class="profile-taber">
	<section class="taber-tabs" id="tabs_holder">
		<div class="tab"><?=lang('company_information', 'معلومات الشركة', 1); ?></div>
		<div class="tab"><?=lang('insurance_catageories', 'فئات التأمين', 1); ?></div>
		<div class="zero"></div>
	</section>
	<section class="taber-body">
	
		<!-- company_information -->
		<section class="tab-holder">
			<h1><?=lang('company_information', 'معلومات الشركة', 1); ?></h1>
		<form id="edit_insurance_company_form">
				<div class="info-cont">
					<div class="info-title"><?=lang('company_id', 'المعرف', 1); ?></div>
					<div class="info-value"><?=$p_data['insurance_company_id']; ?></div>
				</div>
			
				<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="hidden" name="insurance_company_id" value="<?=$p_data['insurance_company_id']; ?>">
				<div class="info-cont">
					<div class="info-title"><?=lang('company_name', 'اسم الشركة', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['insurance_company_name']; ?>" name="insurance_company_name">
					</div>
				
				</div>
				
				<br>
				<br>
			<h1><?=lang('company_contact_details', 'معلومات التواصل', 1); ?></h1>
				<div class="info-cont">
					<div class="info-title"><?=lang('mobile', 'الجوال', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['mobile']; ?>" name="mobile">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('landline', 'الهاتلف الارضي', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['landline']; ?>" name="landline">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('email', 'البريد الالكتروني', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['email']; ?>" name="email">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('Fax_no', 'رقم الفاكس', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['fax_no']; ?>" name="fax_no">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('accreditation_no', 'رقم الاعتماد', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['accreditation_no']; ?>" name="accreditation_no">
					</div>
				</div>
				
		</form>	
				<br>
				<br>
<button type="button" onclick="URLer = '<?=api_root; ?>insurance_companies/update_company.php';redirecter = 'close_modal';submit_form('edit_insurance_company_form');"><?=lang('save_changes'); ?></button>
		</section>
	
		<!-- insurance_catageories -->
		<section class="tab-holder">
			<h1><?=lang('company_insurance_catageories', 'فئات التأمين', 1); ?></h1>
			
			
			


<table>
	<thead>
		<tr>
			<td><?=lang('catageory', 'الفئة', 1); ?></td>
			<td><?=lang('discount_percentage', 'نسبة الخصم', 1); ?></td>
			<td><?=lang('options', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>

<?php
$Q = "SELECT * FROM `insurance_categories` WHERE ( (`insurance_company_id` = ".$p_data['insurance_company_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	$cou = 2;
	while($rec = mysqli_fetch_assoc($QEXE)){
		
?>
		<tr id="cat_tr_<?=$rec['insurance_category_id']; ?>">
			<td id="v1_<?=$rec['insurance_category_id']; ?>"><?=$rec['insurance_category_name']; ?></td>
			<td id="v2_<?=$rec['insurance_category_id']; ?>"><?=$rec['discount'].' %'; ?></td>
			<td>
				<button type="button" onclick="edit_cat(<?=$rec['insurance_category_id']; ?>);"><?=lang('edit', 'تحرير', 1); ?></button>
				<button type="button" onclick="del_cat(<?=$rec['insurance_category_id']; ?>);"><?=lang('delete', 'حذف', 1); ?></button>
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
	var v_name = $('#catageory_val01').val();
	var v_discount = $('#catageory_val02').val();
	
	$('#v1_' + idd).html(v_name);
	$('#v2_' + idd).html(v_discount + ' %');
	
}



function del_cat(idd){
	idd = parseInt(idd);
	if(idd != 0){
		var aa = confirm('<?=lang('are_you_sure_?', 'هل انت متأكد', 1); ?>');
		if(aa != false){
			
			var snt_data = new FormData();
			snt_data.append('cat_id', idd);
			snt_data.append('op', 2);
			$.ajax({
				url     : '<?=api_root; ?>insurance_companies/edit_cat.php',
				data    : snt_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					
				},
				success : function(data){
					mk_alert(data, 'suc');
					$('#cat_tr_' + idd).remove();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
		}
	}
	
}



function edit_cat(idd){
	idd = parseInt(idd);
	if(idd != 0){
		
		var snt_data = new FormData();
		//continue
		//send ajax request to load patient data
		snt_data.append('cat_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>insurance_companies/edit_cat.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('edit_insurance_catageory', 'تحرير فئة التأمين', 1); ?>');
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
