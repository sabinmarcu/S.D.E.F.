<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	$plugins = crawl('plugins');
	$id = secure($_POST[id]);
	if (strpos(" ".$id, "-admin"))
	$id = str_replace("-admin", "", $id);
	foreach($plugins as $plugin)	
		if ($plugin[index] == $id)	{		
		include $plugin[init];
		exit;
	}
?>
