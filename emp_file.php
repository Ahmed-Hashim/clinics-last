<?php
require_once('bootstrap/app_config.php');
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 5;
$sub_id = 2;

$employee_id = 0;
	session_start();
	$go_to = "emp_list.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){

			if(isset($_POST['p_id'])){
				$employee_id = (int) test_inputs($_POST['p_id']);
$Q = "SELECT * FROM `clinics_employees` WHERE ( (`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$p_data = mysqli_fetch_assoc($QEXE);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC != 1){
	header('location:'.$go_to.'?fail=5646');	
}
$p_name = $p_data['first_name'].' '.$p_data['last_name'];

$page_title = lang("employee_File", 'ملف الموظف ', 1)." :: ".$p_name;
	
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
<button onclick="show_emp_note_modal(<?=$p_data['employee_id']; ?>);" type="button"><?=lang('add_note', 'إضافة ملاحظة', 1); ?></button>

	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder"><br>

<form id="upload_emp_profile_pic" style="display:none;">
	<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$employee_id; ?>" name="employee_id">
	<input type="file" class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" id="profile_pic_choser" name="profile_pic_choser">
</form>

<section class="profile-main">
	<section class="profile-pic">
		<img onclick="$('#profile_pic_choser').click();" id="profile_img" src="<?=uploads_root.$p_data['profile_pic']; ?>" alt="<?=lang('profile_pic'); ?>">
	</section>
	<section class="profile-name">
		<h1><i class="fa fa-<?=$gender_class; ?>" area-hidden="true"></i> - <?=$p_name; ?></h1>
		<div class="profile-data"><span><?=lang('age', 'العمر', 1); ?></span>:<i class="nw_age"><?=$pat_age; ?><?=lang('_years', ' سنة', 1); ?></i></div>
		<div class="profile-data"><span><?=lang('join_date', 'تاريخ التوظيف', 1); ?></span>:<i><?=$p_data['join_date']; ?></i></div>
	</section>
	<div class="zero"></div>
