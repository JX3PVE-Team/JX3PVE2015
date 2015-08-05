var JQ = jQuery.noConflict();
JQ(document).ready(function(){
	JQ("#s_url").bind("focus",function(){
		JQ(this).css("color","#404040");
		if(JQ.trim(JQ("#s_url").val())==''||JQ.trim(JQ("#s_url").val())==lang.s_url_text)
		{
			JQ("#s_url").val("");
		}		
	});
	JQ("#s_url").bind("blur",function(){		
		if(JQ.trim(JQ("#s_url").val())==''||JQ.trim(JQ("#s_url").val())==lang.s_url_text)
		{
			JQ("#s_url").val(lang.s_url_text);
			JQ(this).css("color","#bbbbbb");
		}		
	});
	
	JQ("#longusn_button").click(function(){
		var _url = $('s_url').value;
		if(!_url || _url==lang.s_url_text){
			showDialog(lang.nourl, 'error');
			$('s_url').focus();
			return false;
		}
		var pattern = /[a-zA-z]+:\/\/[^s]*/i;
		if (!pattern.test(_url)) {
			_url = "http://" + _url;
			$('s_url').value = _url;
		}
		var fromurl = _url;
		_url = encodeURIComponent(_url);
		var gather_type = $('gather_type').value;	
		JQ("#longsun_loading").html('<img src="' + STATICURL + 'image/common/loading.gif" alt="loading" />');	
		JQ.ajax({
			url: 'plugin.php?id=longsun_collect:post&s_url=' + _url + '&gather_type=' + gather_type + '&positionkey=' + positionkey+'&s='+Math.random()
,
			dataType: "json",
			success: function(r){
				if(r!=null){
				var type = r['data']['type'];
				var data = r['data']['data'];
                if (type == 'eval') {
					eval(data)
				}else if (type == 'sucsses') {
					var subject = data['subject'];
					var message = data['message'];
					var imgCount = data['imgCount'];					
					switch(positionkey)	{
					    case 1:
							JQ('#subject').val(subject);
							if(imgCount > 0){
								ATTACHORIMAGE = 1;
								ajaxget('forum.php?mod=ajax&action=imagelist&pid=' + pid + '&posttime=' + $('posttime').value + (!fid ? '' : '&fid=' + fid), 'imgattachlist', null, null, null, function(){switchEditor(0);JQ("#e_textarea").val(message);discuzcode('svd');switchEditor(1)});	
							}else{
								switchEditor(0);
								JQ("#e_textarea").val(message);
								discuzcode('svd');
								switchEditor(1);
							}							
						break;
						case 2:
							JQ('#subject').val(subject);
							JQ("#fastpostmessage").val(message);						
						break;	
						case 3:
							JQ('#subject').val(subject);
							JQ("#postmessage").val(message);						
						break;
						case 4:
						    var from = data['from'];
							JQ('#title').val(subject);
							JQ("#from").val(from);
							JQ("input[name='fromurl']").val(fromurl);
							var f = window.frames["uchome-ifrHtmlEditor"].window.frames["HtmlEditor"];
							f.document.body.innerHTML = bbcode2html(message);						
						break;
					}
					showmsg(lang.collect_sucsses);
				} else{
					showDialog(data, type);
				}}
				JQ("#longsun_loading").html('');	
			}
		});		

	});	
	
});

function showmsg(info){
	 if(!$('creditpromptdiv')) {
		 showPrompt(null, null, '<div id="creditpromptdiv"><i>'+info+'</i></div>', 0);
	 } else {
		 $('creditpromptdiv').innerHTML = '<i>' + info + '</i>';
	 }	
	 setTimeout(function () {hideMenu(1, 'prompt');$('append_parent').removeChild($('ntcwin'));}, 1500);	
}		