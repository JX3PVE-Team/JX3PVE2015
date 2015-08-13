H.ready(['jquery'],function(){
	jQuery(function($){

		var $w = $(window),
			$score_t = $("#m-raid-rate-trigger"),
			$score = $("#m-raid-rate"),
			$score_btn = $("#ak_rate"),
			$raidvpg = $(".raid-viewpage"),
			groupid = $("#raid-usergroup").text(),
			isTeamPage = Boolean($(".sort-9-container").length)

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
		var SPGROUP = ['24','25','26','22','1','2','3'],
			BGREPEAT = ['不平铺','平铺','水平平铺','垂直平铺'],
			BGREPEATCODE = ['no-repeat','repeat','repeat-x','repeat-y']

		var banner_url_add = function(){
				var urltext = $("#raid-banner-url").text()
					if(urltext){ // && urltext.indexOf('nophoto')===-1
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

		if(isTeamPage){
			//if(isSPGROUP){
				if(banner_url) $raidvpg.css('background-image','url('+banner_url+')')
				if(banner_color) $raidvpg.css('background-color',banner_color)
				if(banner_repeat) $raidvpg.css('background-repeat',banner_repeat)
			//}
		}


	})
})