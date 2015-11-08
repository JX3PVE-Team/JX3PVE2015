/*
* fixSidebar v0.4
* fix the sidebar when window scroll
* https://github.com/iRuxu
* update 2015.7.12
------------------------------------------------------*/
//args:
//selector: #target 
//top + bottom: margin to window for fix header or footer
//triggerScroll : while scroll distance bigger than this and trigger the fix state
//(function($){ 

H.ready(['jquery'], function(){
		
	//定义
	function fixSidebar(selector, top, bottom, triggerScroll) {

		var $ = jQuery;

		//移动端不触发
		if(!$("html").hasClass('no-mobile')) return

		//当内容高度需要高于窗口实际高度较多时才执行函数
		if ($("body").height() < $(window).height()) return

		//无参数时返回空
		if (selector == undefined) return

		//传入元素不正确时
		if ($(selector).length == 0) return

		//参数定义检测
		if (top == undefined) top = 0
		if (bottom == undefined) bottom = 0
		if (triggerScroll == undefined) triggerScroll = 20

		//获取相关尺寸与滚动发生距离
		$(window).scroll(function() {
			
			//定义获取水平坐标函数
			function getLeft(selector) {
				var offset = selector.offsetLeft;
				if (selector.offsetParent != null) offset += getLeft(selector.offsetParent);
				return offset;
			}

			//获取尺寸
			var scroll = $(window).scrollTop(), //滚动数值
				screen_H = $(window).height(), //屏幕高度
				bar_H = $(selector).height(), //侧边栏高度
				ct_H = screen_H - top - bottom, //可视内容区高度（除去网站的fix头与底）
				bar_X = getLeft($(selector)[0]), //侧边栏的水平位置
				bar_Y = 0; //初始化侧边栏距顶

			//设置恢复定位
			function ActionPS() {
				$(selector).css('position', 'static').removeClass('fixSidebar')
			}

			//当侧边栏高度小于可视区高度时，则以侧边栏顶部顶住上方
			if (bar_H < ct_H) {
				//设置侧边栏距顶为fix头的高度
				bar_Y = top
				//当滚动值
				if (scroll > triggerScroll) {
					$(selector).css({
						'position': 'fixed',
						'left': bar_X,
						'top': bar_Y
					}).addClass('fixSidebar')
				} else {
					ActionPS()
				}
				//当侧边栏高度大于内容区时，则要以底部抵住下方为参考
			} else {
				//设置侧边栏距底为底部通栏的高度
				bar_Y = bottom
				if (scroll > bar_H - ct_H && scroll > triggerScroll) {
					$(selector).css({
						'position': 'fixed',
						'left': bar_X,
						'bottom': bar_Y
					}).addClass('fixSidebar')
				} else {
					ActionPS()
				}
			}
		});
	}

	H.fixSidebar = fixSidebar;

	//触发事件
	window.onload = function() {
		jQuery(window).trigger('scroll');
	}
	jQuery(window).resize(function() {
		jQuery(window).trigger('scroll');
	})

})
//})(jQuery);