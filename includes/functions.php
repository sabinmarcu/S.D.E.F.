<?php

function parsekey($xml, $key)	{
	return substr($xml, strpos($xml, "<".$key.">") + strlen($key) + 2, strpos($xml, "</".$key.">") - strpos($xml, "<".$key.">") - strlen($key) - 2);
}

function get_plugins()	{
	$dir = $_SERVER['DOCUMENT_ROOT'].'/plugins/';
	$i = 1;
	if ($odir = opendir($dir))	
		while ($file = readdir($odir))	
			if (is_dir($dir."/".$file))	
				if ($subdir = opendir($dir."/".$file))	
					while ($subfile = readdir($subdir))
						if ($subfile == "info.xml")	{
							$content = fopen($dir.'/'.$file.'/'.$subfile, 'r');
							$content = fread($content, filesize($dir.'/'.$file.'/'.$subfile));	
							$plugins[$i][name] = parsekey($content, "name");
							$plugins[$i][index] = parsekey($content, "index");
							$plugins[$i][init] = $dir.'/'.$file.'/'.parsekey($content, "init");	
							$i++;
						}
	return $plugins;
}

function get_header()	{
	include 'includes/header.php';
}

function get_footer()	{
	include 'includes/footer.php';
}

function print_plugins($plugins)	{
	foreach ($plugins as $plugin)	{
		?><li id='<?echo $plugin[index];?>'><?php echo $plugin[name]; ?></li><?php
	}
}

function secure($string){
	return strip_tags(addslashes($string));
}
?>
