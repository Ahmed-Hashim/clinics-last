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
	
	
	
	
if( isset($_POST['clinic_id']) &&
	isset($_POST['clinic_name'])
	){

	$clinic_id = test_inputs($_POST['clinic_id']);
	$clinic_name = test_inputs($_POST['clinic_name']);
	$clinic_name_ar = test_inputs($_POST['clinic_name_ar']);
	$clinic_address = test_inputs($_POST['clinic_address']);
	$file_num_start = test_inputs($_POST['file_num_start']);
	$status = test_inputs($_POST['status']);

	$qu_clinics_updt = "UPDATE  `clinics` SET 
						`clinic_name` = '".$clinic_name."' WHERE `clinic_id` = $clinic_id;";

	if(mysqli_query($KONN, $qu_clinics_updt)){
		header("location:index.php");
	}

}

	
	
	
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<?php
	include('app/includes.php');
?>
</head>
<body id="bodyer">
<?php
	include('app/header.php');
	//PAGE DATA START
	//-----------------------------
?>
	<form id="page_form" method="post" enctype="multipart/form-data">
	
	<h1 class="main-page-title">Edit Clinic</h1>
	<input type="hidden" name="clinic_id" id="clinic_id" value="<?=$row['clinic_id']; ?>" />
	
	<section class="page-btns-holder">
		<button class="page-btn" onclick="$('#page_form').submit();" type="button">Save</button>
		<a href="index.php"><button class="page-btn" type="button" style="background:red;">Cancel</button></a>
	</section>
	
	<section class="page-content">
	

	
	

	<div class="row">
		<div class="col-1">
			<div class="form-item">
				<label>Clinic Name</label>
				<input type="text" name="clinic_name" id="clinic_name" value="<?=$row['clinic_name']; ?>" required />
			</div>
		</div>
	</div>
	
	
	

	
		
	</section>
	<section id="form_footer" class="page-btns-holder"></section>
	<script>$('#form_footer').html($('.page-btns-holder').html());</script>
	<br><br><br>
	</form>
	
	
<?php
	//-----------------------------
	//PAGE DATA END
	include('app/footer.php');
?>
</body>
</html>