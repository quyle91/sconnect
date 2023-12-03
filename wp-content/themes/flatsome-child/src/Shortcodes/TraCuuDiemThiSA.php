<?php
//TraCuuDiemThiSA.php
namespace Sconnect\Shortcodes;
class TraCuuDiemThiSA {
	
	function __construct() {
		$a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
		$a->shortcode_name = 'sconnect-sa-lookup';
		$a->shortcode_title = 'Sconnect Tra cứu điểm thi SA';

		add_action( 'wp_enqueue_scripts', [$this, 'add_stype_script_frontend'] );
		add_action( 'wp_ajax_sconnect_handle_sa_form', [$this, 'sconnect_handle_sa_form'], 20 );

		$a->shortcode_callback = function() use($a){

			$shortcode_content = '
				[section]

					[row style="collapse" col_bg="rgb(237, 245, 241)" col_bg_radius="10" v_align="middle" padding__sm="0px 15px 15px 15px"]

						[col span__sm="12"]

							[row_inner style="collapse" h_align="center" padding="0px 0px 40px 0px"]

								[col_inner span="8" span__sm="12" margin="-30px 0px 0px 0px"]

									[title style="center" text="'.__('TRA CỨU ĐIỂM THI SA', 'sconnect').'" tag_name="h2" color="rgb(255, 255, 255)" margin_bottom="15px" class="sa_form_title"]

									[ux_text text_align="center"]

										<p><strong><em>'.__('Thí sinh nhập một hoặc nhiều điều kiện vào các ô bên dưới', 'sconnect').':</em></strong></p>
									[/ux_text]
									
									[ux_html]

										<form method="POST" id="sa-form">
										    <div class="row row-collapse mb-half align-middle">
										        <label class="col small-12 large-2 is-normal">'.__('Họ và tên', 'sconnect').' <span style="color: red;">*<span></label>
										        <div class="col small-12 large-10">
										            <input type="text" name="sa_name" class="mb-0" placeholder="'.__('Họ và tên của bạn', 'sconnect').'" required>
										        </div>
										    </div>
										    <div class="row row-collapse mb-half align-middle">
										        <label class="col small-12 large-2 is-normal">'.__('Số điện thoại', 'sconnect').' <span style="color: red;">*<span></label>
										        <div class="col small-12 large-10">
										            <input type="tel" name="sa_phone" class="mb-0" placeholder="'.__('Số điện thoại của bạn', 'sconnect').'" required>
										        </div>
										    </div>
										    <div class="row row-collapse mb-half align-middle">
										        <label class="col small-12 large-2 is-normal">'.__('Ngày sinh', 'sconnect').' <span style="color: red;">*<span></label>
										        <div class="col small-12 large-10">
										            <input type="date" name="sa_birth" class="mb-0">
										        </div>
										    </div>
										    <div class="row row-collapse mb-half align-middle">
										        <label class="col small-12 large-2 is-normal">'.__('Ngày thi', 'sconnect').' <span style="color: red;">*<span></label>
										        <div class="col small-12 large-10">
										            <input type="date" name="sa_testday" class="mb-0">
										        </div>
										    </div>
										    <div class="row row-collapse mb-half align-middle">
										        <label class="col small-12 large-2 is-normal">'.__('Khu vực', 'sconnect').' <span style="color: red;">*<span></label>
										        <div class="col small-12 large-10">
										            <select name="sa_area" class="mb-0">
										                <option value="ha-noi">Hà Nội</option>
										                <option value="tp-ho-chi-minh">Thành phố Hồ Chí Minh</option>
										                <option value="da-nang">Đà Nẵng</option>
										                <option value="hai-phong">Hải Phòng</option>
										            </select>
										        </div>
										    </div>
										    <div class="stack mt stack-row justify-center items-center" style="--stack-gap: 0.7rem;">
										        <button id="sa-submit-form" type="submit" class="button primary lowercase sa_form_button" style="border-radius:10px;padding:5px 60px 5px 60px;"><span>'.__('Tìm kiếm', 'sconnect').'</span></button>
										        <a href="javascript:void(0)" id="sa-refresh-form" class="button primary is-outline lowercase sa_form_button" style="border-radius:10px;padding:5px 60px 5px 60px;"><span>'.__('Làm mới', 'sconnect').'</span></a>
										    </div>
										</form>

									[/ux_html]

								[/col_inner]

							[/row_inner]

						[/col]

					[/row]

				[/section]
			';
			echo do_shortcode( $shortcode_content );
			?>
			<style type="text/css">
				.sa_form_button::before {
					content: '';
					position: absolute;
					width: 33px;
					height: 102%;
					right: -15px;
					bottom: 0;
					z-index: 9;
					background-color: rgba(255,255,255,0.2);
					transform: skew(155deg);
				}
				.sa_form_button {
					overflow: hidden;
				}
				.is-outline.sa_form_button::before {
					background-color: #00844433;
				}
				.sa_form_title .section-title {
					background: url(<?php echo Sconnect_Url ?>/assets/images/sa-header-form.png) no-repeat center;
					background-size: contain;
					padding: 20px;
				}
				.error {
					color: var(--alert-color);
				}
			</style>
			<?php
			wp_enqueue_script('sa-form-script');
			wp_enqueue_script('validate-lib-script');
			wp_enqueue_style('sweetalert2-lib-style');  
			wp_enqueue_script('sweetalert2-lib-script');
		};
		$a->options = [
			'text' => array(
				'type'       => 'textfield',
				'heading'    => 'Text ',
				'default' => 'Text',
			),
		];
		$a->general_element();
	}

	public function add_stype_script_frontend() {
		// wp_register_style( 'image-map-style', Sconnect_Url . "/assets/css/image-map.css", [], null, 'all' );
		// wp_enqueue_style('image-map-style');  

		wp_register_script( 'sa-form-script', Sconnect_Url  . "/assets/js/sa-form-handle.js", array('jquery'), '', true );
		wp_register_script( 'validate-lib-script', Sconnect_Url  . "/assets/js/lib/jquery.validate.min.js", array('jquery'), '', true );
		
		wp_localize_script( 'sa-form-script', 'sconnect_sa_form', array(
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'security_nonce'	=> wp_create_nonce( "sconnect-nonce-ajax" ),
			'string' => array(
				'warning_required' => __('Trường này là bắt buộc', 'sconnect'),
				'warning_wrong_phone' => __('Hãy nhập đúng số điện thoại', 'sconnect'),
			)
		));
	}

	public function sconnect_handle_sa_form() {
	    check_ajax_referer( 'sconnect-nonce-ajax', 'ajax_nonce_parameter' );

	    $response = ['success' => true, 'message' => ''];

	    // if (isset($_POST['field_id']) && isset($_FILES['owcpv_file'])) {
	    //     $product_id = $_POST['product_id'];
	    //     $field = get_field_of_product_by_field_id($product_id, $_POST['field_id']);
	        
	    //     if ($field) {
	    //         $form = new OWCPV_Form_Handler($field, $product_id);
	    //         $response = $form->owcpv_ajax_upload();
	    //     }
	    //     else {
	    //         $response['message'] = __('Wrong field id. Please try again!', 'owcpv');
	    //     }
	    // }

	    wp_send_json($response);
	    exit();
	}
}
