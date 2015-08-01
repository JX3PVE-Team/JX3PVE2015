$(function() {
	$("#yyl-content-before > div, #yyl-content-after > div").each(function(i, item){
		var a = $.trim($(item).find(".yyl_view").text());
		if(a.length <=0){
			$(item).remove();
		};
	});
	
	$(".yyl_close_js").click(function(){
		if($(this).text()=='- 收起'){
			$(this).show().text("+ 展开").parent().parent().find(".yyl_view").hide();
		}else{$(this).show().text("- 收起").parent().parent().find(".yyl_view").show();}
	});

	fixSidebar('.sidebar',100);
	
	/*$("#yyl-title").click(function(){
		var now_url = window.location.href;
		var now_tit = $(this).text();
		function addfavorite(){
			if (document.all){
				window.external.addFavorite(now_url,now_tit);
			} else if (window.sidebar){
				window.sidebar.addPanel(now_tit, now_url, "");
			}
		}
		addfavorite();
	});*/
	
	/*$(window).scroll(function() {
		if($(document).scrollTop() > 358) {
			$(".menu_main").addClass("top_fixed")
		} else {
			$(".menu_main").removeClass("top_fixed")
		}
	});*/
	$.ajax({
		url : "http://www.jx3pve.com/page.php?id="+$("#cloudid").text(),
		type : "GET",
		dataType : "json",
		data : {
			String : Math.random()
		},
		success:function(data){
			var s = "宏内容 <一定要点这复制宏代码>";
			new Sytax("#yyl-content-center",data.content+data.net);
			$("#ajaxuse").text(data.use);
			if(_IE === undefined){
				$("#yyl-content-title").zclip({
					path: "http://static.jx3pve.com/cdn/js/wp/ZeroClipboard.swf",
					copy:function(){
						return data.content+data.net;
					},
					afterCopy:function(){
						$("#yyl-content-title").text("复制成功 到游戏内按 Ctrl+V 粘贴吧").css({"color":"green"});
						setTimeout(function() {
							$("#yyl-content-title").text(s).css({"color":"black"});
						},1500);
					}
				});
			} else {
				$("#yyl-content-title").click(function(){
					window.clipboardData.setData("Text",data.content+data.net);
					alert("复制成功");
				})
			}
		}
	})
});
