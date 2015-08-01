H.ready(['jquery','macro','fixSidebar'],function(){
	jQuery(function($){

		
    	//宏语法高亮
    	var $databox_s = $('#macro-ct1'),
    		$databox_f = $('#macro-ct2'),
			data_s = $.trim($databox_s.text()),
			data_f = $.trim($databox_f.text())

		if(data_s.indexOf('回复可见') == -1){
			new Macro("#macro-ct1",data_s)
		}else{
			$databox_s.html('<a class="u-tobevip" href="http://www.jx3pve.com/home.php?mod=spacecp&ac=usergroup&do=list">本帖隐藏内容需回复可见，加入 <i class="u-vip"></i>VIP会员 享受无需回复查看隐藏内容、无限制下载、免广告极速等多项特权。</a>')
		}
		if(data_f.indexOf('回复可见') == -1){
			new Macro("#macro-ct2",data_f)
		}
		else{
			$databox_f.html('<a class="u-tobevip" href="http://www.jx3pve.com/home.php?mod=spacecp&ac=usergroup&do=list">本帖隐藏内容需回复可见，加入 <i class="u-vip"></i>VIP会员 享受无需回复查看隐藏内容、无限制下载、免广告极速等多项特权。</a>')
		}
		

		//辅助工具
		var $toolbox = $('#macro_tools'),
			toollink = Boolean($toolbox.attr('href'))
		if(!toollink){
			$toolbox.attr('href','http://www.jx3pve.com/jx3/tools/keypress/')
		}


		//非必填字段为空隐藏
		$('.role-info').each(function(i,item){
			if($(this).children('.content').length!=0){
				var block_l_temp = $(this).children('.content').text(),
					block_l = $.trim(block_l_temp)
				if(!block_l){
					$(this).hide();
				}
			}
		})

		//自动添加最后更新时间
    	var pstatus = $(".pstatus").text(),
	    	str_p = pstatus.search(/\u4e8e\s./),
	    	str = pstatus.slice(str_p+1,str_p+11),
	    	$pstatus_box = $("#u-post-lastupdate")

    	$pstatus_box.text(str)

    	//导航栏激活
		H.curpage('.u-macro')

    	//侧边栏
		fixSidebar('.pve-sidebar',96,96,100)
    	
    	
	})
})