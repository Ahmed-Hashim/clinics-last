<?php
require_once('../../bootstrap/app_config.php');


	session_start();
$cc=1;
	if(isset($_SESSION['creator_of_all']) && isset($_SESSION['usr_id']) && isset($_SESSION['clinic_id']) && isset($_SESSION['clinic_short_code'])){
		if(($_SESSION['creator_of_all'] == "allah") && ($_SESSION['usr_id'] == "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl")){


if( isset($_POST['op']) && 
	isset($_POST['procedure_id']) 
	){
		
//data collection
	$op = (int) test_inputs($_POST['op']);
	$procedure_id = (int) test_inputs($_POST['procedure_id']);
	
	if($op == 1){
?>
		<br>
<h3 style="text-align:left;">- <?=lang('defined_parts'); ?></h3>
<section class="assembeled_parts">
<?php
		$q = "SELECT * FROM `clinics_procedures_assembly` WHERE ((`procedure_id` = ".$procedure_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].")) ORDER BY `record_id` ASC";
		$qee = mysqli_query($KONN, $q);
		$counts = mysqli_num_rows($qee);
		
		if($counts > 0){
			$cc=1;
			while($part_data = mysqli_fetch_assoc($qee)){
				if($cc>1){
?>
<div typo="plus" class="plus_sign part" id="plus_<?=$cc; ?>"><i class="fa fa-plus" area-hidden="true"></i></div>
<?php
				}
?>
<div class="part" id="part_<?=$cc; ?>">
<?=$part_data['part_name']; ?>&nbsp;X&nbsp;<?=$part_data['part_qty']; ?>
&nbsp;&nbsp;<button onclick="remove_part(<?=$cc; ?>);" type="button"><i class="fa fa-trash" area-hidden="true"></i></button>
</div>
<?php
			$cc++;
			}
		}
?>
</section>

<h3 style="text-align:left;">- <?=lang('add_new_part'); ?></h3>
<table class="whatever05">
	<tbody>
		<tr>
			<td><?=lang('part_type'); ?></td>
			<td><?=lang('part_name'); ?></td>
			<td><?=lang('Quantity'); ?></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:left;">
				<select id="main_items_selector">
					<option value="0"><?=lang('select_type'); ?></option>
					<option value="1"><?=lang('medication'); ?></option>
					<option value="2"><?=lang('inventory_item'); ?></option>
					<option value="3"><?=lang('lab_exam'); ?></option>
				</select>
			</td>
			
			<td>
				<select id="sub_items_selector">
					<option value="0"><?=lang('select_item'); ?></option>
				</select>
			</td>
			<td><input id="qty_selector" type="text" placeholder="<?=lang('Quantity'); ?>"></td>
			<td><button onclick="add_part();" type="button"><?=lang('add_part'); ?></button></td>
		</tr>
	</tbody>
</table>
		
	<section class="form-holder">
		<form id="assembled_data_form">
				<input value="<?=$procedure_id; ?>" type="hidden" id="procedure_id" name="procedure_id">
<?php
		$q = "SELECT * FROM `clinics_procedures_assembly` WHERE ((`procedure_id` = ".$procedure_id.") AND (`clinic_id` = ".$_SESSION['clinic_id'].")) ORDER BY `record_id` ASC";
		$qee = mysqli_query($KONN, $q);
		$counts = mysqli_num_rows($qee);
		
		if($counts > 0){
			$cc=1;
			while($part_data = mysqli_fetch_assoc($qee)){
?>
<input id="inp_<?=$cc; ?>" type="hidden" name="itms[]" value="<?=$part_data['part_id']; ?>">
<input id="inp_name_<?=$cc; ?>" type="hidden" name="itms_names[]" value="<?=$part_data['part_name']; ?>">
<input id="inp_qty_<?=$cc; ?>" type="hidden" name="itms_qty[]" value="<?=$part_data['part_qty']; ?>">
<input id="inp_typo_<?=$cc; ?>" type="hidden" name="itms_typo[]" value="<?=$part_data['typo']; ?>">

<?php
			$cc++;
			}
		}
?>
		</form>
			<br>
		<div class="form-control">
			<label><?=lang('submit_data'); ?></label>
			<button type="button" onclick="assemble_procedure();"><?=lang('save'); ?></button>
			<button type="button" onclick="hide_modal();"><?=lang('close'); ?></button>
		</div>
	</section>
		<br>
<script>
var itm_count = <?=$cc-1; ?>;
var toter = <?=$cc-1; ?>;

function add_part(){
	//check main item
	var main_item = parseInt($('#main_items_selector').val());
	if(main_item!=0){
		//check sub item
		var sub_item = parseInt($('#sub_items_selector').val());
		var qty = parseFloat($('#qty_selector').val());
		if(sub_item!=0 && isNaN(qty)!=true && qty!=0){
			itm_count++;
			toter++;
			var itm_name = $('#slctd_item_' + sub_item).html();
			var plusser = '<div typo="plus" class="plus_sign part" id="plus_' + itm_count + '"><i class="fa fa-plus" area-hidden="true"></i></div>';
			var nw_part = '<div class="part" id="part_' + itm_count + '">' +
								itm_name + ' X ' + qty +
								'&nbsp;&nbsp;<button onclick="remove_part(' + itm_count + ');" type="button"><i class="fa fa-trash" area-hidden="true"></i></button>' +
							'</div>';
			if(toter > 1){
				nw_part = plusser + nw_part;
			}
			
			var typo = '';
			if(main_item==1){
				typo = 'medications';
			} else if(main_item==2){
				typo = 'inventory';
			} else if(main_item==3){
				typo = 'lab_exam';
			}
			
			var data_inp = '<input id="inp_' + itm_count + '" type="hidden" name="itms[]" value="'+sub_item+'">';
			data_inp += '<input id="inp_name_' + itm_count + '" type="hidden" name="itms_names[]" value="'+itm_name+'">';
			data_inp += '<input id="inp_qty_' + itm_count + '" type="hidden" name="itms_qty[]" value="'+qty+'">';
			data_inp += '<input id="inp_typo_' + itm_count + '" type="hidden" name="itms_typo[]" value="'+typo+'">';
			
			$('.assembeled_parts').append(nw_part);
			$('#assembled_data_form').append(data_inp);
			
		}
	}
}

function remove_part(idd){
	$('#part_' + idd).remove();
	$('#plus_' + idd).remove();
	
	$('#inp_' + idd).remove();
	$('#inp_name_' + idd).remove();
	$('#inp_qty_' + idd).remove();
	$('#inp_typo_' + idd).remove();
	toter--;
	if(toter == 1){
		$('.plus_sign').remove();
	}
	var frst_type = $('.assembeled_parts div:first-child').attr('typo');
	if(frst_type == 'plus'){
		$('.assembeled_parts div:first-child').remove();
	}
}

function assemble_procedure(){
var sent_dat = new FormData();
	if($('.part').length > 0){
		//collect formdata
		// var sent_dat = $('#assembled_data_form').serialize();
		$('#assembled_data_form input').each(function(){
			var ths_name = $(this).attr('name');
			var ths_val = $(this).val();
			sent_dat.append(ths_name, ths_val);
		});
			$.ajax({
				url     : '<?=api_root; ?>procedures/build_assembly.php',
				data    : sent_dat,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					mk_alert('<?=lang('Assembly_Started_...'); ?>', 'suc');
				},
				success : function(data){
					var aa = data.split('|');
					res = parseInt(aa[0]);
					if(res==1){
						mk_alert(aa[1], 'suc');
						hide_modal();
					} else {
						alert(aa[1]);
					}
				},
				error : function(data){
					alert('load error' + data);
				}
			});
	} else {
		var aa = confirm('<?=lang('Sure_To_Clear_Procedure_Assembly_Data_?'); ?>');
		
		if(aa==true){
			//clear all data
			sent_dat.append('procedure_id', <?=$procedure_id; ?>);
			$.ajax({
				url     : '<?=api_root; ?>procedures/clear_assembly.php',
				data    : sent_dat,
				contentType: false,
				processData: false,
				dataType  : 'html',
				method  : 'POST',
				beforeSend : function(){
					mk_alert('<?=lang('Assembly_Started_...'); ?>', 'suc');
				},
				success : function(data){
					var aa = data.split('|');
					res = parseInt(aa[0]);
					if(res==1){
						mk_alert(aa[1], 'suc');
						hide_modal();
					} else {
						alert(aa[1]);
					}
				},
				error : function(data){
					alert('load error' + data);
				}
			});
		}
		
		
	}
}

$('#main_items_selector').on('change', function(){
	var vv = parseInt($('#main_items_selector').val());
	if(vv!=0){
		var snt_data = new FormData();
		if(vv==1){
			snt_data.append('op', 1);
		} else if(vv==2){
			snt_data.append('op', 2);
		} else if(vv==3){
			snt_data.append('op', 3);
		}
		$.ajax({
			url     : '<?=api_root; ?>procedures/get_sub_items.php',
			data    : snt_data,
			contentType: false,
			processData: false,
			dataType  : 'html',
			method  : 'POST',
			beforeSend : function(){
				$('#sub_items_selector').html('<?=lang('Loading data...'); ?>');
			},
			success : function(data){
				$('#sub_items_selector').html(data);
			},
			error : function(data){
				alert('load error' + data);
			}
		});
	}
});
</script>








		
<?php
		

	}
		

	
	
	
	
} else {
			die('0|ERROR no : 56468fesaew');
}










			//page data end
			// log_go("2|17|$usr_ths_id|$clinic_id", $connecter);
			}
	}
?>
