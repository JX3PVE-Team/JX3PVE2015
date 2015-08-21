'use strict';

H.ready(['jquery','underscore'], function() {
	jQuery(function($) {

		var 
		API = {
			'5173' : 'http://www.jx3pve.com/js/sdk/sample1.json',
			'uu898': 'http://www.jx3pve.com/js/sdk/sample2.json',
			'pk200': 'http://www.jx3pve.com/js/sdk/sample3.json'
		},
		DATA = {
			'5173':{},
			'uu898':{},
			'pk200':{}
		},
		LEN = 0, 								//数据总长度
		STATUS = 0, 							//ajax就绪状况
		$box = $("#jx3gold"),					//tbody
		$mode = $("input[name='pricemode']") 	//模式切换

		//'http://www.pk200.com/api/game/getcount/'

		function retrieve(url, name, callback){
			$.getJSON(url,function(data){
				DATA[name] = data
				callback()
			})
		}

		function insertData(fwq, data){
			for (var key in fwq){
				$box.children('tr[data-name="'+ key +'"]').find('td[data-name="'+ name +'"]').html(name)
			}
		}


		$.getJSON('http://www.jx3pve.com/js/sdk/fwq.json', function(fwq) {

			//获取数据总长度
			LEN = _.size(fwq)

			//初始化表格，加载服务器数据
			for (var key in fwq) {
				$box.append(
					  '<tr data-name="' + key + '">' 
					+ '<th class="fwq">' + key + '<em class="fwq-details">' + '[ ' + fwq[key][0] + ' ] ' + fwq[key][1] + ' - ' + key + '</em>' + '</th>' 
					+ '<td data-name="5173"></td>'
					+ '<td data-name="uu898"></td>'
					+ '<td data-name="pk200"></td>'
					+ '<td class="avprice"></td>'
					+ '</tr>'
				)
			}


			//ajax加载数据
			for(var name in API){
				retrieve(API[name],name,insertData)
			}


		})




		
		


		
/*function analysis(fwq, data){
			for(key in fwq){
				data[5173][key] 
			}
		}*/

		

		

		
			//STEP.2 获取金价数据
			/*TOTAL = 0
			for (var i = 0; i < API.length; i++) {
				retrieve API[I], (NAME, RESULT){
					DATA[NAME] = RESULT
					TOTAL ++
					IF(TOTAL == 3){
						analysis(DATA)
					}
				}

				$.getJSON(API[i], function(data) {

					//加载计数,存储数据
					STATUS++
					DATA.push(data)

					console.log(DATA);


					//全部加载完成后
					if (STATUS === API.length) {

						for key in fwq

							$box.find('tr[data-name=""] td[data-name="5173"]').html()
						//遍历插入数据
						;(function insertData() {
							for (var i = 0; i < API.length; i++) {
								for (var j = 0; j < LEN; j++) {
									$box.children('tr').eq(j + 1).children('td').eq(i).html(
										function(){
											if(DATA[i][j] && DATA[i][j]['lowest'] && DATA[i][j]['highest'] && DATA[i][j]['average']){
												return '<span class="lowest"><a class="data" href="' + DATA[i][j]['lowlink'] + '">' + parseInt(DATA[i][j]['lowest']).toFixed(2) + '</a></span>' + '<span class="average"><a class="data" href="' + DATA[i][j]['lowlink'] + '">' + parseInt(DATA[i][j]['average']).toFixed(2) + '</a></span>' + '<span class="highest last"><a class="data" href="' + DATA[i][j]['lowlink'] + '">' + parseInt(DATA[i][j]['highest']).toFixed(2) + '</a></span>'
											}else{
												return '<span class="lowest null"><b class="data">--</b></span>' + '<span class="average null"><b class="data">--</b></span>' + '<span class="highest null last"><b class="data">--</b></span>' 
											}
										}
									)
								}
							}
						})()

						//最低价处理
						;(function comparePrice(){

							function min(arr) {
								var result = Infinity,
									value;
								for (var i = 0, length = arr.length; i < length; i++) {
									value = arr[i];
									if (isNaN(arr[i])){
										arr[i] = Infinity
									}
									if (value < result) {
										result = value;
									}
								}
								return result
							}

							function max(arr) {
								var result =  -Infinity,
									value;
								for (var i = 0, length = arr.length; i < length; i++) {
									value = arr[i];
									if (isNaN(arr[i])){
										arr[i] = -Infinity
									}
									if (value > result) {
										result = value;
									}
								}
								return result
							}

							function avr(arr){
								var sum = 0,
									av = 0,
									length = arr.length;
								for (var i = 0; i < length; i++) {
									if(isNaN(arr[i])){
										arr[i] = 0
									}
									sum += arr[i]
								}
								av = sum / length
								return av
							}

							for(var i=0;i<LEN;i++){
								var compareList = [],
									_data = $box.children('tr').eq(i+1).find('.data'),
									_avr = $box.children('tr').eq(i+1).find('.avprice')
								_data.each(function(){
									compareList.push(parseInt($(this).text()))
								})
								var min_price = min(compareList),
									max_price = max(compareList),
									av_price = avr(compareList).toFixed(2);

								var min_pos = compareList.indexOf(min_price),
									max_pos = compareList.indexOf(max_price);

								_data.eq(min_pos).addClass('ok')
								_data.eq(max_pos).addClass('no')
								_avr.text(av_price)
							}
						})()
						
						//切换模式开放
						$mode.removeAttr('disabled')
						var $data = $(".data")
						$mode.on('change',function(){
							var mode = $(this).val()
							if(mode==2){
								$data.each(function(){
									var _price = Math.round(parseInt($(this).text())*100)
									$(this).text(function(){
										if(isNaN(_price)){
											return '--'
										}else{
											return _price
										}
									})
								})
							}else{
								$data.each(function(){
									var _price = (parseInt($(this).text())/100).toFixed(2)
									$(this).text(function(){
										if(isNaN(_price)){
											return '--'
										}else{
											return _price
										}
									})
								})
							}
						})

					}

				})
			}*/

		


	})
})


//1.当json无法加载到时
//2.无穷大bug NaN判断