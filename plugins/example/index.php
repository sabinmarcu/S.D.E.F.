<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/markdown.php';
	$file = fopen($_SERVER['DOCUMENT_ROOT'].'/plugins/example/file.markdown', 'r');
	$file = fread($file, filesize($_SERVER['DOCUMENT_ROOT'].'/plugins/example/file.markdown'));
	echo Markdown($file);
?>
