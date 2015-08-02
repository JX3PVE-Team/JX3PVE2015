H.ready(['jquery', 'fixSidebar','treeview'], function() {
	jQuery(function($) {

		//树形菜单
		$("#jx3pve-map").treeview();

		//导航栏激活
		H.curpage('.u-bbs')

		//侧边栏
		H.fixSidebar('.pve-sidebar', 110, 105, 100)

	})
})