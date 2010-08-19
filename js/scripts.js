$(document).ready(function()	{
	$(".tooltip").click(function() {
	if ($(this).attr("id") != 'menu')	{
		if (!$(".overlay").length)
			getframe($(this).attr('id'));
		else 
			removeframe();
	}
	else if ($(this).attr("id") == 'menu')
		switchaside();
	});	
	$("aside").css("top", $(window).height());
	
	
	
	$("nav ul").find("ul").hide();
	$("nav li").live('click', function()	{
		if ($(this).find("ul").length)	
			$("nav#sec").html("<div id='refresh'>" + $(this).find("ul:first").html() + "</div>").find("#refresh").animate({opacity: 1}, 500);
});
	
	
	
	
	
	
	
});

function getframe(id)	{
		$("body").append("<div class='overlay'></div><div class='overlayc'><div class='infot'></div><div class='infoc'></div></div>");
		$(".overlay").animate({opacity: 0.9}, 1000).click(function() {removeframe()});
		$(".overlayc").animate({opacity: 1}, 1000);
		switch (id)	{
			case 'confused' :
				$(".infot").html("Confused about this site's structure?");
				$(".infoc").html("We'll sort that out right now ...");
				break;
			case 'author' :
				$(".infot").html("About the author");
				$(".infoc").html("Bla, Bla, Bla ... img ...");
				break;	
		}
}

function removeframe()	{
	$(".overlay, .overlayc").animate({opacity: 0}, 1000, 'linear', function() {$(this).remove()});
}

function switchaside() 	{
	if ($("aside").css("top") == '0px')	{$("aside").animate({top: $(window).height()}, 1000)}
	else $("aside").animate({top: 0}, 1000);
}
