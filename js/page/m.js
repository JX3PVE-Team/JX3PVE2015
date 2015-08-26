$(function(){

	var mySwiper = new Swiper ('.swiper-container', {
	    direction: 'horizontal',
	    loop: true,
	    pagination: '.swiper-pagination',
  	})   


	//unix时间戳格式化
  	function formatTime(selector,dividing){
		var $ = jQuery
		if(dividing == undefined) dividing='-'
		$(selector).each(function(){
			unixtime = $.trim($(this).text()),
			_time = new Date(parseInt(unixtime) * 1000),
			time = _time.getFullYear() + '-' + (_time.getMonth()+1) + '-' + _time.getDate(),
			arr = time.split('-')

			for (var i = 0; i < 3; i++) {
				if (arr[i] < 10 ) arr[i] = '0' + arr[i]
			}

			time = arr.join(dividing)
			$(this).text(time)
		})
	} 
	formatTime('.e-time');

	//单页头部菜单扩展
	$("#i-view-moretg").on('click',function(){
		$(this).children('ul').slideToggle()
	})

	//单页底部跳转
	var $body = $("body"),
		$w = $(window),
		$scroll = $("#i-scrolltop")
	$scroll.on('click',function(){
		var s = $w.scrollTop(),
			h = $body.height()	
		if(s<480){
			$w.scrollTop(h)
		}else{
			$w.scrollTop(0)
		}
	})
	$w.on('scroll',function(){
		var s = $w.scrollTop(),
			h = $body.height()	
		if(s<480){
			$scroll.removeClass('bot')
		}else{
			$scroll.addClass('bot')
		}
	})


	//单页附件查看UI
	var $html = $("html"),
		$attlayout = $("#i-attachshow"),
		$attbox = $("#i-attachshow-box"),
		$attlayout_tg = $("#i-attachshow-close"),
		$ct = $(".message"),
		$img = $(".message img")
	$img.on('click',function(){
		$html.addClass('attachfix')
		$attlayout.show()
		$(this).clone(false).appendTo($attbox)
	})
	$attlayout_tg.on('click',function(){
		$html.removeClass('attachfix')
		$attlayout.hide()
	})






});