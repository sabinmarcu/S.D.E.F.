<?php
	mysql_connect($mysql_server, $mysql_username, $mysql_password) or die("Could not connect to the server. Error : ".mysql_error());
	mysql_select_db($mysql_database) or die("Could not connect to the database. Error : ".mysql_error());
?>
