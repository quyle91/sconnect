jQuery(document).ready(function($){
	$(document).ready(function(){
		$('.blog-posts-custom-element-wrapper.type-slide-vertical .row-slide-vertical').each(function(){
			let option = JSON.parse($(this).prev('mark').attr('data-slide-vertical'));
			let slick_option = {
				slidesToShow: option.groupCells,
				slidesToScroll: 1,
				autoplay: option.autoPlay,
				autoplaySpeed: option.autoPlay,
				infinite: option.infinite,
				vertical: true,
				verticalSwiping: true,
			    verticalScrolling: true,
			    cssEase: 'ease-in',
			    nextArrow: '<i class="none">',
				prevArrow: '<i class="none">',
			};
			$(this).slick(slick_option);
		});
	});
})