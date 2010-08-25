
application['loginout'].preload = function(){
	this.height = "";
}
	
application['loginout'].postload = function(){
	this.height = $(".container#loginout").css("height");
	$("#register").click(function(){application['loginout'].switchform()});
	$("form").submit(function(){
		switch ($(this).attr('id'))	{
			case 'loginform' :
				$.post("/framework/php/login.php", {username: $("input#username").val(), password: $("input#password").val()}, function(data){
						if (data)	{
							user = data;
							alert("Wellcome back "+data['name']+"!");
							application['loginout'].del();
							if (user['admin'] > 0)	$("nav li.admin").show();
						}
						else alert("Error. Data corrupted! \n Just kidding ;) ... The data you entered is incorrect.");
				}, 'json');
				break;
			case 'logoutform'	:
				$.post("/framework/php/login.php", {logout: 1}, function(){
						user = Array();
						alert("So sorry to have you leave ... \n Come back soon :)");
						$("nav li.admin").hide();
						$(".container.admin").each(function(){
							application[$(this).attr('id')].del();
						})
						application['loginout'].del();
				}, 'json');
				break;
		}
		return false;
	});
}

application['loginout'].switchform = function() {
	$(".container#loginout").find("section").load("/framework/dispenser.php", {id: 'loginout', register: 1}, function(){		
		$(this).animate({height: 225}, 500);
		$("form").submit(function(){
				$.post("/framework/php/register.php", {
					username: $("input#username").val(), 
					password: $("input#password").val(), 
					repassword: $("input#repassword").val(),
					name: $("input#name").val(), 
					email: $("input#email").val(), 
					website: $("input#website").val()}, 
					function(data){
						if (data['result'] == 'success')	{
							user = data;
							alert("Glad to have you with us, "+data.name);	
							application['loginout'].del();
						}
						else alert("Sorry, somthing went to hell : \n "+data['problem']);
				}, 'json');
				return false;
		});
	});
}