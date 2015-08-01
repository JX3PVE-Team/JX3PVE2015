H.ready(['jquery'],function(){
	jQuery(function($){

		//侧边栏
		$("#user-os-nav h3").on('click',function(){
			$(this).next('ul').slideToggle()
			var status_text_box = $(this).find('em'),
				status_text = status_text_box.text()
			if(status_text == '-'){
				status_text_box.text('+')
			}else if(status_text == '+'){
				status_text_box.text('-')
			}
		})	

		//email
		var user_email_status = $.trim($('#user-email-status').text()).indexOf('已验证') != -1;
		if(user_email_status){
			$('.user-os-profile .usermail').addClass('validate');
			$('#user-email-status a').css('color','green');
		}else{
			$('.user-os-profile .usermail').addClass('novalidate');
			$('#user-email-status a').css('color','#FF7D00');
			$('#user-email-status').wrap('<a href="http://www.jx3pve.com/home.php?mod=spacecp&ac=profile&op=password"></a>');
		}

		//会员
		var $days = $("#user-vip-days"),
			$need = $("#user-vip-needbuy"),
			$has = $("#user-vip-myhas"),
			unit = 32,
			days = $days.val(),
			need = days*unit,
			has = $has.text()

		function compareCoins(){
			if(has >= need){
				$has.addClass('ok')
			}else{
				$has.addClass('fail')
			}
		}
		compareCoins()
			
		$days.on('change',function(){
			
			var days = $(this).val(),
				need = days*unit

			$need.text(need)
			compareCoins()
		})

		//过期时间换行
		$fail_time = $(".user-vip-header .time span")
			//多个用户组折行
			$fail_time.after('<br>')	

			/*$fail_time.each(function(){
				if(!$.trim($(this).text()).toString()){
					$(this).text('无限期')
				}
			})*/
			



	})
})