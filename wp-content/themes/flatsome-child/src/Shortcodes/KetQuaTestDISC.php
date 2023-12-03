<?php
//KetQuaTestDISC.php
namespace Sconnect\Shortcodes;
class KetQuaTestDISC {
	
	function __construct() {
		$a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
		$a->shortcode_name = 'sconnect-disc-resuilt';
		$a->shortcode_title = 'Sconnect DISC Resuilt';

		add_action( 'wp_enqueue_scripts', [$this, 'add_stype_script_frontend'] );

		$a->shortcode_callback = function() use($a){
			if (!isset($_GET['_disc_data']) || empty($_GET['_disc_data'])) {
				echo '<div class="text-center is-large mb mt pb pt">'.__('Kết quả bài test không tồn tại!', 'sconnect').'</div>';
				return;
			}

			$results = $this->get_all_postmeta_by_hash($_GET['_disc_data']);
			if (!$results) {
				echo '<div class="text-center is-large mb mt pb pt">'.__('Kết quả bài test không tồn tại!', 'sconnect').'</div>';
				return;
			}

			$data_testing = json_decode($results['data_testing'], true);
			$data_point = $this->handle_disc_point_by_raw_data_testing($data_testing);
			$data_chart = "data-chart-point='$data_point'";

			$shortcode_content = '
				[section bg_color="#008444" dark="true" padding="70px" class="disc-resuilt-banner"]

					[row style="collapse"]

						[col span__sm="12"]

							[title style="center" text="'.__('KẾT QUẢ BÀI TEST DISC', 'sconnect').'"]

							[ux_stack distribute="center" gap="3" gap__sm="2"]

								[ux_text]

									<p class="mb-0">'.__('Họ tên', 'sconnect').': <strong>'.$results['name'].'</strong></p>
								
								[/ux_text]

								[ux_text]

									<p class="mb-0">'.__('Ngày sinh', 'sconnect').': <strong>'.$results['birthday'].'</strong></p>
								
								[/ux_text]

							[/ux_stack]

						[/col]

					[/row]

				[/section]

				[section]

					[row]

						[col span__sm="12" padding="50px 50px 50px 50px" padding__md="20px 20px 20px 20px" margin="-70px 0px 0px 0px" bg_color="rgb(255, 255, 255)" bg_radius="10" depth="2"]

							[row_inner]

								[col_inner span__sm="12"]

								[ux_text text_align="center"]

									<h3 class="uppercase mb-0"><span style="color: #0065a9;">Nhóm CS:</span> <span style="color: #282828;">Nhóm người ảnh hưởng và sự ổn định</span></h3>

								[/ux_text]

								[/col_inner]

							[/row_inner]
							
							[row_inner style="small" v_align="equal"]

								[col_inner span="4" span__sm="12" padding="25px 25px 0px 25px" padding__md="10px 10px 0px 10px" bg_color="rgb(237, 245, 241)" bg_radius="5"]

									[ux_text text_align="center"]

									<h5 class="uppercase"><span style="color: #282828;">'.__('Mô tả', 'sconnect').'</span></h5>
									<p>Thấu đáo, chính xác, điềm tĩnh, lô-gic, ngăn nắp, chính xác, cẩn thận, rụt rè, trầm lặng, tập trung, dễ bằng lòng, chú trọng chi tiết và mềm dẻo.</p>
									[/ux_text]
									[gap height__sm="10px"]

									[divider align="center" width="200px" margin="0px" color="rgb(0, 132, 68)"]

								[/col_inner]
								
								[col_inner span="4" span__sm="12" padding="25px 25px 0px 25px" padding__md="10px 10px 0px 10px" bg_color="rgb(237, 245, 241)" bg_radius="5"]

									[ux_text text_align="center"]

									<h5 class="uppercase"><span style="color: #282828;">'.__('Nhóm công việc', 'sconnect').'</span></h5>
									<p>Chuyên gia, nghiên cứu, kỹ thuật, tài chính, IQ cao, trung thực, chính xác, phân tích, tuân thủ<br />và đọc tài liệu.</p>
									[/ux_text]
									[gap height__sm="10px"]

									[divider align="center" width="200px" margin="0px" color="rgb(0, 132, 68)"]

								[/col_inner]

								[col_inner span="4" span__sm="12" padding="25px 25px 0px 25px" padding__md="10px 10px 0px 10px" bg_color="rgb(237, 245, 241)" bg_radius="5"]

									[ux_text text_align="center"]

									<h5 class="uppercase"><span style="color: #282828;">'.__('Công việc', 'sconnect').'</span></h5>
									<p>Lập trình viên, kế toán, thủ quỹ, thủ kho, bác sỹ, vận hành máy móc, nhân sự C&amp;B, quản lý dữ liệu, IT, bác sỹ tâm lý và nghiên cứu thị trường.</p>
									[/ux_text]
									[gap height__sm="10px"]

									[divider align="center" width="200px" margin="0px" color="rgb(0, 132, 68)"]

								[/col_inner]

							[/row_inner]
							
							[row_inner v_align="middle" h_align="center"]

								[col_inner span="4" span__sm="12" span__md="10" margin="80px 0px 80px 0px" margin__sm="30px 0px 10px 0px" margin__md="30px 0px 40px 0px" align="center"]

									[ux_html]

										<div id="disc-chart" '.$data_chart.' style="min-width: 310px; height: 300px; margin: 0 auto"></div>
									
									[/ux_html]

								[/col_inner]
									
								[col_inner span="2" span__sm="12" margin__sm="-20px 0px 0px 0px"]

									<p><strong><span style="color: #ff611a;">D</span> - Dominance</strong></p>
									<p><strong><span style="color: #f09720;">I</span> - Influence</strong></p>
									<p><strong><span style="color: #008444;">S</span> - Steadiness</strong></p>
									<p><strong><span style="color: #0065a9;">C</span> - Conscientiousness</strong></p>

								[/col_inner]

							[/row_inner]

							[row_inner style="collapse" h_align="center"]

								[col_inner span="10" span__sm="12" span__md="12"]

									[accordion class="disc_accordion"]

										[accordion-item title="1. '.__('Ưu điểm của nhóm tính cách', 'sconnect').' CS" class="tesst"]

											<p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

										[/accordion-item]

										[accordion-item title="2. '.__('Điểm hạn chế của nhóm tính cách', 'sconnect').' CS"]

											<p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

										[/accordion-item]

										[accordion-item title="3. '.__('Mô tả hành vi và phong cách làm việc của nhóm', 'sconnect').' CS"]

											<p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

										[/accordion-item]

										[accordion-item title="4. '.__('Định hướng nghề nghiệp', 'sconnect').' CS"]

											<p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

										[/accordion-item]

										[accordion-item title="5. '.__('Lời khuyên dành cho người thuộc nhóm', 'sconnect').' CS"]

											<p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>

										[/accordion-item]

									[/accordion]

								[/col_inner]

							[/row_inner]

						[/col]

					[/row]

				[/section]
			';
			echo do_shortcode( $shortcode_content );
			?>
			<style type="text/css">
				.disc-resuilt-banner {
					background: linear-gradient(180deg, #008444 0%, #09293F 100%);
				}
				.disc_accordion .accordion-item .accordion-title {
					display: flex;
					justify-content: space-between;
					align-items: center;
					flex-direction: row-reverse;
					font-weight: bold;
				}
				.disc_accordion .accordion-item .accordion-title .toggle {
					position: relative;
					margin: 0;
				}
				@media(max-width: 767px){
				    .disc_accordion .accordion-item .accordion-title {
					    padding-left: 15px;
					    padding-right: 15px;
					    font-size: 0.9em;
				    }
				    .disc_accordion .accordion-item .accordion-inner {
					    padding-left: 15px;
					    padding-right: 15px;
				    }
				}
			</style>
			<?php
			wp_enqueue_script('disc-resuilt-script');
			wp_enqueue_script('highcharts-lib-script');
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

		wp_register_script( 'disc-resuilt-script', Sconnect_Url  . "/assets/js/disc-resuilt.js", array('jquery'), '', true );
		wp_register_script( 'highcharts-lib-script', Sconnect_Url  . "/assets/js/lib/highcharts.min.js", array('jquery'), '', true );
		
	}

	private function get_all_postmeta_by_hash( $hash ) {
		global $wpdb;

		$q = "SELECT * 
			FROM wp_postmeta 
			WHERE post_id = (
				SELECT post_id 
				FROM wp_postmeta 
				WHERE meta_key = 'hash_id' 
				AND meta_value = '$hash'
			)
		";
		$results = $wpdb->get_results($q, ARRAY_A);

		if (!$results) return false;

		$results_fetch = [];
		foreach ($results as $item) {
			$results_fetch[$item['meta_key']] = $item['meta_value'];
		}

		return $results_fetch;
	}

	private function handle_disc_point_by_raw_data_testing($data_testing) {
		$point_D = 0;
		$point_I = 0;
		$point_S = 0;
		$point_C = 0;
		foreach ($data_testing as $item_anwser) {
			switch ($item_anwser['most']) {
				case 1:
					$point_D++;
					break;
				case 2:
					$point_I++;
					break;
				case 3:
					$point_S++;
					break;
				case 4:
					$point_C++;
					break;
				default:
					// code...
					break;
			}
			switch ($item_anwser['least']) {
				case 1:
					$point_D--;
					break;
				case 2:
					$point_I--;
					break;
				case 3:
					$point_S--;
					break;
				case 4:
					$point_C--;
					break;
				default:
					// code...
					break;
			}
		}
		$data_point = [
			'point_D' => $point_D,
			'point_I' => $point_I,
			'point_S' => $point_S,
			'point_C' => $point_C,
		];

		return json_encode($data_point);
	}
}
