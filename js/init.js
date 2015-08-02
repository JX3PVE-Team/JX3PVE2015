//加载公共模块
H.load([
	{'jquery':head_conf.CDNROOT+'lib/jquery-1-10-2.js'},
	{'responsive':head_conf.CDNROOT+'plugin/responsive.js'},
	{'getRequest':head_conf.CDNROOT+'plugin/getRequest.js'},
	{'macro':head_conf.CDNROOT+'plugin/Macro.js'},
	{'fixSidebar':head_conf.CDNROOT+'plugin/fixSidebar.js'},
	{'treeview':head_conf.CDNROOT+'plugin/jquery.treeview.js'},
	{'cookie':head_conf.CDNROOT+'plugin/jquery.cookie.js'},
	{'tgbanzhu':head_conf.CDNROOT+'mod/tgbanzhu.js'},
	{'tgpost':head_conf.CDNROOT+'mod/tgpost.js'},
	{'header':head_conf.ROOT+'mod/header.js'},
	{'footer':head_conf.ROOT+'mod/footer.js'},
	{'dialog':head_conf.ROOT+'mod/dialog.js'},
	{'postdate':head_conf.ROOT+'mod/postdate.js'},
	{'oldfb':head_conf.ROOT+'mod/oldfb.js'},
	{'bbs':head_conf.ROOT+'mod/bbs.js'}
])

//全局设置
H.ready('jquery',function(){
	jQuery.noConflict();

	//当前页
	H.curpage = function(cur){
		jQuery('#c-header-nav').children(cur).addClass('on')
	}

	//开关
	H.fadeshow = function(tg,ele){
		var $ = jQuery,
			t
		$(tg).add(ele).hover(function(){
			t && clearTimeout(t)
			$(ele).fadeIn()
		},function(){
			t = setTimeout(function(){
				$(ele).fadeOut()
			},200)
		})
	}










	jQuery(function($){
		//document ready 
	})
})