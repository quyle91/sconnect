<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class TestHuongNghiep {
	
	function __construct() {
		$a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
		$a->shortcode_name = 'sconnect-disc-testing';
		$a->shortcode_title = 'Sconnect DISC Tesing';

		$a->shortcode_callback = function() use($a){
			if (!have_rows('disc_questions', 'option')) return;

			$total_question = count(get_field('disc_questions', 'option'));
			$disc_item_question = '';
			$index_ques = 1;
			if (have_rows('disc_questions', 'option')) {
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

												<input id="disc_most_'.$index_ques.'_'.$index_anw.'" class="disc_anwser_checkbox disc_most_checkbox mt-0 mr-0 ml-0 mb-0" type="radio" name="disc_most_'.$index_ques.'" value="'.get_sub_field('most').'" />
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

												<input id="disc_least_'.$index_ques.'_'.$index_anw.'" class="disc_anwser_checkbox disc_least_checkbox mt-0 mr-0 ml-0 mb-0" type="radio" name="disc_least_'.$index_ques.'" value="'.get_sub_field('least').'" />
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

					$prev_target = ($index_ques == 1) ? '' : 'data-target="'.($index_ques - 1).'"';
					$prev_disabled = ($index_ques == 1) ? 'disabled' : '';

					$next_target = ($index_ques == $total_question) ? '' : 'data-target="'.($index_ques + 1).'"';
					$next_disabled = ($index_ques == $total_question) ? 'disabled' : '';

					$hidden = ($disc_item_question != '') ? 'hidden' : '';

					$disc_item_question .= '

						[col span__sm="12" padding="0px 0px 100px 0px" bg_radius="10" depth="2" border="1px 1px 1px 1px" border_radius="10" class="'.$hidden.' pb-0 disc_item_question disc_item_question_'.$index_ques.'"]

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

											[featured_box img="1338" inline_svg="0" img_width="24" pos="left"]

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

											<a class="button secondary lowercase disc_navigation disc_navigation_prev '.$prev_disabled.'" '.$prev_target.' style="border-radius:10px;padding:5px 50px 5px 50px;">
										  		<i class="icon-angle-left" aria-hidden="true"></i><span>'.__('Câu trước', 'sconnect').'</span>
										  	</a>

										[/col_inner_1]

										[col_inner_1 span="6" span__sm="12" align="right" class="pb-0"]

											<a class="button primary lowercase disc_navigation disc_navigation_next '.$next_disabled.'" '.$next_target.' style="border-radius:10px;padding:5px 50px 5px 50px;">
											    <span>'.__('Câu sau', 'sconnect').'</span><i class="icon-angle-right" aria-hidden="true"></i>
										  	</a>

										[/col_inner_1]

									[/row_inner_1]

								[/col_inner]

							[/row_inner]

						[/col]

					';

					$index_ques++;
				}
			}

			$disc_section = '

				[section]

					[row]

						'.$disc_item_question.'

					[/row]

				[/section]

			';

			echo do_shortcode( $disc_section );
			?>
			<div class="disc-testing">
				<div class="kh_list_questions">
					<?php  
					
					?>
				</div>
			</div>
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
			</style>
			<?php
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

	public function add_stype_image_map_frontend() {
		// wp_register_style( 'image-map-style', Sconnect_Url . "/assets/css/image-map.css", [], null, 'all' );
		// wp_enqueue_style('image-map-style');  

		// wp_register_script( 'image-map-script', Sconnect_Url  . "/assets/js/image-map.js", array('jquery'), '', true );
		// wp_enqueue_script('image-map-script');
	}
}



