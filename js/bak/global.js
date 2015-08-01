require([
	'jquery-private',
	'plugin/responsive',
	'plugin/getRequest',
	'mod/header'
], function($) {
    $(function(){

    	//快速回复提示（加载文档后闪动提示）
		//$('#vfastpostform').find('.fullvfastpost').addClass('tipsforfastpost');


    //对话框模块
	//------------------------------------------
		/*//开启对话框
		function loadDialog(seletor){
			var ele = $(seletor);
			ele.show();
			$('#dialog-content').html('').append(ele);
			$('#dialog,#mask').show();
		}

		function loadDialogs(string){
			$('#dialog-content').html('').append(string);
			$('#dialog,#mask').show();
		}

		//关闭对话框
		$('#dialog-close').on('click', function() {
			$('#dialog,#mask').hide();
		});

		//警告框
		if ($('#dialog-important').html().length > 2) {
			$('#dialog-content').html('').append($('#dialog-important'));
			$('#dialog-important').show();
			$('#dialog,#mask').show();
		}*/
	
	//Sidebar
	//------------------------------------------
		
		/*if($('.zTD').length!=0){
			fixSidebar('.sidebar-wrap',96,96,250);
		}*/

	//下载模块
	//------------------------------------------
		/*if($('#mod-down').length!=0){

			//下载地址写入
			$('.down_url').each(function(i,item){
				var url_data = $(this).text().trim();
				if(url_data == ''){
				//地址未填
					$('.down').eq(i).attr('href',0);
				}else if( url_data.indexOf('回复可见') != -1){
				//需回复可见
					$('.down').eq(i).attr('href',1);
				}else{
				//正常下载地址
					$('.down').eq(i).attr('href',url_data);
				}
			})

			//下载事件绑定
			$('.down').click(function(e){
				var url = $(this).attr('href');
				if(url==0){
					e.preventDefault();
					loadDialogs('抱歉，作者太懒了，没有填写此条快速下载地址！请在文中寻找。^^');
				}else if(url==1){
					e.preventDefault();
					loadDialog('#dialog-vip')
				}else{
					//打开方式
					var url_to = $(this).is('a[href^="http://www.jx3pve.com"]');
					if(url_to){
						//站内地址
						$(this).attr('target','_self');
					}
				}
			})
		}*/

	//工具单页
	//------------------------------------------
		/*if($('.tool-info-primary').length!=0){

			//非必填字段为空隐藏
			$('.tool-info').each(function(i,item){
				if($(this).children('.content').length!=0){
					var content_length = $(this).children('.content').html().trim();
				}
				if(content_length==''){
					$(this).remove();
				}
			})

			//显示查看次数
			$('.macro-views').show();
		}
	*/
	//用户中心
	//------------------------------------------
		/*if($('#nv_home').length !=0){
		
			$('#user-nav h3').click(function(event) {
				$(this).next('ul').slideToggle();
			});

			$('.user-os-profile .verf a').each(function(i,item){
				if( $(this).children('img').length == 0){
					$(this).remove();
				}
			})

			var user_email_status = $('#user-email-status').text().trim().indexOf('已验证') != -1;
			if(user_email_status){
				$('.user-os-profile .usermail').addClass('validate');
				$('#user-email-status a').css('color','green');
			}else{
				$('.user-os-profile .usermail').addClass('novalidate');
				$('#user-email-status a').css('color','#FF7D00');
				$('#user-email-status').wrap('<a href="http://www.jx3pve.com/home.php?mod=spacecp&ac=profile&op=password"></a>');
			}
		}*/

			//$("#register-tips").eq(0).siblings('input').eq(0).attr('placeholder','www.jx3pve.com');

	//副本团队招募
	//------------------------------------------
		$('#raid-sp').on('click',function(e){
			var raid_url = $(this).attr('href');
			if(raid_url == '' || raid_url.indexOf('http')==-1){
				e.preventDefault();
				loadDialogs('该团队未创建团队专栏');
			}
		})

		$('#fam-primary a').on('click',function(e){
			var fam_url = $(this).attr('href');
			if(fam_url == '' || fam_url.indexOf('http')==-1){
				e.preventDefault();
				loadDialogs('作者遗忘填写或未创建');
			}
		})

	//反馈帮助
	//------------------------------------------
		if($('.faq-primary').length != 0){
			$('#postsubmit span').text('提交');
		}
		if($('.pg_faq').length !=0){
			var is_faq_listpage = getRequest('messageid')==undefined;
			if(is_faq_listpage){
				$('.umh').first().addClass('umn');
				$('.um').first().css('display','none');
			}
		}

	//视频
	//------------------------------------------
		if($('.video').length != 0){
			var video_cat = getRequest('fcid');
			//console.log(video_cat);
			switch(video_cat){
				case '1':
					$('.video .nav li').eq(0).removeClass('on');
					$('.video .nav li').eq(1).addClass('on');
					break;
				case '3':
					$('.video .nav li').eq(0).removeClass('on');
					$('.video .nav li').eq(2).addClass('on');
					break;
				case '2':
					$('.video .nav li').eq(0).removeClass('on');
					$('.video .nav li').eq(3).addClass('on');
					break;
				case '7':
					$('.video .nav li').eq(0).removeClass('on');
					$('.video .nav li').eq(4).addClass('on');
					break;
				default:
					break;
			}
			var video_page = getRequest('mod');
			//console.log(video_page);
			if(video_page == 'p'){
				$('.video .nav li').eq(0).removeClass('on');
				$('.video .nav li').eq(6).addClass('on');
			}
		}
	
	//捏脸
	//------------------------------------------
		if($('.face').length != 0){
			var pg_type = getRequest('mod'),
				pg_fid = getRequest('fid');
			if(pg_type=='post' && pg_fid=='92'){
				$('.face .nav li').eq(0).removeClass('on');
				$('.face .nav li').eq(3).addClass('on');
			}
		}

	//宠物
	//------------------------------------------
		if($('.pet').length != 0){

			$('#map').on('click',function(e){
				e.preventDefault();
				loadDialogs('正在开发中,即将上线,敬请关注!');
			})

			//菜单关联
			var pet_from = getRequest('pey_from');
			switch(pet_from){
				case '1':
					$('.pet .nav li').eq(0).removeClass('on');
					$('.pet .nav li').eq(1).addClass('on');
					break;
				case '4':
					$('.pet .nav li').eq(0).removeClass('on');
					$('.pet .nav li').eq(2).addClass('on');
					break;
				case '2':
					$('.pet .nav li').eq(0).removeClass('on');
					$('.pet .nav li').eq(3).addClass('on');
					break;
				case '3':
					$('.pet .nav li').eq(0).removeClass('on');
					$('.pet .nav li').eq(4).addClass('on');
					break;
				case '5':
					$('.pet .nav li').eq(0).removeClass('on');
					$('.pet .nav li').eq(5).addClass('on');
					break;
				case '6':
					$('.pet .nav li').eq(0).removeClass('on');
					$('.pet .nav li').eq(6).addClass('on');
					break;
				default:
					break;
			}
		}

	//副本
	//------------------------------------------
		if($('.fam').length!=0){
			var famzt_po = 0;
			var famzt_length = $('#fam-zt-list li').length-3;
			$('#fam-zt-prev').on('click',function(){
				if(famzt_po==0){
					alert('逗比亲,已是最前!');
					return;
				}
				famzt_po += 210;
				$('#fam-zt-list').css({'transform':'translateY('+ famzt_po +'px)'},400);
			}) 
			$('#fam-zt-next').on('click',function(){
				if(Math.abs(famzt_po)>famzt_length*66){
					alert('逗比亲,已是最后!');
					return;
				}
				famzt_po -= 210;
				$('#fam-zt-list').css({'transform':'translateY('+ famzt_po +'px)'},400);
			})
		}

	//旧副本专题背景图
	//------------------------------------------
		if($('.oldfb').length!=0){
			var fbzt_id = getRequest('topicid');
			switch(fbzt_id){
				case '34':
					$('.box').addClass('fb-old-mjmd');
					break;
				case '21':
					$('.box').addClass('fb-old-dmg');
					break;
				case '25':
					$('.box').addClass('fb-old-zbjxk');
					break;
				case '28':
					$('.box').addClass('fb-old-nzhg');
					break;	
				case '26':
					$('.box').addClass('fb-old-hztm');
					break;
				case '27':
					$('.box').addClass('fb-old-cghyl');
					break;
				case '22':
					$('.box').addClass('fb-old-zld');
					break;
				case '24':
					$('.box').addClass('fb-old-lyz');
					break;
				case '31':
					$('.box').addClass('fb-old-dhsd');
					break;
				case '30':
					$('.box').addClass('fb-old-dhdk');
					break;
				case '32':
					$('.box').addClass('fb-old-dhhs');
					break;
				case '33':
					$('.box').addClass('fb-old-cgtwd');
					break;
				case '29':
					$('.box').addClass('fb-old-gzswyj');
					break;
				case '23':
					$('.box').addClass('fb-old-zbjl');
					break;
				default:
					break;
			}
		}
	
	//ZT
	//------------------------------------------
		//白皮书作者换行
		/*$(".bps-content .module li a").each(function() {
			var book_name = $(this).html();
			var book_arr = book_name.split('|');
			var book_newname = book_arr.join('<br />');
			$(this).html(book_newname);
		})*/

		//白皮书折叠展开
		/*$('.bps-content span .toggle').on('click', function(e) {
			e.preventDefault();
			$(this).parent('span').siblings('h4,div').slideToggle();
		})*/
    });
});