<?php

	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	echo json_encode(crawl('plugins'));

?>
