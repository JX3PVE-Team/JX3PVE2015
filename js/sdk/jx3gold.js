'use strict';

$(function(){
	
	//变量声明
	var API = [
			'json/sample1.json',
			'json/sample2.json',
			'http://www.pk200.com/api/game/getcount/'
		],
		APIL = API.length,
		DATA = [],
		$box = $("#jx3gold")

	//最小取值
	function min(arr){
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
	$.getJSON('json/fwq.json',function(fwq){
		for(var i=0;i<fwq.length;i++){
			$box.append('<tr><th class="fwq">'+fwq[i][0] + '<em class="fwq-details">' + fwq[i][1] + '</em>' + '</th></tr>')
		}
	})

	var total = 0
	//STEP.2 获取金价数据
	for(var i=0;i<APIL;i++){
		$.getJSON(API[i],function(data){

			//存储数据
			var len = data.length
				total++
				DATA.push(data)
			
			//遍历插入数据
			for(var j=0;j<len;j++){
				$box.children('tr').eq(j+1).append(
					'<td>'
					+ '<span class="lowest"><b class="data">' + data[j]['lowest'] + '</b><a class="go go-1" href="' + data[j]['lowlink'] + '">抢单</a></span>' 
					+ '<span class="average"><b class="data">' + data[j]['average'] + '</b><a class="go go-2" href="' + data[j]['link'] + '">购买</a></span>'
					+ '<span class="highest"><b class="data">' + data[j]['highest'] + '</b><a class="go go-3" href="' + data[j]['link'] + '">购买</a></span>' 
					+ '</td>'
				)
			}

			//全部加载完毕
			if(total === APIL){

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
				var $mode = $("input[name='pricemode']"),
					$data = $(".data"),
					price = $data.eq(0).text()
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

			}

		})
	}

});
