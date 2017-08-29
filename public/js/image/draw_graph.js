$(document).ready(function () {
	let graph_columns = $('#table_intensity .column_graph');
	graph_columns.each(function () {
		let t = $(this);
		let position = t.data('position');
		let element_id = 'graph_intensity_' + position;
		console.log(position);
		initChart(element_id, []);
	});
});

let initChart = function (element_id = '', series_data = []) {
	Highcharts.chart(element_id, {

		title: {
			text: 'Інтенсивність'
		},

		subtitle: {
			text: 'по рядках'
		},

		yAxis: {
			title: {
				text: 'Середня інтенсивність'
			}
		},
		// legend: {
		// 	layout: 'vertical',
		// 	align: 'right',
		// 	verticalAlign: 'middle'
		// },


		// plotOptions: {
		// 	series: {
		// 		pointStart: 2010
		// 	}
		// },

		series: [
			{
				name: 'Зображення',
				data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
			}
		],
		chart: {
			events: {
				load: function () {
					setTimeout(() => {
						$('svg').each(function () {
							$(this).find('.highcharts-credits').last().remove();
						});
					}, 1000);
				}
			}
		}

	});


};