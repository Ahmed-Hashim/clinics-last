<?php
require_once('bootstrap/app_config.php');
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 457;
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
$clinic_data = mysqli_fetch_assoc($QEXE);
$NUM_REC = mysqli_num_rows($QEXE);

if($NUM_REC != 1){
	header('location:'.$go_to.'?fail=564786876');	
}

$system_account_id = $clinic_data['system_account_id'];
$p_name = $clinic_data['clinic_name'];

$page_title = lang("System_Settings", 'معلومات النظام', 1)." :: ".$p_name;

$Q = "SELECT * FROM `system_accounts` WHERE ( (`system_account_id` = ".$system_account_id.") )";
$QEXE = mysqli_query($KONN, $Q);
$system_data = mysqli_fetch_assoc($QEXE);
$NUM_RECs = mysqli_num_rows($QEXE);

if($NUM_RECs != 1){
	header('location:'.$go_to.'?fail=564324346');	
}


$Q1 = "SELECT * FROM `accounts_subscriptions` WHERE ( (`system_account_id` = ".$system_account_id.") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$accounts_subscription_data = mysqli_fetch_assoc($QEXE1);
$NUM_RECsds = mysqli_num_rows($QEXE1);

if($NUM_RECsds != 1){
	die($Q1.mysqli_error($KONN));
	header('location:'.$go_to.'?fail=5435646');	
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

	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder"><br>


<section class="profile-taber">
	<section class="taber-tabs" id="tabs_holder">
		<div class="tab"><?=lang('general_information', 'معلومات عامة', 1); ?></div>
		<div class="zero"></div>
	</section>
	<section class="taber-body">
	
		<!-- clinic_information -->
		<section class="tab-holder">
			<h1><?=lang('clinic_information', 'معلومات العيادة', 1); ?>
			</h1>
			
			
			<div style="text-align:center;margin:0 auto;width:50%;">
				<img src="<?=image_root.'logo.png'; ?>" alt="" style="text-align:center;margin:0 auto;width:50%;">
			</div>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('clinic_id', 'المعرف', 1); ?></div>
					<div class="info-value"><?=$clinic_data['clinic_id']; ?></div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('clinic_short_code', 'كود الاختصار', 1); ?></div>
					<div class="info-value"><?=$clinic_data['clinic_short_code']; ?></div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('clinic_name', 'اسم العيادة', 1); ?></div>
					<div class="info-value"><?=$clinic_data['clinic_name']; ?></div>
				</div>
			<br>
			<h1><?=lang('system_information'); ?></h1>
			
				<div class="info-cont">
					<div class="info-title"><?=lang('system_account_id', 'معرف النظام', 1); ?></div>
					<div class="info-value"><?=$system_data['system_account_id']+2645; ?></div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('account_name', 'اسم الحساب', 1); ?></div>
					<div class="info-value"><?=$system_data['system_account_name']; ?></div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('Register_date', 'تاريخ التسجيل', 1); ?></div>
					<div class="info-value"><?=$system_data['reg_date']; ?></div>
				</div>
				
			<br>
			<h1><?=lang('account_information', 'معلومات الحساب', 1); ?></h1>
			
				<div class="info-cont-2">
					<div class="info-title"><?=lang('subscription_date', 'تاريخ الاشتراك', 1); ?></div>
					<div class="info-value"><?=$accounts_subscription_data['subscription_date']; ?></div>
				</div>
				
				<div class="info-cont-2">
					<div class="info-title"><?=lang('subscription_start_date', 'تاريخ بدء الاشتراك', 1); ?></div>
					<div class="info-value"><?=$accounts_subscription_data['subscription_start_date']; ?></div>
				</div>
				
				<div class="info-cont-2">
					<div class="info-title"><?=lang('subscription_end_date', 'تاريخ نهاية الاشتراك', 1); ?></div>
					<div class="info-value"><?=$accounts_subscription_data['subscription_end_date']; ?></div>
				</div>
<?php
$sts = ($accounts_subscription_data['subscription_status'] == 0) ? lang('Inactive', 'غير فعال', 1) : lang('Active_-_Pending_Payment', 'نشط - بانتظار الدفع', 1);
?>
				<div class="info-cont-2">
					<div class="info-title"><?=lang('subscription_status', 'حالة الاشتراك', 1); ?></div>
					<div class="info-value"><?=$sts; ?></div>
				</div>
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
