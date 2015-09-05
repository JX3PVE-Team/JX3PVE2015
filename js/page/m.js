$(function(){

	//首页swiper
	var mySwiper = new Swiper ('.swiper-container', {
	    direction: 'horizontal',
	    loop: true,
	    pagination: '.swiper-pagination',
  	})

  	//头部菜单扩展
	var $menu_t = $("#i-header-more"),
		$menu = $("#i-header-extend")
	$menu_t.on('click',function(){
		$menu.slideToggle()
	})

	//个人中心面板
	var $os_t = $("#i-header-os"),
		$os = $("#i-sidebar"),
		$mask = $("#u-mask")
	$os_t.add($mask).on('click',function(){
		$mask.toggle()
		$os.toggleClass('show')
	})


	//unix时间戳格式化
  	function formatTime(selector,dividing){
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


	//w_weibo:新浪微博
	//当未填写微博UID时，隐藏关注按钮
	var $wb_win = $("#w-weibo-win"),
		$wb = $("#w-weibo")
	if($wb.length){
		if(!$wb.text()) $wb_win.remove()
	} 

	//宏库
	$(".macro-ct").each(function(){
		var text = $(this).html()
		text = text.replace('[hide]','')
		text = text.replace('[/hide]','')
		$(this).html(text)
	})

	//茶馆
	var $bookdown = $(".bookdown"),
		$isdown = $("#isdownload")
	if($isdown.text() == '否'){
		$bookdown.hide()
	}




});