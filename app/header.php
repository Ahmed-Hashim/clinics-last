<script>
var URLer = '';
var redirecter = '';
var slcted_frame = 'na';

function switch_mnu(op){
	var nxt_mnu = 0;
	var cur_mnu = parseInt($('#current_mnu_num').text());
	
	if(op == 1){
		//mnu raise
		if(cur_mnu == 1){
			nxt_mnu = 2;
		} else if(cur_mnu == 2){
			nxt_mnu = 3;
		} else if(cur_mnu == 3){
			nxt_mnu = 1;
		}
		
	} else {
		//mnu reduce
		if(cur_mnu == 1){
			nxt_mnu = 3;
		} else if(cur_mnu == 2){
			nxt_mnu = 1;
		} else if(cur_mnu == 3){
			nxt_mnu = 2;
		}
	}
	
	var nxt_mnu_content = $('#mnu-' + nxt_mnu).html();
	$('#current_mnu_num').text(nxt_mnu);
	$('#mnu_view').html(nxt_mnu_content);
	set_cookie('current_mnu', nxt_mnu);
}

function start_mnu(mnu){
	
	var nxt_mnu_content = $('#mnu-' + mnu).html();
	$('#current_mnu_num').text(mnu);
	$('#mnu_view').html(nxt_mnu_content);
	set_cookie('current_mnu', mnu);
	
}


</script>
<div id="ghost" class="ghost-hidden" onclick=""></div>
<header>
	
	<aside>
		<section class="main-logo">
			<img src="<?=image_root.'logo.png'; ?>" alt="main logo">
		</section>
		
		<nav id="main-nav">
			<ul class="pc-nav" id="mnu_view">

			</ul>
		</nav>
		
		<nav id="nav-changer">
			<ul class="changer-ul-nav">
				<li onclick="switch_mnu(0);">
					<i class="fa fa-angle-left" area-hidden="true"></i>
				</li>
				<li>
					<span id="current_mnu_num">1</span>
				</li>
				<li onclick="switch_mnu(1);">
					<i class="fa fa-angle-right" area-hidden="true"></i>
				</li>
				<div class="zero"></div>
			</ul>
		</nav>
		
	</aside>
</header>

<div style="display:none !important;">
	<div id="mnu-1">
				<li <?php if($page_id == 1){echo ' class="active"';} ?>><a href="dashboard.php">
						<img src="<?=icons_root.'dashboard.png'; ?>" alt="main logo">
						<span><?=lang('Dashboard', 'اللوحة الرئيسية', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 2){echo ' class="active"';} ?>><a href="calendar.php">
						<img src="<?=icons_root.'calendar.png'; ?>" alt="main logo">
						<span><?=lang('calendar', 'المواعيد', 1); ?></span>
				</a></li>
				<li><a onclick="show_modal('nw_pat_form');">
						<img src="<?=icons_root.'new_pat.png'; ?>" alt="main logo">
						<span><?=lang('new_Patient', 'مريض جديد', 1); ?></span>
				</a></li>
				<li><a onclick="add_new_appointment();">
						<img src="<?=icons_root.'new_app.png'; ?>" alt="main logo">
						<span><?=lang('new_Appointment', 'موعد جديد', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 3){echo ' class="active"';} ?>><a href="patient_list.php">
						<img src="<?=icons_root.'pat_list.png'; ?>" alt="main logo">
						<span><?=lang('Patient_list', 'قائمة المرضى', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 4){echo ' class="active"';} ?>><a href="task_list.php">
						<img src="<?=icons_root.'todo.png'; ?>" alt="main logo">
						<span><?=lang('tasks_list', 'قائمة المهمات', 1); ?></span>
				</a></li>
	</div>
	
	
<?php

