<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Invoices List", 'قائمة الفواتير المصدرة', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 458;
$sub_id = 1;


	session_start();
	$go_to = "index.php";

$EMP_LEVEL = 1;
if( isset( $_SESSION['emp_level'] ) ){
	$EMP_LEVEL = ( int ) $_SESSION['emp_level'];
}
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


//payment_type
    $srchPay = 0;
	$dateTo = $dateFrom = "";
		if( isset( $_GET['d_from'] ) ){
			$dateFrom = test_inputs( $_GET['d_from'] ).'';
		}
		if( isset( $_GET['d_to'] ) ){
			$dateTo = test_inputs( $_GET['d_to'] );
		}
		if( isset( $_GET['payment_type'] ) ){
			$srchPay = ( int ) test_inputs( $_GET['payment_type'] );
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
		
		
		if( $qCond != "" ){
			if( $srchPay != 0 ){
				$qCond = $qCond." AND ( `payment_type` =  '$srchPay')";
			}
		} else {
			if( $srchPay != 0 ){
				$qCond = " AND ( `payment_type` =  '$srchPay')";
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
					<div class="info-title"><?=lang('Type', 'الدفع', 1); ?>*</div>
					<div class="info-value">
<select class="data-input" id="payment_type" name="payment_type">
    <option value="0"><?=lang('All', 'الكل', 1); ?></option>
    <option value="1"><?=lang('Cash', 'نقدي', 1); ?></option>
    <option value="2"><?=lang('Card', 'بطاقة', 1); ?></option>
</select>
<script>
    $('#payment_type').val('<?=$srchPay; ?>');
</script>
					</div>
				</div>
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
				<div class="info-cont">
					<div class="info-title">&nbsp;</div>
					<div class="info-value">
<button type="button" onclick="printDiv();"><?=lang('Print', 'طباعة', 1); ?></button>
					</div>
				</div>
			</form>
<script>
function printDiv() {
     var printContents = document.getElementById('printer').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<div id="printer">
<table border="1" style="width:100%;margin:0 auto;">
	<thead>
		<tr>
			<td><?=lang('NO.', 'الرقم', 1); ?></td>
			<td><?=lang('Reciepent', 'المستلم', 1); ?></td>
			<td><?=lang('Patient', 'المريض', 1); ?></td>
			<td><?=lang('date', 'التاريخ', 1); ?></td>
			<td><?=lang('note', 'ملاحظات', 1); ?></td>
			<td><?=lang('Payemnt Amount', 'الدفعة', 1); ?></td>
			<td><?=lang('Remaining amount', 'المبلغ المتبقي', 1); ?></td>
			<td><?=lang('Payemnt Type', 'طريقة الدفع', 1); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
		
		
		$q = "SELECT * FROM `patients_payments` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." ) $qCond )";
		$q_exe = mysqli_query($KONN, $q);

		if(mysqli_num_rows($q_exe) > 0){
			$rrr = 0;
			$pays = 0;
			$totla_price = 0;
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$rrr++;
$Q1 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`employee_id` = ".$db_data['reciepent'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE1 = mysqli_query($KONN, $Q1);
$doctor_db = mysqli_fetch_array($QEXE1);
$rec = '';
if($doctor_db){
    $rec = $doctor_db[0];
}

$Q12 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `patients` WHERE ( (`patient_id` = ".$db_data['patient_id'].") )";
$QEXE12 = mysqli_query($KONN, $Q12);
$pat_db = mysqli_fetch_array($QEXE12);
$patter = "--";
if($pat_db){
    $patter = $pat_db[0];
}

$typo = $db_data['payment_type'];
$typer = '';
if( $typo == 1 ){
    $typer = lang('Cash', 'نقدي', 1);
} else {
    $typer = lang('Card', 'بطاقة', 1);
}
$dbPay = (double) $db_data['payment_amount'];
$pays = $pays + $dbPay;

// *************Tawfiq passed by here****************
$Q13 = "SELECT * FROM `patients_procedures` WHERE ( ( `patient_id` = ".$db_data['patient_id']."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";

$QEXE13 = mysqli_query($KONN, $Q13);

$totla_dbPay = $totla_dbPay + $dbPay;
foreach ($QEXE13 as $key => $pat) {

	// $Q14 = "SELECT * FROM `patients_payments` WHERE ( ( `patient_id` = ".$db_data['patient_id']."  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) )";
	// $total_payss = 0;
	// $QEXE14 = mysqli_query($KONN, $Q14);
	// foreach ($QEXE14 as $key => $value) {
	// 	$pay = (double) $value['payment_amount'];
	// 	$total_payss = $total_payss + $pay;

	// }
	

	$totla_price =  ($pat['price'] * $pat['qty']) - $total_patient_pay;
	//. *************Tawfiq passed by here****************
}

?>
		<tr>
			<td><?=$rrr; ?></td>
			<td><?=$rec; ?></td>
			<td><?=$patter; ?></td>
			<td><?=$db_data['date_time']; ?></td>
			<td><?=$db_data['note']; ?></td>
			<td><?=$dbPay; ?></td>
			<td><?=$db_data['remaining_amount']; ?></td>
			<td><?=$typer; ?></td>
		</tr>
<?php
			}
			?>
		<tr>
			<td colspan="4"></td>
			<td><?=lang('Total :', 'المجموع :', 1); ?></td>
			<td><?=$pays; ?></td>
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
</div>



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
