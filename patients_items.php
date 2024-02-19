<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Invoices List", 'قائمة الفواتير المصدرة', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 461;
$sub_id = 1;


	session_start();
	$go_to = "index.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){




	$dateTo = $dateFrom = "";
		if( isset( $_GET['d_from'] ) ){
			$dateFrom = test_inputs( $_GET['d_from'] ).'';
		}
		if( isset( $_GET['d_to'] ) ){
			$dateTo = test_inputs( $_GET['d_to'] );
		}
		$qCond = "";
		if( $dateFrom != "" ){
			$qCond = "AND ( `date_time` >=  '$dateFrom')";
		}
		
		if( $qCond != "" ){
			if( $dateTo != "" ){
				$qCond = $qCond." AND ( `date_time` <=  '$dateTo')";
			}
		} else {
			if( $dateTo != "" ){
				$qCond = " AND ( `date_time` <=  '$dateTo')";
			}
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
	<h1><?=lang($page_title); ?></h1>
	
	<!--section class="page-options">
		<button type="button" onclick="show_modal('nw_dept');"><?=lang('new_department', 'قسم جديد', 1); ?></button>
	</section-->
	
	<div class="zero"></div>
</section>
<?php } ?>




<section class="panel-holder">

			<form>
				<div class="info-cont">
					<div class="info-title"><?=lang('from', 'من', 1); ?>*</div>
					<div class="info-value">
<input class="has_date data-input" type="text" value="<?=$dateFrom; ?>" name="d_from">
					</div>
				</div>
				<div class="info-cont">
					<div class="info-title"><?=lang('to', 'الى', 1); ?>*</div>
					<div class="info-value">
<input class="has_date data-input" type="text" value="<?=$dateTo; ?>" name="d_to">
					</div>
				</div>
				<div class="info-cont">
					<div class="info-title">&nbsp;</div>
					<div class="info-value">
<button type="submit"><?=lang('Search', 'بحث', 1); ?></button>
					</div>
				</div>
			</form>

<table>
	<thead>
		<tr>
			<td><?=lang('NO.', 'الرقم', 1); ?></td>
			<td><?=lang('Patient', 'المريض', 1); ?></td>
			<td><?=lang('Type', 'النوع', 1); ?></td>
			<td><?=lang('Name', 'الاسم', 1); ?></td>
			<td><?=lang('qty', 'الكمية', 1); ?></td>
			<td><?=lang('U.price', 'سعر الوحدة', 1); ?></td>
			<td><?=lang('Total', 'مجموع', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
$tt=1;
$toter=0;
		$q = "SELECT * FROM `patients_medications` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." )  $qCond ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
			    
				$dose = (float) $db_data['dose'];
				$price = (float) $db_data['price'];
				$thsTot = $dose*$price;
				$toter = $toter + $thsTot;
				

$Q12 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `patients` WHERE ( (`patient_id` = ".$db_data['patient_id'].") )";
$QEXE12 = mysqli_query($KONN, $Q12);
$pat_db = mysqli_fetch_array($QEXE12);
if($pat_db){
?>
		<tr>
			<td><?=$tt++; ?></td>
			<td><?=$pat_db[0]; ?></td>
			<td><?=lang('Mediciation', 'دواء', 1); ?></td>
			<td><?=$db_data['medication_name']; ?></td>
			<td><?=$db_data['dose']; ?></td>
			<td><?=$db_data['price']; ?></td>
			<td><?=$thsTot; ?></td>
		</tr>
<?php
}
			}
			?>
<?php
		$q = "SELECT * FROM `patients_lab_exams` WHERE ( ( `price` <> 0  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." )  $qCond ) ORDER BY date_time DESC";
		
		
		$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
				
				$price = (float) $db_data['price'];
			$toter = $toter + $price;
				

$Q12 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `patients` WHERE ( (`patient_id` = ".$db_data['patient_id'].") )";
$QEXE12 = mysqli_query($KONN, $Q12);
$pat_db = mysqli_fetch_array($QEXE12);
if($pat_db){
?>
		<tr>
			<td><?=$tt++; ?></td>
			<td><?=$pat_db[0]; ?></td>
			<td><?=lang('Lab_Exam', 'فحص مخبري', 1); ?></td>
			<td><?=$db_data['lab_exam_name']; ?></td>
			<td>1</td>
			<td><?=$db_data['price']; ?></td>
			<td><?=$db_data['price']; ?></td>
		</tr>
<?php
}
			}
			?>
<?php
		$q = "SELECT * FROM `patients_procedures` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." )  $qCond ) ORDER BY date_time DESC";
		$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
if( $db_data['patient_id'] != '0' ){
				$qty = (float) $db_data['qty'];
				$price = (float) $db_data['price'];
				
				$toter = $toter + ($qty*$price);
				

$Q12 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `patients` WHERE ( (`patient_id` = ".$db_data['patient_id'].") )";
$QEXE12 = mysqli_query($KONN, $Q12);
$pat_db = mysqli_fetch_array($QEXE12);

$w1 = ( double ) $db_data['qty'];
$w2 = ( double ) $db_data['price'];
$w3 = $w1 * $w2;
if($pat_db){
?>
		<tr>
			<td><?=$tt++; ?></td>
			<td><?=$pat_db[0]; ?></td>
			<td><?=lang('Procedure', 'إجراء طبي', 1); ?></td>
			<td><?=$db_data['procedure_name']; ?></td>
			<td><?=$db_data['qty']; ?></td>
			<td><?=$db_data['price']; ?></td>
			<td><?=$w3; ?></td>
		</tr>
<?php
}
}
			}
			?>
			
		<tr>
			<td colspan="6"><?=lang('Total :', 'المجموع :', 1); ?></td>
			<td><?=$toter; ?></td>
		</tr>
	</tbody>
</table>




</section>

<script>
function edit_department(idd){
	idd = parseInt(idd);
	if(idd != 0){
		
		var snt_data = new FormData();
		//continue
		//send ajax request to load patient data
		snt_data.append('dept_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>departments/edit_dept.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري تحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('edit_department', 'تحرير القسم', 1); ?>');
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
