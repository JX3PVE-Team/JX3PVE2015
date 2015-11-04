H.ready(['jquery','macro','fixSidebar'],function(){
	jQuery(function($){
        /**
          Author: [huyinghuan](xiacijian@163.com)
          Date: 2015.11.03
          Desc: 修改高亮部位初始化DOM逻辑， 从基于ID变为基于class
        
          Author: [huyinghuan](xiacijian@163.com)
          Date: 2015.11.04
          Desc: 修复IE8下代码高亮问题
        **/
		//定义所有需要高亮的数据所在的DOM的class
        var needHighlightDOMClass = "macro-ct";
        var needVipTips = '<a class="u-tobevip" href="http://www.jx3pve.com/vip" target="_blank">本帖隐藏内容需<b>回复可见</b>，加入 <i class="u-vip">VIP会员</i> 享受无需回复查看隐藏内容、无限制下载、免广告极速等多项特权。</a>';
      
        //宏语法高亮
        $("." + needHighlightDOMClass).each(function(){
          
          var content = this.textContent || this.innerText
          content = $.trim(content);
          if(content.indexOf('回复可见') === -1){
            new Macro(this, content);
          }else{
            $(this).html(needVipTips);
          }
        });

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
    	/*var pstatus = $(".pstatus").text(),
	    	str_p = pstatus.search(/\u4e8e\s./),
	    	str = pstatus.slice(str_p+1,str_p+11),
	    	$pstatus_box = $("#u-post-lastupdate")

    	$pstatus_box.text(str)*/
    	var $lastedit = $("#u-post-lastupdate")
    	$lastedit.text($('.c-fli-first .lastedit .e-time').text())

    	//导航栏激活
		H.curpage('.u-macro')

    	//侧边栏
		H.fixSidebar('.pve-sidebar',96,105,100)
    	
    	//帮助
    	H.route(53)

	})
})