<?php 
namespace Adminz\Helper;
use Adminz\Admin\Adminz;

/*
	Tự tạo html template theo cấu trúc của photoswipe 
	new một biến ADMINZ_Helper_Woocommerce_Photoswipe
	setup thuộc tính doom_links
	chạy init();

*/

class ADMINZ_Helper_Woocommerce_Photoswipe{
	public $dom_links = '';

	function __construct() {
		
	}

	function init(){

		if(!$this->dom_links){
			echo 'no set dom_links';
			return;
		}

		$this->enqueue();
	}

	function enqueue(){
		add_action('wp_enqueue_scripts',function(){
		    wp_enqueue_script( 'photoswipe' );
		    wp_enqueue_script( 'photoswipe-ui-default' );

		    wp_enqueue_style( 'photoswipe' );
		    wp_enqueue_style( 'photoswipe-default-skin' );
		});

		add_action('wp_footer',function(){
		    require_once get_template_directory() . '/woocommerce/single-product/photoswipe.php';
		    ?>
		    <script type="text/javascript">
            jQuery(document).ready(function($){
                $('<?php echo esc_attr($this->dom_links); ?>').on('click',function(e){
                    e.preventDefault();

                    const items = [];
                    const index = $(this).closest(".col").index();

                    $('<?php echo esc_attr($this->dom_links); ?>').each(function(){
                        const src = $(this).attr('href');
                        const size = $(this).data('size').split('x');
                        const item = {
                            src: src,
                            w: parseInt(size[0], 10),
                            h: parseInt(size[1], 10)
                        };
                        items.push(item);
                    });

                    const options = {
                        index: index,
                        // Cấu hình PhotoSwipe theo ý muốn
                    };
                    const pswpElement = document.querySelectorAll('.pswp')[0];
                    const gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                    gallery.init();

                });
            })
        </script>
		    <?php
		});
	}
	
}


/* 
	====================== Ví dụ
	
	1. HTML
		<div class="thuvienanh">
			<a 
				href="https://happytoursvietnam.com/wp-content/uploads/2023/09/082126100_1575571114-Felix_Rostig.webp" 
				data-size="800x450"
				>
                IMAGE TAG
            </a>
            <a 
				href="https://happytoursvietnam.com/wp-content/uploads/2023/09/082126100_1575571114-Felix_Rostig.webp" 
				data-size="800x450"
				>
                IMAGE TAG
            </a>
		</div>

	2. PHP
		$gallery = new Adminz\Helper\ADMINZ_Helper_Woocommerce_Photoswipe;
    	$gallery->dom_links = ".thuvienanh a";
    	$gallery->init();




*/