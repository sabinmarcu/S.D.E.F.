<?php 
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
}
?>