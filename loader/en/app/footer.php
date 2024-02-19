
</article>

<footer>
	<section id="pg_not_holder"></section>
	<section id="pg_loader"></section>
	
</footer>

<section id="ghost" class="ghost-hidden">
	<section onclick="hide_ghost();" id="ghost-clash">
		
	</section>
	<section id="ghost-content">
		<section class="ghost-content-header">
			<h1>Project Details</h1>
			<i onclick="hide_ghost();" class="fa fa-times" area-hidden="true"></i>
			<div class="zero"></div>
		</section>
		<section id="ghost-content-data">
			<h1>Project Title</h1>
			<h3>Project Description</h3>
			<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis blandit nisl id rutrum. Duis finibus, ante vitae ullamcorper finibus, purus mauris euismod purus, eu rutrum lacus nulla non enim. Curabitur sit amet mattis lectus, nec finibus elit. In et elit blandit, commodo nibh sit amet, molestie elit. Nam leo elit, placerat non rhoncus eget, mollis varius diam. Donec finibus hendrerit nibh, ut blandit sem vulputate quis. Fusce non mauris non mauris gravida ullamcorper eget ut orci. Integer quis semper dolor. 
			</p>
			<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis blandit nisl id rutrum. Duis finibus, ante vitae ullamcorper finibus, purus mauris euismod purus, eu rutrum lacus nulla non enim. Curabitur sit amet mattis lectus, nec finibus elit. In et elit blandit, commodo nibh sit amet, molestie elit. Nam leo elit, placerat non rhoncus eget, mollis varius diam. Donec finibus hendrerit nibh, ut blandit sem vulputate quis. Fusce non mauris non mauris gravida ullamcorper eget ut orci. Integer quis semper dolor. 
			</p>
			
			<br>
			<h3>Project Attachments</h3>
			<p>
				you can add some pictures or pdf files according to project details
			</p>
			
			
		</section>
	</section>
</section>

<script>
var bottomer = 0;
var lefter = 1;
var ff = 0;
var whatever = 100;
function set_loader(valer){
	$('#pg_loader').css('width', valer + '%');
}
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
		'</section><' + 'script>setTimeout(function(){$("#not_" + ' + whatever + ').remove();}, 10000);' + '<' + '/' + 'script>';
	$('#pg_not_holder').append(alerter);
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
		setTimeout(function(){window.location.replace(redirecter);set_loader(0);}, 3000);
	} else {
		alert(aa[1]);
	}
		
}
function errorHandlerA(event){
	mk_alert("Upload Failed, please check your inputs 4656545687", "err");
}
function abortHandlerA(event){
	mk_alert("Upload Aborted by user", "err");
}
//ajax functions -------------------------------




var invert_det = 0;
function show_det(dd){
	if(invert_det == 0){
		//show b		
		$('#det-a').addClass('deter-up');
		$('#det-b').removeClass('deter-dwn');
		$('#det-b').addClass('deter-up');
		$('#det-b').html(dd);
		setTimeout(function(){$('#main-container').animate({scrollLeft: 0}, 500);}, 500);
		invert_det = 1;
	} else {
		//show a
		$('#det-a').removeClass('deter-up');
		$('#det-b').addClass('deter-dwn');
		$('#det-b').removeClass('deter-up');
		$('#det-a').html(dd);
		setTimeout(function(){$('#main-container').animate({scrollLeft: 0}, 500);}, 500);
		invert_det = 0;
	}
}


var org_wid = 0;
var org_left = 0;
var main_cont_left = 0;
var main_cont_width = 0;

function show_aside(){
	$('#left-nav-sub-sub-container').removeClass('suber_hidden');
	$('#main-container').css('left', main_cont_left + 'px');
	$('#main-container').css('width', main_cont_width + 'px');
}
function hide_aside(){
	$('#left-nav-sub-sub-container').addClass('suber_hidden');
	$('#main-container').css('left', org_left + 'px');
	$('#main-container').css('width', org_wid + 'px');
}

function fix_heights(){
	var header_height = $('header').height();
	var doc_height = $(document).height();
	var doc_width = $(document).width();
	var sub_sub_height = 0;
	var sub_sub_width = 0;
	
	//logo
	var logo_height = doc_height * (0.24);
	var logo_width = doc_width * (0.11);
	//$('#logo-container').css('height', logo_height + 'px');
	$('#logo-container').css('width', logo_width + 'px');
	
	//#left_nav
	//$('#left_nav').css('top', logo_height + 'px');
	$('#left_nav').css('width', logo_width + 'px');
	
	//sub sub
	if($('#left-nav-sub-sub-container').length > 0){
		sub_sub_height = doc_height - header_height;
		sub_sub_width = parseInt($('#left-nav-sub-sub-container').css('width'));
		$('#left-nav-sub-sub-container').css('top', header_height + 'px');
		$('#left-nav-sub-sub-container').css('left', logo_width + 'px');
		$('#left-nav-sub-sub-container').css('height', sub_sub_height + 'px');
	}
	
	//main container
	var main_cont_height = doc_height - header_height;
	main_cont_width = doc_width - (sub_sub_width + logo_width);
	org_wid = doc_width - logo_width;
	main_cont_left = sub_sub_width + logo_width;
	org_left = logo_width;
	$('#main-container').css('top', header_height + 'px');
	$('#main-container').css('left', main_cont_left + 'px');
	$('#main-container').css('width', main_cont_width + 'px');
	$('#main-container').css('height', main_cont_height + 'px');
	
	
}

function hide_ghost(){
	$('#ghost').addClass('ghost-hidden');
}
function show_ghost(){
	$('#ghost').removeClass('ghost-hidden');
}

//AUTO LOAD SCRIPT
fix_heights();

//AUTO EVENT SCRIPT
$( window ).resize(function() {
  fix_heights();
});
</script>