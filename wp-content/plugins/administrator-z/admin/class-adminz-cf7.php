<?php 
namespace Adminz\Admin;
use Adminz\Admin\Adminz as Adminz;

class ADMINZ_CF7 extends Adminz {
	public $options_group = "adminz_cf7";
	public $title = "Contact Form 7";
	protected $tab_icon = "email";
	static $slug = "adminz_cf7";
	static $options;
	function __construct() {
		if(!defined('WPCF7_VERSION')) return;
		
		$this::$options = get_option('adminz_cf7', []);	
		add_action( 'admin_init', [$this, 'register_option_setting']);
		add_filter( 'adminz_setting_tab', [$this,'register_tab']);
		add_action( 'adminz_tabs_html',[$this,'tab_html']);
		
		$this->make_allow_shortcode();
	}

	function make_allow_shortcode(){
		add_filter( 'wpcf7_form_elements', function($form){
			return do_shortcode( $form );
		} );
	}
	
	function register_option_setting() {        
        register_setting($this->options_group, self::$slug);
    }
    function register_tab($tabs) {
 		if(!$this->title) return;
 		if($this->tab_icon){ 			
 			$this->title = $this->get_icon_html($this->tab_icon).$this->title;
		}
        $tabs[self::$slug] = array(
            'title' => $this->title,
            'slug' => self::$slug,
            'type'=> '1'
        );
        return $tabs;
    }
	function tab_html(){
		if(!isset($_GET['tab']) or $_GET['tab'] !== self::$slug) return;
		?>
		<form method="post" action="options.php">
			<?php 
	        settings_fields($this->options_group);
	        do_settings_sections($this->options_group);
	        ?>
	        <table class="form-table">
	        	<tr valign="top">
	        		<th><h3>Contact Form 7</h3></th>
	        		<td></td>
	        	</tr>
	        	<tr valign="top">
	        		<th> <?php echo __("Allow shortcode in form","administrator-z"); ?> </th>
	        		<td>
                        <input type="checkbox" <?php if($this->check_option('allow_shortcode',false,"on")) echo 'checked'; ?> name="adminz_cf7[allow_shortcode]" />
                    </td>
	        	</tr>
        	</table>
        	<?php submit_button(); ?>
        </form>
        <?php
	}
}