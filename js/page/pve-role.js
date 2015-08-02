H.ready(['jquery','fixSidebar'],function(){
    jQuery(function($){

    	//折叠开关
    	var $tg = $("#pve-primary-tg"),
    		$ct = $("#pve-primary-ct")

    	$tg.on('click',function(){
    		if($tg.hasClass('on')){
    			$ct.slideDown()
    			$tg.removeClass('on')
    			  .children('i').text('-')
    			$tg.children('em').text('折叠')
    		}else{
    			$ct.slideUp()
    			$tg.addClass('on')
    			  .children('i').text('+')
    			$tg.children('em').text('展开')
    		}
    		
    	})

    	//关键词关联
    	//取出当前主题分类职业id，起始335
    	var role = Number(getRequest('typeid')),
    		$sdbox = $(".authorbox"),
    		$ctbox = $(".listbox"),
    		$libox = null,
    		$key = $("#pve-primary-key li"),
            sp = true,
    		//对应排序
    		arr = {
    			0:0,
    			335:1,
    			336:2,
    			337:3,
    			338:4,
    			339:5,
    			340:6,
    			341:7,
    			342:8,
    			343:9,
    			344:10,
    			345:11,
    			346:12
    		},
            //排序
            order = arr[role]


    	//1.显示对应职业的侧边栏box
    	$sdbox.hide().eq(order).show()
    	//2.显示对应职业的帖子box
    	$ctbox.hide().eq(order).show()
    	//3.设定libox为当前职业的box
    	//$libox = $ctbox.eq(order).children('.list')
        //4.当为第一个和最后一个特殊时，添加禁用样式
        //sp = order==0 || order==12
        //if(sp) $(".key").hide()
    	//5.点击关键词时，显示该职业下对应的关键词子块，特殊ID禁用
    	/*$key.on('click',function(){
            if(sp) {return;}
    		var curindex = $(this).index()
    		$libox.hide().eq(curindex).show()
    	})*/

        //导航栏激活
        H.curpage('.u-role')

        //侧边栏
        H.fixSidebar('.pve-sidebar',96,105,100)

    });
});