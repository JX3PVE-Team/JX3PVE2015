H.ready(['jquery'], function(){
    jQuery(function($){

    	var $wx_tg = $("#c-float-wx-tg"),
    		$wx_img = $("#c-float-wx-code"),
    		$gotop = $("#c-float-gotop"),
            $close = $("#c-float-close"),
            $fwin = $("#c-float-help")

    	//浮层·微信
    	$wx_tg.hover(function(){
    		$wx_img.fadeIn()
    	},function(){
    		$wx_img.fadeOut()
    	})

    	//浮层·回到顶部
    	$gotop.on('click',function(){
    		$(window).scrollTop(0)
    	})

        //浮层·关闭
        $close.on('click',function(){
            $fwin.hide()
        })

    })
})
