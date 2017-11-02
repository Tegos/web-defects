$(document).ready(function () {
	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
	});

	let graph_columns = $('#table_intensity .column_graph');
	graph_columns.each(function () {
		let t = $(this);
		let position = t.data('position');
		let element_id = 'graph_intensity_' + position;
		//console.log(position);

		$.ajax({
			url: `/ajax/intensity/${imageId}/${position}`,
			dataType: 'json',
			success: function (data) {
				initChart(element_id, data);
				console.log(element_id, data);
			}
		});

	});

	// group chart

	let groupChart = $('#groupChart .groupChart');
	groupChart.each(function () {
		let t = $(this);
		let imageKeys = t.data('image');
		let element_id = t.attr('id');
		//console.log(position);

		$.ajax({
			url: '/ajax/chart',
			type: 'post',
			dataType: 'json',
			data: {
				//_token: '{{ csrf_token() }}',
				featureDataOfImages,
				imageKeys
			},
			success: function (data) {
				//initChart(element_id, data);
				console.log(element_id, data);
			}
		});

	});
});

let initChart = function (element_id = '', series_data = []) {
	Highcharts.chart(element_id, {

		title: {
			text: chartTitle
		},

		subtitle: {
			text: chartSubTitle
		},

		yAxis: {
			max: 255,
			min: 0,
			title: {
				text: yFeatureText
			},
			alignTicks: false,
			endOnTick: false,
		},

		series: [
			{
				name: chartTitle,
				data: series_data
			}
		],
		chart: {
			type: 'line',
			alignTicks: false,
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

let initChartGroup = function (element_id = '', series_data = []) {
	Highcharts.chart(element_id, {

		title: {
			text: chartTitle
		},

		subtitle: {
			text: chartSubTitle
		},

		yAxis: {
			max: 255,
			min: 0,
			title: {
				text: yFeatureText
			},
			alignTicks: false,
			endOnTick: false,
		},

		series: [
			{
				name: chartTitle,
				data: series_data
			}
		],
		chart: {
			type: 'line',
			alignTicks: false,
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