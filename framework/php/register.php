<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	$data[name] = secure($_POST[name]);
	$data[username] = secure($_POST[username]);
	$data[password] = secure($_POST[password]);
	$data[repassword] = secure($_POST[repassword]);
	$data[email] = secure($_POST[email]);
	$data[website] = secure($_POST[website]);
	if ($data[password] != $data[repassword]){
		$post[result] = "fail";
		$post[problem] = "You entered two different passwords ...";
		echo json_encode($post);
		exit;
	}
	else {
		connect();
		$sql = mysql_query("SELECT id FROM users WHERE username = '".$data[username]."'");
		if (mysql_num_rows($sql) > 0)	{			
			$post[result] = "fail";
			$post[problem] = "Username taken, sorry ...";
			echo json_encode($post);
			exit;
		}
		else {
			$sql = mysql_query("INSERT INTO users (name, username, password, email, website) VALUES('".$data[name]."', '".$data[username]."', '".md5($data[password])."', '".$data[email]."', '".$data[website]."')");
			if ($sql)		{
					session_start();
					$_SESSION[id] = $data[id];
					$_SESSION[name] = $data[name];
					$_SESSION[username] = $data[username];
					$_SESSION[admin] = $data[admin];
				 	$_SESSION[email] = $data[email];
					$_SESSION[website] = $data[website];
					$data[result] = "success";
					echo json_encode($data);
					exit;
				}
			else {
				$post[result] = "fail";
				$post[problem] = "Ooops, server problem ... \n ".mysql_error();
				echo json_encode($post);
				exit;				
			}
		}
	}
	
?>