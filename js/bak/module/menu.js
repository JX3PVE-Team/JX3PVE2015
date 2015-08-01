/*
* Menu v0.1
* $wrap > li > ul > li
* https://github.com/iRuxu
* update 2015.1.16
------------------------------------------------------*/
	//arg : delay time
	(function($){ 
		$.fn.extend({ 
			'menu':function(delay){
				var wrap = this;
				if(delay == undefined) delay = 0;
				wrap.children('li').hover(
				function() {
					var self = $(this);
					var mousein = setTimeout(function(){
						wrap.find('ul').hide();
						self.children('ul').slideDown();
						mousein = null;
					},delay);
				}, function() {
					var self = $(this);
					var mouseout = setTimeout(function(){
						self.children('ul').slideUp();
						mouseout = null;
					},delay);
				});
				return this;
			} 
		}) 
	})(jQuery);