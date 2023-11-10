<?php 
namespace Adminz\Helper;
use Adminz\Admin\Adminz;
class ADMINZ_Helper_Flatsome_Acf_Banner{
	public $field_locations = array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'all',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'all',
			),
		),
	);
	public $meta_key_banner_image = 'adminz_banner';
	public $meta_key_banner_title = 'adminz_title';
	public $banner_height = 399;


	function __construct() {
		if(!function_exists('get_field')) return;
		
	}

	function init(){
		$this->create_field();
		$this->create_hook();
	}

	function create_hook(){
		add_action('flatsome_after_header',function(){
		    $this->create_html();
		});
	}

	function create_html(){
		if(is_front_page()) return;
	    $banner = $this->get_banner();
	    $title = $this->get_title();
	                
	    ob_start();
	    ?>
	    [section class="adminz_banner" bg_overlay="rgba(0,0,0,.5)" bg="<?php echo esc_attr($banner) ?>" bg_size="original" dark="true" height="<?php echo esc_attr($this->banner_height); ?>px"]
	        [row]
	            [col span__sm="12" span="9" class="pb-0"]
	                [adminz_breadcrumb]
	                [title class="adminz_banner_title mb-0" text="<?php echo esc_attr($title); ?>" tag_name="h1"]
	            [/col]
	        [/row]
	        
	    [/section]
	    <style type="text/css">
	    	@media (max-width: 549px){
	    		.adminz_banner{
	    			min-height: unset !important;
	    		}
	    	}
	    </style>
	    <?php
	    echo do_shortcode( ob_get_clean());
	}

	function create_field(){
		add_action( 'acf/include_fields', function() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group( array(
		'key' => 'group_6506a81783b36',
		'title' => 'Banner option',
		'fields' => array(
			array(
				'key' => 'field_'.$this->meta_key_banner_image,
				'label' => 'Default banner image',
				'name' => $this->meta_key_banner_image,
				'aria-label' => '',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'id',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
			array(
				'key' => 'field_'.$this->meta_key_banner_title,
				'label' => 'Default banner title',
				'name' => $this->meta_key_banner_title,
				'aria-label' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'return_format' => '',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
		),
		'location' => $this->field_locations,
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	) );
	} );


	}

	function get_banner(){
		$id = get_the_ID();
		if(is_home()){
			$id = get_option('page_for_posts');
		}
		$banner = get_field($this->meta_key_banner_image,$id);

		$queried_object = get_queried_object();
		if(is_a($queried_object, 'WP_Term')){
			if($_banner = get_field($this->meta_key_banner_image,$queried_object)){
				$banner = $_banner;
			}
		}

		// nếu ko có thì lấy default
		if(!$banner){
	        $global_banner = get_field($this->meta_key_banner_image,'option');
	        if(!$global_banner) return;
	        if($global_banner){
	            $banner = $global_banner;
	        }
	    }

		

	    return $banner;
	}

	function get_title(){	
		


		$id = get_the_ID();
		if(is_home()){
			$id = get_option('page_for_posts');
		}
		$title = get_field($this->meta_key_banner_title,$id);

		$queried_object = get_queried_object();
		if(is_a($queried_object, 'WP_Term')){
			if($_title = get_field($this->meta_key_banner_title,$queried_object)){
				$title = $_title;			
			}

			if(!$title){
				$title = $queried_object->name;
			}

		}	

		if(!$title){
			if (is_single()) {
				$title = get_the_title();
			}elseif(is_archive()){
				$title = get_queried_object()->name;
				if(function_exists('is_shop') and is_shop()){
					$title = get_the_title(get_option('woocommerce_shop_page_id'));
				}
			}elseif(is_page()){
				$title = get_the_title();
			}elseif(is_search()){
				$title = __("Search");
			}elseif(is_404()){
				$title = __("Page not found");
			}elseif(is_home()){
				$title = get_the_title(get_option('page_for_posts') );
			}else{
				$title = get_the_title();
			}
		}

	    return $title;
	}
}



/*
	EXAMPLE
	$sa = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Acf_Banner;
$sa->init();
	
*/