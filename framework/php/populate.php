<?php

	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	$plugins = get_plugins();
	echo json_encode($plugins);

?>
