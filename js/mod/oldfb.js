H.ready(['jquery'], function(){
    jQuery(function($){
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

    })
})