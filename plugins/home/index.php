<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/markdown.php';
	switch (secure($_POST['child']))	{
		case 'aweagle' 	:
			?> <h1>	Despre acest website : <?php
			echo siteinfo('title');
			?> </h1><p>	<?php
			echo Markdown(siteinfo('longinfo'));			
			?> </p>	<?php
			break;
		case 'aauthor'	:
			?> <h1>	Despre autor : <?php
			echo siteinfo('owner');
			?> </h1><p>	<?php
			echo siteinfo('ownerinfo');			
			?> </p>	<?php
			break;
	}
	echo Markdown($file);
?>
