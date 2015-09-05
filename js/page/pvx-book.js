H.ready(['jquery','getRequest'],function(){
	jQuery(function($){

		var $sidebar_tg = $("#pvx-sidebar-tg"),
			$tgtext = $sidebar_tg.find('em')
			$main = $(".pvx-main"),
			$bookdown = $(".bookdown"),
			$isdown = $("#isdownload")

		//导航栏激活
		H.curpage('.u-book')

		//route助手
		H.route(119)

		//角标遍历
		$(".book").each(function(){
			//角标验证
			var isDST = parseInt($(this).find('.digest').text()) > 0,
				isHOT = parseInt($(this).find('.views').text()) > 5000,
				isCMD = parseInt($(this).find('.cmds').text()) > 50,
				$mark = $(this).find('.mark')
			if(isDST) $mark.addClass('mark-1')
			if(isHOT) $mark.addClass('mark-2')
			if(isCMD) $mark.addClass('mark-3')
		})


		//侧边栏
		$sidebar_tg.on('click',function(){
			$main.toggleClass('book-open-sidebar')
			$main.hasClass('book-open-sidebar') ? $tgtext.text('折叠') : $tgtext.text('展开')
		})

		
		//检测是否有文件
		if($isdown.text() == '否'){
			$bookdown.hide()
		}

		



	})
})