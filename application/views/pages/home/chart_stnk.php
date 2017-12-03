<div id="chart1" style="height: 400px;" class="col-md-12"></div>

<script type="text/javascript">
	$(function () {
		$('#chart1').highcharts({
			chart: {
				type: 'column',
				options3d: {
					enabled: true,
					alpha: 12,
					beta: 22
				},
				backgroundColor: "#FFFFFF",
				borderWidth: 0,
				borderColor: "#FFFFFF"
			},
			exporting: { enabled: false },
			title: {
				text: 'Summary Status STNK & Perawatan'
			},
			pane:{
				background: [{
					borderWidth: 0
				}]
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				categories: ['STNK', 'Perawatan']
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Jumlah'
				}
			},
			tooltip: {
				formatter: function () {
					return this.series.name + ': ' + this.y;
				}
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						style: {
							textShadow: '0 0 3px black'
						}
					},
					borderWidth: 0 // < set this option
				}
			},
				series: 
				[
					{
						name: 'Expired',
						data: [<?= $chart1[0]->total ?>, <?= $chart11[0]->total ?>]
					},
					{
						name: 'Valid',
						data: [<?= $chart1[1]->total ?>, <?= $chart11[1]->total ?>]
					}
				]
		});
	});
</script>