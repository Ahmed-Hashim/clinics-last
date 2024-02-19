



var bottomer = 0;
var lefter = 1;
var ff = 0;
var whatever = 100;
function mk_alert(content, type){
	var bg = '';
	var icon = '';
	if(type == 'err'){
		bg = 'bg-err';
		icon = 'exclamation-circle';
	} else if(type == 'suc'){
		bg = 'bg-suc';
		icon = 'check';
	}
	
	ff = 0;
	$('.pg-notify').each(function(){
		ff++;
	});
	console.log('ff=' + ff);
	if(ff > 0){
		bottomer = 2 + (10 * ff);
	} else {
		bottomer = 2;
	}
	
	if(ff >= 5 ){
		lefter = 45;
		bottomer = 2 + (10 * (ff-5));
	}
	
	if(ff > 9 ){
		$('#pg_not_holder').html('');
		bottomer = 2;
		lefter = 1;
	}
	
	whatever++;
	var alerter = ''+
		'<section id="not_' + whatever + '" style="bottom: ' + bottomer + '%;left: ' + lefter + '%;" onclick="' + "$(this).remove();" + '" class="pg-notify ' + bg + '">' +
			'<i class="fa fa-' + icon + '" aria-hidden="true"></i>' +
			'<span>' + content + '</span>' +
		'</section><' + 'script>setTimeout(function(){$("#not_" + ' + whatever + ').remove();}, 1500);' + '<' + '/' + 'script>';
	$('#pg_not_holder').append(alerter);
}