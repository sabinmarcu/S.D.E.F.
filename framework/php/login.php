<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
	if (secure($_POST['logout']))	{
		$data[response] = "Done!";
		session_start();
		session_destroy();
		echo json_encode($data);
	}	else {		
		if (strpos(secure($_POST['username']), " "))	{	
			$data[result] = 'fail';	
			$data['problem'] = 'Username : "'.secure($_POST['username']).'" is invalid.'; 
			echo json_encode($data); 
			exit;
		} else {
			connect();
			$sql = mysql_query("SELECT * FROM users WHERE username = '".secure($_POST['username'])."' AND password ='".md5(secure($_POST['password']))."'");
				if (mysql_num_rows($sql))	{
					session_start();
					$user[result] = 'success';
					$user = mysql_fetch_array($sql, MYSQL_ASSOC);
					session_register(id); $_SESSION[id] = $user[id];
					session_register(name); $_SESSION[name] = $user[name];
					session_register(username); $_SESSION[username] = $user[username];
					session_register(admin); $_SESSION[admin] = $user[admin];
					session_register(email); $_SESSION[email] = $user[email];
					session_register(website); $_SESSION[website] = $user[website];
					echo json_encode($user);
					exit;
				}
				else { 	
					$data[result] = 'fail'; 
					$data['problem'] = "You've got the wrong username-password combination."; 
					echo json_encode($data);
					exit;
				}
		}
	
	}
?>