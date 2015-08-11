H.ready(['jquery'],function(){
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

		//菜单活动
		var $filter = $(".m-raid-filter .filter-tg"),
			$filter_ct = $(".m-raid-filter .m-raid-filter-ct")

			$filter.on('click',function(){
				$filter_ct.fadeToggle()
			})

	})
})