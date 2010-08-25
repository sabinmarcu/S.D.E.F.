
application['loginout'].postload = function(){
	$("form").submit(function(){alert("caught"); return false;});
}