H.ready(['jquery'], function(){
    jQuery(function($){

    	var $body = $("body"),
            $html = $("html"),
            $wb_win = $("#w-weibo-win"),
    		$wb = $("#w-weibo"),
    		$magic_t = $(".w-magic-tg"),
    		$magic = $(".w-magic"),
            $route_t = $("#w-route-bztg"),
            $route = $("#w-route-bzbox"),
            $star = $(".w-hotstar"),
            $index_tg = $("#w-index-tg"),
            $index = $("#w-index-list"),
            $filter = $("#w-filter .w-filter-font .item .label"),
            $filter_tg = $("#w-filter-tg"),
            $imgorigin = $(".u-imgorigin"),
            $mask = $("#u-mask")
            

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

        //w_route:导航
        //版主开关
        H.fadeshow($route_t,$route)

        //w_hotstart
        //热度加星
        $star.each(function(){
            var num = parseInt($(this).text())
            if(num>1000){
                $(this).addClass('w-hotstar-5')
            }else if(num>500){
                $(this).addClass('w-hotstar-4')
            }else if(num>200){
                $(this).addClass('w-hotstar-3')
            }else if(num>100){
                $(this).addClass('w-hotstar-2')
            }else{
                $(this).addClass('w-hotstar-1')
            }
        })

        //w-index 
        //分类专栏有自定义首页时打开原帖开关
        $index_tg.on('click',function(){
            $index.toggle()
            if($index.css('display')=='none'){
                $(this).removeClass('on').find('em').text('展开')
            }else{
                $(this).addClass('on').find('em').text('折叠')
            }
        })

        //w-filter
        //分类信息字段筛选扩展
        $filter.each(function(){
            var $label = $(this),
                $value = $(this).next('.value')
            $label.on('click',function(){
                $label.toggleClass('on');
                $value.slideToggle()
            })
        })
        $filter_tg.on('click',function(){
            alert('请点击下方筛选条件之一进行展开与关闭')
        })

        //查看脸型原图 imgorigin
        $imgorigin.on('click',function(){
            var img = $(this).find('img'),
                src = img.attr('src')
            if(src && src.indexOf('nophoto')==-1){
                $mask.show()
                $html.addClass('fixpage')
                $body.append('<img class="u-imgorigin-fix" src="'+ src + '"/>')
                var _img = $(".u-imgorigin-fix"),
                    w = parseInt(_img.width())/2,
                    h = parseInt(_img.height())/2
                    _img.css('margin-left',-w)
                        .css('margin-top',-h)
            }
        })
        //脸型原图
        $mask.on('click',function(){
            var $imgoriginfix = $(".u-imgorigin-fix")
            $mask.hide()
            $imgoriginfix.remove()
            $html.removeClass('fixpage')
        })

    })
})