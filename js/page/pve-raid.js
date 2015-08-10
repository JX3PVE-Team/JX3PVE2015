H.ready(['jquery'],function(){
	jQuery(function($){

		var $w = $(window),
			$raidlogo = $(".c-raidlogo"),
			$score_t = $("#m-raid-rate-trigger"),
			$score = $("#m-raid-rate"),
			$score_btn = $("#ak_rate"),
			$raidvpg = $(".raid-viewpage"),
			//bannerurl = $("#raid-banner").text(),
			groupid = $("#raid-usergroup").text()

    	//导航栏激活
		H.curpage('.u-raid')

		//认证角标
		$raidlogo.add(".c-raidavt").each(function(i){
			if($(this).find('.verif a').length){
				var keywords = $(this).find('.verif a').attr('href'),
					index = keywords.indexOf('vid'),
					verif = keywords.charAt(index+4)
				$(this).addClass('u-verif u-verif-'+verif)
			}
		})

		//如果是个人页面
		if($(".m-raid-vprimary").length !=0){
			$raidvpg.addClass('raid-person-page')
		}

		//滚动至评分
			$score_t.on('click',function(e){
				e.preventDefault()
				var score_pos = $score.offset().top
				$w.scrollTop(score_pos - 50)
			})
			$score_t.one('click',function(e){
				setTimeout(function(){
					$score_btn.addClass('focusthis')
				},300)
			})

		//海报功能
			//发布
			var $raidbanner = $("#typeoption_raidbanner")
								.add('#select_raidbanner,#select_raidbanner button')
								.add('#select_raidbannerrpt,#select_raidbannerrpt input')
								.add('#select_raidbannerbg,#select_raidbannerbg input')
			$raidbanner
				.attr('disabled','disabled')
				.addClass('disabled')

			if($("html").hasClass('spHTML')){
				$raidbanner.removeAttr('disabled').removeClass('disabled')
			}

			//调用
			var SPGROUP = ['24','25','26','22','1','2','3'],
				BGREPEAT = ['不平铺','平铺','水平平铺','垂直平铺'],
				BGREPEATCODE = ['no-repeat','repeat','repeat-x','repeat-y']


			var banner_url_add = function(){
					var urltext = $("#raid-banner-url").text()
						if(urltext && urltext.indexOf('nophoto')===-1){
							return urltext
						}else{
							return ''
						}
				},
				banner_url = banner_url_add(),
				banner_repeat_status = function(){
					var bgstatus = $("#raid-banner-repeat").text().indexOf(BGREPEAT)
					if (bgstatus == -1) bgstatus=0
					return bgstatus
				},
				banner_repeat = BGREPEATCODE[banner_repeat_status()],
				banner_color = $("#raid-banner-color").text(),
				isSPGROUP = SPGROUP.indexOf(groupid) !=-1

			if($raidvpg.length !=0 && !($raidvpg.hasClass('raid-person-page'))){
				if(isSPGROUP){
					if(banner_url) $raidvpg.css('background-image','url('+banner_url+')')
					if(banner_color) $raidvpg.css('background-color',banner_color)
					if(banner_repeat) $raidvpg.css('background-repeat',banner_repeat)
				}
			}

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
		var raidnature = getRequest('raidnature'),
			raidsex = getRequest('raidsex'),
			raidtime = getRequest('raidtime'),
			raidtimefull = getRequest('raidtimefull'),
			raidcondition = [raidnature,raidsex,raidtime,raidtimefull]
		
		$.each(raidcondition,function(i,value){
			value=='all' ? 0 : parseInt(value)
		})
		console.log(raidcondition);



	})
})