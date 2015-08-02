H.ready(['jquery', 'fixSidebar'], function() {
	jQuery(function($) {

		
		var
			$tg = $("#m-fam-more"),
			$box = $("#m-fam-ztbox-all")
			$link = $("#e-fam-primary-raid-link")

		//顶部折叠
		$tg.on('click', function() {
			if ($box.hasClass('folder')) {
				$tg.children('i').text('-')
				$tg.children('em').text('折叠')
			} else {
				$tg.children('i').text('+')
				$tg.children('em').text('展开')
			}
			$box.toggleClass('folder').fadeToggle();
		})

		//团队招募未填写处理
		$link.on('click',function(e){
			if(!$(this).attr('href')){
				e.preventDefault()
				loadDialog('string','作者暂未填写')
			}
		})

		//导航栏激活
		H.curpage('.u-fam')

		//侧边栏
		H.fixSidebar('.pve-sidebar', 96, 96, 100)

	})
})