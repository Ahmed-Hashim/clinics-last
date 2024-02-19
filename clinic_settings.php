<?php
require_once('bootstrap/app_config.php');
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 456;
$sub_id = 2;

$clinic_id = 0;
	session_start();
	$go_to = "index.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){

			if(1==1){
				
				$clinic_id = (int) test_inputs($_SESSION['clinic_id']);
$Q = "SELECT * FROM `clinics` WHERE ( (`clinic_id` = ".$clinic_id.") )";
$QEXE = mysqli_query($KONN, $Q);
$p_data = mysqli_fetch_assoc($QEXE);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC != 1){
	header('location:'.$go_to.'?fail=5646');	
}
$p_name = $p_data['clinic_name'];

$page_title = lang("clinic_file", 'ملف العيادة ', 1)." :: ".$p_name;


	
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

	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder"><br>


<section class="profile-taber">
	<section class="taber-tabs" id="tabs_holder">
		<div class="tab"><?=lang('clinic_information', 'معلومات العيادة', 1); ?></div>
		<div class="tab"><?=lang('clinic_address', 'العنوان', 1); ?></div>
		<div class="tab"><?=lang('clinic_duty', 'معلومات العمل', 1); ?></div>
		<div class="zero"></div>
	</section>
	<section class="taber-body">
	
		<!-- clinic_information -->
		<section class="tab-holder">
			<h1><?=lang('clinic_information', 'معلومات العيادة', 1); ?></h1>
		<form id="edit_clinic_form">
				<div class="info-cont">
					<div class="info-title"><?=lang('clinic_id', 'المعرف', 1); ?></div>
					<div class="info-value"><?=$p_data['clinic_id']; ?></div>
				</div>
			
				<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="hidden" name="clinic_id" value="<?=$clinic_id; ?>">
				
				<div class="info-cont">
					<div class="info-title"><?=lang('clinic_short_code', 'كود الاختصار', 1); ?>*</div>
					<div class="info-value">
<input type="text" value="<?=$p_data['clinic_short_code']; ?>" name="clinic_short_code" readonly>
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('clinic_name', 'اسم العيادة', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_name']; ?>" name="clinic_name">
					</div>
				</div>
				
				<br>
				<br>
			<h1><?=lang('clinic_contact_details', 'معلومات التواصل', 1); ?></h1>
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_mobile', 'الجوال', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_mobile']; ?>" name="clinic_mobile">
					</div>
				</div>
			
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_landline', 'الهاتف الارضي', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_landline']; ?>" name="clinic_landline">
					</div>
				</div>
			
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_email', 'البريد الالكتروني', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_email']; ?>" name="clinic_email">
					</div>
				</div>
			
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_website', 'موقع الانترنت', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_website']; ?>" name="clinic_website">
					</div>
				</div>
				
		</form>	
				<br>
				<br>
<button type="button" onclick="URLer = '<?=api_root; ?>clinics/update_clinic.php';redirecter = 'close_modal';submit_form('edit_clinic_form');"><?=lang('save_changes'); ?></button>
		</section>
	
		<!-- clinic_address -->
		<section class="tab-holder">
			<h1><?=lang('clinic_address_information', 'معلومات العنوان', 1); ?></h1>
		<form id="edit_clinic_address_form">
				<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="hidden" name="clinic_id" value="<?=$clinic_id; ?>">
				
				
				
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_country', 'البلد', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_country']; ?>" name="clinic_country">
					</div>
				</div>
			
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_city', 'المدينة', 1); ?>*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_city']; ?>" name="clinic_city">
					</div>
				</div>
			
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_area', 'المنطقة', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_area']; ?>" name="clinic_area">
					</div>
				</div>
			
				<div class="info-cont-2">
					<div class="info-title"><?=lang('clinic_street', 'الشارع', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="text" value="<?=$p_data['clinic_street']; ?>" name="clinic_street">
					</div>
				</div>
				
		</form>	
				<br>
				<br>
<button type="button" onclick="URLer = '<?=api_root; ?>clinics/update_clinic.php';redirecter = 'close_modal';submit_form('edit_clinic_address_form');"><?=lang('save_changes'); ?></button>
		</section>
	
	
		<!-- clinic_duty -->
		<section class="tab-holder">
			<h1><?=lang('clinic_duty_information', 'معلومات الدوام', 1); ?></h1>
			
<table>
	<thead>
		<tr>
			<td><?=lang('weekday', 'اليوم', 1); ?></td>
			<td><?=lang('open_hour', 'ساعة بدء العمل', 1); ?></td>
			<td><?=lang('close_hour', 'ساعة انتهاء العمل', 1); ?></td>
			<td><?=lang('duty', 'العمل', 1); ?></td>
		</tr>
	</thead>
	<tbody>
		<input type="hidden" value="<?=$clinic_id; ?>" name="clinic_id">
<?php
$Q = "SELECT * FROM `clinics_duty` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") ) ORDER BY `week_day` ASC";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	$cou = 2;
	while($rec = mysqli_fetch_assoc($QEXE)){
?>
		<tr>
		<input class="duty_info_data" type="hidden" value="<?=$rec['clinic_duty_id']; ?>" name="clinic_duty_id[]">
			<td><?=lang($rec['week_day_name']); ?></td>
			<td><input class="duty_info_data" type="text" value="<?=$rec['open_hour']; ?>" name="open_hour[]"></td>
			<td><input class="duty_info_data" type="text" value="<?=$rec['close_hour']; ?>" name="close_hour[]"></td>
			<td>
				<select class="duty_info_data" name="is_onduty[]">
					<option value="1" <?php if($rec['is_onduty']==1){echo ' selected';} ?>><?=lang('ON', 'دوام', 1); ?></option>
					<option value="0" <?php if($rec['is_onduty']==0){echo ' selected';} ?>><?=lang('OFF', 'عطلة', 1); ?></option>
				</select>
			</td>
		</tr>
<?php
	}
}
?>
	</tbody>
</table>
		
<button type="button" onclick="save_duty_changes();"><?=lang('save_duty_changes', 'حفظ المعلومات', 1); ?></button>

		<br><br>
		
<script>
function save_duty_changes(){
	var sent_dat = new FormData();
	
		//collect formdata
		// var sent_dat = $('#assembled_data_form').serialize();
		$('.duty_info_data').each(function(){
			var ths_name = $(this).attr('name');
			var ths_val = $(this).val();
			sent_dat.append(ths_name, ths_val);
		});
		sent_dat.append('clinic_id', <?=$clinic_id; ?>);
			$.ajax({
				url     : '<?=api_root; ?>clinics/update_duty.php',
				data    : sent_dat,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				success : function(data){
					var aa = data.split('|');
					res = parseInt(aa[0]);
					if(res==1){
						mk_alert(aa[1], 'suc');
						hide_modal();
					} else {
						alert(aa[1]);
					}
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	
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
