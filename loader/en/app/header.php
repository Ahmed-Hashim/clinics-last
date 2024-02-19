<header>
	<nav>
		<ul id="main-mnu">
			<li onclick="selct_mnu(1);" id="mnu_1" <?php if($pager == 1){echo ' class="red-bg"';} ?>><a href="index.php">Clinics</a></li>
			
			<li><a href="logout.php">Log Out</a></li>
			<div class="zero"></div>
		</ul>
	<div class="zero"></div>
	</nav>
</header>
<?php
	require_once('aside.php');
?>

<article id="main-container" <?php if($has_sub == false){ echo ' class="main-container-without-left"';} ?>>