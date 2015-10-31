H.ready(['jquery','swiper'],function(){
	jQuery(function($){

		var mySwiper = new Swiper('.swiper-container',{
			direction: 'horizontal',
	    	loop: true,
	    	effect: 'fade',
	    	pagination: '.swiper-pagination',
	    	paginationClickable: true,
	    	autoplay: 5000,
	    	autoplayDisableOnInteraction : false
		}); 

		var $slider = $("#jx3pve-slider"),
			$imglist = $("#jx3pve-slider-imglist"),
			$img = $("#jx3pve-slider-imglist li"),
			$txtlist = $("#jx3pve-slider-txtlist"),
			$txt = $("#jx3pve-slider-txtlist li"),
			len = $txt.length

		//事件绑定
		$txt.on('mouseenter',$txtlist,function(){
			var index = $(this).index()
			$txt.removeClass('on')
			$(this).addClass('on')
			$img.removeClass('on').eq(index).addClass('on')
			clearInterval(sliderTG)
		})

		//自动连播
		var _cur = 0
		function autoSlider(){
			$txt.removeClass('on').eq(_cur).addClass('on')
			$img.removeClass('on').eq(_cur).addClass('on')
			if(_cur == len-1){
				_cur = 0
			}else{
				_cur++
			}
		}
		autoSlider()
		var sliderTG = setInterval(autoSlider,3800)
	})
})