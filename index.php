<?php
require_once('bootstrap/app_config.php');
$page_title = "Log in";
$page_description = "description";
$page_keywords = "keywords";
$page_author = "author";

$message = '';
if( isset($_GET['fail']) ){
	$message = 'please sign in to continue';
}


if( isset($_POST['clinic_id']) && isset($_POST['username']) && isset($_POST['password']) ){
	
	$clinic_id = (int) test_inputs($_POST['clinic_id']);
	$usr = (string) test_inputs($_POST['username']);
	$pass = (string) test_inputs($_POST['password']);
	
	if($usr != '' && $pass != '' && $clinic_id != ''){
		
		
		$qu = "SELECT COUNT(*) FROM `employees_sys_cred` WHERE ((`employees_sys_cred`.`username` = ?) AND (`employees_sys_cred`.`password` = ?) AND (`employees_sys_cred`.`clinic_id` = ?) AND (`employees_sys_cred`.`is_deleted` = 0))";

				$stmtUI = mysqli_prepare($KONN, $qu);
		$stmtUI = mysqli_stmt_init($KONN);
		if(!mysqli_stmt_prepare($stmtUI, $qu)){echo mysqli_error($KONN)."-34341111sdsd";exit();}
		mysqli_stmt_bind_param($stmtUI, "ssi", $usr, $pass, $clinic_id);
		if(!mysqli_stmt_execute($stmtUI)){echo "123456";exit();}
		mysqli_stmt_bind_result($stmtUI, $user_count);
		mysqli_stmt_store_result($stmtUI);
		$totalRows_get_users = mysqli_stmt_num_rows($stmtUI);
		if($totalRows_get_users != 0){
			while (mysqli_stmt_fetch($stmtUI)) {
				$user_counter = $user_count;
				}
			mysqli_stmt_close($stmtUI);
		}
		
		
						if($user_counter == 1){
							//check for pass
							$emp_level = 0;
							$qu = "SELECT `employee_id`, `department_id`, `emp_level` FROM `employees_sys_cred` WHERE ((`employees_sys_cred`.`username` = ?) AND (`employees_sys_cred`.`password` = ?) AND (`employees_sys_cred`.`clinic_id` = ?) AND (`employees_sys_cred`.`is_deleted` = 0))";

							$stmtUI = mysqli_prepare($KONN, $qu);
							$stmtUI = mysqli_stmt_init($KONN);
							if(!mysqli_stmt_prepare($stmtUI, $qu)){echo "1111saasrht";exit();}
							mysqli_stmt_bind_param($stmtUI, "ssi", $usr, $pass, $clinic_id);
							if(!mysqli_stmt_execute($stmtUI)){echo "123456";exit();}
							mysqli_stmt_bind_result($stmtUI, $employee_id, $department_id_db, $emp_level_DB);
							mysqli_stmt_store_result($stmtUI);
							$totalRows_get_users = mysqli_stmt_num_rows($stmtUI);
							if($totalRows_get_users != 0){
								while (mysqli_stmt_fetch($stmtUI)) {
									$user = $employee_id;
									//$namer = $namer_db;
									$department_id = $department_id_db;
									$emp_level = $emp_level_DB;
									
								}
								mysqli_stmt_close($stmtUI);
								
								
	
	
$Q234 = "SELECT CONCAT(`first_name`, ' ', `last_name`) AS namer, `is_admin` FROM `clinics_employees` WHERE ( (`employee_id` = ".$user.") )";
$QEXE133 = mysqli_query($KONN, $Q234) or die('ss');
$cur_emp_data = mysqli_fetch_array($QEXE133);
								
								
								
								
							//slects clinics info and settings
							$qu = "SELECT 
							`clinics`.`clinic_short_code`,
							`clinics`.`clinic_name`
							FROM clinics WHERE(( clinic_id = ?))";
							$stmtUICC = mysqli_prepare($KONN, $qu);
							$stmtUICC = mysqli_stmt_init($KONN);
							if(!mysqli_stmt_prepare($stmtUICC, $qu)){echo "1111asas2332";exit();}
							mysqli_stmt_bind_param($stmtUICC, "i", $clinic_id);
							if(!mysqli_stmt_execute($stmtUICC)){echo "123456";exit();}
							mysqli_stmt_bind_result($stmtUICC, $clinic_short_code, $clinic_nameer);
							mysqli_stmt_store_result($stmtUICC);
							$totalRows_get_clinic = mysqli_stmt_num_rows($stmtUICC);
							
								while (mysqli_stmt_fetch($stmtUICC)) {
									$short_name = $clinic_short_code;
									$clinic_name = $clinic_nameer;
									}
								mysqli_stmt_close($stmtUICC);

								session_start();
								$_SESSION['creator_of_all'] = "allah";
								$_SESSION['usr_id'] = "spro-am-gonna-be-millionere-inshaallah-ksdh-oshsdlfh-874368mecksefk-aehkl";
								$_SESSION['employee_id'] = $user;
								$_SESSION['user_name'] = $usr;
								$_SESSION['emp_level'] = $emp_level;
								$_SESSION['clinic_id'] = $clinic_id;
								$_SESSION['clinic_short_code'] = $short_name;
								$_SESSION['clinic_name'] = $clinic_name;
								
								$_SESSION['atemps'] = 0;
								$_SESSION['employee_name'] = $cur_emp_data[0];
								$_SESSION['is_admin'] = $cur_emp_data[1];
								
								$go_to = "dashboard.php";
								
								
					

								header('location:'.$go_to);
								
							} else {
							//pass is wrong
								$message = 'Please check your inputs, user or pass error 33';
							}
						} else {
						//wrong usr name
							$message = 'Please check your inputs, user or pass error 22';
						}
		
		
		
		
		
		
		
		
						
		
		
	} else {
		$message = 'Please check your inputs, user or pass error 11';
	}
	
	
}
?>
<!DOCTYPE html>
<html dir="<?=$lang_dir; ?>" lang="<?=$lang; ?>">
  <head>
	<?php include('app/meta.php'); ?>
    <?php include('app/assets.php'); ?>
  </head>
	<body>
