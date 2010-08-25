<?php

function parsekey($xml, $key)	{
	return substr($xml, strpos($xml, "<".$key.">") + strlen($key) + 2, strpos($xml, "</".$key.">") - strpos($xml, "<".$key.">") - strlen($key) - 2);
}

function removekey($xml, $key)	{
	return str_replace(substr($xml, strpos($xml, "<".$key.">"), strpos($xml, "</".$key.">") - strpos($xml, "<".$key.">") + strlen($key) + 3 ), "", $xml);
}

function crawl($what)	{
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
							if ($what == "plugins")	{
								$plugins[$i][name] = parsekey($content, "name"); $content = removekey($content, "name");
								$plugins[$i][index] = parsekey($content, "index"); $content = removekey($content, "index"); 
								$plugins[$i][init] = $dir.'/'.$file.'/'.parsekey($content, "init"); $content = removekey($content, "init");	$n = 0;
								while (strpos($content, "<child>")){
									$child = parsekey($content, "child");	$n++;
									$plugins[$i][haschildren] = 1;
									$plugins[$i]["child".$n][name] = parsekey($child, "name"); $child = removekey($child, "name");
									$plugins[$i]["child".$n][index] = parsekey($child, "index"); $child = removekey($child, "index"); 
									$plugins[$i]["child".$n][init] = $dir.'/'.$file.'/'.parsekey($child, "init"); $child = removekey($child, "init");					
									$content = removekey($content, 'child');					
								}	
							$plugins[$i][dir] = $dir.$file;	
							if (strpos($content, "admin"))
								$plugins[$i][admin] = $dir.$file."/".parsekey($content, "admin"); $content = removekey($content, "admin");	
							$i++;
							}	else if ($what == "css")	
									while (strpos($content, "<style>")){
										$plugins[$i++][dir] = "/plugins/".$file."/".parsekey($content, "style"); $content = removekey($content, "style");	
										}	
								else if ($what == "js")	
									while (strpos($content, "<script>")){
										$plugins[$i++][dir] = "/plugins/".$file."/".parsekey($content, "script"); $content = removekey($content, "script");	
										}
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

function print_css($styles)	{
	if ($styles)
	foreach ($styles as $css)	{
		?> 	
		<link rel="stylesheet" href="<?php echo $css[dir] ?>" type="text/css" media="screen" title="no title" charset="utf-8">
		<?php
	}
}

function print_js($scripts)	{
	if ($scripts)
	foreach ($scripts as $script)	{
		?> 
		<script src="<?php echo $script[dir] ?>" type="text/javascript" charset="utf-8"></script>		
		<?php
	}
}

function secure($string){
	return strip_tags(addslashes($string));
}

function connect()	{
	require $_SERVER['DOCUMENT_ROOT'].'/framework/config.php';
	require $_SERVER['DOCUMENT_ROOT'].'/includes/connect.php';
}
function siteinfo($option)	{
	connect();
	$sql = mysql_query("SELECT val FROM siteinfo WHERE opt='".secure($option)."'");
	$sql = mysql_fetch_array($sql);
	return $sql[val];
}
?>
