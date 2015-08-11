H.ready(['jquery', 'fixSidebar','treeview'], function() {
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
		if(!$link.attr('href')){
			$link.attr('href','http://www.jx3pve.com/raid')
		} 

		//捷报发布页面处理
		if(getRequest('action')=='newthread' && getRequest('sortid')=='12' && getRequest('fid')=='369'){
			$("#e_body").addClass('noedit')
			$("#c-editor-extend").hide()
		}

		//导航栏激活
		H.curpage('.u-fam')

		//侧边栏
		H.fixSidebar('.pve-sidebar', 96, 105, 100)

		//树形菜单
		$("#fam-map").treeview();

		//帮助
    	H.route(55)

	})
})