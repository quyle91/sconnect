(function ($) {
	"use strict";

	function getAllDataTesting() {
		var dataTesting = [];
		$('.disc_item_question').each(function(i) {
			var mostVal = $(this).find('.disc_most_checkbox:checked').val(),
				leastVal = $(this).find('.disc_least_checkbox:checked').val();

			dataTesting[i] = {
				most: mostVal,
				least: leastVal,
			}
		});

		return JSON.stringify(dataTesting);
	}

	$(document).ready(function() {
		$('.disc_anwser_checkbox').change(function(e) {
		    e.preventDefault();
		    var indexAnwser = $(this).data('anwser-index'),
		    	symmetryAnwser = $(this).hasClass('disc_least_checkbox') ? 'most' : 'least';

		    $(this)
				.closest('.disc_list_anwsers')
				.find('.disc_'+symmetryAnwser+'_checkbox').removeAttr('disabled');
			$(this)
				.closest('.row')
				.find('.disc_'+symmetryAnwser+'_checkbox[data-anwser-index="'+indexAnwser+'"]')
				.attr('disabled', true);
		});

		$('.disc_navigation_next:not(.disabled)').on('click', function(e) {
			e.preventDefault();
			var currentQues = $(this).data('current-question'),
				targetQues = $(this).data('target'),
				mostInput = $('.disc_anwser_checkbox[name="disc_most_'+currentQues+'"]:checked'),
				leastInput = $('.disc_anwser_checkbox[name="disc_least_'+currentQues+'"]:checked');

			if (!mostInput.val() || !leastInput.val()) {
				Swal.fire({
				  	text: sconnect_disc.string.warning_required_both,
				  	icon: "warning",
				  	confirmButtonText: sconnect_disc.string.warning_button_text
				});
				return;
			}
			if (mostInput.data('anwser-index') == leastInput.data('anwser-index')) {
				Swal.fire({
				  	text: sconnect_disc.string.warning_same_anwser,
				  	icon: "warning",
				  	confirmButtonText: sconnect_disc.string.warning_button_text
				});
				return;
			}

			if (!$(this).hasClass('btn_disc_form')) {
				$(this).closest('.disc_item_question').addClass('hidden');
				$('.disc_item_question_'+targetQues).removeClass('hidden');
			}
			else {
				$('#popup_disc_form input[name="data_testing"]').val(getAllDataTesting());
				$('#btn_disc_form').click();
			}
		});

		$('.disc_navigation_prev:not(.disabled)').on('click', function(e) {
			e.preventDefault();
			var targetQues = $(this).data('target');

			$(this).closest('.disc_item_question').addClass('hidden');
			$('.disc_item_question_'+targetQues).removeClass('hidden');
		});

		/**
		 * Bắt sự kiện submit form cf7 để xử lý data
		 */
		document.addEventListener( 'wpcf7submit', function( event ) {
		    var idForm = event.detail.contactFormId;
			if (idForm == sconnect_disc.cf7_form_id) {
				if (event.detail.apiResponse.faild) {
					Swal.fire({
					  	text: event.detail.apiResponse.faild,
					  	icon: "warning",
					  	confirmButtonText: sconnect_disc.string.warning_button_text
					});
					$(this).find('.wpcf7-submit.button').closest('.processing').removeClass('processing');
				}
				if (event.detail.apiResponse.success) {
					 location.href = sconnect_disc.disc_resuilt_page+'?_disc_data='+event.detail.apiResponse.success; 
				}
			}		    
		})
	})

	$(window).on('load', function() {
	    
	})

})(jQuery);