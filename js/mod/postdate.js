H.ready(['jquery'], function(){
    jQuery(function($){

    	function postdate(){
    		
			//帖子最后编辑时间
			var $allpost = $(".c-flist-list"),
				$eachpost = $allpost.children('tbody')
			if($allpost.length == 0) return

			//格式化日期对齐
			function formatdate(arg){
				var arr = arg.split('-')
				for (var i = 0; i < 3; i++) {
					if (arr[i] < 10 ) arr[i] = '0' + arr[i]
				}
				arg = arr.join('-')
				return arg
			}

			//获取3,6个月时间
			var M_1 = Date.parse('1970/2/1'),
				M_3 = Date.parse('1970/4/1'),
				M_6 = Date.parse('1970/7/1'),
				T_Now = new Date().getTime()

			//遍历处理
			$eachpost.each(function(i) {

				//时间设置处理
				var //最后编辑时间dom
					$lastedit = $(this).find('.e-lastedit'),
					//最后编辑的时间戳
					lastedit = $lastedit.text(),
					//最后发布的时间
					lastpub = $(this).find('.e-postpubday').text(),
					//最后编辑的时间
					lasttime,
					//阅读数
					views = parseInt($.trim($(this).find('.e-views').text()))

				//1.如果没有编辑过，取发布时间
				if(lastedit == 0){
						//lasttime = lastpub
						//关闭了人性化时间模式后需要重新处理
					var p = new Date(lastpub.replace(/-/g, "/"))
					lasttime = p.getFullYear() + '-' +  (p.getMonth()+1) + '-' +  p.getDate()
					lasttime = formatdate(lasttime)

				//2.如果有编辑记录，且为unix时间戳时，转换时间戳
				}else if(lastedit!=0 && lastedit.indexOf('-')==-1){
					lastedit = parseInt($.trim(lastedit)) * 1000
					var d = new Date(lastedit)
					lasttime = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate()
					lasttime = formatdate(lasttime)

				//3.如果是ajax按钮重新遍历，已经转换格式时则不变
				}else{
					lasttime = $lastedit.text()
				}

				//输出日期
				$lastedit.text(lasttime)

				//时间颜色处理
				var T_Modif = Date.parse(lasttime.replace(/-/g, "/")),
					valid = T_Now - T_Modif

				if(valid > M_6){
					$lastedit.addClass('fail')	//6个月以上灰色·失效
				}else if(valid <= M_3 && valid > M_1){
					$lastedit.addClass('new')	//3个月以内绿色
				}else if(valid <= M_1){
					$lastedit.addClass('fresh')	//1个月以内浅紫色
				}else{
					$lastedit.addClass('old')	//3～6个月橙色·可能失效
				}

				//特殊颜色处理
				if(valid <= M_1 && views >= 10000){
					$lastedit.addClass('ok')	//1个月以内有更新，且阅读破万，红色
				}

			})

		}
		postdate()

		var t
		$("#autopbn").on('click',function(){
			t && clearTimeout(t)
			t = setTimeout(postdate,500)
		})

    })
})