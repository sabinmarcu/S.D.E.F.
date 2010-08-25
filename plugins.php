<?php
	session_start();
	print_r($_SESSION);
	session_unregister(id);
	
	print_r($_SESSION);
	session_destroy();
?>
