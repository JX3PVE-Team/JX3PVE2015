H.ready(['jquery'],function(){
	jQuery(function($){

		var $w = $(window),
			$score_t = $("#m-raid-rate-trigger"),
			$score = $("#m-raid-rate"),
			$score_btn = $("#ak_rate")

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

	})
})