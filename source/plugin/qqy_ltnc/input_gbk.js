function checkuse(str){
	var xmlhttp;    
	if (str==""){
	  document.getElementById("txtHint").innerHTML="";
	  return;
	}
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		  var result = parseInt(xmlhttp.responseText);
		  if(result==1){
			  msg ="���ǳƿ���ʹ��"; 
			  document.getElementById("txtHint").innerHTML= msg;
			  document.getElementById("txtHint").className= 'tips';
		  }else if(result==-1){
			  msg ="���ǳƲ���ʹ��"; 
			  document.getElementById("txtHint").innerHTML= msg;
			  document.getElementById("txtHint").className= 'color_warning';
		  }else{
			  msg ="���ǳ��ѱ�ʹ��"; 
			  document.getElementById("txtHint").innerHTML= msg;
			  document.getElementById("txtHint").className= 'color_warning';
		  }
		  //document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	}
	    
	xmlhttp.open("POST","plugin.php?id=qqy_ltnc:plugin",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("fname="+str);
}

function checkinput(thisid){
	var nicheng = thisid.value;
	var result = checktype(nicheng);
	if(result){
		checkuse(nicheng);
	}
}

function checksubmit(){
	var nicheng = document.getElementById("username").value;
	var result = checktype(nicheng);
	if(result){
		checkuse(nicheng);
		if( document.getElementById("txtHint").className=='color_warning'){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}	
}

function checktype(nicheng){
	if(nicheng){
		var lenth = strlen(nicheng);
		if(lenth<3){
			msg ="�ǳƲ���С��3���ַ�"; 
			document.getElementById("txtHint").innerHTML= msg;
			document.getElementById("txtHint").className= 'color_warning';
			return false;
		}
		if(lenth>15){
			msg ="�ǳƲ��ܴ���15���ַ�"; 
			document.getElementById("txtHint").innerHTML= msg;
			document.getElementById("txtHint").className = 'color_warning';
			return false;
		}
		switch(format){
		case 1://����
			patrn =/[^\u4e00-\u9fa5]/ ;///[^u4e00-u9fa5]/;
			if(patrn.exec(nicheng)){
				msg ="�ǳƱ���Ϊ����"; 
				document.getElementById("txtHint").innerHTML= msg;
				document.getElementById("txtHint").className= 'color_warning';
				return false;
			}
			break;
		case 2://��ĸ
			patrn = /[^a-zA-Z]/;
			if(patrn.exec(nicheng)){
				msg ="�ǳƱ���Ϊ��ĸ"; 
				document.getElementById("txtHint").innerHTML= msg;
				document.getElementById("txtHint").className= 'color_warning';
				return false;
			}
			break;
		case 3://���ġ���ĸ������
			patrn1 = /[^0-9a-zA-Z]/;
			patrn2 = /[u4e00-u9fa5]/;
			if(patrn1.exec(nicheng) || patrn2.exec(nicheng)){
				msg ="�ǳƱ���Ϊ���ġ���ĸ������"; 
				document.getElementById("txtHint").innerHTML= msg;
				document.getElementById("txtHint").className= 'color_warning';
				return false;
			}
			break;
		default:
			break;
		}
		return true;	
	}
	return false;
}


function strlen(str){
	var len = str.length;  
    var relen = 0;
    for(var i=0; i<len; i++){  
    	if(str.charCodeAt(i) <27 || str.charCodeAt(i) >126 )  {  
	      relen += 2;
    	}else{  
	      relen ++;  
    	}  
    }  
    return relen;  
}



