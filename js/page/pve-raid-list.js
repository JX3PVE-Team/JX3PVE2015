H.ready(['jquery','getRequest'],function(){
	jQuery(function($){

		//条件筛选·服务器
		var $fwq_s = $("#raid_fuwuqi_select"),
			$fwq_l = $("#raid-fuwuqi-list"),
			$fwq_tips = $("#raid-fuwuqi-tips")
		$fwq_s.on('change',function(){
			var fwq = parseInt($(this).val())
			$fwq_l.children('ul').hide().eq(fwq).show()
		})
		$fwq_s.one('change',function(){
			$fwq_tips.fadeIn()
		})

		//条件筛选·其他条件
		/*var raidnature = getRequest('raidnature'),
			raidsex = getRequest('raidsex'),
			raidtime = getRequest('raidtime'),
			raidtimefull = getRequest('raidtimefull'),
			raidcondition = [raidnature,raidsex,raidtime,raidtimefull]
		
		$.each(raidcondition,function(i,value){
			value=='all' ? 0 : parseInt(value)
		})*/

		//捷报团长链接
		var $jblist = $("#m-raid-jiebao .team")
		$jblist.each(function(i){
			var url = $(this).attr('href')
			if(!url){
				$(this).attr('href','http://www.jx3pve.com/raid')
			}
		})

		//条件筛选
		var $filter_t = $("#w-filter-tg"),
			$filter = $("#w-filter")

			$filter_t.on('click',function(){
				if(!$filter.length){
					alert('请切换到具体分类下才能进行筛选或该类型下没有可筛选条件:)')
				}else{
					$filter.toggleClass('open');
					$filter_t.toggleClass('on');
				}
			})

		//隐藏已过期的数据
		var $list = $(".m-raid-list li").add('.m-raid-bizlist li')
		$list.each(function(){
			var failtime = $(this).find('.failtime').text()
			if(failtime){
				var d = (new Date(failtime.replace(/-/g, "/"))).getTime(),
					n = (new Date()).getTime()
				if(d < n){
					$(this).hide()
				}
			}
		})

	})
})

