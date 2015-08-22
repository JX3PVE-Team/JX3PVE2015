H.ready(['jquery'],function(){
	jQuery(function($){

		//是否为单页
		var $box = $(".viewpage-container"),
			iscustompage = $box.length && $("#u-custombg").length
			//groupid = $("#raid-usergroup").text()

		//海报功能
		var SPGROUP = ['24','25','26','22','1','2','3'],
			BGREPEAT = ['不平铺','平铺','水平平铺','垂直平铺'],
			BGREPEATCODE = ['no-repeat','repeat','repeat-x','repeat-y']

		var banner_url_add = function(){
				var urltext = $("#u-custombg-url").text()
					if(urltext){ // && urltext.indexOf('nophoto')===-1
						return urltext
					}else{
						return ''
					}
			},
			banner_url = banner_url_add(),
			banner_repeat_status = function(){
				var bgstatus = $("#u-custombg-repeat").text().indexOf(BGREPEAT)
				if (bgstatus == -1) bgstatus=0
				return bgstatus
			},
			banner_repeat = BGREPEATCODE[banner_repeat_status()],
			banner_color = $("#u-custombg-color").text()
			//isSPGROUP = SPGROUP.indexOf(groupid) !=-1

		if(iscustompage){
			//if(isSPGROUP){
				if(banner_url) $box.css('background-image','url('+banner_url+')')
				if(banner_color) $box.css('background-color',banner_color)
				if(banner_repeat) $box.css('background-repeat',banner_repeat)
			//}
		}

	})
})