var isd=false;
var b_y=0;
var tp=0;
var t_h=435;
var c_h=97;
var rate=0;
var main_top=0;
var mouserate=10;
var s_h=0;
jQuery(function (){
	jQuery(document).ready(function(e) {
    scol_len=jQuery(".scroll_box").children().size();
	l_h=(scol_len*c_h)-436;
	if(l_h>0){s_h=parseInt(t_h/(scol_len-3.5));
	s_h=s_h>30?s_h:30;
	rate=l_h/(t_h-s_h);
	}else{s_h=0;}
	jQuery("#scrollbar_bar").css("height",s_h+"px");
	jQuery(".scroll_box>div").show();
	});
jQuery("#scrollbar_bar").bind("mousedown",function(e){
	 b_y=e.originalEvent.y;//set drag status
	 isd=true;
	});	
jQuery(document).bind("mousemove",function(e){
	if(isd){
		dh=e.originalEvent.y-b_y;
		tmp=tp+dh;//直接赋值tp会导致tp的值得不到限制
		if(tmp>=0&&(tmp<=(t_h-s_h)))
		{
		tp=tmp;//
		main_top=(0-parseInt(tp*rate));
		jQuery(".player_box").css("top",main_top+"px");
		jQuery("#scrollbar_bar").css("top",tp+"px");//top的值在0-max之间执行 @此动作会导致模块移动
		b_y=e.originalEvent.y;}//重新设置b_y保证流畅性 或者 鼠标按下去设置为1 第一次拖动 鼠标坐标3 移动3-1=2px top=0+2=2px
		//第二次拖动移动4-1=3px top=2+3=5px;或产生不流畅和鼠标跟不上现象
		}
	
	});
jQuery(document).bind("mouseup",function(e){//鼠标收起 或者离开按钮的时候触发 
	 isd=false;//set undrag status
	});
jQuery('.scroll_box').on('mousewheel', function(event) {
	if(event.deltaY>0){
		if((tp-mouserate)>=0){
			tp=tp-mouserate
		jQuery("#scrollbar_bar").css("top",(tp)+"px");}
		}else{
			if((tp+mouserate)<(t_h-s_h)){
				tp=tp+mouserate
			jQuery("#scrollbar_bar").css("top",(tp)+"px");
			}
			}
		main_top=(0-parseInt(tp*rate));
		jQuery(".player_box").css("top",main_top+"px");	
		return false;
});	
jQuery(".scroll_box>div").click(function(){
	jQuery('#swfplayer').html("");
	jQuery(".scroll_box>div").each(function(index, element) {
        jQuery(this).removeClass('hover');
    });
	jQuery(this).addClass('hover');
	
	if(video[jQuery(this).index()]=='0'){
	   jwplayer("smart_video").setup({
        file: f_video[jQuery(this).index()],
        image: m_video[jQuery(this).index()],
		width:'100%',
		height:'100%',
    })
	}else{
			jQuery("#smart_video").html(video[jQuery(this).index()]);
			}
	
	});							
	})	