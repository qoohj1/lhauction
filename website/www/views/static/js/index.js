// var galleryTop = new Swiper('.gallery-top', {
//     nextButton: '.swiper-button-next',
//     prevButton: '.swiper-button-prev',
//     spaceBetween: 10,
// });
// var galleryThumbs = new Swiper('.gallery-thumbs', {
//     spaceBetween: 10,
//     centeredSlides: true,
//     slidesPerView: 'auto',
//     touchRatio: 0.2,
//     slideToClickedSlide: true
// });
// // galleryTop.params.control = galleryThumbs;
// galleryThumbs.params.control = galleryTop;

jQuery(function(){
	var bH = $(window).height() - 97;
	// $('#supersized img').css('margin-top','97px')
	var wH = jQuery(window).height();
	$('.mid').css('margin-top',wH+'px');
});
jQuery(window).resize(function(){
	var wH = jQuery(window).height();
	$('.mid').css('margin-top',wH+'px');
});


$(function() {
    var page = {

        // 页面初始化方法
        init: function() {
            var self = this,
                json = {
                    api: config.apiServer + 'home/get',
                    type: 'get',
                    data: {
                        actionxm: 'getBanner'
                    }
                };
            var callback = function(res) {
                var slides = [],
                    img = {};
                if(res.status == 0) {
                    for(var i = 0;i<res['list'].length;i++){
                        img = {image: res['list'][i]['pic'],thumb: res['list'][i]['pic'],url: res['list'][i]['url_en']};
                        slides.push(img);
                    }
                	$.supersized({
						fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
						fit_landscape			:   0,			// Landscape images will not exceed browser width
						fit_portrait         	:   0,			// Portrait images will not exceed browser height
						horizontal_center : 0,
						vertical_center: 0,
                		slide_interval			:	6000,
                		transition				:	1,
                		transition_speed		:	700,
                		thumbnail_navigation	:	'',
                		slideshow				:	'on',
                		slide_links				:	'blank',
                		slides					:	slides
                	});

                	$("#supersized li a").removeAttr("target");

                } else {
                    alert(res.msg);
                }
            };

            json.callback = callback;
            Utils.requestData(json);
        },


    };

    page.init();


});
