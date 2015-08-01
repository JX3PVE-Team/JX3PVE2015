/*
* fixSidebar v0.2
* fix the sidebar when window scroll
* https://github.com/iRuxu
* update 2015.1.19
------------------------------------------------------*/
	//args:
	//sidebar name: #target 
	//[top value] : 100(top-margin-window)

	(function($){ 
		//定义
		function fixSidebar(selector,top){

			//无参数时返回空
			if(selector==undefined){return;}

			//传入元素不正确时
			if($(selector).length==0){return;}

			//获取相关尺寸与滚动发生距离
			$(window).scroll(function(){

				//获取尺寸
				var scrollHeight = $(window).scrollTop(),
					screenHeight = $(window).height(),
					sidebarHeight = $(selector).height();

				//水平坐标
				function getLeft(selector){ 
					var offset=selector.offsetLeft; 
					if(selector.offsetParent!=null) offset+=getLeft(selector.offsetParent); 
					return offset; 
				}
				var side_margin = getLeft($(selector)[0]);
				
				//垂直坐标
				var top_margin=0;
				if(sidebarHeight<screenHeight){
					if(top == undefined){
						top = 0;
					}else{
						top_margin = top;
					}
					if(scrollHeight>1){
						$(selector).css({
							'position':'fixed',
							'top':top_margin,
							'left':side_margin
						});
					}else{
						$(selector).css({
							'position':'static'
						});
					}
				}else{
					top_margin = -(sidebarHeight-screenHeight);
					if(scrollHeight+screenHeight>sidebarHeight){
						$(selector).css({
							'position':'fixed',
							'top':top_margin,
							'left':side_margin
						});
					}else{
						$(selector).css({
							'position':'static'
						});
					}
				}
			});
		}
		//触发事件
		window.onload = function(){
			$(window).trigger('scroll');
		}
		$(window).resize(function(){
			$(window).trigger('scroll');
		})

		window.fixSidebar = fixSidebar;

	})(jQuery);