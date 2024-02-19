<aside id="left_nav" <?php if($has_sub == false){ echo ' class="left-nav-hidden"';} ?>>
	<section id="logo-container">
		<img id="logo_pic" src="assets/images/logo.png">
	</section>

	
	<section id="left-nav-container">
	
	</section>

	
	
<script>
//to remove any markup from sub menu
$('#suber-main li a span').each(function(){
	var tt = $(this).text();
	$(this).text(tt);
});
</script>

</aside>