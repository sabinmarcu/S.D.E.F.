<?php 
function form($type)	{
	switch ($type)	{
		case 'login':
		session_start();
	if (isset($_SESSION[id])) :
	?>
		<form method='post' action="login" id='logoutform'>
			<input type='submit' value='Logout!'>
		</form>
	<?php else : 
	?>
		<form method='post' action="login" id='loginform'>
			<label>Username</label>
			<input type='text' placeholder='Username' id='username'>
			<label>Password</label>
			<input type='password' placeholder='Password' id='password'><br><br><br><br>
			<input type='submit' value='Login !' class='button'><br/>
			<input type='button' value='Register !'id='register' class='button' >
		</form>
	<?php endif;	break;	
		case 'register'	:	?>
		<form method='post' action="login" id='registerform'>
			<label>Name</label>
			<input type='name' placeholder='Your Name' id='name'>
			<label>Username</label>
			<input type='text' placeholder='Username' id='username'>
			<label>Password</label>
			<input type='password' placeholder='Password' id='password'>
			<label>Password yet again ...</label>
			<input type='password' placeholder='Retype Password' id='repassword'>
			<label>E-Mail</label>
			<input type='text' placeholder='E-Mail' id='email'>			
			<label>Website</label>
			<input type='text' placeholder='Website' id='website'>
			<input type='submit' value='Register !' class='button'>
		</form>
	<?php break;
	}
}
?>