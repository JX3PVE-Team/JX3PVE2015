/**
Author: [huyinghuan](xiacijian@163.com)
Date: 2015.11.08
Desc:
  本文件不需要被引用。 仅做为编辑器editor.js 在chrome下的换行bug修复 仓库。（editor.js中是该片段代码的压缩）
*/
  var preventSetNewLine =  function(e){
     if(e.keyCode === 13){
       document.execCommand("formatBlock", false, "<p>");
       return false;
     }
  };
  var ready = function(){
    if(!/chrome/i.test(navigator.userAgent)){return;}
    document.body.addEventListener('keydown',preventSetNewLine);
  };