H.ready(['jquery'], function() {
	jQuery(function($) {

		//编辑器底部扩展
		var $editorEX = $("#c-editor-extend"),
			$editorEXtg = $("#c-editor-extend-tg"),
			$editorMore = $("#c-editor-extend-more")
		$editorEXtg.on('click', function() {
			$editorEX.hasClass('folder') ? $editorEXtg.text('折叠') : $editorEXtg.text('展开')
			$editorEX.toggleClass('folder')
		})
		$editorMore.on('click',function(){
			$editorEX.addClass('showall')
			$(this).hide()
		})

		//折叠展开更多楼层
		var $tg = $("#u-tgpost"),
            $ct = $(".c-fli").not(':first'),
            $icon = $("#u-tgpost-icon"),
            $tips = $("#u-tgpost-text"),
            isFolderDefault = $(".tgpost-folder").length
        $tg.on('click',function(){
            $ct.fadeToggle('slow')
            $icon.hasClass('on') ? $tips.text('展开') : $tips.text('折叠')
            $icon.toggleClass('on')
        })

        if(isFolderDefault){
            $ct.hide()
        }else{
            $icon.addClass('on')
            $tips.text('折叠')
        }

	})
})