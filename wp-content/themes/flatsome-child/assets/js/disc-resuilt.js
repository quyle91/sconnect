(function ($) {
	"use strict";

	$(document).ready(function() {
		var dataPoint = $('#disc-chart').data('chart-point');
		$('#disc-chart').highcharts({
			title: {
				text: '',
				x: 0
			},
			subtitle: {
				text: '',
				x: 0
			},
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
			xAxis: {
				categories: ['D', 'I', 'S', 'C'],
				labels: {
					useHTML: true,
					formatter: function () {
						var style = 'width:22px;height:22px;display:flex;justify-content:center;align-items:center;color:#fff;border-radius:50%;margin-left:-4px;';
						switch(this.value) {
							case 'D':
							    style += 'background-color: #FF611A;';
							    return '<span style="'+style+'">' + this.value + '</span>';
								break;
							case 'I':
							    style += 'background-color: #F09720;';
							    return '<span style="'+style+'">' + this.value + '</span>';
								break;
							case 'S':
							    style += 'background-color: #008444;';
							    return '<span style="'+style+'">' + this.value + '</span>';
								break;
							case 'C':
							    style += 'background-color: #0065A9;';
							    return '<span style="'+style+'">' + this.value + '</span>';
								break;
							default:
							    return this.value;
						} 
					}
				}
			},
			yAxis: {
				title: {
					text: '%'
				},
				// categories: [0, 20, 40, 60, 80, 100],
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}],
			},
			tooltip: {
				enabled: false,
				crosshairs: false,
				borderColor: '#FFDD90',
				borderRadius: '3',
				borderWidth: '1',
				// backgroundColor: '#FFFAD3',
				formatter: function() {
					return '<strong>' + this.y + '</strong>';
				}
			},
			legend: {
				enabled: false
			},
			credits: {
				enabled: false
			},
			plotOptions: {
				area: {
					fillColor: 'none',
					lineWidth: 1,
					marker: {
						enabled: true,
						fillColor: '#FFF',
						lineWidth: 2
					},
					shadow: false,
					states: {
						hover: {
							lineWidth: 3
						}
					},
					threshold: null
				}
			},
			series: [{
				dataLabels: {
					enabled: true
				},
				name: '',
				type: 'area',
				data: [ 
					{
						y: dataPoint.point_D,
						marker: {
							lineColor: '#FF611A',
						}
					},
					{
						y: dataPoint.point_I,
						marker: {
							lineColor: '#F09720',
						}
					},
					{
						y: dataPoint.point_S,
						marker: {
							lineColor: '#008444',
						}
					},
					{
						y: dataPoint.point_C,
						marker: {
							lineColor: '#0065A9',
						}
					}
				]
			}]
		});
	});

})(jQuery);