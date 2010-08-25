<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	$plugins = crawl('plugins');
	$id = secure($_POST[id]);
	foreach($plugins as $plugin)	
		if ($plugin[index] == $id)	{		
		include $plugin[init];
		exit;
	}
?>