</section>
<script>
function upload_profile_pic() {
	var aa = confirm('<?=lang('Save_new_profile_picture_?'); ?>');
	if(aa == true){
		URLer = '<?=api_root; ?>employee/upload_profile_pic.php';
		redirecter = 'close_modal';
		submit_form('upload_emp_profile_pic');
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
		<div class="tab"><?=lang('employee_information', 'معلومات الموظف', 1); ?></div>
		<div class="tab"><?=lang('financial_information', 'المالية', 1); ?></div>
		<div class="tab"><?=lang('notes', 'الملاحظات', 1); ?></div>
		<div class="tab"><?=lang('media_attached', 'الملحقات', 1); ?></div>
		<div class="zero"></div>
	</section>
	<section class="taber-body">
	
		<!-- employee_information -->
		<section class="tab-holder">
			<h1><?=lang('personal_information', 'المعلومات الشخصية', 1); ?></h1>
			<section class="data-holder">
<form id="edit_employee_data">
<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['employee_id']; ?>" type="hidden" name="employee_id">
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
					<div class="info-title"><?=lang('last_name', 'الاسم الاخير', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['last_name']; ?>" type="text" name="last_name">
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
	$('.nw_age').html(age + '<?=lang('_years', ' سنة', 1); ?>');
});
</script>
				<div class="info-cont-4">
					<div class="info-title"><?=lang('age', 'العمر', 1); ?></div>
					<div class="info-value"><span class="nw_age"><?=$pat_age; ?><?=lang('_years', ' سنة', 1); ?></span></div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('gender', 'الجنس', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="gender">
	<option value="1"<?php if($p_g==1){echo ' selected';} ?>><?=lang('male', 'ذكر', 1); ?></option>
	<option value="2"<?php if($p_g==2){echo ' selected';} ?>><?=lang('female', 'أنثى', 1); ?></option>
</select>
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('martial_status', 'الحالة الاجتماعية', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="martial_status">
	<option value="0"<?php if($p_data['martial_status']==0){echo ' selected';} ?>><?=lang('single', 'اعزب', 1); ?></option>
	<option value="1"<?php if($p_data['martial_status']==1){echo ' selected';} ?>><?=lang('married', 'متزوج', 1); ?></option>
</select>
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('nationality', 'الجنسية', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['nationality']; ?>" type="text" name="nationality">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('join_date', 'تاريخ التوظيف', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['join_date']; ?>" type="text" name="join_date">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('certification', 'المحصل العلمي', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['certification']; ?>" type="text" name="certification">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('graduation_date', 'تاريخ التخرج', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['graduation_date']; ?>" type="text" name="graduation_date">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('duty_start', 'ساعة بدء العمل', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['duty_start']; ?>" type="text" name="duty_start">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('duty_end', 'ساعة انتهاء العمل', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$p_data['duty_end']; ?>" type="text" name="duty_end">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('Is_Doctor', 'طبيب / اخصائي', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="is_dr" id="is_dr-emp">
	<option value="1" <?php if($p_data['is_dr'] == '1'){ echo ' selected'; } ?>><?=lang('Yes', 'نعم', 1); ?></option>
	<option value="0" <?php if($p_data['is_dr'] == '0'){ echo ' selected'; } ?>><?=lang('No', 'لا', 1); ?></option>
</select>
					</div>
				</div>
				
				
				<br>
				<!-- *************Tawfiq passed by here (add window.location.reload())**************** -->
<button type="button" onclick="URLer = '<?=api_root; ?>employee/update_employee_basic_info.php';redirecter = 'close_modal';submit_form('edit_employee_data');window.location.reload()"><?=lang('save_changes'); ?></button>
		
				
</form>
				
			</section>
		
			
			<h1><?=lang('contact_details', 'معلومات التواصل', 1); ?></h1>
<?php
	$contact_id = 0;
	$mobile = '';
	$landline = '';
	$email = '';
	$fax = '';
		
	$qu_employees_contacts_sel = "SELECT * FROM  `employees_contacts` WHERE ( (`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$qu_employees_contacts_EXE = mysqli_query($KONN, $qu_employees_contacts_sel);
	if(mysqli_num_rows($qu_employees_contacts_EXE)){
		$employees_contacts_DATA = mysqli_fetch_assoc($qu_employees_contacts_EXE);
		$contact_id = $employees_contacts_DATA['contact_id'];
		$mobile = $employees_contacts_DATA['mobile'];
		$landline = $employees_contacts_DATA['landline'];
		$email = $employees_contacts_DATA['email'];
		$fax = $employees_contacts_DATA['fax'];
	}
	

?>

			<section class="data-holder">
<form id="emp_contact_details_form">
<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['employee_id']; ?>" type="hidden" name="employee_id">

				<div class="info-cont">
					<div class="info-title"><?=lang('mobile', 'الموبايل', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$mobile; ?>" type="text" name="mobile">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('landline', 'الهاتف الارضي', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$landline; ?>" type="text" name="landline">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('email', 'البريد الإلكتروني', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$email; ?>" type="text" name="email">
					</div>
				</div>
				
			
				<br>
				<!-- *************Tawfiq passed by here (add window.location.reload())**************** -->
<button type="button" onclick="URLer = '<?=api_root; ?>employee/update_employee_contact_info.php';redirecter = 'close_modal';submit_form('emp_contact_details_form');window.location.reload()"><?=lang('save_changes'); ?></button>
		
				
</form>
			</section>
			
			<h1><?=lang('address_information', 'معلومات العنوان', 1); ?></h1>
<?php


	$country = '';
	$city = '';
	$area = '';
	$block = '';
	$street_name = '';
	$building_no = 0;
	$floor_no = 0;
	$apartment_no = 0;
		
	$qu_employees_address_sel = "SELECT * FROM  `employees_address` WHERE ( (`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	$qu_employees_address_EXE = mysqli_query($KONN, $qu_employees_address_sel);
	if(mysqli_num_rows($qu_employees_address_EXE)){
		$employees_address_DATA = mysqli_fetch_assoc($qu_employees_address_EXE);
		$address_id = $employees_address_DATA['address_id'];
		$country = $employees_address_DATA['country'];
		$city = $employees_address_DATA['city'];
		$area = $employees_address_DATA['area'];
		$block = $employees_address_DATA['block'];
		$street_name = $employees_address_DATA['street_name'];
		$building_no = $employees_address_DATA['building_no'];
		$floor_no = $employees_address_DATA['floor_no'];
		$apartment_no = $employees_address_DATA['apartment_no'];
	}
	
?>
			
			
			
			<section class="data-holder">
<form id="emp_address_details_form">
<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['employee_id']; ?>" type="hidden" name="employee_id">

				<div class="info-cont">
					<div class="info-title"><?=lang('country', 'البلد', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$country; ?>" type="text" name="country">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('city', 'المدينة', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$city; ?>" type="text" name="city">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('area', 'المنطقة', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$area; ?>" type="text" name="area">
					</div>
				</div>
				
			
				<div class="info-cont">
					<div class="info-title"><?=lang('block', 'الحي', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$block; ?>" type="text" name="block">
					</div>
				</div>
				
			
				<div class="info-cont">
					<div class="info-title"><?=lang('street_name', 'اسم الشارع', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$street_name; ?>" type="text" name="street_name">
					</div>
				</div>
				
			
				<div class="info-cont">
					<div class="info-title"><?=lang('building_no', 'رقم المبنى', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$building_no; ?>" type="text" name="building_no">
					</div>
				</div>
				
			
				<div class="info-cont">
					<div class="info-title"><?=lang('floor_no', 'الطابق', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$floor_no; ?>" type="text" name="floor_no">
					</div>
				</div>
				
			
				<div class="info-cont">
					<div class="info-title"><?=lang('apartment_no', 'رقم الشقة', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="<?=$apartment_no; ?>" type="text" name="apartment_no">
					</div>
				</div>
				
			
				<br>
				<!-- *************Tawfiq passed by here (add window.location.reload())**************** -->
<button type="button" onclick="URLer = '<?=api_root; ?>employee/update_employee_address_info.php';redirecter = 'close_modal';submit_form('emp_address_details_form');window.location.reload()"><?=lang('save_changes'); ?></button>
		
		
</form>
			</section>
			
			
			<h1><?=lang('system_credintials', 'معلومات النظام', 1); ?></h1>
<?php
$qurA = "SELECT * FROM `employees_sys_cred` WHERE ( (`employee_id` = ".$employee_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$aur_exe = mysqli_query($KONN, $qurA);
$user_cred = '';
$user_pass = '';
$emp_level = 0;

if(mysqli_num_rows($aur_exe) > 0){
	$user_data = mysqli_fetch_assoc($aur_exe);
	$user_cred = $user_data['username'];
	$user_pass = $user_data['password'];
	$emp_level = $user_data['emp_level'];
}

?>
			
			<section class="data-holder">
<form id="emp_sys_cred_details_form">
<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['employee_id']; ?>" type="hidden" name="employee_id">

				<div class="info-cont">
					<div class="info-title"><?=lang('username', 'إسم المستخدم', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$user_cred; ?>" type="text" name="username" autocomplete="off">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('password', 'كلمة السر', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="<?=$user_pass; ?>" type="password" name="password" autocomplete="off">
					</div>
				</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('Level', 'مستوى المستخدم', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="emp_level">
	<option value="1"<?php if($emp_level==1){echo ' selected';} ?>><?=lang('Employee', 'موظف', 1); ?></option>
	<option value="2"<?php if($emp_level==2){echo ' selected';} ?>><?=lang('Manager', 'مدير', 1); ?></option>
</select>
					</div>
				</div>
			
			
				
			
				<br>
				<!-- *************Tawfiq passed by here (add window.location.reload())**************** -->
<button type="button" onclick="URLer = '<?=api_root; ?>employee/update_employee_creds.php';redirecter = 'close_modal';submit_form('emp_sys_cred_details_form'); window.location.reload()"><?=lang('save_changes'); ?></button>
		
		
</form>
			</section>
			
			
			
		</section>
	
		<!-- financial_information -->
		<section class="tab-holder">
			<h1><?=lang('employee_financial_information', 'معلومات الموظف المالية', 1); ?></h1>
			<section class="data-holder">
<form id="edit_employee_financials">
<input class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$p_data['employee_id']; ?>" type="hidden" name="employee_id">
				<div class="info-cont-4">
					<div class="info-title"><?=lang('basic_salary', 'الراتب الاساسي', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="0" denier="" alerter="please check inputs" value="<?=$p_data['basic_salary']; ?>" type="text" name="basic_salary">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('commission', 'العمولة', 1); ?>&nbsp;(%)&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="0" denier="" alerter="please check inputs" value="<?=$p_data['commission']; ?>" type="text" name="commission">
					</div>
				</div>
				
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('clinic_department', 'القسم', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="<?=$p_data['clinic_department_id']; ?>" denier="0" alerter="please check inputs" name="clinic_department_id">

<?php
$Q = "SELECT * FROM `clinics_departments` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	$cou = 2;
	while($rec = mysqli_fetch_assoc($QEXE)){
		$rr = '';
		if($rec['clinic_department_id'] == $p_data['clinic_department_id']){
			$rr = ' selected';
		}
?>
	<option value="<?=$rec['clinic_department_id']; ?>" <?=$rr; ?>><?=$rec['clinic_department_name']; ?></option>
<?php
	}
}
?>
</select>
					</div>
				</div>
				
				
				
				
				
				
				
				<br>
				<!-- *************Tawfiq passed by here (add window.location.reload())**************** -->
<button type="button" onclick="URLer = '<?=api_root; ?>employee/update_employee_financial_info.php';redirecter = 'close_modal';submit_form('edit_employee_financials');window.location.reload()"><?=lang('save_changes'); ?></button>
		
				
</form>
				
			</section>
			
			
			
		</section>
	
		<!-- notes -->
		<section class="tab-holder">
			<h1><?=lang('employee_file_notes', 'ملاحظات ملف الموظف', 1); ?></h1>
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
		$qD = "SELECT * FROM `employees_notes` WHERE ( ( `employee_id` = ".$employee_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY added_date DESC";
		$q_exeD = mysqli_query($KONN, $qD);
		if(mysqli_num_rows($q_exeD) > 0){
			while($db_data = mysqli_fetch_assoc($q_exeD)){
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['added_by'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$emp_db = mysqli_fetch_array($QEXE1);
?>
		<tr>
			<td><?=$db_data['note_content']; ?></td>
			<td><?=$emp_db[0]; ?></td>
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
	
		<!-- media_attached -->
		<section class="tab-holder">
		

			<h1><?=lang('attach_new_media', 'ملحق جديد', 1); ?></h1>
		
	<form id="emp_new_media_form">
<input type="hidden" class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="<?=$employee_id; ?>" name="employee_id">

		<div class="form-control">
			<label><?=lang('media_title', 'عنوان', 1); ?></label>
			<input type="text" class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" name="media_title">
		</div>
			
		<br>
		<div class="form-control">
			<label><?=lang('media', 'الملحق', 1); ?></label>
			<input type="file" id="nw_emp_media_path" class="data-input" req="1" defaulter="" denier="1" alerter="please check inputs" name="nw_emp_media_path">
		</div>
		<br>
		<div class="form-control">
			<!-- *************Tawfiq passed by here (add window.location.reload())**************** -->
			<button type="button" onclick="URLer = '<?=api_root; ?>employee/upload_media.php';redirecter = 'close_modal';submit_form('emp_new_media_form');window.location.reload()"><?=lang('upload_media', 'تحميل', 1); ?></button>
		</div>
	
	
	
	</form>
		
		
		
			<h1><?=lang('employee_attached_files', 'قائمة الملحقات', 1); ?></h1>
<table>
	<thead>
		<tr>
			<td><?=lang('title', 'العنوان', 1); ?></td>
			<td><?=lang('added_by', 'أضيفة بواسطة', 1); ?></td>
			<td><?=lang('option', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		$qsD = "SELECT * FROM `employees_media` WHERE ( ( `employee_id` = ".$employee_id."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY media_id DESC";
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
		<h1 id="modal-title"><?=lang('multiple teeth_procedure'); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body" id="multi_teeth_cont" style="position:relative;">
	<h5 class="whatever02"><?=lang('Please_select_the_teeth_on_which_you_want_to_apply_the_procedure'); ?></h5>
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
			<button type="button" onclick="insert_multiple_teeth();"><?=lang('apply_procedure'); ?></button>
			<button type="button" onclick="cancel_multiple_teeth();"><?=lang('cancel'); ?></button>
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
		frm_dat.append('employee_id', <?=$p_data['employee_id']; ?>);
		frm_dat.append('proc_id', proc_id);
		frm_dat.append('dr_id', dr_id);
		frm_dat.append('note', note);
		
		$.ajax({
			url     : '<?=api_root; ?>employees/insert_multiple_teeth_procedure.php',
			data    : frm_dat,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				mk_alert('<?=lang('DATA_LOADING_...'); ?>', 'suc');
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
		alert('<?=lang('please_select_procedure_or_doctor_name'); ?>');
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
?>
