﻿/*
-------------------------------------------------------------------------
  说明:
  ckplayer6.3,有问题请访问http://www.ckplayer.com
  请注意，该文件为UTF-8编码，不需要改变编码即可使用于各种编码形式的网站内	
-------------------------------------------------------------------------
第一部分，加载插件
以下为加载的插件部份
插件的设置参数说明：
	1、插件名称
	2、水平对齐方式（0左，1中，2右）
	3、垂直对齐方式（0上，1中，2下）
	4、水平方向位置偏移量
	5、垂直方向位置偏移量
	6、插件的等级+竖线
	7、插件是否绑定在控制栏上，0不绑定，1绑定，当值是1的时候该插件将会随着控制栏一起隐藏或缓动
	插件名称尽量不要相同，对此的详细说明请到网站查看
*/
function ckcpt(){
    var cpt = '';
	cpt += 'right.swf,2,1,-75,-100,2,0|';//右边开关灯，调整，分享按钮的插件
	cpt += 'share.swf,1,1,-180,-100,3,0|';//分享插件
	cpt += 'adjustment.swf,1,1,-180,-100,3,0|';//调整大小和颜色的插件
    return cpt;
}
/*
插件的定义结束
以下是对播放器功能进行配置
*/
function ckstyle() { //定义总的风格
    var ck = {
    cpath:'',
	/*
	播放器风格压缩包文件的路径，默认的是style.swf
	如果调用不出来可以试着设置成绝对路径试试
	如果不知道路径并且使用的是默认配置，可以直接留空，播放器会
	*/
	language:'',
	/*播放器所使用的语言配置文件，需要和播放器在同目录下，默认是language.xml*/
	flashvars:'',
	/*
	这里是用来做为对flashvars值的补充，除了c和x二个参数以外的设置都可以在这里进行配置
	*/
	setup:'1,1,1,1,1,2,0,1,2,0,0,1,200,0,2,1,0,1,1,1,2,10,3,0,1,2,3000,0,0,0,1,1,1,1,1,1,1,250,0',
	/*
	这是配置文件里比较重要的一个参数，共有N个功能控制参数，并且以后会继续的增加，各控制参数以英文逗号(,)隔开。下面列出各参数的说明：
		1、鼠标经过按钮是否使用手型，0普通鼠标，1手型鼠标
		2、是否支持单击暂停，0不支持，1是支持
		3、是否支持双击全屏，0不支持，1是支持
		4、在播放前置广告时是否同时加载视频，0不加载，1加载
		5、广告显示的参考对象，0是参考视频区域，1是参考播放器区域
		6、广告大小的调整方式,只针对swf和图片有效,视频是自动缩放的
			=0是自动调整大小，意思是说大的话就变小，小的话就变大
			=1是大的化变小，小的话不变
			=2是什么也不变，就这么大
			=3是跟参考对像(第5个控制)参数设置的一样宽高
		7、前置广告播放顺序，0是顺序播放，1是随机播放
		8、对于视频广告是否采用修正，0是不使用，1是使用，如果是1，则用户在网速慢的情况下会按设定的倒计时进行播放广告，计时结束则放正片（比较人性化），设置成0的话，则强制播放完广告才能播放正片
		9、是否开启滚动文字广告，0是不开启，1是开启且不使用关闭按钮，2是开启并且使用关闭按钮，开启后将在加载视频的时候加载滚动文字广告
		10、视频的调整方式
			=0是自动调整大小，意思是说大的话就变小，小的话就变大，同时保持长宽比例不变
			=1是大的化变小，小的话不变
			=2是什么也不变，就这么大
			=3是跟参考对像(pm_video的设置)参数设置的一样宽高
		11、是否在多视频时分段加载，0不是，1是
		12、缩放视频时是否进行平滑处理，0不是，1是
		13、视频缓冲时间,单位：毫秒,建议不超过300
		14、初始图片调整方式(
			=0是自动调整大小，意思是说大的话就变小，小的话就变大，同时保持长宽比例不变
			=1是大的化变小，小的话不变
			=2是什么也不变，就这么大
			=3是跟pm_video参数设置的一样宽高
		15、暂停广告调整方式(
			=0是自动调整大小，意思是说大的话就变小，小的话就变大，同时保持长宽比例不变
			=1是大的化变小，小的话不变
			=2是什么也不变，就这么大
			=3是跟pm_video参数设置的一样宽
		16、暂停广告是否使用关闭广告设置，0不使用，1使用
		17、缓冲时是否播放广告，0是不显示，1是显示并同时隐藏掉缓冲图标和进度，2是显示并不隐藏缓冲图标
		18、是否支持键盘空格键控制播放和暂停0不支持，1支持
		19、是否支持键盘左右方向键控制快进快退0不支持，1支持
		20、是否支持键盘上下方向键控制音量0不支持，1支持
		21、播放器返回js交互函数的等级，0-2,等级越高，返回的参数越多
			0是返回少量常用交互
			1返回播放器在播放的时候的参数，不返回广告之类的参数
			2返回全部参数
			3返回全部参数，并且在参数前加上"播放器ID->"，用于多播放器的监听
		22、快进和快退的秒数
		23、界面上图片元素加载失败重新加载次数
		24、开启加载皮肤压缩文件包的加载进度提示
		25、使用隐藏控制栏时显示简单进度条的功能,0是不使用，1是使用，2是只在普通状态下使用
		26、控制栏隐藏设置(0不隐藏，1全屏时隐藏，2都隐藏
		27、控制栏隐藏延时时间，即在鼠标离开控制栏后多少毫秒后隐藏控制栏
		28、左右滚动时是否采用无缝，默认0采用，1是不采用
		29、0是正常状态，1是控制栏默认隐藏，播放状态下鼠标经过播放器显示控制栏，2是一直隐藏控制栏
		30、在播放rtmp视频时暂停后点击播放是否采用重新链接的方式,这里一共分0-3四个等级
		31、进度条是否采用前端优化，默认0不采用，1是采用，即加载进度不跟随实际进度，而是展现给用户一个比较流畅的感觉
		32、是否启用播放按钮和暂停按钮
		33、是否启用中间暂停按钮
		34、是否启用静音按钮
		35、是否启用全屏按钮
		36、是否启用进度调节栏
		37、是否启用调节音量
		38、计算时间的间隔，毫秒
		39、前置logo至少显示的时间，单位：毫秒
	*/
	pm_bg:'0x000000,100,230,180',
	/*播放器整体的背景配置，请注意，这里只是一个初始化的设置，如果需要真正的改动播放器的背景和最小宽高，需要在风格文件里找到相同的参数进行更改。
		1、整体背景颜色
		2、背景透明度
		3、播放器最小宽度
		4、播放器最小高度
	*/
	mylogo:'logo.png',
	/*
	视频加载前显示的logo文件，不使用设置成null，即ck.mylogo='null';
	*/
	pm_mylogo:'1,1,-100,-55',
	/*
	视频加载前显示的logo文件(mylogo参数的)的位置
	本软件所有的四个参数控制位置的方式全部都是统一的意思，如下
		1、水平对齐方式，0是左，1是中，2是右
		2、垂直对齐方式，0是上，1是中，2是下
		3、水平偏移量，举例说明，如果第1个参数设置成0左对齐，第3个偏移量设置成10，就是离左边10个像素，第一个参数设置成2，偏移量如果设置的是正值就会移到播放器外面，只有设置成负值才行，设置成-1，按钮就会跑到播放器外面
		4、垂直偏移量 
	*/
	logo:'cklogo.png',
	/*
	默认右上角一直显示的logo，不使用设置成null，即ck.logo='null';
	*/
	pm_logo:'2,0,-100,20',
	/*
	播放器右上角的logo的位置
		1、水平对齐方式，0是左，1是中，2是右
		2、垂直对齐方式，0是上，1是中，2是下
		3、水平偏移量
		4、垂直偏移量 
	以下是播放器自带的二个插件
	*/
	control_rel:'related.swf,source/plugin/smart_vide/ckplayer/related.xml,0',
	/*
	视频结束显示精彩视频的插件
		1、视频播放结束后显示相关精彩视频的插件文件（注意，视频结束动作设置成3时(即var flashvars={e:3})有效），
		2、xml文件是调用精彩视频的示例文件，可以自定义文件类型（比如asp,php,jsp,.net只要输出的是xml格式就行）,实际使用中一定要注意第二个参数的路径要正确
		3、第三个参数是设置配置文件的编码，0是默认的utf-8,1是gbk2312 
	*/
	control_pv:'Preview.swf,105,2000',
	/*
	视频预览插件
		1、插件文件名称(该插件和上面的精彩视频的插件都是放在风格压缩包里的)
		2、离进度栏的高(指的是插件的顶部离进度栏的位置)
		3、延迟时间(该处设置鼠标经过进度栏停顿多少毫秒后才显示插件)
		建议一定要设置延时时间，不然当鼠标在进度栏上划过的时候就会读取视频地址进行预览，很占资源 
	*/
	pm_repc:'',
	/*
	视频地址替换符，该功能主要是用来做简单加密的功能，使用方法很简单，请注意，只针对f值是视频地址的时候有效，其它地方不能使用。具体的请查看http://www.ckplayer.com/manual.php?id=4#title_25
	*/
	pm_spac:'|',
	/*
	视频地址间隔符，这里主要是播放多段视频时使用普通调用方式或网址调用方式时使用的。默认使用|，如果视频地址里本身存在|的话需要另外设置一个间隔符，注意，即使只有一个视频也需要设置。另外在使用rtmp协议播放视频的时候，如果视频存在多级目录的话，这里要改成其它的符号，因为rtmp协议的视频地址多级的话也需要用到|隔开流地址和实例地址 
	*/
	pm_fpac:'file->f',
	/*
	该参数的功能是把自定义的flashvars里的变量替换成ckplayer里对应的变量，默认的参数的意思是把flashvars里的file值替换成f值，因为ckplayer里只认f值，多个替换之间用竖线隔开
	*/
	pm_advtime:'2,0,-110,10,0,300,0',
	/*
	前置广告倒计时文本位置，播放前置 广告时有个倒计时的显示文本框，这里是设置该文本框的位置和宽高，对齐方式的。一共7个参数，分别表示：
		1、水平对齐方式，0是左对齐，1是中间对齐，2是右对齐
		2、垂直对齐方式，0是上对齐，1是中间对齐，2是低部对齐
		3、水平位置偏移量
		4、垂直位置偏移量
		5、文字对齐方式，0是左对齐，1是中间对齐，2是右对齐，3是默认对齐
		6、文本框宽席
		7、文本框高度 
	*/
	pm_advstatus:'1,2,2,-200,-40',
	/*
	前置广告静音按钮，静音按钮只在是视频广告时显示，当然也可以控制不显示 
		1、是否显示0不显示，1显示
		2、水平对齐方式
		3、垂直对齐方式
		4、水平偏移量
		5、垂直偏移量
	*/
	pm_advjp:'1,1,2,2,-100,-40',
	/*
	前置广告跳过广告按钮的位置
		1、是否显示0不显示，1是显示
		2、跳过按钮触发对象(值0/1,0是直接跳转,1是触发js:function ckadjump(){})
		3、水平对齐方式
		4、垂直对齐方式
		5、水平偏移量
		6、垂直偏移量
	*/
	pm_padvc:'2,0,-10,-10',
	/*
	暂停广告的关闭按钮的位置
		1、水平对齐方式
		2、垂直对齐方式
		3、水平偏移量
		4、垂直偏移量
	*/
	pm_advms:'2,2,-46,-56',
	/*
	滚动广告关闭按钮位置
		1、水平对齐方式
		2、垂直对齐方式
		3、水平偏移量
		4、垂直偏移量
	*/
	pm_zip:'1,1,-20,-8,1,0,0',
	/*
	加载皮肤压缩包时提示文字的位置
		1、水平对齐方式，0是左对齐，1是中间对齐，2是右对齐
		2、垂直对齐方式，0是上对齐，1是中间对齐，2是低部对齐
		3、水平位置偏移量
		4、垂直位置偏移量
		5、文字对齐方式，0是左对齐，1是中间对齐，2是右对齐，3是默认对齐
		6、文本框宽席
		7、文本框高度
	*/
	pm_advmarquee:'1,2,50,-60,50,18,0,0x000000,50,0,20,1,15,2000',
	/*
	滚动广告的控制，要使用的话需要在setup里的第9个参数设置成1
	这里分二种情况,前六个参数是定位控制，第7个参数是设置定位方式(0：相对定位，1：绝对定位)
	第一种情况：第7个参数是0的时候，相对定位，就是播放器长宽变化的时候，控制栏也跟着变
		1、默认1:中间对齐
		2、上中下对齐（0是上，1是中，2是下）
		3、离左边的距离
		4、Y轴偏移量
		5、离右边的距离
		6、高度
		7、定位方式
	第二种情况：第7个参数是1的时候，绝对定位，就是播放器长宽变化的时候，控制栏不跟着变，这种方式一般使用在控制栏大小不变的时候
		1、左中右对齐方式（0是左，1是中间，2是右）
		2、上中下对齐（0是上，1是中，2是下）
		3、x偏移量
		4、y偏移量
		5、宽度
		6、高度
		7、定位方式
	以上是前7个参数的作用
		8、是文字广告的背景色
		9、置背景色的透明度
		10、控制滚动方向，0是水平滚动（包括左右），1是上下滚动（包括向上和向下）
		11、移动的单位时长，即移动单位像素所需要的时长，毫秒
		12、移动的单位像素,正数同左/上，负数向右/下
		13、是行高，这个在设置向上或向下滚动的时候有用处
		14、控制向上或向下滚动时每次停止的时间
	*/
	advmarquee:'',
	/*
	该处是滚动文字广告的内容，如果不想在这里设置，就把这里清空并且在页面中使用js的函数定义function ckmarqueeadv(){return '广告内容'}
	*/
	myweb:escape(''),
	/*
	------------------------------------------------------------------------------------------------------------------
	以下内容部份是和插件相关的配置，请注意，自定义插件以及其配置的命名方式要注意，不要和系统的相重复，不然就会替换掉系统的相关设置，删除相关插件的话也可以同时删除相关的配置
	------------------------------------------------------------------------------------------------------------------
	以下内容定义自定义插件的相关配置，这里也可以自定义任何自己的插件需要配置的内容，当然，如果你某个插件不使用的话，也可以删除相关的配置
	------------------------------------------------------------------------------------------------------------------
	*/
	cpt_lights:'1',
	/*
	该处定义是否使用开关灯，和right.swf插件配合作用,使用开灯效果时调用页面的js函数function closelights(){};
	*/
	cpt_share:'source/plugin/smart_video/ckplayer/share.xml',
	/*
	分享插件调用的配置文件地址
	调用插件开始
	*/
    cpt_list:ckcpt()
	/*
	ckcpt()是本文件最上方的定义插件的函数
	*/
	}
    return ck;
}
/*
html5部分开始
以下代码是支持html5的，如果你不需要，可以删除。
html5代码块的代码可以随意更改以适合你的应用，欢迎到论坛交流更改心得
*/
(function() {	
	var CKobject= {
		_K_:function(d){return document.getElementById(d);},
		getVideo:function(s){
			var v='';
			if(s){
				for(var i=0;i<s.length;i++){
					var a=s[i].split('->');
					if(a && a[0]){
						v+='<source src="'+a[0]+'"';
					}
					if(a.length==2 && a[1]){
						v+=' type="'+a[1]+'"';
					}
					v+='>';
				}
			}
			return v;
		},
		getVars:function(v,k){
			if(v[k]){
				return v[k];
			}
		},
		getParams:function(v){
			var p='';
			if(v){
				if(this.getVars(v,'p')==1 && this.getVars(v,'m')!=1){
					p+=' autoplay="autoplay"';
				}
				if(this.getVars(v,'e')==1){
					p+=' loop="loop"';
				}
				if(this.getVars(v,'m')==1){
					p+=' preload="meta"';
				}
				if(this.getVars(v,'i')){
					p+=' poster="'+this.getVars(v,'i')+'"';
				}
			}
			return p;
		},
		browser:function(){
			var m = (function(ua){
				var a=new Object();
				var b = {
					msie: /msie/.test(ua) && !/opera/.test(ua),
					opera: /opera/.test(ua),
					safari: /webkit/.test(ua) && !/chrome/.test(ua),
					firefox: /firefox/.test(ua),
					chrome: /chrome/.test(ua)
				};
				var vMark = '';
				for (var i in b) {
					if (b[i]) { vMark = 'safari' == i ? 'version' : i; break; }
				}
				b.version = vMark && RegExp('(?:' + vMark + ')[\\/: ]([\\d.]+)').test(ua) ? RegExp.$1 : '0';
				b.ie = b.msie;
				b.ie6 = b.msie && parseInt(b.version, 10) == 6;
				b.ie7 = b.msie && parseInt(b.version, 10) == 7;
				b.ie8 = b.msie && parseInt(b.version, 10) == 8;
				a.B=vMark;
				a.V=b.version;
				return a;
			})(window.navigator.userAgent.toLowerCase());
			return m;
		},
		Platform:function(){
			var w=''; 
			var u = navigator.userAgent, app = navigator.appVersion;              
			var b={                  
				iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1,
				iPad: u.indexOf('iPad') > -1,
				ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
				android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1,
				webKit: u.indexOf('AppleWebKit') > -1,
				gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
				presto: u.indexOf('Presto') > -1,
				trident: u.indexOf('Trident') > -1,       
				mobile: !!u.match(/AppleWebKit.*Mobile.*/)||!!u.match(/AppleWebKit/),
				webApp: u.indexOf('Safari') == -1
			}; 
			for (var k in b){
				if(b[k]){
					w=k;
					break;
				}
			}
			return w;
		},
		getpath:function(z) {
			var d = unescape(window.location.href).replace('file:///', '');
			var k = parseInt(document.location.port);
			var u = document.location.protocol + '//' + document.location.hostname;
			var l = '',e = '',t = '';
			var s = 0;
			var r = z.split('//');
			if (r.length > 0) {
				l = r[0] + '//'
			}
			var h = 'http|https|ftp|rtsp|mms|ftp|rtmp';
			var a = h.split('|');
			if(k!=80 && k){
				u+=':'+k;
			}
			for (i = 0; i < a.length; i++){
				if ((a[i] + '://') == l){
					s = 1;
					break;
				}
			}
			if (s == 0) {
				if (z.substr(0, 1) == '/'){
					t = u + z;
				}
				else {
					e = d.substring(0, d.lastIndexOf('/') + 1).replace('\\', '/');
					var w = z.replace('../', './');
					var u = w.split('./');
					var n = u.length;
					var r = w.replace('./', '');
					var q = e.split('/');
					var j = q.length - n;
					for (i = 0; i < j; i++) {
						t += q[i] + '/';
					}
					t += r;
				}
			}
			else {
				t = z;
			}
			return t;
		},
		Flash:function(){
			var f=false,v=0;
			if(document.all){
				try { 
					var s=new ActiveXObject('ShockwaveFlash.ShockwaveFlash'); 
					f=true;
					var z=s.GetVariable('$version');
					v=parseInt(z.split(' ')[1].split(',')[0]);
				} 
				catch(e){} 
			}
			else{
				if (navigator.plugins && navigator.plugins.length > 0){
					var s=navigator.plugins['Shockwave Flash'];
					if (s){
						f=true;
						var w = s.description.split(' ');
						for (var i = 0; i < w.length; ++i){
							if (isNaN(parseInt(w[i]))) continue;
								v = parseInt(w[i]);
							}
						}
				}
			}
			return {f:f,v:v};
		},
		embedHTML5:function(C,P,W,H,V,A,S){
			var v='',
			b=this.browser()['B'],
			v=this.browser()['V'],
			x=v.split('.'),
			t=x[0],
			m=b+v,
			n=b+t,
			w='',
			s=false,
			f=this.Flash()['f'],
			a=false;
			if(!S){
				S=['iPad','iPhone','ios'];
			}
			for(var i=0;i<S.length;i++){
				w=S[i];
				if (w.indexOf('+')>-1){
					w=w.split('+')[0];
					a=true;
				}
				else{
					a=false;
				}
				if(this.Platform()==w|| m==w || n==w || b==w){
					if(a){
						if(!f){
							s=true;
							break;
						}
					}
					else{
						s=true;
						break;
					}
				}
			}
			if(s){
				v='<video controls id="'+P+'" width="'+W+'" height="'+H+'"'+this.getParams(A)+'>'+this.getVideo(V)+'</video>';
				this._K_(C).innerHTML=v;
				this._K_(C).style.width=W+'px';
				this._K_(C).style.height=H+'px';
				this._K_(C).style.backgroundColor='#000';
			}
		},
		getflashvars:function(s){
			var v='',i=0;
			if(s){
				for(var k in s){
					if(i>0){
						v+='&';
					}
					if(k=='f' && s[k] && !ckstyle()['pm_repc']){
						s[k]=this.getpath(s[k]);
						if(s[k].indexOf('&')>-1){
							s[k]=encodeURIComponent(s[k]);
						}
					}
					if(k=='y' && s[k]){
						s[k]=this.getpath(s[k]);
					}
					v+=k+'='+s[k];
					i++;
				}
			}
			return v;
		},
		getparam:function(s){
			var w='',v='',
			o={
				allowScriptAccess:'always',
				allowFullScreen:true,
				quality:'high',
				bgcolor:'#000'
			};
			if(s){
				for(var k in s){
					o[k]=s[k];
				}
			}
			for(var e in o){
				w+=e+'="'+o[e]+'" ';
				v+='<param name="'+e+'" value="'+o[e]+'" />';
			}
			w=w.replace('movie=','src=');
			return {w:w,v:v};
		},
		getObjectById:function (s){
			var X = null,
			Y = this._K_(s),
			r = 'embed';
			if (Y && Y.nodeName == 'OBJECT') {
				if (typeof Y.SetVariable != 'undefined') {
					X = Y;
				} else {
					var Z = Y.getElementsByTagName(r)[0];
					if (Z) {
						X = Z;
					}
				}
			}
			return X;
		},
		embedSWF:function(C,D,N,W,H,V,P){
			if(!N){N='ckplayer_a1'}
			if(!P){P={};}
			var u='undefined',
			j=document,
			r='http://www.macromedia.com/go/getflashplayer',
			t='<a href="'+r+'" target="_blank">请点击此处下载安装最新的flash插件</a>',
			error={
				w:'您的网页不符合w3c标准，无法显示播放器',
				f:'您没有安装flash插件，无法播放视频，'+t,
				v:'您的flash插件版本过低，无法播放视频，'+t
			},
			w3c=typeof j.getElementById != u && typeof j.getElementsByTagName != u && typeof j.createElement != u,
			i='id="'+N+'" name="'+N+'" ',
			s='',
			l='';
			P['movie']=C;
			P['flashvars']=this.getflashvars(V);
			s+='<object  pluginspage="http://www.macromedia.com/go/getflashplayer" ';
			s+='classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
			s+='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" ';
			s+='width="'+W+'" ';
			s+='height="'+H+'" ';
			s+=i;
			s+='align="middle">';
			s+=this.getparam(P)['v'];
			s+='<embed ';
			s+=this.getparam(P)['w'];
			s+=' width="'+W+'" height="'+H+'" name="'+N+'" id="'+N+'" align="middle" '+i;
			s+='type="application/x-shockwave-flash" pluginspage="'+r+'" />';
			s+='</object>';
			if(!w3c){
				l=error['w'];
			}
			else{
				if(!this.Flash()['f']){
					l=error['f'];
				}
				else{
					if(this.Flash()['v']<10){
						l=error['f'];
					}
					else{
						l=s;
					}
				}
			}
			if(l){
				this._K_(D).innerHTML=l;
				this._K_(D).style.color='#FFDD00';
			}
		}
	}
	window.CKobject = CKobject;
})();
/*
html5 部分结束
======================================================
SWFObject v2.2
如果你的网站里已经有swfobject类，可以删除下面的
*/
