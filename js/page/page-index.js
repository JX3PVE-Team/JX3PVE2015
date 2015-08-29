H.ready(['jquery','swiper'],function(){
	jQuery(function($){

		var mySwiper = new Swiper('.swiper-container',{
			direction: 'horizontal',
	    	loop: true,
	    	effect: 'fade',
	    	pagination: '.swiper-pagination',
	    	paginationClickable: true,
	    	autoplay: 5000,
	    	autoplayDisableOnInteraction : false
		}); 

	})
})