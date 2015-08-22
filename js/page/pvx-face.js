H.ready(['jquery','getRequest'],function(){
	jQuery(function($){


    	//导航栏激活
		H.curpage('.u-face')

		//route助手
		H.route(50)


		//列表页遍历
		$(".m-face-list-item").each(function(){
			//多角度验证
			var round = $(this).find('.u-face-round').text(),
				isround = round && round.indexOf('nophotosmall') ==-1,
				$isround = $(this).find('.isround')
			isround ? $isround.addClass('true') : $isround.addClass('false')
			//角标验证
			var isDST = parseInt($(this).find('.digest').text()) > 0,
				isHOT = parseInt($(this).find('.downs').text()) > 5000,
				isCMD = parseInt($(this).find('.cmds').text()) > 50,
				$mark = $(this).find('.mark')
			if(isDST) $mark.addClass('mark-1')
			if(isHOT) $mark.addClass('mark-2')
			if(isCMD) $mark.addClass('mark-3')
		})



	})
})