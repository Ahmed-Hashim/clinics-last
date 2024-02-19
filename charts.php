<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Charts", 'الرسوم البيانية', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 51;
$sub_id = 1;


session_start();
$go_to = "index.php";

$EMP_LEVEL = 1;
if (isset($_SESSION['emp_level'])) {
	$EMP_LEVEL = (int) $_SESSION['emp_level'];
}
if (isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])) {
	if (($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")) {
?>
		<!DOCTYPE html>
		<html dir="<?= $lang_dir; ?>" lang="<?= $lang; ?>">

		<head>
			<?php include(main_app_url . 'app/meta.php'); ?>
			<?php include(main_app_url . 'app/assets.php'); ?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
			<style>
				*,
				*::before,
				*::after {
					box-sizing: border-box;
				}

				.charts {
					display: flex;
					justify-content: center;
					align-items: center;
					flex-wrap: wrap;
				}

				.charts-canvas,
				.charts-box {
					max-width: 500px;
					width: 100%;
					flex-grow: 1;
					padding: 1rem;
					margin: 1rem;
				}

				.charts-box {
					display: flex;
					justify-content: center;
					align-items: center;
				}

				.charts-box__plus,
				.charts-box__minus {
					display: block;
					flex-grow: 1;
					padding: 1rem;
					margin: 2rem;
					border-radius: 0.5rem;
					color: var(--color-white);
					font-size: 1rem;
					font-weight: 600;
					white-space: nowrap;
					box-shadow: 10px 10px 10px var(--color-grey-dark);
				}

				.charts-box__plus {
					background-color: darkseagreen;
				}

				.charts-box__plus:hover {
					background-color: #12b312;
					box-shadow: 10px 10px 50px rgba(0, 300, 0, 0.5);
				}

				.charts-box__minus {
					background-color: var(--color-red);
				}

				.charts-box__minus:hover {
					background-color: #ff0000;
					box-shadow: 10px 10px 50px rgba(300, 0, 0, 0.5);
				}

				span {
					display: block;
				}

				/* .charts-box__plus-title {} */

				.charts-box__plus-amount {
					font-weight: bolder;
				}

				/* .charts-box__minus-title {} */

				.charts-box__minus-amount {
					font-weight: bolder;
				}

				@media screen and (max-width:1250px) {
					.charts-canvas,
					.charts-box {
						max-width: 80%;
					}

				}
			</style>
		</head>

		<body>
			<?php
			include(main_app_url . 'app/header.php');
			//PAGE DATA START ----------------------------------------------///---------------------------------
			?>
			<?php if ($show_page_title == true) { ?>
				<section class="page-title">
					<li id="mob-mnu-btn" class="mob-mnu-button" onclick="show_main_menu();" title="<?= lang('show_main_menu'); ?>">
						<i class="fa fa-bars" area-hidden="true"></i>
					</li>
					<h1><?= $page_title; ?></h1>

					<div class="zero"></div>
				</section>
			<?php } ?>

			<?php
			// *************Tawfiq passed by here****************

				$currentYear = date("Y");

				$Q12 = "SELECT * FROM `patients_procedures` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." ) AND (YEAR(`date_time`) = $currentYear) ) ORDER BY date_time DESC";
				$QEXE12 = mysqli_query($KONN, $Q12);

				$clinic_chart_arr['1'] = 0;
				$clinic_chart_arr['2'] = 0;
				$clinic_chart_arr['3'] = 0;
				$clinic_chart_arr['4'] = 0;
				$clinic_chart_arr['5'] = 0;
				$clinic_chart_arr['6'] = 0;
				$clinic_chart_arr['7'] = 0;
				$clinic_chart_arr['8'] = 0;
				$clinic_chart_arr['9'] = 0;
				$clinic_chart_arr['10'] = 0;
				$clinic_chart_arr['11'] = 0;
				$clinic_chart_arr['12'] = 0;

				$doctorsNames = [];

				$getDoctorNames = "SELECT * FROM `clinics_employees` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." ))";
				$QEXEDoctorNames = mysqli_query($KONN, $getDoctorNames);

				foreach ($QEXEDoctorNames as $key => $name) {
					$doctorsNames[$name['first_name']." ".$name['last_name']] = 0;
				}

				foreach ($QEXE12 as $key => $value) {


					if (date("m", strtotime($value['date_time'])) == '01') {
						$clinic_chart_arr['1'] = $clinic_chart_arr['1'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '02') {
						$clinic_chart_arr['2'] = $clinic_chart_arr['2'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '02') {
						$clinic_chart_arr['3'] = $clinic_chart_arr['3'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '04') {
						$clinic_chart_arr['4'] = $clinic_chart_arr['4'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '05') {
						$clinic_chart_arr['5'] = $clinic_chart_arr['5'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '06') {
						$clinic_chart_arr['6'] = $clinic_chart_arr['6'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '07') {
						$clinic_chart_arr['7'] = $clinic_chart_arr['7'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '08') {
						$clinic_chart_arr['8'] = $clinic_chart_arr['8'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '09') {
						$clinic_chart_arr['9'] = $clinic_chart_arr['9'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '10') {
						$clinic_chart_arr['10'] = $clinic_chart_arr['10'] + $value['price'];

					}elseif (date("m", strtotime($value['date_time'])) == '11') {
						$clinic_chart_arr['11'] = $clinic_chart_arr['11'] + $value['price'];

					}else{
						$clinic_chart_arr['12'] = $clinic_chart_arr['12'] + $value['price'];
					}

				
					if (date("F", strtotime($value['date_time'])) == date('F')) {
						$doctor = "SELECT * FROM `clinics_employees` WHERE ( ( `employee_id` = ".$value['dr_id']." )) LIMIT 1";
						$result = mysqli_query($KONN, $doctor);
						$resultData = $result->fetch_assoc();
					
						$doctorName = $resultData['first_name']." ".$resultData['last_name'];
						if (isset($doctorsNames[$doctorName])) {
							// $doctorsNames[$resultData['first_name']." ".$resultData['last_name']] = $doctorsNames[$resultData['first_name']." ".$resultData['last_name']] + $value['price'];
							$doctorsNames[$doctorName] = $doctorsNames[$doctorName] + $value['price'];
							
						}else{
							$doctorsNames[$doctorName] = $value['price'];
							
							// $doctorsNames[$doctor['first_name']." ".$doctor['last_name']] = $value['price'];
						}	
					}
					

				}


				// *********************************

				
				$Q15 = "SELECT * FROM `clinic_expenses` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." ) AND (YEAR(`date_time`) = ".$currentYear.") ) ORDER BY date_time DESC";
				$QEXE15 = mysqli_query($KONN, $Q15);

				$expense_chart_arr['1'] = 0;
				$expense_chart_arr['2'] = 0;
				$expense_chart_arr['3'] = 0;
				$expense_chart_arr['4'] = 0;
				$expense_chart_arr['5'] = 0;
				$expense_chart_arr['6'] = 0;
				$expense_chart_arr['7'] = 0;
				$expense_chart_arr['8'] = 0;
				$expense_chart_arr['9'] = 0;
				$expense_chart_arr['10'] = 0;
				$expense_chart_arr['11'] = 0;
				$expense_chart_arr['12'] = 0;

				foreach ($QEXE15 as $key => $value) {
					
					if (date("m", strtotime($value['date_time'])) == '01') {
						$expense_chart_arr['1'] = $expense_chart_arr['1'] + $value['expense_total'];
					}elseif (date("m", strtotime($value['date_time'])) == '02') {
						$expense_chart_arr['2'] = $expense_chart_arr['2'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '02') {
						$expense_chart_arr['3'] = $expense_chart_arr['3'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '04') {
						$expense_chart_arr['4'] = $expense_chart_arr['4'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '05') {
						$expense_chart_arr['5'] = $expense_chart_arr['5'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '06') {
						$expense_chart_arr['6'] = $expense_chart_arr['6'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '07') {
						$expense_chart_arr['7'] = $expense_chart_arr['7'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '08') {
						$expense_chart_arr['8'] = $expense_chart_arr['8'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '09') {
						$expense_chart_arr['9'] = $expense_chart_arr['9'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '10') {
						$expense_chart_arr['10'] = $expense_chart_arr['10'] + $value['expense_total'];

					}elseif (date("m", strtotime($value['date_time'])) == '11') {
						$expense_chart_arr['11'] = $expense_chart_arr['11'] + $value['expense_total'];

					}else{
						$expense_chart_arr['12'] = $expense_chart_arr['12'] + $value['expense_total'];
					}

				}

				$quotedKeys = array_map(function($key) {
				    return "'" . $key . "'";
				}, array_keys($doctorsNames));

				$keyDoctorsString = implode(', ', $quotedKeys);

				
				// *********************************
				$q = "SELECT * FROM `patients_medications` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
			$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$toter = $toter + ($db_data['dose']*$db_data['price']);
			}

			$q = "SELECT * FROM `patients_lab_exams` WHERE ( ( `price` <> 0  ) AND ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
			$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
            $thsV = (double) $db_data['price'];
			$toter = $toter + $thsV;
			}

			$q = "SELECT * FROM `patients_procedures` WHERE (( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
			$q_exe = mysqli_query($KONN, $q);
			while($db_data = mysqli_fetch_assoc($q_exe)){
				$thsP = (double) $db_data['price'];
				$thsQ = (double) $db_data['qty'];
				$thsTot = $thsQ * $thsP;
				$toter = $toter + $thsTot;
			}

				$totla_price = $toter;
				// $Q13 = "SELECT * FROM `patients_procedures` WHERE ( ( `clinic_id` = ".$_SESSION['clinic_id']." ) ) ORDER BY date_time DESC";
				// $QEXE13 = mysqli_query($KONN, $Q13);

				// $totla_price = 0;
				// foreach ($QEXE13 as $key => $pat) {
				// 	$totla_price =  ($pat['price'] * $pat['qty']);
				// }

				
				$Q14 = "SELECT * FROM `patients_payments` WHERE (( `clinic_id` = ".$_SESSION['clinic_id']." ) )";
				$QEXE14 = mysqli_query($KONN, $Q14);

				$total_pays = 0;
				foreach ($QEXE14 as $key => $value) {
					$pay = (double) $value['payment_amount'];
					$total_pays = $total_pays + $pay;
					
				}

			//. *************Tawfiq passed by here****************
			?>
			<section class="charts">
				<canvas class="charts-canvas" id="clinic"></canvas>
				<canvas class="charts-canvas" id="doctor"></canvas>
				<canvas class="charts-canvas" id="costs"></canvas>
				<div class="charts-box">
					<p class="charts-box__plus">
						<span class="charts-box__plus-title">
							<?= lang('Collected Amounts', 'المبالغ المحصلة', 1); ?>
						</span>
						<span class="charts-box__plus-amount">
							<?= $total_pays ?>
						</span>
					</p>
					<p class="charts-box__minus">
						<span class="charts-box__minus-title">
							<?= lang('Remaining Amounts', 'المبالغ المتبقية', 1); ?>
						</span>
						<span class="charts-box__minus-amount">
							 <?= $total_pays - $totla_price?>  
						</span>

					</p>
				</div>
			</section>




			<br>

			<?php
			//PAGE DATA END   ----------------------------------------------///---------------------------------
			include(main_app_url . 'app/footer.php');

			?>
			<script>
				let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				let doctorsNames = [<?= $keyDoctorsString ?>];
				let yDoctorValues = [<?= implode(',', $doctorsNames) ?>];

				let yClinicValues = [<?= implode(',', $clinic_chart_arr) ?>];
				let expenseValues = [<?= implode(',', $expense_chart_arr) ?>]
				let barColors = [
					"#b91d47",
					"#00aba9",
					"#2b5797",
					"#e8c3b9",
					"#1e7145",

					"#b91d47",
					"#00aba9",
					"#2b5797",
					"#e8c3b9",
					"#1e7145",

					"#b91d47",
					"#00aba9"
				];
				new Chart("clinic", {
					type: "line",
					data: {
						labels: months,
						datasets: [{
							fill: false,
							lineTension: 0,
							backgroundColor: barColors,
							borderColor: "rgba(44,220,55,0.5)",
							data: yClinicValues
						}]
					},
					options: {
						legend: {
							display: false,
						},
						title: {
							display: true,
							text: `<?= lang('Percentage of income per month from the clinic’s medical procedures', 'نسبة الدخل لكل شهر من الاجرائات الطبية للعيادة', 1); ?>`
						}
					}
				});
				new Chart("doctor", {
					type: "bar",
					data: {
						labels: doctorsNames,
						datasets: [{
							fill: false,
							lineTension: 0,
							backgroundColor: "#00aba9",
							borderColor: "rgba(0,0,255,0.5)",
							data: yDoctorValues
						}]
					},
					options: {
						legend: {
							display: false,
						},
						title: {
							display: true,
							text: `<?= lang('Percentage of income per month from the doctor’s medical procedures', 'نسبة الدخل لكل شهر من الاجرائات الطبية للدكتور', 1); ?>`
						}
					}
				});
				new Chart("costs", {
					type: "bar",
					data: {
						labels: months,
						datasets: [{
							backgroundColor: barColors,
							data: expenseValues
						}]
					},
					options: {
						legend: {
							display: false,
						},
						title: {
							display: true,
							text: `<?= lang('Percentage of costs per month', 'نسبة التكاليف لكل شهر', 1); ?>`
						}
					}
				});
			</script>
		</body>

		</html>
<?php
		//page data end
		// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
	} else {
		header('location:' . $go_to . '?fail=444');
	}
} else {
	header('location:' . $go_to . '?fail=333');
}
?>