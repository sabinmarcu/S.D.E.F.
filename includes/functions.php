<?php

function parsekey($xml, $key)	{
	return substr($xml, strpos($xml, "<".$key.">") + strlen($key) + 2, strpos($xml, "</".$key.">") - strpos($xml, "<".$key.">") - strlen($key) - 2);
}

function removekey($xml, $key)	{
	return str_replace(substr($xml, strpos($xml, "<".$key.">"), strpos($xml, "</".$key.">") - strpos($xml, "<".$key.">") + strlen($key) + 3 ), "", $xml);
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

function form($type)	{
	switch ($type){
		case "login":
			?>
				<form method='post' action="login" id='loginform'>
					<label>Username</label>
					<input type='text' placeholder='Username' id='username'>
					<label>Password</label>
					<input type='text' placeholder='Password' id='password'>
					<input type='submit' value='Login!'>
				</form>
			<?php break;
	}
	?> <script> 
	$("form").submit(function(){
	windows['admin'].del();}) </script><?php
}

function connect()	{
	include $_SERVER['DOCUMENT_ROOT'].'/includes/connect.php';
}
function bloginfo($option)	{
	connect();
	$sql = mysql_query("SELECT * FROM bloginfo WHERE key='".secure($option)."'");
	$sql = mysql_fetch_array($sql);
	print_r($sql);
	return $sql[$option];
}
?>
