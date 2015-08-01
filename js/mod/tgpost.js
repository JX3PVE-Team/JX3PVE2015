H.ready(['jquery'], function(){
    jQuery(function($){

        var 
        	$tg = $("#u-tgpost"),
        	$ct = $(".c-fli").not(':first'),
        	$icon = $("#u-tgpost-icon"),
        	$tips = $("#u-tgpost-text")
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

