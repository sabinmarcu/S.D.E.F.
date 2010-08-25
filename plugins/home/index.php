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
		case 'admin'	:
			?> <h2> Hail <span style='font-size: 20pt;'><script type='text/javascript'> $("section h2 span").html(user.name)</script></span>! </h2>	<?php
			connect();
			?> <label>Owner Name : </label><input type='text' value = '<?php echo siteinfo('owner') ?>'> <?php
	}
	echo Markdown($file);
?>
