jQuery(document).ready(function($){

	/* Thực hiện init lại slider sau khi load bằng ajax */
	$('.blog-posts-custom-element-wrapper').on(
		'ajax_custom_blog_posts_after',
		function(e){
			$(this).find(".slider").each(function(){
                let slider_option = $(this).attr('data-flickity-options');
                $(this).flickity(JSON.parse(slider_option));
            });
            $(this).find('.row-slide-vertical').each(function(){
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
		}
	);


	$("body").on('dragStart.flickity', ".blog-posts-custom-element-wrapper .slider", function(event, pointer) {
	    var flkty = $(this).data('flickity');
	    
	    // Lưu trữ chỉ số slide tại thời điểm dragStart
	    var startIndex = flkty.selectedIndex;
	    
	    // Lắng nghe sự kiện dragEnd để kiểm tra chuyển slide sau khi vuốt
	    $("body").one('dragEnd.flickity', ".blog-posts-custom-element-wrapper .slider", function(event, pointer) {
	        var endIndex = flkty.selectedIndex;
	        
	        // Kiểm tra xem người dùng đã chuyển slide hay không
	        if (endIndex === startIndex) {
	            // hướng touch
			    var swipeDirection = (flkty.x - flkty.dragX) > 0 ? "right" : "left";
			    // là vị trí cuối
			    var isEnd = (flkty.selectedIndex === flkty.slides.length - 1) ? "true" : "false";
			    // là vị trí đầu
			    var isStart = (flkty.selectedIndex === 0) ? "true" : "false";

			    if( isStart == "true" && swipeDirection == 'left'){
			    	console.log("ajax prev");
			    	$(this).next(".page-numbers").find(".prev").trigger("click");
			    }
			    if( isEnd == "true" && swipeDirection == 'right'){
			    	console.log("ajax next");
			    	$(this).next(".page-numbers").find(".next").trigger("click");
			    }
	        }
	    });
	});


});