//resize body class
H.ready(['jquery'], function(){
    jQuery(function($){
    	$(function(){
                
            var timer = null;
            var $window = $(window).resize(function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    $window.trigger('onResizeEx');
                }, window.RESIZEINTERVAL || 200)
            })

            var w = $(window)
            var resetLayout = function() {
                var width = ~~w.width(),
                    $body = $('body');
                $body.removeClass('screen-xs screen-s screen-m screen-l screen-xl')
                var screenSize = {
                    "screen-xs": [0, 940],
                    'screen-s': [940, 1180],
                    "screen-m": [1180, 1400],
                    "screen-l": [1400, 1580],
                    "screen-xl": [1580]
                };
                var bodyClazz = ""
                for(var clazz in screenSize){
                    
                    var min = screenSize[clazz][0];
                    var max = screenSize[clazz][1];
                    if(width >= min && width < max){
                        bodyClazz = clazz;
                        break;
                    }
                    if(screenSize[clazz].length == 1){
                        bodyClazz = clazz;
                        break;
                    }
                }

                $body.addClass(bodyClazz);
                //$wp.width($(".guides").width())
            };
            resetLayout()
            w.bind('onResizeEx', resetLayout);

        });
    })
})
