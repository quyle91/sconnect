(function ($) {
	"use strict";

	$(window).on('load', function() {
	    $('.imp-shape-spot').each(function(index) {
	        var icon = $(this).find('img').attr('src'),
	            title = $(this).attr('data-shape-title');
	        $('.imp-tooltip:nth-child('+(index + 1)+') .squares-element').children().text(title);
	        $('#kh-'+$(this).attr('id')).find('.kh_title_building .img-fluid').attr("src", icon);
	    })
	    $('.imp-shape-spot').on('click', function() {
	        var idPot = $(this).attr('id');
	        $('#kh-'+idPot).modal('show');
	    })
	    $('.kh_open_paroname').on('click', function() {
	        $('.kh_item_building .modal').modal('hide');
	        $('#kh_paronama').show();
	        var srcPano = $(this).data('src');
	        var container = document.getElementById('kh_paronama');
	        container.classList.add("show");
	        const PSV = new PhotoSphereViewer.Viewer({
	            panorama: srcPano,
	            container: container,
	            defaultZoomLvl: 0,
	            caption: 'Hình ảnh chỉ mang tính chất minh họa',
	            navbar: [
	                'move',
	                'zoom',
	                {
	                    id: 'kh-home',
	                    content: '<i class="far fa-home"></i>',
	                    title: 'Quay lại',
	                    className: 'kh_pano_close',
	                    onClick: (viewer) => {
	                        // alert('Hello from custom button');
	                        $('#kh_paronama').fadeOut('slow', function() {
	                            $(this).removeClass('show');
	                            PSV.destroy();
	                        })
	                    },
	                },
	                'caption',
	                'fullscreen',
	            ],
	        });
	    })
	})

})(jQuery);