<?php

	//PAGE DATA START ----------------------------------------------///---------------------------------
?>
<style>
.form-group {
    width: 100%;
    margin: 0 auto;
}
.form-group img {
    width: 50%;
}
.form-group label {
    display: block;
    text-align: left;
    width: 80%;
    margin: 0 auto;
    margin-top: 10px;
}
.form-group input {
    width: 70%;
    padding: 2%;
}
.form-group button {
    width: 70%;
    padding: 2%;
    margin: 20px auto;
}
</style>

<section class="panel panel-half " style="margin: 0 auto;display: block;">
	<section class="panel-header">
		<?=lang('Please Log in'); ?>
	</section>
	<section class="panel-body">
		<form class="form-main" method="post">
			<div class="form-group">
			<img src="<?=image_root.'logo.png'; ?>" alt="main logo">
		  </div>
			<div class="form-group">
			<label style="color:red;"><?=$message; ?></label>
		  </div>
			<div class="form-group">
			<label for="username"><?=lang('clinic_id'); ?></label>
			<input name="clinic_id" type="text" value="1000" placeholder="<?=lang('Please_Insert_id'); ?>">
		  </div>
			<div class="form-group">
			<label for="username"><?=lang('Username'); ?></label>
			<input name="username" type="text" placeholder="<?=lang('Please_Insert_Username'); ?>">
		  </div>
			<div class="form-group">
			<label for="password"><?=lang('Password'); ?></label>
			<input name="password" type="password" placeholder="<?=lang('Please_Insert_Password'); ?>">
		  </div>
			<div class="form-group">
			<button type="submit" class="bg-01"><?=lang('Log_In'); ?></button>
		  </div>
		</form>
		<br>
	</section>
  <section class="panel-footer">
  	<center>All Rights Reserved &copy; SoulBody <?=date('Y'); ?></center>
  </section>
</section>




<?php
	//PAGE DATA END   ----------------------------------------------///---------------------------------
?>
	</body>
</html>