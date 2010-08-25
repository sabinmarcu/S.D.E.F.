function Window(id, parent, name)	{
	this.id = id;
	this.name = name;
	this.parent = parent;

	//	Construct / Destruct Handler
	this.toggle = function()	{	
		if (!$(".container#"+this.id).length)	{
			this.y = '100px';
			this.x = ($(window).width() - 600) / 2 +"px";
			this.width = '600px';	
			this.height = ($(window).height() / 100 * 70) + "px";
			this.preload();
			this.init();
			this.loadc();
		}
		else if ($(".container#"+this.id).hasClass("minimized"))	this.restore();
		else this.del();
	}
		
	
	// Constructor Method
	this.init = function()	{
	
		if (!$(".container#"+this.id).length)
			$("body").append(
				"<div class='container "+this.parent+"' id='"+ id +
				"' style='left:"+ this.x +
				";top:"+ this.y +
				";height:"+ this.height +
				";width:"+ this.width +
				"'></div>"
			).find(".container#"+id)
			.draggable({
				cancel: '.content', 
				drag: function(){
					application[this.id].x = $(this).css("left");
					application[this.id].y = $(this).css("top");
				}
			})
			.resizable({
				resize: function(){
					application[this.id].width = $(this).css("width");
					application[this.id].height = $(this).css("height");
				}
			})
			.append("<div class='windowb' id='close'>X</div><div class='windowb' id='maximize'>[]</div><div class='windowb' id='minimize'>-</div><div class='content'><section></section></div>")
			.animate({opacity: 0.95}, 'fast')
			.find(".windowb").click( function(){
				application[id].mod(
					$(this).attr('id'), 
					$(this).parent().attr('id')
				);});
	}
	
	
	
	//Deconstructor Method
	this.del = function()	{
		$(".container#"+this.id).animate({opacity: 0}, 'fast', 'linear', function()	{$(this).remove()});
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
		$(".container#"+this.id).draggable('disable').addClass("maximized").animate({height: $(window).height(), width: $(window).width(), top: 0, left: 0}, 'slow');	
	}
	
	//Restore Method
	this.restore = function()	{
		$(".container#"+this.id).animate({height: this.height, width: this.width, top: this.y, left: this.x, opacity: 1}, 'fast').draggable('enable').removeClass("maximized").removeClass("minimized");
		$("footer li#"+this.id).animate({opacity: 0}, 'fast', 'linear', function()	{$(this).remove()});
	}
	
	//Minimize Method
	this.minimize = function()	{
		$("footer ul").append("<li id='"+this.id+"'>"+this.name+"</li>").find("li#"+this.id).animate({opacity: 1}, 'fast');
		$("footer li").click(function()	{
			application[this.id].restore();
		});
		$(".container#"+this.id).animate({opacity: 0}, 'fast', 'linear', function(){$(this).addClass("minimized")});
	}
	
	//Content Loading
	this.loadc = function(url, data)	{
		var id = this.id;
		var parent = this.parent;
		if (parent && parent != "admin")
	 		$(".container#"+id).find('section')
				.load("/framework/dispenser.php", {id: parent, child: id}, function(){application[id].postload()});
		else if (parent) 
			 $(".container#"+id).find('section')
				.load("/framework/dispenser.php", {id: id, child: parent}, function(){application[id].postload()});
		else $(".container#"+id).find('section')
				.load("/framework/dispenser.php", {id: id}, function(){application[id].postload()});
	}
	
	//Customizable Functions
	this.postload = function()	{}
	this.preload = function()	{}
}
