H.ready(['jquery'], function(){
    jQuery(function($){

    	var $wb_win = $("#w-weibo-win"),
    		$wb = $("#w-weibo"),
    		$magic_t = $(".w-magic-tg"),
    		$magic = $(".w-magic")


    	//w_weibo:新浪微博
    	//当未填写微博UID时，隐藏关注按钮
    	if($wb.length){
    		if(!$wb.text()) $wb_win.remove()
    	} 

    	//w_magic:道具
    	//扩展栏开关
    	$magic_t.add($magic).on('mouseenter',function(){
    		$magic.show()
    	})
    	
    	$magic.on('mouseleave',function(){
    		setTimeout(function(){
    			$magic.hide()
    		},500)
    	})


    })
})