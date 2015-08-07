H.ready(['jquery'],function(){
	jQuery(function($){

    	//导航栏激活
		H.curpage('.u-raid')

		//认证角标
		$(".m-raid-unit .raidlogo").add(".m-raid-unit .author").each(function(i){
			if($(this).find('.verif a').length){
				var keywords = $(this).find('.verif a').attr('href'),
					index = keywords.indexOf('vid'),
					verif = keywords.charAt(index+4)
				$(this).addClass('verif-'+verif)
			}
		})

		//海报功能
			//发布
			var $raidbanner = $("#typeoption_raidbanner")
			$raidbanner.attr('disabled','disabled')
			if($("html").hasClass('spHTML')) $raidbanner.removeAttr('disabled')
    	
	})
})