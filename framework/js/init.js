function populate(){
	$.getJSON("/framework/php/plugins.php", function(plugins){
		var content = "";
		$.each(plugins, function(i, plugin){
			if (plugin.haschildren == 1 && plugin.admin)	{
				content += "<li>"+plugin.name+"<ul>";			
				$.each(plugin, function(j, child){
					if (child.name)
						content += "<li id='"+child.index+"' class='"+plugin.index+"'>"+child.name;
						window.application[child.index] = new Window(child.index, plugin.index, child.name);
				});
				content += "<li class='admin' id='"+plugin.index+"-admin'>Admin</li>";
				window.application[plugin.index+"-admin"] = new Window(plugin.index+"-admin", 'admin', plugin.name+" Admin");
				content += "</ul>";
			}	else if (plugin.admin){
				content += "<li id='"+plugin.index+"'>"+plugin.name;
				window.application[plugin.index] = new Window(plugin.index, '', plugin.name);
				content += "<ul><li><li class='admin' id='"+plugin.index+"-admin'>Admin</li></ul";
			}	else {
					content += "<li id='"+plugin.index+"'>"+plugin.name;
					window.application[plugin.index] = new Window(plugin.index, '', plugin.name);
			}
			content +=	"</li>";
		});
		$("nav ul").append(content).find("li").click(function() {
			if ($(this).find("ul").length)	$(this).find("ul:first").toggle('fast');
			else application[$(this).attr('id')].toggle();
		}).find("ul").hide();
		getscripts();
	});
}


function getscripts(){
	$.getJSON("/framework/php/scripts.php", function(scripts){
	$.each(scripts, function(i, script){
		$("footer").append("<script src='"+script['dir']+"' type='text/javascript' charset='utf-8'></script>");
	});
});
}

var application = new Array(new Window);
var user = new Array();

$(document).ready(function()	{	
	$("#javascript, #javaoverlay").delay(2000).hide(500);
	populate();
});