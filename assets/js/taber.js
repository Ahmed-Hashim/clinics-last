

function init_tabs(){
	var cc = 1;
	$('.tab').each(function(){
		$(this).attr('id', 't-' + cc);
		$(this).attr('order', cc);
		$(this).append('<span></span>');
		cc++;
	});
	cc = 1;
	$('.tab-holder').each(function(){
		$(this).attr('id', 'tab-' + cc);
		cc++;
	});
	
	$('.tab').on('click', function(){
		
		var ord = parseInt($(this).attr('order'));
		if(ord != 0){
			$('.tab-selected').removeClass('tab-selected');
			$('.tab-active').removeClass('tab-active');
			$('#t-' + ord).addClass('tab-selected');
			$('#tab-' + ord).addClass('tab-active');
		}
	});

	
}

init_tabs();

$('#t-1').click();