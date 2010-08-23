function Window(id, name)	{
	this.id = id;
	this.name = name;

	//	Construct / Destruct Handler
	this.toggle = function()	{	
		if (!$(".container#"+this.id).length)	{
			this.y = '100px';
			this.x = ($(window).width() - 600) / 2 +"px";
			this.width = '600px';	
			this.height = ($(window).height() / 100 * 70) + "px";
			this.init();
			this.load();
		}
		else if ($(".container#"+this.id).hasClass("minimized"))	this.restore();
		else this.del();
	}
		
	
	// Constructor Method
	this.init = function()	{
	
		if (!$(".container#"+this.id).length)
			$("body").append(
				"<div class='container' id='"+ id +
				"' style='left:"+ this.x +
				";top:"+ this.y +
				";height:"+ this.height +
				";width:"+ this.width +
				"'></div>"
			).find(".container#"+id)
			.draggable({
				cancel: '.content', 
				drag: function(){
					windows[this.id].x = $(this).css("left");
					windows[this.id].y = $(this).css("top");
				}
			})
			.resizable({
				resize: function(){
					windows[this.id].width = $(this).css("width");
					windows[this.id].height = $(this).css("height");
				}
			})
			.append("<div class='windowb' id='close'>X</div><div class='windowb' id='maximize'>[]</div><div class='windowb' id='minimize'>-</div><div class='content'><section></section></div>")
			.animate({opacity: 0.95}, 500)
			.find(".windowb").click( function(){
				windows[id].mod(
					$(this).attr('id'), 
					$(this).parent().attr('id')
				);});
				
	}
	
	
	
	//Deconstructor Method
	this.del = function()	{
		$(".container#"+this.id).animate({opacity: 0}, 500, 'linear', function()	{$(this).remove()});
	}
	
	
	//Window Action Controller
	this.mod = function(action){
	switch (action)	{
		case 'close'	:	this.del();	break;
		case 'maximize'	:	
			if (!$(".container#"+this.id).hasClass("maximized"))	this.maximize();
			else this.restore();	
		break;
		case 'minimize'	:
			if (!$(".container#"+this.id).hasClass("minimized") && !$(".container#"+this.id).hasClass("maximized"))	this.minimize();
			else if (!$(".container#"+this.id).hasClass("maximized")) this.restore();
		}
	}
	
	//Maximize Method
	this.maximize = function()	{
		$(".container#"+this.id).draggable('disable').addClass("maximized").animate({height: $(window).height(), width: $(window).width(), top: 0, left: 0}, 500);	
	}
	
	//Restore Method
	this.restore = function()	{
		$(".container#"+this.id).animate({height: this.height, width: this.width, top: this.y, left: this.x, opacity: 1}, 500).draggable('enable').removeClass("maximized").removeClass("minimized");
		$("footer li#"+this.id).animate({opacity: 0}, 500, 'linear', function()	{$(this).remove()});
	}
	
	//Minimize Method
	this.minimize = function()	{
		$("footer ul").append("<li id='"+this.id+"'>"+this.name+"</li>").find("li#"+this.id).animate({opacity: 1}, 500);
		$("footer li").click(function()	{
			windows[this.id].restore();
		});
		$(".container#"+this.id).animate({opacity: 0}, 500).addClass("minimized");
	}
	
	//Content Loading
	this.load = function(url, data)	{
		if (!url)	{
			if (this.id == 'admin')
				$(".container#"+this.id).find('section').css('background', "white")
					.load("/framework/admin/hub.php");
			else $(".container#"+this.id).find('section')
					.load("/framework/dispenser.php", {id: id});
		}
		else switch (url)	{
			case "admin":	alert(data); $(".container#"+this.id).find('section').css('background', "white").load("/framework/admin/login.php");
		}
	}
}


windows = new Array();

$(document).ready(function()	{
	$("header div").hide().parent().find("img").hover(function(){$(this).parent().find("div").css({display: 'block', opacity: 0}).animate({opacity: 1}, 500, 'linear');},function(){$(this).parent().find("div").animate({opacity: 0}, 500, 'linear', function(){$(this).hide()});});
	populate();	
});

function populate(){
	$.getJSON("/framework/php/populate.php", function(plugins){
		var content = "";
		$.each(plugins, function(i, plugin){
			if (plugin.haschildren == 1)	{
				content += "<li>"+plugin.name+"<ul>";			
				$.each(plugin, function(j, child){
					if (child.name)
						content += "<li id='"+plugin.index+"-"+child.index+"'>"+child.name;
						windows[plugin.index+"-"+child.index] = new Window(plugin.index+"-"+child.index, child.name);
				});
				content += "</ul>";
			}	else {
				content += "<li id='"+plugin.index+"'>"+plugin.name;
				windows[plugin.index] = new Window(plugin.index, plugin.name);
			}			
			content +=	"</li>";
		});
		$("nav ul").append(content).find("li").click(function() {
			if ($(this).find("ul").length)	$(this).find("ul:first").slideToggle(500);
			else windows[$(this).attr('id')].toggle();
		}).find("ul").hide();
	});
}
