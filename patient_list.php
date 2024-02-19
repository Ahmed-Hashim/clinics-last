<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Patient List", 'قائمة المرضى', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 3;
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
		
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder">


<section style="text-align:center;">
<?php
$rchF = '';
$cond = '';
if(isset($_GET['srch_fr']) && isset($_GET['srch_id'])){
	$rchF = test_inputs($_GET['srch_fr']);
	$srch_id = (int) test_inputs($_GET['srch_id']);
	$col_n = '';
	$srch = '';
	if($srch_id == '1'){
		//file no
		$col_n = 'file_num';
		$srch = $rchF;
	} elseif($srch_id == '2'){
		//phone no
		$col_n = 'mobile';
		$srch = $rchF;
	} elseif($srch_id == '3') {
		//name
		$col_n = 'first_name';
		$srch = $rchF;
		$cond = " AND (( `first_name` LIKE '%".$srch."%') OR ( `second_name` LIKE '%".$srch."%') OR ( `third_name` LIKE '%".$srch."%') OR ( `last_name` LIKE '%".$srch."%'))";
	}
	
	
	if($srch_id != '3') {
		//NOT name
		$cond = " AND ( `".$col_n."` LIKE '%".$srch."%')";
	}
}
?>
	<form method="get">
		<select name="srch_id" value="<?=$rchF; ?>" style="padding: 10px 20px;width: 20%;margin-top: 20px;display:inline-block;">
			<option value="0"><?=lang('-- Please Select --', 'الرجاء الإختيار', 1); ?></option>
			<option value="1"><?=lang('Search By file Num', 'بحث برقم الملف', 1); ?></option>
			<option value="2"><?=lang('Search By Phone', 'بحث برقم الهاتف', 1); ?></option>
			<option value="3"><?=lang('Search By Name', 'بحث بالاسم', 1); ?></option>
		</select>
		<input type="text" name="srch_fr" value="<?=$rchF; ?>" style="padding: 10px 20px;width: 50%;margin-top: 20px;display:inline-block;">
	</form>
</section>



<table>
	<thead>
		<tr>
			<td></td>
			<td><?=lang('file_no', 'رقم الملف', 1); ?></td>
			<td><?=lang('patient_name', 'اسم المريض', 1); ?></td>
			<td><?=lang('Mobile', 'رقم الموبايل', 1); ?></td>
			<td><?=lang('age', 'العمر', 1); ?></td>
			<td><?=lang('doctor', 'الطبيب', 1); ?></td>
			<td><?=lang('options', 'الخيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>

<?php
$Q = "SELECT * FROM `patients` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") ".$cond." )";



if( $QEXE = mysqli_query($KONN, $Q) ){
$NUM_REC = mysqli_num_rows($QEXE);

	$cou = 2;
	$ff = 0;
	while($rec = mysqli_fetch_assoc($QEXE)){
	    
	    
	    /*
	    $ff++;
	    $cID = ( int ) $_SESSION['clinic_id'];
	    if( $cID == 1006 ){
	        $thsID = $rec['patient_id'];
	    	$Q11 = "UPDATE `patients` SET `file_num` = '$ff' WHERE ( (`patient_id` = ".$thsID.") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
	    	$QEXE11 = mysqli_query($KONN, $Q11);
	    }
	    
	    */
	    
	    
	    
	    
	    
		$gender_class = 'male';
		switch($rec['gender']){
			case 1:
				$gender_class = lang('male', 'ذكر', 1);
				break;
			case 2:
				$gender_class = lang('female', 'أنثى', 1);
				break;
		}
	$dob_arr = explode('-', $rec['dob']);
	$pat_age = date('Y') - $dob_arr[0];
	
		$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$rec['dr_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		$QEXE1 = mysqli_query($KONN, $Q1);
		$doctor_db = mysqli_fetch_array($QEXE1);
		
		$wLink = '';
		if( $rec['mobile'] != '' ){
			if( $rec['mobile'] != '0' ){
				$wLink = '<a href="https://api.whatsapp.com/send?phone='.$rec['mobile'].'" target="_blank"><button type="button"><i class="fa fa-whatsapp" area-hidden="true"></i></button></a>';
			}
		}
	
?>
		<tr id="patt-<?=$rec['patient_id']; ?>">
			<td>&nbsp;&nbsp;&nbsp;<i class="fa fa-<?=trim($gender_class); ?>" area-hidden="true"></i>&nbsp;&nbsp;&nbsp;</td>
			<td><?=$rec['file_num']; ?></td>
			<td><?=$rec['first_name'].' '.$rec['second_name'].' '.$rec['third_name'].' '.$rec['last_name'];?></td>
			<td>&nbsp;&nbsp;&nbsp;<?=$rec['mobile'].' '.$wLink; ?>&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;<?=$pat_age; ?>&nbsp;&nbsp;&nbsp;</td>
			<td><?=$doctor_db[0]; ?></td>
			<td>
				<form method="get" action="patient_file.php" id="pat_frm_view<?=$rec['patient_id']; ?>" style="display:none;">
					<input type="hidden" name="p_id" value="<?=$rec['patient_id']; ?>">
				</form>
				<button onclick="$('#pat_frm_view<?=$rec['patient_id']; ?>').submit();" type="button"><?=lang('view-edit', 'عرض - تحرير', 1); ?></button>
				<button onclick="add_new_appointment_patient(<?=$rec['file_num']; ?>, <?=$rec['dr_id']; ?>);" type="button"><?=lang('add_appointment', 'إضافة موعد', 1); ?></button>
				<button onclick="show_note_modal(<?=$rec['patient_id']; ?>);" type="button"><?=lang('add_note', 'إضافة ملاحظة', 1); ?></button>
				<button onclick="show_transfer_modal(<?=$rec['patient_id']; ?>);" type="button"><?=lang('transfer_doctor', 'نقل الطبيب', 1); ?></button>
				<button onclick="delPatFile(<?=$rec['patient_id']; ?>);" type="button" style="background: red;color: white;"><?=lang('Delete_file', 'حذف_الملف', 1); ?></button>
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

<script>
    function delPatFile( pId ){
       
        var cc = confirm("<?=lang('Are_you_sure?', 'هل_انت_متأكد؟', 1); ?>");
        if( cc == true ){

            $.ajax({
            	url     : '<?=api_root; ?>patients/del_patient.php',
            	data    : { 'patient_id': pId },
            	dataType  : 'html',
            	method  : 'POST',
            	success : function(data){
            		$('#patt-' + pId).remove();
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
