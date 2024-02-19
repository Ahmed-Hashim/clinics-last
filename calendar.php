<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Calendar", 'جدول المواعيد', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 2;
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
	
	
	
	<style>
/* *************Tawfiq passed by here (commint opacity)****************	*/
	.app-filled {
		background: #60B8C2 !important;
/*		opacity: 0.5;*/
		cursor: not-allowed !important;
	}
	.calendar-col .calendar-col-block {
		margin: 0 auto !important;
		border-bottom: 1px dotted !important;
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
		
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>




<script>
var cal_day = parseInt(<?=date('d'); ?>);
var cal_month = parseInt(<?=date('n'); ?>);
var cal_year = parseInt(<?=date('Y'); ?>);

var cal_docs = new Array();
/*
1 : happening now
2 : all day
3 : reserved
*/






var cal_frame_setting = 2;


function change_calendar_day(nw_dat){
	$('#calendar-day-selector .selected').removeClass('selected');
	cal_day = nw_dat;
	$('#day_' + cal_day).addClass('selected');
	load_calendar();
}
var firstStart = true;

function change_calendar_month(nw_dat){
	$('#day_29').addClass('hidden-day');
	$('#day_30').addClass('hidden-day');
	$('#day_31').addClass('hidden-day');
	var num_days = parseInt(days_num(nw_dat, cal_year));
	var res_day = 0;
	switch(num_days){
		case 29:
			$('#day_29').removeClass('hidden-day');
			break;
		case 30:
			$('#day_29').removeClass('hidden-day');
			$('#day_30').removeClass('hidden-day');
			break;
		case 31:
			$('#day_29').removeClass('hidden-day');
			$('#day_30').removeClass('hidden-day');
			$('#day_31').removeClass('hidden-day');
			break;
	}
	
	
	$('#calendar-month-selector .selected').removeClass('selected');
	cal_month = nw_dat;
	$('#month_' + cal_month).addClass('selected');
	
	
	if( firstStart == true ){
		change_calendar_day(<?=date('d'); ?>);
		firstStart = false;
	} else {
		change_calendar_day(1);
	}
	
}
	var max_y = <?=date('Y') + 1; ?>;
	var min_y = <?=date('Y') - 1; ?>;
function change_calendar_year_up(){
	cal_year++;
	if(cal_year > max_y){
		cal_year = min_y;
	}
	
	
	// load_calendar();
	change_calendar_month(1);
}
function change_calendar_year_down(){
	cal_year--;
	if(cal_year < min_y){
		cal_year = max_y;
	}
	// load_calendar();
	change_calendar_month(1);
}


function change_cal_frame(ss){
	$('.calendar-settings .selected').removeClass('selected');
	cal_frame_setting = ss;
	$('#cal_frame_btn_' + cal_frame_setting).addClass('selected');
	setTimeout(function(){$('#ghost').click();}, 50);
	load_calendar();
}


function show_cal_settings(){
	show_modal('calendar_settings');
}


function load_calendar(){
	
	var cal_data = new FormData();
	
	cal_data.append('day', cal_day);
	cal_data.append('month', cal_month);
	cal_data.append('year', cal_year);
	
	cal_data.append('frame', cal_frame_setting);
	
	
	
	$('.cal_docs').each(function(){
		var ths_id = parseInt($(this).attr('dr_id'));
		var is_slcted = parseInt($(this).attr('is_selected'));
		if(is_slcted == 1){
			cal_data.append('docs[]', ths_id);
		}
		
	});
	
	console.log('loading calendar...');
	cal_year_str = cal_year.toString();
	console.log(cal_year_str );
	console.log(cal_month);
	console.log(cal_day);
	$.ajax({
		url     : '<?=api_root; ?>calendar/get_calendar.php',
		data    : cal_data,
        contentType: false,
        processData: false,
		dataType  : 'html',
		method  : 'POST',
		beforeSend : function(){
			start_cal_load();
		},
		success : function(data){
			$('#cal-result').html(data);
			$('#cal-year').html(cal_year_str[2] + '' + cal_year_str[3]);
			
			end_cal_load();
		},
		error : function(data){
			alert('load error' + data);
		}
	});
	
}

function start_cal_load(){
	$('#cal-loader').addClass('showed-cal-loader');
}
function end_cal_load(){
	$('#cal-loader').removeClass('showed-cal-loader');
}

function remove_doc(dr){
	$('#dr_col_' + dr).remove();
	toggle_doc(dr);
	setTimeout(function(){$('#ghost').click();load_calendar();}, 50);
	
}
</script>
<section id="calendar">
	<section class="calendar-header">
	
		<div id="calendar-day-selector">
			<?php
			for($day=1;$day<=7;$day++){
				$dayName = date('D',mktime(0, 0, 0, date('m'), $day));
			?>
				<div class="calendar-day" id="day-name-<?=$day; ?>" style="color: var(--color-01);font-size: 14px;"><?=$dayName; ?></div>
			<?php } ?>
			
			<?php
			for($day=1;$day<=31;$day++){
			?>
				<div onclick="change_calendar_day(<?=$day; ?>);" id="day_<?=$day; ?>" class="calendar-day <?php if($day==date('d')){echo 'selected';} ?>"><?=$day; ?></div>
			<?php } ?>
			<div class="zero"></div>
		</div>
	
		<div id="calendar-month-selector">
				<div onclick="change_calendar_month(1);" id="month_1" class="calendar-month"><?=lang('january', 'يناير', 1); ?></div>
				<div onclick="change_calendar_month(2);" id="month_2" class="calendar-month"><?=lang('february', 'فبراير', 1); ?></div>
				<div onclick="change_calendar_month(3);" id="month_3" class="calendar-month"><?=lang('march', 'مارس', 1); ?></div>
				<div onclick="change_calendar_month(4);" id="month_4" class="calendar-month"><?=lang('april', 'ابريل', 1); ?></div>
				<div onclick="change_calendar_month(5);" id="month_5" class="calendar-month"><?=lang('may', 'مايو', 1); ?></div>
				<div onclick="change_calendar_month(6);" id="month_6" class="calendar-month"><?=lang('june', 'يونيو', 1); ?></div>
				<div onclick="change_calendar_month(7);" id="month_7" class="calendar-month"><?=lang('july', 'يوليو', 1); ?></div>
				<div onclick="change_calendar_month(8);" id="month_8" class="calendar-month"><?=lang('augest', 'أغسطس', 1); ?></div>
				<div onclick="change_calendar_month(9);" id="month_9" class="calendar-month"><?=lang('september', 'سبتمبر', 1); ?></div>
				<div onclick="change_calendar_month(10);" id="month_10" class="calendar-month"><?=lang('october', 'أكتوبر', 1); ?></div>
				<div onclick="change_calendar_month(11);" id="month_11" class="calendar-month"><?=lang('november', 'نوفمبر', 1); ?></div>
				<div onclick="change_calendar_month(12);" id="month_12" class="calendar-month"><?=lang('december', 'ديسيمبر', 1); ?></div>
			<div class="zero"></div>
		</div>
	
		<div id="calendar-year-selector">
			<div class="calendar-year-up" onclick="change_calendar_year_up();"><i class="fa fa-angle-up" area-hidden="true"></i></div>
				<div class="calendar-year">20<span id="cal-year"><?=date('y'); ?></span></div>
			<div class="calendar-year-down" onclick="change_calendar_year_down();"><i class="fa fa-angle-down" area-hidden="true"></i></div>
		</div>
		
	<div class="zero"></div>
	</section>
	
	
	<section class="calendar-body">
	<div id="cal-loader"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
	<div id="cal-result">
	
		
	</div>
	
	<div class="zero"></div>
	<br><br>
	</section>
	
</section>

	
	
<script>

function toggle_doc(idd){
	var is_slcted = parseInt($('#cal_doc_'+idd).attr('is_selected'));
	var res = 0;
	if(is_slcted == 0){
		res = 1;
	} else {
		res = 0;
	}
	
	$('#cal_doc_'+idd).attr('is_selected', res);
	
}




/*
status codes :
1 : pending
	pending_app
2 : confirmed
	confirmed_app
3 : canceled
	canceled_app
4 : blocked
	blocked_app
5 : checked-in
	checkin_app
6 : no-show
	noshow_app
7 : completed
	completed_app
*/

function unslct_time_block(){
	slcted_frame = 'na';
	$('.selected_frame').removeClass('selected_frame');
	hide_appointment_options();
	hide_ghost();
}

function slct_time_block(frame_id){
	$('.selected_frame').removeClass('selected_frame');
	$('#' + frame_id).addClass('selected_frame');
	
	var ths_status = parseInt($('#' + frame_id).attr('status'));
	
	show_appointment_options(frame_id, ths_status);
	show_ghost('unslct_time_block');
	slcted_frame = frame_id;
}

function show_appointment_options(frame_id, status){
	var fetch_id = '';
	switch(status){
		case 0:
			fetch_id = 'free-frame';
			break;
		case 1:
			fetch_id = 'pending-frame';
			break;
		case 2:
			fetch_id = 'confirmed-frame';
			break;
		case 3:
			fetch_id = 'canceled-frame';
			break;
		case 4:
			fetch_id = 'blocked-frame';
			break;
		case 5:
			fetch_id = 'checkedin-frame';
			break;
		case 6:
			fetch_id = 'noshow-frame';
			break;
		case 7:
			fetch_id = 'completed-frame';
			break;
	}
	
	var dd = $('#' + fetch_id).html();
	
	$('#appointment-options').html(dd);
	
	$('#appointment-options').removeClass('appointment-options-hidden');
}

function hide_appointment_options(){
	$('#appointment-options').addClass('appointment-options-hidden');
}

function show_dr_opt(dr_id){
	show_ghost('hide_dr_opt');
	$('#dr-opt-' + dr_id).addClass('dr-opt-mnu-showed');
	$('#dr-col-' + dr_id).addClass('focused-dr-col');
	dr_opt_showed = true;
}
function hide_dr_opt(){
	hide_ghost();
	$('.dr-opt-mnu-showed').removeClass('dr-opt-mnu-showed');
	$('.focused-dr-col').removeClass('focused-dr-col');
}




function activate_appointment(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		frm_data.append('appointment_id', appointment_id);
	
			$.ajax({
				url     : '<?=api_root; ?>appointments/activate_appointment.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					mk_alert(data, 'suc');
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}


function cancel_appointment(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		frm_data.append('appointment_id', appointment_id);
	
			$.ajax({
				url     : '<?=api_root; ?>appointments/cancel_appointment.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					mk_alert(data, 'suc');
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}


function noshow_appointment(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		frm_data.append('appointment_id', appointment_id);
	
			$.ajax({
				url     : '<?=api_root; ?>appointments/noshow_appointment.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					mk_alert(data, 'suc');
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}



function checkin_appointment(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		frm_data.append('appointment_id', appointment_id);
	
			$.ajax({
				url     : '<?=api_root; ?>appointments/checkin_appointment.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					mk_alert(data, 'suc');
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}


function confirm_appointment(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		frm_data.append('appointment_id', appointment_id);
	
			$.ajax({
				url     : '<?=api_root; ?>appointments/confirm_appointment.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					mk_alert(data, 'suc');
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}



function block_time(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		
		var y = parseInt($('#' + slcted_frame).attr('t_year'));
		var m = parseInt($('#' + slcted_frame).attr('t_month'));
		var d = parseInt($('#' + slcted_frame).attr('t_day'));
		var h = parseInt($('#' + slcted_frame).attr('t_hour'));
		var i = parseInt($('#' + slcted_frame).attr('t_min'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		
		frm_data.append('year', y);
		frm_data.append('month', m);
		frm_data.append('day', d);
		
		frm_data.append('hour', h);
		frm_data.append('min', i);
	
			$.ajax({
				url     : '<?=api_root; ?>doctors/block_time.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					var d_ar = data.split('|');
					if(d_ar[0] == 1){
						mk_alert(d_ar[1], 'suc');
					} else {
						mk_alert(d_ar[1], 'err');
					}
					
					
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}


function activate_time(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		
		var y = parseInt($('#' + slcted_frame).attr('t_year'));
		var m = parseInt($('#' + slcted_frame).attr('t_month'));
		var d = parseInt($('#' + slcted_frame).attr('t_day'));
		var h = parseInt($('#' + slcted_frame).attr('t_hour'));
		var i = parseInt($('#' + slcted_frame).attr('t_min'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		
		frm_data.append('year', y);
		frm_data.append('month', m);
		frm_data.append('day', d);
		
		frm_data.append('hour', h);
		frm_data.append('min', i);
	
			$.ajax({
				url     : '<?=api_root; ?>doctors/activate_time.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					var d_ar = data.split('|');
					if(d_ar[0] == '1'){
						mk_alert(d_ar[1], 'suc');
					} else {
						mk_alert(d_ar[1], 'err');
					}
					
					
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}

function appointment_done(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		frm_data.append('appointment_id', appointment_id);
	
			$.ajax({
				url     : '<?=api_root; ?>appointments/appointment_done.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					mk_alert(data, 'suc');
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}

function view_appointment_details(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		frm_data.append('appointment_id', appointment_id);
		
			$.ajax({
				url     : '<?=api_root; ?>appointments/view_appointment_details.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					show_modal('data_fetch_modal');
					$('#data_fetch_modal #modal-title').html('<?=lang('appointment_details', 'تفاصيل الموعد', 1); ?>');
					$('#data_fetch_modal .modal-body').html('<?=lang('LOADING_DATA_...', 'جاري التحميل', 1); ?>');
				},
				success : function(data){
					$('#data_fetch_modal .modal-body').html(data);
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}

function days_num(month, year) {
  return new Date(year, month, 0).getDate();
}

/*
function edit_appointment(){
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr_id = parseInt($('#' + slcted_frame).attr('dr_id'));
		
		var y = parseInt($('#' + slcted_frame).attr('t_year'));
		var m = parseInt($('#' + slcted_frame).attr('t_month'));
		var d = parseInt($('#' + slcted_frame).attr('t_day'));
		var h = parseInt($('#' + slcted_frame).attr('t_hour'));
		var i = parseInt($('#' + slcted_frame).attr('t_min'));
		
		var frm_data = new FormData();
		frm_data.append('dr_id', dr_id);
		
		frm_data.append('year', y);
		frm_data.append('month', m);
		frm_data.append('day', d);
		
		frm_data.append('hour', h);
		frm_data.append('min', i);
	
			$.ajax({
				url     : '<?=api_root; ?>doctors/activate_time.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					unslct_time_block();
					start_cal_load();
				},
				success : function(data){
					end_cal_load();
					var d_ar = data.split('|');
					if(d_ar[0] == '1'){
						mk_alert(d_ar[1], 'suc');
					} else {
						mk_alert(d_ar[1], 'err');
					}
					
					
					load_calendar();
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
}
*/

</script>
	
	


<section id="appointment-options" class="appointment-options-hidden">
		<div onclick="view_appointment_details();" class="app-opt">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span><?=lang('view_details', 'التفاصيل', 1); ?></span>
		</div>
		<div onclick="edit_appointment_calendar();" class="app-opt">
			<i class="fa fa-edit" aria-hidden="true"></i>
			<span><?=lang('edit_appointment', 'تعديل', 1); ?></span>
		</div>
		<div onclick="checkin_appointment();" class="app-opt">
			<i class="fa fa-sign-in" aria-hidden="true"></i>
			<span><?=lang('check_in', 'تسجيل الدخول', 1); ?></span>
		</div>
		<div onclick="confirm_appointment();" class="app-opt">
			<i class="fa fa-check" aria-hidden="true"></i>
			<span><?=lang('confirm_appointment', 'تأكيد', 1); ?></span>
		</div>
		<div onclick="cancel_appointment();" class="app-opt">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span><?=lang('cancel_appointment', 'إلغاء', 1); ?></span>
		</div>
		<div onclick="block_time();" class="app-opt">
			<i class="fa fa-ban" aria-hidden="true"></i>
			<span><?=lang('block_time', 'منع الوقت', 1); ?></span>
		</div>
		<div class="zero"></div>
</section>


<div style="display:none !important;">

	<div id="free-frame">
		<div onclick="add_new_appointment_calendar();" class="app-opt">
			<i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
			<span><?=lang('add_appointment', 'إضافة موعد جديد', 1); ?></span>
		</div>
	
		<div onclick="block_time();" class="app-opt">
			<i class="fa fa-ban" aria-hidden="true"></i>
			<span><?=lang('block_time', 'منع الوقت', 1); ?></span>
		</div>
		<div class="zero"></div>
	</div>

	<div id="pending-frame">
		<div onclick="view_appointment_details();" class="app-opt">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span><?=lang('view_details', 'التفاصيل', 1); ?></span>
		</div>
		<div onclick="edit_appointment_calendar();" class="app-opt">
			<i class="fa fa-edit" aria-hidden="true"></i>
			<span><?=lang('edit_appointment', 'تعديل الموعد', 1); ?></span>
		</div>
		<div onclick="checkin_appointment();" class="app-opt">
			<i class="fa fa-sign-in" aria-hidden="true"></i>
			<span><?=lang('check_in', 'تسجيل الدخول', 1); ?></span>
		</div>
		<div onclick="confirm_appointment();" class="app-opt">
			<i class="fa fa-check" aria-hidden="true"></i>
			<span><?=lang('confirm_appointment', 'تأكيد الموعد', 1); ?></span>
		</div>
		<div onclick="cancel_appointment();" class="app-opt">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span><?=lang('cancel_appointment', 'إلغاء الموعد', 1); ?></span>
		</div>
		<div onclick="noshow_appointment();" class="app-opt">
			<i class="fa fa-eye-slash" aria-hidden="true"></i>
			<span><?=lang('no_show', 'عدم الظهور', 1); ?></span>
		</div>
		<div class="zero"></div>
	</div>

	<div id="confirmed-frame">
		<div onclick="view_appointment_details();" class="app-opt">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span><?=lang('view_details', 'التفاصيل', 1); ?></span>
		</div>
		<div onclick="edit_appointment_calendar();" class="app-opt">
			<i class="fa fa-edit" aria-hidden="true"></i>
			<span><?=lang('edit_appointment', 'تعديل الموعد', 1); ?></span>
		</div>
		<div onclick="checkin_appointment();" class="app-opt">
			<i class="fa fa-sign-in" aria-hidden="true"></i>
			<span><?=lang('check_in', 'تسجيل الدخول', 1); ?></span>
		</div>
		<div onclick="cancel_appointment();" class="app-opt">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span><?=lang('cancel_appointment', 'إلغاء الموعد', 1); ?></span>
		</div>
		<div onclick="noshow_appointment();" class="app-opt">
			<i class="fa fa-eye-slash" aria-hidden="true"></i>
			<span><?=lang('no_show', 'عدم الظهور', 1); ?></span>
		</div>
		<div class="zero"></div>
	</div>

	<div id="canceled-frame">
		<div onclick="view_appointment_details();" class="app-opt">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span><?=lang('view_details', 'التفاصيل', 1); ?></span>
		</div>
		<div onclick="edit_appointment_calendar();" class="app-opt">
			<i class="fa fa-edit" aria-hidden="true"></i>
			<span><?=lang('edit_appointment', 'تعديل الموعد', 1); ?></span>
		</div>
		<div onclick="activate_appointment();" class="app-opt">
			<i class="fa fa-check" aria-hidden="true"></i>
			<span><?=lang('activate_appointment', 'تنشيط الموعد', 1); ?></span>
		</div>
		<div class="zero"></div>
	</div>

	<div id="blocked-frame">
		<div onclick="activate_time();" class="app-opt">
			<i class="fa fa-check" aria-hidden="true"></i>
			<span><?=lang('activate_time', 'تنشيط الوقت', 1); ?></span>
		</div>
		<div class="zero"></div>
	</div>

	<div id="checkedin-frame">
		<div onclick="appointment_done();" class="app-opt">
			<i class="fa fa-check" aria-hidden="true"></i>
			<span><?=lang('activate_appointment', 'تم الانتهاء', 1); ?></span>
		</div>
		<div onclick="view_appointment_details();" class="app-opt">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span><?=lang('view_details', 'التفاصيل', 1); ?></span>
		</div>
		
		<div class="zero"></div>
	</div>

	<div id="noshow-frame">
		<div onclick="view_appointment_details();" class="app-opt">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span><?=lang('view_details', 'التفاصيل', 1); ?></span>
		</div>
		<div class="zero"></div>
	</div>

	<div id="completed-frame">
		<div onclick="view_appointment_details();" class="app-opt">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span><?=lang('view_details', 'التفاصيل', 1); ?></span>
		</div>
		<div class="zero"></div>
	</div>

	
	
</div>






<section id="calendar-key">

	<div class="">
		<span class="circler pending_app"></span>
		<span class="namer"><?=lang('pending', 'بالانتظار', 1); ?></span>
	<div>

	<div class="">
		<span class="circler confirmed_app"></span>
		<span class="namer"><?=lang('confirmed', 'مؤكد', 1); ?></span>
	<div>

	<div class="">
		<span class="circler canceled_app"></span>
		<span class="namer"><?=lang('canceled', 'ملغي', 1); ?></span>
	<div>

	<div class="">
		<span class="circler blocked_app"></span>
		<span class="namer"><?=lang('blocked', 'محجوب', 1); ?></span>
	<div>

	<div class="">
		<span class="circler checkin_app"></span>
		<span class="namer"><?=lang('checked-in', 'مسجل بالدخول', 1); ?></span>
	<div>

	<div class="">
		<span class="circler noshow_app"></span>
		<span class="namer"><?=lang('no-show', 'لم يظهر', 1); ?></span>
	<div>

	<div class="">
		<span class="circler completed_app"></span>
		<span class="namer"><?=lang('completed', 'تك إكماله', 1); ?></span>
	<div>
	
</section>













<script>
// load_calendar();
change_calendar_month(<?=date('m'); ?>);
</script>
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
