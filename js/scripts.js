$(document).ready(function()	{
	$("header div").hide().parent().find("img").hover(function(){$(this).parent().find("div").css({display: 'block', opacity: 0}).animate({opacity: 1}, 500, 'linear');},function(){$(this).parent().find("div").animate({opacity: 0}, 500, 'linear', function(){$(this).hide()});});
	$("nav li").click(function() {
		var id = $(this).attr('id');
		if (!$(".container#"+id).length)
		$("body").append("<div class='container' id='"+id+"'></div>").find(".container#"+id).draggable().resizable().animate({opacity: 1}, 500).load(id+".html");
		else $(".container#"+id).animate({opacity: 0}, 500, 'linear', function()	{$(this).remove()});
	});
	
});

