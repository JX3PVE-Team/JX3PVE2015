H.ready(['jquery'], function(){
    jQuery(function($){

		//微信浮层开关
		H.fadeshow('#c-header-wxtg','#c-header-wx')

		//os面板开关
		$("#c-header-username").on('mouseenter',function(){
			$("#myprompt_menu").hide()
		})
		H.fadeshow('#c-header-username','#c-header-os')

		//用户组判断
		var $group = $("#c-header-usergroup")
		$group.text().indexOf('VIP')!=-1 ?	$group.addClass('vip') : $group.removeClass('vip')

		//签到
		var $qiandao_trigger = $(".user-qiandao")
    	$qiandao_trigger.on('click',function(){
    		var btn_qiandao = $(this)
    		var t = setTimeout(function(){
    			btn_qiandao.hide()
    		},200)
    	})

		//百度搜索文字隐藏
		var $bd_search = $('#bdcs')
		$bd_search.find('#bdcs-search-form-submit').val('');

		//漂浮菜单
		var $fmenu = $("#c-header-fmenu"),
			$w = $(window),
			scroll = 0
		$w.on('scroll',function(){
			scroll = $w.scrollTop()
			if(scroll > 100){
				$fmenu.fadeIn()
			}else{
				$fmenu.fadeOut()
			}
		})

    })
})