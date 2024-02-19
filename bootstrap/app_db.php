<?php

$hostname_connecter = "";
$database_connecter = "";
$username_connecter = "";
$password_connecter = "";


		$hostname_connecter = "localhost";
		$database_connecter = "profiles_flexcl";
		$username_connecter = "soul&body";
		$password_connecter = "Soul@body;123456";

$KONN = mysqli_connect($hostname_connecter, $username_connecter, $password_connecter, $database_connecter);

if (mysqli_connect_errno()) {
    printf("<br><br><br>Connect failed: %s\n", mysqli_connect_error());
	echo "no connect";
    exit();
}


			mysqli_query($KONN,"SET NAMES 'utf8'");
			mysqli_query($KONN,'SET CHARACTER SET utf8');

?>