

var form_processed = '';

function submit_form(frm_id){
	var formdata = new FormData();
	form_processed = frm_id;
	set_loader(0);
	//tinyMCE.triggerSave();
	console.log('submission started');
	var gate = true;
	$('#' + frm_id + ' .data-input').each(function(){
		//collect entry data
		var ths_id = $(this).attr('id');
		var ths_name = $(this).attr('name');
		var ths_den = $(this).attr('denier');
		var ths_alert = $(this).attr('alerter');
		var ths_default = $(this).attr('defaulter');
		var ths_req = parseInt($(this).attr('req'));
		var ths_val = $(this).val();
		var ths_tag = $(this).prop("tagName").toLowerCase();
		var ths_type = '';
		// alert(ths_name);
		ths_alert = ths_alert + ' (' + ths_name + ')';
		//define element type
		if(ths_tag == 'input'){
			ths_type = $(this).attr('type');
		} else {
			ths_type = 'select';
		}
		
		if(ths_type == 'file'){
			//its file
			if (($("#" + ths_id))[0].files.length> 0) {
				var filer = ($("#" + ths_id))[0].files[0];
				formdata.append(ths_id, filer);
			} else {
				if(ths_req == 1){
					gate = false;
					mk_alert(ths_alert, 'err');
					return false;
				}
			}
		} else {
			//its input
			if(ths_val != ths_den){
				formdata.append(ths_name, ths_val);
			} else {
				if(ths_req == 1){
					gate = false;
					mk_alert(ths_alert, 'err');
					return false;
				} else {
					formdata.append(ths_name, ths_default);
				}
			}
		}
		
	});
	
	//gate = false;
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandlerA, false);
	ajax.addEventListener("load", completeHandlerA, false);
	ajax.addEventListener("error", errorHandlerA, false);
	ajax.addEventListener("abort", abortHandlerA, false);
	ajax.open("POST", URLer);
	if(gate == true){
		//send data to ajax
		ajax.send(formdata);
	}
}





function clear_form(frm){
	
	

	$('#' + frm + ' .data-input').each(function(){
		
		//collect entry data
		var ths_id = $(this).attr('id');
		var ths_name = $(this).attr('name');
		var ths_den = $(this).attr('denier');
		var ths_alert = $(this).attr('alerter');
		var ths_default = $(this).attr('defaulter');
		var ths_req = parseInt($(this).attr('req'));
		var ths_val = $(this).val();
		var ths_tag = $(this).prop("tagName").toLowerCase();
		var ths_type = '';
		
		//clear element type based on type
		if(ths_tag == 'input'){
			$(this).val('');
		} else {
			$(this).val(1986);
		}
		
		
	});
	
	
	
}









//ajax functions -------------------------------

function progressHandlerA(event){
	var percent = (event.loaded / event.total) * 100;
	set_loader(percent);
}
function completeHandlerA(event){
	var responser = event.target.responseText;
	console.log(responser);
	var aa = responser.split('|');
	if(aa[0] == 1){
		
		mk_alert(aa[1], 'suc');
		if(redirecter == 'self'){
			setTimeout(function(){set_loader(0);window.location.reload();}, 1000);
		} else if(redirecter == 'close_modal'){
			clear_form(form_processed);
			set_loader(0);
			hide_modal();
			load_calendar();
		} else if(redirecter == 'func_teeth'){
			unslct_teeths();
		} else {
			setTimeout(function(){window.location.replace(redirecter);set_loader(0);}, 2000);
		}
		
	} else {
		alert(aa[1]);
		set_loader(0);
	}
		
}
function errorHandlerA(event){
	mk_alert("Upload Failed, please check your inputs 4656545687", "err");
	set_loader(0);
}
function abortHandlerA(event){
	mk_alert("Upload Aborted by user", "err");
	set_loader(0);
}
//ajax functions -------------------------------