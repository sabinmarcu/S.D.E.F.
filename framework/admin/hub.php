<?php
	session_start();
	if ($_SESSION['auth'])	include 'admin.php';
	else include 'login.php';
?>
