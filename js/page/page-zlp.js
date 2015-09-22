H.ready(['jquery'],function(){
	jQuery(function($){

			var $w = $(window)

			//内容区块折叠
			var $block_tg = $("h2 .folder")
			$block_tg.on('click',function(){
				$(this).parent('h2').parent('.m-block').toggleClass('folder')
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

			//导航跳转
			var $nav = $(".m-nav ul li a"),
				$block = $(".m-block")
				$nav.on('click',function(e){
					var index = $(this).index('.m-nav ul li a')
					var pos = $block.eq(index).offset().top
					if(index<5){
						e.preventDefault()
						$w.scrollTop(pos - 75)
					}
				})
				
	})
})