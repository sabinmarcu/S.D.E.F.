	$("header div").hide().parent().find("img").hover(function(){$(this).parent().find("div").css({display: 'block', opacity: 0}).animate({opacity: 1}, 500, 'linear');},function(){$(this).parent().find("div").animate({opacity: 0}, 500, 'linear', function(){$(this).hide()});});
	
	