H.ready(['jquery'], function(){
    jQuery(function($){

		var
    	$tg = $("#w-route-bztg"),
    	$box = $("#w-route-bzbox"),
    	t

    	$tg.add($box).hover(function(){
    		t && clearTimeout(t)
    		$box.show()
            $tg.addClass('on')
    	},function(){
            $tg.removeClass('on')
    		t && clearTimeout(t)
    		t = setTimeout(function(){
    			$box.hide()
    		},200)
    	})
        
    })
})