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
		tmp=tp+dh;//ֱ�Ӹ�ֵtp�ᵼ��tp��ֵ�ò�������
		if(tmp>=0&&(tmp<=(t_h-s_h)))
		{
		tp=tmp;//
		main_top=(0-parseInt(tp*rate));
		jQuery(".player_box").css("top",main_top+"px");
		jQuery("#scrollbar_bar").css("top",tp+"px");//top��ֵ��0-max֮��ִ�� @�˶����ᵼ��ģ���ƶ�
		b_y=e.originalEvent.y;}//��������b_y��֤������ ���� ��갴��ȥ����Ϊ1 ��һ���϶� �������3 �ƶ�3-1=2px top=0+2=2px
		//�ڶ����϶��ƶ�4-1=3px top=2+3=5px;�������������������������
		}
	
	});
jQuery(document).bind("mouseup",function(e){//������� �����뿪��ť��ʱ�򴥷� 
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