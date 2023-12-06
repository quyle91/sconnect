<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class TestHuongNghiep {
	private $validate_time_spam = 10; // minutes
	
	function __construct() {
		$a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
		$a->shortcode_name = 'sconnect-disc-testing';
		$a->shortcode_title = 'Sconnect DISC Tesing';

		add_action( 'wp_enqueue_scripts', [$this, 'add_stype_script_frontend'] );
		add_action(	'wpcf7_before_send_mail', [$this, 'cf7_create_post'], 10, 3 );

		add_filter( "acf/prepare_field_group_for_import", [$this, 'exclude_default_acf_field'], 10);

		$a->shortcode_callback = function() use($a){
			ob_start();

			if (!have_rows('disc_questions', 'option')) return;

			$total_question = $this->count_total_questions();
			$disc_item_question = '';
			$index_ques = 1;

			while (have_rows('disc_questions', 'option')) {
				the_row();
				$disc_list_anwsers = '';
				$index_anw = 1;
				if (have_rows('disc_questions_list')) {
					while (have_rows('disc_questions_list')) {
						the_row();

						$disc_list_anwsers .= '

							[row_inner_2 style="small" v_align="middle"]

								[col_inner_2 span="1" span__sm="12" class="pb-0"]

									[ux_html]

										<p class="mb-0">

											<input id="disc_most_'.$index_ques.'_'.$index_anw.'" class="disc_anwser_checkbox disc_most_checkbox mt-0 mr-0 ml-0 mb-0" type="radio" name="disc_most_'.$index_ques.'" value="'.get_sub_field('most').'" data-anwser-index="'.$index_anw.'"/>
											<label for="disc_most_'.$index_ques.'_'.$index_anw.'"></label>

										</p>
										
									[/ux_html]

								[/col_inner_2]
							
								[col_inner_2 span="10" span__sm="12" align="center" class="pb-0"]

									[ux_text font_size="1"]

										<p class="mb-0"><strong>'.get_sub_field('disc_anwser').'</strong></p>
									
									[/ux_text]

								[/col_inner_2]
							
								[col_inner_2 span="1" span__sm="12" align="right" class="pb-0"]

									[ux_html]

										<p class="mb-0">

											<input id="disc_least_'.$index_ques.'_'.$index_anw.'" class="disc_anwser_checkbox disc_least_checkbox mt-0 mr-0 ml-0 mb-0" type="radio" name="disc_least_'.$index_ques.'" value="'.get_sub_field('least').'" data-anwser-index="'.$index_anw.'"/>
											<label for="disc_least_'.$index_ques.'_'.$index_anw.'"></label>

										</p>

									[/ux_html]

								[/col_inner_2]

							[/row_inner_2]

							[divider width="100%" height="1px" color="rgb(234, 234, 235)"]
							
						';

						$index_anw++;
					}
				}

				$prev_button = '<a class="button secondary lowercase disc_navigation disc_navigation_prev" data-target="'.($index_ques - 1).'" style="border-radius:10px;padding:5px 50px 5px 50px;"><i class="icon-angle-left" aria-hidden="true"></i><span>'.__('Câu trước', 'sconnect').'</span></a>';
				if ($index_ques == 1) {
					$prev_button = '<a class="button secondary lowercase disc_navigation disc_navigation_prev disabled" style="border-radius:10px;padding:5px 50px 5px 50px;"><i class="icon-angle-left" aria-hidden="true"></i><span>'.__('Câu trước', 'sconnect').'</span></a>';
				}

				$next_button = '<a class="button primary lowercase disc_navigation disc_navigation_next" data-target="'.($index_ques + 1).'" style="border-radius:10px;padding:5px 50px 5px 50px;" data-current-question="'.$index_ques.'"><span>'.__('Câu sau', 'sconnect').'</span><i class="icon-angle-right" aria-hidden="true"></i></a>';
				if ($index_ques == $total_question) {
					$next_button = '<a class="button primary lowercase disc_navigation disc_navigation_next btn_disc_form" style="border-radius:10px;padding:5px 50px 5px 50px;" data-current-question="'.$index_ques.'"><span>'.__('Xem kết quả', 'sconnect').'</span><i class="icon-angle-right" aria-hidden="true"></i></a><a href="#popup_disc_form" id="btn_disc_form"></a>';
				}

				$hidden = ($disc_item_question != '') ? 'hidden' : '';

				$disc_item_question .= '

					[col span__sm="12" padding="0px 0px 100px 0px" bg_radius="10" depth="2" border="1px 1px 1px 1px" border_radius="10" class="'.$hidden.' pb-0 disc_item_question disc_item_question_'.$index_ques.'" bg_color="rgb(255,255,255)"]

						[row_inner style="collapse" h_align="center" class="disc_index_question"]

							[col_inner span="2" span__sm="12" padding="10px 0px 10px 0px" align="center" bg_color="rgb(237, 245, 241)" bg_radius="15"]

								[ux_text font_size="1"]

									<h3 class="mb-0"><span style="font-size: 120%;">'.$index_ques.'<span style="color: #000000;">/'.$total_question.'</span></span></h3>
								
								[/ux_text]

							[/col_inner]

						[/row_inner]
							
						[row_inner style="collapse" h_align="center" class="mt disc_header_question"]

							[col_inner span="8" span__sm="12"]

								[row_inner_1]

									[col_inner_1 span="6" span__sm="12" class="pb-0"]

										[featured_box img="1339" inline_svg="0" img_width="24" pos="left"]

											<h4 class="mb-0">'.__('Giống tôi nhất', 'sconnect').'</h4>

										[/featured_box]

									[/col_inner_1]

									[col_inner_1 span="6" span__sm="12" align="right" class="pb-0"]

										[featured_box img="1340" inline_svg="0" img_width="24" pos="right"]

											[ux_text text_color="rgb(235, 87, 87)"]

												<h4 class="mb-0">'.__('Khác tôi nhất', 'sconnect').'</h4>
											
											[/ux_text]

										[/featured_box]

									[/col_inner_1]

								[/row_inner_1]

							[/col_inner]

						[/row_inner]

						[row_inner style="collapse" h_align="center" class="mt disc_list_anwsers"]

							[col_inner span="8" span__sm="12"]

								[row_inner_1]

									[col_inner_1 span__sm="12" class="pb-0"]

										'.$disc_list_anwsers.'

									[/col_inner_1]

								[/row_inner_1]

							[/col_inner]

						[/row_inner]

						[row_inner style="collapse" h_align="center" class="mt disc_footer_question"]

							[col_inner span="8" span__sm="12"]

								[row_inner_1]

									[col_inner_1 span="6" span__sm="12" class="pb-0"]

										'.$prev_button.'

									[/col_inner_1]

									[col_inner_1 span="6" span__sm="12" align="right" class="pb-0"]

										'.$next_button.'

									[/col_inner_1]

								[/row_inner_1]

							[/col_inner]

						[/row_inner]

					[/col]

				';

				$index_ques++;
			}

			$disc_section = $disc_item_question;

			echo do_shortcode( $disc_section );
			?>
			<style type="text/css">
				.disc_index_question > .col > .col-inner {
					border-radius: 0 0 15px 15px !important;
				}
				.disc_anwser_checkbox {
					position: absolute;
					z-index: -1;
					opacity: 0;
					left: 0;
					top: 0;
					visibility: hidden;
				}
				.disc_anwser_checkbox[type="radio"] + label {
					border-radius: 4px;
					border: 2px solid #BDBDBD;
					display: inline-block;
					width: 34px;
					height: 34px;
					cursor: pointer;
					margin-bottom: 0;
					position: relative;
				}
				.disc_anwser_checkbox[type="radio"]:checked + label {
					background-color: #008444;
					border-color: #008444;
				}
				.disc_anwser_checkbox[type="radio"][disabled] + label {
					background-color: #BDBDBD;
				}
				.disc_anwser_checkbox[type="radio"]:checked + label::before {
					content: '\e00a';
					font-family: fl-icons;
					color: #fff;
					font-weight: 300;
					font-size: 16px;
					line-height: 1; 
					position: absolute;
					left: 50%;
					top: 50%;
					transform: translate(-50%, -50%);
				}
				.disc_anwser_checkbox[type="radio"][disabled] + label::before {
					display: none;
				}
				.disc_anwser_checkbox.disc_least_checkbox[type="radio"]:checked + label {
					background-color: #EB5757;
					border-color: #EB5757;
				}
				#popup_disc_form .wpcf7-form.failed .wpcf7-response-output {
					display: none;
				}
				#popup_disc_form .wpcf7-form.aborted .wpcf7-response-output {
					display: none;
				}
			</style>
			<?php
			$id_form = ($this->get_cf7_form_id_disc()) ? $this->get_cf7_form_id_disc() : 0;
			self::add_cf7_form_disc($id_form);
			wp_enqueue_script('disc-handle-script');
			wp_enqueue_style('sweetalert2-lib-style');  
			wp_enqueue_script('sweetalert2-lib-script');
			

			return ob_get_clean();
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

	private function count_total_questions() {
		if (!have_rows('disc_questions', 'option')) return 0;
		return count(get_field('disc_questions', 'option'));
	}

	private function get_cf7_form_id_disc() {
		return get_field('disc_cf7_form', 'option');
	}

	public function add_stype_script_frontend() {
		wp_register_style( 'sweetalert2-lib-style', Sconnect_Url . "/assets/css/lib/sweetalert2.min.css", [], null, 'all' );

		wp_register_script( 'disc-handle-script', Sconnect_Url  . "/assets/js/disc-handle.js", array('jquery'), '', true );
		wp_register_script( 'sweetalert2-lib-script', Sconnect_Url  . "/assets/js/lib/sweetalert2.all.min.js", array('jquery'), '', true );

		wp_localize_script( 'disc-handle-script', 'sconnect_disc', array(
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'security_nonce'	=> wp_create_nonce( "owcpv-nonce-ajax" ),
			'cf7_form_id' => $this->get_cf7_form_id_disc(),
			'disc_resuilt_page' => (get_field('disc_resuilt_page', 'option')) ? get_field('disc_resuilt_page', 'option') : '/disc-resuilt/',
			'string' => array(
				'warning_required_both' => __('Bạn cần trả lời đủ 2 phần!', 'sconnect'),
				'warning_same_anwser' => __('Chỉ được chọn một bên với cùng một đáp án!', 'sconnect'),
				'warning_button_text' => __('Xác nhận', 'sconnect'),
			)
		));
	}

	public static function add_cf7_form_disc($id_form) {
		$popup = '
			[lightbox id="popup_disc_form" width="700px" padding="50px"]
				[contact-form-7 id="'.$id_form.'"]
			[/lightbox]
		';
		echo do_shortcode($popup);
	}

	public function exclude_default_acf_field($field_group) {
		if ($field_group['key'] == 'group_6506a81783b36') {
			$field_group['location'] = array(
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
					array(
						'param' => 'post_type',
						'operator' => '!=',
						'value' => 'disc_kq',
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
		}

		return $field_group;
	}

	public function cf7_create_post($data, &$abort, $submission) {

		$form_id = $data->id;
		if ($form_id != $this->get_cf7_form_id_disc()) return;

		//Get the current posted form instance
		$submission = \WPCF7_Submission::get_instance();
		$formData = $submission->get_posted_data(); // Get all data from the posted form

		$disc_title = $formData['hovaten'] . ' - ' . $formData['sodienthoai'];
		$name = $formData['hovaten'];
		$phone = $formData['sodienthoai'];
		$email = $formData['diachiemail'];
		$birthday = $formData['namsinh'];
		$cur_job = $formData['cvhientai'];
		$dream_job = $formData['cvmouoc'];
		$data_testing = $formData['data_testing'];

		$data_arr = json_decode($data_testing, true);
		$total_question = $this->count_total_questions();

		if (!is_array($data_arr)) {
			$submission->add_result_props( ['faild' => __('Đã có lỗi xảy ra, vui lòng thử lại!', 'sconnect')] );
			$abort = true;
			return;
		}
		if (count($data_arr) != $total_question) {
			$submission->add_result_props( ['faild' => __('Bạn chưa hoàn thành bài Test. Vui lòng kiểm tra lại!', 'sconnect')] );
			$abort = true;
			return;
		}
		else {
			foreach ($data_arr as $item) {
				if (empty($item['most']) || empty($item['least'])) {
					$submission->add_result_props( ['faild' => __('Bạn chưa hoàn thành bài Test. Vui lòng kiểm tra lại!', 'sconnect')] );
					$abort = true;
					return;
				}
			}
		}

		$args = array(
		    'post_type' => 'disc_kq',
		    'posts_per_page'=> 1,
		    'post_status' => 'publish',
		    'meta_query' => array(
		    	'relation' => 'OR',
		        array(
		            'key' => 'phone',
		            'value' => $phone,
		            'compare' => '=',
		        ),
		        array(
		            'key' => 'email',
		            'value' => $email,
		            'compare' => '=',
		        ),
		    ),
		    // 'fields' => 'ids',
		    'date_query' => array(
	    		'relation' => 'AND',
	         	array(
	             	'after' => $this->validate_time_spam . ' minutes ago',
         			'inclusive' => true,
	         	)
	     	)
		);
		$validate_spam = new \WP_Query($args);
		if (!empty($validate_spam->posts)) {
			$submission->add_result_props( [
				'faild' => sprintf( __( 'Bạn vừa làm bài cách đây ít phút. Vui lòng chờ %d phút tính từ thời điểm nhận kết quả để làm lại bài Test', 'sconnect' ), $this->validate_time_spam )
			] );
			$abort = true;
			return;
		}

		// print_r($data_arr); die();
		$newpostid = wp_insert_post(array(
			'post_status'  => 'publish',
			'post_title'  => $disc_title,
			'post_type' => 'disc_kq'
		));

		if(is_wp_error($newpostid) || !$newpostid){
			$submission->add_result_props( ['faild' => __('Đã có lỗi xảy ra, vui lòng thử lại!', 'sconnect')] );
			$abort = true;
			return;
		}

		update_field( 'name', $name, $newpostid );
		update_field( 'phone', $phone, $newpostid );
		update_field( 'email', $email, $newpostid );
		update_field( 'birthday', $birthday, $newpostid );
		update_field( 'cur_job', $cur_job, $newpostid );
		update_field( 'dream_job', $dream_job, $newpostid );
		update_field( 'data_testing', $data_testing, $newpostid );

		$hash_id = sha1( implode( '|', array(
			$newpostid,
			$disc_title,
			time()
		)));
		update_post_meta($newpostid, 'hash_id', $hash_id);

		$submission->add_result_props( ['success' => $hash_id] );
	}
	

}



