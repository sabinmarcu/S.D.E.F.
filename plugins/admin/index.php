<?php
	include $plugin[dir]."/functions.php";
	if (secure($_POST['register'])) {
		form('register');
	}	else form('login');
?>