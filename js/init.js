//加载公共模块
H.load([
	{'jquery':head_conf.CDNROOT+'lib/jquery-1-10-2.js'},
	{'underscore':head_conf.CDNROOT+'lib/underscore.js'},
	{'responsive':head_conf.CDNROOT+'plugin/responsive.js'},
	{'getRequest':head_conf.CDNROOT+'plugin/getRequest.js'},
	{'macro':head_conf.CDNROOT+'plugin/Macro.js'},
	{'fixSidebar':head_conf.CDNROOT+'plugin/fixSidebar.js'},
	{'treeview':head_conf.CDNROOT+'plugin/jquery.treeview.js'},
	{'cookie':head_conf.CDNROOT+'plugin/jquery.cookie.js'},
	{'swiper':head_conf.CDNROOT+'plugin/swiper2.min.js'},
	{'footer':head_conf.CDNROOT+'mod/footer.js'},
	{'dialog':head_conf.CDNROOT+'mod/dialog.js'},
	{'postdate':head_conf.CDNROOT+'mod/postdate.js'},
	{'oldfb':head_conf.CDNROOT+'mod/oldfb.js'},
	{'custombg':head_conf.CDNROOT+'mod/custombg.js'},
	{'header':head_conf.ROOT+'mod/header.js'},
	{'bbs':head_conf.CDNROOT+'mod/bbs.js'},
	{'widget':head_conf.ROOT+'mod/widget.js'}
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
			},400)
		})
	}

	//route助手
	H.route = function(helpID,joinID){
		var $routeHelp = jQuery('#w-route-help'),
			$routeJoin = jQuery('#w-route-join')
		$routeHelp.attr('href','http://www.jx3pve.com/misc.php?mod=faq&action=faq&id='+helpID)
	}

	//unix时间戳转换
	H.time = function(selector,dividing){
		var $ = jQuery
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

	jQuery(function($){
		//时间转化
		H.time('.e-time');

		//用户组判断
		var group = $("#c-header-usergroup").text()
		//管理员（操作工具条）
		if(group.indexOf('管理员')!=-1 || group.indexOf('版主')!=-1 || group.indexOf('编辑')!=-1){
			$('html').addClass('adminHTML')
		}
		//VIP专属
		if(group.indexOf('VIP会员')!=-1){
			$('html').addClass('vipHTML')
		}
		//LV7~LV9，管理员，VIP会员
		var SPGROUP = ['管理员','版主','编辑','VIP会员','LV.7果子狸','LV.8果子狸','LV.9果子狸'],
			isSP = false
		function checkSP(){
			for (var i=0;i<SPGROUP.length;i++){
				isSP = isSP || group.indexOf(SPGROUP[i]) !=-1
			}
		}
		checkSP()
		if(isSP) $('html').addClass('spHTML')

	})
})