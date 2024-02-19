<?php
require_once('bootstrap/app_config.php');
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 3;
$sub_id = 2;

$patient_id = 0;
	session_start();
	$go_to = "patient_list.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){

			if(isset($_GET['p_id'])){
				$patient_id = (int) test_inputs($_GET['p_id']);
$Q = "SELECT * FROM `patients` WHERE ( (`patient_id` = ".$patient_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$p_data = mysqli_fetch_assoc($QEXE);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC != 1){
	header('location:'.$go_to.'?fail=5646');
	die();
}
$p_name = $p_data['first_name'].' '.$p_data['last_name'];

$page_title = lang("Patient_File", 'ملف المريض', 1)." :: ".$p_name;


	$dob_arr = explode('-', $p_data['dob']);
	$pat_age = date('Y') - $dob_arr[0];
	$p_g = (int) $p_data['gender'];
		$gender_class = 'male';
		switch($p_g){
			case 1:
				$gender_class = 'male';
				break;
			case 2:
				$gender_class = 'female';
				break;
		}

		
		

	$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$p_data['dr_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$QEXE1 = mysqli_query($KONN, $Q1);
	$doctor_db = mysqli_fetch_array($QEXE1);
		

	$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$p_data['registerer'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$QEXE1 = mysqli_query($KONN, $Q1);
	$registerer_db = mysqli_fetch_array($QEXE1);
		?>
<!DOCTYPE html>
<html dir="<?=$lang_dir; ?>" lang="<?=$lang; ?>">
  <head>
	<?php include(main_app_url.'app/meta.php'); ?>
    <?php include(main_app_url.'app/assets.php'); ?>
	<style>
	.teeth_coord {
		background: red;
		cursor:pointer;
	}
	#teeth_mover {
		width: 20px;
		height: 20px;
		border-radius: 20px;
		background: blue;
		position: absolute;
		transform: translate(-10px,-10px);
		opacity: 0.8;
		transition: all 0s ease !important;
	}
	</style>
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
		<button onclick="add_new_appointment_patient(<?=$p_data['file_num']; ?>, <?=$p_data['dr_id']; ?>);" type="button"><?=lang('add_appointment', 'إضافة جلسة', 1); ?></button>
		<button onclick="show_note_modal(<?=$p_data['patient_id']; ?>);" type="button"><?=lang('add_note', 'إضافة ملاحظة', 1); ?></button>
		<button onclick="show_transfer_modal(<?=$p_data['patient_id']; ?>);" type="button"><?=lang('transfer_doctor', 'نقل الطبيب', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder"><br>

<form id="upload_profile_pic" style="display:none;">
	<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$patient_id; ?>" name="patient_id">
	<input type="file" class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" id="profile_pic_choser" name="profile_pic_choser">
</form>

<section class="profile-main">
	<section class="profile-pic">
		<img onclick="$('#profile_pic_choser').click();" id="profile_img" src="<?=uploads_root.$p_data['profile_pic']; ?>" alt="<?=lang('profile_pic'); ?>">
	</section>
	<section class="profile-name">
		<h1><i class="fa fa-<?=$gender_class; ?>" area-hidden="true"></i> - <?=$p_name; ?></h1>
		<div class="profile-data"><span><?=lang('age', 'العمر', 1); ?></span>:<i class="nw_age"><?=$pat_age; ?><?=lang('_years', ' سنين', 1); ?></i></div>
		<div class="profile-data"><span><?=lang('mobile', 'الهاتف', 1); ?></span>:<i><?=$p_data['mobile']; ?></i></div>
		<div class="profile-data"><span><?=lang('Registered_at', 'سجل بتاريخ', 1); ?></span>:<i><?=$p_data['reg_date']; ?></i><span class="sec-child"><?=lang('by', 'بواسطة', 1); ?></span>:<i><?=$registerer_db[0]; ?></i></div>
		<div class="profile-data"><span><?=lang('doctor', 'الطبيب', 1); ?></span>:<i><?=$doctor_db[0]; ?></i></div>
	</section>
	<div class="zero"></div>
</section>
<script>
function upload_profile_pic() {
	var aa = confirm('<?=lang('Save_new_profile_picture_?', 'حفظ الصورة الجديدة', 1); ?>');
	if(aa == true){
		URLer = '<?=api_root; ?>patients/upload_profile_pic.php';
		redirecter = 'close_modal';
		submit_form('upload_profile_pic');
	}
	
}

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
	
	
	setTimeout(function(){
		upload_profile_pic();
	}, 100);
	
}

$("#profile_pic_choser").change(function(){
    readURL(this);
});
</script>
<hr>

<section class="profile-taber">
	<section class="taber-tabs" id="tabs_holder">
		<div class="tab"><?=lang('patient_information', 'معلومات المريض', 1); ?></div>
		<div class="tab"><?=lang('teeth_chart', 'معلومات البيان', 1); ?></div>
		<div class="tab"><?=lang('insurance_information', 'معلومات التأمين', 1); ?></div>
		<div class="tab"><?=lang('Sessions', 'الجلسات', 1); ?></div>
		<div class="tab"><?=lang('notes', 'الملاحظات', 1); ?></div>
		<div class="tab"><?=lang('financials', 'المالية', 1); ?></div>
		<div class="tab"><?=lang('doctor_transfers', 'تنقلات الطبيب', 1); ?></div>
		<div class="tab"><?=lang('medications', 'الأدوية', 1); ?></div>
		<div class="tab"><?=lang('lab_exams', 'فحوص المختبر', 1); ?></div>
		<div class="tab"><?=lang('procedures', 'الإجراءات الطبية', 1); ?></div>
		<div class="tab"><?=lang('media_attached', 'الملحقات', 1); ?></div>
		<div class="zero"></div>
	</section>
	<section class="taber-body">
	
		<!-- patient_information -->
		<section class="tab-holder">
			<h1><?=lang('personal_information', 'المعلومات الشخصية', 1); ?></h1>
			<section class="data-holder">
<form id="edit_patient_data">
				<div class="info-cont">
					<div class="info-title"><?=lang('system_id', 'معرف النظام', 1); ?></div>
					<div class="info-value"><span><?=$p_data['patient_id']; ?></span></div>
					<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['patient_id']; ?>" type="hidden" name="patient_id">
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('file_number', 'رقم الملف', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['file_num']; ?>" type="text" name="file_num">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('nat_no', 'الرقم الوطني', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['nat_no']; ?>" type="text" name="nat_no">
					</div>
				</div>
				
				<br>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('first_name', 'الاسم الاول', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['first_name']; ?>" type="text" name="first_name">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('second_name', 'الاسم الثاني', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['second_name']; ?>" type="text" name="second_name">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('third_name', 'الاسم الثالث', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['third_name']; ?>" type="text" name="third_name">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('last_name', 'اسم العائلة', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['last_name']; ?>" type="text" name="last_name">
					</div>
				</div>
				
			
				<div class="info-cont-4">
					<div class="info-title"><?=lang('nationality', 'الجنسية', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['nationality']; ?>" type="text" name="nationality">
					</div>
				</div>
			
				<div class="info-cont-4">
					<div class="info-title"><?=lang('dob', 'تاريخ الميلاد', 1); ?></div>
					<div class="info-value">
<input class="has_date data-input" id="dober" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['dob']; ?>" type="text" name="dob">
					</div>
				</div>
<script>
$('#dober').on('change', function(){
	console.log('ss');
	var c_yy = <?=date('Y'); ?>;
	var dob = $('#dober').val();
	var dob_a = dob.split('-');
	var yy = parseInt(dob_a[0]);
	var age = c_yy - yy;
	$('.nw_age').html(age + '<?=lang('_years', '_سنين', 1); ?>');
});
</script>
				<div class="info-cont-4">
					<div class="info-title"><?=lang('age', 'العمر', 1); ?></div>
					<div class="info-value"><span class="nw_age"><?=$pat_age; ?><?=lang('_years', '_سنين', 1); ?></span></div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('gender', 'الجنس', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="gender">
	<option value="1"<?php if($p_g==1){echo ' selected';} ?>><i class="fa fa-male" area-hidden="true"></i><?=' - '.lang('male', 'ذكر', 1); ?></option>
	<option value="2"<?php if($p_g==2){echo ' selected';} ?>><i class="fa fa-female" area-hidden="true"></i><?=' - '.lang('female', 'أنثى', 1); ?></option>
</select>
					</div>
				</div>
				
			
				<div class="info-cont-4">
					<div class="info-title"><?=lang('mobile', 'الهاتف الخلوي', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['mobile']; ?>" type="text" name="mobile">
					</div>
				</div>

<?php
if( $p_data['mobile'] != '' ){
	if( $p_data['mobile'] != '0' ){
?>
				<div class="info-cont-4">
					<div class="info-title"><?=lang('Send Whatsapp', 'إرسال واتس آب', 1); ?>&nbsp;*</div>
					<div class="info-value">
<a href="https://api.whatsapp.com/send?phone=<?=$p_data['mobile']; ?>" target="_blank"><button type="button"><?=lang('Send', 'إرسال', 1); ?></button></a>
					</div>
				</div>
<?php
	}
}
?>
				<div class="info-cont-4">
					<div class="info-title"><?=lang('landline', 'الهاتف الارضي', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['landline']; ?>" type="text" name="landline">
					</div>
				</div>
			
				<div class="info-cont-4">
					<div class="info-title"><?=lang('email', 'البريد الإلكتروني', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['email']; ?>" type="text" name="email">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('Payment Term', 'نوع الدفع', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="insurance_type">
	<option value="1"<?php if($p_data['insurance_type']==1){echo ' selected';} ?>><?=lang('cash', 'نقدي', 1); ?></option>
	<option value="2"<?php if($p_data['insurance_type']==2){echo ' selected';} ?>><?=lang('insurance', 'خاضع للتأمين', 1); ?></option>
</select>
					</div>
				</div>
				
				
				<br>
<button type="button" onclick="URLer = '<?=api_root; ?>patients/update_patient_basic_info.php';redirecter = 'close_modal';submit_form('edit_patient_data');"><?=lang('save_changes', 'حفظ التعديلات', 1); ?></button>
		
				
</form>
				
			</section>
		</section>
	
		<!-- teeth_chart -->
		<section class="tab-holder">
		
			<h1><?=lang('patient_chart', 'بيان المريض', 1); ?></h1>
			
					
			<section class="data-holder" style="position:relative;">

			
			
<?php

if($p_g==1){
?>
	<img src="assets/images/A- Tooth chart.png" width="720" alt="">
<?php
} else {
?>
	<img src="assets/images/A- Tooth chart.png" width="720" alt="">
<?php
}

?>
			
			
			
			
			
			
			
			
			
	
<section class="data-holder" style="position:relative;">

<?php /*
	<section class="pat_teeth">
		<section class="pat_teeth_upper">
<?php for($r=1;$r<=16;$r++){ ?>
	<div onclick="slct_teeth(<?=$r; ?>);" id="teeth_<?=$r; ?>" class="teether teeth_<?=$r; ?>" ><?=$r; ?></div>
<?php } ?>
		</section>
		<section class="pat_teeth_downer">
<?php for($r=32;$r>=17;$r--){ ?>
	<div onclick="slct_teeth(<?=$r; ?>);" id="teeth_<?=$r; ?>" class="teether teeth_<?=$r; ?>" ><?=$r; ?></div>
<?php } ?>
		</section>
	</section>
*/ ?>
	
	
	
	<div style="width:500px;height:500px;position:relative;margin: 0 auto;">
	<img src="<?=uploads_root?>teeth_chart.png" alt="" usemap="#teeth_map" style="width:500px;height:500px;">
	<div id="teeth_mover" style=""></div>
	</div>

<map name="teeth_map" id="teeth_maper">
  <area shape="circle" idder="1" id="r-up-1" onclick="select_teeth('r-up-1');" class="teeth_coord" coords="228,67,10" alt="R-UP-1">
  <area shape="circle" idder="2" id="r-up-2" onclick="select_teeth('r-up-2');" class="teeth_coord" coords="204,69,10" alt="R-UP-2">
  <area shape="circle" idder="3" id="r-up-3" onclick="select_teeth('r-up-3');" class="teeth_coord" coords="181,75,10" alt="R-UP-3">
  <area shape="circle" idder="4" id="r-up-4" onclick="select_teeth('r-up-4');" class="teeth_coord" coords="160,87,10" alt="R-UP-4">
  <area shape="circle" idder="5" id="r-up-5" onclick="select_teeth('r-up-5');" class="teeth_coord" coords="142,104,10" alt="R-UP-5">
  <area shape="circle" idder="6" id="r-up-6" onclick="select_teeth('r-up-6');" class="teeth_coord" coords="125,122,10" alt="R-UP-6">
  <area shape="circle" idder="7" id="r-up-7" onclick="select_teeth('r-up-7');" class="teeth_coord" coords="117,144,10" alt="R-UP-7">
  <area shape="circle" idder="8" id="r-up-8" onclick="select_teeth('r-up-8');" class="teeth_coord" coords="114,167,10" alt="R-UP-8">
  
  <area shape="circle" idder="9" id="r-up-a" onclick="select_teeth('r-up-a');" class="teeth_coord" coords="228,115,10" alt="R-UP-a">
  <area shape="circle" idder="10" id="r-up-b" onclick="select_teeth('r-up-b');" class="teeth_coord" coords="206,120,10" alt="R-UP-b">
  <area shape="circle" idder="11" id="r-up-c" onclick="select_teeth('r-up-c');" class="teeth_coord" coords="186,130,10" alt="R-UP-c">
  <area shape="circle" idder="12" id="r-up-d" onclick="select_teeth('r-up-d');" class="teeth_coord" coords="170,146,10" alt="R-UP-d">
  <area shape="circle" idder="13" id="r-up-e" onclick="select_teeth('r-up-e');" class="teeth_coord" coords="162,167,10" alt="R-UP-e">
  
  
  <area shape="circle" idder="14" id="l-up-1" onclick="select_teeth('l-up-1');" class="teeth_coord" coords="269,67,10" alt="L-UP-1">
  <area shape="circle" idder="15" id="l-up-2" onclick="select_teeth('l-up-2');" class="teeth_coord" coords="293,69,10" alt="L-UP-2">
  <area shape="circle" idder="16" id="l-up-3" onclick="select_teeth('l-up-3');" class="teeth_coord" coords="316,75,10" alt="L-UP-3">
  <area shape="circle" idder="17" id="l-up-4" onclick="select_teeth('l-up-4');" class="teeth_coord" coords="338,87,10" alt="L-UP-4">
  <area shape="circle" idder="18" id="l-up-5" onclick="select_teeth('l-up-5');" class="teeth_coord" coords="356,104,10" alt="L-UP-5">
  <area shape="circle" idder="19" id="l-up-6" onclick="select_teeth('l-up-6');" class="teeth_coord" coords="372,122,10" alt="L-UP-6">
  <area shape="circle" idder="20" id="l-up-7" onclick="select_teeth('l-up-7');" class="teeth_coord" coords="382,144,10" alt="L-UP-7">
  <area shape="circle" idder="21" id="l-up-8" onclick="select_teeth('l-up-8');" class="teeth_coord" coords="383,167,10" alt="L-UP-8">
  
  <area shape="circle" idder="22" id="l-up-a" onclick="select_teeth('l-up-a');" class="teeth_coord" coords="270,115,10" alt="L-UP-a">
  <area shape="circle" idder="23" id="l-up-b" onclick="select_teeth('l-up-b');" class="teeth_coord" coords="292,120,10" alt="L-UP-b">
  <area shape="circle" idder="24" id="l-up-c" onclick="select_teeth('l-up-c');" class="teeth_coord" coords="312,130,10" alt="L-UP-c">
  <area shape="circle" idder="25" id="l-up-d" onclick="select_teeth('l-up-d');" class="teeth_coord" coords="328,147,10" alt="L-UP-d">
  <area shape="circle" idder="26" id="l-up-e" onclick="select_teeth('l-up-e');" class="teeth_coord" coords="336,168,10" alt="L-UP-e">
  
  
  <area shape="circle" idder="27" id="r-low-1" onclick="select_teeth('r-low-1');" class="teeth_coord" coords="229,433,10" alt="R-LOW-1">
  <area shape="circle" idder="28" id="r-low-2" onclick="select_teeth('r-low-2');" class="teeth_coord" coords="205,430,10" alt="R-LOW-2">
  <area shape="circle" idder="29" id="r-low-3" onclick="select_teeth('r-low-3');" class="teeth_coord" coords="182,425,10" alt="R-LOW-3">
  <area shape="circle" idder="30" id="r-low-4" onclick="select_teeth('r-low-4');" class="teeth_coord" coords="159,412,10" alt="R-LOW-4">
  <area shape="circle" idder="31" id="r-low-5" onclick="select_teeth('r-low-5');" class="teeth_coord" coords="142,395,10" alt="R-LOW-5">
  <area shape="circle" idder="32" id="r-low-6" onclick="select_teeth('r-low-6');" class="teeth_coord" coords="125,377,10" alt="R-LOW-6">
  <area shape="circle" idder="33" id="r-low-7" onclick="select_teeth('r-low-7');" class="teeth_coord" coords="117,355,10" alt="R-LOW-7">
  <area shape="circle" idder="34" id="r-low-8" onclick="select_teeth('r-low-8');" class="teeth_coord" coords="114,332,10" alt="R-LOW-8">

  
  <area shape="circle" idder="35" id="r-low-a" onclick="select_teeth('r-low-a');" class="teeth_coord" coords="229,385,10" alt="R-LOW-a">
  <area shape="circle" idder="36" id="r-low-b" onclick="select_teeth('r-low-b');" class="teeth_coord" coords="206,380,10" alt="R-LOW-b">
  <area shape="circle" idder="37" id="r-low-c" onclick="select_teeth('r-low-c');" class="teeth_coord" coords="186,370,10" alt="R-LOW-c">
  <area shape="circle" idder="38" id="r-low-d" onclick="select_teeth('r-low-d');" class="teeth_coord" coords="170,354,10" alt="R-LOW-d">
  <area shape="circle" idder="39" id="r-low-e" onclick="select_teeth('r-low-e');" class="teeth_coord" coords="162,334,10" alt="R-LOW-e">
  
  
  
  <area shape="circle" idder="40" id="l-low-1" onclick="select_teeth('l-low-1');" class="teeth_coord" coords="269,433,10" alt="L-LOW-1">
  <area shape="circle" idder="41" id="l-low-2" onclick="select_teeth('l-low-2');" class="teeth_coord" coords="293,430,10" alt="L-LOW-2">
  <area shape="circle" idder="42" id="l-low-3" onclick="select_teeth('l-low-3');" class="teeth_coord" coords="316,425,10" alt="L-LOW-3">
  <area shape="circle" idder="43" id="l-low-4" onclick="select_teeth('l-low-4');" class="teeth_coord" coords="338,412,10" alt="L-LOW-4">
  <area shape="circle" idder="44" id="l-low-5" onclick="select_teeth('l-low-5');" class="teeth_coord" coords="356,395,10" alt="L-LOW-5">
  <area shape="circle" idder="45" id="l-low-6" onclick="select_teeth('l-low-6');" class="teeth_coord" coords="372,377,10" alt="L-LOW-6">
  <area shape="circle" idder="46" id="l-low-7" onclick="select_teeth('l-low-7');" class="teeth_coord" coords="382,355,10" alt="L-LOW-7">
  <area shape="circle" idder="47" id="l-low-8" onclick="select_teeth('l-low-8');" class="teeth_coord" coords="383,332,10" alt="L-LOW-8">
  
  <area shape="circle" idder="48" id="l-low-a" onclick="select_teeth('l-low-a');" class="teeth_coord" coords="270,384,10" alt="L-LOW-a">
  <area shape="circle" idder="49" id="l-low-b" onclick="select_teeth('l-low-b');" class="teeth_coord" coords="292,380,10" alt="L-LOW-b">
  <area shape="circle" idder="50" id="l-low-c" onclick="select_teeth('l-low-c');" class="teeth_coord" coords="312,370,10" alt="L-LOW-c">
  <area shape="circle" idder="51" id="l-low-d" onclick="select_teeth('l-low-d');" class="teeth_coord" coords="328,354,10" alt="L-LOW-d">
  <area shape="circle" idder="52" id="l-low-e" onclick="select_teeth('l-low-e');" class="teeth_coord" coords="336,334,10" alt="L-LOW-e">
</map>
<script>
var selected_teeth = '';

function select_teeth(idd){
	$('#teeth_maper .selected_teeth').removeClass('selected_teeth');
	var coords = $('#' + idd).attr('coords');
	var c_arr = coords.split(',');
	var left_X = c_arr[0];
	var top_Y = c_arr[1];
	$('#teeth_mover').css('top', top_Y + 'px');
	$('#teeth_mover').css('left', left_X + 'px');
	selected_teeth = idd;
	var ths_id = parseInt($('#' + idd).attr('idder'));
	if(ths_id != 0 && isNaN(ths_id) == false){
		$('#teeth_slctor').val(ths_id);
		$('#teeth_slctor').change();
	}
}
</script>
	<section class="teeth-proc">
<?php
$teeth_pediatrics = array("NA", "a", "b", "c", "d", "e");
$teeth_id = 0;
?>
	<form id="pat_proc_submit_form">
<input class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['patient_id']; ?>" type="hidden" name="patient_id">	
		<label><?=lang('teeth_no', 'رقم السن', 1); ?></label>
		<select id="teeth_slctor" class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" type="text" name="teeth_no">
<option value="1986"><?=lang('Please_Select_Teeth', 'الرجاء اختيار السن', 1); ?></option>
<option value="1986">------ Right Upper ------</option>
<?php 
	for($z=1;$z<=8;$z++){
		$teeth_id++;
		$teeth_name = 'Right-Upper-'.$z;
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>
<?php 
	for($z=1;$z<=5;$z++){
		$teeth_id++;
		$teeth_name = 'Right-Upper-'.strtoupper($teeth_pediatrics[$z]);
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>
<option value="1986">------ Left Upper ------</option>
<?php 
	for($z=1;$z<=8;$z++){
		$teeth_id++;
		$teeth_name = 'Left-Upper-'.$z;
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>
<?php 
	for($z=1;$z<=5;$z++){
		$teeth_id++;
		$teeth_name = 'Left-Upper-'.strtoupper($teeth_pediatrics[$z]);
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>
<option value="1986">------ Right Lower ------</option>
<?php 
	for($z=1;$z<=8;$z++){
		$teeth_id++;
		$teeth_name = 'Right-Lower-'.$z;
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>
<?php 
	for($z=1;$z<=5;$z++){
		$teeth_id++;
		$teeth_name = 'Right-Lower-'.strtoupper($teeth_pediatrics[$z]);
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>
<option value="1986">------ Left Lower ------</option>
<?php 
	for($z=1;$z<=8;$z++){
		$teeth_id++;
		$teeth_name = 'Left-Lower-'.$z;
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>
<?php 
	for($z=1;$z<=5;$z++){
		$teeth_id++;	
		$teeth_name = 'Left-Lower-'.strtoupper($teeth_pediatrics[$z]);
?>
	<option value="<?=$teeth_id; ?>"><?=$teeth_name; ?></option>
<?php } ?>

		</select>
		<br>
		<label><?=lang('procedure', 'الأجراء', 1); ?></label>
		<select id="proc_slctor" class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" type="text" name="proc_id">
		<option value="1986" selected><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
<?php 
	$q = "SELECT `procedure_id`, `procedure_name` AS namer FROM `clinics_procedures` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$q_exe = mysqli_query($KONN, $q);
	$cc = 0;
	while($dr_datas = mysqli_fetch_assoc($q_exe)){
	?>
		<option value="<?=$dr_datas['procedure_id']; ?>"><?=$dr_datas['namer']; ?></option>
<?php } ?>
		</select>
		<br>
		<label><?=lang('doctor_name', 'اسم الطبيب', 1); ?></label>
		<select id="dr_slctor" class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" type="text" name="dr_id">
				<option value="1986" selected><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
<?php 
	$q = "SELECT `employee_id`, CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`is_dr` = 1) AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$q_exe = mysqli_query($KONN, $q);
	$cc = 0;
	while($dr_datas = mysqli_fetch_assoc($q_exe)){
		$sel = '';
		if($p_data['dr_id'] == $dr_datas['employee_id']){
			$sel = ' selected';
		}
?>
	<option value="<?=$dr_datas['employee_id']; ?>" <?=$sel; ?>><?=$dr_datas['namer']; ?></option>
<?php } ?>
		</select>
		<br>
		<label><?=lang('note', 'ملاحظات', 1); ?></label>
		<textarea id="note_slctor" class="data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="text" name="note"></textarea>
		
		
		<br>
	</form>
		
<!--button type="button" onclick="show_modal('applied_teeth');"><?=lang('multiple_teeth_procedure', 'إجراء متعدد', 1); ?></button-->
<button type="button" onclick="URLer = '<?=api_root; ?>patients/insert_patient_teeth_chart.php';redirecter = 'func_teeth';submit_form('pat_proc_submit_form');"><?=lang('insert_procedure', 'ادخال الاجراء', 1); ?></button>
		
		<button type="button" onclick="unslct_teeths();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		
		
		<br><br>
		<h2 class="whatever"><?=lang('previous_procedures', 'الاجراءات السابقة', 1); ?></h2>
		<div id="prev_proc">
		
		</div>
		
		
	</section>


<script>
function get_prev_proc(){
	//collect data
		var snt_data = new FormData();
		
		var teeth_slctor = parseInt($('#teeth_slctor').val());
		var patient_id = parseInt(<?=$p_data['patient_id']; ?>);
		
		if(teeth_slctor != 1986 && patient_id != 0){
		
				snt_data.append('teeth_no', teeth_slctor);
				snt_data.append('patient_id', patient_id);
				
				$.ajax({
					url     : '<?=api_root; ?>patients/get_patient_teeth_proc.php',
					data    : snt_data,
					contentType: false,
					processData: false,
					dataType  : 'html',
					method  : 'POST',
					beforeSend : function(){
						$('#prev_proc').html('<?=lang('DATA_LOADING_...', 'جاري التحميل', 1); ?>');
					},
					success : function(data){
						$('#prev_proc').html(data);
					},
					error : function(data){
						alert('load error' + data);
					}
				});
		}
	
	
}

$('#teeth_slctor').on('change', function(){
	get_prev_proc();
});
</script>
	
</section>






			</section>
		</section>
	
		<!-- insurance_information -->
		<section class="tab-holder">
<?php
//load insurance information
if( $p_data['insurance_type'] == 2){
	

$Q1A = "SELECT insurance_company_name AS namer FROM `insurance_companies` WHERE ( (`insurance_company_id` = ".$p_data['insurance_company'].") )";
$QEXE1 = mysqli_query($KONN, $Q1A);
$main_ins_D = mysqli_fetch_array($QEXE1);


$Q3 = "SELECT insurance_category_name AS namer, `discount` FROM `insurance_categories` WHERE ( (`insurance_category_id` = ".$p_data['insurance_category'].") )";
$QEXE1 = mysqli_query($KONN, $Q3);
$sub_ins_D = mysqli_fetch_array($QEXE1);

?>
			
			
			
				<div class="info-cont">
					<div class="info-title"><?=lang('insurance_company - discount_ratio', 'شركة التأمين - نسبة الخصم', 1); ?></div>
					<div class="info-value">
			<select class="data-input" req="1" id="file_insurance_discount" defaulter="" denier="0" alerter="please check inputs" type="text" name="insurance_category">
				<?php 
			$q = "SELECT * FROM `insurance_categories` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
			$q_exe = mysqli_query($KONN, $q);
				$cc = 0;
				while($cat_compDA = mysqli_fetch_assoc($q_exe)){
					$rlt = "";
					if($p_data['insurance_category'] == $cat_compDA['insurance_category_id']){
						$rlt = " selected";
					}
$QTW = "SELECT `insurance_company_name` FROM `insurance_companies` WHERE `insurance_company_id` =  '".$cat_compDA['insurance_company_id']."'";
$QTEW = mysqli_query($KONN, $QTW);
$QTRESW = mysqli_fetch_array($QTEW);
	
				?>

<option value="<?=$cat_compDA['insurance_category_id']; ?>" <?=$rlt; ?>><?=$QTRESW[0]; ?> - <?=$cat_compDA['insurance_category_name']; ?> - <?=$cat_compDA['discount']; ?></option>

				<?php
				}
				?>
			</select>
					
					</div>
				</div>
				
					
<?php
} else {
?>
				<div class="info-cont">
					<div class="info-title"><?=lang('patient_has_no_insurance', 'المريض ليس لديه تأمين', 1); ?></div>
					<div class="info-value"><?=lang('payment_method_:_CASH', 'وسيلة الدفع : نقدا', 1); ?></div>
				</div>
<?php
}
?>
			
			
		</section>
	
		<!-- appointments -->
		<section class="tab-holder">
			<h1><?=lang('patient_sessions_list', 'جلسات المريض', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('session_id', 'معرف الجلسة', 1); ?></td>
			<td><?=lang('session_date', 'تاريخ الجلسة', 1); ?></td>
			<td><?=lang('doctor', 'الطبيب', 1); ?></td>
			<td><?=lang('session_state', 'حالة الجلسة', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$qD = "SELECT * FROM `clinics_appointments` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY time_date DESC";
		$q_exeD = mysqli_query($KONN, $qD);
		if(mysqli_num_rows($q_exeD) > 0){
			while($db_data = mysqli_fetch_assoc($q_exeD)){
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['dr_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$doctor_db = mysqli_fetch_array($QEXE1);

		$stater = '';
switch($db_data['status']){
	case 1:
		$stater = lang('Pending', 'بالانتظار', 1);
		break;
	case 2:
		$stater = lang('Confirmed', 'مؤكدة', 1);
		break;
	case 3:
		$stater = lang('Canceled', 'ملغية', 1);
		break;
	case 4:
		$stater = lang('Blocked', 'محجوبة', 1);
		break;
	case 5:
		$stater = lang('checked-in', 'مسجل الدخول', 1);
		break;
	case 6:
		$stater = lang('No-Show', 'لم يظهر', 1);
		break;
	case 7:
		$stater = lang('Completed', 'تمت', 1);
		break;
}
?>
		<tr>
			<td><?=$db_data['appointment_id']; ?></td>
			<td><?=$db_data['time_date']; ?></td>
			<td><?=$doctor_db[0]; ?></td>
			<td><?=$stater; ?></td>
		</tr>
<?php
		$qC = "SELECT * FROM `clinics_appointments_notes` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `appointment_id` = ".$db_data['appointment_id']."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) )";
		$q_exeC = mysqli_query($KONN, $qC);
		if(mysqli_num_rows($q_exeC) > 0){
?>
		<tr>
			<td colspan="4">
				<h3><?=lang('appointment_notes', 'ملاحظات', 1); ?></h3>
				<table>
					<tbody>
<?php
			while($note_data = mysqli_fetch_assoc($q_exeC)){
?>
						<tr>
							<td><?=$note_data['note_content']; ?></td>
							<td><?=$note_data['date_added']; ?></td>
						</tr>
<?php
			}
?>
					</tbody>
				</table>
			</td>
		</tr>
<?php
		}
?>
		
<?php
			}
?>
			
			<?php
		} else {
?>
		<tr>
			<td colspan="4"><?=lang('No_Records_Found', 'لا توجد بيانات', 1); ?></td>
		</tr>
<?php
		}
?>
		</tbody>
</table>		
			
			
			
			
			
		</section>
	
		<!-- notes -->
		<section class="tab-holder">
			<h1><?=lang('patient_file_notes', 'ملاحظات ملف المريض', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('note', 'الملاحظة', 1); ?></td>
			<td><?=lang('added_by', 'أضيفة بواسطة', 1); ?></td>
			<td><?=lang('date', 'التاريخ', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$qD = "SELECT * FROM `patients_notes` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY added_date DESC";
		$q_exeD = mysqli_query($KONN, $qD);
		if(mysqli_num_rows($q_exeD) > 0){
			while($db_data = mysqli_fetch_assoc($q_exeD)){
?>
		<tr>
			<td><?=$db_data['note_content']; ?></td>
			<td><?=$db_data['added_by']; ?></td>
			<td><?=$db_data['added_date']; ?></td>
		</tr>
<?php
			}
		} else {
?>
		<tr>
			<td colspan="3"><?=lang('No_Records_Found', 'لا توجد بيانات', 1); ?></td>
		</tr>
<?php
		}
?>
		</tbody>
</table>		
			
			
			
			
			
			
			
			
		</section>
	
		<!-- patient_financials -->
		<section class="tab-holder">
			<h1><?=lang('patient_financials', 'الامور المالية', 1); ?></h1>
		
	<form id="profile_new_payment_form">
	
<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$patient_id; ?>" name="patient_id">

		
		<div class="form-control">
			<label><?=lang('payment_amount', 'الدفعة', 1); ?></label>
<input type="text" class="data-input" req="0" defaulter="" denier="" alerter="please check inputs" name="payment_amount">
		</div>
		
		<div class="form-control">
			<label><?=lang('payment_type', 'طريقة الدفع', 1); ?></label>
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="payment_type">
	<option value="1"><?=lang('Cash', 'نقدي', 1); ?></option>
	<option value="2"><?=lang('Card', 'بطاقة', 1); ?></option>
</select>
		</div>
		
		
		<div class="form-control">
			<label><?=lang('Note', 'ملاحظات', 1); ?></label>
			<input type="text" class="data-input" req="0" defaulter="" denier="" alerter="please check inputs" name="note">
		</div>

		<br>
		<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>patients/insert_payment.php';redirecter = 'close_modal';submit_form('profile_new_payment_form');"><?=lang('add_payment', 'إضافة الدفعة', 1); ?></button>
		</div>
		<br>
		<br>
		<?php
		// *************Tawfiq passed by here****************

			

			$q = "SELECT * FROM `patients_medications` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
			$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$toter = $toter + ($db_data['dose']*$db_data['price']);
			}

			$q = "SELECT * FROM `patients_lab_exams` WHERE ( ( `price` <> 0  ) AND ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
			$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
            $thsV = (double) $db_data['price'];
			$toter = $toter + $thsV;
			}

			$q = "SELECT * FROM `patients_procedures` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
			$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$thsP = (double) $db_data['price'];
				$thsQ = (double) $db_data['qty'];
				$thsTot = $thsQ * $thsP;
				$toter = $toter + $thsTot;
			}

			$Q13 = "SELECT * FROM `patients_procedures` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";

			$QEXE13 = mysqli_query($KONN, $Q13);


			$totla_dbPay = $totla_dbPay + $dbPay;
			foreach ($QEXE13 as $key => $pat) {
				// *********
				$Q14 = "SELECT * FROM `patients_payments` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) )";
				$total_payss = 0;
				$QEXE14 = mysqli_query($KONN, $Q14);
				foreach ($QEXE14 as $key => $value) {
					$pay = (double) $value['payment_amount'];
					$total_payss = $total_payss + $pay;
					
				}
				
				// *************

				$totla_price = (($pat['price'] * $pat['qty']) - $total_payss);
			}

			$totla_price = $toter - $total_payss;

			//. *************Tawfiq passed by here****************
		 ?>
		<div class="form-control">
				<h2><?=lang('Remaining amount', 'المبلغ المتبقي', 1); ?></h2>
				<p style="font-size: 22px;font-weight: bold;color: red;"><?=$totla_price?></p>
			</div>
	</form>
	<br>
	<hr>
	<br>
			<h1><?=lang('patient_payments_list', 'قائمة الدفعات', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('NO.', 'الرقم', 1); ?></td>
			<td><?=lang('Payemnt Amount', 'الدفعة', 1); ?></td>
			<td><?=lang('Payemnt Type', 'طريقة الدفع', 1); ?></td>
			<td><?=lang('Reciepent', 'المستلم', 1); ?></td>
			<td><?=lang('date', 'التاريخ', 1); ?></td>
			<td><?=lang('note', 'ملاحظات', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$q = "SELECT * FROM `patients_payments` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
		if(mysqli_num_rows($q_exe) > 0){
			$rrr = 0;
			$pays = 0;
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$rrr++;
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['reciepent'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$doctor_db = mysqli_fetch_array($QEXE1);
$thsP = (double) $db_data['payment_amount'];
$pays = $pays + $thsP;

$typo = $db_data['payment_type'];
$typer = '';
if( $typo == 1 ){
    $typer = lang('Cash', 'نقدي', 1);
} else {
    $typer = lang('Card', 'بطاقة', 1);
}
?>
		<tr>
			<td><?=$rrr; ?></td>
			<td><?=$thsP; ?></td>
			<td><?=$typer; ?></td>
			<td><?=$doctor_db[0]; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$db_data['note']; ?></td>
		</tr>
<?php
			}
			?>
		<tr>
			<td colspan="2"><?=lang('Total :', 'المجموع :', 1); ?></td>
			<td colspan="3"><?=$pays; ?></td>
		</tr>
			<?php
		} else {
?>
		<tr>
			<td colspan="5"><?=lang('No_Records_Found'); ?></td>
		</tr>
<?php
		}
?>
	</tbody>
</table>
	<br>
	<hr>
	<br>
			<h1><?=lang('patient_usage_list', 'قائمة المستهلكات', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('NO.', 'الرقم', 1); ?></td>
			<td><?=lang('Type', 'النوع', 1); ?></td>
			<td><?=lang('Name', 'الاسم', 1); ?></td>
			<td><?=lang('Date', 'التاريخ', 1); ?></td>
			<td><?=lang('qty', 'الكمية', 1); ?></td>
			<td><?=lang('U.price', 'سعر الوحدة', 1); ?></td>
			<td><?=lang('Total', 'مجموع', 1); ?></td>
			</tr>
	</thead>
	<tbody>
<?php
$tt=1;
$toter=0;
		$q = "SELECT * FROM `patients_medications` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$toter = $toter + ($db_data['dose']*$db_data['price']);
?>
		<tr>
			<td><?=$tt++; ?></td>
			<td><?=lang('Mediciation', 'دواء', 1); ?></td>
			<td><?=$db_data['medication_name']; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$db_data['dose']; ?></td>
			<td><?=$db_data['price']; ?></td>
			<td><?=$db_data['dose']*$db_data['price']; ?></td>
		</tr>
<?php
			}
			?>
<?php
		$q = "SELECT * FROM `patients_lab_exams` WHERE ( ( `price` <> 0  ) AND ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
            $thsV = (double) $db_data['price'];
			$toter = $toter + $thsV;
?>
		<tr>
			<td><?=$tt++; ?></td>
			<td><?=lang('Lab_Exam', 'فحص مخبري', 1); ?></td>
			<td><?=$db_data['lab_exam_name']; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td>1</td>
			<td><?=$thsV; ?></td>
			<td><?=$thsV; ?></td>
		</tr>
<?php
			}
			?>
<?php
		$q = "SELECT * FROM `patients_procedures` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$thsP = (double) $db_data['price'];
				$thsQ = (double) $db_data['qty'];
				$thsTot = $thsQ * $thsP;
				$toter = $toter + $thsTot;
?>
		<tr>
			<td><?=$tt++; ?></td>
			<td><?=lang('Procedure', 'إجراء طبي', 1); ?></td>
			<td><?=$db_data['procedure_name']; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$thsQ; ?></td>
			<td><?=$thsP; ?></td>
			<td><?=$thsTot; ?></td>
		</tr>
<?php
			}
			?>
			
			
			
			
			
			
			
			
			
			
		<tr>
			<td colspan="5"><?=lang('Total :', 'المجموع :', 1); ?></td>
			<td><?=$toter; ?></td>
		</tr>
		
	</tbody>
</table>
			
			
			
			
			
			
			
			
			
		</section>
	
		<!-- doctor_transfers -->
		<section class="tab-holder">
			<h1><?=lang('patient_doctor_transfers', 'تنقلات الأطباء', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('transfer_date', 'تاريخ النقل', 1); ?></td>
			<td><?=lang('old_doctor', 'الطبيب القديم', 1); ?></td>
			<td><?=lang('new_doctor', 'الطبيب الجديد', 1); ?></td>
			<td><?=lang('transfer_note', 'ملاحظات', 1); ?></td>
			<td><?=lang('transfered_by', 'نقل بواسطة', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$qD = "SELECT * FROM `patients_doctors_transfers` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY transfer_id DESC";
		$q_exeD = mysqli_query($KONN, $qD);
		if(mysqli_num_rows($q_exeD) > 0){
			while($db_data = mysqli_fetch_assoc($q_exeD)){
$Q31 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['old_dr'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE31 = mysqli_query($KONN, $Q31);
$old_doctor = mysqli_fetch_array($QEXE31);

$Q31 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['new_dr'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE31 = mysqli_query($KONN, $Q31);
$new_doctor = mysqli_fetch_array($QEXE31);

$Q31 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['transferer'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE31 = mysqli_query($KONN, $Q31);
$transferer = mysqli_fetch_array($QEXE31);
?>
		<tr>
			<td><?=$db_data['transfer_date']; ?></td>
			<td><?=$old_doctor[0]; ?></td>
			<td><?=$new_doctor[0]; ?></td>
			<td><?=$db_data['transfer_note']; ?></td>
			<td><?=$transferer[0]; ?></td>
		</tr>
<?php
			}
		} else {
?>
		<tr>
			<td colspan="5"><?=lang('No_Records_Found', 'لا توجد بيانات', 1); ?></td>
		</tr>
<?php
		}
?>
		</tbody>
</table>		
			
			
			
		</section>
	
		<!-- medications -->
		<section class="tab-holder">
			<h1><?=lang('add_medication', 'إضافة دواء', 1); ?></h1>
		
	<form id="profile_new_mediciation_form">
<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$patient_id; ?>" name="patient_id">

		<div class="form-control">
			<label><?=lang('medication', 'الدواء', 1); ?></label>
			<select class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="medication_id">

				<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
<?php
$Q = "SELECT * FROM `clinics_medications` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	
	while($rec = mysqli_fetch_assoc($QEXE)){
?>
				<option value="<?=$rec['medication_id']; ?>"><?=$rec['medication_name']; ?></option>
<?php

	}
}
?>
			</select>
		</div>
		
		<div class="form-control">
			<label><?=lang('dose', 'الكمية', 1); ?></label>
			<input type="text" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" name="dose" value="0">
		</div>
		
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>patients/insert_medication.php';redirecter = 'close_modal';submit_form('profile_new_mediciation_form');"><?=lang('add_mediciation'); ?></button>
		</div>
	</form>
			

			<h1><?=lang('patient_medication_list', 'قائمة ادوية المريض', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('medication', 'الدواء', 1); ?></td>
			<td><?=lang('doctor', 'الطبيب', 1); ?></td>
			<td><?=lang('dose', 'الكمية', 1); ?></td>
			<td><?=lang('date', 'التاريخ', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$q = "SELECT * FROM `patients_medications` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
		if(mysqli_num_rows($q_exe) > 0){
			while($db_data = mysqli_fetch_assoc($q_exe)){
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['dr_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$doctor_db = mysqli_fetch_array($QEXE1);
?>
		<tr>
			<td><?=$db_data['medication_name']; ?></td>
			<td><?=$doctor_db[0]; ?></td>
			<td><?=$db_data['dose']; ?></td>
			<td><?=$db_data['date_time']; ?></td>
		</tr>
<?php
			}
			?>
			
			<?php
		} else {
?>
		<tr>
			<td colspan="4"><?=lang('No_Records_Found', 'لا توجد بيانات', 1); ?></td>
		</tr>
<?php
		}
?>
	</tbody>
</table>
			
			
			
		</section>
	
		<!-- lab_exams -->
		<section class="tab-holder">
			<h1><?=lang('Add_new_patient_labexam', 'إضافة فحص مخبري للمريض', 1); ?></h1>
		
	<form id="profile_new_labexam_form">
	
<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$patient_id; ?>" name="patient_id">

		<div class="form-control">
			<label><?=lang('labexam', 'الفحص', 1); ?></label>
			<select class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="lab_exam_id">

				<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
	<?php
	$Q = "SELECT * FROM `clinics_labs_exams` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$QEXE = mysqli_query($KONN, $Q);
	$NUM_REC = mysqli_num_rows($QEXE);
	if($NUM_REC > 0){
		while($rec = mysqli_fetch_assoc($QEXE)){
			
$Q1 = "SELECT `lab_name` FROM `clinics_labs` WHERE ( (`lab_id` = ".$rec['lab_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$lab_db = mysqli_fetch_array($QEXE1);
			
			
	?>
<option value="<?=$rec['lab_exam_id']; ?>"><?=$lab_db[0]; ?> - <?=$rec['lab_exam_name']; ?></option>
	<?php

		}
	}
	?>
			</select>
		</div>
		
		
		<div class="form-control">
			<label><?=lang('Note', 'ملاحظات', 1); ?></label>
<input type="text" class="data-input" req="0" defaulter="" denier="" alerter="please check inputs" name="note">
		</div>
		<br>
		<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>patients/insert_labexam.php';redirecter = 'close_modal';submit_form('profile_new_labexam_form');"><?=lang('add_procedure', 'إضافة الفحص', 1); ?></button>
		</div>
	</form>
	<br>
	<hr>
	<br>
			<h1><?=lang('patient_labexams_list', 'قائمة فحوصات المختبر', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('labexam', 'الفحص', 1); ?></td>
			<td><?=lang('date', 'التاريخ', 1); ?></td>
			<td><?=lang('note', 'ملاحظات', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$q = "SELECT * FROM `patients_lab_exams` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
		if(mysqli_num_rows($q_exe) > 0){
			while($db_data = mysqli_fetch_assoc($q_exe)){
				/*
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['dr_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$doctor_db = mysqli_fetch_array($QEXE1);
*/
?>
		<tr>
			<td><?=$db_data['lab_exam_name']; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$db_data['note']; ?></td>
		</tr>
<?php
			}
			?>
			
			<?php
		} else {
?>
		<tr>
			<td colspan="5"><?=lang('No_Records_Found'); ?></td>
		</tr>
<?php
		}
?>
	</tbody>
</table>
		</section>
	
		<!-- procedures -->
		<section class="tab-holder">
			<h1><?=lang('Add_new_patient_procedure', 'إضافة إجراء للمريض', 1); ?></h1>
		
	<form id="profile_new_procedure_form">
	
<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$patient_id; ?>" name="patient_id">

		<div class="form-control">
			<label><?=lang('Procedure', 'الإجراء', 1); ?></label>
			<select class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="procedure_id">

				<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
	<?php
	$Q = "SELECT * FROM `clinics_procedures` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$QEXE = mysqli_query($KONN, $Q);
	$NUM_REC = mysqli_num_rows($QEXE);
	if($NUM_REC > 0){
		
		while($rec = mysqli_fetch_assoc($QEXE)){
	?>
					<option value="<?=$rec['procedure_id']; ?>"><?=$rec['procedure_name']; ?></option>
	<?php

		}
	}
	?>
			</select>
		</div>
		
		<div class="form-control">
			<label><?=lang('qty', 'الكمية', 1); ?></label>
			<input type="text" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" name="qty" value="0">
		</div>
		
		<div class="form-control">
			<label><?=lang('Note', 'ملاحظات', 1); ?></label>
<input type="text" class="data-input" req="0" defaulter="" denier="" alerter="please check inputs" name="note">
		</div>
		<br>
		<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>patients/insert_procedure.php';redirecter = 'close_modal';submit_form('profile_new_procedure_form');"><?=lang('add_procedure', 'إضافة الإجراء', 1); ?></button>
		</div>
	</form>
	<br>
	<hr>
	<br>
			<h1><?=lang('patient_procedure_list', 'قائمة إجراءات المريض', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('procedure', 'الاجراء', 1); ?></td>
			<td><?=lang('date', 'التاريخ', 1); ?></td>
			<td><?=lang('Notes', 'ملاحظات', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$q = "SELECT * FROM `patients_procedures` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
		if(mysqli_num_rows($q_exe) > 0){
			while($db_data = mysqli_fetch_assoc($q_exe)){
				/*
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['dr_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$doctor_db = mysqli_fetch_array($QEXE1);
*/
?>
		<tr>
			<td><?=$db_data['procedure_name']; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$db_data['note']; ?></td>
		</tr>
<?php
			}
			?>
			
			<?php
		} else {
?>
		<tr>
			<td colspan="5"><?=lang('No_Records_Found'); ?></td>
		</tr>
<?php
		}
?>
	</tbody>
</table>
		</section>
	
		<!-- media_attached -->
		<section class="tab-holder">
		

			<h1><?=lang('attach_new_media', 'رفع ملحق جديد', 1); ?></h1>
		
	<form id="profile_new_media_form">
<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$patient_id; ?>" name="patient_id">

		<div class="form-control">
			<label><?=lang('media_title', 'عنوان', 1); ?></label>
			<input type="text" class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" name="media_title">
		</div>
			
		<br>
		<div class="form-control">
			<label><?=lang('media', 'المادة', 1); ?></label>
			<input type="file" id="nw_media_path" class="data-input" req="1" defaulter="" denier="1" alerter="please check inputs" name="nw_media_path">
		</div>
		
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>patients/upload_media.php';redirecter = 'close_modal';submit_form('profile_new_media_form');"><?=lang('upload_media', 'رفع المحتوى', 1); ?></button>
		</div>
		
	</form>
		
		
		
			<h1><?=lang('patient_attached_files', 'ملحقات ملف المريض', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('title', 'العنوان', 1); ?></td>
			<td><?=lang('added_by', 'أضيف بواسطة', 1); ?></td>
			<td><?=lang('option', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$qsD = "SELECT * FROM `patients_media` WHERE ( ( `patient_id` = ".$patient_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY media_id DESC";
		$q_exeSS = mysqli_query($KONN, $qsD);
		if(mysqli_num_rows($q_exeSS) > 0){
			while($db_data = mysqli_fetch_assoc($q_exeSS)){
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['added_by'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$emp_db = mysqli_fetch_array($QEXE1);
				
?>
		<tr>
			<td><?=$db_data['media_title']; ?></td>
			<td><?=$emp_db[0]; ?></td>
			<td><a href="<?=uploads_root.$db_data['media_path']; ?>" target="_blank"><button type="button"><?=lang('view', 'عرض', 1); ?></button></a></td>
		</tr>
<?php
			}
		} else {
?>
		<tr>
			<td colspan="3"><?=lang('No_Records_Found', 'لا توجد بيانات', 1); ?></td>
		</tr>
<?php
		}
?>
		</tbody>
</table>		
		
		
		</section>
	
	
	
	
	</section>
	<div class="zero"></div>
</section>

















	
</section>
<br>



<section id="applied_teeth" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('multiple teeth_procedure', 'إجراء متعدد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body" id="multi_teeth_cont" style="position:relative;">
	<h5 class="whatever02"><?=lang('Please_select_the_teeth_on_which_you_want_to_apply_the_procedure', 'الرجاء التحديد لتطبيق الاجراء', 1); ?></h5>
	<section class="pat_teeth">
		<section class="pat_teeth_upper">
<?php for($r=1;$r<=16;$r++){ ?>
	<div onclick="slct_multiple_teeth(<?=$r; ?>);" is_selected="0" id="mult_teeth_<?=$r; ?>" class="teether teeth_<?=$r; ?>" ><?=$r; ?></div>
<?php } ?>
		</section>
		<section class="pat_teeth_downer">
<?php for($r=32;$r>=17;$r--){ ?>
	<div onclick="slct_multiple_teeth(<?=$r; ?>);" is_selected="0" id="mult_teeth_<?=$r; ?>" class="teether teeth_<?=$r; ?>" ><?=$r; ?></div>
<?php } ?>
		</section>
	</section>
	<form id="multiple_teeth_proc"></form>
		<div class="whatever03">
			<button type="button" onclick="insert_multiple_teeth();"><?=lang('apply_procedure', 'تطبيق الاجراء', 1); ?></button>
			<button type="button" onclick="cancel_multiple_teeth();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
</section>

<script>
function insert_multiple_teeth(){
	var frm_dat = new FormData();
	var ths_v = 0;
	$('.multi_teeth_inp').each(function(){
		ths_v = parseInt($(this).attr('value'));
		if(ths_v != 0){
			frm_dat.append('teeth[]', ths_v);
		}
	});
	
	//collect procedure
	var proc_id = parseInt($('#proc_slctor').val());
	var dr_id = parseInt($('#dr_slctor').val());
	var note = $('#note_slctor').val();
	
	if( proc_id != 1986 && dr_id != 1986 ){
		frm_dat.append('patient_id', <?=$p_data['patient_id']; ?>);
		frm_dat.append('proc_id', proc_id);
		frm_dat.append('dr_id', dr_id);
		frm_dat.append('note', note);
		
		$.ajax({
			url     : '<?=api_root; ?>patients/insert_multiple_teeth_procedure.php',
			data    : frm_dat,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				mk_alert('<?=lang('DATA_LOADING_...', 'جاري التحميل', 1); ?>', 'suc');
			},
			success : function(data){
				mk_alert(data, 'suc');
				cancel_multiple_teeth();
			},
			error : function(data){
				alert('load error' + data);
			}
		});
		
		
	} else {
		alert('<?=lang('please_select_procedure_or_doctor_name', 'خطأ, الرجاء تحديد الاجراء او اسم الطبيب', 1); ?>');
	}
	
	
}

function cancel_multiple_teeth(){
	$('.multi_teeth_inp').each(function(){
		var ths_v = parseInt($(this).attr('value'));
		slct_multiple_teeth(ths_v);
	});
	hide_modal();
}

function slct_multiple_teeth(t_id){
	t_id = parseInt(t_id);
	var is_sel = parseInt($('#mult_teeth_' + t_id).attr('is_selected'));
	if(is_sel == 0){
		//select teeth
		$('#mult_teeth_' + t_id).addClass('selected_teeth');
		$('#mult_teeth_' + t_id).attr('is_selected', 1);
		var nw_input = '<input class="multi_teeth_inp" type="hidden" id="inp_multi_' + t_id + '" name="teeth[]" value="' + t_id + '">';
		$('#multiple_teeth_proc').append(nw_input);
	} else {
		//unselect teeth
		$('#mult_teeth_' + t_id).removeClass('selected_teeth');
		$('#mult_teeth_' + t_id).attr('is_selected', 0);
		$('#inp_multi_' + t_id ).remove();
	}
}

var selected_teeth = 0;
function slct_teeth(t_id){
	$('.selected_teeth').removeClass('selected_teeth');
	
	selected_teeth = 0;
	selected_teeth = parseInt(t_id);
	$('#teeth_' + selected_teeth).addClass('selected_teeth');
	$('#teeth_slctor').val(selected_teeth);
	get_prev_proc();
}

function unslct_teeths(){
	$('.selected_teeth').removeClass('selected_teeth');
	$('#teeth_slctor').val(1986);
	$('#proc_slctor').val(1986);
	$('#dr_slctor').val(1986);
	$('#note_slctor').val('');
	$('#prev_proc').html('');
	set_loader(0);
	slct_teeth(selected_teeth);
}
</script>




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
	
	
	
	
	/*
	
	
	
	

<section class="body-chart-viewer">
	
	<section class="body-parts">
		<ul class="parts-ul">
			<li class="part-li"><?=lang('all_body'); ?></li>
			<li class="part-li"><?=lang('cardiovascular_system'); ?></li>
			<li class="part-li"><?=lang('digestive_system'); ?></li>
			<li class="part-li"><?=lang('endocrine_system'); ?></li>
			<li class="part-li"><?=lang('integumentary_system'); ?></li>
			<li class="part-li"><?=lang('immune_system'); ?></li>
			<li class="part-li"><?=lang('muscular_system'); ?></li>
			<li class="part-li"><?=lang('nervous_system'); ?></li>
			<li class="part-li"><?=lang('urinary_system'); ?></li>
			<li class="part-li"><?=lang('reproductive_system'); ?></li>
			<li class="part-li"><?=lang('respiratory_system'); ?></li>
			<li class="part-li"><?=lang('skeletal_system'); ?></li>
		</ul>
	</section>
	
	<section class="body-viewer">
		
		
		
		
	</section>
	
	<div class="zero"></div>
</section>

			
	
	
	
	
	
	
	*/
	
?>









