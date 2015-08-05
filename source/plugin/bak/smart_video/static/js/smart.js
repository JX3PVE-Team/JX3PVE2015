var slide_order=0;
var slide_total=0;
jQuery(function(){
	slide_total=jQuery("#smart_slide").children().size();
jQuery("#smart_rank>li").mouseover(function(){
	slide_order=jQuery(this).index();
	jQuery("#smart_rank>li").each(function(index, element) {
       jQuery(this).removeClass("current");
    });
	jQuery(this).addClass("current");
	})	
	jQuery("#smart_slide>li").mouseover(function(){
		slide_order=jQuery(this).index();
        smart_slide(slide_order);
	})
	jQuery(".next").click(function(){
	    slide_order--;
		 smart_slide(slide_order);
		});
	jQuery(".prev").click(function(){
	    slide_order++;
		 smart_slide(slide_order);
		});	
});
var interval = setInterval(auto_slide, "3000");
function auto_slide(){
	        slide_order++;
		    smart_slide(slide_order)
	}
function smart_slide(slide_order){
        slide_order=slide_order%slide_total;
		jQuery("#smart_slide>li").each(function(index, element) {
		jQuery(this).removeClass("current");  
		});
		jQuery("#smart_slide_txt>div").each(function(index, element) {
		jQuery(this).hide();  
		});
		jQuery("#smart_slide_pic>li").each(function(index, element) {
		jQuery(this).css("display",'none');  
		});	
		jQuery("#smart_slide>li").eq(slide_order).addClass("current");
		jQuery("#smart_slide_txt>div").eq(slide_order).show();
		jQuery("#smart_slide_pic>li").eq(slide_order).show();
	}