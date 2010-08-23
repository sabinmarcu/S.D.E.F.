<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/markdown.php';
	switch ($postdata[1])	{
		case 'aweagle' 	:
			$file = fopen($_SERVER['DOCUMENT_ROOT'].'/plugins/home/file.markdown', 'r');
			$file = fread($file, filesize($_SERVER['DOCUMENT_ROOT'].'/plugins/home/file.markdown'));
			break;
		case 'aauthor'	:
			echo bloginfo('owner');
			break;
	}
	echo Markdown($file);
?>
