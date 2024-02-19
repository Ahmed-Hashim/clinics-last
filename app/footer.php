</article>


<section id="loader"></section>
<section id="pg_not_holder"></section>


<section id="data_fetch_modal" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('title', 'العنوان', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br><?=lang('LOADING_DATA_...', 'جاري التحميل', 1); ?><br>
	</section>
</section>


<section id="nw_lab" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('define_new_lab', 'إضافة مختبر جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	<section class="form-holder">
		<form id="nw_lab_company_form">
		
			<div class="form-control">
				<label><?=lang('lab_name', 'اسم المختبر', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="lab_name">
			</div>
		
			<div class="form-control">
				<label><?=lang('mobile', 'رقم الهاتف الجوال', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="mobile">
			</div>
		
			<div class="form-control">
				<label><?=lang('landline', 'رقم الهاتف الارضي', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="landline">
			</div>
		
			<div class="form-control">
				<label><?=lang('email', 'البريد الالكتروني', 1); ?></label>
				<input class=" data-input" req="0" defaulter="na" denier="" alerter="please check inputs" type="text" name="email">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>labs/add_lab.php';redirecter = 'self';submit_form('nw_lab_company_form');"><?=lang('add_new', 'إضافة', 1); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>

<section id="nw_lab_exam" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('new_insurance_catageory', 'فئة تأمين جديدة', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	<section class="form-holder">
		<form id="nw_lab_exam_form">
		
<input id="new_main_lab_exam_id" class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="0" type="hidden" name="lab_id">
		
			<div class="form-control">
				<label><?=lang('lab_exam_name', 'اسم الفحص المخبري', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="lab_exam_name">
			</div>
		
			<div class="form-control">
				<label><?=lang('cost', 'التكلفة', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="cost">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>labs/add_lab_exam.php';redirecter = 'close_modal';submit_form('nw_lab_exam_form');"><?=lang('add_new', 'إضافة', 1); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>


<section id="nw_insurance_company" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('new_insurance_company', 'شركة تأمين جديدة', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	<section class="form-holder">
		<form id="nw_insurance_company_form">
		
			<div class="form-control">
				<label><?=lang('insurance_company_name', 'اسم الشركة', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="insurance_company_name">
			</div>
		
			<div class="form-control">
				<label><?=lang('mobile', 'الهاتف الجوال', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="mobile">
			</div>
		
			<div class="form-control">
				<label><?=lang('landline', 'الهاتف الارضي', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="landline">
			</div>
		
			<div class="form-control">
				<label><?=lang('email', 'البريد الإلكتروني', 1); ?></label>
				<input class=" data-input" req="0" defaulter="na" denier="" alerter="please check inputs" type="text" name="email">
			</div>
		
			<div class="form-control">
				<label><?=lang('Fax_no', 'رقم الفاكس', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="fax_no">
			</div>
		
			<div class="form-control">
				<label><?=lang('accreditation_no', 'رقم الاعتماد', 1); ?>*</label>
				<input class=" data-input" req="1" defaulter="na" denier="" alerter="please check inputs" type="text" name="accreditation_no">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>insurance_companies/add_company.php';redirecter = 'insurance_companies.php';submit_form('nw_insurance_company_form');"><?=lang('add_new'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>



<section id="nw_insurance_catt" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('new_insurance_catageory', 'فئة تأمين جديدة', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	<section class="form-holder">
		<form id="nw_insurance_cat_form">
		
<input id="new_cat_main_comp_id" class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" value="0" type="hidden" name="insurance_company_id">
		
			<div class="form-control">
				<label><?=lang('catageory_name', 'اسم الفئة', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="insurance_category_name">
			</div>
		
			<div class="form-control">
				<label><?=lang('discount_percentage', 'نسبة الخصم', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="discount">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>insurance_companies/add_cat.php';redirecter = 'insurance_companies.php';submit_form('nw_insurance_cat_form');"><?=lang('add_new'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>



<section id="nw_item" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('add_new_items', 'إضافة جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
	<section class="form-holder">
		<form id="add_new_item_form">
			<div class="form-control">
				<label><?=lang('item_name', 'الاسم', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="item_name">
			</div>
			
			<div class="form-control">
				<label><?=lang('qty', 'الكمية', 1); ?></label>
				<input class=" data-input" req="1" defaulter="0" denier="" value="0" alerter="please check inputs" type="text" name="qty">
			</div>
			
			<div class="form-control">
				<label><?=lang('cost_price', 'سعر التكلفة', 1); ?></label>
				<input class=" data-input" req="1" defaulter="0" denier="" value="0" alerter="please check inputs" type="text" name="cost_price">
			</div>
			
			<div class="form-control">
				<label><?=lang('selling_price', 'سعر البيع', 1); ?></label>
				<input class=" data-input" req="1" defaulter="0" denier="" value="0" alerter="please check inputs" type="text" name="selling_price">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>items/add_items.php';redirecter = 'self';submit_form('add_new_item_form');"><?=lang('add_new'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>

<section id="nw_medication" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('add_new_medications', 'إضافة دواء جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
	<section class="form-holder">
		<form id="add_new_medication_form">
			<div class="form-control">
				<label><?=lang('medication_name', 'الاسم', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="medication_name">
			</div>
			
			<div class="form-control">
				<label><?=lang('qty', 'الكمية', 1); ?></label>
				<input class=" data-input" req="1" defaulter="0" denier="" value="0" alerter="please check inputs" type="text" name="qty">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>medications/add_medications.php';redirecter = 'self';submit_form('add_new_medication_form');"><?=lang('add_new'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>


<section id="nw_procedure" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('new_procedure', 'إجراء جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
	<section class="form-holder">
		<form id="add_new_procedure_form">
			<div class="form-control">
				<label><?=lang('procedure_name', 'الاسم', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="procedure_name">
			</div>
			
			<div class="form-control">
				<label><?=lang('procedure_selling_price', 'سعر البيع', 1); ?></label>
				<input class=" data-input" req="1" defaulter="0" denier="" value="0" alerter="please check inputs" type="text" name="price">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>procedures/add_procedure.php';redirecter = 'self';submit_form('add_new_procedure_form');"><?=lang('add_new'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>


<section id="nw_emp" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('new_employee', 'موظف جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	
	<section class="form-holder">
<form id="add_employee_data">

				<div class="info-cont-4">
					<div class="info-title"><?=lang('first_name', 'الاسم الاول', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="first_name">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('second_name', 'الاسم الثاني', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="second_name">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('third_name', 'الاسم الثالث', 1); ?></div>
					<div class="info-value">
<input class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="third_name">
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('last_name', 'الاسم الاخير', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="last_name">
					</div>
				</div>
			
				<div class="info-cont-4">
					<div class="info-title"><?=lang('dob', 'تاريخ الميلاد', 1); ?></div>
					<div class="info-value">
<input class="has_date data-input" id="dober_new_emp" req="1" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="dob">
					</div>
				</div>
<script>
$('#dober_new_emp').on('change', function(){
	console.log('ss');
	var c_yy = <?=date('Y'); ?>;
	var dob = $('#dober_new_emp').val();
	var dob_a = dob.split('-');
	var yy = parseInt(dob_a[0]);
	var age = c_yy - yy;
	$('.nw_age_new_emp').html(age + '<?=lang('_years', ' سنة', 1); ?>');
});
</script>
				<div class="info-cont-4">
					<div class="info-title"><?=lang('age', 'العمر', 1); ?></div>
					<div class="info-value"><span class="nw_age_new_emp">0</span></div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('gender', 'الجنس', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="gender">
	<option value="1"><?=lang('male', 'ذكر', 1); ?></option>
	<option value="2"><?=lang('female', 'أنثى', 1); ?></option>
</select>
					</div>
				</div>
				
				<div class="info-cont-4">
					<div class="info-title"><?=lang('martial_status', 'الحالة الاجتماعية', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="martial_status">
	<option value="0"><?=lang('single', 'اعزب', 1); ?></option>
	<option value="1"><?=lang('married', 'متزوج', 1); ?></option>
</select>
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('nationality', 'الجنسية', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="nationality">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('join_date', 'تاريخ التوظيف', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="join_date">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('certification', 'المحصل العلمي', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="certification">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('graduation_date', 'تاريخ التخرج', 1); ?>&nbsp;*</div>
					<div class="info-value">
<input class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" value="" type="text" name="graduation_date">
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('duty_start', 'ساعة بدء العمل', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" name="duty_start">
<option value="0"><?=lang('Please Select', 'الرجاء الاختيار', 1); ?> ---</option>
<?php
for($e=0;$e<=23;$e++){
	$e_res = ''.$e;
	if($e<10){
		$e_res = '0'.$e;
	}
?>
	<option value="<?=$e; ?>"><?=$e_res; ?></option>
<?php } ?>
</select>
					</div>
				</div>
				
				<div class="info-cont">
					<div class="info-title"><?=lang('duty_end', 'ساعة انتهاء العمل', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" name="duty_end">
<option value="0"><?=lang('Please Select', 'الرجاء الاختيار', 1); ?> ---</option>
<?php
for($e=0;$e<=23;$e++){
	$e_res = ''.$e;
	if($e<10){
		$e_res = '0'.$e;
	}
?>
	<option value="<?=$e; ?>"><?=$e_res; ?></option>
<?php } ?>
</select>
					</div>
				</div>
				
				
				<div class="info-cont">
					<div class="info-title"><?=lang('Department', 'القسم', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="text" name="clinic_department_id">
<option value="0"><?=lang('Please Select', 'الرجاء الاختيار', 1); ?> ---</option>
<?php 
$q = "SELECT * FROM `clinics_departments` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$q_exe = mysqli_query($KONN, $q);
$cc = 0;
while($dr_datas = mysqli_fetch_assoc($q_exe)){
?>
	<option value="<?=$dr_datas['clinic_department_id']; ?>"><?=$dr_datas['clinic_department_name']; ?></option>
<?php } ?>
</select>
					</div>
				</div>
				
				
				<div class="info-cont">
					<div class="info-title"><?=lang('Is_Doctor', 'طبيب / اخصائي', 1); ?>&nbsp;*</div>
					<div class="info-value">
<select class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="is_dr">
	<option value="1"><?=lang('Yes', 'نعم', 1); ?></option>
	<option value="0"><?=lang('No', 'لا', 1); ?></option>
</select>
					</div>
				</div>
				
</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>employee/add_employee.php';redirecter = 'self';submit_form('add_employee_data');"><?=lang('save_changes'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>



<section id="nw_dept" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('new_department', 'قسم جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	
	<section class="form-holder">
		<form id="add_new_department_form">
		
			<div class="form-control">
				<label><?=lang('department_name', 'اسم القسم', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="department_name">
			</div>
			
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>departments/add_department.php';redirecter = 'self';submit_form('add_new_department_form');"><?=lang('add_new'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>





<section id="nw_task" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('add_new_task', 'مهمة جديدة', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	
	<section class="form-holder">
		<form id="add_new_task_form">
		
			<input id="nw_task_from_id" class="data-input" req="1" defaulter="" denier="0" value="<?=$_SESSION['employee_id']; ?>" alerter="please select patient" type="hidden" name="from_id">
			
			<div class="form-control">
				<label><?=lang('employee_name', 'اسم الموظف', 1); ?></label>
				<select id="nw_task_to_id" class="data-input" req="1" defaulter="" denier="1986" alerter="please select patient" name="to_id">
					<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
				<?php 
			$q = "SELECT `employee_id`, CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ( (`is_deleted` = '0') AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
			$q_exe = mysqli_query($KONN, $q);
				$cc = 0;
				while($dr_datas = mysqli_fetch_assoc($q_exe)){
				?>
					<option value="<?=$dr_datas['employee_id']; ?>"><?=$dr_datas['namer']; ?></option>
				<?php } ?>
				</select>
			</div>
	
			<div class="form-control">
				<label><?=lang('priority', 'الاولوية', 1); ?></label>
				<select class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="priority">
					<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<option value="0"><?=lang('low', 'منخفظة', 1); ?></option>
					<option value="1"><?=lang('normal', 'عادية', 1); ?></option>
					<option value="2"><?=lang('high', 'مهمة جدا', 1); ?></option>
				</select>
			</div>
			
			<div class="form-control">
				<label><?=lang('task_date', 'تاريخ المهمة', 1); ?></label>
				<input class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="task_date">
			</div>
			
			
			<div class="form-control">
				<label><?=lang('task_hour', 'ساعة التنفيذ', 1); ?></label>
				<select class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="task_hour">
					<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<?php 
					for($i=0;$i<=23;$i++){ 
					$hour = $i;
					if($i<10){$hour = '0'.$i;}
					?>
					<option value="<?=$i; ?>"><?=$hour; ?></option>
					<?php }?>
				</select>
			</div>
			
			<div class="form-control">
				<label><?=lang('deadline_date', 'تاريخ الانتهاء', 1); ?></label>
				<input class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="deadline_date">
			</div>
			
			<div class="form-control">
				<label><?=lang('task_content', 'المحتوى', 1); ?></label>
				<textarea class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="task_content"></textarea>
			</div>
			
			
			
		</form>
			<br>
			
			
		<div class="form-control">
			<label><?=lang('submit_data', 'حفظ', 1); ?></label>
			<button type="button" onclick="URLer = '<?=api_root; ?>tasks/add_task.php';redirecter = 'close_modal';submit_form('add_new_task_form');"><?=lang('add_new_task'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
			
			
	</section>
		<br>
		
	</section>
</section>
	


<section id="new_cost" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('new_cost', 'تكلفة جديدة', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
		
	
	<section class="form-holder">
		<form id="add_new_coster_form">
		
			<div class="form-control">
				<label><?=lang('item', 'البند', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="expense_item">
			</div>
		
			<div class="form-control">
				<label><?=lang('notes', 'ملاحظات', 1); ?></label>
				<textarea class=" data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="text" name="expense_notes"></textarea>
			</div>
			
			<div class="form-control">
				<label><?=lang('cost', 'القيمة', 1); ?></label>
				<input class=" data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="expense_total">
			</div>
		</form>
			<br>
		<div class="form-control">
			<button type="button" onclick="URLer = '<?=api_root; ?>clinics/add_cost.php';redirecter = 'self';submit_form('add_new_coster_form');"><?=lang('add_new'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
	</section>
		<br>
	</section>
</section>
	
	
<section id="nw_pat_form" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('add_new_patient', 'إضافة مريض جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
	<section class="form-holder">
		<form id="add_new_patient_form">
			<div class="form-control">
				<label><?=lang('first_name', 'الاسم الاول', 1); ?></label>
				<input class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="first_name">
			</div>
				<input class="data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="hidden" name="second_name">
				<input class="data-input" req="0" defaulter="" denier="" alerter="please check inputs" type="hidden" name="third_name">
			
			<div class="form-control">
				<label><?=lang('last_name', 'اسم العائلة', 1); ?></label>
				<input class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="last_name">
			</div>
			
			<div class="min-form-control">
				<label><?=lang('DOB', 'تاريخ الميلاد', 1); ?></label>
				<input class="has_date data-input" req="1" defaulter="" denier="" value="<?=date('Y-m-d'); ?>" alerter="please check inputs" type="text" name="dob">
			</div>
			
			<div class="min-form-control">
				<label><?=lang('gender', 'الجنس', 1); ?></label>
				<select class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" name="gender">
					<option value="0"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<option value="1"><?=lang('male', 'ذكر', 1); ?></option>
					<option value="2" selected><?=lang('female', 'انثى', 1); ?></option>
				</select>
			</div>
			
			<div class="min-form-control">
				<label><?=lang('mobile_no', 'رقم الهاتف الجوال', 1); ?></label>
				<input class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="mobile">
			</div>
			
			<div class="form-control">
				<label><?=lang('nat_no', 'الرقم الوطني', 1); ?></label>
				<input class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="text" name="nat_no">
			</div>
<?php
$ff_nw = 0;
	$QTW = "SELECT MAX(`file_num`) FROM `patients` WHERE `clinic_id` =  '".$_SESSION['clinic_id']."'";
	$QTEW = mysqli_query($KONN, $QTW);
	$QTRESW = mysqli_fetch_array($QTEW);
	$ff_nw = $QTRESW[0] + 1;
		
		
?>
			
			<div class="form-control">
				<label><?=lang('file_no', 'رقم الملف', 1); ?></label>
				<input class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="text" name="file_num" value="<?=$ff_nw; ?>" readonly>
			</div>
			
			<div class="form-control">
				<label><?=lang('nationality', 'الجنسية', 1); ?></label>
				<input class="data-input" req="1" defaulter="" denier="0" alerter="please check inputs" type="text" name="nationality">
			</div>
			
			
			<div class="form-control">
			<label><?=lang('doctor_name', 'اسم الطبيب', 1); ?></label>
			<select class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" type="text" name="dr_id">
					<option value="1986" selected><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
				<?php 
			$q = "SELECT `employee_id`, CONCAT(`first_name`, ' ', `last_name`) AS namer FROM `clinics_employees` WHERE ((`is_deleted` = '0') AND  (`is_dr` = 1) AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
			$q_exe = mysqli_query($KONN, $q);
				$cc = 0;
				while($dr_datas = mysqli_fetch_assoc($q_exe)){
				?>
					<option value="<?=$dr_datas['employee_id']; ?>" selected><?=$dr_datas['namer']; ?></option>
				<?php } ?>
			</select>
			</div>
			<br>
			<br>
			<div class="min-form-control">
			<label><?=lang('insurance_type', 'طريقة الدفع', 1); ?></label>
			<select class="data-input" req="1" id="pat_insurance_type" defaulter="" denier="1986" alerter="please check inputs" type="text" name="insurance_type">
					<option value="1986" ><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<option value="1" selected><?=lang('cash', 'نقدي', 1); ?></option>
					<option value="2"><?=lang('insurance', 'خاضع للتأمين', 1); ?></option>
			</select>
			</div>
			
			<div class="min-form-control">
			<label><?=lang('insurance_company', 'شركة التأمين', 1); ?></label>
			<select class="data-input" req="0" id="pat_insurance_company" defaulter="" denier="" alerter="please check inputs" type="text" name="insurance_company">
					<option value="0" selected><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
				<?php 
			$q = "SELECT `insurance_company_id`, `insurance_company_name` AS namer FROM `insurance_companies` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
			$q_exe = mysqli_query($KONN, $q);
				$cc = 0;
				while($dr_datas = mysqli_fetch_assoc($q_exe)){
				?>
					<option value="<?=$dr_datas['insurance_company_id']; ?>"><?=$dr_datas['namer']; ?></option>
				<?php } ?>
			</select>
			</div>
			
			<div class="min-form-control">
			<label><?=lang('insurance_discount_category', 'نسبة الخصم', 1); ?>&nbsp;(%)</label>
			<select class="data-input" req="0" id="pat_insurance_discount" defaulter="" denier="0" alerter="please check inputs" type="text" name="insurance_category">
					<option value="0" selected>&nbsp;</option>
			</select>
			</div>
<script>
$('#pat_insurance_company').on('change', function(){
	var typo = parseInt($('#pat_insurance_type').val());
	if(typo != 1986){
		if(typo != 1){
			var main_id = parseInt($('#pat_insurance_company').val());
			if(main_id != 0){
				
var snt_data = new FormData();
//continue
//send ajax request to load patient data
snt_data.append('main_id', main_id);
snt_data.append('op', 1);
$.ajax({
	url     : '<?=api_root; ?>insurance_companies/get_ins_cat_by_main_id.php',
	data    : snt_data,
	contentType: false,
	processData: false,
	dataType  : 'html',
	method  : 'POST',
	beforeSend : function(){
		$('#pat_insurance_discount').val('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
	},
	success : function(data){
		$('#pat_insurance_discount').html(data);
	},
	error : function(data){
		alert('load error' + data);
	}
});
				
			} else {
				$('#pat_insurance_discount').html('<option value="0" selected>&nbsp;</option>');
			}
			//----
		}
	}
});



$('#pat_insurance_type').on('change', function(){
	var typo = parseInt($(this).val());
	if(typo != 1986){
		
		if(typo == 1){
			//cash deactivate ins selector
			$('#pat_insurance_company').change(0);
			$('#pat_insurance_company').attr('denier', '');
			$('#pat_insurance_company').prop('disabled', 'disabled');
			$('#pat_insurance_discount').prop('disabled', 'disabled');
			$('#pat_insurance_company').attr('req', '0');
			$('#pat_insurance_discount').attr('req', '0');
		} else if(typo == 2){
			//insurance activate ins selector
			$('#pat_insurance_company').change(0);
			$('#pat_insurance_company').attr('denier', '0');
			$('#pat_insurance_discount').attr('denier', '0');
			$('#pat_insurance_company').prop('disabled', false);
			$('#pat_insurance_discount').prop('disabled', false);
			$('#pat_insurance_company').attr('req', '1');
			$('#pat_insurance_discount').attr('req', '1');
		}
		
	}
});
$('#pat_insurance_company').change(0);
$('#pat_insurance_company').attr('denier', '');
$('#pat_insurance_discount').attr('denier', '');
$('#pat_insurance_company').prop('disabled', 'disabled');
$('#pat_insurance_discount').prop('disabled', 'disabled');

</script>
			
		</form>
		<br>
		
		<div class="form-control">
			<label><?=lang('submit_data', 'جفظ', 1); ?></label>
			<button type="button" onclick="URLer = '<?=api_root; ?>patients/add_patient.php';redirecter = 'close_modal';submit_form('add_new_patient_form');"><?=lang('add_new_patient'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
			
	</section>
		<br>
	</section>
</section>

<section id="nw_appointment_form" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('add_new_appointment', 'موعد جديد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
	
	<section class="form-holder">
		<form id="add_new_appointment_form">
			<div class="form-control">
				<label><?=lang('patient_file_num', 'رقم ملف المريض', 1); ?></label>
				<input id="nw_app_pat_file_num" pat_name_input="nw_app_pat_name" pat_id_input="nw_app_pat_id" class="auto_complete_file_no" type="text" name="file_num">
			</div>
			
			<div class="form-control" style="position:relative;">
				<label><?=lang('patient_name', 'اسم المريض', 1); ?></label>
				<input id="nw_app_pat_name" class="auto_complete_pat_name" pat_autocomp_list="nw_app_name_autocomp" pat_id_input="nw_app_pat_id" pat_file_num_input="nw_app_pat_file_num" type="text" name="patient_name">
				<ul id="nw_app_name_autocomp" class="auto_complete_list auto_complete_list_hidden">
					<li><?=lang('Loading data...', 'جاري التحميل', 1); ?></li>
					
				</ul>
			</div>
			<input id="nw_app_pat_id" class="data-input" req="1" defaulter="" denier="0" value="0" alerter="please select patient" type="hidden" name="patient_id">
			
<script>
function slct_pat_nw_app(id, file, name){
	var ths_id = 'li_' + id + '_' + file;
	var pat_id_dest = $('#' + ths_id).attr('id_dest');
	var pat_file_dest = $('#' + ths_id).attr('file_dest');
	var pat_name_dest = $('#' + ths_id).attr('name_dest');
	
	var list_dest = $('#' + ths_id).attr('list_dest');
	
	
	console.log(ths_id);
	
	$('#' + pat_id_dest).val(id);
	$('#' + pat_file_dest).val(file);
	$('#' + pat_name_dest).val(name);
	
	
	$('#' + list_dest).addClass('auto_complete_list_hidden');
}

$('.auto_complete_pat_name').on('keyup', function(){
	
	var ths_val = $(this).val();
	
	var ths_pat_file_num_input = $(this).attr('pat_file_num_input');
	var autocomp_list = $(this).attr('pat_autocomp_list');
	var ths_pat_id_input = $(this).attr('pat_id_input');
	
	$('#' + ths_pat_id_input).val('');
	$('#' + ths_pat_file_num_input).val('');
	$('#' + ths_pat_id_input).val(0);
	
	if(ths_val != ''){
		
		var snt_data = new FormData();
		//continue
		//send ajax request to load patient data
		snt_data.append('pat_name', ths_val);
		snt_data.append('op', 1);
		$.ajax({
			url     : '<?=api_root; ?>patients/get_patient_data_by_name.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#' + autocomp_list).removeClass('auto_complete_list_hidden');
				$('#auto_complete_pat_name').val('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#' + autocomp_list).html(data);
				$('#auto_complete_pat_name').val('');
			},
			error : function(data){
				alert('load error' + data);
			}
		});
		
		
	} else {
		$('#' + autocomp_list).addClass('auto_complete_list_hidden');
	}
	
});



$('.auto_complete_file_no').on('keyup', function(){
	var ths_val = $(this).val();
	var is_num = true;
	var nums = '';
	var ths_pat_name_input = $(this).attr('pat_name_input');
	var ths_pat_id_input = $(this).attr('pat_id_input');
	
	var snt_data = new FormData();
	
	for(i=0;i<ths_val.length;i++){
		if($.isNumeric(ths_val[i])){
			is_num = true;
			nums = nums + '' + ths_val[i];
		} else {
			is_num = false;
			break;
		}
	}
		
	if(is_num == true){
		//continue
		//send ajax request to load patient data
		snt_data.append('pat_file_num', ths_val);
		snt_data.append('op', 1);
		
		
		$.ajax({
			url     : '<?=api_root; ?>patients/get_patient_data_by_file_num.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#' + ths_pat_name_input).val('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				data_arr = data.split('|');
				$('#' + ths_pat_id_input).val(data_arr[0]);
				$('#' + ths_pat_name_input).val(data_arr[1]);
			},
			error : function(data){
				alert('load error' + data);
			}
		});
		
		
		
		
	} else {
		$(this).val(nums);
		alert('<?=lang('please_insert_only_numbers', 'الرجاء ادخال ارقام فقط', 1); ?>');
	}
	
});
</script>
			
			
			<div class="form-control">
				<label><?=lang('doctor', 'الطبيب', 1); ?></label>
				<select id="nw_app_dr" class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="doctor_id">
					<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<?php
					
		$q = "SELECT `employee_id`,`title`, `first_name`, `last_name` FROM `clinics_employees` WHERE ((`is_deleted` = '0') AND  (`is_dr` = 1) AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		$q_exe = mysqli_query($KONN, $q);
		if(mysqli_num_rows($q_exe) > 0){
			$cc = 0;
			while($dr_datas = mysqli_fetch_assoc($q_exe)){
					?>
					<option value="<?=$dr_datas['employee_id']; ?>"><?=$dr_datas['first_name'].' '.$dr_datas['last_name']; ?></option>
	<?php
			}
		}
	?>
					
				</select>
			</div>
			
			<div class="form-control">
				<label><?=lang('date', 'التاريخ', 1); ?></label>
				<input id="nw_app_date" class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="date">
			</div>
			
			
			<div class="form-control">
				<label><?=lang('hour', 'الساعة', 1); ?></label>
				<select id="nw_app_hour" class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="hour">
					<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<?php 
					for($i=9;$i<=22;$i++){ 
					$hour = $i;
					if($i<10){$hour = '0'.$i;}
					?>
					<option value="<?=$i; ?>"><?=$hour; ?></option>
					<?php }?>
				</select>
			</div>
			
			<div class="form-control">
				<label><?=lang('minute', 'الدقيقة', 1); ?></label>
				<select id="nw_app_min" class="data-input" req="1" defaulter="" denier="1" alerter="please check inputs" name="minute">
					<option value="1"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<option value="0"><?=lang('00'); ?></option>
					<option value="15"><?=lang('15'); ?></option>
					<option value="30"><?=lang('30'); ?></option>
					<option value="45"><?=lang('45'); ?></option>
				</select>
			</div>
			
			
			<div class="form-control">
				<label><?=lang('duration', 'المدة', 1); ?>( <?=lang('minutes', 'بالدقائق', 1); ?> )</label>
				<input type="number" min="15" step="15" required id="nw_app_dur" value="15" class="data-input" req="1" defaulter="" denier="1" alerter="please check inputs" name="duration">
			</div>
			
			<div class="form-control">
				<label><?=lang('procewdure', 'الاجراء', 1); ?></label>
				<select id="nw_app_proc" class="data-input" req="1" defaulter="" denier="" alerter="please check inputs" name="procedure_id">
					<option value="0"><?=lang('None', 'بلا', 1); ?></option>
<?php
	$qu_clinics_procedures_sel = "SELECT `procedure_id`, `procedure_name` FROM  `clinics_procedures` WHERE `clinic_id` = ".$_SESSION['clinic_id'];
	$qu_clinics_procedures_EXE = mysqli_query($KONN, $qu_clinics_procedures_sel);
	if(mysqli_num_rows($qu_clinics_procedures_EXE)){
		while($clinics_procedures_REC = mysqli_fetch_assoc($qu_clinics_procedures_EXE)){
		?>
					<option value="<?=$clinics_procedures_REC['procedure_id']; ?>"><?=$clinics_procedures_REC['procedure_name']; ?></option>
		<?php
		}
	}
?>
				</select>
			</div>
			
			
		</form>
			<br>
			<br>
			<br>
			
		<div class="form-control">
			<label><?=lang('submit_data', 'حفظ', 1); ?></label>
			<button type="button" onclick="URLer = '<?=api_root; ?>appointments/add_appointment.php';redirecter = 'close_modal';submit_form('add_new_appointment_form');"><?=lang('add_new_appointment'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
			
			
	</section>
		<br>
	</section>

</section>
	
<section id="edit_appointment_form" class="modal">
	<section class="modal-header">
		<h1 id="modal-title"><?=lang('Edit_appointment', 'تحرير موعد', 1); ?></h1>
		<i onclick="hide_modal();" class="fa fa-close" area-hidden="true"></i>
	</section>
	<section class="modal-body">
		<br>
	
	
	<section class="form-holder">
		<form id="edit_pat_appointment_form">
			<div class="form-control">
				<label><?=lang('patient_file_num', 'رقم ملف المريض', 1); ?></label>
				<input id="edit_app_pat_file_num" pat_name_input="edit_app_pat_name" pat_id_input="edit_app_pat_id" class="auto_complete_file_no_ed" type="text" name="file_num">
			</div>
			
			<div class="form-control" style="position:relative;">
				<label><?=lang('patient_name', 'اسم المريض', 1); ?></label>
				<input id="edit_app_pat_name" class="auto_complete_pat_name_edit" pat_autocomp_list="edit_app_name_autocomp" pat_id_input="edit_app_pat_id" pat_file_num_input="edit_app_pat_file_num" type="text" name="patient_name">
				<ul id="edit_app_name_autocomp" class="auto_complete_list auto_complete_list_hidden">
					<li><?=lang('Loading data...', 'جاري التحميل', 1); ?></li>
					
				</ul>
			</div>
			
			<input id="edit_app_pat_id" class="data-input" req="1" defaulter="" denier="0" value="0" alerter="please select patient" type="hidden" name="patient_id">
			<input id="edit_appointment_id" class="data-input" req="1" defaulter="" denier="0" value="0" alerter="please select patient" type="hidden" name="appointment_id">
			
<script>
function slct_pat_edit_app(id, file, name){
	var ths_id = 'li_' + id + '_' + file;
	var pat_id_dest = $('#' + ths_id).attr('id_dest');
	var pat_file_dest = $('#' + ths_id).attr('file_dest');
	var pat_name_dest = $('#' + ths_id).attr('name_dest');
	
	var list_dest = $('#' + ths_id).attr('list_dest');
	
	
	console.log(ths_id);
	
	$('#' + pat_id_dest).val(id);
	$('#' + pat_file_dest).val(file);
	$('#' + pat_name_dest).val(name);
	
	
	$('#' + list_dest).addClass('auto_complete_list_hidden');
}

$('.auto_complete_pat_name_edit').on('keyup', function(){
	
	var ths_val = $(this).val();
	
	var ths_pat_file_num_input = $(this).attr('pat_file_num_input');
	var autocomp_list = $(this).attr('pat_autocomp_list');
	var ths_pat_id_input = $(this).attr('pat_id_input');
	
	$('#' + ths_pat_id_input).val('');
	$('#' + ths_pat_file_num_input).val('');
	$('#' + ths_pat_id_input).val(0);
	
	if(ths_val != ''){
		
		var snt_data = new FormData();
		//continue
		//send ajax request to load patient data
		snt_data.append('pat_name', ths_val);
		snt_data.append('op', 2);
		$.ajax({
			url     : '<?=api_root; ?>patients/get_patient_data_by_name.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#' + autocomp_list).removeClass('auto_complete_list_hidden');
				$('#auto_complete_pat_name_edit').val('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#' + autocomp_list).html(data);
				$('#auto_complete_pat_name_edit').val('');
			},
			error : function(data){
				alert('load error' + data);
			}
		});
		
		
	} else {
		$('#' + autocomp_list).addClass('auto_complete_list_hidden');
	}
	
});



$('.auto_complete_file_no_ed').on('keyup', function(){
	var ths_val = $(this).val();
	var is_num = true;
	var nums = '';
	var ths_pat_name_input = $(this).attr('pat_name_input');
	var ths_pat_id_input = $(this).attr('pat_id_input');
	
	var snt_data = new FormData();
	
	for(i=0;i<ths_val.length;i++){
		if($.isNumeric(ths_val[i])){
			is_num = true;
			nums = nums + '' + ths_val[i];
		} else {
			is_num = false;
			break;
		}
	}
		
	if(is_num == true){
		//continue
		//send ajax request to load patient data
		snt_data.append('pat_file_num', ths_val);
		snt_data.append('op', 1);
		
		
		$.ajax({
			url     : '<?=api_root; ?>patients/get_patient_data_by_file_num.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#' + ths_pat_name_input).val('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				data_arr = data.split('|');
				$('#' + ths_pat_id_input).val(data_arr[0]);
				$('#' + ths_pat_name_input).val(data_arr[1]);
			},
			error : function(data){
				alert('load error' + data);
			}
		});
		
		
		
		
	} else {
		$(this).val(nums);
		alert('<?=lang('please_insert_only_numbers', 'الرجاء ادخال ارقام فقط', 1); ?>');
	}
	
});
</script>
			
			
			<div class="form-control">
				<label><?=lang('doctor', 'الطبيب', 1); ?></label>
				<select id="edit_app_dr" class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="doctor_id">
					<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<?php
					
		$q = "SELECT `employee_id`,`title`, `first_name`, `last_name` FROM `clinics_employees` WHERE ( (`is_deleted` = '0') AND (`is_dr` = 1) AND (`clinic_id` = ".$_SESSION['clinic_id'].") )";
		$q_exe = mysqli_query($KONN, $q);
		if(mysqli_num_rows($q_exe) > 0){
			$cc = 0;
			while($dr_datas = mysqli_fetch_assoc($q_exe)){
					?>
					<option value="<?=$dr_datas['employee_id']; ?>"><?=$dr_datas['first_name'].' '.$dr_datas['last_name']; ?></option>
	<?php
			}
		}
	?>
					
				</select>
			</div>
			
			<div class="form-control">
				<label><?=lang('date', 'التاريخ', 1); ?></label>
				<input id="edit_app_date" class="has_date data-input" req="1" defaulter="" denier="" alerter="please check inputs" type="text" name="date">
			</div>
			
			
			<div class="form-control">
				<label><?=lang('hour', 'الساعة', 1); ?></label>
				<select id="edit_app_hour" class="data-input" req="1" defaulter="" denier="1986" alerter="please check inputs" name="hour">
					<option value="1986"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<?php 
					for($i=9;$i<=22;$i++){ 
					$hour = $i;
					if($i<10){$hour = '0'.$i;}
					?>
					<option value="<?=$i; ?>"><?=$hour; ?></option>
					<?php }?>
				</select>
			</div>
			
			<div class="form-control">
				<label><?=lang('minute', 'الدقيقة', 1); ?></label>
				<select id="edit_app_min" class="data-input" req="1" defaulter="" denier="1" alerter="please check inputs" name="minute">
					<option value="1"><?=lang('please_select', 'الرجاء الاختيار', 1); ?></option>
					<option value="0"><?=lang('00'); ?></option>
					<option value="15"><?=lang('15'); ?></option>
					<option value="30"><?=lang('30'); ?></option>
					<option value="45"><?=lang('45'); ?></option>
				</select>
			</div>
			
			<div class="form-control">
				<label><?=lang('duration', 'المدة', 1); ?>( <?=lang('minutes', 'بالدقائق', 1); ?> )</label>
				<input type="number" min="15" step="15" required id="edit_app_dur" class="data-input" req="1" defaulter="" denier="1" alerter="please check inputs" name="duration">
			</div>
		</form>
			<br>
			<br>
			<br>
			
		<div class="form-control">
			<label><?=lang('submit_data', 'حفظ', 1); ?></label>
			<button type="button" onclick="URLer = '<?=api_root; ?>appointments/edit_appointment.php';redirecter = 'close_modal';submit_form('edit_pat_appointment_form');"><?=lang('edit_appointment'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('cancel', 'إلغاء', 1); ?></button>
		</div>
			
	</section>
		<br>
	</section>
</section>
	
	
	

<script type="text/javascript" src="<?=assets_root; ?>js/ajax_funcs.js"></script>
<script type="text/javascript" src="<?=assets_root; ?>js/alerts_funcs.js"></script>
<script type="text/javascript" src="<?=assets_root; ?>js/loader_funcs.js"></script>
<script type="text/javascript" src="<?=assets_root; ?>js/taber.js"></script>
<!-- datepicker css -->
<script type="text/javascript" src="<?=assets_root; ?>js/jquery_datepicker.js"></script>
<link type="text/css" rel="stylesheet" href="<?=assets_root; ?>js/jquery_datepicker.css" >

<script>

var html_top_scroll;
var mnu_shown = false;
var usr_opt_shown = false;



function show_emp_note_modal(idd){
	idd = parseInt(idd);
	if(idd != 0){
		
		var snt_data = new FormData();
		snt_data.append('employee_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>employee/get_file_note_form.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('add_employee_note', 'إضافة ملاحظة للموظف', 1); ?>');
				$('#data_fetch_modal .modal-body').html(data);
				show_modal('data_fetch_modal');
			},
			error : function(data){
				alert('load error' + data);
			}
		});
	}
}



function show_note_modal(idd){
	idd = parseInt(idd);
	if(idd != 0){
		
		var snt_data = new FormData();
		snt_data.append('patient_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>patients/get_file_note_form.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('add_patient_note', 'إضافة ملاحظة للمريض', 1); ?>');
				$('#data_fetch_modal .modal-body').html(data);
				show_modal('data_fetch_modal');
			},
			error : function(data){
				alert('load error' + data);
			}
		});
	}
}


function show_transfer_modal(idd){
	idd = parseInt(idd);
	if(idd != 0){
		
		var snt_data = new FormData();
		snt_data.append('patient_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>patients/get_transfer_form.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('edit_procedure', 'تحرير الاجراء', 1); ?>');
				$('#data_fetch_modal .modal-body').html(data);
				show_modal('data_fetch_modal');
			},
			error : function(data){
				alert('load error' + data);
			}
		});
	}
}






function mark_task_as_done(task_id){
	
	var aa = confirm('<?=lang('Are_You_Sure_?', 'هل انت متأكد ؟', 1); ?>');
	if(aa == true){
		var frm_data = new FormData();
		frm_data.append('op', 1);
		frm_data.append('task_id', task_id);
	
			$.ajax({
				url     : '<?=api_root; ?>tasks/mark_as_done.php',
				data    : frm_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					set_loader(10);
				},
				success : function(data){
					mk_alert(data, 'suc');
					set_loader(100);
					setTimeout(function(){set_loader(0);location.reload();}, 1000);
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	}
	
}



function show_main_menu(){
	if(usr_opt_shown == true){
		usr_opt_shown = false;
		hide_user_opt();
	}
	$('header').addClass('header-showed');
	show_ghost('hide_main_menu');
	mnu_shown = true;
}


function hide_main_menu(){
	$('header').removeClass('header-showed');
	mnu_shown = false;
	setTimeout(function(){hide_ghost();}, 100);
}

function add_new_appointment_patient(file_no, dr_id){
		$('#nw_app_pat_file_num').val('');
		$('#nw_app_pat_name').val('');
	file_no = parseInt(file_no);
	dr_id = parseInt(dr_id);
	//check activate time frame
	if(file_no != 0){
		//load data
		
		
		
		$('#nw_app_dr').val(dr_id);
		$('#nw_app_pat_file_num').val(file_no);
		
		
		
		show_modal('nw_appointment_form');
		$('#nw_app_pat_file_num').keyup();
	}
}

function add_new_appointment_calendar(){
		$('#nw_app_pat_file_num').val('');
		$('#nw_app_pat_name').val('');
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr = parseInt($('#' + slcted_frame).attr('dr_id'));
		var y = parseInt($('#' + slcted_frame).attr('t_year'));
		var m = parseInt($('#' + slcted_frame).attr('t_month'));
		var d = parseInt($('#' + slcted_frame).attr('t_day'));
		var h = parseInt($('#' + slcted_frame).attr('t_hour'));
		var i = parseInt($('#' + slcted_frame).attr('t_min'));
		
		if(m < 10){m = '0' + m;}
		if(d < 10){d = '0' + d;}
		
		
		var dater = y + '-' + m + '-' + d;
		$('#nw_app_date').val(dater);
		
		$('#nw_app_dr').val(dr);
		
		$('#nw_app_hour').val(h);
		$('#nw_app_min').val(i);
		
		
		var chk = $('#nw_app_hour').val();
		if(chk == null){
			$('#nw_app_hour').val(1986);
		}
		
		
		show_modal('nw_appointment_form');
	}
}

function edit_appointment_calendar(){
	
	
	//check activate time frame
	if(slcted_frame != 'na'){
		//load data
		var dr = parseInt($('#' + slcted_frame).attr('dr_id'));
		var y = parseInt($('#' + slcted_frame).attr('t_year'));
		var m = parseInt($('#' + slcted_frame).attr('t_month'));
		var d = parseInt($('#' + slcted_frame).attr('t_day'));
		var h = parseInt($('#' + slcted_frame).attr('t_hour'));
		var i = parseInt($('#' + slcted_frame).attr('t_min'));
		var dur = parseInt($('#' + slcted_frame).attr('t_dur'));
		
		var appointment_id = parseInt($('#' + slcted_frame).attr('appointment_id'));
		
		var patient_file_num = parseInt($('#' + slcted_frame).attr('patient_file_num'));
		var patient_id = parseInt($('#' + slcted_frame).attr('patient_id'));
	
		if(m < 10){m = '0' + m;}
		if(d < 10){d = '0' + d;}
		
		
		var dater = y + '-' + m + '-' + d;
		
		$('#edit_app_date').val(dater);
		
		$('#edit_app_dr').val(dr);
		
		$('#edit_app_hour').val(h);
		$('#edit_app_min').val(i);
		
		$('#edit_app_dur').val(dur);
		
		$('#edit_appointment_id').val(appointment_id);
		
		$('#edit_app_pat_id').val(patient_id);
		$('#edit_app_pat_file_num').val(patient_file_num);
		
		$('#edit_app_pat_file_num').keyup();
		
		var chk = $('#edit_app_hour').val();
		if(chk == null){
			$('#edit_app_hour').val(1986);
		}
		
		
		show_modal('edit_appointment_form');
	}
}

function add_new_appointment(){
	show_modal('nw_appointment_form');
}


function show_modal(mod_id){
	<?php if($page_id == 2){ ?>
	unslct_time_block();
	<?php } ?>
	html_top_scroll = $('html').scrollTop();
	$('html').scrollTop(0);
	setTimeout(function(){show_ghost('hide_modal');}, 100);
	$('#' + mod_id).addClass('modal-showed');
}


function hide_modal(){
	$('.modal').removeClass('modal-showed');
	setTimeout(function(){hide_ghost();$('html').scrollTop(html_top_scroll);}, 100);
	
}


function show_ghost(func_name){
	$('#ghost').removeClass('ghost-hidden');
	$('#ghost').attr('onclick', func_name + '();');
}

function hide_ghost(){
	if(mnu_shown == true){
		mnu_shown = false;
		hide_main_menu();
	}
	if(dr_opt_showed == true){
		dr_opt_showed = false;
		hide_dr_opt();
	}
	$('#ghost').addClass('ghost-hidden');
}

function show_user_opt(){
	usr_opt_shown = true;
	if(mnu_shown == true){
		hide_main_menu();
		mnu_shown = false;
	}
	show_ghost('hide_user_opt');
	$('#user-opt').addClass('user-opt-viewed');
	$('.user-opt-viewer').addClass('user-opt-vieweder');
}

function hide_user_opt(){
	usr_opt_shown = false;
	hide_ghost();
	clear_opt();
	$('#user-opt').removeClass('user-opt-viewed');
	$('.user-opt-viewer').removeClass('user-opt-vieweder');
}

function do_date_picker(){
	$(".has_date").datepicker({
	  dateFormat: "yy-mm-dd",
	  changeYear: true, 
	  changeMonth: true, 
	  yearRange: "1950:<?=date('Y'); ?>"
	});
}

function remove_date_picker(){
	$( ".has_date" ).datepicker( "destroy" );
}



//cookies funcs start ------------------------------------------------------------
function set_cookie(cname, cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + (200 * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function get_cookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return false;
}

function check_cookie(cname) {
    var user = get_cookie(cname);
    if (user != false) {
        return true;
    } else {
        return false;
    }
} 
//cookies funcs end ---------------------------------------------------------



//AUTO START JS

if(check_cookie('current_mnu') != false){
	start_mnu(get_cookie('current_mnu'));
} else {
	start_mnu(1);
}




set_loader(100);



setTimeout(function(){set_loader(0);}, 400);

//date picker date inisialize
do_date_picker();







</script>
		<?php if($page_id == 1 || $page_id == 2 ||$page_id == 3 || $page_id == 4){
		?>
		<script>start_mnu(1);</script>
		<?php
		}
		?>
		<?php if($page_id == 5 || $page_id == 6 || $page_id == 132654 || $page_id == 666 || $page_id == 7 || $page_id == 8){
		?>
		<script>start_mnu(2);</script>
		<?php
		}
		?>
		<?php if($page_id == 66 || $page_id == 456 || $page_id == 457 || $page_id == 458 || $page_id == 459 || $page_id == 461){
		?>
		<script>start_mnu(3);</script>
		<?php
		}
		?>
		<?php if( $page_id == 462 || $page_id == 463 ){
		?>
		<script>start_mnu(4);</script>
		<?php
		}
		?>