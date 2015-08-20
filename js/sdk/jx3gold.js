'use strict';

H.ready(['jquery'], function() {
	jQuery(function($) {

		//变量声明
		var API = [
				'http://www.jx3pve.com/js/sdk/sample1.json',
				'http://www.jx3pve.com/js/sdk/sample2.json',
				'http://www.pk200.com/api/game/getcount/'
			],
			DATA = [], //存储全部json数据
			LEN = 0, //数据总长度
			STATUS = 0 //ajax就绪状况


		//选择器
		var $box = $("#jx3gold"),
			$mode = $("input[name='pricemode']"), //模式切换
			$data = $(".data") //全部数据td


		//最小取值
		function min(arr) {
			var result = Infinity,
				value;
			for (var i = 0, length = arr.length; i < length; i++) {
				value = arr[i];
				if (value < result) {
					result = value;
				}
			}
			return result
		}

		//STEP.1 获取服务器数据
		$.getJSON('http://www.jx3pve.com/js/sdk/fwq.json', function(fwq) {

			//获取数据总长度
			LEN = fwq.length

			//初始化表格，加载服务器数据，布局占位
			;(function init() {
				for (var i = 0; i < LEN; i++) {
					$box.append(
						'<tr>' + '<th class="fwq">' + fwq[i][0] + '<em class="fwq-details">' + fwq[i][1] + '</em>' + '</th>' + '<td class="data"></td><td class="data"></td><td class="data"></td>' + '</tr>'
					)
				}
			})()


			//STEP.2 获取金价数据
			for (var i = 0; i < API.length; i++) {
				$.getJSON(API[i], function(data) {

					//加载计数,存储数据
					STATUS++
					DATA.push(data)

					//全部加载完成后
					if (STATUS === API.length) {

						//遍历插入数据
						(function insertData() {
							for (var i = 0; i < API.length; i++) {
								for (var j = 0; j < LEN; j++) {
									$box.children('tr').eq(j + 1).children('td').eq(i).html(
										function(){
											if(DATA[i][j]){
												return '<span class="lowest"><b class="data">' + DATA[i][j]['lowest'] + '</b><a class="go go-1" href="' + DATA[i][j]['lowlink'] + '">抢单</a></span>' + '<span class="average"><b class="data">' + DATA[i][j]['average'] + '</b><a class="go go-2" href="' + DATA[i][j]['link'] + '">购买</a></span>' + '<span class="highest"><b class="data">' + DATA[i][j]['highest'] + '</b><a class="go go-3" href="' + DATA[i][j]['link'] + '">购买</a></span>' 
											}else{
												return '<span class="lowest"><b class="data">--</b></span>' + '<span class="average"><b class="data">--</b></span>' + '<span class="highest"><b class="data">--</b></span>' 
											}
										}
									)
								}
							}
						})()

					}



					//全部加载完毕
					/*if(STATUS === APIL){

						//最低价处理
						for(var o=0;o<len;o++){
							var compareList = []
							for(var p=0;p<APIL;p++){
								compareList.push(parseInt(DATA[p][o]['lowest']))
							}
							var minPrice = min(compareList),
								minPos = compareList.indexOf(minPrice)
							$box.children('tr')
								.eq(o+1)
								.children('td')
								.eq(minPos)
								.children('.lowest')
								.addClass('ok')
						}

						//显示模式
						var price = $data.eq(0).text()
						$mode.on('change',function(){
							var mode = $(this).val()
							if(mode==2){
								$data.each(function(){
									var _price = parseInt($(this).text())*100
									$(this).text(_price)
								})
							}else{
								$data.each(function(){
									var _price = parseInt($(this).text())/100
									$(this).text(_price)
								})
							}
						})

					}*/
				})
			}

		})


	})
})


//1.当json无法加载到时