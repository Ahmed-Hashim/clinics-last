<?php
require_once('bootstrap/app_config.php');
$page_title = lang("Clinic items List", 'قائمة المستلزمات الطبية', 1);
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$show_page_title = true;

$page_id = 666;
$sub_id = 1;


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
	<li id="mob-mnu-btn" class="mob-mnu-button" onclick="show_main_menu();" title="<?=lang('show_main_menu', 'القائمة الرئيسية', 1); ?>">
		<i class="fa fa-bars" area-hidden="true"></i>
	</li>
	<h1><?=$page_title; ?></h1>
	
	<section class="page-options">
		<button type="button" onclick="show_modal('nw_item');"><?=lang('new_item', 'إضافة جديد', 1); ?></button>
	</section>
	
	<div class="zero"></div>
</section>
<?php } ?>



<section class="panel-holder">




<table>
	<thead>
		<tr>
			<td><?=lang('item_id', 'المعرف', 1); ?></td>
			<td><?=lang('item_name', 'الاسم', 1); ?></td>
			<td><?=lang('qty', 'الكمية', 1); ?></td>
			<td><?=lang('options', 'خيارات', 1); ?></td>
		</tr>
	</thead>
	<tbody>




<?php
$Q = "SELECT * FROM `clinics_items` WHERE ( (`clinic_id` = ".$_SESSION['clinic_id'].") )";
$QEXE = mysqli_query($KONN, $Q);
$NUM_REC = mysqli_num_rows($QEXE);
if($NUM_REC > 0){
	
	while($rec = mysqli_fetch_assoc($QEXE)){
?>
		<tr>
			<td><?=$rec['item_id']; ?></td>
			<td><?=$rec['item_name']; ?></td>
			<td><?=$rec['qty']; ?></td>
			<td>
				<button type="button" onclick="edit_item(<?=$rec['item_id']; ?>);"><?=lang('edit', 'تحرير', 1); ?></button>
				<button type="button" onclick="delete_item(<?=$rec['item_id']; ?>);"><?=lang('delete', 'حذف', 1); ?></button>
			</td>
		</tr>
<?php

	}
} else {

?>
	<tr>
		<td colspan="4"><?=lang('No_Data_Found', 'لا توجد بيانات', 1); ?></td>
	</tr>
<?php
}
?>
	</tbody>
</table>




</section>

<script>
function delete_item(idd){
	idd = parseInt(idd);
	if(idd != 0){
		var aa = confirm('<?=lang('are_you_sure_?', 'هل انت متأكد', 1); ?>');
		if(aa == true){
			var snt_data = new FormData();
			snt_data.append('item_id', idd);
			$.ajax({
				url     : '<?=api_root; ?>items/del_items.php',
				data    : snt_data,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
				},
				success : function(data){
					
					var d_arr = data.split('|');
					var rr = parseInt(d_arr[0]);
					if(rr == 1){
						mk_alert(d_arr[1], 'suc');
						location.reload();
					} else {
						alert(data);
					}
					
				},
				error : function(data){
					alert('load error' + data);
				}
			});
		}
		
	}
	
}


function edit_item(idd){
	idd = parseInt(idd);
	if(idd != 0){
		
		var snt_data = new FormData();
		snt_data.append('proc_id', idd);
		snt_data.append('op', 1);
		
		$.ajax({
			url     : '<?=api_root; ?>items/edit_items.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				
				$('#data_fetch_modal .modal-body').html('<?=lang('Loading data...', 'جاري التحميل', 1); ?>');
			},
			success : function(data){
				$('#data_fetch_modal #modal-title').html('<?=lang('edit_item', 'تحرير', 1); ?>');
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
