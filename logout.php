<?php

session_start();


// remove all session variables
session_unset();

// destroy the session
session_destroy(); 

// Redirect browser
	$go_to = "index.php";
	header('location:'.$go_to);
?>