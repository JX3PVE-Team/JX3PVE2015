H.ready(['jquery','dialog','fixSidebar'],function(){
	jQuery(function($){

		//下载地址写入
		$('.down_url').each(function(i,item){
			var url_data = $.trim($(this).text())
			if(url_data == ''){
				//地址未填 ==> 0
				$('.tool-down').eq(i).attr('href',0);
			}else if( url_data.indexOf('回复可见') != -1){
				//需回复可见 ==> 1
				$('.tool-down').eq(i).attr('href',1);
			}else{
				//正常下载地址
				$('.tool-down').eq(i).attr('href',url_data);
			}
		})

		//下载事件绑定
		$('.tool-down').on('click',function(e){
			var url = $(this).attr('href');
			if(url==0){
				//提示未填写
				e.preventDefault();
				loadDialog('string','抱歉，作者太懒了，没有填写此条快速下载地址！请在文中寻找。^^');
			}else if(url==1){
				//显示需回复可见
				e.preventDefault();
				loadDialog('download')
			}else{
				//打开方式
				var url_to = $(this).is('a[href^="http://www.jx3pve.com"]');
				if(url_to){
					//站内地址
					$(this).attr('target','_self');
				}
			}
		})

		//下载次数
		var down_count = $("#postlist table:first").find('.pls').children('.hm').find('.xi1').eq(0).text()
		$("#tool-down-count").text(down_count)


		//非必填字段为空隐藏
		$('.tool-check-info').each(function(i,item){
			if($(this).children('.content').length!=0){
				var block_l_temp = $(this).children('.content').text(),
					block_l = $.trim(block_l_temp)
				if(!block_l){
					$(this).hide();
				}
			}
		})

		//自动添加最后更新时间
    	/*var pstatus = $(".pstatus").text(),
	    	str_p = pstatus.search(/\u4e8e\s./),
	    	str = pstatus.slice(str_p+1,str_p+11),
	    	$pstatus_box = $("#u-post-lastupdate")
    	$pstatus_box.text(str)*/
    	var $lastedit = $("#u-post-lastupdate")
    	$lastedit.text($('.c-fli-first .lastedit .e-time').text())


    	//导航栏激活
		H.curpage('.u-tool')

		//侧边栏
		H.fixSidebar('.pve-sidebar',96,105,100)

		//帮助
    	H.route(54)



	})
})