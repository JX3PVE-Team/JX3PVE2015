H.ready(['jquery'], function(){
    jQuery(function($){

		//微信浮层开关
		$("#c-header-wxtg").on('click',function(){
			$("#c-header-wx").slideToggle()
		})

		//os面板开关
		$("#c-header-username").on('click',function(e){
			e.preventDefault()
			$(this).toggleClass('on')
			$("#c-header-os").toggle();
		})
		//H.fadeshow('#c-header-username','#c-header-os')

		//vip图标
		/*var $group = $("#c-header-usergroup"),
		group = $("#c-header-usergroup").text()
		$group.text().indexOf('VIP')!=-1 ?	$group.addClass('vip') : $group.removeClass('vip')*/

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