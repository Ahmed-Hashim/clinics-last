<?php
	$PAGE_TITLE = 'LOADER CP';
	$PG_title = 'LOADER CP';
	$PG_desc = 'desc';
	$PG_keywords = 'keywords';
	$PG_author = 'author';
	$pager = 1;
	$sub_page = 1;
	$has_sub = true;
	$has_slider = false;
session_start();
$no_session = true;
$main_pointer = '../../';
	require_once('../bootstrap/app_config.php');
	
	$USR = $PASS = '';
	$RES = '<br>';
if(isset($_POST['usr']) && isset($_POST['pass'])){
	$USR = $_POST['usr'];
	$PASS = $_POST['pass'];
	
	if($USR != '' && $PASS != ''){
			if($USR == 'sb_admin' && $PASS === 'Qwerty#123'){
				
				session_start();
				$_SESSION['username'] = $USR;
				$_SESSION['id'] = 12342;
				$_SESSION['sess_id'] = 'bsmelah-15031986';
				$langg = 'en';
				header('location:'.$langg.'/index.php');
				
			} else {
				$RES = '- Username Or Password Error';
			}
	} else {
		$RES = '- Username Or Password Error';
	}
	
}
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<title>LOADER CMS</title>
<style>
.panel-box {
    width: 30%;
    margin: 3% auto;
    border: 1px solid rgba(0,0,0,0.1);
    box-shadow: 1px 2px 3px rgba(0,0,0,0.1);
    padding: 1%;
    text-align: center;
    font-family: 'calibri';
}

.former {
    width: 90%;
    margin: 1% auto;
}
.former img {
    width: 50%;
    margin: 0 auto;
	 box-shadow: 1px 2px 3px rgba(0,0,0,0.1);
}

.former label {
    display: block;
    text-align: left;
    width: 90%;
    padding: 2%;
}

.former input {
    width: 90%;
    padding: 2%;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 2px;
}


.former select {
    width: 95%;
    padding: 2%;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 2px;
}

.former button {
    width: 90%;
    margin: 0 auto;
    padding: 3%;
    border: none;
    background: #3D2314;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    font-family: 'calibri';
}

</style>
</head>
<body id="bodyer">
<?php
	//include('app/header.php');
	//PAGE DATA START
	//-----------------------------
?>


<div class="panel-box">
	<form method="post">
		<div class="former">
			<img src="en/assets/images/logo.png">
		</div>
		<div class="former">
			<label>Username :</label>
			<input type="text" name="usr" required>
		</div>
		<div class="former">
			<label>Password :</label>
			<input type="password" name="pass" required>
		</div>
		<div class="former" style="color:red;">
			<label><?=$RES; ?></label>
		</div>
		<div class="former">
			<button type="submit">Log In</button>
		</div>
	</form>
</div>
		


<?php
	//-----------------------------
	//PAGE DATA END
	//include('app/footer.php');
?>
</body>
</html>