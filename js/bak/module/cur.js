/*
* Current Animation v0.1
* https://github.com/iRuxu
* update 2015.1.16
------------------------------------------------------*/
	//arg==null -> self
	//arg!=null -> self + childrenselector[just children]
	(function($){ 
		$.fn.extend({ 
			'cur':function(childrenselector){
				if(childrenselector==undefined){
					this.hover(
					function() {
						$(this).addClass('cur');
					}, function() {
						$(this).removeClass('cur');
					});
				}else{
					this.hover(
					function() {
						$(this).addClass('cur').children(childrenselector).addClass('cur');
					}, function() {
						$(this).removeClass('cur').children(childrenselector).removeClass('cur');
					});
				}
				return this;
			} 
		}) 
	})(jQuery);