<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	$plugins = get_plugins();
	foreach($plugins as $plugin)	
		if ($plugin[index] == secure($_POST[id]))	{		
		include $plugin[init];
	}
?>
