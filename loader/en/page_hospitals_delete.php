<?php
	$PAGE_TITLE = 'My site CP';
	$PG_title = 'My site CP';
	$PG_desc = 'desc';
	$PG_keywords = 'keywords';
	$PG_author = 'author';
	$pager = 1;
	$sub_page = 1;
	$has_sub = true;
	$has_slider = false;
session_start();
$no_session = true;
$main_pointer = '../../';
	require_once('../../bootstrap/app_config.php');
	
	$ths_id = 0;
	if(isset($_GET['pf_id'])){
		$ths_id = (int) test_inputs($_GET['pf_id']);
	} else {
		
		header("location:page_clinics.php");
	}


	$qq = "SELECT * FROM `clinics` WHERE `clinic_id` = '".$ths_id."'";
	$qqEE = mysqli_query($KONN, $qq);
	$row;

	if(mysqli_num_rows($qqEE) > 0){
		$row = mysqli_fetch_assoc($qqEE);
	} else {
		header("location:index.php");
	}
	
	

	
if( isset($_GET['pf_id'])){

	$qu_clinics_updt = "UPDATE  `clinics` SET 
						`is_deleted` = 1 WHERE `clinic_id` = '".$_GET['pf_id']."'";

	$qu_clinics_updt2 = "UPDATE  `employees_sys_cred` SET 
						`is_deleted` = 1 WHERE `clinic_id` = '".$_GET['pf_id']."'";

	if(mysqli_query($KONN, $qu_clinics_updt)){
		if(mysqli_query($KONN, $qu_clinics_updt2)){
			session_start();
			$_SESSION['message'] = '<div class="alert alert-style">
						  تم الغاء التفعيل بنجاح
						</div>';
			header("location:index.php");
		}
	}

}

	