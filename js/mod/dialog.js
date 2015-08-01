H.ready(['jquery'], function(){
    jQuery(function($){

		//操作对话框
		//---------------------------------

		//1.显示
		function showDialog(){
			$('#u-mask,#w-dialog').show()
		}

		function loadDialog(type,ele){
			//显示对话框
			$('#u-mask,#w-dialog').show()
			$(".w-dialog-content").hide()
			//字符串
			if(type == 'string'){
				$("#w-dialog-content-default").show().html(ele)
			//选择器追加
			}else if(type == 'selector'){
				var append_ele = $(ele)
				$('#w-dialog-content-other').show().append(append_ele);
			//下载
			}else if(type == 'download'){
				$("#w-dialog-content-vip").show()
			}
		}

		window.loadDialog = loadDialog;

		//2.隐藏
		function hideDialog(){
			$('#u-mask,#w-dialog').hide()
		}

		$('#w-dialog-close').on('click', function() {
			hideDialog()
		})
		

		//警告
		//---------------------------------

		//1.公告警告
		var dialog_ac_important = $('#w-dialog-important').length > 0 ? $('#w-dialog-important').html().length : 0
		if (dialog_ac_important > 2) {
			loadDialog('string',dialog_ac_important)
		}

		//2.IE67警告
		var dialog_ac_ie67 = '您当前的浏览器版本过低，可能导致网站部分功能或界面异常，建议使用较高版本浏览器。建议使用Chrome标准浏览器，喜欢使用360的朋友推荐使用360极速浏览器。'
		if ($('html').hasClass('ie6') || $('html').hasClass('ie7')){
			loadDialog('string',dialog_ac_ie67)
		}

    })
})