if( $EMP_LEVEL == 2 ){
	//manager
?>
	<div id="mnu-2">
				<li <?php if($page_id == 5){echo ' class="active"';} ?>><a href="emp_list.php">
						<img src="<?=icons_root.'emps_list.png'; ?>" alt="main logo">
						<span><?=lang('employees', 'الموظفين', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 6){echo ' class="active"';} ?>><a href="dept_list.php">
						<img src="<?=icons_root.'deps_list.png'; ?>" alt="main logo">
						<span><?=lang('clinic_department', 'اقسام العيادة', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 132654){echo ' class="active"';} ?>><a href="clinic_labs_list.php">
						<img src="<?=icons_root.'lab.png'; ?>" alt="main logo">
						<span><?=lang('lab_examanations', 'فحوص المختبرات', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 666){echo ' class="active"';} ?>><a href="items_list.php">
						<img src="<?=icons_root.'inv_items.png'; ?>" alt="main logo">
						<span><?=lang('inventory_items', 'المستلزمات الطبية', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 8){echo ' class="active"';} ?>><a href="medications_list.php">
						<img src="<?=icons_root.'med_list.png'; ?>" alt="main logo">
						<span><?=lang('medications_list', 'قائمة الأدوية', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 7){echo ' class="active"';} ?>><a href="procedures_list.php">
						<img src="<?=icons_root.'proc_list.png'; ?>" alt="main logo">
						<span><?=lang('procedures_list', 'الاجراءات', 1); ?></span>
				</a></li>
	</div>
	<div id="mnu-3">
				<li <?php if($page_id == 66){echo ' class="active"';} ?>><a href="insurance_companies.php">
						<img src="<?=icons_root.'insurance.png'; ?>" alt="main logo">
						<span><?=lang('patient_insurance', 'شركات التأمين', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 51){echo ' class="active"';} ?>><a href="charts.php">
						<img src="<?=icons_root.'charts.png'; ?>" alt="main logo">
						<span><?=lang('charts', 'الرسوم البيانية', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 456){echo ' class="active"';} ?>><a href="clinic_settings.php">
						<img src="<?=icons_root.'clin_settings.png'; ?>" alt="main logo">
						<span><?=lang('clinic_settings', 'اعدادت العيادة', 1); ?></span>
				</a></li>
				<!-- *************Tawfiq passed by here**************** -->
				<!-- <li <?php if($page_id == 457){echo ' class="active"';} ?>><a href="system_settings.php">
						<img src="<?=icons_root.'sys_set.png'; ?>" alt="main logo">
						<span><?=lang('system_settings', 'اعدادات النظام', 1); ?></span>
				</a></li> -->
				<li <?php if($page_id == 458){echo ' class="active"';} ?>><a href="patients_payments.php">
						<img src="<?=icons_root.'invoices.png'; ?>" alt="main logo">
						<span><?=lang('patients_payments', 'دفعات المرضى', 1); ?></span>
				</a></li>
				<!--li style="opacity:0.6;" <?php if($page_id == 459){echo ' class="active"';} ?>><a href="#">
						<img src="<?=icons_root.'reports.png'; ?>" alt="main logo">
						<span><?=lang('reporting_system', 'التقارير', 1); ?></span>
				</a></li-->
				<li <?php if($page_id == 461){echo ' class="active"';} ?>><a href="patients_items.php">
						<img src="<?=icons_root.'acc_sys.png'; ?>" alt="main logo">
						<span><?=lang('patients_items', 'محاسبة المرضى', 1); ?></span>
				</a></li>
				<li <?php if($page_id == 469){echo ' class="active"';} ?>><a href="clinic_expenses.php">
						<img src="<?=icons_root.'reports.png'; ?>" alt="main logo">
						<span><?=lang('clinic_expenses', 'تكاليف', 1); ?></span>
				</a></li>
	</div>
<?php
}
?>
	
	
	
	</div>
	
	
	
	
	
	
	
</div>






<?php

$q = "SELECT COUNT(employee_id) AS not_counts FROM `employees_notifications` WHERE ( (`is_seen` = 0) AND (`employee_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$notifications_unseen = $q_row['not_counts'];

$q = "SELECT COUNT(to_id) AS tasks_counts FROM `employees_tasks` WHERE ( (`is_done` = 0) AND (`to_id` = ".$_SESSION['employee_id'].") AND (`clinic_id` = ".$_SESSION['clinic_id'].") ) ";
$q_exe = mysqli_query($KONN, $q);
$q_row = mysqli_fetch_assoc($q_exe);
$tasks_counts = $q_row['tasks_counts'];

?>
	
	<section id="user-opt">
		<ul class="user-opt-ul">
			<li id="opt-1" onclick="show_opt(1);" title="<?=lang('my_profile', 'ملفي', 1); ?>">
				<i class="fa fa-user" area-hidden="true"></i>
			</li>
			<li id="opt-2" onclick="show_opt(2);" title="<?=lang('my_notifications', 'الاشعارات', 1); ?>">
				<i class="fa fa-bell-o" area-hidden="true"></i>
				<span class="counter"><?=$notifications_unseen ?></span>
			</li>
			<li id="opt-3" onclick="show_opt(3);" title="<?=lang('my_tasks', 'مهامي', 1); ?>">
				<i class="fa fa-list-ol" area-hidden="true"></i>
				<span class="counter"><?=$tasks_counts ?></span>
			</li>
			<li id="opt-3" onclick="change_lang();" title="<?=lang('عربي', 'EN', 1); ?>">
				<i class="fa fa-globe" area-hidden="true"></i>
			</li>
			<!--li onclick="show_opt();" title="<?=lang('help', 'مساعدة', 1); ?>">
				<i class="fa fa-question" area-hidden="true"></i>
			</li-->
		</ul>
		
		
	</section>
<section id="user-opt-container" class="user-opt-viewer">

</section>

<script>
var dr_opt_showed = false;
var cur_l = '<?=$lang; ?>';
var nw_l = '';


switch(cur_l){
	case 'ar':
		nw_l = 'en';
		break;
	case 'en':
		nw_l = 'ar';
		break;
}




function change_lang(){
	var path = window.location.pathname;
	var page = path.split("/").pop();
	window.location.href = page + "?nw_lang=" + nw_l;
}


function show_opt(opt){
	
	hide_modal();
	setTimeout(function(){
		clear_opt();
		show_user_opt();
		$('#opt-' + opt).addClass('active-opt');
		$('#user-opt-container').html('<h1><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><br><?=lang('LOADING...', 'جاري التحميل', 1); ?></h1>');
		setTimeout(function(){
			$.ajax({
				url     : '<?=api_root; ?>users/view_user_opt.php',
				data    : {'opt': opt},
				method  : 'POST',
				success : function(data){
					$('#user-opt-container').html(data);
				}
			});
		}, 500);
	}, 200);
	
}

function clear_opt(){
	$('#user-opt-container').html('');
	$('.active-opt').removeClass('active-opt');
}
</script>

<article>