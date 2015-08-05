function addrow(e,t){var n=e.parentNode.parentNode.parentNode.parentNode.parentNode;if(!addrowdirect)var r=n.insertRow(e.parentNode.parentNode.parentNode.rowIndex);else var r=n.insertRow(e.parentNode.parentNode.parentNode.rowIndex+1);var i=rowtypedata[t];for(var s=0;s<=i.length-1;s++){var o=r.insertCell(s);o.colSpan=i[s][0];var u=i[s][1];i[s][2]&&(o.className=i[s][2]),u=u.replace(/\{(n)\}/g,function(e){return addrowkey}),u=u.replace(/\{(\d+)\}/g,function(e,t){return addrow.arguments[parseInt(t)+1]}),o.innerHTML=u}addrowkey++,addrowdirect=0}function deleterow(e){var t=e.parentNode.parentNode.parentNode.parentNode.parentNode,n=e.parentNode.parentNode.parentNode;t.deleteRow(n.rowIndex)}var rowtypedata=[[[1,'<span style="color:red;">*</span>&#x89C6;&#x9891;&#x4FE1;&#x606F;',"td25"],[4,'<div style="float:right;"><a href="javascript:;" class="deleterow" onClick="deleterow(this)"><font color="red">&#x5220;&#x9664;</font></a></div><p style="margin-bottom:3px;">&#x89C6;&#x9891;&#x6807;&#x9898;:<input  name="videoname[]" class="px" style=" width:360px" placeholder="&#x6807;&#x9898;"></p><p  style="margin-bottom:3px;">&#x89C6;&#x9891;&#x5730;&#x5740;:<input  name="videolink[]" class="px" style=" width:360px"  placeholder="&#x94FE;&#x63A5;"><span style="margin-left:3px;" class="smart_up_window"><a href="plugin.php?id=smart_video&mod=u&type=video"  onclick="show_smart_window(\'smart_upload_main\',this.href,this);doane(event);"><img src="source/plugin/smart_video/static/images/upload.png" style="vertical-align:middle;"></a></span></p><p>&#x5C01;&#x9762;&#x5730;&#x5740;:<input  name="videoimg[]"  class="px" style=" width:360px" placeholder="&#x5C01;&#x9762;&#x56FE;&#x7247;&#x94FE;&#x63A5;"><span style="margin-left:3px;" class="smart_up_window"><a href="plugin.php?id=smart_video&mod=u&type=img"  onclick="show_smart_window(\'smart_upload_main\',this.href,this);doane(event);"><img src="source/plugin/smart_video/static/images/upload.png" style="vertical-align:middle;"></a></span></p>',""]]],addrowdirect=0,addrowkey=0
function check_form(){
  jQuery.noConflict();
	if(jQuery("#subject").val()==''){
	alert("Please input the title");
	jQuery("#subject").focus();		
	doane(event);
	return false;	
		}
   if(jQuery("#fcid").val()==0){
	alert("Please choose class");
	jQuery("#fcid").focus();	
	doane(event);
	return false;
		}
	return true;
	}
function show_smart_window(id,url,obj){
	id="#"+id;
	jQuery("#smart_mark").attr('id','');
    jQuery(obj).parent('span').parent('p').children('.px').attr('id','smart_mark');
	w=jQuery(window).width();
	h=jQuery(window).height();
	s_w=jQuery(id).width();
	s_h=jQuery(id).height();
	dw=parseInt((w-s_w)/2);
	dh=parseInt((h-s_h)/2)
	jQuery(id).css("top",dh);
	jQuery(id).css("left",dw)
	jQuery(id+"_iframe").attr("src",url);
	jQuery(id).show();
	
	}
function hide_smart_window(id){
	sid="#"+id
	jQuery(sid).hide();
	}	
