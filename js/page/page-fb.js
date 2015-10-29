H.ready(['jquery'],function(){
	jQuery(function($){

			var $w = $(window)

			//五甲榜处理
			var $toplist_item = $(".c-toplist li a span")
			$toplist_item.each(function(){
				var ori = $(this).text(),
					arr = ori.split('|')
				arr[1] = '<em>' + arr[1] + '</em>'
				text = arr.join('')
				$(this).html(text)

			})

			//内容区块折叠
			var $fbct_tg = $(".fb-content h2 .folder")
			$fbct_tg.on('click',function(){
				$(this).parent('h2').parent('.m-block').toggleClass('folder')
			})


			//评论跳转
			var $cmt_tg = $("#fb-goto-cmt"),
				$cmt = $("#fb-cmt")
			$cmt_tg.on('click',function(){
				var pos = $cmt.offset().top
				$w.scrollTop(pos)
			})

			//tab切换
			var $tab = $('.m-tabbox .navbox li')
			$tab.on('click',function(){
				var $this = $(this),
					$tg = $this.parent('.navbox').children('li'),
					$ct = $this.parent('.navbox').next('.ctbox').children('.ctbox-item'),
					i = $this.index()

				$tg.removeClass('on')
				$this.addClass('on')
				$ct.hide().eq(i).show()

			})




	})
})