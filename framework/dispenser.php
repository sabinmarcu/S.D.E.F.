<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	$plugins = get_plugins();
	$postdata = explode("-", secure($_POST[id]));
	$post = $postdata[0];
	foreach($plugins as $plugin)	
		if ($plugin[index] == $post)	{		
		include $plugin[init];
		exit;
	}
?>
